jQuery(document).ready(function () {
        jQuery('header nav').meanmenu();
});

//微信弹窗
$(function(){
    $(".weixin").click(function(){
    $(".overlay").css({display:"block",height:$(document).height()});
    $(".weixindiag").css({
        left:($("body").width()-$(".weixindiag").width())/2+"px",
        top:($(window).height()-$(".weixindiag").height())/2+$(window).scrollTop()+"px",
        display:"block"
    });
    });

    $(".weixinclose").click(function(){
    $(".overlay,.weixindiag").css("display","none");
    return false;
    });
});
