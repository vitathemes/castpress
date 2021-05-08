<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package makemeup
 */

if ( ! function_exists( 'makemeup_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function makemeup_posted_on( $makemeup_is_bold = false , $link_class = " " ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		if( $makemeup_is_bold ) {
			$makemeup_is_bold = "font--semibold";
		} else {
			$makemeup_is_bold = "font--regular";
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
			esc_html( '%s', 'makemeup' ),
			'<a class="a--tertiary" href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="c-post__date h5--secondary h5-lh--sm '. esc_html($makemeup_is_bold) .' posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'makemeup_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function makemeup_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'makemeup' ),
			'<span class="author vcard h5--secondary h5-lh--sm"><a class="url fn n c-post__author__link a--tertiary" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);


		echo '<span class="byline h5--secondary h5-lh--sm c-post__author "> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'makemeup_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function makemeup_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'makemeup' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'makemeup' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'makemeup' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'makemeup' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'makemeup' ),
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
					__( 'Edit <span class="screen-reader-text">%s</span>', 'makemeup' ),
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

if ( ! function_exists( 'makemeup_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function makemeup_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

<div class="post-thumbnail">
    <?php the_post_thumbnail(); ?>
</div><!-- .post-thumbnail -->

<?php else : ?>

<?php 

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
?>
<?php
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


if (! function_exists('makemeup_get_page_name')) :
	/**
	 * get current page name (slug)
	 */
	function makemeup_get_page_name() {

		global $post;
		$post_slug = $post->post_name;
		$post_slug = str_replace("-", " ", $post_slug);
		echo esc_html(esc_html($post_slug));
		
	}
endif;


if (! function_exists('makemeup_archive_page_name')) :
	/**
	  * Get archive page name
	  */
	function makemeup_archive_page_name() {
		if ( !is_front_page() && is_home() ) {
			echo "blog";
		}	
		if( is_archive() ){
			echo "archives";
		}
	}
endif;


if (! function_exists('makemeup_get_thumbnail')) :
	/**
	 * Return thumbnail if exist
	 */
	function makemeup_get_thumbnail() {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		else{
			echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
		}
}
endif;


if (! function_exists('makemeup_get_single_thumbnail')) :
	/**
	 * Return thumbnail in single page
	 */
	function makemeup_get_single_thumbnail( $makemeup_DefaultThumbnail = true ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="'.esc_attr( 'c-single__thumbnail' ).'"><div class="'.esc_attr( 'c-single__image c-single__image--single' ).'">';
				the_post_thumbnail();
			echo '</div></div>';
		}
		else{
			if($makemeup_DefaultThumbnail){
				echo '<div class="'.esc_attr( 'c-single__thumbnail' ).'"><div class="'.esc_attr( 'c-single__image c-single__image--single' ).'">';
					echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
				echo '</div></div>';
			}
		}
}
endif;


if (! function_exists('makemeup_get_tags')) :
	/**
	  * Return Post tags
	  */
	function makemeup_get_tags( $makemeup_className = 'c-post__tag' ) {
		$post_tags = get_the_tags();
		if ($post_tags) {
			foreach($post_tags as $post_tag) {
				echo '<a class="'.esc_attr( $makemeup_className ).' h4" href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">'. esc_html( $post_tag->name ). '</a>';
			}
		}
	}
endif;


if (! function_exists('makemeup_get_category')) :
	/**
	  * Return Post category
	  */
	function makemeup_get_category( $makemeup_is_bold = false , $makemeup_have_seprator = false ) {
		($makemeup_is_bold) ? $makemeup_is_bold = 'h5' : $makemeup_is_bold = 'h5--secondary';
		($makemeup_have_seprator) ? $makemeup_have_seprator = "<span class='seprator h5 a--secondary'> | </span>" : $makemeup_have_seprator = "";
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'makemeup' ) );
		if ( $categories_list ) {
			/* translators: 1: $categories_list list of categories. Rendered from category section that client set in categories. $makemeup_is_bold check if should render text bold or not ( Will add class) */
			echo '<span class="c-episode__category '. esc_attr( $makemeup_is_bold ) .' h5-lh--sm">'. $categories_list .'</span>' . $makemeup_have_seprator;// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;


if (! function_exists('makemeup_get_audio_podcast')) :
	/**
	 * Return Post category
	 */
	function makemeup_get_audio_podcast($post) {
		
		$podcast_audio = get_post_meta( $post->ID, 'podcast_audio_file', true ); 
		$makemeup_podcast_audio_shortcode = '[audio mp3="'.$podcast_audio.'" ][/audio]';
		$makemeup_podcast_audio_shortcode = strval( $makemeup_podcast_audio_shortcode);

		echo "<div class='c-episode__player'>";
		echo do_shortcode($makemeup_podcast_audio_shortcode);
		echo "</div>";

	}
endif;


if (! function_exists('makemeup_get_category_seperator')) :
	/**
	 * Return Post category
	 */
	function makemeup_get_category_seperator() {
		

		if( ! empty( get_the_category() ) ){
			/* get category */
			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			$category_counter = 0;
			if ( ! empty( $categories ) ) {
			
				foreach( $categories as $category ) {

					if( $isLimited === true && $category_counter === 3){
						break;
					}

					$category_counter++;
					/* translators: used between list items, there is a space after the comma */
					$output .= '<a class="c-post__meta__link" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'makemeup' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo  wp_kses_post(trim( $output, $separator ));
			}
		}
	}
endif;



if (! function_exists('makemeup_get_default_pagination')) :
	/**
	* Show numeric pagination
	*/
	function makemeup_get_default_pagination() {
		echo'<div class="c-pagination">' . wp_kses_post(
			paginate_links(
				array(
				'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
				'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
				)
			)) .'</div>';
	}
endif;


if ( ! function_exists( 'makemeup_socials_links' ) ) :
	/**
	 * Display Social Networks
	 */
	function makemeup_socials_links() {
		$makemeup_facebook  = get_theme_mod( 'facebook', "" );
		$makemeup_twitter   = get_theme_mod( 'twitter', "" );
		$makemeup_instagram = get_theme_mod( 'instagram', "" );
		$makemeup_linkedin  = get_theme_mod( 'linkedin', "" );
		$makemeup_github    = get_theme_mod( 'github', "" );

		if ( $makemeup_facebook ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>', esc_url( $makemeup_facebook ), esc_html__( 'Facebook', 'makemeup' ) );
		}

		if ( $makemeup_twitter ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-twitter"></span></a>', esc_url( $makemeup_twitter ), esc_html__( 'Twitter', 'makemeup' ) );
		}

		if ( $makemeup_instagram ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-instagram"></span></a>', esc_url( $makemeup_instagram ), esc_html__( 'Instagram', 'makemeup' ) );
		}

		if ( $makemeup_linkedin ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>', esc_url( $makemeup_linkedin ), esc_html__( 'Linkedin', 'makemeup' ) );
		}

		if ( $makemeup_github ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="c-social-share__icon--github"></span></a>', esc_url( $makemeup_github ), esc_html__( 'Github', 'makemeup' ) );
		}
	}
endif;


if ( ! function_exists( 'makemeup_share_links' ) ) {
	/**
	 * Display Share icons 
	 */
	function makemeup_share_links() {
		if ( get_theme_mod( 'show_share_icons', true ) ) {
			$makemeup_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$makemeup_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$makemeup_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();

			echo sprintf( '<span class="c-social-share__title h4 h4-lh--sm">%s</span>', esc_html_e( 'Share:', 'makemeup' ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-facebook-alt c-social-share__item__icon"></span></a>', esc_url( $makemeup_facebook_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-twitter c-social-share__item__icon"></span></a>', esc_url( $makemeup_twitter_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-linkedin c-social-share__item__icon"></span></a>', esc_url( $makemeup_linkedin_url ) );
		}
	}
}



if (! function_exists('makemeup_get_podcast_player_link')) :
	/**
	* get social media 
	*/
	function makemeup_get_podcast_player_link() {


		echo '<div class="c-episodes__share"> <span class="c-episode__social-share__title font--semibold">Listen on</span>';

		// Spotify
		if ( get_theme_mod('p_spotify_link') != null) { 
		
			echo '
			<a href="'. esc_url(get_theme_mod('p_spotify_link')) .'">
			<span class="iconify c-episodes__social-share__icons" data-icon="bx-bxl-spotify" data-inline="false"></span>
			</a>';
			
		}

		// Soundcloud
		if ( get_theme_mod('p_soundcloud_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_soundcloud_link')) .'">
				<span class="iconify c-episodes__social-share__icons c-episodes__social-share__icons--big" data-icon="ion-logo-soundcloud" data-inline="false"></span>
			</a>';
			
		}
		
		// Podcasts (Apple Podcasts)
		if ( get_theme_mod('p_apple_link') != null) { 
		
			echo '
			<a href="'. esc_url(get_theme_mod('p_apple_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="ant-design:apple-filled" data-inline="false"></span>
			</a>';
			
		}

		// Youtube
		if ( get_theme_mod('p_youtube_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_youtube_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="ant-design:youtube-filled" data-inline="false"></span>
			</a>';
			
		}
		
		
		// Stitcher
		if ( get_theme_mod('p_stitcher_link') != null) { 
		
			echo '
			<a href="'. esc_url(get_theme_mod('p_stitcher_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:stitcher" data-inline="false"></span>
			</a>';
			
		}

		// Deezer
		if ( get_theme_mod('p_deezer_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_deezer_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="fa-brands:deezer" data-inline="false"></span>
			</a>';
			
		}
		
		// Google podcasts
		if ( get_theme_mod('p_google_podcasts_link') != null) { 
		
			echo '
			<a href="'. esc_url(get_theme_mod('p_google_podcasts_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-google-podcasts" data-inline="false"></span>
			</a>';
			
		}

		// I heart radio
		if ( get_theme_mod('p_iheartradio_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_iheartradio_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:iheartradio" data-inline="false"></span>
			</a>';
			
		}
		
		// Overcast
		if ( get_theme_mod('p_overcast_link') != null) { 
		
			echo '
			<a href="'. esc_url(get_theme_mod('p_overcast_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-overcast" data-inline="false"></span>
			</a>';
			
		}

		// Pandora
		if ( get_theme_mod('p_pandora_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_pandora_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-pandora" data-inline="false"></span>
			</a>';
			
		}
		
		// Pocket casts
		if ( get_theme_mod('p_pocketcasts_link') != null) { 
		
			echo '
			<a href="'. esc_url(get_theme_mod('p_pocketcasts_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:pocketcasts" data-inline="false"></span>
			</a>';
			
		}

		// Radio public
		if ( get_theme_mod('p_radiopublic_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_radiopublic_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib:radiopublic" data-inline="false"></span>
			</a>';
			
		}

		
		// Rss Feed
		if ( get_theme_mod('p_rss_link') != null) { 
	
			echo '
			<a href="'. esc_url(get_theme_mod('p_rss_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="ic-baseline-rss-feed" data-inline="false"></span>
			</a>';
			
		}
	
		// Spreaker
		if ( get_theme_mod('p_spreaker_link') != null) { 

			echo '
			<a href="'. esc_url(get_theme_mod('p_spreaker_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-spreaker" data-inline="false"></span>
			</a>';
			
		}

		// Audible
		if ( get_theme_mod('p_castro_link') != null) { 

			echo '
			<a href="'. esc_url(get_theme_mod('p_castro_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-castro" data-inline="false"></span>
			</a>';
			
		}

		// Castbox
		if ( get_theme_mod('p_castbox_link') != null) { 

			echo '
			<a href="'. esc_url(get_theme_mod('p_castbox_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:castbox" data-inline="false"></span>
			</a>';
			
		}

		// audible
		if ( get_theme_mod('p_audible_link') != null) { 

			echo '
			<a href="'. esc_url(get_theme_mod('p_audible_link')) .'">
				<span class="iconify c-episodes__social-share__icons" data-icon="la-audible" data-inline="false"></span>
			</a>';
			
		}

		echo '</div>';	

	}

endif;


if ( ! function_exists( 'makemeup_render_newsletter' ) ) {
	/**
	 * Display Share icons qa-
	 */
	function makemeup_render_newsletter() {
	

		echo '<div class="c-footer__widget">

		<h2 class="c-footer__widget__title">NEWSLETTER</h2>
		<p class="c-footer__widget__desc span">Sign up now; get closer to our action.</p>

		<div class="tnp tnp-widget">
			<form method="post" action="//localhost:3000/?na=s">
				<input type="hidden" name="nr" value="widget" />
				<input type="hidden" name="nlang" value="" />
						<div class="tnp-field tnp-field-email">
							<label for="tnp-email"></label>
							<input class="c-tnp-email" type="email" name="ne" value="" required=""
								placeholder="Email  address..." />
						</div>
						<button onclick="window.alert("Submit button clicked")" aria-label="Search" type="submit"
							class="btn c-footer__newsletter-submit">
						</button>
					</form>
				</div>

			</div>
		</div>';

	}
}