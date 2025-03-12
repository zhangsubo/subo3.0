<?php
/**
 * Template Name: Links
 *
 * 此模板用于显示所有文章标签和友情链接。
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package subo
 */

get_header();
the_post(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="links">
            <article class="my-item clearfix">
                <?php
                // 获取自定义文章类型的分类项目
                $custom_taxterms = wp_get_object_terms( 
                    $post->ID,
                    'project', 
                    array('fields' => 'ids') 
                );

                // 查询参数设置
                $args = array(
                    'post_type'    => 'project',    // 文章类型
                    'post_status'  => 'publish',    // 发布状态
                    'posts_per_page' => -1,         // 显示所有文章
                );

                $related_items = new WP_Query($args);

                if ($related_items->have_posts()) : 
                    ?>
                    <h2 class="section-title">张小璋的项目</h2>
                    <div class="items clearfix">
                        <?php 
                        while ($related_items->have_posts()) : 
                            $related_items->the_post(); 
                            ?>
                            <div class="item">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail(array(300, 225));
                                }
                                
                                if (!is_single()) {
                                    the_title(
                                        sprintf('<a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                        '</a>'
                                    );
                                }
                                ?>
                            </div>
                        <?php 
                        endwhile; 
                        ?>
                    </div><!-- .items -->
                    <?php
                endif;

                // 重置文章数据
                wp_reset_postdata();
                ?>
            </article><!-- .my-item -->

            <article class="friends">
                <h2 class="section-title">张小璋的小伙伴们</h2>
                <?php 
                wp_nav_menu(array(
                    'container'      => false,
                    'theme_location' => 'menu-2',
                    'menu_id'       => 'friends-links',
                    'menu_class'    => 'friends-list'
                )); 
                ?>
            </article><!-- .friends -->
        </section><!-- .links -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
