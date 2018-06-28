<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Payments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
        <?php foreach ($dataProvider as $item) :?>
        <div class="box-body">
            <div class="form-group">
                <?= $form->field($model, 'payment_id')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <label class="control-label" for="voucher-start_date">Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker-date" name="Payments[date]" value="<?php echo date('Y-m-d', strtotime($item['date']));?>">
                </div>
                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'total_usd')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'voucher_id')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'grand_total')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'grand_total_usd')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([0 => 'Waiting Verification', 1 => 'Confirmed'],['class' => 'form-control select2']) ?>
            </div>
        </div>
        <?php endforeach;?>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="form-group">
                <?= Html::a('Back',Url::to('/payments/'), ['class' => 'btn btn-primary']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
