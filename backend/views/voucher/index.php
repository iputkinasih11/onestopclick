<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\Permission;
use backend\components\CMS;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vouchers';
$this->params['breadcrumbs'][] = $this->title;
?>

<input type="hidden" id="url-category" value="<?php echo Url::to('/voucher');?>">

<div id="category" class="category-index">

    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <?php if ( CMS::check_permission(Permission::FULL_ACCESS) || CMS::check_permission(Permission::RESTRICT_DELETE) ):?>
        <p class="button-create-category">
            <?= Html::a('Create Voucher', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif;?>

    <div class="box">

        <div class="box-body">
            <table class="table table-bordered table-striped table-data-features-custom">
                <thead>
                    <th class="w5">No</th>
                    <th class="w10">Name</th>
                    <th class="w10">Code</th>
                    <th class="w20">Description</th>
                    <th class="w10">Discount (%)</th>
                    <th class="w10">Discount Price (IDR)</th>
                    <th class="w10">Start Date</th>
                    <th class="w10">End Date</th>
                    <th class="w10">Status</th>
                    <th class="w5">Action</th>
                </thead>
                <tbody>
                    
                    <?php foreach($dataProvider as $item):?>
                        <tr>
                            <td class="w5"><?php echo $item->id;?></td>
                            <td class="w10"><?php echo $item->name;?></td>
                            <td class="w10"><?php echo $item->code;?></td>
                            <td class="w20"><?php echo $item->description;?></td>
                            <td class="w10"><?php echo $item->discount_prosentase;?></td>
                            <td class="w10"><?php echo $item->discount_price;?></td>
                            <td class="w10"><?php echo date('d M Y', strtotime($item->start_date));?></td>
                            <td class="w10"><?php echo date('d M Y', strtotime($item->end_date));?></td>
                            <td class="w5">
                                <?php
                                    if ($item->status == 1) :
                                        echo "Active";
                                    else :
                                        echo "inactive";
                                    endif;
                                ?>
                            </td>
                            <td class="w10">
                                <a href="<?php echo Url::to('/voucher/update/?id='.$item->id);?>" class="btn btn-warning btn-xs btn-round" title="Edit Category" rel="tooltip">
                                    <i class="fa fa-pencil-square-o"></i>
                                    <div class="ripple-container"></div>
                                </a>

                                <?php if ( CMS::check_permission(Permission::FULL_ACCESS) ):?>
                                    <a onclick="show_delete_popup(<?php echo $item->id;?>,'<?php echo $item->name;?>')" class="btn btn-primary btn-xs btn-round" title="Delete Category" rel="tooltip">
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
                        <h3 class="box-title">Delete Voucher</h3>
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