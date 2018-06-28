<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image w10">Item</td>
						<td class="description w35"></td>
						<td class="price w20">Price</td>
						<td class="quantity w10">Quantity</td>
						<td class="total w20">Sub Total</td>
						<td class="w5"></td>
					</tr>
				</thead>
				<tbody>
					<?php
					$subtotal = 0; 
					if ($cart) :
						foreach ($cart as $key => $item) :
					?>
							<tr>
								<td class="cart_product w10">
									<a href=""><img src="<?php echo Url::to('@uploadfile/'.$item['image']); ?>" alt="" style="width: 80px;"></a>
								</td>
								<td class="cart_description w35">
									<h4><a href="<?php echo Url::to('/product/'.$item['slug']);?>"><?php echo $item['name'];?></a></h4>
									<p>Code: <?php echo $item['code'];?></p>
								</td>
								<td class="cart_price w20">
									<p>IDR <?php echo number_format($item['price'],0,'','.');?></p>
								</td>
								<td class="cart_quantity w10">
									<div class="cart_quantity_button">
										<!-- <a class="cart_quantity_up" href=""> + </a> -->
										<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo number_format($item['qty']);?>" autocomplete="off" size="2">
										<!-- s<a class="cart_quantity_down" href=""> - </a> -->
									</div>
								</td>
								<td class="cart_total w20">
									<p class="cart_total_price">IDR <?php echo number_format($item['price'] * $item['qty'],0,'','.');?></p>
								</td>
								<td class="cart_delete w5" style="width: auto;">
									<a class="cart_quantity_delete" href="<?php echo Url::to('/cart/delete/'.$key);?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>
					<?php 
							$subtotal += $item['price'] * $item['qty'];
						endforeach; 
					endif;
					?>
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="row">
			<div class="col-sm-6" style="float: right;">
				<div class="total_area">
					<ul>
						<?php
						$discount 	= 0;
						$total = $subtotal;
						?>
						<li>Cart Sub Total <span>IDR <?php echo number_format($subtotal,0,'','.');?></span></li>

						<?php if( !YII::$app->session->get('voucher') ): ?>

							<li class="voucher-li">Voucher 
								<span>
									<form method="post" action="<?php echo Url::to('/cart/voucher');?>">
										<input type="text" placeholder="code" value="" id="coupon_code" class="input-text" name="voucher">
										<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
										<input type="submit" value="Apply" name="apply_coupon" class="button">
									</form>
								</span>
							</li>

						<?php else: ?>
							<?php $voucher = YII::$app->session->get('voucher') ;?>
							<li>Voucher 
								<a class="voucher-delete" href="<?php echo Url::to(['/cart/vouchercancel']);?>">
									<span>
										<i class="fa fa-times"></i>
									</span>
								</a>
								<span><?php echo $voucher['code'];?></span>
							</li>
							<?php
							//print_r($voucher);
							if ( !empty( $voucher['discount_prosentase'] ) ) : 
								$discount = ($voucher['discount_prosentase'] / 100) * $subtotal;
							elseif( !empty( $voucher['discount_price'] ) ) :
								$discount = $voucher['discount_price'];
							else :
								$discount = 0;
							endif;

							$total = $subtotal - $discount;
							?>
							<li>Discount <span>IDR <?php echo number_format($discount,0,'','.');?></span></li>

						<?php endif;?>

						<li>Total <span>IDR <?php echo number_format($total,0,'','.');?></span></li>
					</ul>
						<!-- <a class="btn btn-default check_out" href="">Check Out</a> -->
						<form action="<?php echo Url::to('/checkout');?>" method="post">
							<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
							<input type="submit" value="Checkout" name="apply_coupon" class="btn btn-default check_out">
						</form>
				</div>
			</div>
		</div>
	</div>
</section>