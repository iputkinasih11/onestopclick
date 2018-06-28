<?php
namespace frontend\controllers;

use Yii;
use common\models\Product;
use common\models\Payments;
use common\models\PaymentDetail;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\Paypal;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
	public function actionIndex()
    {
    	$payment_detail    	= [];
    	$payments 			= [];
    	$total 				= 0;
    	$grand_total 		= 0;
    	$datenow 			= date('Y-m-d H:i:s', time());
    	$just_date			= date('Y-m-d', time()).' 00:00:00';
    	$payment_id 		= $this->getPaymentIDCode();
    	Yii::$app->session->set('payment_id', $payment_id);

    	foreach ($_SESSION['cart'] as $key => $value) :
    		$total 			= $total + $value['price'];
    	endforeach;

    	$total_usd = $this->currencyConverter( 'IDR', 'USD', $total );

    	if ( !empty( $_SESSION['voucher'] ) ) :
    		$voucher_id 	= $_SESSION['voucher']['code'];
    		$discount_prosentase 	= $_SESSION['voucher']['discount_prosentase'];
    		$discount_price 		= $_SESSION['voucher']['discount_price'];

    		if ( !empty( $discount_prosentase ) ) : 
				$discount 	= ($discount_prosentase / 100) * $subtotal;
			elseif( !empty( $discount_price ) ) :
				$discount 	= $discount_price;
			else :
				$discount 	= 0;
			endif;

    	else :
    		$voucher_id 	= '';
    		$discount 		= 0;
    	endif;

    	$grand_total 		= $total - $discount;
    	$grand_total_usd 	= $this->currencyConverter( 'IDR', 'USD', $grand_total );

    	$payments[]			= [$payment_id, $just_date, $total, $total_usd, $voucher_id, $discount, $grand_total, $grand_total_usd, 0, $datenow, $datenow];

    	$insert_payment = Yii::$app->db
				    		->createCommand()
				    		->batchInsert('payments',['payment_id', 'date', 'total', 'total_usd', 'voucher_id', 'discount', 'grand_total', 'grand_total_usd', 'status', 'created_at', 'updated_at'], $payments)
				    		->execute();

		if ( $insert_payment ) :
			
	    	foreach ($_SESSION['cart'] as $key => $value) {
	    		$detail = array(
	    			'code' 	=> $value['code'],
	    			'name' 	=> $value['name'],
	    			'slug' 	=> $value['slug'],
	    			'image' => $value['image'],
	    			'qty' 	=> $value['qty']
	    		);
	    		$data 				= json_encode($detail);
	    		$payment_detail[] 	= [$payment_id, $value['id'], $data, $value['price'], $datenow, $datenow];
	    	}

	    	Yii::$app->db
	    		->createCommand()
	    		->batchInsert('payment_detail',['payment_id', 'product_id', 'data', 'sell_price', 'created_at', 'updated_at'], $payment_detail)
	    		->execute();

	    endif;

        $p 			= new Paypal();
        $response 	= $p->teszt( $grand_total_usd, $payment_id );

    	$url 		= $response->links[1]->href;

        header('Location: '.$url);
        die();

    }

    public function actionExecute()
    {
    	$each    	= [];
    	$apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AS67obv6-6brdBi1keEpq1oOMxi4WhnFcHx4aItcXG8pc6y2WG5Jk1mJiHYpbZwhYxpEumP0GBKXIS1s',     // ClientID
                'EIyGLVEjSXg2JQSjo72LGHNCGFNGWor6nZjwP2O75VPUx-Q7RVbixoSEgEzNNklLBwLdbqAA7fpg_asU'      // ClientSecret
            )
        );

    	if ( isset($_GET['success']) && $_GET['success'] == 'true' ) :

    		$payment_id = $_SESSION['payment_id'];
    		$paymentId 	= $_GET['paymentId'];
    		$payment 	= Payment::get($paymentId, $apiContext);

    		$execution 	= new PaymentExecution();
			$execution->setPayerId($_GET['PayerID']);

			try 
			{
	        	$result = $payment->execute($execution, $apiContext);
	        	try 
	        	{
            		$payment 			= Payment::get($paymentId, $apiContext);
            		$pi 				= $payment->payer->payer_info;
		            $transactions 		= $payment->getTransactions();
		            $related_resources 	= $transactions[0]->getRelatedResources();
		            $sale 				= $related_resources[0]->getSale();
		            $sale_id 			= $sale->getId();
		            $amount 			= $transactions[0]->amount->total;

		            $each[] 			= [$sale_id, $pi->email, $pi->payer_id, $payment->id, $payment_id, $amount, time()];

		            Yii::$app->db->createCommand()->batchInsert('paypal_detail',['ltransaction_id', 'lpayer_email', 'lpayer_id', 'paypal_payment_id', 'payment_id', 'lamount', 'created_at'], $each)->execute();

		            // header('Location: http://onestopclick.com');
        			// die();

        			return $this->redirect(['/site/success']);
            	}
            	catch (Exception $e)
            	{
            		return $this->redirect(['/site/failed']);
            	}
	        }
	        catch (Exception $e)
	        {
	        	ResultPrinter::printError("Executed Payment", "Payment", null, null, $e);
	        }

    	endif;
    }

    public function getPaymentIDCode()
    {
    	$valid = Payments::find()->one();
    	if ( $valid ) :
	    	$year = date('y', time());
	    	$month = date('m', time());
	    	$date =  date('d', time());

	    	$paymentid = Yii::$app->db->createCommand( 'SELECT max(substring(payment_id, 12, 4)) max 
	    												FROM payments 
	    												WHERE substring(payment_id, 4, 2) = :year
	    												AND substring(payment_id, 6, 2) = :month
	    												AND substring(payment_id, 8, 2) = :day' )
	    					->bindValue(':year', $year)
	    					->bindValue(':month', $month)
	    					->bindValue(':day', $date)
            				->queryScalar();

    	else :
    		$paymentid = '';
    	endif;

    	if ( empty($paymentid) )
    	{ 
    		$code = 1; 
    	}
    	else 
		{ 
			$code = $paymentid + 1; 
		}

		$mixcode = "PAY".date("y",time()).date("m",time()).date("d",time());
		if($code < 10){
			$mixcode=$mixcode."000".$code;
		}elseif($code<100){
			$mixcode=$mixcode."00".$code;
		}elseif($code<1000){
			$mixcode=$mixcode."0".$code;
		}elseif($code<10000){
			$mixcode=$mixcode.$code;
		}

    	return $mixcode;
    }

    function object_to_array($data)
    {
	    if (is_array($data) || is_object($data))
	    {
	        $result = array();
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = $this->object_to_array($value);
	        }
	        return $result;
	    }
	    return $data;
	}

	function currencyConverter($from, $to, $amount){
		$url 	= file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . $from . '_' . $to . '&compact=ultra');
		$json 	= json_decode($url, true);
		$rate 	= implode(" ",$json);
		$total 	= $rate * $amount;
		$rounded = round($total,2); //optional, rounds to a whole number
		return $rounded; //or return $rounded if you kept the rounding bit from above
	}
}