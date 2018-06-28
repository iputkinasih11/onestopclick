<?php 

use yii\helpers\Html;
use yii\helpers\Url;

?>

<header class="main-header">

	<!-- Logo -->
	<a href="index2.html" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>A</b>ES</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Admin</b>E-Store</span>
	</a>

	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">

		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src=<?php echo Url::to('@web/dist/img/putri.jpg') ?> class="user-image" alt="User Image">
						<span class="hidden-xs">
							<?php
								echo Yii::$app->user->identity->name;
							?>
						</span>
					</a>
					<ul class="dropdown-menu">

						<!-- User image -->
						<li class="user-header">
							<img src=<?php echo Url::to('@web/dist/img/putri.jpg') ?> class="img-circle" alt="User Image">

							<p>
								<?php echo Yii::$app->user->identity->name; ?>
								<small>Member since <?php echo date ('M, d Y', strtotime(Yii::$app->user->identity->created_at)); ?></small>
							</p>
						</li>
						
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-right">
								<!-- <a href="#" class="btn btn-default btn-flat">Sign out</a> -->
								<?= Html::beginForm(['/auth/logout'], 'post') ?>
									<?= Html::submitButton(
										'Logout',
										['class' => 'btn btn-default btn-flat']
									) ?>
								<?= Html::endForm() ?> 
							</div>
						</li>

					</ul>
				</li>

				<!-- Control Sidebar Toggle Button -->
				<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
		</div>
	</nav>

</header>