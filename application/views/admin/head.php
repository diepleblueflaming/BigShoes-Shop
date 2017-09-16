<header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url("admin/")?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>AD</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ADMIN</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <?php $num_con = isset($number_of_feedback) ? $number_of_feedback : 0 ?>
                <li class="dropdown messages-menu">
                    <a href="<?=base_url("admin/feedback/")?>" title="Có <?=$num_con?> Phản Hồi Chưa Xử Lý">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"><?=$num_con?></span>
                    </a>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <?php $num_tra = isset($number_of_transaction) ? $number_of_transaction : 0?>
                <li class="dropdown notifications-menu">
                    <a href="<?=base_url("admin/transaction/")?>" title="Có <?=$num_tra?> Đơn Hàng Chưa Xử Lý">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?=$num_tra?></span>
                    </a>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url("upload/admin/avatar/".(isset($info_login) &&  $info_login->avatar ? $info_login->avatar : "no_avatar.png"))?>" class="user-image">
                        <span class="hidden-xs"><?=isset($info_login) ? $info_login->username: ""?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= base_url("upload/admin/avatar/".(isset($info_login) &&  $info_login->avatar ? $info_login->avatar : "no_avatar.png"))?>" class="img-circle">

                            <p><?=isset($info_login) ? $info_login->username: ""?></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php $id_login = isset($info_login) ? $info_login->id : 0?>
                                <a href="<?=base_url("admin/admin/profile/{$id_login}/")?>"
                                   class="btn btn-default btn-flat">Thông Tin Cá Nhân</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?=base_url("admin/home/logout/")?>" class="btn btn-default btn-flat">Đăng Xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>