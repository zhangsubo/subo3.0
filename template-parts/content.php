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
		if (!is_single( )) {
			the_excerpt();
		}else{
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'subo' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'subo' ),
				'after'  => '</div>',
			) );}
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
		<div class="about-me" style="">
		    <h2>#About Me</h1>
		    <p style="line-height: 200%">张小璋，野蛮生长成世界500强企业供应链金融产品经理的法语毕业生。微信公众号：<a style="color:#ff6700;text-decoration:underline">张小璋碎碎念</a>（ID:<a style="color:#ff6700;text-decoration:underline"> SylvainZhang </a>）。<br>一直在互联网金融公司从事产品经理工作并负责互联网金融产品线，深耕互联网金融和区块链领域。「PMCAFF」、「人人都是产品经理」专栏作家、「PmTalk」签约作家。</p>
		</div>
    <?php endif; ?>
</article><!-- #post-## -->
