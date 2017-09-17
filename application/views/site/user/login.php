<link href="<?=base_url("public/site/css/user.css")?>" rel="stylesheet">
<div id="login_register" ng-app="appLogin" ng-controller="loginController">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#login" data-toggle="tab">Đăng Nhập</a></li>
        <li><a href="#register" data-toggle="tab">Tạo Tài Khoản</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="login">
            <div id="input_div">
                <form>
                    <input ng-model="lg_name" type="text" name="login_name" class="form-control" placeholder="Tên Đăng Nhập">
                    <div class="error">{{err_name}}</div>
                    <br>
                    <input ng-model="lg_pass" type="password" name="login_password" class="form-control" placeholder="Mật Khẩu">
                    <div class="error">{{err_pass}}</div>
                    <div id="forget_password">
                        <a href="#forget_password_div" data-toggle="tab"> Quên Mật Khẩu ?</a>
                    </div>

                    <div class="checkbox" id="remember">
                        <label><input type="checkbox" name="remember_me" > Ghi Nhớ </label>
                    </div>
                    <div class="clearfix"></div>
                    <a href="#" id="btn_login_facebook">FaceBook Login</a>
                    <a href="#" id="btn_login_google">Google Login</a>
                    <button id="btn-login" ng-click="login()">Đăng Nhập</button>
                </form>
            </div>
            <img src="<?=base_url("upload/site/img/logo.png")?>" id="img_logo">
        </div>
        <div class="tab-pane fade" id="register">
            <form action="" method="post">
                <div id="input_div_left">
                    <input type="text" ng-model="reg_name"  name ="username" placeholder="Tên Đăng Nhập" class="form-control">
                    <div class="error">{{reg_err_name}}</div>
                    <br>
                    <input type="email" ng-model="reg_email" name="email" placeholder="Email" class="form-control">
                    <div class="error">{{reg_err_email}}</div>
                    <br>
                    <input type="tel" ng-model="reg_phone" name="phone" placeholder="Số Điện Thoại" class="form-control">
                    <div class="error">{{reg_err_phone}}</div>
                </div>
                <div id="input_div_right">
                    <input type="password" ng-model="reg_password"  name="password" placeholder="Password" class="form-control">
                    <div class="error">{{reg_err_pass}}</div>
                    <br>
                    <input type="password" ng-model="reg_re_password" name="re_password" placeholder="Re Password" class="form-control">
                    <div class="error">{{reg_err_re_pass}}</div>
                    <button type="button" id="btn_reg_submit" ng-click="register()"> Đăng Kí</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="success">
            <h4>Bạn Đã Đăng Kí Tài Khoản Thành Công</h4>
            <p>Vui Lòng <b> Đăng Nhập </b>Để Sử Dụng Các Dịch Vụ Của Chúng Tôi<p>
            <div id="action">
                <button id="btn-success-dashboard">Trang Chủ</button>
            </div>
        </div>
        <div class="tab-pane fade" id="forget_password_div">
            <div class="inputDiv">
                <input type="email" name="forger_email" placeholder="Nhập Email Để Lấy Lại Password" ng-model="forget_email" class="form-control">
                <div class="error">{{forget_err_email}}</div>
                <button id="btn-forget-submit" ng-click="forgetPassword()">Lấy Lại Mật Khẩu</button>
            </div>
            <div id="loading">
                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url("public/site/js/user.js")?>" type="application/javascript"></script>
