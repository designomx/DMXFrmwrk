TOOTH.webappVenue=function($){var n=function(){toast('<span class="left">&nbsp;&nbsp;¡Bienvenido!<span>',5e3,"")},e=function(){function n(){setTimeout(function(){$(".navbar-fixed nav").removeClass("animated slideInDown")},100)}var e=0;$(window).scroll(function(){var o=$(this).scrollTop();o>48?($(".navbar-fixed nav").addClass("animated slideOutUp"),e=1):96>o&&1==e&&($(".navbar-fixed nav").removeClass("animated slideOutUp"),$(".navbar-fixed nav").addClass("animated slideInDown"),$(".navbar-fixed nav").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",n),e=0),o>300?$(".fixed-action-btn").addClass("scrolledBtn"):300>=o&&$(".fixed-action-btn").removeClass("scrolledBtn")})},o=function(){$("section").css("background",function(){return $(this).data("color")}),$(".parallax-container").each(function(){$(this).css("background",$(this).attr("data-hero"))})},a=function(){$(".fixed-action-btn").bind("click",function(){$(".fixed-action-btn ul").css({display:"block"}),setTimeout(function(){$(".fixed-action-btn ul").fadeOut()},3e3)}),$(".fixed-action-btn").bind("mouseenter",function(){$(".fixed-action-btn ul").css({display:"block"}),setTimeout(function(){$(".fixed-action-btn ul").fadeOut()},3e3)}),$(".fixed-action-btn").bind("mouseleave",function(){$(".fixed-action-btn ul").fadeOut()})},i=function(){0==isMobile.any&&($(".sucursales-venue .browser-default").removeClass("browser-default"),$("select").material_select())},t=function(){$(".material-placeholder .materialboxed").on("click",function(){$(".overflow-on").addClass("overflow-off"),$(".overflow-off").removeClass("overflow-on"),l()})},l=function(){$("#materialbox-overlay, .scroll-slider-gallery .material-placeholder img").on("click",function(){$(".overflow-off").addClass("overflow-on"),$(".overflow-on").removeClass("overflow-off"),t()})},s=function(){};return{init:function(){n(),e(),a(),o(),i(),t()}}}(jQuery);