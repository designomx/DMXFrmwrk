!function($){$.fn.characterCounter=function(e){function t(e){var t,n="";for(t in e)n+=" "+t+'="'+e[t]+'"';return n}function n(){var e=u.counterCssClass;return u.customFields["class"]&&(e+=" "+u.customFields["class"],delete u.customFields["class"]),"<"+u.counterWrapper+t(u.customFields)+' class="'+e+'"></'+u.counterWrapper+">"}function r(e){var t=u.counterFormat.replace(/%1/,e);return u.renderTotal&&(t+="/"+u.limit),t}function s(e){var t=$(e).val().length,n=u.counterSelector?$(u.counterSelector):$(e).siblings("."+u.counterCssClass),s=u.limit-t,c=0>s;u.increaseCounting&&(s=t,c=s>u.limit),c?(n.addClass(u.counterExceededCssClass),u.exceeded=!0,u.onExceed(t)):u.exceeded&&(n.removeClass(u.counterExceededCssClass),u.onDeceed(t),u.exceeded=!1),n.html(r(s))}function c(e){$(e).on("keyup",function(){s(e)}).on("paste",function(){var e=this;setTimeout(function(){s(e)},0)})}var o={exceeded:!1,counterSelector:!1,limit:150,renderTotal:!1,counterWrapper:"span",counterCssClass:"charCounter",counterFormat:"%1",counterExceededCssClass:"exceeded",increaseCounting:!1,onExceed:function(e){},onDeceed:function(e){},customFields:{}},u=$.extend(o,e);return this.each(function(){var e=$(this).attr("maxlength");"undefined"!=typeof e&&e!==!1&&$.extend(o,{limit:parseInt($(this).attr("maxlength"))}),u.counterSelector||$(this).after(n()),c(this),s(this)})}}(jQuery);