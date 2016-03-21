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
			$(this).parent('.col-xs-6').find('.materialized-post:first').stop(true,false).animate({top: 0,opacity: 1},0).addClass('opened-bx');
		});
		
		$('.close-product').bind('click', function(e) {
			
			$('.opened-bx').stop(true,false).animate({
			    top: '100%',
			    opacity: 0
			  }, 0, function() {
			    $('body, html').removeClass('force-no-overflow');
			    setTimeout(function(){
			      $('.animated-post .opened-bx').stop(true,false).animate({opacity: 0},500,function() {
			      	$('.animated-post .opened-bx').removeClass('opened-bx');
			      	$('.animated-post').css('top',0);
			      });
			    }, 500);
			  });
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