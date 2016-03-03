/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

FRMWRK.comparador = (function ($) {

        
    //COMPARADOR::FILE////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
 	
 	var _compaRadorSlide = function() {
 		var slider = document.getElementById('slidertest');
 		
 		noUiSlider.create(slider, {
 		start: [0, 1000],
 		connect: true,
 		step: 10,
 		range: {
 		 'min': 0,
 		 'max': 1000
 		},
 		  format: wNumb({
 			decimals: 0
 		  })
 		});
 		
 		var slider2 = document.getElementById('slidertest2');
 			 	
 		noUiSlider.create(slider2, {
 		start: [0, 350],
 		connect: true,
 		step: 10,
 		range: {
 		 'min': 10,
 		 'max': 350
 		},
 		  format: wNumb({
 			decimals: 0
 		  })
 		});
 		
 		var slider3 = document.getElementById('slidertest3');
 			 	
 		noUiSlider.create(slider3, {
 		start: [0, 1000],
 		connect: true,
 		step: 50,
 		range: {
 		 'min': 0,
 		 'max': 1000
 		},
 		  format: wNumb({
 			decimals: 0
 		  })
 		});
 		
 		var slider4 = document.getElementById('slidertest4');
 			 	
 		noUiSlider.create(slider4, {
 		start: [0, 1000],
 		connect: true,
 		step: 50,
 		range: {
 		 'min': 0,
 		 'max': 1000
 		},
 		  format: wNumb({
 			decimals: 0
 		  })
 		});
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