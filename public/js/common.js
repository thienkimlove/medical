(function($){
    var statusSearch = 0;
    var timeSearch = null;
    var delaySearch = 5000;

    var setMenuMobile = function(){
        $("#btn-menu").on("click",function(){
            if($("body").hasClass("show-menu")){
                closeMenuMobile();
            }else{
                $("body").addClass("show-menu");
                var height_device = $(window).height();
//                var width_device = $(window).width();
                var padding_menu = 30;
               /* if(width_device < 640){
                    padding_menu = 45;
                }*/
                var height_menu = $("#menu-mobile .inner").height() + padding_menu;
                /*if(height_menu <= height_device){
                    height_menu = height_device;
                }*/
                $("#wrapper").css({height: height_menu});
                $("#overlay").css({display: "block"});
            }
        });
    };

    var resetMenuMobile = function(){
        $("#overlay").on("click",function(){
            closeMenuMobile();
        });
    };
    var closeMenuMobile = function(){
        $("body").removeClass("show-menu");
        $("#wrapper").removeAttr("style");
        $("#overlay").css({display: "none"});
    };

    var checkSearch = function(){
        if(statusSearch == 0){
            window.clearTimeout(timeSearch);
            timeSearch = window.setTimeout(function(){
                $("#box-search").stop().animate({width: 230});
            },0);
        }else{
            window.clearTimeout(timeSearch);
            timeSearch = window.setTimeout(function(){
                $("#box-search").stop().animate({width: 30});
            },delaySearch);
        }
    };

    var changeSearch = function(){
        $("#box-search").hover(function(){
            checkSearch();
            statusSearch = 1;
        },function(){
            checkSearch();
            statusSearch = 0;
        });
    };

    var slideHomepage = function(){
        $('#slide-homepage').owlCarousel({
            loop:true,
            margin:0,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:1,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:1,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };

    var equalHeight = function(selector) {
        minheight = 0;
        $(selector).each(function() {
            thisheight = $(this).height();
            if (thisheight > minheight) {
                minheight = thisheight
            }
        });
        minheight = minheight + 2;
        $(selector).css("min-height", minheight)
    };
    
    //accordionMobile
    $(".title-mobile").addClass("deactive");

    //ACCORDION BUTTON ACTION
    $('.title-mobile').click(function() {
        
        $(this).siblings('.active')
            .removeClass('active')
            .addClass('deactive');

        if($(this).next().is(':visible')) {
            $('.box-media').slideUp('normal');
              $(this).addClass("deactive").removeClass("active");

        } else {
            $('.box-media').slideUp('normal');    
            $(this).next().slideDown('normal');
            $(this).removeClass("deactive").addClass("active"); 

        }
    });





    jQuery(document).ready(function() {
        changeSearch();
        setMenuMobile();
        resetMenuMobile();
        slideHomepage();
    });
})(jQuery);

