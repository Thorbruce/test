/**
 * Created by Lei on 2015/11/24.
 */
//�����ر�
$("document").ready(function(){

    var window_w = $(window).width(),
        window_h = $(window).height(),
        popup_w = $(".popup-wrap").outerWidth(),
        popup_h = $(".popup-wrap").outerHeight(),
        left = (window_w- popup_w)/ 2,
        top = (window_h- popup_h)/ 2;
    //$(".popup-wrap").css('margin-top',top);

    //����������
    //$('[data-dismiss="modal"]').click(function(){
    //    $(".popup-fixed").hide();
    //    $(document.body).removeClass("popup-body");
    //});
    $('.click-hide').click(function(){
        $(".popup-fixed").hide();
        $(document.body).removeClass("popup-body");
        $(document.body).removeClass("oh");
    });
});

//function hideCmtModal(){
//    $(".popup-fixed").hide();
//}
//
//$('[data-dismiss="modal"]').on('click',function(){
//    hideCmtModal();
//});