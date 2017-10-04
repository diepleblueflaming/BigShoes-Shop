<link rel="stylesheet" href="<?=base_url("public/site/css/cart.css") ?>">
<script src="<?=base_url('public/site/js/angular.min.js')?>"></script>
<script src="<?=base_url('public/site/js/angular-animate.js')?>"></script>
<script src="<?=base_url('public/site/js/cart.js')?>"></script>
<div class="wrapper" id="cart">
    <div class="container" id="process">
        <div class="row">
            <div class="process col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <img src="<?=base_url("upload/site/img/process.png")?>">
            </div>
        </div>
        <div class="row" id="cart-main-content" ng-app="appCart" ng-controller="myCtrl">
            <div id="cart-content">
                <!-- phan gio hang -->
                <div id="cart-list">
                    <div class="title">Giỏ Hàng</div>
                    <?php if(!$carts): ?>
                        <div class="alertError" ng-if="check">
                            <h2 class="message">Bạn chưa có sản phẩm nào trong giỏ hàng</h2>
                            <a href="<?= base_url()?>" class="backToHome" id="btn">Quay Lại Trang Chủ</a>
                        </div>
                    <?php else : ?>
                    <form action="" method="" ng-if="!check">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Ảnh</th>
                                    <th>Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng Giá</th>
                                    <th>Xóa</th>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in carts" ng-init="options=item['options']">
                                        <td><img src="{{options['imageUri']}}" class="img-thumb"></td>
                                        <td class="td-content">
                                            <p>{{item.name}}</p>
                                            <div class="color_container">
                                                <div class="label-text">Màu Sắc </div>
                                                <div ng-init="color=options['color']"></div>
                                                <span class="color active" id="{{color.name+'-'+color.id}}" style="color : {{color.name}}"></span>
                                                <div class="list_color">
                                                    <span class="color" ng-repeat="c in options['colors']" id="{{c.name+'-'+c.id}}" ng-click="changeData(item.id,c,'color')" style="color:{{c.name}}"></span>
                                                </div>
                                            </div>
                                            <div class="size_container">
                                                <div class="label-text">Kích Thước </div>
                                                <div ng-init="size=options['size']"></div>
                                                <span class="size active" id="{{size.size}}">{{size.size}}</span>
                                                <div class="list_size">
                                                    <span class="size" ng-repeat="s in options['sizes']" id="{{s.size}}" ng-click="changeData(item.id,s,'size')">{{s.size}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="td-qty">
                                            <input type="text" id="cart-product-qty" ng-model="item.qty" class="form-control" ng-blur="changeData(item.id,item.qty,'qty')">
                                        </td>
                                        <td>{{item.price| number}}</td>
                                        <td>{{item.price * item.qty | number}}</td>
                                        <td>
                                            <a href="">
                                                <i class="fa fa-trash cart-remove" ng-click="delete(item.id)"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td colspan="4"><b>Tổng Cộng</b></td>
                                    <td colspan="2"><b>{{total|number}}</b></td>
                                </tfoot>
                            </table>
                        </div>
                        <div class="cart-action">
                            <button type="submit" id="btn-cart-submit" formaction="<?=base_url("order/checkOut/")?>">Thanh Toán</button>
                            <button type="button" id="btn-cart-back"> <i class="fa fa-long-arrow-left" id></i> Quay Lại</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
                <!-- end phan gio hang -->
            </div>
        </div>
    </div>
</div>
