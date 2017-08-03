$(function(){

   $("#open-brief").click(function(){
   	var $conent=$(this).parents().siblings(".conent");
   	if($conent.css("display")=="block"){
		$(this).html('展开详细' + '<i class="select-down"></i>');
	  $conent.hide();
		$(this).find(".select-down").css({'transform':' rotate(0deg)','-o-transform':' rotate(0deg)','-webkit-transform':' rotate(0deg)','-moz-transform':' rotate(0deg)',})

   	}else{
		$(this).html('收起详细' + '<i class="select-down"></i>');
   	  $conent.show();
		$(this).find(".select-down").css({'transform':' rotate(180deg)','-o-transform':' rotate(180deg)','-webkit-transform':' rotate(180deg)','-moz-transform':' rotate(180deg)',})
	}
  })

   $(".pay-way li").click(function(){
   	   $(".pay-way li").children(".choose-pay").remove();
   	   $(this).append('<span class="choose-pay fr"><img src="../../assets/img/choose-pay.png" alt=""></span>');
   })
})