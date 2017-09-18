$(function(){
    set_color();
    $('[data-toggle="tooltip"]').tooltip();

    $("#btn-check-out").click(function(){
       window.location.href = base_url("cart");
    });

    showFormLogin();
    logout();
    add_to_cart();
    smooth_Scroll();
    menu_mobile_handling();
    // goi toi ham su ly su kien cuon trang cho menu top
    scroll_fixed();

    $("#btn_login_facebook").click(() => {
       login_facebook();
    });


    gapi.load("auth2", () => {
        "use strict";
        gapi.auth2.init({
            client_id : "832663098268-ean9j1occph4rb36m40rb440r15lghki.apps.googleusercontent.com",
            scope : "profile email"
        }).then((auth2) => {
            console.log('init');
            $("#btn_login_google").click(() => {
               login_gmail(auth2);
            });
            $("#logout_link").on("click",() => {
                let t = localStorage.getItem("type_login");
                if (t && t == "google"){
                    auth2.disconnect();
                    auth2.signOut().then(() => {
                        console.log("google logout");
                    });
                }
            });
        }, () => {

        });
    });
});

function base_url(url){
    return "http://diepledev.tk/"+url;
}

function set_color(){

    setTimeout(function(){
        var list = $(".p-color-item .color");

        $(list).each(function(k,v){
            var color = $(v).attr("id").match(/[a-zA-z]+/)[0];
            $(this).css("background",color);
        });
    },400);
}


function showFormLogin(){
    $("#login_link").click(function(){
        $("#overlay").show();
        $("#login_register").addClass("showForm");
    });

    $("#overlay").click(function(){
        $hideForm();
    });

    $hideForm = function(){
        $("#overlay").hide();
        $("#login_register").removeClass("showForm");
    }
}


function validString($str,$hasNumeric){
    if($str == ''){
        return "Bạn chưa nhập thông tin";
    }

    if(!$hasNumeric)
        var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?";
    else
        var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?1234567890";

    for (var i = 0; i < $str.length; i++) {
        if (iChars.indexOf($str.charAt(i)) != -1) {
            return "Chuỗi đã nhập có ký tự đặc biệt.Nhập Lại!!!";
        }
    }
    return false;
}


function logout(){
    $("#logout_link").click(function(){
        $.post(base_url("user/logout/"),{},function($res){
            $("#logout_link").hide();
            $("#login_link").css("display","inline");
            $("#accountName").css("display","none");
            window.location.reload();
        });
    });
}

/**
 * Ham xu ly them san pham moi vao gio hang
 */
function add_to_cart(){
    $("a i.add_to_cart").click(function(e){
        e.preventDefault();
    });
}

// ham xu ly su kien khi cuon trang.
function smooth_Scroll(){
    $(window).scroll(function(){
        // neu thanh cuon trang cach top > 50 hien thi nut quay len.
        if($(document).scrollTop() > 50){
            $("#to_top").css("transform","scale(1)");
        }
        else{
            // nguoc lai an di.
            $("#to_top").css("transform","scale(0)");
        }
    });

    // khi click vao thi quay ve top.
    $("#to_top").click(function(){
        $("html,body").animate({
            scrollTop:0
        },1000);
    });
}

function menu_mobile_handling(){
    var $menu = $("#mobile_menu .icon");
    $menu.click(function(){
        var $menu_container = $("#menu_mobile_container");
        $menu.toggleClass("change");
        if($menu_container.hasClass("open")){
            $menu_container.css("width","0");
            $menu_container.removeClass("open").addClass("close");
        }
        else if($menu_container.hasClass("close")){
            $menu_container.css("width","100%");
            $menu_container.removeClass("close").addClass("open");
        }
    });
}


// ham xu ly fixed cho top menu.
function scroll_fixed(){
    var width = $(window).innerWidth();
    if(width > 768){
        var ele = $("#nav-top");
        if(!ele.length){
            return;
        }
        var offset_top = (ele.offset().top);
        $(window).scroll(function(){
            if(($(document).scrollTop() > offset_top)){
                if(!$("#nav-top").hasClass("nav-top-fixed")){
                    $("#nav-top").addClass("nav-top-fixed");
                }
            }else if($(document).scrollTop() < offset_top){
                if($("#nav-top").hasClass("nav-top-fixed")){
                    $("#nav-top").removeClass("nav-top-fixed");
                }
            }
        });
    }
}

/*
    function login via facebook
 */
function login_facebook() {
    FB.login((response) => {
        "use strict";
        if (response.status == 'connected'){
            FB.api("/me",{locate : "vn_VN", fields : "name,email,gender"}, (res) => {
               send_data_to_server(res, base_url("/user/login_facebook/"), true);
               localStorage.setItem("type_login","facebook");
            });
        }else {

        }
    });
}

/*
    login via gmail
 */
function login_gmail(auth2) {
    auth2.signIn().then(() => {
        if (auth2.isSignedIn.get()) {
            var profile = auth2.currentUser.get().getBasicProfile();
            let params = {
                id: profile.getId(),
                name: profile.getName(),
                email : profile.getEmail()
            }
            send_data_to_server(params, base_url("user/login_google/"), true);
            localStorage.setItem("type_login","google");
        }
    });
}

function send_data_to_server($data, $server, $needReload) {
    $.post($server, $.param($data)).then((response) => {
        "use strict";
        if($needReload){
            //window.location.reload();
        }
    });
}
