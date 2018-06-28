<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

						<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
						<?= $form->field($model, 'password')->passwordInput() ?>
						<?= $form->field($model, 'rememberMe')->checkbox() ?>

						<div style="color:#999;margin:1em 0">
							If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
						</div>

						<div class="form-group">
							<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
						</div>
						
					<?php ActiveForm::end(); ?>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
					
					<?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => Url::to('/site/signup')]); ?>

						<?= $form->field($modelsignup, 'username')->textInput(['autofocus' => true]) ?>
						<?= $form->field($modelsignup, 'password')->passwordInput() ?>
						<?= $form->field($modelsignup, 'email') ?>

						<div class="form-group">
							<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
						</div>

					<?php ActiveForm::end(); ?>

                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->