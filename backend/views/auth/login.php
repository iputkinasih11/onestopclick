<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="login" class="login clearfix">
    <div class="wrapper clearfix">
        <div class="center clearfix">
            <div class="container-form">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Please fill out the following fields to login:</p>

                <div class="row">
                    <div class="form">
                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => ['/auth/']]); ?>

                            <?= $form->field($model, 'email')->textInput() ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?php //= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="checkbox" style="display:none;">
                                <label>
                                    <input type="checkbox" name="remember" value="1"> Remember Me
                                </label>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
