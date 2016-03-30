/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

FRMWRK.main = (function($) {

	//isMobile////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	var _isMobileInit = function() {
			!
			function(a) {
				var b = /iPhone/i,
					c = /iPod/i,
					d = /iPad/i,
					e = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,
					f = /Android/i,
					g = /IEMobile/i,
					h = /(?=.*\bWindows\b)(?=.*\bARM\b)/i,
					i = /BlackBerry/i,
					j = /BB10/i,
					k = /Opera Mini/i,
					l = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,
					m = new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)", "i"),
					n = function(a, b) {
						return a.test(b)
					},
					o = function(a) {
						var o = a || navigator.userAgent;
						return this.apple = {
							phone: n(b, o),
							ipod: n(c, o),
							tablet: n(d, o),
							device: n(b, o) || n(c, o) || n(d, o)
						}, this.android = {
							phone: n(e, o),
							tablet: !n(e, o) && n(f, o),
							device: n(e, o) || n(f, o)
						}, this.windows = {
							phone: n(g, o),
							tablet: n(h, o),
							device: n(g, o) || n(h, o)
						}, this.other = {
							blackberry: n(i, o),
							blackberry10: n(j, o),
							opera: n(k, o),
							firefox: n(l, o),
							device: n(i, o) || n(j, o) || n(k, o) || n(l, o)
						}, this.seven_inch = n(m, o), this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch, this.phone = this.apple.phone || this.android.phone || this.windows.phone, this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet, "undefined" == typeof window ? this : void 0
					},
					p = function() {
						var a = new o;
						return a.Class = o, a
					};
				"undefined" != typeof module && module.exports && "undefined" == typeof window ? module.exports = o : "undefined" != typeof module && module.exports && "undefined" != typeof window ? module.exports = p() : "function" == typeof define && define.amd ? define("isMobile", [], a.isMobile = p()) : a.isMobile = p()
			}(this);
		};

	//VARIABLES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	//Calculo el ancho y alto del documento
	var _anchoWindow = $(window).width();
	var _altoWindow = $(window).height();


	//INDEX::FILE////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	
	var _modalOnLoad = function() {
		$("#modalID").nifty("show");
					  		
		$('.md-close').bind('click', function() {
			$("#modalID").nifty("hide");
		});
	}
	
	var _URLModalActions = function() {
		$( ".clickme" ).click(function() {
		  $('#conect-action-btn').fadeOut(250);
		  $('.not-connected').hide();
		  $('body').toggleClass('body-no-overflow');
		  $( "#url-modal" ).animate({
		    top: "0",
		    height: "100%"
		  }, 500, function() {
		    $('.url-modal-close').toggleClass('opened-url');
		  });
		});
		
		$( ".url-modal-close" ).click(function() {
		  $('.url-modal-close').toggleClass('opened-url');
		  $( "#url-modal" ).animate({
		    top: "100%",
		    height: "0"
		  }, 500, function() {
		  	$('.not-connected').show();
		    $('body').toggleClass('body-no-overflow');
		    $('#conect-action-btn').fadeIn(250);
		  });
		});
	}
	
	var _productsClamp = function() {
		$('.clampedauto').each(function(index, element) {
		    $clamp(element, {clamp: 3, useNativeClamp: true});
		});
	}
	
	var _wifiLogInBx = function() {
		$('.login-btn-bx').bind('click',function() {
			$(this).hide();
			$('#register-form-tab').hide();
			$('#login-form-tab,.registro-btn-bx').show();
		});
		
		$('.registro-btn-bx').bind('click',function() {
			$('.login-btn-bx,#register-form-tab').show();
			$('#login-form-tab').hide();
		});
		
		$('.cancel-btn-bx').bind('click',function() {
			$('.md-login-overlay').fadeOut(500,function() {
				$('#register-form-tab,#login-form-tab').hide();
				$('.login-btn-bx,.registro-btn-bx').show();
			});
		});
		
		$('.validate-prze').bind('click',function(ev) {
			ev.preventDefault();
			$('#logedin-modal-bx').slideUp();
			$('#validate-modal-bx').slideDown();
		});
		
		$('.cancel-valdtn').bind('click',function(ev) {
			ev.preventDefault();
			$('#logedin-modal-bx').slideDown();
			$('#validate-modal-bx').slideUp();
		});
		
		$('.close-valdtn').bind('click',function(ev) {
			ev.preventDefault();
			$('.md-logedin-overlay').fadeOut();
		});
		
	};
		
	//CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////

	var _reSizeWindow = function() {
		$(window).resize(function() {
		});
	};


	//FIN CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	var _baseTemplate = function() {};


	return {
		init: function() {
			_isMobileInit();
			_modalOnLoad();
			_URLModalActions();
			_productsClamp();
			_wifiLogInBx();
			_reSizeWindow();
		}
	};

})
(jQuery);