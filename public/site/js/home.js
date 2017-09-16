$(function() {
    //phan slide/
    $("#banner_top_slide").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
        autoplay: true,
        autoplayTimeout : 6000,
        loop : true,
        responsive: true,
        onInitialized: callback
    });

    function callback() {
        let ele = getElement(1);
        animate(ele.h1, "lightSpeedIn", "lightSpeedOut");
        animate(ele.my_tag_a, "slideInDown", "slideOutDown");
    }

    $("#banner_top_slide").on('changed.owl.carousel', function(event) {
         var item = event.item.index - 1;     // Position of the current item
        // $('h1').removeClass('animated bounce');
        // $('.owl-item').not('.cloned').eq(item).find('h1').addClass('animated bounce');
        if(item == 1){
            callback();
        }else if(item == 2) {
            let ele = getElement(2);
            animate(ele.h1, "rotateIn", "rotateOut");
            animate(ele.p, "fadeInLeft", "fadeOutLeft");
            animate(ele.my_tag_a, "zoomIn", "zoomOut");
        }else {
            let ele = getElement(3);
            animate(ele.h1, "rollIn", "rollOut");
            animate(ele.p, "fadeInRightBig", "fadeOutLeftBig");
            animate(ele.my_tag_a, "bounceInLeft", "bounceOutRight");
        }

    });

    /** phan slide list post */
    $('#list_post_slide').owlCarousel({
        loop: true,
        margin:10,
        nav:true,
        dots : false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    $(".owl-carousel").filter(".tab-content-item").owlCarousel({
        loop : true,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $('.owl-prev,.owl-next').html("");

    /* Xu ly xu kien khi click cac tab*/
    $("#list-product #tab-list li").click(function () {
        $("#list-product #tab-list li").removeClass("active").children().css("color", "black");
        $(this).addClass("active");

        show_list_product();
    });

    show_list_product();

    $(".item").hover(function(){
        hoverEffect($(this).find(".list-action").children(),'add','list-action-effect');
    },function(){
        hoverEffect($(this).find(".list-action").children(),'remove','list-action-effect');
    })
    rating();
});


function show_list_product(){

    var lis = $("#list-product #tab-list li");

    $(lis).each(function(k,v){
        if($(v).hasClass("active")) {
            $(v).children().css("color", "#ff5959");

            $ele = $("#tab-content-" + $(v).attr("id"));
            var $childs = $($ele).siblings(".tab-content-item");
            $childs.hide();
            $("#tab-content-" + $(v).attr("id")).show();
            hoverEffect($("#tab-content-" + $(v).attr("id")).children(),'add','hoverEffect')
        }
    });
}

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

function animate($elem, $animate_in, $animate_out, $time_to = 1000, $time_out = 4000) {
    if($(window).innerWidth() <= 425){
        return
    }

    if($elem.hasClass($animate_out)){
        $elem.removeClass($animate_out);
    }
    setTimeout(()=> {
        $elem.addClass($animate_in);
    },$time_to);
    setTimeout(()=> {
        $elem.removeClass($animate_in).addClass($animate_out);
    },$time_out);
}


function getElement($id) {
    let caption = $("#banner_top_slide #slide_"+$id+" .caption");
    let h1 = caption.find("h1");
    let p = caption.find("p");
    let my_tag_a = caption.find("a");
    return {"h1" : h1, "p" : p, "my_tag_a" : my_tag_a};
}
