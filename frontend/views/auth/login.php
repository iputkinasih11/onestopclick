<?php 
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <?php $form = ActiveForm::begin(['action' => ['/auth/']]); ?>

                        <?= $form->field($model, 'email')->textInput() ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div style="color:#999;margin:1em 0">
                            If you forgot your password you can <?= Html::a('reset it', ['/auth/forget']) ?>.
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
                    
                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => Url::to('/auth/register')]); ?>

                        <?= $form->field($modelsignup, 'name')->textInput() ?>
                        <?= $form->field($modelsignup, 'email') ?>
                        <?= $form->field($modelsignup, 'password')->passwordInput() ?>
                        <?= $form->field($modelsignup, 'repeat_password')->passwordInput() ?>
                        <?= $form->field($modelsignup, 'address') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->