<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\Category;
use common\models\Subcategory;
use backend\models\BackendUser;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\Url;
use backend\components\BaseController;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{
    public function init(){
        $this->view->params['menu'] = 'product';
        $this->view->params['submenu'] = 'product';
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        // print_r(Yii::$app->controller->id); 
        $userrole   = BackendUser::find()->where(['id' => Yii::$app->user->id])->one();
        $role       = $userrole['roles'];
        if ( $role == 1 ) :
            $query      = Product::find()->where(['status' => 1]);
        else :
            $query      = Product::find()->where(['status' => 1, 'created_by' => Yii::$app->user->id]);
        endif;

        // $query      = Product::find()->where(['status' => 1, 'created_by' => Yii::$app->user->id]);
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
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model  = new Product();
        $path   = dirname(dirname(dirname(__FILE__).DIRECTORY_SEPARATOR)).'/uploads/';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->created_by  = Yii::$app->user->id;
            $model->picture     = UploadedFile::getInstance($model, 'picture');
            if ($model->validate()) {
                // file is uploaded successfully
                $model->picture->saveAs($path . $model->slug . '-' . time() . '.' . $model->picture->extension);
                $model->picture = 'uploads/' . $model->slug . '-' . time(). '.' . $model->picture->extension;
                $model->save(false);
                return $this->redirect('/product/');
            }
        }

        $options = [];
        $parents = Category::find()->where(['status' => 1])->all();
        foreach($parents as $id => $p) {
            $children = Subcategory::find()->where(["category_id" => $p->id,'status' => 1])->all();
            $child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options[$p->name] = $child_options;
        }

        return $this->render('create', [
            'model' => $model,
            'category_items' => $options,
        ]);
    }

    /**
     * Updates an existing Product model.
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
            $model->created_by  = Yii::$app->user->id;
            $model->picture     = UploadedFile::getInstance($model, 'picture');

            if ($model->validate()) {
                // file is uploaded successfully
                $model->picture->saveAs($path . $model->slug . '-' . time() . '.' . $model->picture->extension);
                $model->picture = 'uploads/' . $model->slug . '-' . time(). '.' . $model->picture->extension;
                $model->save(false);
                return $this->redirect('/product/');
            }
        }

        $options = [];
        $parents = Category::find()->where(['status' => 1])->all();
        foreach($parents as $id => $p) {
            $children = Subcategory::find()->where(["category_id" => $p->id,'status' => 1])->all();
            $child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options[$p->name] = $child_options;
        }

        return $this->render('update', [
            'model' => $model,
            'category_items' => $options,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);

        $model              = Product::findOne($id);
        $model->status      = -1;
        $model->updated_at  = date('Y-m-d H:i:s');
        $model->save(false);

        return $this->redirect('/product/');
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
