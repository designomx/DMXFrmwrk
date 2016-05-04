/*
 * fadeSlideShow
 * v.2.0.0
 *
 * Copyright (c) 2010 Pascal Bajorat (http://www.pascal-bajorat.com)
 * Dual licensed under the MIT (below)
 * and GPL (http://www.gnu.org/licenses/gpl.txt) licenses.
 *
 *
 * http://plugins.jquery.com/project/fadeslideshow
 * http://www.pascal-bajorat.com

MIT License

Copyright (c) 2010 Pascal Bajorat

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

jQuery.fn.fadeSlideShow = function(options) {
	return this.each(function(){
		settings = jQuery.extend({
     		width: 640, // default width of the slideshow
     		height: 480, // default height of the slideshow
			speed: 'slow', // default animation transition speed
			interval: 8000, // default interval between image change
			PlayPauseElement: false, // default css id for the play / pause element
			//PlayText: 'Play', // default play text
			//PauseText: 'Pause', // default pause text
			NextElement: false, // default id for next button
			//NextElementText: 'Next >', // default text for next button
			PrevElement: false, // default id for prev button
			//PrevElementText: '< Prev', // default text for prev button
			ListElement: 'fssList', // default id for image / content controll list
			ListLi: 'fssLi', // default class for li's in the image / content controll 
			ListLiActive: 'active-post-bullet', // default class for active state in the controll list
			addListToId: 'controlSlide', // add the controll list to special id in your code - default false
			//allowKeyboardCtrl: true, // allow keyboard controlls left / right / space
			autoplay: true // autoplay the slideshow
	 	}, options);
		
		// set style for wrapper element
		
		// count number of slides
		Slides = jQuery('> *', this).length;
		Slides = Slides - 1;
		ActSlide = Slides;
		// Set jQuery Slide short var
		jQslide = jQuery('> *', this);
		// save this
		fssThis = this;
		posts= jQuery('.postHeaderALL').length;
		posts=posts-1;
		jQuery('.postHeaderALL').hide();
		ActSlidePost=0;
		jQuery('.postHeader'+ActSlidePost).show();

		autoplay = function(){
			intval = setInterval(function(){
				jQslide.eq(ActSlide).fadeOut(settings.speed);
				//console.log("ActSlide"+ActSlide);
				
				

				
				// if list is on change the active class
				if(settings.ListElement){
					setActLi = (Slides - ActSlide) + 1;
					if(setActLi > Slides){setActLi=0;}
					jQuery('#'+settings.ListElement+' a').removeClass(settings.ListLiActive);
					jQuery('#'+settings.ListElement+' a').eq(setActLi).addClass(settings.ListLiActive);
				}
				
				if(ActSlide <= 0){
					jQslide.fadeIn(settings.speed);
					ActSlide = Slides;
				}else{
					ActSlide = ActSlide - 1;	
				}

				if(ActSlidePost >= Slides ){
					//console.log("ActSlidePost"+ActSlidePost);
					jQuery('.postHeaderALL').hide();
					ActSlidePost=0;
					jQuery('.postHeader'+ActSlidePost).fadeIn(settings.speed);
				}else{
					//console.log("ActSlidePost"+ActSlidePost);
					jQuery('.postHeaderALL').hide();
					ActSlidePost = ActSlidePost + 1;
					jQuery('.postHeader'+ActSlidePost).fadeIn(settings.speed);	
				}




			}, settings.interval);
			
			if(settings.PlayPauseElement){
				jQuery('#'+settings.PlayPauseElement).html(settings.PauseText);
			}
		}
		
		stopAutoplay = function(){
			clearInterval(intval);
			intval = false;
			if(settings.PlayPauseElement){
				jQuery('#'+settings.PlayPauseElement).html(settings.PlayText);
			}
		}
		
		jumpTo = function(newIndex){
			if(newIndex < 0){newIndex = Slides;}
			else if(newIndex > Slides){newIndex = 0;}
			if( newIndex >= ActSlide ){
				jQuery('> *:lt('+(newIndex+1)+')', fssThis).fadeIn(settings.speed);
			}else if(newIndex <= ActSlide){
				jQuery('> *:gt('+newIndex+')', fssThis).fadeOut(settings.speed);
			}
			
			// set the active slide
			ActSlide = newIndex;

			if(settings.ListElement){
				// set active
				jQuery('#'+settings.ListElement+' a').removeClass(settings.ListLiActive);
				jQuery('#'+settings.ListElement+' a').eq((Slides-newIndex)).addClass(settings.ListLiActive);
			}
		}
		
		// if list is on render it
		if(settings.ListElement){
			i=0;
			a = '';
			while(i<=Slides){
				if(i==0){
					//li = li+'<li class="'+settings.ListLi+i+' '+settings.ListLiActive+'"> <\/li>';
					a = a+'<a onclick="MostrarPostHeader('+i+')" class="'+settings.ListLi+i+' '+settings.ListLiActive+'"> <\/a>';
				}else{
					//li = li+'<li class="'+settings.ListLi+i+'"> <\/li>';
					a = a+'<a onclick="MostrarPostHeader('+i+')" class="'+settings.ListLi+i+'"> <\/a>';
				}
				
				i++;
			}
			//List = '<ul id="'+settings.ListElement+'">'+li+'<\/ul>';
			div = '<div id="'+settings.ListElement+'">'+a+'<\/div>';

			// add list to a special id or append after the slideshow
			if(settings.addListToId){
				jQuery('#'+settings.addListToId).append(div);
			}else{
				jQuery(this).after(div);
			}
			
			jQuery('#'+settings.ListElement+' a').bind('click', function(){
				index = jQuery('#'+settings.ListElement+' a').index(this);
				stopAutoplay();
				//clearInterval(interval);
				autoplay();
				ReverseIndex = Slides-index;
				ActSlidePost= index;
				jumpTo(ReverseIndex);
				
				return false;
			});
		}
		
		if(settings.PlayPauseElement){
			if(!jQuery('#'+settings.PlayPauseElement).css('display')){
				jQuery(this).after('<a href="#" id="'+settings.PlayPauseElement+'"><\/a>');
			}
			
			if(settings.autoplay){
				jQuery('#'+settings.PlayPauseElement).html(settings.PauseText);
			}else{
				jQuery('#'+settings.PlayPauseElement).html(settings.PlayText);
			}
			
			jQuery('#'+settings.PlayPauseElement).bind('click', function(){
				if(intval){
					stopAutoplay();
				}else{
					autoplay();
				}
				return false;
			});
		}
		
		if(settings.NextElement){
			if(!jQuery('#'+settings.NextElement).css('display')){
				jQuery(this).after('<a href="#" id="'+settings.NextElement+'">'+settings.NextElementText+'<\/a>');
			}
			
			jQuery('#'+settings.NextElement).bind('click', function(){
				nextSlide = ActSlide-1;
				stopAutoplay();
				jumpTo(nextSlide);
				return false;
			});
		}
		
		if(settings.PrevElement){
			if(!jQuery('#'+settings.PrevElement).css('display')){
				jQuery(this).after('<a href="#" id="'+settings.PrevElement+'">'+settings.PrevElementText+'<\/a>');
			}
			
			jQuery('#'+settings.PrevElement).bind('click', function(){
				prevSlide = ActSlide+1;
				stopAutoplay();
				jumpTo(prevSlide);
				return false;
			});
		}
		
		if(settings.allowKeyboardCtrl){
			jQuery(document).bind('keydown', function(e){
				if(e.which==39){
					nextSlide = ActSlide-1;
					stopAutoplay();
					jumpTo(nextSlide);
				}else if(e.which==37){
					prevSlide = ActSlide+1;
					stopAutoplay();
					jumpTo(prevSlide);
				}else if(e.which==32){
					if(intval){stopAutoplay();}
					else{autoplay();}
					return false;
				}
			});
		}
		
		// start autoplay or set it to false
		if(settings.autoplay){autoplay();}else{intval=false;}
	});
};

function MostrarPostHeader(post) {
	//console.log(post);
	jQuery('.postHeaderALL').hide();
	jQuery('.postHeader'+post).fadeIn('slow');
};
