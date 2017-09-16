<?php if(!$listNews) return;?>
<!-- common css -->
<link rel="stylesheet" href="<?=base_url("public/site/css/post.css") ?>">
<div id="categoryNews" class="container">

    <div id="path">
        <a href="<?php base_url()?>">Home</a> &gt;
        <a href="<?php base_url("news/")?>">News</a> &gt;
        Categories
    </div>

    <div class="wrapper">

        <!-- list post -->
            <div id="session-right" class="col-xs-12 col-sm-7 col-md-8 pull-right">
            <div id="news-container">
                <?php if($listNews){
                    foreach($listNews as $n){ ?>
                        <?php $uri = base_url("news/".convert_vi_to_en($n->title)."-n".$n->id.".html"); ?>
                        <div class="news-container-item">
                            <div class="img-container col-sm-12 col-md-7">
                                <a href="<?=$uri?>"><img src="<?=getNewsUri($n->image_link)?>"></a>
                            </div>
                            <div class="content-container col-sm-12 col-md-5">
                                <h3><a href="<?=$uri?>"><?=$n->title?></a></h3>
                                <div class="news-item-author">
                                    <span><i class="fa fa-tag"></i> Dressed</span>
                                    <span><i class="fa fa-user"></i> <?=$n->author?></span>
                                    <span><i class="fa fa-comment"></i> 10</span>
                                </div>
                                <div class="summary-content">
                                    <?=getCertainWord($n->summary_content,45)?>
                                </div>
                            </div>
                        </div>
                     <?php }
                }?>
            </div>
        </div>
        <!-- end list post -->

        <?php
            $this->load->view('site/news/sideBarLeft');
        ?>
    </div>
</div>
