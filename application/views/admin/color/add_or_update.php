<?php
// include phan head
$this->load->view("admin/color/head");
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
            <label for="color" class="col-sm-2 control-label">Tên Màu/Mã Hex<span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="color" placeholder="Màu Sắc" type="text" name="color"
                    value="<?php echo isset($info) ? $info->username : set_value("color"); ?>">
                <div class="error"><?php echo isset($error['color']) ? $error['color'] : form_error("color")?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success"><?php echo $action?></button>
                <a href="<?php echo base_url("admin/color/")?>" class="btn btn-danger">Hủy Bỏ</a>
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
