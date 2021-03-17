<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
		if ( post_password_required() ) {
			return;
		}
		
		$makemeup_comment_counter = get_comments_number();
?>

<div id="comments" class="comments-area">


    <?php

		//Declare Vars
		$comment_send = 'Submit';
		$comment_reply = 'Leave a Reply';
		$comment_reply_to = 'Reply';

		$comment_author = 'Name';
		$comment_email = 'E-Mail';
		$comment_body = 'Comment';
		$comment_url = 'Website';
		$comment_cookies_1 = ' Save my name, email, and website in this browser for the next time I comment';
		$comment_cookies_2 = ' Privacy Policy';

		$comment_before = 'Required fields are marked *';

		$comment_cancel = 'Cancel Reply';

		//Custom comment form 
		$comments_args = array(
			//Define Fields
			'fields' => array(
				//Author field
				'author' => '<p class="comment-form-author h4 h4-lh--bg">Name*<br /><input type="text" id="author" name="author" aria-required="true" ></input></p>',
				//Email Field
				'email' => '<p class="comment-form-email h4 h4-lh--bg">Email*<br /><input type="email" id="email" name="email" ></input></p>',
				//URL Field
				'url' => '<p class="comment-form-url h4 h4-lh--bg">Website<br /><input type="url" id="url" name="url" ></input></p>',
				//Cookies
				'cookies' => '<div class="c-comment__cookie"><input type="checkbox" name="wp-comment-cookies-consent" required><span class="c-comments__cookie">' . $comment_cookies_1 .'</span></div>',
			),
			// Change the title of send button
			'label_submit' => __( $comment_send ),
			// Change the title of the reply section
			'title_reply' => '<p class="c-comments__title h4 h4-lh--sm font--semibold">'.$comment_reply .'</p>',
			// Change the title of the reply section
			'title_reply_to' => __( $comment_reply_to ),
			//Cancel Reply Text
			'cancel_reply_link' => __( $comment_cancel ),
			// Redefine your own textarea (the comment body).
			'comment_field' => '<p class="comment-form-comment h4 h4-lh--bg">Comment *<br /><textarea id="comment" name="comment" aria-required="true" ></textarea></p>',
			//Message Before Comment
			'comment_notes_before' =>'<p class="c-comments__desc h5--secondary h5-lh--sm font--regular">'. $comment_before .'</p>',
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after' => '',
			//Submit Button ID
			'id_submit' => __( 'comment-submit' ),
			'class_submit' => __( 'makemeup-comment-submit' ),
		);
		

		comment_form( $comments_args );


		// You can start editing here -- including this comment!
		if ( have_comments() ) :
		
?>

    <h2 class="comments-title h4--secondary h4-lh--sm">
        <?php
			$makemeup_comment_count = get_comments_number();
			if ( '1' === $makemeup_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'Comments', 'makemeup' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( 'Comments', 'Comments', $makemeup_comment_count, 'comments title', 'makemeup' ) ),
					number_format_i18n( $makemeup_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
    </h2><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
        <?php
			wp_list_comments(
				array(
					'walker'      => new Makemeup_walker_comment(),
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
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'makemeup' ); ?></p>
    <?php
		endif;

	endif; // Check for have_comments().
	

	?>

</div><!-- #comments -->