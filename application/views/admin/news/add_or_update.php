<?php
// include phan head
$this->load->view("admin/news/head");
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
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

        <!-- tieu de -->
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Tiêu Đề<span class="req">*</span></label>
            <div class="col-sm-10">
                <input class="form-control" id="title" placeholder="Tiêu Đề" type="text" name="title"
                    value="<?php echo isset($info) ? $info->title : set_value("title"); ?>">
                <div class="error"><?php echo isset($error['title']) ? $error['title'] : form_error("title")?></div>
            </div>
        </div>
        <!-- tieu de -->

        <!-- anh dai dien cua bai viet -->
        <div class="form-group">
            <label for="image_link" class="col-sm-2 control-label">Ảnh Đại Diện<span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="image_link" placeholder="Ảnh Đại Diện" type="file" name="image_link"
                       value="<?php echo isset($info) ? "" : set_value("image_link"); ?>">
                <div class="error"><?php echo isset($error['image_link']) ? $error['image_link'] : form_error("image_link")?></div>
            </div>
        </div>
        <!-- anh dai dien cua bai viet -->

        <!-- noi dung tom tat -->
        <div class="form-group">
            <label for="summary_content" class="col-sm-2 control-label">Nội Dung Tóm Tắt<span class="req">*</span></label>

            <div class="col-sm-10">
                <textarea cols="70" rows="5" id="summary_content" name="summary_content"><?= isset($info->summary_content) ? $info->summary_content : set_value("summary_content")?></textarea>
                <div class="error"><?php echo isset($error['summary_content']) ? $error['summary_content'] : form_error("summary_content")?></div>
            </div>
        </div>
        <!-- noi dung tom tat -->

        <!-- noi dung chi tiet -->
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">Nội Dung Chi Tiết<span class="req">*</span></label>
            <div class="col-sm-10">
                <textarea cols="70" rows="5" id="content" name="content"><?= isset($info->content) ? $info->content : set_value("content")?></textarea>
                <script>CKEDITOR.replace("content")</script>
                <div class="error"><?php echo isset($error['content']) ? $error['content'] : form_error("content")?></div>
            </div>
        </div>
        <!-- noi dung chi tiet -->

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success"><?php echo $action?></button>
                <a href="<?php echo base_url("admin/news/")?>" class="btn btn-danger">Hủy Bỏ</a>
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