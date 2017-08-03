$(function(){
	var str = '2016-09-30 13:59'; // 日期字符串

	str = str.replace(/-/g,'/'); // 将-替换成/，因为下面这个构造函数只支持/分隔的日期字符串
	
	var date = new Date(str); // 构造一个日期型数据，值为传入的字符串
	var years,days,hours,min,sec;
	var paytime=new Date();
	var timenow=paytime.getTime();
//	alert(times);
//	paytime.setHours(13);
	var times=date.getTime();
//	alert(times);
    var timeend=times-timenow;
    timeend=timeend/1000;
    if(timeend<=0){
    	text="0小时0分0秒";
	    $('.pay-time em').html(text);
    	clearInterval(daojishi);
    }else{
    	Sec2Time(timeend);
		var text=hours+"小时"+min+"分"+sec+"秒";
		$('.pay-time em').html(text);
    }
    $('.pay-time').show();
//  alert(timeend);
    
    var daojishi=setInterval(function(){
    	timeend--;
    	Sec2Time(timeend);
    	text=hours+"小时"+min+"分"+sec+"秒";
    	$('.pay-time em').html(text);
        if(timeend<=0){
        	text="0小时0分0秒";
    	    $('.pay-time em').html(text);
        	clearInterval(daojishi);
        }
    },1000)
	
	
	function Sec2Time($time){
    if($time){
    if($time >= 31556926){
    years = Math.floor($time/31556926);
      $time = ($time%31556926);
    }
    else{
    	years=0;
    }
    if($time >= 86400){
      days = Math.floor($time/86400);
      $time = ($time%86400);
    }else{
    	days=0;
    }
    if($time >= 3600){
      hours = Math.floor($time/3600);
      $time = ($time%3600);
    }else{
    	hours=0;
    }
    if($time >= 60){
      min = Math.floor($time/60);
      $time = ($time%60);
    }else{
    	min=0;
    }
    sec = Math.floor($time);
    //return (array) $value;
    
    }else{
    }
 }
	
	
	
})
