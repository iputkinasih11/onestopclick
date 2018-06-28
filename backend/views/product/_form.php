<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

    <!-- form start -->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <div class="form-group">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?php //= $form->field($model, 'category_id')->dropdownList([ArrayHelper::map(Category::find()->all(),'id','name')],['class' => 'form-control select2']); ?>
                <?= $form->field($model, 'category_id', ['inputOptions' => ['class' => 'selectpicker']])->dropDownList($category_items, ['prompt' => 'Select Category', 'class'=>'form-control select2']); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group" style="position: relative;">
                <?php echo $form->field($model, 'picture')->fileInput(['id' => 'upload-category-picture'])->label('Product Image');?>
                <?= Html::img(
                    ($model->picture) ? Url::to('@uploadfile/'.$model->picture) : 'http://via.placeholder.com/400x400',
                    ['id'=> 'category-picture','style' => 'width:400px;']); 
                ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([Product::STATUS_ACTIVE => 'Active', Product::STATUS_INACTIVE => 'Inactive'],['class' => 'form-control select2']) ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/product/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
