<?php
// include phan head
$this->load->view("admin/admin/head");
?>
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
    <li class="active"><a href="#commons" data-toggle="tab">Thông Tin Chung</a></li>
    <li><a href="#plus" data-toggle="tab">Thông Tin Thêm</a></li>
    <li><a href="#permission" data-toggle="tab">Phân Quyền</a></li>
</ul>

<!-- phan noi dung cac the -->
<div class="tab-content">
<div class="tab-pane active" id="commons">
    <form class="form-horizontal" id="form_admin" action=""
          method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">UserName <span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="username" placeholder="Name" type="text" name="username"
                    value="<?php echo isset($info) ? $info->username : set_value("username"); ?>">
                <div class="error"><?php echo isset($error['username']) ? $error['username'] : form_error("username")?></div>
            </div>
        </div>

        <div class="form-group">
            <label for="Email" class="col-sm-2 control-label">Email <span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="Email" placeholder="Email" type="email" name="email"
                       value="<?php echo isset($info) ? $info->email : set_value("email"); ?>">
                <div class="error"><?php echo isset($error['email']) ? $error['email'] : form_error("email")?></div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone <span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="phone" placeholder="Phone" type="text" name="phone"
                       value="<?php echo isset($info) ? $info->phone : set_value("phone"); ?>">
                <div class="error"><?php echo isset($error['phone']) ? $error['phone'] : form_error("phone")?></div>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password <span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="password" placeholder="password" type="password" name="password"
                       value="<?php echo isset($info) ? "" : set_value("password"); ?>">
                <div class="error"><?php echo form_error("password")?></div>
            </div>
        </div>

        <div class="form-group">
            <label for="re-password" class="col-sm-2 control-label">Re-Password <span class="req">*</span></label>

            <div class="col-sm-10">
                <input class="form-control" id="re-password" placeholder="re-password" type="password" name="re-password"
                       value="<?php echo isset($info) ? "" : set_value("re-password"); ?>">
                <div class="error"><?php echo form_error("re-password")?></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success"><?php echo $action?></button>
                <a href="<?php echo base_url("admin/admin/")?>" class="btn btn-danger">Hủy Bỏ</a>
            </div>
        </div>
</form>
</div>
<!-- /.tab-pane -->

<!-- thong tin them -->
<div class="tab-pane" id="plus">
    <form class="form-horizontal">
    <div class="form-group">
        <label for="avatar" class="col-sm-2 control-label">Avatar</label>
        <div class="col-sm-10">
            <input class="form-control" id="avatar" type="file" name="avatar" form="form_admin">
            <div class="error"><?php echo isset($error['avatar']) ? $error['avatar'] : ""?></div>
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="col-sm-2 control-label">Address</label>

        <div class="col-sm-10">
            <input class="form-control" id="address" placeholder="Address"
                   value="<?php echo isset($info) ? $info->address  : set_value("address"); ?>"
                   type="text" name="address" form="form_admin">
            <div class="error"><?php echo form_error("address")?></div>
        </div>
    </div>

    <div class="form-group">
        <label for="fullname" class="col-sm-2 control-label">Full Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="fullname" placeholder="Full Name" type="text"
                   value="<?php echo isset($info) ? $info->full_name  : set_value("full_name"); ?>"
                   name="full_name" form="form_admin" >
            <div class="error"><?php echo form_error("full_name")?></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="introduction">Giới Thiệu</label>
        <div class="col-sm-10">
            <textarea id="introduction" class="form-control" rows="3" placeholder="Lời Giới Thiệu"
                      name="introduction" form="form_admin"><?php echo isset($info) ? $info->introduction  : set_value("introduction"); ?>
            </textarea>
            <div class="error"><?php echo form_error("introduction")?></div>
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