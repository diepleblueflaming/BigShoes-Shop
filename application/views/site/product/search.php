<!-- css for home -->
<link rel="stylesheet" href="<?=base_url("public/site/css/home.css") ?>">
<link rel="stylesheet" href="<?=base_url("public/site/css/categoryProduct.css") ?>">
<script src="<?=base_url("public/site/js/category.js") ?>" type="text/javascript"></script>
<div class="container">
    <div id="path">
        <a href="<?=base_url()?>">Home</a> &gt; <?="Kết quả tìm kiếm cho '".$p_name_search."'" ?>
    </div>

    <div class="wrapper">
        <!-- article left -->
        <div class="col-sm-12 col-md-3" id="session-left">
            <!-- navbar left -->
            <div class="nav-left panel-group" id="according">
                <div id="nav-left-title">
                    Categories
                    <i class="fa fa-list"></i>
                </div>
                <?php if(count($categories)){
                    /** @var  $it CatalogBean */
                    foreach($categories as $it){?>
                        <div class="category panel">
                            <div class="cat-title">
                                <a href="#<?=convert_vi_to_en($it->getTitle())?>" data-toggle="collapse" data-parent="#according">
                                    <?=$it->getTitle()?>
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <?php if($it->sub){?>
                                <div class="sub-cat panel-collapse collapse" id="<?=convert_vi_to_en($it->getTitle())?>">
                                    <?php
                                    /** @var  $item CatalogBean*/
                                    foreach($it->sub as $item){?>
                                        <div class="sub-cat-item"><a href="<?=$item->getCatalogUri()?>"><?=$item->getTitle()?></a></div>
                                    <?php
                                    }?>
                                </div>
                            <?php
                            }?>

                        </div>
                    <?php
                    }
                }?>
            </div>
            <!-- end navbar left -->

            <!-- phan loc theo gia san pham -->
            <div id="filterPrice">
                <div class=" filterPrice-title">Lọc Theo Giá Sản Phẩm
                    <i class="fa fa-reload"></i>
                </div>
                <form action="" method="post" role="form">
                    <div class="filterPrice-from">
                        <label class="price-label">Giá Từ</label>
                        <select name="filterPrice-from" class="form-control filterPriceInput" id="filterPrice-from">
                            <option value="undefined">From</option>
                            <?php for($i = 0; $i <= 5 * pow(10,6); $i =  $i + pow(10,5)){
                                $selected =  $i === set_value("filterPrice-from") ? "selected ": "";
                                ?>
                                <option value="<?= $i==0 ? pow(10,3) : $i?>" <?=$selected?>><?=number_format($i==0 ? pow(10,3) : $i)?></option>
                            <?php }; ?>
                        </select>
                    </div>
                    <div class="filterPrice-to">
                        <label class="price-label">Giá Tới</label>
                        <select name="filterPrice-to" class="form-control filterPriceInput" id="filterPrice-to">
                            <option value="">To</option>
                            <?php for($i = pow(10,5); $i <= 5 * pow(10,6); $i = $i + pow(10,5)){
                                $selected = $i ===  set_value("filterPrice-to") ? "selected ": "";
                                ?>
                                <option value="<?=$i?>" <?=$selected?>><?=number_format($i)?></option>
                            <?php } ;?>
                        </select>
                    </div>
                    <input type="hidden" name="p_name_search" value="<?=isset($p_name_search) ? $p_name_search : ''?>">
                </form>
            </div>
            <!-- phan loc theo gia san pham -->
        </div>
        <!-- end article left -->

        <!-- article  right -->
        <div class="col-sm-12 col-md-9" id="article-right">
            <!-- phan loc san pham -->
            <div class="filter">
                <div class="totalProduct"><?php echo count($products)?> &nbsp;<i class="fa fa-product-hunt"></i></div>
                <form action="" method="post" role="form">
                    <select name="filterProduct" id="filterProduct" class="form-control">
                        <?php $order = set_value("filterProduct")?>
                        <option>Order By</option>
                        <option value="new" <?= $order && $order == "new" ? "selected" : ""?>>New Product</option>
                        <option value="popular" <?= $order && $order == "popular" ? "selected" : ""?>>Popular Product</option>
                        <option value="sale" <?= $order && $order == "sale" ? "selected" : ""?>>Sale Product</option>
                        <option value="price" <?= $order && $order == "price" ? "selected" : ""?>>Price Product</option>
                    </select>
                    <input type="hidden" name="p_name_search" value="<?=isset($p_name_search) ? $p_name_search : ''?>">
                </form>
            </div>
            <!-- phan loc san pham -->

            <!-- phan danh sach san pham -->
            <?php if(count($products)):
                /** @var  $p ProductBean */
                foreach($products as $p):?>
                    <div class="item col-xs-12 col-sm-12 col-md-4">
                        <div class="item-container">
                            <div class="item-img">
                                <a href="<?=$p->getProductUri()?>">
                                    <img src="<?=getProductUri($p->getImage())?>">
                                </a>
                                <?php if($p->getDiscount()): ?>
                                    <div class="sale"><?=$p->getDiscount()?>%</div>
                                <?php endif?>

                                <div class="list-action">
                                    <a href=""><i class="fa fa-eye" data-toggle="tooltip" title="Quick View"></i></a>
                                    <a href=""><i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add To Cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-title">
                                    <a href="#"><?=$p->getName()?></a>
                                </div>

                                <div class="product-rating">
                                    <div class='raty' data-score='<?=$p->getRateCount() ? ($p->getRateTotal()/$p->getRateCount()) : 0?>'></div>
                                </div>
                                <div class="product-price">
                                    <?php if($p->getSpecialPrice()){?>
                                        <span class="price"><?=number_format($p->getSpecialPrice())?></span>
                                        <span class="old-price"><?=number_format($p->getPrice())?></span>
                                    <?php }
                                    else{ ?>
                                        <span class="price"><?=number_format($p->getPrice())?></span>
                                    <?php
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            endif ?>
            <!-- end phan danh sach san pham -->
        </div>
        <!-- article  right -->
    </div>
</div>
