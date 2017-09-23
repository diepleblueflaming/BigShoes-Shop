<script src="<?=base_url("public/site/js/home.js") ?>" type="text/javascript"></script>
<!-- css for home -->
<link rel="stylesheet" href="<?=base_url("public/site/css/home.css") ?>">
<link rel="stylesheet" href="<?=base_url("public/site/css/animate.css") ?>">
<!-- slide -->
<div class="owl-carousel owl-theme" id="banner_top_slide">
    <div class="item" id="slide_1">
        <img  src="<?=base_url("upload/site/img/image.jpg")?>" alt="image desc">
        <div class="caption">
            <h1 class="animated">FASHION SHOW 2016</h1>
            <h1 class="animated">NEW TREND THIS SUMMER</h1>
            <p></p>
            <a href="#" class="animated">Shop Now</a>
        </div>
    </div>
    <div class="item" id="slide_2">
        <img  src="<?=base_url("upload/site/img/image-2.jpg")?>">
        <div class="caption">
            <h1 class="animated">NEW MODERN</h1>
            <h1 class="animated">BEST SELLING THEME</h1>
            <p class="animated">Giảm giá 50% tất cả các sản phẩm</p>
            <a href="#" class="animated">Shop Now</a>
        </div>
    </div>
    <div class="item" id="slide_3">
        <img  src="<?=base_url("upload/site/img/image-3.jpg")?>">
        <div class="caption">
            <h1 class="animated">WOMEN COLLECTION</h1>
            <p class="animated">Thời trang dành cho phụ nữ</p>
            <a href="#" class="animated">Shop Now</a>
        </div>
    </div>
</div>
<!-- end slide -->

