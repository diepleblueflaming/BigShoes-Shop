<?php
    // load head
    $this->load->view("admin/admin/head");
?>
<section class="content">
    <div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle"
                     src="<?= $info->avatar ?  base_url("upload/admin/avatar/".$info->avatar) : base_url("upload/admin/avatar/no_avatar.png")?>"
                     alt="<?=$info->full_name?>">
                <h3 class="profile-username text-center"><?=$info->username?></h3>
                <p class="text-muted text-center">Software Engineer</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php $empty = "Chưa cập nhật"?>
                <strong><i class="fa fa-book margin-r-5"></i> Full Name</strong>
                <p class="text-muted"><?=$info->full_name ? $info->full_name : $empty?></p>
                <hr>

                <strong><i class="fa fa-mail-forward margin-r-5"></i> Email</strong>
                <p class="text-muted"><?=$info->email?></p>
                <hr>

                <strong><i class="fa fa-phone margin-r-5"></i> Phone Number</strong>
                <p class="text-muted"><?=$info->phone?></p>
                <hr>

                <strong><i class="fa fa-home margin-r-5"></i> Address</strong>
                <p class="text-muted"><?=$info->address ? $info->address : $empty?></p>
                <hr>

                <strong><i class="fa fa-info margin-r-5"></i> Introducion</strong>
                <p class="text-muted"><?=$info->introduction?></p>
                <hr>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
    <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li><a href="#activity" data-toggle="tab">Activity</a></li>
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane" id="activity">

    </div>
    <!-- /.tab-pane -->

    <div class="active tab-pane" id="settings">
        <form class="form-horizontal" action="<?=base_url("admin/admin/edit/".$info->id."/profile/")?>" method="post" enctype="multipart/form-data">
            <div class="col-sm-10 col-sm-offset-2"><label>Chỉnh Sửa Lại Các Trường Mà Bạn Muốn Thay Đổi Thông Tin</label></div>
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
                <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                    <input class="form-control" id="avatar" type="file" name="avatar">
                    <div class="error"><?php echo isset($error['avatar']) ? $error['avatar'] : ""?></div>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>

                <div class="col-sm-10">
                    <input class="form-control" id="address" placeholder="Address"
                           value="<?php echo isset($info) ? $info->address  : set_value("address"); ?>"
                           type="text" name="address">
                    <div class="error"><?php echo form_error("address")?></div>
                </div>
            </div>

            <div class="form-group">
                <label for="fullname" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-10">
                    <input class="form-control" id="fullname" placeholder="Full Name" type="text"
                           value="<?php echo isset($info) ? $info->full_name  : set_value("full_name"); ?>"
                           name="full_name">
                    <div class="error"><?php echo form_error("full_name")?></div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="introduction">Giới Thiệu</label>
                <div class="col-sm-10">
                    <textarea id="introduction" class="form-control" rows="3" placeholder="Lời Giới Thiệu"
                              name="introduction"><?php echo isset($info) ? $info->introduction  : set_value("introduction"); ?>
                    </textarea>
                    <div class="error"><?php echo form_error("introduction")?></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Chỉnh Sửa</button>
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
    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>