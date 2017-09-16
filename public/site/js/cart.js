/**
 * Created by Administrator on 3/27/2017.
 */
$(function(){
    setTimeout(function(){
        cart_handler();

        handlerSelect("color");
        handlerSelect("size");
    },500);

    $("#btn-cart-back").click(function(){
        window.history.back();
    })
});

function cart_handler(){

    $(window).click(function(event){

        $ele = $(event.target);
        if($ele.hasClass("active")) {
            $("div[class^='list']").hide();
            $($ele).siblings("div[class^='list']").show();
        }else{
            $("div[class^='list']").hide();
        }

    });
}

function handlerSelect($type){

    $("."+$type).not($(".active")).click(function(){
        var id = $(this).attr("id");
        $ele = $(this).parent().siblings("."+$type).filter(".active");
        //console.log($ele);
        if($type == "color"){
            var backgroundColor = id.match(/[a-zA-Z]+/g)[0];
            $ele.css("background-color",backgroundColor);
        }else if ($type == "size"){
            var size = $(this).html();
            $ele.html(size);
        }
        $ele.attr("id",id);
    })
}

var app = angular.module('appCart',['ngAnimate']);

app.controller('myCtrl',function($scope,$http){

    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8'

    $scope.total = 0;
    $http.get(base_url('cart/getCarts/')).then(function($response){
        console.log($response.data.carts);
        $scope.carts = $response.data.carts;
        $scope.check = angular.equals([],$scope.carts);
        $scope.total = getTotalPrice($scope);
    });

    $scope.delete = function(id){

        $param = {productId : id};
        $http.post(base_url('cart/delete/'), $.param($param)).then(function($response){
            $scope.carts = $response.data.carts;
            $scope.total = getTotalPrice($scope);
        });
    }

    $scope.changeData = function($productId,$data,$type){

        $param = {productId: $productId,type: $type,data : $data};

        $http.post(base_url('cart/update/'), $.param($param)).then(function($response){
            $scope.carts = $response.data.carts;
            $scope.total = getTotalPrice($scope);
        });
    }
});


function getTotalPrice($scope){
    var $total = 0;
    $($scope.carts).each(function($key,$val){
        for($it in $val){
            var price = $val[$it]['price'] * $val[$it]['qty'];
            $total += price;
        }
    });
    return $total;
}
