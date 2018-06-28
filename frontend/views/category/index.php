<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use frontend\components\CMS;
use yii\helpers\ArrayHelper;

?>

<section>
	<div class="container" style="min-height: calc(100vh - 287px);">
		<div class="row">

			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian">
						<!--category-productsr-->		
						
						<?php $sub = CMS::getSubCategory(); ?>
						<?php foreach(CMS::getMenu() as $cats):?>
							<?php $in = $this->params['category'] == $cats->slug ? 'in' : ''; ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $cats->name;?>">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											<?php echo $cats->name;?>
										</a>
									</h4>
								</div>
								<div id="<?php echo $cats->name;?>" class="panel-collapse collapse <?php echo $in ;?>">
									<div class="panel-body">
										<ul>
											<?php if(isset($sub[$cats->slug])):?>
												<?php foreach($sub[$cats->slug] as $item):?>
													<?php $active = $this->params['subcategory'] == $item->slug ? 'active' : ''; ?>
													<li class="subcategory <?php echo $active ;?>"><a href="<?php echo Url::to('/category/'.$cats->slug.'/'.$item->slug);?>"><?php echo $item->name;?> </a></li>
												<?php endforeach;?>
											<?php endif;?>
										</ul>
									</div>
								</div>
							</div>
						<?php endforeach;?>

					</div>
					<!--/category-productsr-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Features Items</h2>
											
					<?php foreach ($products as $key => $product):?>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<a class="link-single-product" href=<?php echo Url::to('/product/'.$product->slug);?>>
								<div class="single-products">
									<div class="productinfo text-center">
										<!-- <img src=<?php echo Url::to("@web/images/img/dummy.jpg"); ?> alt="" /> -->
										<div class="bg-product-image" style="background-image: url(<?php echo Url::to('@uploadfile/'.$product->picture); ?>);"></div>
										<h2>IDR <?php echo number_format($product->price,0,"",".") ;?></h2>
										<p><?php echo $product->name;?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>IDR <?php echo number_format($product->price,0,"",".") ;?></h2>
											<p><?php echo $product->price;?></p>
										</div>
									</div>
								</div>
							</a>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href="<?php echo Url::to('/cart/add/'.$product->id) ;?>"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
								</ul>
							</div>
						</div>
					</div>
					<?php endforeach;?>
											
				</div>
			</div>

		</div>
	</div>
</section>