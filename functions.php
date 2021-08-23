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
define('THEME_DIR', trailingslashit( get_template_directory() ));
define('THEME_URL', trailingslashit( get_template_directory_uri() ));
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
include_once (ZS_DIR . 'remove-head.php');//移除头部多余代码
include_once (ZS_DIR . 'custom-excerpt.php');//自定义文章摘要文字长度
// include_once (ZS_DIR . 'post-functions.php');
// include_once (ZS_DIR . 'paginate-links.php');
// include_once (ZS_DIR . '/widgets/widgets-info.php');
// include_once (ZS_DIR . 'remove-open-sans.php');
include_once (ZS_DIR . 'register-post.php');//定义post类型
include_once (ZS_DIR . 'option.php');//选项页面


if ( ! function_exists( 'subo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function subo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on subo2017, use a find and replace
	 * to change 'subo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'subo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'subo' ),
		'menu-2' => esc_html__( '友情链接', 'subo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'subo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'subo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function subo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'subo_content_width', 640 );
}
add_action( 'after_setup_theme', 'subo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
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

/**
 * 注册和引入样式
 */
function subo_style()
{
    wp_register_style('subo_normalize',CSS_URL . 'min/normalize-min.css',array(),'20170130' );
    wp_register_style('subo_fontawsome',CSS_URL . 'fontawsome/font-awesome.min.css', array() , '' );
    wp_register_style('subo_menu',CSS_URL.'min/meanmenu.min.css',array(),'20170130' );
    wp_register_style('subo_prism',CSS_URL . 'min/prism-min.css', array() , '20190511' );
    wp_register_style('subo_web',CSS_URL . 'min/style-min.css', array() , '20200613' );
    wp_enqueue_style('subo_normalize' );
    wp_enqueue_style( 'subo_fontawsome');
    wp_enqueue_style('subo_menu' );
	wp_enqueue_style('subo_prism' );
    wp_enqueue_style('subo_web' );
}
add_action('wp_enqueue_scripts' , 'subo_style' );
/**
 * 注册和引入js脚本
 */
function subo_scripts() {
	//wp_enqueue_script( 'subo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('subo_jquery',JS_URL. 'jquery-3.1.1.min.js',array(),'3.1.1',true);
	wp_enqueue_script('subo_menu',JS_URL. 'jquery.meanmenu-min.js',array(),'20170130',true );
	wp_enqueue_script('subo_main',JS_URL. 'main-min.js',array(),'20170130',true );
	wp_enqueue_script('subo_languages',JS_URL. 'prism-min.js',array(),'20190512',true );
}
add_action( 'wp_enqueue_scripts', 'subo_scripts' );
/**
 * 强制修改为 https
 */
function my_content_manipulator($content){
    if( is_ssl() ){
        $content = str_replace('https://zhangsubo.cn/wp-content/uploads', 'https://zhangsubo.cn/wp-content/uploads', $content);
    }
    return $content;
}
add_filter('the_content', 'my_content_manipulator');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
