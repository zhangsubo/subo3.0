<?php
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

    // update path
    $path = OPTION_DIR;

    // return
    return $path;

}
// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {

    // update path
    $dir = OPTION_URL;

    // return
    return $dir;

}
// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( OPTION_DIR . '/acf.php' );


//setting option
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
