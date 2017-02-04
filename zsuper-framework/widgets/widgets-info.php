<?php  
include_once (ZS_DIR . 'widgets/widgets-categories.php');
include_once (ZS_DIR . 'widgets/widgets-notice.php');
include_once (ZS_DIR . 'widgets/widget-indexessay.php');

//让文本小工具支持简码
add_filter('widget_text', 'do_shortcode');
//让文本小工具支持PHP代码 

add_filter('widget_text','execute_php',100); 

function execute_php($html){ 

if(strpos($html,"<"."?php")!==false){ 

ob_start(); 

eval("?".">".$html); 

$html=ob_get_contents(); 

ob_end_clean(); 

} 

return $html;

}



?>