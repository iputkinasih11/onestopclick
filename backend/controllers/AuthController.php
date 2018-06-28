<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\request;
use yii\filters\AccessControl;
use yii\helpers\Url;
use backend\models\LoginForm;

class AuthController extends Controller
{

	public function init(){
		if (!Yii::$app->user->isGuest) {
			return $this->redirect('/dashboard');
		}
	}
	/**
	 * [behaviors description]
	 * @return [type] [description]
	 */
	public function behaviors()
	{
		$this->layout = 'login';
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['login', 'logout', 'signup'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['login', 'signup'],
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'actions' => ['logout'],
						'roles' => ['@'],
					],
				]
			],
		];
	}



	public function action(){
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	
	public function actionError()
	{
		$exception = Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			return $this->render('error', ['exception' => $exception]);
		}
	}



	/**
	 * [actionIndex description]
	 * @return [type] [description]
	 */
	public function actionIndex()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->redirect('/dashboard');
		}

		$model = new LoginForm();	
		if(Yii::$app->request->post()){
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				$this->redirect('/dashboard');
			} 
		}

		return $this->render('login', ['model' => $model]);
	}


	/**
	 * [actionForget description]
	 * @return [type] [description]
	 */
	public function actionForget(){

		$error = false;
		$model = new ForgetForm();

		if(Yii::$app->request->post()){
			if($model->load(Yii::$app->request->post()) && !$model->checkuser()){
				$error = 'Email not found.';
			}else{
				if ($result = $model->request()) {
					$this->redirect(['/auth/forgetlanding', 'key' => $result]);
				}else{
					$result = $model->checkactiverequest();
					$error = "We already send you one email, please check your email inbox (mightbe on spam folders). or click <a href='".URL::to(['/auth/resend/', 'key' => $result->encryption_key])."'>here</a> get another email";
				}
			}
		}
		
		return $this->render('/auth/forget',['model' => $model,'error' => $error]);
	}

	/**
	 * [actionForgetlanding description]
	 * @return [type] [description]
	 */
	public function actionForgetlanding()
	{	
		return $this->render('forgetlanding', ['key' => Yii::$app->request->get('key')]);
	}


	/**
	 * [actionResend description]
	 * @return [type] [description]
	 */
	public function actionResend()
	{
		$model = new ForgetForm();
		
		$key = $model->resend(Yii::$app->request->get('key'));
		if(!$key){
			return $this->redirect(['/auth/forget']);		
		}
		$this->redirect(['/auth/forgetlanding', 'key' => $key]);		
	}

	/**
	 * [actionSignup description]
	 * @return [type] [description]
	 */
	public function actionSignup(){

		$model = new RegisterForm();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->redirect('/auth');
		} else {
			$model->password = '';
			return $this->render('register', ['model' => $model]);
		}
	}

	/**
	 * [actionRegister description]
	 * @return [type] [description]
	 */
	public function actionRegister(){
		$model = new RegisterForm();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->redirect('/auth');
		} 

		return $this->redirect('/auth/signup');
	}

	/**
	 * [actionReset description]
	 * @param  [type] $access_token [description]
	 * @return [type]               [description]
	 */
	public function actionReset(){
		
		$forget_password = new Forgetpassword();
		
		// var_dump(YII::$app->request->get('code'));
		$result = $forget_password::findOne(['code' => Yii::$app->request->get('code'),'status' => Forgetpassword::STATUS_AVAILABLE]);
		if(!$result){
			$this->redirect('/auth/');
		}

		$model = new ResetPasswordForm();
		if($model->load(Yii::$app->request->post()) && $user = $model->updatepassword($result->user))
		{	
			$result->status = Forgetpassword::STATUS_USED;
			$result->save();
			$this->redirect('/auth');
		}
		
		return $this->render('reset_form', ['model' => $model,'code' =>  Yii::$app->request->get('code')]);
	}

	/**
	 * [actionLogout description]
	 * @return [type] [description]
	 */
	public function actionLogout(){

		$session = Yii::$app->session->destroy();
		Yii::$app->user->logout();
		$this->redirect('/auth');
	}
}
