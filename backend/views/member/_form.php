<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Roles;

/* @var $this yii\web\View */
/* @var $model backend\models\activerecord\BackendUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <div class="form-group">
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/member/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
