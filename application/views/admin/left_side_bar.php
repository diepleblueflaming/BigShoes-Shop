<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url("upload/admin/avatar/".(isset($info_login) &&  $info_login->avatar ? $info_login->avatar : "no_avatar.png"))?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=isset($info_login) ? $info_login->username : ""?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Tài Khoản</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("admin/admin/")?>"><i class="fa fa-circle-o"></i>Admin</a></li>
                    <li><a href="<?=base_url("admin/user/")?>"><i class="fa fa-circle-o"></i> Người Dùng</a></li>
                    <li><a href="<?=base_url("admin/admin/profile/".$info_login->id)?>"><i class="fa fa-circle-o"></i> Tiểu Sử</a></li>
                </ul>
            </li>
            <!-- phan san pham -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Sản Phẩm</span>
            <span class="pull-right-container">
                <span class="label label-info pull-right">4</span>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("admin/catalog/")?>"><i class="fa fa-circle-o"></i> Danh Mục</a></li>
                    <li><a href="<?=base_url("admin/product/")?>"><i class="fa fa-circle-o"></i> Sản Phẩm</a></li>
                    <li><a href="<?=base_url("admin/color/")?>"><i class="fa fa-circle-o"></i> Màu sắc</a></li>
                    <li><a href="<?=base_url("admin/size/")?>"><i class="fa fa-circle-o"></i> Kích Thước</a></li>
                    <li><a href="<?=base_url("admin/product_color_size/")?>"><i class="fa fa-circle-o"></i>Chi Tiết</a></li>
                </ul>
            </li>
            <!-- ket thuc phan san pham -->

            <!-- phan quan ly giao dich -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Giao Dịch</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">2</span>
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("admin/transaction/")?>"><i class="fa fa-circle-o"></i> Đơn hàng</a></li>
                    <li><a href="<?=base_url("admin/order/")?>"><i class="fa fa-circle-o"></i> Giao Dịch</a></li>
                </ul>
            </li>
            <!-- end phan quan li don hang -->

            <!-- phan quan ly phan hoi va tro giup -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Trợ Giúp</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">2</span>
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> Trợ Giúp</a></li>
                    <li><a href="<?=base_url("admin/feedback/")?>"><i class="fa fa-circle-o"></i> Phản Hồi</a></li>
                </ul>
            </li>
            <!-- ket thuc phan quan ly tro giup -->

            <!-- phan quan ly noi dung -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Nội Dung</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">2</span>
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i>Sile</a></li>
                    <li><a href="<?=base_url("admin/news/")?>"><i class="fa fa-circle-o"></i> Tin Tức</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>