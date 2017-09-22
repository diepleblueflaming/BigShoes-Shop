<?php
    if(!$news){return;}
?>
<!-- common css -->
<link rel="stylesheet" href="<?=base_url("public/site/css/post.css") ?>">
<div id="categoryNews" class="container">

    <div id="path">
        <a href="<?=base_url()?>">Home</a> &gt;
        <a href="<?=base_url('news/')?>">News</a> &gt;
        <?=$news->title?>
    </div>

    <div class="wrapper">

        <!-- view post -->
        <div id="session-right" class="col-xs-12 col-sm-7 col-md-8 pull-right">
            <div id="news-container">
                <div class="news-container-summary-content">
                    <div class="img-container col-sm-12 col-md-6">
                        <img src="<?=getNewsUri($news->image_link)?>">
                    </div>
                    <div class="content-container col-sm-12 col-md-6">
                        <h3><a href=""><?=$news->title?></a></h3>
                        <div class="news-item-author">
                            <span><i class="fa fa-tag"></i> Dressed</span>
                            <span><i class="fa fa-user"></i> <?=$news->author?></span>
                            <span><i class="fa fa-comment"></i> 10</span>
                        </div>
                        <div class="summary-content">
                           <?=$news->summary_content?>
                        </div>
                    </div>
                </div>

                <div class="detail-content">
                    <?=$news->content?>
                </div>

                <div class="fb-comments" data-href="<?=base_url($_SERVER['REQUEST_URI'])?>" data-colorscheme="light"
                     data-numposts="5" data-width="100%">
                </div>
            </div>
        </div>
        <!-- end view post -->

        <?php
            $this->load->view('site/news/sideBarLeft');
        ?>
    </div>
</div>
