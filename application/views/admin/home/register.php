<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=isset($title) ? $title : "Shop Nội Thất"?></title>
    <link rel="shortcut icon" href="<?php echo base_url("upload/site/img/favicon.png")?>"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo public_url("admin/bootstrap")?>/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo public_url("admin")?>/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo public_url("admin/plugins")?>/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Đăng Kí Thành Viên</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?php if(!isset($success) || (isset($success) && !$success)){?>
        <p class="login-box-msg">Đăng kí thành viên của website</p>

        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username" value="<?=set_value("username")?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <div class="error"><?= isset($errors["username"]) ? $errors["username"] : form_error("username")?></div>
            </div>
            <div class="form-group has-feedback" data-nav="password">
                <input type="password" class="form-control" placeholder="Mật khẩu" name="password" value="<?=set_value("password")?>">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <div class="error"><?= isset($errors["password"]) ? $errors["password"] : form_error("password")?></div>
            </div>
            <div class="form-group has-feedback" data-nav="re_password">
                <input type="password" class="form-control" placeholder="Nhập Lại Mật khẩu" name="re_password" value="<?=set_value("re_password")?>">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <div class="error"><?= isset($errors["re_password"]) ? $errors["re_password"] : form_error("re_password")?></div>
            </div>
            <div class="form-group has-feedback" data-nav="email">
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?=set_value("email")?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <div class="error"><?= isset($errors["email"]) ? $errors["email"] : form_error("email")?></div>
            </div>
            <div class="form-group has-feedback" data-nav="phone">
                <input type="text" class="form-control" placeholder="Số điện thoại" name="phone" value="<?=set_value("phone")?>">
                <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                <div class="error"><?= isset($errors["phone"]) ? $errors["phone"] : form_error("phone")?></div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12" style="margin-bottom: 15px">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng Kí</button>
                    <button type="button" class="btn btn-primary btn-block btn-flat"
                        onclick="{window.history.back();}">Hủy Bỏ</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <?php }else{ ?>
            <h3>Bạn đã đăng kí thành công hãy</h3>
            <h3>Hãy <a href="<?=base_url("admin/home/login/")?>">Đăng Nhập</a></h3>
            <h3>Để Bắt Đầu Phiên Làm Việc</a></h3>
        <?php } ?>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo public_url("admin/plugins")?>/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo public_url("admin/")?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo public_url("admin/")?>/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
