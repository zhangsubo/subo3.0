<?php
if( function_exists('acf_add_options_page') ) {

      $option_page = acf_add_options_page(array(
            'page_title'      => '主题设置',
            'menu_title'      => '主题设置',
            'menu_slug'       => 'theme-general-settings',
            'capability'      => 'edit_posts',
            'redirect'  => 'false',
      ));
}
// 定义默认特色图片
add_filter( 'post_thumbnail_html', 'my_post_thumbnail_html' );

function my_post_thumbnail_html( $html ) {

    if ( empty( $html ) )
        $html = '<img src="' .  get_stylesheet_directory_uri() . '/images/default-thumbnail.png' . '" alt="" />';

    return $html;
}
?>
