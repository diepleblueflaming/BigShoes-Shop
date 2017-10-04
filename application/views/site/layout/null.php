<html>
<head>
    <meta charset="utf-8">
    <title><?= isset($title) ? $title : "Big Shoes"?></title>
    <link rel="shortcut icon" href="<?php echo base_url("/upload/site/img/favicon.jpg")?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url("public/site/css/bootstrap.min.css") ?>" rel="stylesheet">
    <script src="<?=base_url("public/site/js/jquery-1.10.2.min.js") ?>" type="text/javascript"></script>
    <script src="<?=base_url("public/site/js/bootstrap.min.js") ?>" type="text/javascript"></script>
    <script src="<?=base_url("public/site/js/common.js") ?>" type="text/javascript"></script>
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '1611409532205698',
                cookie: true,
                xfbml: true,
                version: 'v2.8'
            });
        }
    </script>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- common css -->
    <link rel="stylesheet" href="<?=base_url("public/site/css/common.css") ?>">

</head>
<body>
<div class="wrapper">

    <div id="page-content" class="clearfix" role="main">
        <!-- main -->
        <?php $this->load->view($temp)?>
        <!-- main -->
    </div>
</div>
</body>
</html>
