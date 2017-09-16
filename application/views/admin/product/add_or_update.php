<?php
// include phan head
$this->load->view("admin/product/head");
?>
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="nav-tabs-custom">
<!-- cac the  -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#commons" data-toggle="tab">Thông Tin Chung</a></li>
    <li><a href="#plus" data-toggle="tab">Thông Tin Thêm</a></li>
</ul>

<!-- phan noi dung cac the -->
<div class="tab-content">
<div class="tab-pane active" id="commons">
    <form class="form-horizontal" id="form_product" action="" method="post" enctype="multipart/form-data">
        <!-- ten san pham -->
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Tên Sản Phẩm<span class="req">*</span></label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control"
                       value="<?php echo isset($info->name) ? $info->name : set_value("name"); ?>">
                <div class="error"><?php echo isset($error['name']) ? $error['name'] : form_error("name")?></div>
            </div>
        </div>
        <!-- / ten san pham -->

        <!-- Chuyen Muc -->
        <div class="form-group">
            <label for="catalog" class="col-sm-2 control-label">Chuyên Mục<span class="req">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" name="catalog" id="catalog">
                    <option value="">Chọn Chuyên Mục</option>
                    <?php foreach($catalog as $item):?>
                        <?php if($item->sub_child):?>
                            <optgroup label="<?=$item->title?>">
                                <?php foreach($item->sub_child as $it):?>
                                    <?php $selected = $info->catalog_id = $it->id ? "selected" : ""?>
                                    <option value="<?=$it->id?>" <?=$selected?>><?=$it->title?></option>
                                <?php endforeach?>
                            </optgroup>
                        <?php else:?>
                            <?php $sel = $info->catalog_id = $it->id ? "selected" : ""?>
                            <option value="<?=$item->id?>" <?=$sel?>><?=$item->title?></option>
                        <?php endif?>
                    <?php endforeach?>
                </select>
                <div class="error"><?php echo isset($error['catalog']) ? $error['catalog'] : form_error("catalog")?></div>
            </div>
        </div>
        <!-- / Chuyen Muc -->

        <!-- Gia -->
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Giá Sản Phẩm <span class="req">*</span></label>
            <div class="col-sm-10">
                <input class="form-control" id="price" placeholder="Giá Sản Phẩm" type="number" name="price"
                       value="<?php echo isset($info->price) ? $info->price : set_value("price"); ?>">
                <div class="error"><?php echo isset($error['qty']) ? $error['price'] : form_error("price")?></div>
            </div>
        </div>
        <!-- / Gia -->

        <!-- anh dai dien cua san pham -->
        <div class="form-group">
            <label for="image" class="col-sm-2 control-label">Ảnh Đại Diện<span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="image" placeholder="Ảnh Đại Diện" type="file" name="image"
                       value="<?php echo isset($info) ? "" : set_value("image"); ?>">
                <div class="error"><?php echo isset($error['image']) ? $error['image'] : form_error("image")?></div>
            </div>
        </div>
        <!-- anh dai dien cua san pham -->

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success"><?php echo $action?></button>
                <a href="<?php echo base_url("admin/product/")?>" class="btn btn-danger">Hủy Bỏ</a>
            </div>
        </div>
</form>
</div>
<!-- /.tab-pane -->

<!-- thong tin them -->
<div class="tab-pane" id="plus">
    <form class="form-horizontal">
    <!-- anh kem theo -->
    <div class="form-group">
        <label for="image_list" class="col-sm-2 control-label">Ảnh Kèm Theo</label>
        <div class="col-sm-10">
            <input class="form-control" id="image_list" type="file" multiple=multiple" name="image_list[]" form="form_product">
            <div class="error"><?php echo isset($error['image_list']) ? $error['image_list'] : ""?></div>
        </div>
    </div>
    <!-- anh kem theo -->

    <!-- Giam Gia cua san pham -->
    <div class="form-group">
        <label for="discount" class="col-sm-2 control-label">Giảm Giá (%)</label>
        <div class="col-sm-10">
            <input class="form-control" id="discount" placeholder="Giảm Giá" type="number" name="discount"
                   value="<?php echo isset($info->discount) ? $info->discount : set_value("discount"); ?>" form="form_product">
            <div class="error"><?php echo form_error("discount")?></div>
        </div>
    </div>
    <!-- / Giam Gia cua san pham -->

    <!-- Bao Hanh -->
    <div class="form-group">
        <label for="warranty" class="col-sm-2 control-label">Bảo hành</label>
        <div class="col-sm-10">
            <input class="form-control" id="warranty" placeholder="Bảo hành"
                   value="<?php echo isset($info->warranty) ? $info->warranty  : set_value("warranty"); ?>"
                   type="text" name="warranty" form="form_product">
            <div class="error"><?php echo form_error("warranty")?></div>
        </div>
    </div>
    <!-- / Bao Hanh -->

    <!-- Site title -->
    <div class="form-group">
        <label for="site_title" class="col-sm-2 control-label">Site Title</label>
        <div class="col-sm-10">
            <input class="form-control" id="site_title" placeholder="Site Title" type="text"
                   value="<?php echo isset($info->site_title) ? $info->site_title  : set_value("site_title"); ?>"
                   name="site_title" form="form_product" >
            <div class="error"><?php echo form_error("site_title")?></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="description">Mô Tả</label>
        <div class="col-sm-10">
            <textarea id="description" class="form-control" rows="3" placeholder="Mô Tả" name="description" form="form_product"><?php echo isset($info->description) ? $info->description  : set_value("description"); ?></textarea>
            <script>CKEDITOR.replace("description")</script>
            <div class="error"><?php echo form_error("description")?></div>
        </div>
    </div>
</div>
</form>
</div>
<!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->
</div>
</div>
</section>