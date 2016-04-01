/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

BARCRTSA.main = (function($) {
		
	//CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	
	var _openMaterialBx = function() {
	
		$('.animated-post').css({top:'100%',width:'100%'});
	
		$('.col-xs-6 a').bind('click', function(e) {
			$('body, html').addClass('force-no-overflow');

			
			var r = confirm("Haz elegido Pepillin, ¿Estas seguro?.");
			if (r == true) {
			   //Entregar premio
			   
			   $('body, html').removeClass('force-no-overflow');
			   
			} else {
				$('body, html').removeClass('force-no-overflow');
				
			}
						
		});
		
		$('.close-product').bind('click', function(e) {
			
			$('body, html').removeClass('force-no-overflow');
			
		});
	}

	var _reSizeWindow = function() {
		$(window).resize(function() {
		});
	};


	//FIN CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	var _baseTemplate = function() {};


	return {
		init: function() {
			_openMaterialBx();
			_reSizeWindow();
		}
	};

})
(jQuery);