<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
// use backend\models\Category;
use backend\models\CategorySearch;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use backend\components\BaseController;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController
{
    public function init(){
        $this->view->params['menu'] = 'category';
        $this->view->params['submenu'] = 'category';
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new CategorySearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

        $query      = Category::find()->where(['status' => 1]);
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
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model  = new Category();
        $path   = dirname(dirname(dirname(__FILE__).DIRECTORY_SEPARATOR)).'/uploads/';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->picture = UploadedFile::getInstance($model, 'picture');

            if ($model->validate()) {
                // file is uploaded successfully
                $model->picture->saveAs($path . $model->slug . '-' . time() . '.' . $model->picture->extension);
                $model->picture = 'uploads/' . $model->slug . '-' . time(). '.' . $model->picture->extension;
                $model->save(false);
                return $this->redirect('/category/');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model  = $this->findModel($id);
        $path   = dirname(dirname(dirname(__FILE__).DIRECTORY_SEPARATOR)).'/uploads/';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->picture = UploadedFile::getInstance($model, 'picture');

            if ($model->validate()) {
                // file is uploaded successfully
                $model->picture->saveAs($path . $model->slug . '-' . time() . '.' . $model->picture->extension);
                $model->picture = 'uploads/' . $model->slug . '-' . time(). '.' . $model->picture->extension;
                $model->save(false);
                return $this->redirect('/category/');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);
        $model              = Category::findOne($id);
        $model->status      = -1;
        $model->updated_at  = date('Y-m-d H:i:s');
        $model->save(false);
        
        return $this->redirect('/category/');
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
