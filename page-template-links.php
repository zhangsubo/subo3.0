<?php
/**
 * Template Name: Links
 *
 * This is the template that displays all tags of post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package subo
 */

get_header();the_post(); ?>
<section class="links">
    <article class="my-item clearfix">
        <?php
        // 获取自定义文章类型的分类项目
        $custom_taxterms = wp_get_object_terms( $post->ID,'project', array('fields' => 'ids') );
        // 参数
        $args = array(
        'post_type' => 'project',// 文章类型
        'post_status' => 'publish',
        );
        $related_items = new WP_Query( $args );
        if ($related_items->have_posts()) :
        ?>
        <h2>张小璋的项目</h2>
        <div class="items clearfix">
        <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
          <div class="item">
            <?php the_post_thumbnail( array(300,225) ); ?>
            <?php
        if ( !is_single() ) :
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
        endif;?>
        </div>
        <?php endwhile;endif;
        // 重置文章数据
        wp_reset_postdata();
         ?>
        </div>
      </article>
    <article class="friends">
      <h2>张小璋的小伙伴们</h2>
        <?php wp_nav_menu( array( 'container' =>'none','theme_location' => 'menu-2', 'menu_id' => '友情链接' ) ); ?>
      </article>
</section>
<!-- END #main -->
<?php
get_footer();
