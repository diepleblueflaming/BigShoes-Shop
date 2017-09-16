<div class="container" id="profile">
    <div id="path">
        <a href="<?=base_url()?>">Home</a> &gt; Thông Tin Cá Nhân
    </div>
    <h2 class="title">Thông Tin Cá Nhân</h2>
    <div id="form-profile">
        <div class="form-group col-sm-12 col-md-8">
            <label for="username" class="control-label">Tên Đăng Nhập : <span id="lab-username"><?=$info->username?></span></label> <a href="">Chỉnh Sửa</a>
            <div class="input-container-username">
                <div class="input-group">
                    <input class="form-control" id="username" placeholder="Name" type="text" name="username">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="btn-submit-username">Cập Nhật</button>
                    </span>
                </div>
                <div id="err_username"></div>
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-8">
            <label for="password" class="control-label">Mật Khẩu</label> <a href="">Mật Khẩu Mới</a>
            <div class="input-container-password">
                <input class="form-control" placeholder="Mật Khẩu Hiện Tại" type="password" name="curr_password">
                <div id="err_curr_password"></div><br>
                <input class="form-control" placeholder="Mật Khẩu Mới" type="password" name="new_password">
                <div id="err_new_password"></div><br>
                <input class="form-control" placeholder="Nhập Lại Mật Khẩu Mới" type="password" name="cof_new_password">
                <div id="err_cof_new_password"></div><br>
                <button type="submit" class="btn btn-primary" name="btn-submit-password">Cập Nhật</button>
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-8">
            <label for="username" class="control-label">Địa Chỉ : <span id="lab-address"><?=$info->address?></span></label> <a href="">Chỉnh Sửa</a>
            <div class="input-container-address">
                <div class="input-group">
                    <input class="form-control" placeholder="Địa Chỉ Mới" type="text" name="address">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="btn-submit-address">Cập Nhật</button>
                    </span>
                </div>
                <div id="err_address"></div>
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-8">
            <label for="username" class="control-label">Email : <span id="lab-email"><?=$info->email?></span></label> <a href="">Chỉnh Sửa</a>
            <div class="input-container-email">
                <div class="input-group">
                    <input class="form-control" placeholder="Email Mới" type="text" name="email">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="btn-submit-email">Cập Nhật</button>
                    </span>
                </div>
                <div id="err_email"></div>
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-8">
            <label for="username" class="control-label">Số Điện Thoại : <span id="lab-phone"><?=$info->phone?></span></label> <a href="">Chỉnh Sửa</a>
            <div class="input-container-phone">
                <div class="input-group">
                    <input class="form-control" placeholder="Địa Chỉ Mới" type="text" name="phone">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="btn-submit-phone">Cập Nhật</button>
                    </span>
                </div>
                <div id="err_phone"></div>
            </div>
        </div>
    </div>
</div>
