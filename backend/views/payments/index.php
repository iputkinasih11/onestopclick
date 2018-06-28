<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\Permission;
use backend\components\CMS;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<input type="hidden" id="url-category" value="<?php echo Url::to('/payments');?>">

<div id="category" class="category-index">

    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <div class="box">

        <div class="box-body">
            <table class="table table-bordered table-striped table-data-features-custom">
                <thead>
                    <th>No</th>
                    <th>Payment ID</th>
                    <th>Payment Date</th>
                    <th>Total (IDR)</th>
                    <th>Discount (IDR)</th>
                    <th>Grand Total (IDR)</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>

                    <?php foreach($dataProvider as $key => $item):?>
                        <tr>
                            <td><?php echo ($key+1);?></td>
                            <td class="action_detail" rel="<?php echo $item['id'];?>"><?php echo $item['payment_id'];?></td>
                            <td><?php echo date('d M Y', strtotime($item['date']));?></td>
                            <td><?php echo number_format($item['total'],0,'','.');?></td>
                            <td><?php echo number_format($item['discount'],0,'','.');?></td>
                            <td><?php echo number_format($item['grand_total'],0,'','.');?></td>
                            <td>
                                <?php
                                if ($item['status'] == 0) :
                                    echo "Waiting Verification";
                                else :
                                    echo "Confirmed";
                                endif;
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo Url::to('/payments/update/?id='.$item['id']);?>" class="btn btn-warning btn-xs btn-round" title="Edit Payments" rel="tooltip">
                                    <i class="fa fa-pencil-square-o"></i>
                                    <div class="ripple-container"></div>
                                </a>

                                <?php if ( CMS::check_permission(Permission::FULL_ACCESS) ):?>
                                    <a onclick="show_delete_popup(<?php echo $item->id;?>,'<?php echo $item['payment_id'];?>')" class="btn btn-primary btn-xs btn-round" title="Delete Payments" rel="tooltip">
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
                        <h3 class="box-title">Delete Payments</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>Are you sure want to delete ?</p>
                        <div class="form-group">                
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

<div class="warp-notification"></div>

<?php
    $script = 
    "$('.action_detail').on('click', function(e) {
        var id = $(this).attr('rel');
        // console.log(id);
        send_ajax(id);
    });";
    $this->registerJs($script);
?>

<script>
    function send_ajax(id){
        var obj         = new Object();
            obj.action  = 'get_detail';
            obj.id      = id;

        $.ajax({
            type        : "post",
            dataType    : "json",
            url         : "<?php echo \Yii::$app->getUrlManager()->createUrl('payments/ajaxdetail'); ?>",
            data        : obj,
            success: function(data) {
                $('.warp-notification').html(data.body);
            },
            error: function(){
                console.log("Error");
            }
        });
    }
</script>