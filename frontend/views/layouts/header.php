<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\components\CMS;
use yii\widgets\Menu;
use yii\widgets\activeForm;

?>


<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@mitrais.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="http://facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="http://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="http://linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="http://instagram.com/"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href=<?php echo Url::to('/site/'); ?> style="float: left;display: block;background-color: #330a5d;width: 185px;">
                            <!-- <img src=<?php echo Url::to("@web/images/home/tap.png"); ?> alt="" /> -->
                            <img src=<?php echo Url::to("@web/images/home/mitrais-logo.png"); ?> alt="" style="width: 100%;height: auto;padding: 20px;" />
                        </a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo Url::to('/account/'); ?>"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="<?php echo Url::to('/cart/'); ?>"><i class="fa fa-shopping-cart"></i> Cart (<?php echo CMS::getCountCart();?>)</a></li>
                            <li>
                                <?php if ( Yii::$app->user->isGuest ) : ?>
                                    <?= Html::beginForm(['/site/login'], 'post') ?>
                                        <i class="fa fa-lock"></i>
                                        <?= Html::submitButton(
                                            'Login',
                                            ['class' => 'btn btn-link logout']
                                        ) ?>
                                    <?= Html::endForm() ?>
                                <?php else : ?>
                                    <?= Html::beginForm(['/site/logout'], 'post') ?>
                                        <i class="fa fa-lock"></i>
                                        <?= Html::submitButton(
                                            'Logout(' . Yii::$app->user->identity->username . ')',
                                            ['class' => 'btn btn-link logout']
                                        ) ?>
                                    <?= Html::endForm() ?>    
                                <?php endif; ?>                            
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <?php if ( $this->params ) : ?>

                                <?php $active_home  = $this->params['menu'] == 'home' ? 'active' : ''; ?>
                                <li style="padding-right: 30px;">
                                    <?= Html::a('Home', ['/site/'], ['class' => $active_home]) ?>
                                </li>

                                <?php
                                    $first_category = CMS::getFirstCategory();
                                    $first_slug     = $first_category->slug;
                                    $active_shop    = $this->params['menu'] == $first_category->slug ? 'active' : '';
                                ?>

                                <li style="padding-right: 30px;">
                                    <?= Html::a('Shop', ['/category/'.$first_slug], ['class' => $active_shop]) ?>
                                </li>

                                <?php $active_contact  = $this->params['menu'] == 'contact' ? 'active' : ''; ?>
                                <li>
                                    <?= Html::a('Contact', ['/site/contact'], ['class' => $active_contact]) ?>
                                </li>

                            <?php else : ?>

                                <li style="padding-right: 30px;">
                                    <?= Html::a('Home', ['/site/']) ?>
                                </li>

                                <?php
                                    $first_category = CMS::getFirstCategory();
                                    $first_slug     = $first_category->slug;
                                ?>

                                <li style="padding-right: 30px;">
                                    <?= Html::a('Shop', ['/category/'.$first_slug]) ?>
                                </li>

                                <li>
                                    <?= Html::a('Contact', ['/site/contact']) ?>
                                </li>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <!-- <input type="text" placeholder="Search"/> -->
                        <div class="col-md-4">                                
                            <div class="row">
                                <form method="get" action="<?php echo Url::to('/search');?>" class="form-horizontal form-search-product">
                                    <?php echo Html::input('text', 'sc', null,['class' => 'button-search-product','required' => TRUE]);?>
                                    <!-- <button type="submit" style="padding:10px 16px;"><i class="fa fa-search"></i></button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->