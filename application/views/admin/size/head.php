<section class="content-header">
    <h1>
       SIZE
        <small>Quản Lý Kích Thước</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url("admin/")?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url("admin/size/")?>">Size</a></li>
        <li class="active"><?php echo $action?></li>
    </ol>
</section>
<br>
<div class="col-sm-12">
    <div class="callout callout-info">
        <h4><?php echo $action?> Kích Thước</h4>
        <?php if(in_array($action,array("Thêm Mới","Chỉnh Sửa"))) :?>
        <h5>Các Thông Tin Có Dấu Sao Là Bắt Buộc</h5>
        <?php endif?>
    </div>
</div>