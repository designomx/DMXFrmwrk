BARCRTSA.main=function($){var o=function(){$(".animated-post").css({top:"100%",width:"100%"}),$(".col-xs-6 a").bind("click",function(o){$("body, html").addClass("force-no-overflow"),$(this).parent(".col-xs-6").find(".materialized-post:first").stop(!0,!1).animate({top:0,opacity:1},0).addClass("opened-bx")}),$(".close-product").bind("click",function(o){$(".opened-bx").stop(!0,!1).animate({top:"100%",opacity:0},0,function(){$("body, html").removeClass("force-no-overflow"),setTimeout(function(){$(".animated-post .opened-bx").stop(!0,!1).animate({opacity:0},500,function(){$(".animated-post .opened-bx").removeClass("opened-bx"),$(".animated-post").css("top",0)})},500)})})},t=function(){$(window).resize(function(){})},n=function(){};return{init:function(){o(),t()}}}(jQuery);