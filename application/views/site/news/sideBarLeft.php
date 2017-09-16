<!-- sidebar left -->
<div class="sidebar-left col-xs-12 col-sm-5 col-md-4 pull-left">

    <!-- recent news -->
    <div id="recent-news">
        <div class="title">Bài Viết Mới Nhất</div>
        <?php if($hotNews){
            /** @var  $news NewsBean*/
            foreach($hotNews as $news){ ?>
                <div class="recent-news-item">
                    <div class="img-container col-sm-4 col-xs-12 col-md-4">
                        <a href="<?=$news->getNewsUri()?>"><img src="<?=$news->getImageUri()?>"></a>
                    </div>
                    <div class="description col-sm-8 col-xs-12 col-md-8">
                        <p><a href="<?=$news->getNewsUri()?>"><?=$news->getTitle()?></a></p>
                        <div class="date"><b><i class="fa fa-clock-o"></i> <?=$news->getCreated()?></div>
                    </div>
                </div>
            <?php }
        }?>
    </div>
    <!-- end recent news -->

    <!-- categories news-->
    <div id="categories-news">
        <div class="title">Chuyên Mục</div>
        <div class="categories-news-item">
            <a href=""> <i class="fa fa-angle-right"></i> &nbsp;Accessories</a>
        </div>
        <div class="categories-news-item">
            <a href=""> <i class="fa fa-angle-right"></i> &nbsp;Dressed</a>
        </div>
        <div class="categories-news-item">
            <a href=""> <i class="fa fa-angle-right"></i> &nbsp;Fashion</a>
        </div>
        <div class="categories-news-item">
            <a href=""> <i class="fa fa-angle-right"></i> &nbsp;Shoes</a>
        </div>
    </div>
    <!-- categories news-->
</div>
<!-- end sidebar left -->