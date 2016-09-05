// Some general UI pack related JS
// Extend JS String with repeat method
String.prototype.repeat = function (num) {
  return new Array(Math.round(num) + 1).join(this);
};

(function ($) {

	// Switches
	if ($('[data-toggle="switch"]').length) {
	  $('[data-toggle="switch"]').bootstrapSwitch();
	}

})(jQuery);
