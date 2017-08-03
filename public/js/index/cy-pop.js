$(function(){
	var winheight=$(window).height();
	$('.cy-pop-box').height(winheight);
	$('.cy-cancel-box').click(function(){
		$('.cy-pop-box').hide();
	})
	$('.cy-cancel').click(function(){
		$('.cy-pop-box').show();
	})
	$('.cy-pop-box').bind('touchmove',function(){
		return false;
	})
})
