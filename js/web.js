/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

FRMWRK.web = (function ($) {

        
    //PERFIL::FILE////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
 	
 	var _homeSliderH = function() {
 		var wHeight = $(window).height();
 		var sliderH = wHeight - 104;
 		$('.slider, .slider .slide').slider({full_width: true, height: sliderH});
 	};
          
    
    var _reSizeWeb = function() {
    		$( window ).resize(function() {
    			 clearTimeout(id);
    			 id = setTimeout(doneResizing, 500);
    		});
    		
    		var id;
    		
    		function doneResizing(){
    		   location.reload();
    		}
    	};
    
    //FIN CLASES////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
    var _baseTemplate = function() {
    };
       
    
    return {
        init: function () {
        	_homeSliderH();
        	_reSizeWeb();
        }
    };

})
(jQuery);