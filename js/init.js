/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

FRMWRK.main = (function ($) {

	//isMobile////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////

	var _isMobileInit = function() {
		!function(a){var b=/iPhone/i,c=/iPod/i,d=/iPad/i,e=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,f=/Android/i,g=/IEMobile/i,h=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,i=/BlackBerry/i,j=/BB10/i,k=/Opera Mini/i,l=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,m=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),n=function(a,b){return a.test(b)},o=function(a){var o=a||navigator.userAgent;return this.apple={phone:n(b,o),ipod:n(c,o),tablet:n(d,o),device:n(b,o)||n(c,o)||n(d,o)},this.android={phone:n(e,o),tablet:!n(e,o)&&n(f,o),device:n(e,o)||n(f,o)},this.windows={phone:n(g,o),tablet:n(h,o),device:n(g,o)||n(h,o)},this.other={blackberry:n(i,o),blackberry10:n(j,o),opera:n(k,o),firefox:n(l,o),device:n(i,o)||n(j,o)||n(k,o)||n(l,o)},this.seven_inch=n(m,o),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},p=function(){var a=new o;return a.Class=o,a};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=o:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=p():"function"==typeof define&&define.amd?define("isMobile",[],a.isMobile=p()):a.isMobile=p()}(this);
	};

   //VARIABLES////////////////////////////////////////////////////////////////////////////////////
   	/////////////////////////////////////////////////////////////////////////////////
     
   	//Calculo el ancho y alto del documento
   	var _anchoWindow = $(window).width();
   	var _altoWindow = $(window).height();
   	
   
   	//CLASES////////////////////////////////////////////////////////////////////////////////////
   	/////////////////////////////////////////////////////////////////////////////////
   	
   	var _generalesInit = function() {
   		//Inicializo el boton de navegacion
   		$('.button-collapse').sideNav();
   		//SELECT Generico
   		$('select').material_select();
   		//MODAL TRIGGER
   		$('.modal-trigger').leanModal();
   		//TOOLTIPS
   		$('.tooltipped').tooltip();
   		//DROPDOWNS
   		$('.dropdown-right').dropdown({
   		     inDuration: 300,
   		     outDuration: 225,
   		     constrain_width: false, // Does not change width of dropdown to that of the activator
   		     hover: false, // Activate on click
   		     alignment: 'right', // Aligns dropdown to left or right edge (works with constrain_width)
   		     gutter: 10 // Spacing from edge
   		   }
   		);
   		$('.dropdown-left').dropdown({
   			     inDuration: 300,
   			     outDuration: 225,
   			     constrain_width: false, // Does not change width of dropdown to that of the activator
   			     hover: false, // Activate on click
   			     alignment: 'left', // Aligns dropdown to left or right edge (works with constrain_width)
   			     gutter: 10 // Spacing from edge
   			   }
   			);
   		$('.dropdown-right-hover').dropdown({
   			     inDuration: 300,
   			     outDuration: 225,
   			     constrain_width: false, // Does not change width of dropdown to that of the activator
   			     hover: true, // Activate on click
   			     alignment: 'right', // Aligns dropdown to left or right edge (works with constrain_width)
   			     gutter: 10 // Spacing from edge
   			   }
   			);
   		//TABS
   		$('ul.tabs').tabs();
   		//Contador de caracteres tipo Twitter
   		$(".charCountTW").characterCounter({
   			  limit: '140',
   			  counterFormat: 'Caracteres restantes: %1' 
   		});
   		//Back to top
   		var offset = 300,
   		offset_opacity = 999999,
   		scroll_top_duration = 700,
   		$back_to_top = $('.cd-top');
   		//hide or show the "back to top" link
   		$(window).scroll(function(){
   			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
   		});
   		//smooth scroll to top
   		$back_to_top.on('click', function(event){
   			event.preventDefault();
   			$('body,html').animate({
                    scrollTop: 0
   			 	}, scroll_top_duration
   			);
   		});
   		if (isMobile.any) {
   			$('ul li a').on('click touchend', function(e) {
   				var el = $(this);
   				var link = el.attr('href');
   				window.location = link;
   			});
   		}
   		
   		//RateBox
   		$('.rate-btn').bind('click', function(ev) {
   			ev.preventDefault();
   			if ($(this).find('.fa-star-o')) {
   				$(this).find('.fa-star-o').removeClass('fa-star-o').addClass('fa-star');
   			}
   		});
   		//Stop # Page jump using href #
   		$(".jslink").click(function(e) {
   		    e.preventDefault();
   		});
		
	};
	   	
   	var _iosOverlay = function() {
   	
   		var opts = {
   				 lines: 9,
   			     length: 12,
   			     width: 8,
   			     radius: 18,
   			     corners: 1,
   			     rotate: 0,
   			     direction: 1,
   			     color: '#ffffff',
   			     speed: 1.2,
   			     trail: 60,
   			     shadow: false,
   			     hwaccel: false,
   			     className: 'loadingSpinner',
   			     zIndex: 2e9,
   			     top: '40%',
   			     left: '50%'
   			};
   		
   			var target = document.createElement("div");
   			document.body.appendChild(target);
   			var spinner = new Spinner(opts).spin(target);
   			var overlay = iosOverlay({
   				text: "Cargando",
   				spinner: spinner
   			});
   		
   			window.setTimeout(function() {
   				overlay.update({
                    icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
   					text: "Listo"
   				});
   			}, 1000);
   		
   			window.setTimeout(function() {
   				overlay.hide();
   			}, 2000);
   		
   			return false;
   	
   	};
   	
   	var _stickFooter = function() {

   		var _bHght = $('body').height();
   		var _wHght = $(window).height();
   		var _leftHW = _wHght - _bHght;
   		
   		if(_bHght < _wHght){
   			$('footer').addClass("stickFoot");
   		}else {
   			$('footer').removeClass("stickFoot");
   		}

   		$(window).bind("load", function() {
			var _bHght = $('body').height();
			var _wHght = $(window).height();
			var _leftHW = _wHght - _bHght;

            if (_bHght < _wHght) {
				$('footer').addClass("stickFoot");
			}else {
				$('footer').removeClass("stickFoot");
			}
   		});

    };
   	
   	var _reSizeWindow = function() {
   		$( window ).resize(function() {
   			 _stickFooter();
   		});
   	};
   	
   	
   	//ACTIVE TABS
   	var _tabsActiveBg = function() {
   		$('.tabs li').bind('click',function() {
        	$('.tabs > li').removeClass("blue-grey lighten-5");
        	$(this).addClass("blue-grey lighten-5");
        	_stickFooter();
        });
        $('.tabs, .tabs li a').bind('click',function() {
        	_stickFooter();
        });
   	};


    ///PNotify
    //http://sciactive.com/pnotify/#demos-simple
    var _pnotify_stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
    var _pnotify = function (mensaje, tipo) {
        if (typeof PNotify != "undefined") {
            var opts = {
                title: "Atención",
                text: mensaje,
                addclass: "stack-topleft alertBox blackAlertBx",
                styling: 'fontawesome',
                cornerclass: "",
                width: "100%",
                stack: _pnotify_stack_bar_top
            };
            switch (tipo) {
                case 'error':
                    opts.title = "Error";
                    opts.type = "error";
                    break;
                case 'info':
                    opts.title = "Atención";
                    opts.type = "info";
                    break;
                case 'success':
                    opts.title = "¡Hecho!";
                    opts.type = "success";
                    break;
            }
            new PNotify(opts);
        } else {
            alert(mensaje);
        }
    }

   	//INDEX::FILE////////////////////////////////////////////////////////////////////////////////////
   	/////////////////////////////////////////////////////////////////////////////////
   	   
   	var _animacionInit = function() {
   		$('#login-bx').addClass('magictime swashIn');
   		$('.navbar-fixed.aniMagic').addClass('animated bounceInDown');
   	};
   	

       
    //FIN CLASES////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
    var _baseTemplate = function() {
    };
    
    
    return {
        init: function () {
        	_isMobileInit();
        	_generalesInit();
        	_animacionInit();
        	_iosOverlay();
        	_tabsActiveBg();
        	_stickFooter();
        	_reSizeWindow();
        },
        notificacion: function (mensaje, tipo) {
            _pnotify(mensaje, tipo);
        }
    };

})
(jQuery);