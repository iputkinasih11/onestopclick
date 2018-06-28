<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\Permission;
use backend\components\CMS;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<input type="hidden" id="url-category" value="<?php echo Url::to('/product');?>">

<div id="category" class="category-index">

    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <?php if ( CMS::check_permission(Permission::FULL_ACCESS) || CMS::check_permission(Permission::RESTRICT_DELETE) ):?>
        <p class="button-create-category">
            <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif;?>

    <div class="box">

        <div class="box-body">
            <table class="table table-bordered table-striped table-data-features-custom">
                <thead>
                    <tr>
                        <th class="w5">No</th>
                        <th class="w10">Picture</th>
                        <th class="w10">Name</th>
                        <th class="w35">Description</th>
                        <th class="w10">Author/Singer</th>
                        <th class="w10">Price (IDR)</th>
                        <th class="w10">Category</th>
                        <th class="w10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                        foreach($dataProvider as $key => $item):
                    ?>
                    <tr>
                        <td class="w5"><?php echo ($key+1);?></td>
                        <td class="w10">
                            <img class="picture-category-backend" src=<?php echo Url::to('@uploadfile/'.$item['picture']); ?>>
                        </td>
                        <td class="w10"><?php echo $item['name'];?></td>
                        <td class="w35"><?php echo $item['description'];?></td>
                        <td class="w10"><?php echo $item['author'];?></td>
                        <td class="w10"><?php echo number_format($item['price'],0,'','.');?></td>
                        <td class="w10"><?php echo $item['Subcategory'];?></td>
                        <td class="w10">
                            <a href="<?php echo Url::to('/product/update/?id='.$item['id']);?>" class="btn btn-warning btn-xs btn-round" title="Edit Product" rel="tooltip">
                                <i class="fa fa-pencil-square-o"></i>
                                <div class="ripple-container"></div>
                            </a>

                            <?php if ( CMS::check_permission(Permission::FULL_ACCESS) ):?>
                                <a onclick="show_delete_popup(<?php echo $item['id'];?>,'<?php echo $item['name'];?>')" class="btn btn-primary btn-xs btn-round" title="Delete Product" rel="tooltip">
                                    <i class="fa fa-window-close"></i>
                                    <div class="ripple-container"></div>
                                </a>
                            <?php endif;?>

                        </td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

<div class="popup-delete">
    <div class="wrapper">
        <div class="content">
            <div class="col-md-pull-12">
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Delete Product</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>Are you sure want to delete ?</p>
                        <div class="form-group">                
                            <!-- <button type="submit" class="btn btn-primary pull-right btn-danger">Yes</button> -->
                            <a class="btn btn-primary pull-right btn-danger" href="">Yes</a>
                            <button type="submit" class="btn btn-primary pull-right cancel-delete-category" style="margin-right: 5px;">No</button>        
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>