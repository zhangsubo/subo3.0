<?php
if ( ! function_exists( 'zsuper_mayi_mate' ) ) :
/**
 * 文章发布时间，更新时间，作者，分类
 */
function zsuper_mayi_mate() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
		//esc_attr( get_the_modified_date( 'c' ) ),//文章最后更新时间
		//esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'zsuper_mayi' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="ico_3"></i>' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'zsuper_mayi' ),
		'<a id="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="ico_2"></i>' . esc_html( get_the_author() ) . '</a>'
	);

}
endif;

/**
 * 文章浏览量
 */
/* 访问计数 */
function record_visitors()
{
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');
/// 函数名称：post_views
/// 函数作用：取得文章的阅读次数
function post_views()
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  return $views;
}
/**
 * 输出文章分类链接
 */
function zsuper_mayi_categories($post_id  = '' , $taxonomy = 'category', $separator = ' ') {
	if(empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}
	$categories = wp_get_post_terms( $post_id, $taxonomy, array('orderby' => 'term_group') );
	$output = '';
	if($categories){
		foreach($categories as $category) {
			$output .= '<a href="'.get_term_link( $category, $taxonomy ).'" rel="category" ><i class="ico_1"></i>'.$category->name.'</a>'.$separator;
		}
	}
	return trim($output, $separator);
}
//end
?>
