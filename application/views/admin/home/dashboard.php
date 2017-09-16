<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url("admin/")?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= isset($num_of_order) ? $num_of_order->total : 0?></h3>
                    <p>Giao Dịch</p>
                    <p>Đã thanh toán : <?= isset($num_of_order) ? $num_of_order->processed : 0?></p>
                    <p>Chưa thanh toán : <?= isset($num_of_order) ? $num_of_order->total - $num_of_order->processed : 0?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?=base_url("admin/order/")?>" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= isset($num_of_feedback) ? $num_of_feedback->total : 0?></h3>
                    <p>Phản Hồi</p>
                    <p>Đã xử lý : <?= isset($num_of_feedback) ? $num_of_feedback->processed : 0?></p>
                    <p>Chưa xử lý : <?= isset($num_of_feedback) ? $num_of_feedback->total - $num_of_feedback->processed : 0?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <a href="<?=base_url("admin/feedback/")?>" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= isset($num_of_admin) ? $num_of_admin : 0?></h3>

                    <p>Thành Viên</p>
                    <p style="visibility: hidden">s</p>
                    <p style="visibility: hidden">s</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?=base_url("admin/admin/")?>" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">

                    <h3><?= isset($num_of_transaction) ? $num_of_transaction->total : 0?></h3>
                    <p>Đơn Hàng</p>
                    <p>Đã xử lý : <?= isset($num_of_transaction) ? $num_of_transaction->processed : 0?></p>
                    <p>Chưa xử lý : <?= isset($num_of_transaction) ? $num_of_transaction->total - $num_of_transaction->processed : 0?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?=base_url("admin/transaction/")?>" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</section>