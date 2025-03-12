<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package subo2017
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        if ( have_posts() ) {
            ?>
            <div class="posts-wrapper">
                <?php
                /* 开始循环 */
                while ( have_posts() ) {
                    the_post();

                    /*
                     * 包含特定文章格式的模板。
                     * 如果要在子主题中覆盖此模板，请包含一个名为 content-___.php 的文件
                     * （其中 ___ 是文章格式名称），该文件将被优先使用。
                     */
                    get_template_part( 'template-parts/content', get_post_format() );
                }
                ?>
            </div><!-- .posts-wrapper -->

            <?php
            the_posts_navigation( array(
                'prev_text' => __( '← Older posts', 'subo2017' ),
                'next_text' => __( 'Newer posts →', 'subo2017' ),
            ) );

        } else {
            get_template_part( 'template-parts/content', 'none' );
        }
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
