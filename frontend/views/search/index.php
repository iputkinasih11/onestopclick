<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use frontend\components\CMS;
use yii\helpers\ArrayHelper;

?>

<div class="container" style="min-height: calc(100vh - 287px);">
	<div class="row">
		<div class="features_items"><!--features_items-->
			<h2 class="title text-center">SEARCH RESULT(S)</h2>
			<?php if (count($products) > 0) :?>
				<?php foreach ($products as $product) :?>
				
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<a class="link-single-product" href=<?php echo Url::to('/product/'.$product->slug);?>>
								<div class="single-products">
									<div class="productinfo text-center">
										<!-- <img src=<?php echo Url::to("@web/images/img/dummy.jpg"); ?> alt="" /> -->
										<div class="bg-product-image" style="background-image: url(<?php echo Url::to('@uploadfile/'.$product->picture); ?>);"></div>
										<h2>IDR <?php echo number_format($product->price,0,'','.');?></h2>
										<p><?php echo $product->name;?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>IDR <?php echo number_format($product->price,0,'','.');?></h2>
											<p><?php echo $product->name;?></p>
										</div>
									</div>
								</div>
							</a>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href=""><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
								</ul>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else :?>
				<h2 class="text-center" style="font-family: 'Roboto', sans-serif;font-size: 18px;margin: 0 15px;margin-bottom: 30px;position: relative;">Your search did not yield any results.</h2>
			<?php endif ;?>			
		</div><!--features_items-->
	</div>
</div>