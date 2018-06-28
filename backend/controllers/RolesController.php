<?php

namespace backend\controllers;

use Yii;
use backend\models\Roles;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
// use yii\web\Controller;
use backend\components\BaseController;
use yii\filters\VerbFilter;
use backend\models\Permission;
use backend\models\LoginForm;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RolesController extends BaseController
{

       /**
 * [init description]
 * @return [type] [description]
 */
       public function init(){
        $this->view->params['menu'] = 'roles';
        $this->view->params['submenu'] = 'roles';
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
     * Lists all Roles models.
     * @return mixed
     */
    public function actionIndex()
    {

       $query       = Roles::find()->where(['status' => 1]);
       $countQuery  = clone $query;
       $pages       = new Pagination(['totalCount' => $countQuery->count()]);
       $models      = $query->offset($pages->offset)
                       ->limit($pages->limit)
                       ->all();

        return $this->render('index', 
            [
                'pages'         => $pages,
                'dataProvider'  => $models,
            ]
        );
   }

    /**
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Roles();
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {

            $data    = Yii::$app->request->post();
            $each    = [];
            $roles   = $model->id;
            foreach($data['feature'] as $feature => $item)
            {
                $model = Permission::find()->where(['roles' => $roles, 'feature' => $feature])->one();
                if ( $model )
                {
                    $model->access = $item;
                    $model->save(false);
                }
                else
                {
                    $each[] = [$roles, $feature, $item];
                }
            }

            if ( $each )
            {
                Yii::$app->db->createCommand()->batchInsert('backend_permission',['roles','feature', 'access'], $each)->execute();
            }

            return $this->redirect(['/roles/']);
        }   

        return $this->render('create', 
            [
                'model' => $model,
            ]
        );

        /*$model = new Roles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect('/roles/');
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model      = $this->findModel($id);

        // print_r(Yii::$app->request->post());
        // die();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {

            $data    = Yii::$app->request->post();
            $each    = [];
            $roles   = $model->id;
            foreach($data['feature'] as $feature => $item)
            {
                $model = Permission::find()->where(['roles' => $roles, 'feature' => $feature])->one();
                if ( $model )
                {
                    $model->access = $item;
                    $model->save(false);
                }
                else
                {
                    $each[] = [$roles, $feature, $item];
                }
            }

            if ( $each )
            {
                Yii::$app->db->createCommand()->batchInsert('backend_permission',['roles','feature', 'access'], $each)->execute();
            }

            return $this->redirect(['/roles/']);
        }   

        $permission = $model->id;

        return $this->render('update', 
            [
                'model' => $model,
                'roles' => $permission,
            ]
        );

        // if ( $model->load(Yii::$app->request->post()) && $model->save() ) 
        // {

        //     $data    = Yii::$app->request->post();
        //     $each    = [];
        //     $roles   = $model->id;
        //     foreach ( $data['feature'] as $feature => $item )
        //     {
        //         $model  = Permission::find()->where(['roles' => $roles, 'feature' => $feature])->one();
        //         if ( $model )
        //         {
        //             $model->access = $item;
        //             $model->save(false);
        //         }
        //         else
        //         {
        //             $each[] = [$roles, $feature, $item];
        //         }
        //     }

        //     if ( $each )
        //     {
        //         Yii::$app->db->createCommand()->batchInsert('backend_permission',['roles','feature', 'access'], $each)->execute();
        //     }

            // if ( $id == YII::$app->user->identity->roles )
            // {

                // $permission = Permission::find()
                //                 ->select(['backend_feature'.'.name','backend_feature'.'.slug', 'backend_permission'.'.access'])
                //                 ->where(['roles' => YII::$app->user->identity->roles,'backend_feature.status' => 1])
                //                 ->orderBy('backend_feature.name', SORT_ASC)
                //                 ->asArray()
                //                 ->all();

                // $menu = $group = $list = [];

                // foreach ( $permission as $item )
                // {
                //     if ( !isset($group[strtolower($item['feature_group'])]) )
                //     {
                //         $group[strtolower($item['feature_group'])] = ['name' => $item['feature_group'],'icon' => $item['feature_group_icon'],'slug' => $item['feature_group_slug']];
                //     }

                //     $menu[strtolower($item['feature_group'])][] = ['name' => $item['name'], 'slug' => $item['slug'],'icon' => $item['icon'],'access' => $item['access']];
                //     $list[$item['slug']] = ['name' => $item['name'], 'slug' => $item['slug'],'icon' => $item['icon'],'access' => $item['access']];
                // }

                // $result     = ['group' => $group,'menu' => $menu, 'list' => $list];

                // $session    = Yii::$app->session;
                // $session->set('menu', $result);
            // }

            // return $this->render('update', [
            //     'model' => $model,
            //     'roles' => $id
            // ]);
        // }
    }

    /**
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = Roles::findOne($id);
        $model->status = -9;
        $model->save(false);

        return $this->redirect(['/roles/']);
    }

    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Roles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
