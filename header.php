<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package subo2017
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="website-header">
        <div class="top clearfix">
            <div class="logo"><a href="<?php bloginfo('url') ?>"><?php $website=home_url( );echo str_replace('http://', '', $website); ?></a></div>
            <div id="navigation">
                <nav>
                    <?php wp_nav_menu( array( 'container' =>'none','theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
                </nav>
            </div>
            </div>
        <section class="slogan text-center">
		    <?php if(is_front_page()&&is_home()){ ?>
               <div class="big-title "><?php bloginfo('name'); ?></div>
               <hr class="small" />
               <div class="small-title "><?php bloginfo('description'); ?></div>
        <?php } elseif(is_page( )||is_category()||is_tag()) { ?>
               <div class="big-title"><?php echo the_title(); ?></div>
               <hr class="small" />
               <div class="small-title"><?php the_field('page-en'); ?></div>
        <?php }elseif(is_single()) {?>
			         <div class="article-title"><?php the_title(); ?></div>
               <hr class="small" />
        <?php
			     if ( have_posts() ) {
				      while ( have_posts() ) {
		    	       the_post();
					       subo_posted_on();
	             }
         	}
		?>
         <?php }elseif(!have_posts()){ ?>
         <div class="big-title">404!No Fond</div>
               <hr class="small" />
              <div class="small-title">你搜索的东西坐宇宙飞船去了火星，┗|｀O′|┛ 嗷~~</div>
          <?php }elseif(is_search()){ ?>
              <div class="big-title"><?php echo get_search_query() ?></div>
              <hr class="small" />
              <div class="small-title">搜索结果</div>
          <?php } ?>
</section>
    </header>
