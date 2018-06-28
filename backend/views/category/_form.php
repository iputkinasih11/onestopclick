<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set("Asia/Singapore");

?>

<div class="box box-primary">

    <!-- form start -->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([Category::STATUS_ACTIVE => 'Active', Category::STATUS_INACTIVE => 'Inactive'],['class' => 'form-control select2']) ?>
            </div>
            <div class="form-group" style="position: relative;">
                <?php echo $form->field($model, 'picture')->fileInput(['id' => 'upload-category-picture'])->label('Product Image');?>
                <?= Html::img(
                    ($model->picture) ? Url::to('@uploadfile/'.$model->picture) : 'http://via.placeholder.com/400x400',
                    ['id'=> 'category-picture','style' => 'width:400px;']); 
                ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/category/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary create-category']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>