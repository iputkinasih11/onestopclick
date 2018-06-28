<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<input type="hidden" id="url-category" value="<?php echo Url::to('/admin');?>">

<div id="category" class="category-index">

    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <p class="button-create-category">
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">

        <div class="box-body">
            <table class="table table-bordered table-striped table-data-features-custom">
                <thead>
                    <tr>
                        <th class="w5">No</th>
                        <th class="w10">Picture</th>
                        <th class="w10">Username</th>
                        <th class="w15">First Name</th>
                        <th class="w15">Last Name</th>
                        <th class="w15">Email</th>
                        <th class="w10">Role</th>
                        <th class="w10">Status</th>
                        <th class="w10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                        foreach($dataProvider as $item):
                    ?>
                    <tr>
                        <td class="w5"><?php echo $item->id;?></td>
                        <td class="w10">
                            <img class="picture-category-backend" src=<?php echo Url::to('@uploadfile/'.$item->picture); ?>>
                        </td>
                        <td class="w10"><?php echo $item->username;?></td>
                        <td class="w15"><?php echo $item->firstname;?></td>
                        <td class="w15"><?php echo $item->lastname;?></td>
                        <td class="w15"><?php echo $item->email;?></td>
                        <td class="w10"><?php echo $item->role;?></td>
                        <td class="w10"><?php echo $item->status;?></td>
                        <td class="w10">
                            <a href="<?php echo Url::to('/admin/update/?id='.$item->id);?>" class="btn btn-warning btn-xs btn-round" title="Edit Product" rel="tooltip">
                                <i class="fa fa-pencil-square-o"></i>
                                <div class="ripple-container"></div>
                            </a>
                            <a onclick="show_delete_popup(<?php echo $item->id;?>,'<?php echo $item->username;?>')" class="btn btn-primary btn-xs btn-round" title="Delete Product" rel="tooltip">
                                    <i class="fa fa-window-close"></i>
                                    <div class="ripple-container"></div>
                                </a>
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
                        <h3 class="box-title">Delete User</h3>
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