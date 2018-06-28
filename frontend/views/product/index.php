<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use frontend\components\CMS;
use yii\helpers\ArrayHelper;

?>

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

			<div class="product-details"><!--product-details-->
				<div class="col-sm-5">
					<div class="view-product">
						<img src=<?php echo Url::to('@uploadfile/'.$product->picture); ?> alt="" />
					</div>
				</div>
				<div class="col-sm-7">
					<div class="product-information"><!--/product-information-->
						<h2><?php echo $product->name;?></h2>
						<p><b>Code:</b> <?php echo $product->code;?></p>
						<p><?php echo $product->description;?></p>
						<span>
							<span>IDR <?php echo number_format($product->price,0,'','.');?></span>
							<label>Quantity:</label>
							<input type="text" value="1" />
						</span>
						<p><b>Availability:</b> In Stock</p>
						<a href=<?php echo Url::to('/cart/add/'.$product->id) ;?> class="btn btn-fefault cart">
							<i class="fa fa-shopping-cart"></i>
							Add to cart
						</a>
					</div><!--/product-information-->
				</div>
			</div><!--/product-details-->

			<div class="category-tab shop-details-tab"><!--category-tab-->
				<div class="col-sm-12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
						<?php 
							if ($this->params['menu'] == 'movie') {
								echo "<li class=\"\"><a href=\"#movie\" data-toggle=\"tab\">Movie Trailer</a></li>";
							}

							if ($this->params['menu'] == 'music') {
								echo "<li class=\"\"><a href=\"#music\" data-toggle=\"tab\">Music Player</a></li>";
							}
						?>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="reviews">
						<div class="col-sm-12">
							<p><b>Write Your Review</b></p>
							
							<form action="#">
								<span>
									<input type="text" placeholder="Your Name">
									<input type="email" placeholder="Email Address">
								</span>
								<textarea name=""></textarea>
								<b>Rating: </b> <img src=<?php echo Url::to("@web/images/product-details/rating.png"); ?> alt="">
								<button type="button" class="btn btn-default pull-right">Submit</button>
							</form>
						</div>
					</div>

					<?php 
						if ($this->params['menu'] == 'movie') {
							echo 
								"<div class=\"tab-pane fade\" id=\"movie\">
									<div class=\"col-sm-12\">
										Movie Trailer
									</div>
								</div>";
						}

						if ($this->params['menu'] == 'music') {
							echo 
								"<div class=\"tab-pane fade\" id=\"music\">
									<div class=\"col-sm-12\">
										Music Player
									</div>
								</div>";
						}
					?>

				</div>
			</div>

			<div class="recommended_items"><!--related_item-->
				<h2 class="title text-center">related products</h2>
				<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="item active">	
							<?php foreach ($related as $key => $related_product): ?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a class="link-single-product" href=<?php echo Url::to('/product/'.$related_product->slug);?>>
													<!-- <img src=<?php echo Url::to("@web/images/img/dummy.jpg"); ?> alt="" /> -->
													<div class="bg-product-image" style="background-image: url(<?php echo Url::to('@uploadfile/'.$related_product->picture); ?>);"></div>
													<h2>IDR <?php echo number_format($related_product->price,0,'','.'); ?></h2>
													<p><?php echo $related_product->name ;?></p>
												</a>
												<!-- <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button> -->
												<a href="<?php echo Url::to('/cart/add/'.$related_product->id) ;?>" class="btn btn-default add-to-cart">
													<i class="fa fa-shopping-cart"></i>
													Add to cart
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>