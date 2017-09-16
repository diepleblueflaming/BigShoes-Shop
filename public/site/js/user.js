
$(document).ready(function(){
    $("#btn-success-dashboard").click(function(){
        $("#success").removeClass("active in");
        $("#register").addClass("active in");
        $hideForm();
    }) ;

    profile();
});


var app = angular.module("appLogin",[]);
app.controller('loginController',function($scope,$http){
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $scope.login = function(){

        $scope.err_name = '';
        $scope.err_pass = '';

        var name = $scope.lg_name;
        var pass = $scope.lg_pass;

        var isValidName  = validString(name,false);
        var isValidPass = validString(pass,false);


        if(isValidName){
            $scope.err_name = isValidName;
        }

        if(isValidPass){
            $scope.err_pass = isValidPass;
        }

        if(isValidName || isValidPass){
            return;
        }

        var $param = {lg_name : name, lg_pass : pass};

        $http.post(base_url("user/login/"), $.param($param)).then(function($response){

            var $error = $response.data;

            if($error.username != undefined){
                $scope.err_name = $error.username;
                return;
            }

            if($error.password != undefined){
                $scope.err_pass = $error.password;
                return;
            }

            if($error.name != undefined){
                $("#accountName").css("display","inline").children("a").html($error.name);
                $("#login_link").hide();
                $("#logout_link").css("display","inline");
                window.location.reload();
            }

            $hideForm();
        });
    }

    $scope.register = function(){

        var $name = $scope.reg_name != undefined ? $scope.reg_name : "";
        var $email = $scope.reg_email != undefined ? $scope.reg_email : "";
        var $password = $scope.reg_password != undefined ? $scope.reg_password : "";
        var $re_password = $scope.reg_re_password != undefined ? $scope.reg_re_password : "";
        var $phone = $scope.reg_phone != undefined ? $scope.reg_phone : "";

        var isValidName = validString($name,true);
        var isValidEmail = (/^\w+([\.-]?\w+)*@([\.-]?\w+)*(\.\w{2,3})+$/).test($email);
        var isValidPassword = validString($password,false);
        var isValidPhone = (/^[0-9]{9,12}$/).test($phone);
        var isValidRePassword = ( $password != $re_password );


        $scope.reg_err_name = isValidName ? isValidName : "";
        $scope.reg_err_email = isValidEmail ? "" : "Bạn Phải Nhập Định Dang Email";
        $scope.reg_err_pass = isValidPassword ? isValidPassword : "";
        $scope.reg_err_re_pass = !isValidPassword && !isValidRePassword ? "" : "Passwword Nhập Lại Không Khớp";
        $scope.reg_err_phone = isValidPhone ? "" : "Bạn Phải Nhập Đinh Dạng Số Điện Thoại";

        if(isValidName || !isValidEmail || isValidPassword || isValidRePassword || !isValidPhone){
            return;
        }

        var $param = {name:$name,email:$email,password:$password,phone : $phone};

        $http.post(base_url("user/add/"), $.param($param)).then(function($response){

            var $res = $response.data;

            $scope.reg_err_name = $res.username != undefined ? $res.username : "";
            $scope.reg_err_email = $res.email != undefined ? $res.email : "";
            $scope.reg_err_phone = $res.phone != undefined ? $res.phone : "";

            if($res.success != undefined){
                $("#login_register #register").removeClass("active in");
                $("#login_register #success").addClass("active in");
            }else if($res.failed != undefined){
                alert("Đã có lỗi xảy ra Vui Lòng Thử Lại Sau");
            }
        });
    }

    $scope.forgetPassword  = function(){

        var $email = $scope.forget_email != undefined ? $scope.forget_email : "";
        var isValidEmail = (/^\w+([\.-]?\w+)*@([\.-]?\w+)*(\.\w{2,3})+$/).test($email);

        if(!isValidEmail){
            $scope.forget_err_email = "Email Không Hợp Lệ";
            return;
        }

        $http.post(base_url("user/checkEmail/"), $.param({email : $email})).then(function($response){

            if($response.data.email != undefined){
                $scope.forget_err_email = $response.data.email;
                return;
            }

            $scope.forget_err_email = "";
            $("#forget_password_div #loading").show();

            $http.post(base_url("user/setPassword/"), $.param({email: $email})).then(function ($response) {
                var $res = $response.data;

                $("#forget_password_div #loading").css("padding","0 10px");

                if ($res.success != undefined) {
                    $("#forget_password_div #loading").html(
                        "<h4 class='text'>Một email đã đươc gửi tới địa chỉ email của bạn hãy "+
                        "đăng nhập vào email để nhận mật khẩu mới của bạn"+
                        "<a href='https://mail.google.com/mail/'> &nbsp;<b>Your Email</b> </a></h4>"
                    );
                } else {
                    $("#forget_password_div #loading").html(
                        "<h4 class='text'>rất tiếc đã có lỗi xảy ra chúng tôi không thể"+
                        "gửi email đến email của bạn.Vui Lòng Thử Lại Sau</h4>");
                }
            });
        });
    }
});

/**
 * Ham Xu ly trong form cap nhat thong tin ca nhan
 */
function profile(){
    $("#profile a").click(function(e){
        e.preventDefault();
        $(this).siblings("div").slideToggle(300);
    });

    $("button[name^='btn-submit']").click(function(){

        $("div[id^='err_']").html("");
        var $btn = $(this).attr("name");
        var $data  = {}, $ele = "";

        if($btn == "btn-submit-password"){
            $ele = $(this).siblings("input");
            for(var i = 0; i < $ele.length; i++){
                $data[$($ele[i]).attr("name")] = $($ele[i]).val();
            }
        }else{
            $ele = $(this).parent().siblings();
            var name = $ele.attr("name");
            $data[name] = $ele.val()
        }
        $data[$btn] = $btn;
        var url = window.location.href;
        $.post(url,$data,function(res){

            if(res.has_error != undefined){
                if($btn != "btn-submit-password"){
                    $("#lab-"+name).html($ele.val());
                    $("#accountName a").html($ele.val());
                    $ele.val("");
                    $("#err_"+name).html("");
                }else{
                    $("div[id$='_password']").html("");
                    $("#err_cof_new_password").html("Bạn Đã Thay Đổi Mật Khẩu Thành Công");
                }
            }else{
                for(var key in res){
                    console.log(res[key]);
                    $("#err_"+key).html(res[key]);
                }
            }
        },"json");
    });
}