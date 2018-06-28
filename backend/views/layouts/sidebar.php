<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\CMS;
use backend\models\Roles;

?>

<aside class="main-sidebar">
	
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src=<?php echo Url::to('@web/dist/img/putri.jpg') ?> class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo Yii::$app->user->identity->name; ?></p>
				<?php 
					$roles 	= Yii::$app->user->identity->roles; 
					$query 	= Roles::find()->where(['status' => Roles::STATUS_ACTIVE, 'id' => $roles])->one();
				?>
				<i class="fa fa-circle text-success"></i> <?php echo $query->name; ?>
			</div>
		</div>

		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">

			<li class="header">MAIN NAVIGATION</li>

			<li>
				<a href=<?php echo Url::to('@web/dashboard') ;?>>
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>

			<?php 
				$slugs	= array();
				$menus 	= CMS::getMenu();
				$arr	= array( 'category', 'subcategory', 'product', 'voucher', 'payments', 'member', 'user', 'feature', 'roles' );

				foreach ($menus['menu'] as $key => $value) :
					if ( $value[0]['access'] != 0 ) :
						$slugs[] .= $value[0]['slug'];
					endif;
				endforeach;

				foreach ( $arr as $key => $value ) :
					if ( in_array($value, $slugs) ) :
						?>
						<li>
							<a href=<?php echo Url::to('@web/'.$value.'/') ;?>>
								<i class="fa fa-th"></i> <span><?php echo ucwords($value);?></span>
							</a>
						</li>
						<?php
					endif;
				endforeach;
			?>

		</ul>
		
	</section>
	<!-- /.sidebar -->

</aside>