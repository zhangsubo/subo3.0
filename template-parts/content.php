<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package subo2017
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if ( !is_single() ) :
			the_title( '<h2 class="article-title "><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'subo' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'subo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php if (!is_single( )) :?>
	<footer class="article-footer">
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php subo_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</footer><!-- .entry-footer -->
	<hr class="long" />
	<?php else : ?>
	  <hr>
      <footer class="clearfix">
          <?php the_tags( '<ul class="tags">Tags:<li>#', '</li><li>、#' , '</li></ul>' ); ?>
          Category:<?php the_category('、' ); ?>
        <!-- <ul class="category">Category:<li><a href="">随笔</a></li></ul> -->
      </footer>
    <?php endif; ?>
</article><!-- #post-## -->
