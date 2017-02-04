<?php
/**
 * Template Name: Tags
 *
 * This is the template that displays all tags of post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package subo
 */

get_header();the_post(); ?>
<section>
    <article id="page-<?php the_ID(); ?>" <?php post_class('Article'); ?>>
        <?php
            $tags = get_tags( array(
                'hide_empty' => false
            ) );
            $html = '<ul class="tags">';

            foreach ($tags as $tag) {
                $tag_link = get_tag_link( $tag->term_id );
                $html .= "<li class='tag'><a href='{$tag_link}' title='{$tag->name}'>";
                $html .= "{$tag->name}</a></li>";
            }

            $html .= '</ul>';
            echo $html;
        ?>
    </article>
    <!-- END .Article -->
</section>
<!-- END #main -->
<?php
get_footer();
