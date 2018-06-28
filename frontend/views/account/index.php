<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

?>

<section>
	<div class="container" style="min-height: calc(100vh - 287px);">
		<div class="row">

			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Detail</h2>
					<div class="panel-group category-products" id="accordian">
						<!--category-productsr-->		
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="tab" href="#profile">
										Profile
									</a>
								</h4>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="tab" href="#purchase-history">
										Purchase History
									</a>
								</h4>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="tab" href="#downloads">
										Downloads
									</a>
								</h4>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title logout-form">
									<?= Html::beginForm(['/site/logout'], 'post') ?>
                                        <?= Html::submitButton(
                                            'LOGOUT',
                                            ['class' => 'btn btn-link logout']
                                        ) ?>
                                    <?= Html::endForm() ?>
								</h4>
							</div>
						</div>

					</div>
					<!--/category-productsr-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Account Detail</h2>

					<div class="container-account">
						<div class="tab-content">
							<div class="panel-collapse collapse active" id="profile">

								<div class="form-group col-md-6">
									<div class="form-group required">
										<label class="control-label" for="profile_username">Username</label>
										<input type="text" id="profile_username" class="form-control" name="profile_username" readonly="" value="<?php echo $fixed->username;?>">
									</div>                    
								</div>
								<div class="form-group col-md-6">
									<div class="form-group required">
										<label class="control-label" for="profile_email">Email</label>
										<input type="text" id="profile_email" class="form-control" name="profile_email" readonly="" value="<?php echo $fixed->email;?>">
									</div>                    
								</div>

								<?php $form = ActiveForm::begin(['action' => '/account']);?>
									
								<div class="form-group col-md-6">
									<?= $form->field($updateprofile, 'firstname')->textInput(['value' => $fixed->firstname]); ?>
								</div>
								<div class="form-group col-md-6">
									<?= $form->field($updateprofile, 'lastname')->textInput(['value' => $fixed->lastname]); ?>
								</div>
								<div class="form-group col-md-6">
									<?= $form->field($updateprofile, 'phone')->textInput(['value' => $fixed->phone]); ?>
								</div>
								<div class="form-group col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
								<?php Activeform::end();?>

								<h2 class="title text-center" style="float: left;width: 100%;">Change Password</h2>

								<?php $form = ActiveForm::begin(['action' => '/account']);?>
								<div class="form-group col-md-12">
									<?= $form->field($updatepassword, 'current_password')->passwordInput(['value' => '']); ?>
								</div>
								<div class="form-group col-md-12">
									<?= $form->field($updatepassword, 'password')->passwordInput(['value' => '']); ?>
								</div>
								<div class="form-group col-md-12">
									<?= $form->field($updatepassword, 'confirm_password')->passwordInput(['value' => '']); ?>
								</div>
								<div class="form-group col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Change Password</button>
									</div>
								</div>
								<?php Activeform::end();?>

							</div>

							<div class="panel-collapse collapse" id="purchase-history">
								<div class="table-responsive cart_info">
									<table class="table table-condensed table-purchase-history">
										<thead>
											<tr class="cart_menu">
												<td class="w10">No</td>
												<td class="w30">Purchase Code</td>
												<td class="w20">Date</td>
												<td class="w20">Total Price</td>
												<td class="w20">Status</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($purchase as $key => $item) : ?>
											<tr>
												<td class="cart_description">
													<h4><?php echo ($key+1);?></h4>
												</td>
												<td class="cart_description">
													<h4 class="action_detail" rel="<?php echo $item['id']; ?>" style="font-weight: 500;"><?php echo $item['payment_id']; ?></h4>
												</td>
												<td class="cart_description">
													<h4><?php echo date('d M Y', strtotime($item['date']));?></h4>
												</td>
												<td class="cart_description cart_total_price">
													<h4>IDR <?php echo number_format($item['grand_total'],0,'','.') ;?></h4>
												</td>
												<td class="cart_description cart_status">
													<h4>
													<?php
														if ($item['status'] == 0) :
															echo "Waiting Verification";
														else :
															echo "Confirmed";
														endif;
													?>
													</h4>
												</td>
											</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="panel-collapse collapse" id="downloads">
								<div class="table-responsive cart_info">
									<table class="table table-condensed table-downloads">
										<thead>
											<tr class="cart_menu">
												<td class="w10">No</td>
												<td class="w20">Product</td>
												<td class="w20">Purchase Code</td>
												<td class="w35">Download Link</td>
												<td class="w15">Status</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="cart_description">
													<h4>1</h4>
												</td>
												<td class="cart_description">
													<h4 style="font-weight: 500;">Incredibles 2</h4>
												</td>
												<td class="cart_description">
													<h4>PAY1806210001</h4>
												</td>
												<td class="cart_description cart_link">
													<h4>DSJHFKJEWLTHGLFghdsaGH</h4>
												</td>
												<td class="cart_description cart_status">
													<h4>Available</h4>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
											
				</div>
			</div>

		</div>
	</div>
</section>

<div class="warp-notification"></div>

<?php
	$script = 
	"$('.action_detail').on('click', function(e) {
		var id = $(this).attr('rel');
		// console.log(id);
		send_ajax(id);
	});";
	$this->registerJs($script);
?>

<script>
	function send_ajax(id){
		var obj 		= new Object();
			obj.action 	= 'get_detail';
			obj.id 		= id;

		$.ajax({
			type 		: "post",
			dataType 	: "json",
			url			: "<?php echo \Yii::$app->getUrlManager()->createUrl('account/ajaxdetail'); ?>",
			data 		: obj,
			success: function(data) {
				$('.warp-notification').html(data.content);
			},
			error: function(){
				console.log("Error");
			}
		});
	}
</script>