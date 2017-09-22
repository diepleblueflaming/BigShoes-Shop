/**
 * Created by Administrator on 2/27/2017.
 */
$(document).ready(function(){

    $(".category .cat-title a").click(function(){
        $(this).children().toggleClass("icon-rotate");
    });

    $("#filterProduct").change(function(){

        $(this).parent().submit();
        return false;
    });


    // ham xu ly su kien loc gia san pham.
    $("select[class*='filterPriceInput']").change(function(){

        var $to = $("#filterPrice-to").val();
        var $from = $("#filterPrice-from").val();

        if($to && $from != "undefined"){
            $(this).parents("form").submit();
            return false;
        }
    });

    $(".item").hover(function(){
        hoverEffect($(this).find(".list-action").children(),'add','list-action-effect');
    },function(){
        hoverEffect($(this).find(".list-action").children(),'remove','list-action-effect');
    })
    rating();
})


function hoverEffect($list,$type,$class){

    var timeEffect = 300;
    $($list).each(function($key,$val){

        setTimeout(function(){
            if($type == "add"){
                $($val).addClass($class);
            }else{
                $($val).removeClass($class);
            }
        },timeEffect);

        timeEffect += 200;
    });
}

function rating(){
    $.fn.raty.defaults.path = base_url("public/site/raty/img");
    $('.raty').raty({
        score: function () {
            return $(this).attr('data-score');
        },
        width : 115,
        readOnly: true
    });
}
