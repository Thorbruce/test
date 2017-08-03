$.fn.jcountdown = function(count, options){
    $.cookie('the_cookie', 'the_value', { expires: 7 });
    var zCount = count;
	var defaults = {
		timeup : function(){}
	};
	var opts = $.extend(defaults, options);
	

	var $timeDiv = $(this);
	

	var timeOut = function(){
		$timeDiv.text(zCount);
		zCount--;
		if (zCount >= 0){
			setTimeout(timeOut,1000);
		} else {
			opts.timeup();
		}
	};
	
	timeOut();
};