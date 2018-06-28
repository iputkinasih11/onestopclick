<?php

use backend\models\BackendUser;

/* @var $this yii\web\View */

$this->title = 'E-Store Administrator';

$userrole   = BackendUser::find()->where(['id' => Yii::$app->user->id])->one();
$role       = $userrole['roles'];

$monday 	= date( 'd M Y', strtotime( 'monday this week' ) );
$sunday 	= date( 'd M Y', strtotime( 'sunday this week' ) );

?>

<section class="content-header">
	<h1>
		Dashboard
	</h1>
</section>

<?php if ( $role == 1 ) : ?>

<section class="content">
	<div class="row">

		<input type="hidden" id="start_day_week" value="<?php echo $monday; ?>">
		<input type="hidden" id="end_day_week" value="<?php echo $sunday; ?>">	

		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Select Period:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" id="period-range">
							</div>
						</div>
					</div>

					<div class="container-chart"></div>

	            </div>
			</div>
		</div>

	</div>
</section>

<?php else :?>

<section class="content">
	<div class="row">
	</div>
</section>

<?php endif;?>

<script>
	function set_chart(start, end){
		var obj 			= new Object();
			obj.action 		= 'set_chart';
			obj.startdate 	= start;
			obj.enddate		= end;

		$.ajax({
			type 		: "post",
			dataType 	: "json",
			url			: "<?php echo \Yii::$app->getUrlManager()->createUrl('site/ajaxchart'); ?>",
			data 		: obj,
			success: function(data) {
				$('.container-chart').html(data.content);
			},
			error: function(){
				console.log("Error");
			}
		});
	}

	function set_first_chart(start, end){
		var obj 			= new Object();
			obj.action 		= 'set_chart';
			obj.startdate 	= start;
			obj.enddate		= end;

		$.ajax({
			type 		: "post",
			dataType 	: "json",
			url			: "<?php echo \Yii::$app->getUrlManager()->createUrl('site/ajaxchart'); ?>",
			data 		: obj,
			success: function(data) {
				$('.container-chart').html(data.content);
			},
			error: function(){
				console.log("Error");
			}
		});
	}
</script>