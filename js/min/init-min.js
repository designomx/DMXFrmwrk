FRMWRK.main=function($){var e=function(){!function(e){var i=/iPhone/i,n=/iPod/i,o=/iPad/i,t=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,d=/Android/i,l=/IEMobile/i,a=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,c=/BlackBerry/i,r=/BB10/i,s=/Opera Mini/i,b=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,u=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),f=function(e,i){return e.test(i)},h=function(e){var h=e||navigator.userAgent;return this.apple={phone:f(i,h),ipod:f(n,h),tablet:f(o,h),device:f(i,h)||f(n,h)||f(o,h)},this.android={phone:f(t,h),tablet:!f(t,h)&&f(d,h),device:f(t,h)||f(d,h)},this.windows={phone:f(l,h),tablet:f(a,h),device:f(l,h)||f(a,h)},this.other={blackberry:f(c,h),blackberry10:f(r,h),opera:f(s,h),firefox:f(b,h),device:f(c,h)||f(r,h)||f(s,h)||f(b,h)},this.seven_inch=f(u,h),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},p=function(){var e=new h;return e.Class=h,e};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=h:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=p():"function"==typeof define&&define.amd?define("isMobile",[],e.isMobile=p()):e.isMobile=p()}(this)},i=$(window).width(),n=$(window).height(),o=function(){$("#modalID").nifty("show"),$(".md-close").bind("click",function(){$("#modalID").nifty("hide")})},t=function(){$(".clickme").click(function(){$("#conect-action-btn").fadeOut(250),$(".not-connected").hide(),$("body").toggleClass("body-no-overflow"),$("#url-modal").animate({top:"0",height:"100%"},500,function(){$(".url-modal-close").toggleClass("opened-url")})}),$(".url-modal-close").click(function(){$(".url-modal-close").toggleClass("opened-url"),$("#url-modal").animate({top:"100%",height:"0"},500,function(){$(".not-connected").show(),$("body").toggleClass("body-no-overflow"),$("#conect-action-btn").fadeIn(250)})})},d=function(){$(".clampedauto").each(function(e,i){$clamp(i,{clamp:3,useNativeClamp:!0})})},l=function(){$(".login-btn-bx").bind("click",function(){$(this).hide(),$("#register-form-tab").hide(),$("#login-form-tab,.registro-btn-bx").show()}),$(".registro-btn-bx").bind("click",function(){$(".login-btn-bx,#register-form-tab").show(),$("#login-form-tab").hide()}),$(".cancel-btn-bx").bind("click",function(){$(".md-login-overlay").fadeOut(500,function(){$("#register-form-tab,#login-form-tab").hide(),$(".login-btn-bx,.registro-btn-bx").show()})}),$(".validate-prze").bind("click",function(e){e.preventDefault(),$("#logedin-modal-bx").slideUp(),$("#validate-modal-bx").slideDown()}),$(".cancel-valdtn").bind("click",function(e){e.preventDefault(),$("#logedin-modal-bx").slideDown(),$("#validate-modal-bx").slideUp()}),$(".close-valdtn").bind("click",function(e){e.preventDefault(),$(".md-logedin-overlay").fadeOut()})},a=function(){$(".close-product").bind("click",function(){var e=confirm("¿Estas seguro de cerrar esta ventana? Si la cierras sin avisar a tu anfitrión, es probable que pierdas tu recompensa.");1==e&&($(".materialized-prize").fadeOut(),$("body").toggleClass("body-no-overflow"))})},c=function(){$(window).resize(function(){})},r=function(){};return{init:function(){e(),o(),t(),d(),l(),a(),c()}}}(jQuery);