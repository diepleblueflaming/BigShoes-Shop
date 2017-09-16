<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div id="header" class="header">
    <!-- toolbar -->
    <div id="toolbar">
        <div class="container-fluid">
            <div class="row">
                <div class="top-left col-sm-12 col-md-8">
                    Free shipping on orders over $100. Need Help? 866.526.3979
                </div>
                <div class="top-right col-sm-12 col-md-4">
                    <ul id="topbar-menu" class="menu">
                        <?php $isShow = $login_info ? "inline" : "none"?>
                        <li id="accountName" style="display: <?=$isShow?>"><a href="#"><?=$login_info["name"]?></a></li>
                        <li style="display: <?=$isShow?>"><a href="<?=base_url("user/edit/")?>">My Account</a></li>
                        <li style="display: <?=!$login_info ? "inline" : "none"?>" id="login_link"><a>Login</a></li>
                        <li style="display: <?=$login_info ? "inline" : "none"?>" id="logout_link"><a >Logout</a></li>
                        <li><a href="<?=base_url("order/checkout/")?>">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- toolbar -->
    <!-- head -->
    <div class="container-fluid">
        <div class="row" id="nav-top">
            <!--  mobile menu   -->
            <div class="col-sm-12 fixed" id="mobile_menu">
                <div class="icon">
                    <div class="bar_1"></div>
                    <div class="bar_2"></div>
                    <div class="bar_3"></div>
                </div>
                <div id="login_info">
                    <?= isset($login_info) ? $login_info["name"] : ""?>
                </div>
            </div>
            <div id="menu_mobile_container" class="close">
                <div id="accordion" class="panel-group">
                    <div class="panel panel-default" id="mobile_search">
                       <div class="panel-heading">
                           <div class="panel-title">
                               <form action="<?=base_url("product/search/")?>" method="post">
                                   <div class="input-group">
                                       <input type="text" class="form-control" placeholder="Search..." id="input-search" name="p_name_search">
                                       <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </span>
                                   </div>
                               </form>
                           </div>
                       </div>
                    </div>
                    <?php
                        if(isset($login_info)){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a href="<?=base_url("user/logout/")?>">LOGOUT</a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="panel panel-default" id="mobile_login">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a data-parent="#accordion" data-toggle="collapse" href="#mobile_login_container">
                                            <i class="fa fa-caret-right"></i> LOGIN
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-collapse collapse" id="mobile_login_container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <form>
                                                    <div class="input-group">
                                                        <input type="text" name="m_login_username" placeholder="Tên đăng nhập" required="required" class="form-control" autocomplete="off">

                                                        <input type="password" name="m_login_password" placeholder="Mật khẩu" required="required" class="form-control" autocomplete="off">
                                                        <input type="button" class="form-control" name="m_btn_login" value="Login">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a href="<?=base_url()?>">HOME</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a href="<?=base_url("news/")?>">BLOG</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-parent="#accordion" data-toggle="collapse" href="#mega_menu"> <i class="fa fa-caret-right"></i> MEGA MENU</a>
                            </div>
                        </div>
                        <div id="mega_menu" class="panel-collapse collapse">
                            <div class="panel-group" id="accordion_2">
                                <?php if(count($categories)){
                                    /** @var  $it CatalogBean*/
                                    foreach($categories as $it){ ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="padding-left: 44px">
                                                    <a data-parent="#accordion_2" data-toggle="collapse"
                                                            href="#panel_<?=$it->getId()?>"><i class="fa fa-caret-right"></i> <?=$it->getTitle()?></a>
                                                </div>
                                            </div>
                                            <div class="panel-collapse collapse" id="panel_<?=$it->getId()?>">
                                                <?php if($it->sub):?>
                                                    <?php foreach($it->sub as $item):?>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <div class="panel-title" style="padding-left: 88px">
                                                                    <a href="<?=base_url("product/".convert_vi_to_en($item->getTitle())."-".$item->getId())?>"><?= $item->getTitle()?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php }
                                }?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a href="<?=base_url("home/contact/")?>">CONTACT</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a href="<?=base_url("order/checkout/")?>">CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  end mobile menu-->

            <!-- logo -->
            <div class="col-sm-12 col-md-3" id="top-logo">
                <a href="<?=base_url()?>">
                    <img src="<?=base_url("upload/site/img/logo.png") ?>">
                </a>
            </div>
            <!-- / logo -->

            <!-- desktop navbar -->
            <div class="col-sm-12 col-md-9">
                <nav class="navbar navbar-default" id="myNav-Desktop">
                    <div class="container-fluid">
                        <div id="top-navbar">
                            <ul class="nav navbar-nav">
                                <li><a href="<?=base_url()?>">HOME</a></li>
                                <li><a href="<?=base_url("news/")?>">BLOG</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="">MEGA-MENU
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                    <ul class="menu-dropdown">
                                        <?php if(count($categories)){
                                            foreach($categories as $it){ ?>
                                                <li class="menu-dropdown-item">
                                                    <a href="<?=base_url("product/".convert_vi_to_en($it->getTitle())."-".$it->getId())?>" class="menu-link"><?=$it->getTitle()?></a>
                                                    <?php if($it->sub):?>
                                                    <ul>
                                                        <?php foreach($it->sub as $item):?>
                                                            <li><a href="<?=base_url("product/".convert_vi_to_en($item->getTitle())."-".$item->getId())?>"><?= $item->getTitle() ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                 <?php endif ?>
                                                </li>
                                        <?php
                                            }
                                        }?>
                                    </ul>
                                </li>
                                <li><a href="<?=base_url("home/contact/")?>">CONTACT</a></li>
                                <li id="quick-view-cart-container">
                                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <div id="quick-view-cart">
                                        <?php if($carts){
                                            foreach($carts as $it){ ?>
                                                <div class="quick-view-cart-item">
                                                    <div class="img-container">
                                                        <img src="<?=$it['options']['imageUri']?>">
                                                    </div>
                                                    <div class="content">
                                                        <p><b><?=$it['name']?></b></p>
                                                        <p><b>Giá : </b> <?=number_format($it['price'])?></p>
                                                        <p><b>Số Lượng : </b> <?=$it['qty']?></p>
                                                    </div>
                                                </div>
                                             <?php } ?>
                                            <button id="btn-check-out">Cart</button>
                                            <p id="total-price"><b>Tổng Cộng :</b> <?=number_format($totalPrice)?></p>
                                       <?php }else { ?>
                                                <h5>Bạn Chưa Có Sản Phẩm Nào Trong Giỏ Hàng</h5>
                                         <?php } ?>
                                    </div>
                                </li>
                                <li id="search">
                                    <a><i class="fa fa-search" aria-hidden="true"></i></a>
                                    <form action="<?=base_url("product/search/")?>" method="post">
                                        <div id="form-search">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search..." id="input-search" name="p_name_search">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="submit">
                                                        <i class="glyphicon glyphicon-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- end desktop navbar -->
        </div>
    </div>
    <!-- / head -->
</div>
