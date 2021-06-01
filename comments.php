<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
		if ( post_password_required() ) {
			return;
		}		
		$castpress_comment_counter = get_comments_number();
?>
<div id="comments" class="comments-area">

    <?php
	

		//Custom comment form 
		$comments_args = array(
			//Define Fields
			'fields' => array(
				//Author field
				'author' => '<h4 class="comment-form-author u-heading-4-line-height--bg">'. __( 'Name*', 'castpress' ).'<br /><input type="text" id="author" name="author" aria-required="true" ></input></h4>',
				//Email Field
				'email' => '<h4 class="comment-form-email u-heading-4-line-height--bg">'. __( 'Email*', 'castpress' ).'<br /><input type="email" id="email" name="email" ></input></h4>',
				//URL Field
				'url' => '<h4 class="comment-form-url u-heading-4-line-height--bg">'. __( 'Website', 'castpress' ).'<br /><input type="url" id="url" name="url" ></input></h4>',
				//Cookies
				'cookies' => '<div class="c-comment__cookie"><input type="checkbox" name="wp-comment-cookies-consent" required><span class="h6 h6--regular u-line-height--sm c-comments__cookie">' . __(' Save my name, email, and website in this browser for the next time I comment', 'castpress' ) .'</span></div>',
			),
			// Change the title of send button
			'label_submit' => __( 'Submit', 'castpress'),
			// Change the title of the reply section
			'title_reply_to' =>  __( 'Reply' , 'castpress'),
			//Cancel Reply Text
			'cancel_reply_link' =>  __( 'Cancel Reply', 'castpress' ),
			// Redefine your own textarea (the comment body).
			'comment_field' => '<h4 class="comment-form-comment u-heading-4-line-height--bg">'. __( 'Comment*', 'castpress' ).'<br /><textarea id="comment" name="comment" aria-required="true" ></textarea></p>',
			//Message Before Comment
			'comment_notes_before' =>'<h5 class="c-comments__desc u-heading-5-line-height--sm u-font--regular">'. __( 'Required fields are marked *' , 'castpress') .'</h5>',
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after' => '',
			//Submit Button ID
			'id_submit' =>  __( 'comment-submit' , 'castpress'),
			'class_submit' =>  __( 'castpress-comment-submit' , 'castpress'),
		);
		comment_form( $comments_args );

		// You can start editing here -- including this comment!
		if ( have_comments() ) :
?>

    <h4 class="comments-title u-heading-4-line-height--sm u-font--semibold">
        <?php
			$castpress_comment_count = get_comments_number();
			if ( '1' === $castpress_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'Comments', 'castpress' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( 'Comments', 'Comments', $castpress_comment_count, 'comments title', 'castpress' ) ),
					number_format_i18n( $castpress_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
		?>
    </h4><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
        <?php
			wp_list_comments(
				array(
					'walker'      => new Castpress_walker_comment(),
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 144,
				)
			);
			?>
    </ol><!-- .comment-list -->

    <?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'castpress' ); ?></p>
    <?php
		endif;
	endif; // Check for have_comments().
	?>

</div><!-- #comments -->