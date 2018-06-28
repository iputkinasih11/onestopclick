<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<section id="cart_items">
	<div class="container">

		<div class="review-payment">
			<h2>Review Product</h2>
		</div>

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
					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								<tbody>
									<?php
									$discount 	= 0;
									$total 		= $subtotal;
									?>
									<tr>
										<td>Cart Sub Total</td>
										<td>IDR <?php echo number_format($subtotal,0,'','.');?></td>
									</tr>
									<?php if( !YII::$app->session->get('voucher') ): ?>
										<tr class="shipping-cost">
											<td>Discount</td>
											<td>IDR 0</td>										
										</tr>
									<?php else: ?>
										<?php $voucher = YII::$app->session->get('voucher') ;?>
										<?php
											if ( !empty( $voucher['discount_prosentase'] ) ) : 
												$discount = ($voucher['discount_prosentase'] / 100) * $subtotal;
											elseif( !empty( $voucher['discount_price'] ) ) :
												$discount = $voucher['discount_price'];
											else :
												$discount = 0;
											endif;
											$total = $subtotal - $discount;
										?>
										<tr class="shipping-cost">
											<td>Discount</td>
											<td>IDR <?php echo number_format($discount,0,'','.');?></td>										
										</tr>
									<?php endif;?>
									<tr>
										<td>Total</td>
										<td><span>IDR <?php echo number_format($total,0,'','.');?></span></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="review-payment">
			<h2>Payment Option</h2>
		</div>

		<div class="table-responsive noborder payment">
			<ul>
				<!-- <li>
					<input type="radio" data-order_button_text="Bank Transfer" value="banktransfer" name="payment_method" class="input-radio" id="payment_method_banktransfer">
                    <label for="payment_method_banktransfer">
                    	<img class="image-payment" alt="Bank Transfer" src="<?php //echo Url::to("@web/images/cart/bank.png"); ?>">
                    </label>
				</li> -->
				<li>
					<input type="radio" data-order_button_text="PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal" checked="checked">
                    <label for="payment_method_paypal">
                    	<img class="image-payment" src="<?php echo Url::to("@web/images/cart/paypal.png"); ?>">
                    </label>
				</li>
			</ul>
		</div>

		<div class="table-responsive noborder">
		<form action="<?php echo Url::to('/paypal');?>" method="post">
			<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
			<input type="submit" value="Continue" name="continue_payment" class="btn btn-default check_out">
		</form>
	</div>

	</div>
</section>