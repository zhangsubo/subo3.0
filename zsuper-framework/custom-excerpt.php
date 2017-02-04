<?php 
/**
 * 修改the_excerpt 默认长度
 *
 **/
function zsuper_custom_excerpt_length($length){
	return 350;
}
add_filter('excerpt_length','zsuper_custom_excerpt_length',999);

/**
 * 给read more加上链接
 */
function zsuper_custom_excerpt_more($more){
	return sprintf('…<a class="read-more" href="%1$s">%2$s</a>',get_permalink(get_the_ID() ),__( '[Read More]', 'textdomain' ));
}
add_filter('excerpt_more','zsuper_custom_excerpt_more' );
?>