<div class="container clearfix">
    <div id="main-content" class="row">
        <!-- home feature -->
            <div id="home-feature" class="col-sm-12 col-md-12">
                <div class="col-xs-12 col-sm-4 home-feature-item">
                    <div class="home-feature-header">
                        <span class="icon">
                            <i class="fa fa-truck"></i>
                        </span>

                        <span class="title">
                            FREE DELIVERY
                        </span>
                    </div>

                    <div class="home-feature-body">
                        <p><b>Giao hàng trên toàn quốc:</b></p>
                        <p>
                            Giaytot.com luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng.
                            Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm từ Giaytot.com.
                        </p>
                    </div>

                    <div class="home-feature-footer">
                        <p><a href="#">Learn More</a></p>
                    </div>
            </div>
                <div class="col-xs-12 col-sm-4 home-feature-item">
                    <div class="home-feature-header">
                        <span class="icon">
                            <i class="fa fa-phone"></i>
                        </span>

                        <span class="title">
                            SUPPORT 24/7
                        </span>
                    </div>

                    <div class="home-feature-body">
                        <p><b>Giảm thêm 5% khi mua từ 2 đôi giày trở lên</b></p>

                        <p>Đối với khách hàng mua từ 2 đôi giày trở lên,
                            Giaytot.com tặng Quý khách 5% giảm giá trên tổng giá trị sản phẩm.
                            5% này được áp dụng chung với các chương trình giảm giá khác (nếu có).
                            Đây là chính sách cố định dành cho tất cả các khách hàng của Giaytot.com.
                        </p>
                    </div>

                    <div class="home-feature-footer">
                        <p>Learn More</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 home-feature-item">
                    <div class="home-feature-header">
                        <span class="icon">
                            <i class="fa fa-truck"></i>
                        </span>

                        <span class="title">
                            FREE DELIVERY
                        </span>
                    </div>

                    <div class="home-feature-body">
                        <p>NEtharums ser quidem laborum dolo.
                            Lid est laborum dolo rumes fugats untras.
                            Etharums ser quidem rerum facilis dolores
                            nemis omnis fugats vitaes nemo minima rerums
                            unsers sadips amets.</p>
                    </div>

                    <div class="home-feature-footer">
                        <p>Learn More</p>
                    </div>
                </div>
            </div>
        <!-- home feature -->


        <!-- home category -->
            <div id="home-category" class="col-sm-12">
                <div class="col-xs-12 col-sm-4 item">
                    <div class="item-img">
                        <a href="#">
                            <img src="<?=base_url("upload/site/img/banner-home-1.jpg")?>" alt="" width="370" height="270">
                        </a>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 item">
                    <div class="item-img">
                        <a href="">
                            <img src="<?=base_url("upload/site/img/banner-home-2.jpg")?>" alt="" width="370" height="270">
                        </a>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 item">
                    <div class="item-img">
                        <a href="">
                            <img src="<?=base_url("upload/site/img/banner-home-3.jpg")?>" alt="" width="370" height="270">
                        </a>
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        <!-- home category -->

        <!-- list product -->
        <div id="list-product" class="clearfix">
            <!-- tab list -->
            <ul id="tab-list">
                <li class="tab-list-item active" id="popular"><a>Popular</a></li>
                <li class="tab-list-item" id="new-receive"><a>New Receive</a></li>
            </ul>
            <!-- end tab list -->

            <!-- tab content -->
            <div id="tab-content-container" class="clearfix">
                <div class="tab-content-item owl-carousel owl-theme" id="tab-content-popular">
                    <?php if(count($popularProducts)) {
                        /** @var  $item ProductBean*/
                        foreach ($popularProducts as $item) {
                            ?>
                            <div class="item">
                                <div class="item-container">
                                    <div class="item-img">
                                        <a href="<?=base_url("product/".convert_vi_to_en($item->getName())."-p".$item->getId()).".html"?>">
                                            <img src="<?php echo base_url("upload/product/".$item->getImage())?>">
                                        </a>
                                        <?php if($item->getDiscount()): ?>
                                            <div class="sale"><?=$item->getDiscount()?>%</div>
                                        <?php endif?>

                                        <div class="list-action">
                                            <a href="<?=$item->getProductUri()?>"><i class="fa fa-eye" data-toggle="tooltip" title="Quick View"></i></a>
                                            <a href="#"><i class="fa fa-shopping-cart add_to_cart" data-toggle="tooltip" title="Add To Cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <a href="<?=base_url("product/".convert_vi_to_en($item->getName())."-p".$item->getId()).".html"?>">
                                                <?=$item->getName()?></a>
                                        </div>

                                        <div class="product-rating">
                                            <div class='raty' data-score='<?=$p->getRateCount() ? ($p->getRateTotal()/$p->getRateCount()) : 0?>'></div>
                                        </div>
                                        <div class="product-price">
                                            <?php if($item->getSpecialPrice()){?>
                                                <span class="price"><?=number_format($item->getSpecialPrice())?></span>
                                                <span class="old-price"><?=number_format($item->getPrice())?></span>
                                            <?php }
                                            else{ ?>
                                                <span class="price"><?=number_format($item->getPrice())?></span>
                                            <?php
                                            }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }?>
                </div>

                <div class="tab-content-item owl-carousel owl-theme" id="tab-content-new-receive">
                    <?php if(count($newProducts)) {
                        /** @var  $item ProductBean*/
                        foreach ($newProducts as $item) {
                            ?>
                            <div class="item">
                                <div class="item-container">
                                    <div class="item-img">
                                        <a href="<?=$item->getProductUri()?>">
                                            <img src="<?=getProductUri($item->getImage())?>">
                                        </a>

                                        <?php if($item->getDiscount()): ?>
                                            <div class="sale"><?=$item->getDiscount()?>%</div>
                                        <?php endif?>

                                        <div class="list-action">
                                            <a href=""><i class="fa fa-eye" data-toggle="tooltip" title="Quick View"></i></a>
                                            <a href=""><i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add To Cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <a href="<?=base_url("product/.".convert_vi_to_en($item->getName())."-p".$item->getId()).".html"?>"><?=$item->getName()?></a>
                                        </div>

                                        <div class="product-rating">
                                            <div class='raty' data-score='<?=$p->getRateCount() ? ($p->getRateTotal()/$p->getRateCount()) : 0?>'></div>
                                        </div>
                                        <div class="product-price">
                                            <?php if($item->getSpecialPrice()){?>
                                                <span class="price"><?=number_format($item->getSpecialPrice())?></span>
                                                <span class="old-price"><?=number_format($item->getPrice())?></span>
                                            <?php }
                                            else{ ?>
                                                <span class="price"><?=number_format($item->getPrice())?></span>
                                            <?php
                                            }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }?>
                </div>
            </div>
            <!-- tab content -->
        </div>
        <!-- end list product -->


        <?php if($products){
            foreach($products as $key => $val){
                if($val) {
                    ?>
                    <!-- list product belong categories -->
                    <div id="list-product-category" class="clearfix">
                        <!-- tab list -->
                        <ul id="tab-list">
                            <li class="tab-list-item" id="<?=convert_vi_to_en($key)?>"><a><?=$key?></a></li>
                        </ul>
                        <!-- end tab list -->

                        <!-- tab content -->
                        <div id="tab-content-container" class="clearfix">
                            <div class="tab-content-item owl-carousel owl-theme" id="tab-content-<?=convert_vi_to_en($key)?>">
                                <?php if(count($val)) {
                                    foreach ($val as $item) {
                                        ?>
                                        <div>
                                            <div class="item-container item">
                                                <div class="item-img">
                                                    <img src="<?php echo base_url("upload/product/".$item->getImage())?>">

                                                    <?php if($item->getDiscount()): ?>
                                                        <div class="sale"><?=$item->getDiscount()?>%</div>
                                                    <?php endif?>

                                                    <div class="list-action">
                                                        <a href="<?=$item->getProductUri()?>"><i class="fa fa-eye" data-toggle="tooltip" title="Quick View"></i></a>
                                                        <a href=""><i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add To Cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-title">
                                                        <a href="<?=$item->getProductUri()?>"><?=$item->getName()?></a>
                                                    </div>

                                                    <div class="product-rating">
                                                        <div class='raty' data-score='<?=$p->getRateCount() ? ($p->getRateTotal()/$p->getRateCount()) : 0?>'></div>
                                                    </div>
                                                    <div class="product-price">
                                                        <?php if($item->getSpecialPrice()){?>
                                                            <span class="price"><?=number_format($item->getSpecialPrice())?></span>
                                                            <span class="old-price"><?=number_format($item->getPrice())?></span>
                                                        <?php }
                                                        else{ ?>
                                                            <span class="price"><?=number_format($item->getPrice())?></span>
                                                        <?php
                                                        }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }?>
                            </div>
                        </div>
                        <!-- tab content -->
                    </div>
                    <!-- list product belong categories -->
                <?php }
            }
        }?>

        <!-- list post -->
        <div class="clearfix" id="list-post">
            <ul id="tab-list">
                <li class="tab-list-item"><a href="">Host Post</a></li>
            </ul>
            <div class="owl-carousel owl-theme" id="list_post_slide">
                <?php if(count($news)){
                    foreach($news as $i){
                        ?>
                        <?php $uri = base_url("news/".convert_vi_to_en($i->getTitle())."-n".$i->getId().".html"); ?>
                        <div class="list-post-item item">
                            <div class="item-img">
                                <img src="<?=base_url("upload/news/images/".$i->getImageLink())?>" width="100%" height="100%">
                            </div>
                            <div class="item-content">
                                <h4><a href="<?=$uri?>"><?=$i->getTitle()?></a></h4>
                                <p><?=getCertainWord($i->getSummaryContent(),44)?></p>
                            </div>
                        </div>
                    <?php
                    }
                }?>
            </div>
        </div>
        <!-- end list post -->
    </div>
</div>
