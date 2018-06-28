<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="form" style="margin-top: 50px;min-height: calc(100vh - 522px);"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6" style="margin: 0 auto;float: none;">
                <div class="login-form"><!--login form-->
                    <h2 style="margin-bottom: 10px;"><?= Html::encode($this->title) ?></h2>
                    <p style="margin-bottom: 30px;">Please choose your new password.</p>
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                        </div>
                        
                    <?php ActiveForm::end(); ?>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section>