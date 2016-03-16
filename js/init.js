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
		  $(this).fadeOut(250);
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
		    $('.clickme').fadeIn(250);
		  });
		});
	}
	
	var _productsClamp = function() {
		$('.clampedauto').each(function(index, element) {
		    $clamp(element, {clamp: 3, useNativeClamp: true});
		});
	}
		
<<<<<<< HEAD
	var _animacionInit = function() {
			$('#login-bx').addClass('magictime swashIn');
			$('.navbar-fixed.aniMagic').addClass('animated bounceInDown');
		};

	var _scrollResizer = function() {
			var planWidth = 0;
			$('.plan-box').each(function() {
				planWidth += $(this).outerWidth(true);
			});
			$('.products-box').width(planWidth).css('min-width', 860);
		};

	var _scrollPlansResizer = function() {
			var planWidthb = 0;
			$('.active-selection').each(function() {
				planWidthb += $(this).outerWidth(true);
			});
			$('.products-box').width(planWidthb).css('min-width', 0);
		};

	var _mainFileIndex = function() {

			var winH = $(window).height()

			var blogHbx = $('#blog-module').outerHeight();

			$('#blog-module').css('margin-top', (winH - 20));

			$('.side-bar-bx').height(blogHbx - 185);

			$('.reload-button-bx a').bind('mouseover', function() {
				$('.reload-button-bx a i').toggleClass('fa-spin');
			});
			$('.reload-button-bx a').bind('mouseout', function() {
				$('.reload-button-bx a i').toggleClass('fa-spin');
			});

			$('.plan-box').bind('click', function() {
				$(this).toggleClass('active-selection');
			});

			$(".scroll-box").mCustomScrollbar({
				axis: "x",
				theme: "minimal",
				updateOnContentResize: true
			});

			var _selfClick = 0;

			$('.cellplan').click(function() {

				$("div").filter($(".nocell")).fadeToggle('500', function() {

					if (_selfClick <= 3) {
						_scrollPlansResizer();
						_selfClick++;
					} else if (_selfClick >= 4) {
						_selfClick++;
						_scrollResizer();
						if (_selfClick >= 8) {
							_selfClick = 0;
						}
					}

					var _algoMes = $('.scroll-box').outerWidth();

					$("#mCSB_1_container").outerWidth(_algoMes);

				});

			});

			$('.streaming').click(function() {

				$("div").filter($(".nostreaming, .cellplan")).fadeToggle('500', function() {
					console.log('filter');
					if (_selfClick <= 3) {
						_scrollPlansResizer();
						_selfClick++;
					} else if (_selfClick >= 4) {
						_selfClick++;
						_scrollResizer();
						if (_selfClick >= 8) {
							_selfClick = 0;
						}
					}

					var _algoMes = $('.scroll-box').outerWidth();

					$("#mCSB_1_container").outerWidth(_algoMes);

				});

			});

			$('.tripleplay1, .tripleplay2, .tripleplay3').click(function() {

				var triple1True = $('.active-selection.tripleplay1').length
				var triple2True = $('.active-selection.tripleplay2').length
				var triple3True = $('.active-selection.tripleplay3').length
				var tripleCheck = triple1True + triple2True + triple3True;

				if (tripleCheck == 1) {
					$('div').filter($(".streaming, .cellplan")).fadeOut('500', function() {

						$('.products-box').width(500).css('min-width', 500);

						var _algoMes = $('.scroll-box').outerWidth();

						$("#mCSB_1_container").outerWidth(_algoMes).css('min-width', 500);

					});
				} else if (tripleCheck == 2) {} else if (tripleCheck == 3) {} else if (tripleCheck == 0) {
					$('div').filter($(".streaming, .cellplan")).fadeIn('500', function() {

						var _algoMes = $('.scroll-box').outerWidth();

						$('.products-box').width(860).css('min-width', 860);

						$("#mCSB_1_container").outerWidth(860).css('min-width', _algoMes);

					});
				}

			});
		};
=======
	//CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
>>>>>>> origin/EligeFacil-FE

	var _reSizeWindow = function() {
		$(window).resize(function() {
		});
	};
	
	var _slideInBanner = function() {
		$('#slide-in-banner').hide();
		function _slideInB(){
		  $('#slide-in-banner').slideDown();
		}
		setTimeout(_slideInB, 5000);
		
		$('#slide-in-banner .close-modal-btn').bind('click', function() {
			$('#slide-in-banner').slideUp();
		});
	}
	
	var _timeLineBanner = function() {
	
		var _doitOnce = 0;
		
		$(window).scroll(function() {
		  var _getScrollPos = $('.blog-timeline-bx').offset().top - $(window).scrollTop();

		  if (_getScrollPos <= -225 && _getScrollPos >= -228 && _doitOnce == 0) {
		  	$('.timeline-banner').slideDown();
		  	$("#embed01")[0].src += "&autoplay=1";
		  	_doitOnce = 1;
		  }
		});
	}


	//FIN CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	var _baseTemplate = function() {};


	return {
		init: function() {
			_isMobileInit();
<<<<<<< HEAD
			_generalesInit();
			_animacionInit();
			_iosOverlay();
			_tabsActiveBg();
			_stickFooter();
			_mainFileIndex();
			_scrollResizer();
			_positionWidget();
			_homeSlideFade();
			_selectDflt();
			_slideInBanner();
			_timeLineBanner();
=======
			_modalOnLoad();
			_URLModalActions();
			_productsClamp();
>>>>>>> origin/EligeFacil-FE
			_reSizeWindow();
		}
	};

})
(jQuery);