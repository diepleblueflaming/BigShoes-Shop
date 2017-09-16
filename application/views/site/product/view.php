<?php
    /** @var  $product ProductBean*/
    $product = $product;

    /** @var  $catalog CatalogBean*/
    $catalog = $catalog;

    $sizes = $sizes;
    $colors = $colors;
?>
<link rel="stylesheet" href="<?=base_url("public/site/css/view.css") ?>">
<script src="<?=base_url('public/site/js/angular-animate.js')?>" type="application/javascript"></script>
<script src="<?=base_url("public/site/js/viewProduct.js")?>" type="application/javascript"></script>
<div class="container">
    <div class="row path_row">
        <div id="path">
            <a href="<?=base_url()?>">Home</a> &gt;
            <a href="<?=$catalog->getCatalogUri()?>"><?=$catalog->getTitle()?></a> &gt;
            <?=$product->getName()?>
        </div>
    </div>

    <div class="row" id="product-view">
        <!-- view content -->
        <div class="view-content">
            <!-- image of product -->
            <div id="product-image" class="col-sm-12 col-md-9">
                <!-- main image -->
                <div id="product-title">
                    <?=$product->getName()?>
                </div>
                <div id="product-img-container">
                    <div class="owl-carousel owl-theme" id="product-slider">
                        <?php
                            $images = json_decode($product->getImageList());
                            if($images){
                                for($i = 0; $i < count($images); $i++){ ?>
                                    <div class="item"><img src="<?=getProductUri($images[$i])?>" style="height: 100%"></div>
                                <?php }
                            }
                        ?>
                    </div>
                    <!-- thumbnail -->
                    <ul id='carousel-custom-dots' class='owl-dots'>
                        <?php if($images){
                            for($i = 0; $i < count($images); $i++){ ?>
                                <li class="owl-dot" >
                                    <img src="<?=getProductUri($images[$i])?>">
                                </li>
                            <?php }
                        }?>
                    </ul>
                    <!-- end thumbnail -->
                </div>
                <!-- end main image -->
            </div>
            <!-- end image of product -->

            <!-- phan mua hang -->
            <div class="col-xs-12 col-sm-6 col-md-3 pull-right product-action">

                <div id="p-price">
                    <?php if($product->getSpecialPrice()){ ?>
                        <div class="regular-price">
                            <?=number_format($product->getSpecialPrice())?>
                            <span id="icon-price">đ</span>
                        </div>
                        <div class="special-price">
                             <?=number_format($product->getPrice())?>
                            <span id="icon-price">đ</span>
                        </div>
                    <?php } else { ?>
                        <div class="regular-price">
                            <?=number_format($product->getPrice())?>
                            <span id="icon-price">đ</span>
                        </div>
                    <?php }?>
                </div>

                <!-- phan chon san pham -->
                <div id="p-option">
                    <div id="p-label"><i class="fa fa-option"></i> Lựa Chọn</div>
                    <div class="p-option-container">
                        <label class="p-label-option">Màu Sắc</label>
                        <div id="p-color-container">
                            <?php if($colors){
                                /** @var  $c ColorBean*/
                                foreach($colors as $c){ ?>
                                    <div class="p-color-item" id="<?=$c->getName()."-".$c->getId()?>">
                                        <div class="icon-check">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="p-option-container">
                        <label class="p-label-option">Kích Thước</label>
                        <div id="p-size-container">
                            <?php if($sizes){
                                /** @var  $s SizeBean*/
                                foreach($sizes as $s){ ?>
                                    <div class="p-size-item" id="<?=$s->getId()?>">
                                        <?=$s->getSize()?>
                                        <div class="icon-check">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>

                    <div class="p-option-container">
                        <label class="p-label-option">Số Lượng</label>
                        <input type="number" class="form-control" name="qty" id="p-input-qty" form="productForm" min="0">
                        <p class="form-control-static" id="p-qty"></p>
                    </div>
                    <!-- end phan chon  san pham -->
                </div >
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 pull-right product-action">
                <!-- phan khuyen mai -->
                <div id="p-promotion">
                    <div id="p-label">Khuyến Mại</div>
                    <p><strong>Miễn phí giao hàng toàn quốc</strong> đơn hàng trên 1 triệu</p>
                    <p><strong>Trả lại hàng trong 365 ngày</strong> hoàn tiền 100% <a target="_blank" href="http://www.giaytot.com/tra-lai-san-pham-faq.html">Xem thêm</a></p>
                    <p><strong>Bảo hành miễn phí trọn đời</strong></p>
                </div>
                <!-- end phan khuyen mai -->

                <div class="action-button">
                    <form method="post" role="form" id="productForm">
                        <input type="hidden" name="productId" value="" id="inputProductId">
                        <input type="hidden" name="colorId" value="" id="inputColorId">
                        <input type="hidden" name="sizeId" value="" id="inputSizeId">
                        <button type="button" id="btn-buy"> <i class="fa fa-check"></i> Mua Ngay</button>
                        <button type="button" id="btn-add">
                            <i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ Hàng
                        </button>
                    </form>
                </div>
            </div>
            <!-- phan mua hang -->

            <div id="left" class="col-sm-12 col-md-9">
                    <!-- product description -->
                    <div id="product-description">
                        <h3 class="title">Mô Tả Sản Phẩm</h3>
                        <?=$product->getDescription()?>
                    </div>
                    <!--end product description -->

                    <div class="rating">
                        <h3>Đánh Giá Sản Phẩm</h3>
                        <div id="rating_container">Đánh Giá : <span class="rating_detail" id="<?=$product->getId()?>" data-score="<?=$product->getRateCount() ?  ($product->getRateTotal()/$product->getRateCount()) : 0?>"></span></div>
                        Tổng số đánh giá: <b class="rate_count"><?php echo $product->getRateCount()?></b>
                    </div>
                    <!-- product comment -->
                    <div id="product-comment" ng-app="commentModule" ng-controller="commentCtrl" class="col-xs-12">
                        <script type="text/ng-template" id="temp">
                            <div class="user-comment">
                                <div class="avatar-comment"><i class="fa fa-user"></i></div>
                                <div class="username-comment"><b>{{comment.name}}</b></div>
                            </div>
                            <div class="content-comment">{{comment.content}}</div>
                            <div class="footer-comment">
                                <b class="date"><i class="fa fa-calendar"></i> {{comment.created}}</b>
                                <span class="reply"><a><i class="fa fa-reply"></i> Trả Lời</a></span>
                                <div class="inputReply">
                                    <textarea class="form-control txtReply" name="inputReply" id="txtComment"></textarea>
                                    <button id="btnReply" ng-click="addComment(comment.id,$event)" type="button"><i class="fa fa-reply"></i> Trả Lời</button>
                                    <div class="col-sm-2" id="txtNameComment" style="display: <?=$login_info ? "none" : ""?>">
                                        <input name="userComment" id="userComment" class="form-control" required="required" placeholder="Tên Bạn">
                                    </div>
                                </div>
                            </div>
                            <div ng-repeat="comment in comment.answers" ng-include="'temp'"
                                class="list-comment-item {{comment.is_manager == true ? 'admin-comment' : ''}}">
                            </div>
                        </script>
                        <div id="comment-wrapper">
                            <!-- form comment -->
                            <form action="" method="post" role="form">
                                <textarea id="txtComment" cols="70" rows="10" class="form-control" placeholder="Để Lại Bình Luận Của Bạn"></textarea>
                                <div class="col-sm-2" id="txtNameComment" style="display: <?=$login_info ? "none" : ""?>">
                                    <input name="userComment" id="userComment" class="form-control" required="required" placeholder="Tên Bạn">
                                </div>
                                <button type="button" id="btnComment" ng-click="addComment(0,$event)"><i class="fa fa-comment"></i> Comment</button>
                            </form>
                            <!-- end form comment -->

                            <!-- list comment -->
                                <div class="list-comment-item {{comment.is_manager == true ? 'admin-comment' : ''}}" ng-repeat="comment in comments" ng-include="'temp'">

                                </div>
                            <!-- list comment -->
                        </div>
                    </div>
                    <!-- end product comment -->
                </div>

            <div id="right" class="col-sm-12 col-md-3 pull-right">
                    <!-- phan san pham moi nhat -->
                    <div id="new-product">
                        <div class="title col-xs-12 col-sm-4 col-md-12">Sản Phẩm Mới</div>
                        <div class="clearfix"></div>
                        <?php if($newProducts) {
                        /** @var  $p  ProductBean*/
                            foreach($newProducts as $p){ ?>
                                <div class="new-product-items col-xs-12 col-sm-4 col-md-12">
                                    <img src="<?=getProductUri($p->getImage())?>">
                                    <a class="name" href="<?=$p->getProductUri()?>"><?=$p->getName()?></a>
                                    <p class="price">Giá :  <?= $p->getSpecialPrice() ? number_format($p->getSpecialPrice()) : number_format($p->getPrice())?></p>
                                    <hr>
                                </div>
                           <?php }
                        }
                        ?>
                    </div>
                    <!-- end phan san pham moi nhat -->
                </div>
        </div>
        <!-- end view content -->
    </div>
</div>