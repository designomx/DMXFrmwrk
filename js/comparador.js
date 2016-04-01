/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

FRMWRK.comparador = (function ($) {

        
    //COMPARADOR::FILE////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
 	
 	var _compaRadorSlide = function() {
 		
 	};
 	
 	var _scrollSlides = function() {
 	
 		var _widthSlides = 0;
 		$('.sliders-wrapp .slider-bx').each(function() {
 		    _widthSlides += $(this).outerWidth( true );
 		});
 		$('.sliders-wrapp').css('width', _widthSlides);
 	
 		if (isMobile.any == false) {
 			$(".sliders-scroll-bx").mCustomScrollbar({
				axis: "x",
				theme: "dark-thin",
				autoHideScrollbar: true,
				updateOnContentResize: true
			});
			$(".checks-scroll-bx form").mCustomScrollbar({
				axis: "y",
				theme: "dark-thin",
				autoHideScrollbar: true,
				updateOnContentResize: true
			});
 		}else {
 			$(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
 		}
 	};

    
    //FIN CLASES////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
    var _baseTemplate = function() {
    };
       
    
    return {
        init: function () {
        	_compaRadorSlide();
        	_scrollSlides();
        }
    };

})
(jQuery);