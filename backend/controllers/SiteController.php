<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use common\models\LoginForm;
use common\models\AdminLoginForm;
use common\models\Payments;
use backend\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    /*public function actionLogin()
    {
        $this->layout = 'login.php';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/site/index');
        }

        //$model = new AdminLoginForm();
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/site/index');
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Logout action.
     *
     * @return string
     */
    /*public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }*/

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionAjaxchart()
    {
        $post       = Yii::$app->request->post();
        $startdate  = strtotime($post['startdate']);
        $enddate    = strtotime($post['enddate']);
        $the24      = 86400;
        $html       = '';
        $categories = array();
        $data       = array();

        $startq     = date('Y-m-d H:i:s', $startdate);
        $endq       = date('Y-m-d H:i:s', $enddate);

        for ( $i = $startdate; $i <= $enddate; $i = $i + $the24 ) :
            $datepay    = date('Y-m-d H:i:s', $i);
            $grand_total= 0;
            $payments   = Payments::find()
                            ->andwhere(['date' => $datepay])
                            ->andwhere(['status' => 1])
                            ->all();
            foreach ($payments as $key => $payment):
                $grand_total = $grand_total + $payment['grand_total'];
            endforeach;

            $categories[] .= date('d M Y', $i);
            $data[] .= $grand_total;
        endfor;

        $textcategories = '[';
        $countc = count($categories);
        foreach ($categories as $key => $value) :
            if (($key+1) < $countc) :
                $coma = ',';
            else :
                $coma = '';
            endif;
            $textcategories .= "'".$value."'".$coma;
        endforeach;
        $textcategories .= ']';

        $textdata = '[';
        $countd = count($data);
        foreach ($data as $key => $value) :
            if (($key+1) < $countd) :
                $coma = ',';
            else :
                $coma = '';
            endif;
            $textdata .= $value.$coma;
        endforeach;
        $textdata .= ']';

        $html       .= '
        <div id="container-chart"></div>
        <script>
            Highcharts.chart(\'container-chart\', {
                chart: {
                    type: \'line\'
                },
                title: {
                    text: \'Payment Statistic Chart\'
                },
                subtitle: {
                    text: \'Periode: '.date('d M Y', $startdate).' - '.date('d M Y', $enddate).'\'
                },
                xAxis: {
                    categories: '.$textcategories.'
                },
                yAxis: {
                    title: {
                        text: \'Total (IDR)\'
                    },
                    min: 0,
                    max: 500000,
                    tickInterval: 50000
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                    }
                },
                series: [{
                    name: \'Sales Growth\',
                    data: '.$textdata.'
                }]
            });
        </script>
        ';

        // echo $html; die();

        $return['content'] = $html;
        echo json_encode($return);


        // print_r($post);
        // die();
    }
}
