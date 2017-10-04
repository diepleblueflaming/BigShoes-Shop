<link rel="stylesheet" href="<?=base_url("public/site/css/cart.css") ?>">
<script src="<?=base_url("public/site/js/order.js")?>" type="application/javascript"></script>
<div class="wrapper" id="transaction">
    <div class="container">
        <div class="row" id="process">
            <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <img src="<?=base_url("upload/site/img/process-checkout.png")?>">
            </div>
        </div>

        <div class="row" id="transaction-main-content">

            <?php if(!$carts) { ?>
                <h1 class="orderAlertError">Không Có Sản Phẩm Nào Trong Đơn Hàng</h1>
            <?php } else { ?>
                <form action="" method="post" role="form">
                <div class="transaction-item col-xs-12 col-sm-4">
                    <div class="transaction-item-wrapper">
                        <div class="sub-item">
                            <h3>Thông Tin Giao Hàng</h3>
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Họ Tên" value="<?=set_value("full_name")?>">
                            <div class="error"><?=form_error("full_name")?></div>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Điện Thoại" value="<?=set_value("phone")?>">
                            <div class="error"><?=form_error("phone")?></div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Địa Chỉ Email" value="<?=set_value("email")?>">
                            <div class="error"><?=form_error("email")?></div>
                        </div>

                        <div class="sub-item">
                            <h3>Phương Thức Giao Hàng</h3>
                            <?php
                                $checked = set_value("radio-giao-hang");
                                $radio_1 = in_array($checked,["","giao-hang"]) ? "checked" : "";
                                $radio_2 = $radio_1 ? "" : "checked";
                            ?>
                            <div class="radio">
                                <label><input type="radio" name="radio-giao-hang"  <?=$radio_1?> value="giao-hang"> <b>Giao Hàng Tận Nơi</b></label>
                            </div>
                            <div class="user-address">
                                <input type="text" name="deliver-address" placeholder="Địa Chỉ Giao Hàng" class="form-control">
                                <div class="error"><?=form_error("deliver-address")?></div>
                                <select class="form-control" name="location">
                                    <option value="">Vui lòng chọn vùng</option>
                                    <option value="Nội Thành Hà Nội" title="Hà Nội (Nội Thành)">Hà Nội (Nội Thành)</option>
                                    <option value="Ngoại thành hà nội" title="Hà Nội (Ngoại Thành)">Hà Nội (Ngoại Thành)</option>
                                    <option value="Thành phố Hồ Chí Minh" title="Thành phố Hồ Chí Minh">Thành phố Hồ Chí Minh</option>
                                    <option value="Bắc Cạn" title="Bắc Cạn">Bắc Cạn</option>
                                    <option value="Bắc Giang" title="Bắc Giang">Bắc Giang</option>
                                    <option value="Bắc Ninh" title="Bắc Ninh">Bắc Ninh</option>
                                    <option value="Bến Tre" title="Bến Tre">Bến Tre</option>
                                    <option value="Bình Dương" title="Bình Dương">Bình Dương</option>
                                    <option value="Bình Định" title="Bình Định">Bình Định</option>
                                    <option value="Bình Phước" title="Bình Phước">Bình Phước</option>
                                    <option value="Bình Thuận" title="Bình Thuận">Bình Thuận</option>
                                    <option value="Cà Mau" title="Cà Mau">Cà Mau</option>
                                    <option value="Cao Bằng" title="Cao Bằng">Cao Bằng</option>
                                    <option value="Cần Thơ" title="Cần Thơ">Cần Thơ</option>
                                    <option value="Đà Nẵng" title="Đà Nẵng">Đà Nẵng</option>
                                    <option value="Đắk Lắk" title="Đắk Lắk">Đắk Lắk</option>
                                    <option value="Đắk Nông" title="Đắk Nông">Đắk Nông</option>
                                    <option value="Điện Biên" title="Điện Biên">Điện Biên</option>
                                    <option value="Đồng Nai" title="Đồng Nai">Đồng Nai</option>
                                    <option value="Đồng Tháp" title="Đồng Tháp">Đồng Tháp</option>
                                    <option value="Gia Lai" title="Gia Lai">Gia Lai</option>
                                    <option value="Hà Giang" title="Hà Giang">Hà Giang</option>
                                    <option value="Hà Nam" title="Hà Nam">Hà Nam</option>
                                    <option value="An Giang" title="An Giang">An Giang</option>
                                    <option value="Bà Rịa-Vũng Tàu" title="Bà Rịa-Vũng Tàu">Bà Rịa-Vũng Tàu</option>
                                    <option value="Hà Tĩnh" title="Hà Tĩnh">Hà Tĩnh</option>
                                    <option value="Hải Dương" title="Hải Dương">Hải Dương</option>
                                    <option value="Hải Phòng" title="Hải Phòng">Hải Phòng</option>
                                    <option value="Hậu Giang" title="Hậu Giang">Hậu Giang</option>
                                    <option value="Hòa Bình" title="Hòa Bình">Hòa Bình</option>
                                    <option value="Bạc Liêu" title="Bạc Liêu">Bạc Liêu</option>
                                    <option value="Hưng Yên" title="Hưng Yên">Hưng Yên</option>
                                    <option value="Khánh Hoà" title="Khánh Hoà">Khánh Hoà</option>
                                    <option value="Kiên Giang" title="Kiên Giang">Kiên Giang</option>
                                    <option value="Kon Tum" title="Kon Tum">Kon Tum</option>
                                    <option value="Lai Châu" title="Lai Châu">Lai Châu</option>
                                    <option value="Lạng Sơn" title="Lạng Sơn">Lạng Sơn</option>
                                    <option value="Lào Cai" title="Lào Cai">Lào Cai</option>
                                    <option value="Lâm Đồng" title="Lâm Đồng">Lâm Đồng</option>
                                    <option value="Long An" title="Long An">Long An</option>
                                    <option value="Nam Định" title="Nam Định">Nam Định</option>
                                    <option value="Nghệ An" title="Nghệ An">Nghệ An</option>
                                    <option value="Ninh Bình" title="Ninh Bình">Ninh Bình</option>
                                    <option value="Ninh Thuận" title="Ninh Thuận">Ninh Thuận</option>
                                    <option value="Phú Thọ" title="Phú Thọ">Phú Thọ</option>
                                    <option value="Phú Yên" title="Phú Yên">Phú Yên</option>
                                    <option value="Quảng Bình" title="Quảng Bình">Quảng Bình</option>
                                    <option value="Quảng Nam" title="Quảng Nam">Quảng Nam</option>
                                    <option value="Quảng Ngãi" title="Quảng Ngãi">Quảng Ngãi</option>
                                    <option value="Quảng Ninh" title="Quảng Ninh">Quảng Ninh</option>
                                    <option value="Quảng Trị" title="Quảng Trị">Quảng Trị</option>
                                    <option value="Sóc Trăng" title="Sóc Trăng">Sóc Trăng</option>
                                    <option value="Sơn La" title="Sơn La">Sơn La</option>
                                    <option value="Tây Ninh" title="Tây Ninh">Tây Ninh</option>
                                    <option value="Thái Bình" title="Thái Bình">Thái Bình</option>
                                    <option value="Thái Nguyên" title="Thái Nguyên">Thái Nguyên</option>
                                    <option value="Thanh Hoá" title="Thanh Hoá">Thanh Hoá</option>
                                    <option value="Thừa Thiên-Huế<" title="Thừa Thiên-Huế">Thừa Thiên-Huế</option>
                                    <option value="Tiền Giang" title="Tiền Giang">Tiền Giang</option>
                                    <option value="Trà Vinh" title="Trà Vinh">Trà Vinh</option>
                                    <option value="Tuyên Quang" title="Tuyên Quang">Tuyên Quang</option>
                                    <option value="Vĩnh Long" title="Vĩnh Long">Vĩnh Long</option>
                                    <option value="Vĩnh Phúc" title="Vĩnh Phúc">Vĩnh Phúc</option>
                                    <option value="Yên Bái" title="Yên Bái">Yên Bái</option>
                                </select>
                                <div class="error"><?=form_error("location")?></div>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="radio-giao-hang" id="radio-nhan-hang" <?=$radio_2?> value="nhan-hang"> <b>Nhận Hàng Tại Cửa Hàng</b></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="transaction-item col-xs-12 col-sm-4">
                    <div class="transaction-item-wrapper">
                        <div class="sub-item">
                            <h3>Phương Thức Thanh Toán</h3>
                            <?php
                                $paymentChecked = set_value("payment");
                                $payment_radio_1 = in_array($paymentChecked,["","direct"]) ? "checked" : "";
                                $payment_radio_2 = $payment_radio_1 ? "" : "checked";
                            ?>
                            <div class="radio">
                                <label><input type="radio" name="payment" value="direct" <?=$payment_radio_1?> > <b>Thanh Toán Trưc Tiếp</b></label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="payment" value="bao-kim" <?=$payment_radio_2?> > <b>Thanh Toán Qua Bảo Kim</b></label>
                            </div>
                        </div>
                        <div class="sub-item">
                            <h3>Mã Giảm Giá</h3>
                            <div class="input-group">
                                <input type="text" class="form-control" name="discount-code" placeholder="Mã Giảm giá nếu có">
                            <span class="input-group-btn">
                                <button type="button" class="btn" id="button-discount"> Áp Dụng </button>
                            </span>
                            </div>
                        </div>

                        <div class="sub-item">
                            <h3>Ghi chú</h3>
                            <textarea class="form-control" placeholder="Ghi chú thêm" name="message"><?=set_value("message")?></textarea>
                        </div>
                        <button type="submit" id="btn-transaction-submit" name="pay" value="btnPay">Hoàn Tất Đặt Hàng</button>
                    </div>
                </div>

                <div class="transaction-item col-xs-12 col-sm-4">
                    <div class="transaction-item-wrapper">
                        <div class="sub-item">
                            <h3>Thông Tin Đơn Hàng</h3>
                            <div class="transaction-list-product">
                                <?php foreach($carts as $cart) {
                                    ?>
                                    <div class="transaction-list-product-item">
                                        <div class="col-sm-6 col-xs-6">
                                            <img src="<?=$cart['options']['imageUri']?>">
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <p><b>Sản Phẩm :</b><?=$cart['name']?></p>
                                            <p><b>Đơn giá : </b><?=number_format($cart['price'])?></p>
                                            <p><b>Số Lượng: </b><?=$cart['qty']?></p>
                                            <div class="color_container">
                                                <div class="label-text">Màu Sắc </div>
                                                <span  class="color" style="background-color: <?=$cart["options"]["color"]->name?>">
                                                ></span>
                                            </div>
                                            <div class="size_container">
                                                <div class="label-text">Kích Thước </div>
                                                <span class="size" id="<?=$cart['options']['size']->size?>"><?=$cart['options']['size']->size?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php }; ?>

                            </div>
                        </div>
                        <div class="transaction-result"><b>Tổng Tiền Thanh Toán:</b> <b><?=number_format($totalPrice)?></b></div>
                        <button id="btn-continue" type="button">Tiếp Tục Mua Hàng</button>
                    </div>
                </div>
                </form>
            <?php }?>
        </div>
    </div>
</div>
