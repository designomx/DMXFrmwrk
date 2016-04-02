/*
 ** REQUIRED jquery-X.XX.js
 ** REQUIRED init.config.js
 */

SLOTM.main = (function($) {
		
	//CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	
	var _moveSlots = function(speed) {
	
		var _anchoSltElmnt = $('.top-row-bx .move-top-row .slot-bx:first').outerWidth();
	
		$('.top-row-bx .move-top-row').stop(true,false).animate({
		    left: -_anchoSltElmnt
		},{
			duration: speed,
			easing: 'linear',
			complete: function() {
				$('.top-row-bx .move-top-row').css('left' , 0);
				
				$('.top-row-bx .move-top-row .slot-bx:first').appendTo($('.top-row-bx .move-top-row'));
				
				_moveSlots(speed);
			}
		});
		
	};
	
	var _moveSlotsM = function(speed) {
	
		var _anchoSltElmnt = $('.mid-row-bx .move-mid-row .slot-bx:last').outerWidth();
		
		$('.mid-row-bx .move-mid-row .slot-bx:last').prependTo($('.mid-row-bx .move-mid-row'));
		
		$('.mid-row-bx .move-mid-row').css('left' , -_anchoSltElmnt);
	
		$('.mid-row-bx .move-mid-row').stop(true,false).animate({
		    left: 0
		},{
			duration: speed,
			easing: 'linear',
			complete: function() {
				_moveSlotsM(speed);
			}
		});
		
	};
	
	var _moveSlotsB = function(speed) {
	
		var _anchoSltElmnt = $('.bot-row-bx .move-bot-row .slot-bx:first').outerWidth();
	
		$('.bot-row-bx .move-bot-row').stop(true,false).animate({
		    left: -_anchoSltElmnt
		},{
			duration: speed,
			easing: 'linear',
			complete: function() {
				$('.bot-row-bx .move-bot-row').css('left' , 0);
				
				$('.bot-row-bx .move-bot-row .slot-bx:first').appendTo($('.bot-row-bx .move-bot-row'));
				
				_moveSlotsB(speed);
			}
		});
		
	};
	
	var _startGameBtn = function() {
	
		$('.action-bar-bx').on('click', function() {
		
			$('#audio-loop').get(0).loop=true;
			$('#audio-loop').get(0).play();
		
			$('#instructed-ovrly').fadeOut(1000);
			$('#touch-stop-overlay').show();
			
			$('.action-bar-bx').addClass('stop-row-btn');
			$('.action-bar-bx').text('Parar fila uno');
			_moveSlots(600);
			_moveSlotsM(500);
			_moveSlotsB(300);
		
		});
	
		$('#touch-stop-overlay').on('click', function() {
		
			var _anchoSltElmnt = $('.top-row-bx .move-top-row .slot-bx:first').outerWidth();
						
				$('.top-row-bx .move-top-row').stop(true,false).animate({
				    left: -_anchoSltElmnt/2
				});
				
				$('.action-bar-bx').text('Parar fila dos');
			
				$(this).off('click');
				
				$(this).on('click', function() {
				
					var _anchoSltElmnt = $('.mid-row-bx .move-mid-row .slot-bx:first').outerWidth();
							
					$('.mid-row-bx .move-mid-row').stop(true,false).animate({
					    left: -_anchoSltElmnt/2
					});
					
					$('.action-bar-bx').text('Parar fila tres');
													
					$(this).off('click');
					
					$(this).on('click', function() {
					
						var _anchoSltElmnt = $('.bot-row-bx .move-bot-row .slot-bx:first').outerWidth();
								
						$('.bot-row-bx .move-bot-row').stop(true,false).animate({
						    left: -_anchoSltElmnt/2
						}, function() {
						
							var lastClass = $('.top-row-bx .move-top-row .slot-bx:eq(1)').attr('class').split(' ').pop();
							
							if ($('.mid-row-bx .move-mid-row .slot-bx').eq(1).hasClass(lastClass)) {
								if ($('.bot-row-bx .move-bot-row .slot-bx').eq(1).hasClass(lastClass)) {
									$('.action-bar-bx').removeClass('stop-row-btn');
									$('.action-bar-bx').text('GAME OVER');
									$('.winner-modal,#overlay-bx').fadeIn();
									$('#audio-loop').get(0).stop();
								}else {
									$('.action-bar-bx').removeClass('stop-row-btn');
									$('.action-bar-bx').text('GAME OVER');
									$('.fail-modal,#overlay-bx').fadeIn();
									$('#audio-loop').get(0).stop();
								}
							} else {
								$('.action-bar-bx').removeClass('stop-row-btn');
								$('.action-bar-bx').text('GAME OVER');
								$('.fail-modal,#overlay-bx').fadeIn();
								$('#audio-loop').get(0).stop();
							}
							
							
//							$('.winner-modal,#overlay-bx').fadeIn();
						});
											
					});
				
				});
			
			
		});
	
	};

	var _reSizeWindow = function() {
		$(window).resize(function() {
		});
	};


	//FIN CLASES////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////


	return {
		init: function() {
			_moveSlots(2000);
			_moveSlotsM(1000);
			_moveSlotsB(800);
			_startGameBtn();
			_reSizeWindow();
		}
	};

})
(jQuery);