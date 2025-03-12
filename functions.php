<?php
/**
 * subo2017 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package subo2017
 */

/*----------------------------------------------------------------------*/
/* 全局参数定义 */
/*----------------------------------------------------------------------*/

// 定义主题目录和URL
define('THEME_DIR', trailingslashit( get_template_directory() ));
define('THEME_URL', trailingslashit( get_template_directory_uri() ));

// 定义其他目录和URL
define('INC_DIR', THEME_DIR . 'inc/');
define('INC_URL', THEME_URL . 'inc/');
define('JS_DIR', THEME_DIR . 'js/min/');
define('JS_URL', THEME_URL . 'js/min/');
define('CSS_DIR', THEME_DIR . 'layouts/');
define('CSS_URL', THEME_URL . 'layouts/');
define('ZS_DIR', THEME_DIR . 'zsuper-framework/');
define('ZS_URL', THEME_URL . 'zsuper-framework/');
define('IMG_URL', THEME_URL . 'images/');
define('IMG_DIR', THEME_DIR . 'images/');
define('OPTION_URL', ZS_URL . 'acf/');
define('OPTION_DIR', ZS_DIR . 'acf/');

/*----------------------------------------------------------------------*/
/* 引入依赖文件 */
/*----------------------------------------------------------------------*/

// 移除头部多余代码
include_once (ZS_DIR . 'remove-head.php');

// 自定义文章摘要文字长度
include_once (ZS_DIR . 'custom-excerpt.php');

// 链接转脚注
include_once (ZS_DIR . 'post-footnotes.php');

// 定义post类型
include_once (ZS_DIR . 'register-post.php');

// 选项页面
include_once (ZS_DIR . 'option.php');

/*----------------------------------------------------------------------*/
/* 主题设置和支持 */
/*----------------------------------------------------------------------*/

if ( ! function_exists( 'subo_setup' ) ) :
/**
 * 设置主题默认值并注册对各种WordPress功能的支持
 */
function subo_setup() {
	// 使主题可翻译
	load_theme_textdomain( 'subo', get_template_directory() . '/languages' );

	// 添加默认的文章和评论RSS源链接到头部
	add_theme_support( 'automatic-feed-links' );

	// 让WordPress管理文档标题
	add_theme_support( 'title-tag' );

	// 启用文章和页面的特色图片支持
	add_theme_support( 'post-thumbnails' );

	// 注册导航菜单
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'subo' ),
		'menu-2' => esc_html__( '友情链接', 'subo' ),
	) );

	// 切换默认的核心标记为有效的HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// 设置WordPress核心自定义背景功能
	add_theme_support( 'custom-background', apply_filters( 'subo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// 添加对小部件的选择性刷新支持
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'subo_setup' );

/*----------------------------------------------------------------------*/
/* 内容宽度设置 */
/*----------------------------------------------------------------------*/

/**
 * 根据主题的设计和样式表设置内容宽度
 */
function subo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'subo_content_width', 640 );
}
add_action( 'after_setup_theme', 'subo_content_width', 0 );

/*----------------------------------------------------------------------*/
/* 小部件区域注册 */
/*----------------------------------------------------------------------*/

/**
 * 注册小部件区域
 */
function subo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'subo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'subo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'subo_widgets_init' );

/*----------------------------------------------------------------------*/
/* 样式和脚本注册 */
/*----------------------------------------------------------------------*/

/**
 * 注册和引入样式
 */
function subo_style() {
	wp_register_style('subo_normalize', CSS_URL . 'min/normalize-min.css', array(), '20170130');
	wp_register_style('subo_fontawsome', CSS_URL . 'fontawsome/font-awesome.min.css', array(), '');
	wp_register_style('subo_menu', CSS_URL . 'min/meanmenu.min.css', array(), '20170130');
	wp_register_style('subo_prism', CSS_URL . 'min/prism-min.css', array(), '20190511');
	wp_register_style('subo_web', CSS_URL . 'min/style-min.css', array(), '20200613');

	wp_enqueue_style('subo_normalize');
	wp_enqueue_style('subo_fontawsome');
	wp_enqueue_style('subo_menu');
	wp_enqueue_style('subo_prism');
	wp_enqueue_style('subo_web');
}
add_action('wp_enqueue_scripts', 'subo_style');

/**
 * 注册和引入js脚本
 */
function subo_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('subo_jquery', JS_URL . 'jquery-3.1.1.min.js', array(), '3.1.1', true);
	wp_enqueue_script('subo_menu', JS_URL . 'jquery.meanmenu-min.js', array(), '20170130', true);
	wp_enqueue_script('subo_main', JS_URL . 'main-min.js', array(), '20170130', true);
	wp_enqueue_script('subo_languages', JS_URL . 'prism-min.js', array(), '20190512', true);
}
add_action( 'wp_enqueue_scripts', 'subo_scripts' );

/*----------------------------------------------------------------------*/
/* 其他功能 */
/*----------------------------------------------------------------------*/

/**
 * 强制修改为https
 */
function my_content_manipulator($content) {
	if ( is_ssl() ) {
		$content = str_replace('https://zhangsubo.cn/wp-content/uploads', 'https://zhangsubo.cn/wp-content/uploads', $content);
	}
	return $content;
}
add_filter('the_content', 'my_content_manipulator');

/*----------------------------------------------------------------------*/
/* 其他文件引入 */
/*----------------------------------------------------------------------*/

// 自定义头部功能
require get_template_directory() . '/inc/custom-header.php';

// 自定义模板标签
require get_template_directory() . '/inc/template-tags.php';

// 独立于主题模板的自定义函数
require get_template_directory() . '/inc/extras.php';

// 自定义器添加
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';