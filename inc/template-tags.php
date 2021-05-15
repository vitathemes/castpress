<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package castpress
 */

if ( ! function_exists( 'castpress_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function castpress_posted_on( $castpress_is_bold = false , $link_class = " " ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		if( $castpress_is_bold ) {
			$castpress_is_bold = "font--semibold";
		} else {
			$castpress_is_bold = "font--regular";
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html( '%s', 'castpress' ),
			'<a class="u-link--tertiary" href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="c-post__date h5--secondary u-heading-5-line-height--sm '. esc_html($castpress_is_bold) .' posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'castpress_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function castpress_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'castpress' ),
			'<span class="author vcard h5--secondary u-heading-5-line-height--sm"><a class="url fn n c-post__author__link u-link--tertiary" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);


		echo '<span class="byline h5--secondary u-heading-5-line-height--sm c-post__author "> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'castpress_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function castpress_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'castpress' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'castpress' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'castpress' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'castpress' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'castpress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'castpress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'castpress_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function castpress_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

<div class="post-thumbnail">
    <?php the_post_thumbnail(); ?>
</div><!-- .post-thumbnail -->

<?php else :

	if ( has_post_thumbnail() ) {
		
?>
<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
    <?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
</a>
<?php 
	}
	else {
		echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
	}
	
		endif; // End is_singular().
	}
	
endif;


if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( !function_exists('castpress_get_page_name')) :
	/**
	 * get current page name (slug)
	 */
	function castpress_get_page_name() {

		global $post;
		$post_slug = $post->post_name;
		$post_slug = str_replace("-", " ", $post_slug);
		echo esc_html(esc_html($post_slug));
		
	}
endif;


if ( ! function_exists('castpress_archive_page_name')) :
	/**
	  * Get archive page name
	  */
	function castpress_archive_page_name() {
		if ( !is_front_page() && is_home() ) {
			echo "blog";
		}	
		if( is_archive() ){
			echo "archives";
		}
	}
endif;


if ( ! function_exists('castpress_get_thumbnail')) :
	/**
	 * Return thumbnail if exist
	 */
	function castpress_get_thumbnail() {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		else{
			echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
		}
}
endif;


if (! function_exists('castpress_get_single_thumbnail')) :
	/**
	 * Return thumbnail in single page
	 */
	function castpress_get_single_thumbnail( $castpress_DefaultThumbnail = true ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="'.esc_attr( 'c-single__thumbnail' ).'"><div class="'.esc_attr( 'c-single__image c-single__image--single' ).'">';
				the_post_thumbnail();
			echo '</div></div>';
		}
		else{
			if($castpress_DefaultThumbnail){
				echo '<div class="'.esc_attr( 'c-single__thumbnail' ).'"><div class="'.esc_attr( 'c-single__image c-single__image--single' ).'">';
					echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
				echo '</div></div>';
			}
		}
}
endif;


if (! function_exists('castpress_get_tags')) :
	/**
	  * Return Post tags
	  */
	function castpress_get_tags( $castpress_className = 'c-post__tag' ) {
		$post_tags = get_the_tags();
		if ($post_tags) {
			foreach($post_tags as $post_tag) {
				echo '<a class="'.esc_attr( $castpress_className ).' h4" href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">'. esc_html( $post_tag->name ). '</a>';
			}
		}
	}
endif;


