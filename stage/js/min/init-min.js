FRMWRK.main=function($){var i=function(){!function(i){var e=/iPhone/i,t=/iPod/i,n=/iPad/i,o=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,a=/Android/i,r=/IEMobile/i,l=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,s=/BlackBerry/i,d=/BB10/i,c=/Opera Mini/i,u=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,f=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),h=function(i,e){return i.test(e)},p=function(i){var p=i||navigator.userAgent;return this.apple={phone:h(e,p),ipod:h(t,p),tablet:h(n,p),device:h(e,p)||h(t,p)||h(n,p)},this.android={phone:h(o,p),tablet:!h(o,p)&&h(a,p),device:h(o,p)||h(a,p)},this.windows={phone:h(r,p),tablet:h(l,p),device:h(r,p)||h(l,p)},this.other={blackberry:h(s,p),blackberry10:h(d,p),opera:h(c,p),firefox:h(u,p),device:h(s,p)||h(d,p)||h(c,p)||h(u,p)},this.seven_inch=h(f,p),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},b=function(){var i=new p;return i.Class=p,i};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=p:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=b():"function"==typeof define&&define.amd?define("isMobile",[],i.isMobile=b()):i.isMobile=b()}(this)},e=$(window).width(),t=$(window).height(),n=function(){$(".button-collapse").sideNav(),$("select").material_select(),$(".modal-trigger").leanModal(),$(".tooltipped").tooltip(),$(".dropdown-right").dropdown({inDuration:300,outDuration:225,constrain_width:!1,hover:!1,alignment:"right",gutter:10}),$(".dropdown-left").dropdown({inDuration:300,outDuration:225,constrain_width:!1,hover:!1,alignment:"left",gutter:10}),$(".dropdown-right-hover").dropdown({inDuration:300,outDuration:225,constrain_width:!1,hover:!0,alignment:"right",gutter:10}),$("ul.tabs").tabs(),$(".charCountTW").characterCounter({limit:"140",counterFormat:"Caracteres restantes: %1"});var i=300,e=999999,t=700,n=$(".cd-top");$(window).scroll(function(){$(this).scrollTop()>i?n.addClass("cd-is-visible"):n.removeClass("cd-is-visible cd-fade-out")}),n.on("click",function(i){i.preventDefault(),$("body,html").animate({scrollTop:0},t)}),isMobile.any&&$("ul li a").on("click touchend",function(i){var e=$(this),t=e.attr("href");window.location=t}),$(".rate-btn").bind("click",function(i){i.preventDefault(),$(this).find(".fa-star-o")&&$(this).find(".fa-star-o").removeClass("fa-star-o").addClass("fa-star")}),$(".jslink").click(function(i){i.preventDefault()})},o=function(){var i={lines:9,length:12,width:8,radius:18,corners:1,rotate:0,direction:1,color:"#ffffff",speed:1.2,trail:60,shadow:!1,hwaccel:!1,className:"loadingSpinner",zIndex:2e9,top:"40%",left:"50%"},e=document.createElement("div");document.body.appendChild(e);var t=new Spinner(i).spin(e),n=iosOverlay({text:"Cargando",spinner:t});return window.setTimeout(function(){n.update({icon:"images/assets/check.png",text:"Listo"})},1e3),window.setTimeout(function(){n.hide()},2e3),!1},a=function(){var i=$("body").height(),e=$(window).height(),t=e-i;e>i?$("footer").addClass("stickFoot"):$("footer").removeClass("stickFoot"),$(window).bind("load",function(){var i=$("body").height(),e=$(window).height(),t=e-i;e>i?$("footer").addClass("stickFoot"):$("footer").removeClass("stickFoot")})},r=function(){var i=$(".widget-wrapper").outerWidth();$(".widget-wrapper").css("margin-left",i/2*-1)},l=function(){$(window).resize(function(){a(),r()})},s=function(){$(".tabs li").bind("click",function(){$(".tabs > li").removeClass("blue-grey lighten-5"),$(this).addClass("blue-grey lighten-5"),a()}),$(".tabs, .tabs li a").bind("click",function(){a()})},d={dir1:"down",dir2:"right",push:"top",spacing1:0,spacing2:0},c=function(i,e){if("undefined"!=typeof PNotify){var t={title:"Atención",text:i,addclass:"stack-topleft alertBox blackAlertBx",styling:"fontawesome",cornerclass:"",width:"100%",stack:d};switch(e){case"error":t.title="Error",t.type="error";break;case"info":t.title="Atención",t.type="info";break;case"success":t.title="¡Hecho!",t.type="success"}new PNotify(t)}else alert(i)},u=function(){$("#login-bx").addClass("magictime swashIn"),$(".navbar-fixed.aniMagic").addClass("animated bounceInDown")},f=function(){var i=0;$(".plan-box").each(function(){i+=$(this).outerWidth(!0)}),$(".products-box").width(i).css("min-width",860)},h=function(){var i=0;$(".active-selection").each(function(){i+=$(this).outerWidth(!0)}),$(".products-box").width(i).css("min-width",0)},p=function(){var i=$(window).height(),e=$("#blog-module").outerHeight();$("#blog-module").css("margin-top",i-20),$("#contact-module").css("margin-top",i-310),$(".side-bar-bx").height(e-185),$(".reload-button-bx a").bind("mouseover",function(){$(".reload-button-bx a i").toggleClass("fa-spin")}),$(".reload-button-bx a").bind("mouseout",function(){$(".reload-button-bx a i").toggleClass("fa-spin")}),$(".plan-box").bind("click",function(){$(this).toggleClass("active-selection")}),$(".scroll-box").mCustomScrollbar({axis:"x",theme:"minimal",updateOnContentResize:!0});var t=0;$(".cellplan").click(function(){$("div").filter($(".nocell")).fadeToggle("500",function(){3>=t?(h(),t++):t>=4&&(t++,f(),t>=8&&(t=0));var i=$(".scroll-box").outerWidth();$("#mCSB_1_container").outerWidth(i)})}),$(".streaming").click(function(){$("div").filter($(".nostreaming, .cellplan")).fadeToggle("500",function(){3>=t?(h(),t++):t>=4&&(t++,f(),t>=8&&(t=0));var i=$(".scroll-box").outerWidth();$("#mCSB_1_container").outerWidth(i)})}),$(".tripleplay1, .tripleplay2, .tripleplay3").click(function(){var i=$(".active-selection.tripleplay1").length,e=$(".active-selection.tripleplay2").length,t=$(".active-selection.tripleplay3").length,n=i+e+t;1==n?$("div").filter($(".streaming, .cellplan")).fadeOut("500",function(){$(".products-box").width(500).css("min-width",500);var i=$(".scroll-box").outerWidth();$("#mCSB_1_container").outerWidth(i).css("min-width",500)}):2==n||3==n||0==n&&$("div").filter($(".streaming, .cellplan")).fadeIn("500",function(){var i=$(".scroll-box").outerWidth();$(".products-box").width(860).css("min-width",860),$("#mCSB_1_container").outerWidth(860).css("min-width",i)})})},b=function(){var i=setInterval(function(){$(".home-hero .hero-image.active-slide").fadeToggle(1e3)},8e3)},w=function(){isMobile.any&&($("select").addClass("browser-default"),$(".paq-bx").addClass("mobile-scroll"))},m=function(){function i(){$("#slide-in-banner").slideDown()}function e(){$("#slide-in-banner").slideUp()}$("#slide-in-banner").hide(),setTimeout(i,1e4),setTimeout(e,17e3),$("#slide-in-banner .close-modal-btn").bind("click",function(){$("#slide-in-banner").slideUp()})},v=function(){var i=0;$(window).scroll(function(){var e=$(".blog-timeline-bx").offset().top-$(window).scrollTop();-225>=e&&e>=-300&&0==i&&($(".timeline-banner").slideDown(),$("#embed01")[0].src+="&autoplay=1",i=1)})},g=function(){$(window).scroll(function(){var i=$(".filter-mid-bar").offset().top-$(window).scrollTop(),e=$(".home-hero").offset().top-$(window).scrollTop();65>i?$("#main-nav-bar").slideUp():i>65&&$("#main-nav-bar").slideDown(),0>=i&&($(".filter-mid-bar").addClass("fixed-filter-cl"),$("#compare-tools").addClass("fixed-filter-ct")),e>-583&&($(".filter-mid-bar").removeClass("fixed-filter-cl"),$("#compare-tools").removeClass("fixed-filter-ct"))})},x=function(){$("#modal-comparador .close-modal-btn").bind("click",function(){$("#modal-comparador").animate({top:"100%"},1e3,function(){$("#modal-comparador").hide()})})},y=function(){};return{init:function(){i(),n(),u(),o(),s(),a(),p(),f(),r(),b(),w(),m(),$("#slide-in-banner").hide(),v(),g(),x(),l()},notificacion:function(i,e){c(i,e)}}}(jQuery);