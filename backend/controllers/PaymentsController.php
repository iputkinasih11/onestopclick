<?php

namespace backend\controllers;

use Yii;
use common\models\Payments;
use common\models\PaymentDetail;
use backend\models\PaymentsSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
use yii\helpers\Url;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends BaseController
{
    public function init(){
        $this->view->params['menu'] = 'payments';
        $this->view->params['submenu'] = 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $query      = Payments::find()
                        ->from('payments');
        $countQuery = clone $query;
        $pages      = new Pagination(['totalCount' => $countQuery->count()]);
        $models     = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();

        return $this->render('index', [
            'pages' => $pages,
            'dataProvider' => $models,
        ]);
    }

    /**
     * Displays a single Payments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model      = $this->findModel($id);
        $query      = Payments::find()
                        ->where(['id' => $id]);
        $models     = $query->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/payments/');
        }

        return $this->render('update', [
            'model' => $model,
            'dataProvider' => $models,
        ]);
    }

    /**
     * Deletes an existing Payments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);

        $model              = Payments::findOne($id);
        $model->status      = -1;
        $model->updated_at  = date('Y-m-d H:i:s');
        $model->save(false);

        return $this->redirect('/payments');
    }

    /**
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAjaxdetail()
    {
        $post   = Yii::$app->request->post();
        $id     = $post['id'];

        $items  = Payments::find()->where(['id' => $id])->all();
        foreach ($items as $item) :
            $payment_id = $item->payment_id;
            $discount   = $item->discount;
        endforeach;

        $datas  = PaymentDetail::find()->where(['payment_id' => $payment_id])->all();
        $total  = 0;
        
        $html   = '';
        $html   = '
        <section class="popup-detail">
            <div class="wrapper-detail">
                <div class="center-detail container">
                    <div class="close" onclick="close_popup_detail()">
                        <img class="image" src="'.Url::to("@web/images/img/cancel.svg").'">
                    </div>
                    <div class="content-detail">
                        <table class="table-detail">
                            <thead class="header">
                                <tr>
                                    <th class="w15">Item</th>
                                    <th class="w35">Description</th>
                                    <th class="w20">Price</th>
                                    <th class="w10">Quantity</th>
                                    <th class="w20">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ( $datas as $key => $data) :

            $detail = $this->object_to_array(json_decode($data['data']));

            $html   .= '
                                <tr>
                                    <td class="w15">
                                        <a href="#">
                                            <img class="image" src="'.Url::to('@uploadfile/'.$detail['image'].'').'">
                                        </a>
                                    </td>
                                    <td class="w35">
                                        <p class="title">'.$detail['name'].'</p>
                                        <p class="code">Code: '.$detail['code'].'</p>
                                    </td>
                                    <td class="w20">
                                        <p class="price">IDR '.number_format($data['sell_price'],0,'','.').'</p>
                                    </td>
                                    <td class="w10">
                                        <p class="qty">1</p>
                                    </td>
                                    <td class="w20">
                                        <p class="sub">IDR '.number_format($data['sell_price'],0,'','.').'</p>
                                    </td>
                                </tr>';

            $total = $total + $data['sell_price'];

        endforeach;

        $grand_total = $total - $discount;

        $html   .= '
                                <tr class="noborder">
                                    <td colspan="4" class="label-cart" style="padding-top: 30px;">Cart Sub Total</td>
                                    <td class="w20 data-cart" style="padding-top: 30px;">IDR '.number_format($total,0,'','.').'</td>
                                </tr>
                                <tr class="noborder">
                                    <td colspan="4" class="label-cart">Discount</td>
                                    <td class="w20 data-cart">IDR '.number_format($discount,0,'','.').'</td>
                                </tr>
                                <tr class="noborder">
                                    <td colspan="4" class="label-cart"><strong>Total</strong></td>
                                    <td class="w20 data-cart"><span>IDR '.number_format($grand_total,0,'','.').'</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>';

        // echo $html; die();
        
        $return['body'] = $html;
        echo json_encode($return);
    }

    public function object_to_array($data){
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
}
