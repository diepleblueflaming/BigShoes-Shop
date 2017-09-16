<html>
    <head>
        <meta charset="utf-8">
        <title><?= isset($title) ? $title : "Big Shoes"?></title>
        <link rel="shortcut icon" href="<?php echo base_url("/upload/site/img/favicon.jpg")?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?=base_url("public/site/css/bootstrap.min.css") ?>" rel="stylesheet">
        <link href="<?=base_url("public/site/css/header.css") ?>" rel="stylesheet">
        <script src="<?=base_url("public/site/js/jquery-1.10.2.min.js") ?>" type="text/javascript"></script>
        <script src="<?=base_url("public/site/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?=base_url("public/site/js/common.js") ?>" type="text/javascript"></script>
        <script src="<?=base_url('public/site/js/angular.min.js')?>" type="application/javascript"></script>
        <link rel="stylesheet" href="<?=base_url("public/site/css/owl.carousel.min.css") ?>">
        <link rel="stylesheet" href="<?=base_url("public/site/css/owl.theme.default.min.css") ?>">
        <script src="<?=base_url("public/site/js/owl.carousel.js") ?>" type="application/javascript"></script>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=PT+Sans' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- css for footer -->
        <link rel="stylesheet" href="<?=base_url("public/site/css/footer.css") ?>">
        <!-- common css -->
        <link rel="stylesheet" href="<?=base_url("public/site/css/common.css") ?>">
        <!-- raty phan danh gia ngoi sao-->
        <script type="text/javascript" src="<?=base_url("public/site/raty/jquery.raty.min.js"); ?>"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- phan header -->
                <?php $this->load->view("site/layout/header")?>
            <!-- / phan header -->

            <div id="page-content" class="clearfix" role="main">
                <!-- main -->
                    <?php $this->load->view($temp)?>
                <!-- main -->
            </div>

            <?php $this->load->view("site/layout/footer")?>
        </div>
        <div id="overlay"></div>
        <?php $this->load->view("site/user/login");?>
    </body>
</html>
