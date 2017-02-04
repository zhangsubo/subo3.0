<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package subo2017
 */

if ( ! function_exists( 'subo_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function subo_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	// $byline = the_author( );

	echo '<div class="article-posted">Posted by '. get_the_author( ) .' on '.$time_string .'</div>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'subo_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function subo_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'subo' ) );
		if ( $categories_list && subo_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'subo' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'subo' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'subo' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'subo' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'subo' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function subo_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'subo_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'subo_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so subo_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so subo_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in subo_categorized_blog.
 */
function subo_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'subo_categories' );
}
add_action( 'edit_category', 'subo_category_transient_flusher' );
add_action( 'save_post',     'subo_category_transient_flusher' );

/**
 * Post comments
 * @param  string $comment
 * @param  string $args
 * @param  string $depth
 * @return string
 */
function subo_comments( $comment , $args , $depth ) {
	$GLOBALS['comment'] = $comment;
    $comment_post = get_post($comment->comment_post_ID);
?>
	<!-- commment -->
    <li id="comment-<?php echo $comment->comment_ID; ?>" <?php comment_class('Comment'); ?>>
    	<?php
          $avatar_size = 48;
        ?>
    	<div class="Comment__media">
    		<?php echo get_avatar($comment,$avatar_size); ?>
    	</div>
    	<div class="Comment__body">
      		<div class="Comment__heading">
      			<div class="Comment__meta">
      				<div class="Comment__username"><?php comment_author(); ?></div>
      				<div class="Comment__date"><?php echo get_comment_date(); ?></div>
      			</div>
      			<div class="Comment__actions">
      				<span class="Comment__reply"><?php comment_reply_link(array_merge($args,array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
      			</div>
			</div>
      		<?php if ($comment->comment_approved == '0') : ?>
            <div class="Alert Alert--warning"><?php _e('Your comment is awaiting approval.','subo');?></div>
        	<?php endif; ?>
	        <?php comment_text(); ?>
    	</div>
    </li>
    <!-- End .Comment -->
<?php
}

function subo_comment_form_defaults($defaults) {
	// $defaults['comment_notes_before'] = '';
    // $defaults['comment_notes_after'] = '';
    $defaults['comment_field'] = '<div class="comment-form__comment">
                                    <textarea placeholder="'. __('Say something nice!', 'subo') .'" required name="comment" id="comment" rows="3"></textarea>
                                  </div>';
    $defaults['submit_field'] = '<div class="comment-form__submit">%1$s %2$s</div>';
    $defaults['submit_button'] = '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>';
    $defaults['class_submit'] = 'btn btn-primary';
    // $defaults['logged_in_as'] = '';
    // $defaults['must_log_in'] = '';
    return $defaults;
}
add_filter('comment_form_defaults','subo_comment_form_defaults');

function subo_comment_fields( $fields ) {

	$commenter 	= wp_get_current_commenter();

	$req      	= get_option( 'require_name_email' );
   	$aria_req 	= ( $req ? " aria-required='true'" : '' );
	$html_req 	= ( $req ? " required='required'" : '' );
	$req_hint 	= ( $req ? "*": "" );

    $fields   	=  array(
		'author' => '<div class="comment-form__author">' .
		            '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__('Name', 'subo') . $req_hint . '"' . $aria_req . $html_req . ' /></div>',
		'email'  => '<div class="comment-form__email">' .
		            '<input id="email" name="email" type="email" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__('Email', 'subo') . $req_hint . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
		'url'    => '<div class="comment-form__url">' .
		            '<input id="url" name="url" type="url" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'. esc_attr__('Website', 'subo') .'" /></div>'
	);

    return $fields;
}
add_filter('comment_form_default_fields','subo_comment_fields');

function subo_password_form() {
	global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="form-inline" method="post">
    <p class="help-block">' . __( "To view this protected post, enter the password below:", "subo" ) . '</p>
    <div class="form-group"><label for="' . $label . '">' . __( "Password:", "subo" ) . ' </label><input name="post_password" id="' . $label . '" type="password" class="form-control" size="20" maxlength="20" /></div><div class="form-group"><input type="submit" name="Submit" class="form-control" value="' . esc_attr__( "Submit", "subo" ) . '" /></div>
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'subo_password_form' );
