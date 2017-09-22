$(document).ready(function(){
    // ham xu ly silde tai phan view san pham
    view_slide();

    // ham xu ly lua chon mau sac,kich thươc san pham
    handler_choose_option("p-color-item");
    handler_choose_option("p-size-item");

    // ham lay ra so luong san pham ung voi mau sac va kich thuoc.
    getQtyProduct();

    // goi toi ham xu ly su kien nhan nut tra loi comment.
    handlerReply();

    // ham xu ly them vao gio hang.
    addCartHandling();

    // ham kiem tra tinh hơp le so lương san pham ngươi dung nhap vao.
    checkQty();

    // ham su ly khi nhan nut mua ngay.
    handlingButtonBuyNow();

    // ham xu ly khi nhan nut danh gia  san pham
    rating();

    set_width();

    $(window).resize(function(){
        set_width();
    });

});


function view_slide(){

    $("#product-slider").owlCarousel({
        loop : true,
        nav : false,
        responsive : {
            0:{
                items : 1
            }
        },
        dotsContainer: '#carousel-custom-dots'
    });
    var owl = $("#product-slider").owlCarousel();
    $('.owl-dot').hover(function () {
        owl.trigger('to.owl.carousel', [$(this).index(), 300]);
        $(".owl-dot").css("border","1px solid transparent");
        $(this).css("border","1px solid #004444");
    });
}

function handler_choose_option(type){

    $("."+type).click(function(){
        $("."+type).css("border","none");
        $("."+type).removeClass("isSelected");
        $("."+type+" .icon-check").css("transform","scale(0)")
        $(".icon-check",this).css("transform","scale(1)")
        $(this).css("border","2px solid red");
        $(this).addClass("isSelected");
    });
}


function getQtyProduct(){

    $(".p-size-item,.p-color-item").click(function(){

        var colorId = getColorId();
        var sizeId = getSizeId();

        if(colorId  && sizeId){

            $.post(base_url("product/getQtyProduct/"),{colorId : colorId, sizeId : sizeId},function(res){
                if(res){

                    $("#p-qty").html("Chỉ Còn "+res+" Sản Phẩm");
                    $("#p-input-qty").attr("max",res);
                    $("#p-input-qty").prop("disabled",false);
                }else{
                    $("#p-qty").html("Chỉ Còn 0 Sản Phẩm");
                    $("#p-input-qty").prop("disabled",true);
                }
            },"text");
        }
    });
}

// ham xu ly su kien khi nhan nut tra loi comment
function handlerReply(){
    setTimeout(function(){
        $(".footer-comment .reply").click(function(){
            $(this).siblings(".inputReply").slideToggle(200);
        });
    },1000);
}


// ham xu ly su kien khi nhat nut then vao gio hang.
function addCartHandling(){

    $("#btn-add").click(function(){

        if(!validData()){
            return;
        };

        $(this).parent().attr("action",base_url("cart/add/")).submit();
        return false;
    })
}

// load comments by angular js
angular.module('commentModule',[]).controller('commentCtrl',function($scope,$http){

    // get product id
    var $productId  = getProductId();

    //set Content-Type
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8'

    // send httpRequest to get comments from server.
    var $param = {productId : $productId};
    $http.post(base_url('comment/getComments/'),$.param($param)).then(function($response){

        $scope.comments = $response.data;
    });

    /**
     *
     * @param id  -- ma cua cau hoi
     * @param event
     */
    $scope.addComment = function(id,event){

        var $id = ( id == undefined ) ? 0 : id;
        var ele  = event.currentTarget;
        var $txt_comment = $(ele).siblings("#txtComment");
        var $txt_user = $(ele).siblings("#txtNameComment").children();
        var $content = $txt_comment.val();
        var $userComment = $txt_user.val();

        var $param = {question_id : $id, content : $content, user_comment : $userComment, product_id : getProductId()}
        $http.post(base_url("comment/addComment/"), $.param($param)).then(function($response){

            if($response.data.error != undefined){
                alert($response.data.error);
            }else{
                $scope.comments = $response.data;
                if(id){
                    handlerReply();
                }
                $txt_comment.val('');
                $txt_user.val('');
            }
        });
    }
});


// function get product id
function getProductId(){
    var uri = window.location.href;
    var $productId = parseInt(uri.match(/p([0-9]+)/)[1]);
    return $productId;
}

// function get color id
function getColorId(){
    var colors = $("div[class^='p-color-item']").filter(".isSelected");
    var colorId = colors.attr("id");

    return colorId == undefined ? 0 : parseInt(colorId);
}

// function get size id
function getSizeId(){
    var size = $("div[class^='p-size-item']").filter(".isSelected");
    sizeId = size.attr("id");
    return sizeId == undefined ? 0 : sizeId;
}


// function check valid input qty
function checkQty(){

   var inputQty = document.getElementById("p-input-qty");

    inputQty.onblur = function(){
        if(!inputQty.checkValidity()){
            $("#p-qty").html("Số Lượng sản phẩm bạn chọn quá lớn");
        }else{
            if(parseInt(inputQty.value)){
                $("#p-qty").html("");
            }
        }
    }
   return inputQty.checkValidity();
}

// ham su ly khi nhan nut mua ngay.
function handlingButtonBuyNow(){

    $("#btn-buy").click(function(){

        if(!validData()){
            return;
        }

        $(this).parent().attr("action",base_url("order/checkOut/")).submit();
        return false;
    });
}


function validData(){

    // get product id
    var $productId  = getProductId();
    var $colorId = getColorId();
    var $sizeId = getSizeId();

    var $qty = $('#p-input-qty').val();

    $qty = !$qty || !checkQty() ? 0 : parseInt($qty);

    //console.log($productId + "-"+$colorId + "-"+$sizeId + "-"+$qty);

    if(!$productId || !$colorId || !$sizeId || !$qty){

        alert("Bạn Chưa Nhập Thông Tin Hoặc thông Tin Không Hợp Lệ");
        return false;
    }


    $("#inputProductId").val($productId);
    $("#inputColorId").val($colorId);
    $("#inputSizeId").val($sizeId);

    return true;
}
window.onload = function(){
    angular.bootstrap(document.getElementById("login_register"),["appLogin"]);
}

function rating(){
    $.fn.raty.defaults.path = base_url("public/site/raty/img");
    $('.rating_detail').raty({
        score: function() {
            return $(this).attr('data-score');
        },
        half    : true,
        width : 235,
        click: function(score, evt) {
            var id = $(this).attr("id");
            var rate_count = $('.rate_count');
            var rate_count_total = rate_count.text();
            $.ajax({
                url: base_url("product/rating/"),
                type: 'POST',
                data: {'id':id,'score':score},
                dataType: 'json',
                success: function(data)
                {
                    if(data.complete)
                    {
                        var total = parseInt(rate_count_total)+1;
                        rate_count.html(parseInt(total));
                    }
                    alert(data.msg);
                }
            });
        }
    });
}


function set_width() {
    var window_width = $(window).innerWidth();
    if(window_width <= 425) {
        var width = 0;
        width = (window_width - 30)+4;
        $("#carousel-custom-dots").css("width",""+(width));
        var li_width, li_height
        li_width = li_height = parseFloat(width / 5);
        $("#carousel-custom-dots li").css({"width": "" + (li_width), "height": (li_height)});
    }
}


