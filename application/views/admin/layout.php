<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/8/2017
 * Time: 5:07 PM
 */ ?>

<!-- load phan header -->
<?php $this->load->view("admin/header")?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- load phan head -->
    <?php $this->load->view("admin/head");?>
    <div class="content-wrapper">
        <!-- load phan noi dung chinh -->
        <?php $this->load->view($temp);?>
    </div>
    <!-- phan footer -->
    <?php $this->load->view("admin/footer");?>
    <!-- phan right side bar -->
    <?php $this->load->view("admin/right_side_bar");?>
    <!-- phan left side bar -->
    <?php $this->load->view("admin/left_side_bar");?>

</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo public_url("admin/plugins")?>/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo public_url("admin/")?>dist/js/jquery.dataTables.min.js"></script>
<script src="<?php echo public_url("admin/")?>dist/js/sortTable.js"></script>
<script src="<?php echo public_url("admin/")?>dist/js/admin.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo public_url("admin/")?>bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo public_url("admin/plugins")?>/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo public_url("admin/plugins")?>/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo public_url("admin/plugins")?>/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo public_url("admin/plugins")?>/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo public_url("admin/plugins")?>/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo public_url("admin/plugins")?>/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo public_url("admin/plugins")?>/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo public_url("admin/plugins")?>/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo public_url("admin/plugins")?>/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo public_url("admin/plugins")?>/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo public_url("admin")?>/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo public_url("admin")?>/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo public_url("admin")?>/dist/js/demo.js"></script>

</body>
</html>