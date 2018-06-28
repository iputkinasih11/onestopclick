<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\components\CMS;
use yii\helpers\ArrayHelper;

$this->title = 'E-Store';
?>

<div class="container" style="min-height: calc(100vh - 287px);">
	<div class="row">

		<div class="category-tab"><!--category-tab-->
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tshirt" >
					<?php
						$category_list 	= ArrayHelper::map(CMS::getMenu(),'id','name'); 
						$slug_list 		= ArrayHelper::map(CMS::getMenu(),'id','slug'); 
						$picture_list 	= ArrayHelper::map(CMS::getMenu(),'id','picture');
						foreach ($category_list as $key => $value) :
							if ($key < 5) :
					?>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<a class="link-single-product" href=<?php echo Url::to('/category/'.$slug_list[$key]); ?>>
								<div class="single-products">
									<div class="productinfo text-center bg-productinfo" style="background-image: url(<?php echo Url::to('@uploadfile/'.$picture_list[$key]); ?>);">
										<div class="overlay-productinfo"></div>
										<h2><?php echo strtoupper($value) ;?></h2>
									</div>
									
								</div>
							</a>
						</div>
					</div>
					<?php endif; endforeach;?>
				</div>
			</div>
		</div><!--/category-tab-->

		<div class="features_items"><!--features_items-->
			<h2 class="title text-center">Newest Product</h2>
			<?php foreach ($products as $product) :?>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<a class="link-single-product" href=<?php echo Url::to('/product/'.$product->slug);?>>
							<div class="single-products">
								<div class="productinfo text-center">
									<!-- <img src=<?php echo Url::to('@uploadfile/'.$product->picture); ?> alt="" /> -->
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
								<li><a href="<?php echo Url::to('/cart/add/'.$product->id) ;?>"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach; ?>			
		</div><!--features_items-->

	</div>
</div>