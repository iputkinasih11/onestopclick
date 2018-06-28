<?php

namespace backend\controllers;

use Yii;
use backend\models\Feature;
use backend\models\Roles;
// use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\Url;
use backend\components\BaseController;

/**
 * 
 * FeatureController implements the CRUD actions for Feature model.
 */
class FeatureController extends BaseController
{

    /**
 * [init description]
 * @return [type] [description]
 */
    public function init(){
        $this->view->params['menu'] = 'feature';
        $this->view->params['submenu'] = 'feature';
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Feature models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$data = [];
        $query = Feature::find()->where(['status' => 1]);
        $data['keyword'] = Yii::$app->request->get('keyword');
        if(Yii::$app->request->get('keyword')){
            $query->where(['like','name',Yii::$app->request->get('keyword')]);
        }

        $data['slug'] = Yii::$app->request->get('slug');
        if(Yii::$app->request->get('slug')){
            $query->where(['like','slug',Yii::$app->request->get('slug')]);

        }

        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        $data['pages'] = $pages;
        $data['dataProvider'] = $models;
        $data['parent'] = false;

        return $this->render('index', $data);*/

        $query      = Feature::find()->where(['status' => Feature::STATUS_ACTIVE]);
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
     * Creates a new Feature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $each  = [];
        $model = new Feature();
        $roles = Roles::find()->all();

        $featureid = Yii::$app->db->createCommand( 'SELECT max(id) FROM backend_feature' )->queryScalar();
        $nextfeatureid = $featureid + 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($roles as $key => $role) :
                $each[] = [$role['id'], $nextfeatureid, 0];
            endforeach;

            if ( $each )
            {
                Yii::$app->db->createCommand()->batchInsert('backend_permission',['roles','feature', 'access'], $each)->execute();
            }

            return $this->redirect(['/feature/']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Feature model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/feature/']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Feature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model          = Feature::findOne($id);
        $model->status  = -1;
        $model->save(false);
        

        return $this->redirect(['/feature/']);
    }

    /**
     * Finds the Feature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feature::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
