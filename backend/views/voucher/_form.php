<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Voucher;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Voucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
        <?php 
            if ( empty( $dataProvider ) ) :
        ?>
        <div class="box-body">
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
                <?= $form->field($model, 'discount_prosentase')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'discount_price')->textInput() ?>
            </div>
            <div class="form-group">
                <label class="control-label" for="voucher-start_date">Start Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker-date" name="Voucher[start_date]" value="">
                </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="voucher-end_date">End Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker-date" name="Voucher[end_date]" value="">
                </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([Voucher::STATUS_ACTIVE => 'Active', Voucher::STATUS_INACTIVE => 'Inactive'],['class' => 'form-control select2']) ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/voucher/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php
            else :
            foreach ($dataProvider as $item) :
        ?>
        <div class="box-body">
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
                <?= $form->field($model, 'discount_prosentase')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'discount_price')->textInput() ?>
            </div>
            <div class="form-group">
                <label class="control-label" for="voucher-start_date">Start Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker-date" name="Voucher[start_date]" value="<?php echo date('d M Y', strtotime($item->start_date));?>">
                </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="voucher-end_date">End Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker-date" name="Voucher[end_date]" value="<?php echo date('d M Y', strtotime($item->end_date));?>">
                </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([Voucher::STATUS_ACTIVE => 'Active', Voucher::STATUS_INACTIVE => 'Inactive'],['class' => 'form-control select2']) ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/voucher/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php
        endforeach;
        endif;
    ?>
    <?php ActiveForm::end(); ?>
</div>
