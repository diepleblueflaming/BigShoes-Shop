<?php
// include phan head
$this->load->view("admin/size/head");
?>
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
    <li class="active"><a href="#commons" data-toggle="tab">Thông Tin Chung</a></li>
</ul>

<!-- phan noi dung cac the -->
<div class="tab-content">
<div class="tab-pane active" id="commons">
    <form class="form-horizontal" action="" method="post">

        <div class="form-group">
            <label for="size" class="col-sm-2 control-label">Kích Thước<span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="size" placeholder="Kích Thước" type="number" name="size"
                    value="<?php echo isset($info) ? $info->username : set_value("size"); ?>">
                <div class="error"><?php echo isset($error['size']) ? $error['size'] : form_error("size")?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success"><?php echo $action?></button>
                <a href="<?php echo base_url("admin/size/")?>" class="btn btn-danger">Hủy Bỏ</a>
            </div>
        </div>
</form>
</div>
<!-- /.tab-pane -->
</div>
<!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->
</div>
</div>
</section>