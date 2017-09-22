<?php
// include phan head
$this->load->view("admin/pcs/head");
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

        <!-- San Pham -->
        <div class="form-group">
            <label for="product_id" class="col-sm-2 control-label">Sản Phẩm<span class="req">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" name="product_id" id="product_id">
                    <option value="">Chọn Sản Phẩm</option>
                    <?php foreach($products as $item):?>
                        <?php $selected = $info->product_id == $item->id  ? "selected" : ""?>
                        <option value="<?=$item->id?>" <?=$selected?>><?=$item->name?></option>
                    <?php endforeach?>
                </select>
                <div class="error"><?php echo isset($error['product_id']) ? $error['product_id'] : form_error("product_id")?></div>
            </div>
        </div>
        <!-- ten San Pham -->

        <!-- Mau Sac -->
        <div class="form-group">
            <label for="color_id" class="col-sm-2 control-label">Màu Sắc<span class="req">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" name="color_id" id="color_id">
                    <option value="">Chọn Màu Sắc</option>
                    <?php foreach($colors as $item):?>
                        <?php $selected = $info->color_id == $item->id  ? "selected" : ""?>
                        <option value="<?=$item->id?>" <?=$selected?>><?=$item->name?></option>
                    <?php endforeach?>
                </select>
                <div class="error"><?php echo isset($error['color_id']) ? $error['color_id'] : form_error("color_id")?></div>
            </div>
        </div>
        <!-- / Mau Sac -->

        <!-- Kich Thuoc -->
        <div class="form-group">
            <label for="size_id" class="col-sm-2 control-label">Kích Thước<span class="req">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" name="size_id" id="size_id">
                    <option value="">Chọn Kích Thước</option>
                    <?php foreach($sizes as $item):?>
                        <?php $selected = $info->size_id == $item->id  ? "selected" : ""?>
                        <option value="<?=$item->id?>" <?=$selected?>><?=$item->size?></option>
                    <?php endforeach?>
                </select>
                <div class="error"><?php echo isset($error['size_id']) ? $error['size_id'] : form_error("size_id")?></div>
            </div>
        </div>
        <!-- / Kich Thuoc -->

        <!-- So Luong -->
        <div class="form-group">
            <label for="qty" class="col-sm-2 control-label">Số Lượng<span class="req">*</span></label>
            <div class="col-sm-10">
                <input class="form-control" id="qty" placeholder="Số Lượng" type="number" name="qty"
                       value="<?php echo isset($info->qty) ? $info->qty : set_value("qty"); ?>">
                <div class="error"><?php echo isset($error['qty']) ? $error['qty'] : form_error("qty")?></div>
            </div>
        </div>
        <!-- / So Luong -->

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
