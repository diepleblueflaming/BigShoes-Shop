<link href="<?=base_url("public/site/css/contact.css")?>" rel="stylesheet">
<div id="contact" class="container">
    <div id="path">
        <a href="<?=base_url()?>">Home</a> &gt;
        Contact / Feedback
    </div>
    <div class="wrapper">
        <!-- phan nhap du lieu -->
            <div class="col-xs-12 col-sm-5" id="contactInput">
                <div id="contactTitle">Liên Hệ / Phản Hồi</div>
                <?php if(!isset($success)){?>
                    <form action="" method="post">
                    <div class="form-group">
                        <label class="control-label" for="name">Tên Bạn</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Tên Bạn" name="name" id="name"
                                   value="<?=set_value("name")?>">
                        </div>
                        <div class="error"><?=form_error("name")?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                   value="<?=set_value("email")?>">
                        </div>
                        <div class="error"><?=form_error("email")?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="address">Địa Chỉ</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                            <input type="text" class="form-control" placeholder="Địa Chỉ" name="address" id="address"
                                value="<?=set_value("address")?>">
                        </div>
                        <div class="error"><?=form_error("address")?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">Tiêu Đề</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                            <input type="text" class="form-control" placeholder="Tiêu Đề" name="title" id="title"
                                value="<?=set_value("title")?>">
                        </div>
                        <div class="error"><?=form_error("title")?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="name">Tin Nhắn</label>
                        <textarea class="form-control" placeholder="Tin Nhắn" name="message" id="message"><?=set_value("message")?></textarea>
                        <div class="error"><?=form_error("message")?></div>
                    </div>
                    <button type="submit" name="btnContact" id="btnContact">
                        <i class="fa fa-paper-plane"></i> Gửi
                    </button>
                </form>
                <?php }else{ ?>
                    <?php if($success){ ?>
                          <h4 class="contact-alert">Phản Hồi/Liên Hệ Của Bạn Đã Được Gửi Tới Chúng Tôi Chúng Tôi Sẽ Xử Lý Sớm Nhất Có Thể</h4>
                    <?php }else{ ?>
                            <h4 class="contact-alert">Gửi Thất Bại. Đã Có Lỗi Xảy Ra Thử Lại Sau </h4>
                    <?php }?>
                <?php }?>
            </div>
        <!-- end phan nhap du lieu -->

        <!-- phan mo ta -->
        <div class="col-xs-12 col-sm-6 col-md-offset-1" id="contact-description">
            <h3>CONTACT US</h3>
            <p>Etiam nulla nunc, aliquet vel metus nec, scelerisque tempus enim. Sed eget blandit lectus. Donec facilisis ornare turpis id pretium. Maecenas scelerisque interdum dolor in vestibulum.</p>
            <p>Proin euismod dui purus, non lacinia ligula luctus aIn volutpat cursus quam, a blandit neque accumsan vitae. Maecenas scelerisque interdum dolor in vestibulum.</p>
            <h3>Address</h3>
            <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.</p>
            <div class="contact-add">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <p>No 1104 Sky Tower, Newyork, USA</p>
            </div>
            <div class="contact-add">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <p>Phone : +12 34 506 789</p>
            </div>
            <div class="contact-add">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <p>Email : contact@yourwebsite.com</p>
            </div>
        </div>
        <!-- end phan mo ta -->
    </div>
</div>