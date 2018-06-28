<?php

namespace backend\controllers;

use Yii;
// use backend\models\Voucher;
use common\models\Voucher;
use backend\models\VoucherSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use backend\components\BaseController;

/**
 * VoucherController implements the CRUD actions for Voucher model.
 */
class VoucherController extends BaseController
{
    public function init(){
        $this->view->params['menu'] = 'voucher';
        $this->view->params['submenu'] = 'voucher';
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
     * Lists all Voucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new VoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $query      = Voucher::find()->where(['status' => 1]);
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
     * Displays a single Voucher model.
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
     * Creates a new Voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Voucher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ( empty( $model->discount_prosentase )  ) {
                $model->discount_prosentase = 0;
            }
            if ( empty( $model->discount_price )  ) {
                $model->discount_price = 0;
            }
            $model->save(false);
            return $this->redirect('/voucher/');
        }

        return $this->render('create', [
            'model' => $model,
            'dataProvider' => array(),
        ]);
    }

    /**
     * Updates an existing Voucher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model  = $this->findModel($id);
        $post   = Yii::$app->request->post();

        $query      = Voucher::find()->where(['status' => 1, 'id' => $id]);
        $countQuery = clone $query;
        $pages      = new Pagination(['totalCount' => $countQuery->count()]);
        $models     = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();

        // print_r($model->discount_price);
        // die();

        if ($model->load($post) && $model->save()) {
            if ( empty( $model->discount_prosentase )  ) {
                $model->discount_prosentase = 0;
            }
            if ( empty( $model->discount_price )  ) {
                $model->discount_price = 0;
            }
            $model->save(false);
            return $this->redirect('/voucher/');
        }

        return $this->render('update', [
            'model' => $model,
            'pages' => $pages,
            'dataProvider' => $models,
        ]);
    }

    /**
     * Deletes an existing Voucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);

        $model              = Voucher::findOne($id);
        $model->status      = -1;
        $model->updated_at  = date('Y-m-d H:i:s');
        $model->save(false);

        return $this->redirect('/voucher');
    }

    /**
     * Finds the Voucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Voucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Voucher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
