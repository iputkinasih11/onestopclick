<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Roles;
use backend\models\Feature;
use backend\models\Permission;

/* @var $this yii\web\View */
/* @var $model backend\models\activerecord\Roles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary" style="float: left;width: 100%;">

    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-4">
        <div class="box-body">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'description')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'status')->dropdownList([Roles::STATUS_ACTIVE => 'Active', Roles::STATUS_INACTIVE => 'Inactive'],['class' => 'form-control select2']) ?>
            </div>
        </div>
        <!-- /.box-body -->    
    </div>

    <div class="col-sm-8">
		<div class="box" style="margin-top: 10px;border-top: 1px solid #f4f4f4;">

			<div class="box-header">
				<h3 class="box-title">Role Permission</h3>
			</div>
			<!-- /.box-header -->

			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tbody>
						<tr>
							<th>Features</th>
							<th>No Access</th>
							<th>Read-only</th>
							<th>Restrict Delete</th>
							<th>Full Access</th>
						</tr>

						<?php foreach(Feature::find()->where(['status' => Feature::STATUS_ACTIVE])->all() as $feature): ?>
							<?php $active = Permission::find()->where(['roles' => $roles, 'feature' => $feature->id])->one(); ?>

						<tr>
							<td><?php echo $feature->name;?></td>
							<td>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="feature[<?php echo $feature->id;?>]" value="0" <?php echo ($active && $active->access == 0)?'checked="checked"':'';?> class="flat-red">
									</label>
								</div>
							</td>
							<td>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="feature[<?php echo $feature->id;?>]" value="1" <?php echo ($active && $active->access ==1)?'checked="checked"':'';?>  class="flat-red">
									</label>
								</div>
							</td>
							<td>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="feature[<?php echo $feature->id;?>]" value="3"  <?php echo ($active && $active->access == 3)?'checked="checked"':'';?> class="flat-red">
										
									</label>
								</div>
							</td>
							<td>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="feature[<?php echo $feature->id;?>]" value="2"  <?php echo ($active && $active->access == 2)?'checked="checked"':'';?> class="flat-red">
										
									</label>
								</div>
							</td>
						</tr>

						<?php endforeach;?>

					</tbody>
				</table>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
	            <div class="form-group">
	                <?= Html::a('Back',Url::to('/roles/'), ['class' => 'btn btn-primary']);?>
	                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
	            </div>
	        </div>

		</div>
    </div>

    <?php ActiveForm::end(); ?>
</div>