if (! function_exists('castpress_get_category')) :
	/**
	  * Return Post category
	  */
	function castpress_get_category( $castpress_is_bold = false, $castpress_have_seprator = false ) {
		($castpress_is_bold) ? $castpress_is_bold = 'h5' : $castpress_is_bold = 'h5--secondary';
		($castpress_have_seprator) ? $castpress_have_seprator = "<span class='seprator h5 u-link--secondary'> | </span>" : $castpress_have_seprator = "";
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'castpress' ) );
		if ( $categories_list ) {
			/* translators: 1: $categories_list list of categories. Rendered from category section that client set in categories. $castpress_is_bold check if should render text bold or not ( Will add class) */
			echo '<span class="c-episode__category  '. esc_attr( $castpress_is_bold ) .' u-heading-5-line-height--sm">'. $categories_list .'</span>' . $castpress_have_seprator;// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;


if (! function_exists('castpress_get_podcast_audio')) :
	/**
	 * Return Podcast Audio and update Custom field
	 */
	function castpress_get_podcast_audio($post , $castpress_class_name = "") {
				
		// Get audio link from importer plugin
		$castpress_podcast_audio = get_post_meta( $post->ID, 'podcast_audio_file', true ); 

		if( empty(get_post_meta( $post->ID, '_castpress_audio_url', true ))  && !empty($castpress_podcast_audio) ){
		
			// Update Custom field link
			update_post_meta( $post->ID , '_castpress_audio_url', sanitize_text_field( $castpress_podcast_audio ) );
			
			$castpress_podcast_audio = get_post_meta( $post->ID, '_castpress_audio_url', true );

		}
		elseif( !empty(get_post_meta( $post->ID, '_castpress_audio_url', true )) ){

			$castpress_podcast_audio = get_post_meta($post->ID, '_castpress_audio_url', true);
						
		}
		else{
			$castpress_podcast_audio = null;
		}

			// Fill variable to display in front part
			$castpress_podcast_audio_shortcode = '[audio mp3="'.$castpress_podcast_audio.'" ][/audio]';
			$castpress_podcast_audio_shortcode = strval( $castpress_podcast_audio_shortcode);

			// if (isset($_POST['secondline_import_embed_player'])) {
				// 	$castpress_import_embed_player = sanitize_text_field($_POST['secondline_import_embed_player']);
				// 	update_post_meta($post_id_to_update, 'secondline_import_embed_player', $castpress_import_embed_player);
			// }
		
		if( !empty($castpress_podcast_audio) ){
			// Display the result
			echo '<div class="c-episode__player '.esc_attr( $castpress_class_name ).'">';
			echo do_shortcode($castpress_podcast_audio_shortcode);
			echo '</div>';

			// Download button
			// qa- saniztize aria label and translatable also use sprintf
			echo '<a class="btn btn--download" aria-label="download button" href="'.esc_attr($castpress_podcast_audio).'" download="'.esc_attr($castpress_podcast_audio).'"></a>';
		}
		
	}
endif;


if (! function_exists('castpress_get_default_pagination')) :
	/**
	* Show numeric pagination
	*/
	function castpress_get_default_pagination() {
		echo'<div class="c-pagination">' . wp_kses_post(
			paginate_links(
				array(
				'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
				'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
				)
			)) .'</div>';
	}
endif;


if ( ! function_exists( 'castpress_socials_links' ) ) :
	/**
	 * Display Social Networks
	 */
	function castpress_socials_links() {
		$castpress_facebook  = get_theme_mod( 'facebook', "" );
		$castpress_twitter   = get_theme_mod( 'twitter', "" );
		$castpress_instagram = get_theme_mod( 'instagram', "" );
		$castpress_linkedin  = get_theme_mod( 'linkedin', "" );
		$castpress_github    = get_theme_mod( 'github', "" );

		if ( $castpress_facebook ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>', esc_url( $castpress_facebook ), esc_html__( 'Facebook', 'castpress' ) );
		}

		if ( $castpress_twitter ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-twitter"></span></a>', esc_url( $castpress_twitter ), esc_html__( 'Twitter', 'castpress' ) );
		}

		if ( $castpress_instagram ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-instagram"></span></a>', esc_url( $castpress_instagram ), esc_html__( 'Instagram', 'castpress' ) );
		}

		if ( $castpress_linkedin ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>', esc_url( $castpress_linkedin ), esc_html__( 'Linkedin', 'castpress' ) );
		}

		if ( $castpress_github ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="c-social-share__icon--github"></span></a>', esc_url( $castpress_github ), esc_html__( 'Github', 'castpress' ) );
		}
	}
endif;


if ( ! function_exists( 'castpress_share_links' ) ) {
	/**
	 * Display Share icons 
	 */
	function castpress_share_links() {
		if ( get_theme_mod( 'show_share_icons', true ) ) {
			$castpress_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$castpress_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$castpress_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();

			echo sprintf( '<span class="c-social-share__title h4 u-heading-4-line-height--sm">%s</span>', esc_html_e( 'Share:', 'castpress' ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-facebook-alt c-social-share__item__icon"></span></a>', esc_url( $castpress_facebook_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-twitter c-social-share__item__icon"></span></a>', esc_url( $castpress_twitter_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-linkedin c-social-share__item__icon"></span></a>', esc_url( $castpress_linkedin_url ) );
		}
	}
}



if (! function_exists('castpress_get_podcast_player_link')) :
	/**
	  * Get publishers link from kirki 
	  */
	function castpress_get_podcast_player_link() {
		
		$castpress_spotify   		 = get_theme_mod( 'p_spotify_link' );
		$castpress_soundcloud   	 = get_theme_mod( 'p_soundcloud_link' );
		$castpress_apple 	    	 = get_theme_mod( 'p_apple_link' );
		$castpress_youtube  	  	 = get_theme_mod( 'p_youtube_link' );
		$castpress_stitcher      	 = get_theme_mod( 'p_stitcher_link' );
		$castpress_deezer    		 = get_theme_mod( 'p_deezer_link' );
		$castpress_google_podcasts   = get_theme_mod( 'p_google_podcasts_link' );
		$castpress_iheartradio    	 = get_theme_mod( 'p_iheartradio_link' );
		$castpress_overcast    	  	 = get_theme_mod( 'p_overcast_link' );
		$castpress_pandora    		 = get_theme_mod( 'p_pandora_link' );
		$castpress_pocketcasts    	 = get_theme_mod( 'p_pocketcasts_link' );
		$castpress_radiopublic   	 = get_theme_mod( 'p_radiopublic_link' );
		$castpress_rss    			 = get_theme_mod( 'p_rss_link' );
		$castpress_castro    		 = get_theme_mod( 'p_castro_link' );
		$castpress_castbox    		 = get_theme_mod( 'p_castbox_link' );
		$castpress_audible    		 = get_theme_mod( 'p_audible_link' );


		$castpress_all_publishers = array(
			$castpress_spotify, $castpress_soundcloud, $castpress_apple, $castpress_youtube, 
			$castpress_stitcher, $castpress_deezer, $castpress_google_podcasts, $castpress_iheartradio,
			$castpress_overcast, $castpress_pandora, $castpress_pocketcasts, $castpress_radiopublic,
			$castpress_rss, $castpress_castro, $castpress_castbox, $castpress_audible
		);
		
		$castpress_publisher_flag = 0;		
		foreach($castpress_all_publishers as $castpress_publisher){
			if( !empty($castpress_publisher)){
				$castpress_publisher_flag = 1;
				break;
			}
		}
				
		if($castpress_publisher_flag === 1){
		
			echo sprintf('<div class="c-episodes__share"><span class="c-episode__social-share__title font--semibold">%s</span>' , esc_html__( 'Listen on', 'castpress' ) );

			// Spotify
			if ( $castpress_spotify ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="bx-bxl-spotify" data-inline="false"></span>
				</a>', esc_url( $castpress_spotify ), esc_html__( 'Spotify', 'castpress' ) );
			}

			// Soundcloud
			if ( $castpress_soundcloud ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons c-episodes__social-share__icons--big" data-icon="ion-logo-soundcloud" data-inline="false"></span>
				</a>', esc_url( $castpress_soundcloud ), esc_html__( 'Soundcloud', 'castpress' ) );
			}

			// Apple Music
			if ( $castpress_apple ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="ant-design:apple-filled" data-inline="false"></span>
				</a>', esc_url( $castpress_apple ), esc_html__( 'Apple Music', 'castpress' ) );
			}

			// Youtube
			if ( $castpress_youtube ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="ant-design:youtube-filled" data-inline="false"></span>
				</a>', esc_url( $castpress_youtube ), esc_html__( 'Youtube', 'castpress' ) );
			}

			// stitcher
			if ( $castpress_stitcher ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:stitcher" data-inline="false"></span>
				</a>', esc_url( $castpress_stitcher ), esc_html__( 'stitcher', 'castpress' ) );
			}

			// deezer
			if ( $castpress_deezer ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="fa-brands:deezer" data-inline="false"></span>
				</a>', esc_url( $castpress_deezer ), esc_html__( 'deezer', 'castpress' ) );
			}

			// Google podcast
			if ( $castpress_google_podcasts ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-google-podcasts" data-inline="false"></span>
				</a>', esc_url( $castpress_google_podcasts ), esc_html__( 'Google podcast', 'castpress' ) );
			}

			// I heart radio
			if ( $castpress_iheartradio ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:iheartradio" data-inline="false"></span>
				</a>', esc_url( $castpress_iheartradio ), esc_html__( 'I heart radio', 'castpress' ) );
			}

			// Overcast
			if ( $castpress_overcast ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-overcast" data-inline="false"></span>
				</a>', esc_url( $castpress_overcast ), esc_html__( 'Overcast', 'castpress' ) );
			}

			// Pandora
			if ( $castpress_pandora ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-pandora" data-inline="false"></span>
				</a>', esc_url( $castpress_pandora ), esc_html__( 'Pandora', 'castpress' ) );
			}

			// Pocket casts
			if ( $castpress_pocketcasts ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:pocketcasts" data-inline="false"></span>
				</a>', esc_url( $castpress_pocketcasts ), esc_html__( 'Pocket casts', 'castpress' ) );
			}

			// Radio public
			if ( $castpress_radiopublic ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib:radiopublic" data-inline="false"></span>
				</a>', esc_url( $castpress_radiopublic ), esc_html__( 'Radio public', 'castpress' ) );
			}

			// Rss Feed
			if ( $castpress_rss ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="ic-baseline-rss-feed" data-inline="false"></span>
				</a>', esc_url( $castpress_rss ), esc_html__( 'Rss Feed', 'castpress' ) );
			}

			// Castro
			if ( $castpress_castro ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-castro" data-inline="false"></span>
				</a>', esc_url( $castpress_castro ), esc_html__( 'Castro', 'castpress' ) );
			}

			// castbox
			if ( $castpress_castbox ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:castbox" data-inline="false"></span>
				</a>', esc_url( $castpress_castbox ), esc_html__( 'castbox', 'castpress' ) );
			}

			// audible
			if ( $castpress_audible ) { 
				echo sprintf( '<a href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="la-audible" data-inline="false"></span>
				</a>', esc_url( $castpress_audible ), esc_html__( 'audible', 'castpress' ) );
			}

			echo '</div>';	
		}
		

	}

endif;