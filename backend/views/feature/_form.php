<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Feature;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([Feature::STATUS_ACTIVE => 'Active', Feature::STATUS_INACTIVE => 'Inactive'],['class' => 'form-control select2']) ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/feature/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>