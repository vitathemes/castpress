<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package castpress
 */


if ( ! function_exists( 'castpress_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function castpress_posted_by() {

		/* translators: %s: post author. */
		$byline = sprintf(
			'<span class="c-post__author vcard u-font--regular  u-heading-5-line-height--sm"><a class="url fn n c-post__author__link u-link--tertiary" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> %s ' . esc_html(get_the_author()) . ' </a></span>' , esc_html__( 'By', 'castpress' )
		);

		echo '<h5 class="byline u-font--regular u-heading-5-line-height--sm c-post__author "> ' . $byline  . '</h5>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;


if ( ! function_exists( 'castpress_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 */
	function castpress_post_thumbnail() {
	
		if ( is_singular() ) :

			echo '<div class="post-thumbnail">';
		    	the_post_thumbnail();
			echo '</div><!-- .post-thumbnail -->';
		
 		else :

			if ( has_post_thumbnail() ) { ?>
			<a class="post-thumbnail" href="<?php echo esc_attr( the_permalink() ); ?> " aria-hidden="true" tabindex="-1">

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
				echo '<img alt="'.esc_attr__( 'no thumbnail', 'castpress' ).'" src="' . esc_url( get_template_directory_uri() ). '/assets/images/no-thumbnail.png" />';
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


if ( ! function_exists('castpress_get_thumbnail')) :
	/**
	 * Return thumbnail if exist
	 */
	function castpress_get_thumbnail( $castpress_image_size = "full" ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $castpress_image_size );
		}
		else{
			echo '<img alt="'.esc_attr__( 'no thumbnail', 'castpress' ).'" src="' . esc_url(get_template_directory_uri()). '/assets/images/no-thumbnail.png" />';
		}
}
endif;


if (! function_exists('castpress_get_single_thumbnail')) :
	/**
	  * Return thumbnail in single page
	  */
	function castpress_get_single_thumbnail( $castpress_DefaultThumbnail = true, $castpress_image_size = "full" ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="'.esc_attr( 'c-single__thumbnail' ).'"><div class="'.esc_attr( 'c-single__image c-single__image--single' ).'">';
				the_post_thumbnail($castpress_image_size);
			echo '</div></div>';
		}
		else{
			if($castpress_DefaultThumbnail){
				echo '<div class="'.esc_attr( 'c-single__thumbnail' ).'"><div class="'.esc_attr( 'c-single__image c-single__image--single' ).'">';
					echo '<img alt="'.esc_attr__( 'no thumbnail', 'castpress' ).'" src="' . esc_url(get_template_directory_uri()). '/assets/images/no-thumbnail.png" />';
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
			$castpress_tags = "";
			foreach($post_tags as $post_tag) {
				$castpress_tags .= '<a class="'.esc_attr( $castpress_className ).' h4" href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">'. esc_html( $post_tag->name ). '</a>';
			}
			echo wp_kses_post(sprintf('<div class="c-single__tags">%s</div>' ,  $castpress_tags));
		}
	}
endif;


if (! function_exists('castpress_get_category')) :
	/**
	  * Return Post category
	  */
	function castpress_get_category( $castpress_have_seprator = false ) {
		($castpress_have_seprator) ? $castpress_have_seprator = "<span class='seprator h5 u-link--secondary'> ".esc_html( " | " )." </span>" : $castpress_have_seprator = "";
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'castpress' ) );
		if ( $categories_list ) {
			/* $categories_list list of categories. Rendered from category section that client set in categories.*/
			echo '<h5 class="c-episode__category u-font--regular u-heading-5-line-height--sm">'.  wp_kses_post($categories_list) .'</h5>' . wp_kses_post($castpress_have_seprator) ;// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;


if ( ! function_exists('castpress_get_podcast_audio')) :

	/**
	  * Return Podcast Audio and Update Custom Field
	  */
	function castpress_get_podcast_audio($post , $castpress_class_name = "",  $castpress_button_class_name = "" ) {
		
		// Get audio link from importer plugin
		$castpress_podcast_audio_link = get_post_meta( $post->ID, 'podcast_audio_url', true );
		// Get audio file from importer plugin
		$castpress_podcast_audio = get_post_meta( $post->ID, 'podcast_audio_file', true );
		// Get embeded aufio file
		$castpress_podcast_embedfile = get_post_meta( $post->ID, 'podcast_importer_external_embed', true);


		if(class_exists('ACF')){
			// Get imported audio link if acf existed
			$castpress_acf_podcast_audio_field = get_field('podcast_audio_file'); 
		}
		else{
			$castpress_acf_podcast_audio_field = null;
		}

	
		if( empty($castpress_acf_podcast_audio_field) && !empty($castpress_podcast_audio) ){

			if( class_exists('ACF') &&  empty($castpress_acf_podcast_audio_field) ){
				// Update Custom field link
				update_field( 'podcast_audio_file' , $castpress_podcast_audio );
			}
			else{
				// Reset the global variable 
				$castpress_podcast_audio = get_post_meta( $post->ID, 'podcast_audio_file', true );
			}
			
		}
		elseif ( !empty($castpress_acf_podcast_audio_field) ) {
			// if acf field was not empty ,read from field
			$castpress_podcast_audio = $castpress_acf_podcast_audio_field;
		}
		else {
			$castpress_podcast_audio = null;
		}

		$tagname = substr($castpress_podcast_embedfile ,0 , 7);

		if( !empty($castpress_podcast_audio) ){
			if(strpos($tagname, 'iframe') !== false) {
				
				// Return just the custom player 
				/* translators: %s: class name . translator 2 %s : audio short code  */
				echo sprintf('<div class="c-episode__player js-episode__player--embed %s">%s</div>' , esc_attr( $castpress_class_name ) , do_shortcode($castpress_podcast_embedfile) );

			}
			elseif(strpos($tagname, 'audio') !== false) {

				// Get src attribute from embeded file
				$castpress_podcast_embedfile_link = $castpress_podcast_embedfile;
				$castpress_audio_src_array = array();
				preg_match( '/src="([^"]*)"/i', $castpress_podcast_embedfile_link, $castpress_audio_src_array );

				$castpress_attributes = array(
					'src'      => esc_url( $castpress_audio_src_array[1] ),
					'loop'     => '',
					'autoplay' => '',
					'preload'  => 'auto'
				);
				$castpress_podcast_embedfile = wp_audio_shortcode( $castpress_attributes );

				/* translators: %s: class name . translator 2 %s : audio short code  */
				echo sprintf('<div class="c-episode__player %s">%s</div>' , esc_attr( $castpress_class_name ) , do_shortcode($castpress_podcast_embedfile) );
				
				// Download button
				echo '<a class="c-btn c-btn--download '.esc_attr( $castpress_button_class_name ).'" aria-label="'. esc_attr('Download button' , 'castpress') .'" href="'.esc_attr($castpress_podcast_audio).'" download="'.esc_attr($castpress_podcast_audio).'"></a>';

			}
			elseif( class_exists('ACF') &&  get_field('podcast_audio_file') !== $castpress_podcast_audio_link ){
					
				$castpress_podcast_updated_field = get_field('podcast_audio_file');
				$castpress_podcast_embedfile = '[audio preload="metadata" mp3="'.$castpress_podcast_updated_field.'" ][/audio]';

				/* translators: %s: class name . translator 2 %s : audio short code  */
				echo sprintf('<div class="c-episode__player %s">%s</div>' , esc_attr( $castpress_class_name ) , do_shortcode($castpress_podcast_embedfile) );
		
				// Download button
				echo '<a class="c-btn c-btn--download '.esc_attr( $castpress_button_class_name ).'" aria-label="'. esc_attr('Download button' , 'castpress') .'" href="'.esc_attr($castpress_podcast_audio).'" download="'.esc_attr($castpress_podcast_audio).'"></a>';



			}
		
		}	
	}
endif;


if (! function_exists('castpress_get_default_pagination')) :
	/**
	  * Show numeric pagination
	  */
	function castpress_get_default_pagination() {
		if(paginate_links()) {
			echo'<div class="c-pagination">' . wp_kses_post(
				paginate_links(
					array(
					'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
					'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
					)
			)) .'</div>';
		}
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

			echo sprintf( '<h4 class="c-social-share__title u-heading-4-line-height--sm">%s</h4>', esc_html__( 'Share:', 'castpress' ) );
			echo sprintf( '<a  class="c-social-share__item" target="_blank" href="%s" aria-label="%s" ><span class="dashicons dashicons-facebook-alt c-social-share__item__icon"></span></a>', esc_url( $castpress_facebook_url ), esc_html__( "facebook" , "castpress" ) );
			echo sprintf( '<a  class="c-social-share__item" target="_blank" href="%s" aria-label="%s" ><span class="dashicons dashicons-twitter c-social-share__item__icon"></span></a>', esc_url( $castpress_twitter_url ), esc_html__( "twitter" , "castpress" ) );
			echo sprintf( '<a  class="c-social-share__item" target="_blank" href="%s" aria-label="%s" ><span class="dashicons dashicons-linkedin c-social-share__item__icon"></span></a>', esc_url( $castpress_linkedin_url ), esc_html__( "linkedin" , "castpress" ) );
		}
	}
}


if (! function_exists('castpress_get_podcast_player_link')) :
	/**
	  * Get publishers link from kirki 
	  */
	function castpress_get_podcast_player_link( $castpress_class_name = "" ) {
		
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
		$castpress_spreaker    		 = get_theme_mod( 'p_spreaker_link' );


		$castpress_all_publishers = array(
			$castpress_spotify, $castpress_soundcloud, $castpress_apple, $castpress_youtube, 
			$castpress_stitcher, $castpress_deezer, $castpress_google_podcasts, $castpress_iheartradio,
			$castpress_overcast, $castpress_pandora, $castpress_pocketcasts, $castpress_radiopublic,
			$castpress_rss, $castpress_castro, $castpress_castbox, $castpress_audible,$castpress_spreaker 
		);
		
		$castpress_publisher_flag = 0;		
		foreach($castpress_all_publishers as $castpress_publisher){
			if( !empty($castpress_publisher)){
				$castpress_publisher_flag = 1;
				break;
			}
		}
				
		if($castpress_publisher_flag === 1){
		
			/* Translator %s : title class name , translator 2 %s : The title  */
			echo sprintf('<div class="c-episodes__share %s"><span class="c-episode__social-share__title h6 u-line-height--sm">%s</span>' , esc_attr($castpress_class_name) , esc_html__( 'Listen on', 'castpress' ) );

			// Spotify
			if ( $castpress_spotify ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="bx-bxl-spotify" data-inline="false"></span>
				</a>', esc_url( $castpress_spotify ), esc_html__( 'Spotify', 'castpress' ) );
			}

			// Soundcloud
			if ( $castpress_soundcloud ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons c-episodes__social-share__icons--big" data-icon="akar-icons:soundcloud-fill" data-inline="false"></span>
				</a>', esc_url( $castpress_soundcloud ), esc_html__( 'Soundcloud', 'castpress' ) );
			}

			// Apple Music
			if ( $castpress_apple ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="ant-design:apple-filled" data-inline="false"></span>
				</a>', esc_url( $castpress_apple ), esc_html__( 'Apple Music', 'castpress' ) );
			}

			// Youtube
			if ( $castpress_youtube ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="ant-design:youtube-filled" data-inline="false"></span>
				</a>', esc_url( $castpress_youtube ), esc_html__( 'Youtube', 'castpress' ) );
			}

			// stitcher
			if ( $castpress_stitcher ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:stitcher" data-inline="false"></span>
				</a>', esc_url( $castpress_stitcher ), esc_html__( 'stitcher', 'castpress' ) );
			}

			// deezer
			if ( $castpress_deezer ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="fa-brands:deezer" data-inline="false"></span>
				</a>', esc_url( $castpress_deezer ), esc_html__( 'deezer', 'castpress' ) );
			}

			// Google podcast
			if ( $castpress_google_podcasts ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-google-podcasts" data-inline="false"></span>
				</a>', esc_url( $castpress_google_podcasts ), esc_html__( 'Google podcast', 'castpress' ) );
			}

			// I heart radio
			if ( $castpress_iheartradio ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:iheartradio" data-inline="false"></span>
				</a>', esc_url( $castpress_iheartradio ), esc_html__( 'I heart radio', 'castpress' ) );
			}

			// Overcast
			if ( $castpress_overcast ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-overcast" data-inline="false"></span>
				</a>', esc_url( $castpress_overcast ), esc_html__( 'Overcast', 'castpress' ) );
			}

			// Pandora
			if ( $castpress_pandora ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-pandora" data-inline="false"></span>
				</a>', esc_url( $castpress_pandora ), esc_html__( 'Pandora', 'castpress' ) );
			}

			// Pocket casts
			if ( $castpress_pocketcasts ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:pocketcasts" data-inline="false"></span>
				</a>', esc_url( $castpress_pocketcasts ), esc_html__( 'Pocket casts', 'castpress' ) );
			}

			// Radio public
			if ( $castpress_radiopublic ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib:radiopublic" data-inline="false"></span>
				</a>', esc_url( $castpress_radiopublic ), esc_html__( 'Radio public', 'castpress' ) );
			}

			// Rss Feed
			if ( $castpress_rss ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="ic-baseline-rss-feed" data-inline="false"></span>
				</a>', esc_url( $castpress_rss ), esc_html__( 'Rss Feed', 'castpress' ) );
			}

			// Castro
			if ( $castpress_castro ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib-castro" data-inline="false"></span>
				</a>', esc_url( $castpress_castro ), esc_html__( 'Castro', 'castpress' ) );
			}

			// castbox
			if ( $castpress_castbox ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="simple-icons:castbox" data-inline="false"></span>
				</a>', esc_url( $castpress_castbox ), esc_html__( 'castbox', 'castpress' ) );
			}

			// audible
			if ( $castpress_audible ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="la-audible" data-inline="false"></span>
				</a>', esc_url( $castpress_audible ), esc_html__( 'audible', 'castpress' ) );
			}

			// spreaker
			if ( $castpress_spreaker ) { 
				echo sprintf( '<a class="c-episodes__social-share__link" href="%s" aria-label="%s" target="_blank">
				<span class="iconify c-episodes__social-share__icons" data-icon="cib:spreaker" data-inline="false"></span>
				</a>', esc_url( $castpress_spreaker ), esc_html__( 'spreaker', 'castpress' ) );
			}

			echo '</div>';	
		}

	}

endif;


if ( ! function_exists( 'castpress_get_main_class' ) ) :
	/**
	 * Get Main section class
	 */
	function castpress_get_main_class() {
		if( 'episodes' === get_post_type() ){
			echo esc_attr( "c-main--episode" );
		}
	}
endif;


if ( ! function_exists( 'castpress_get_archives_header' ) ) :
	/**
	 * Get Archives header
	 */
	function castpress_get_archives_header() {

		echo sprintf('<header class="c-main__header"><h1 class="c-main__entry-title u-heading-1-line-height--bg">%s</h1></header><!-- .-main__content -->', wp_kses_post(get_the_archive_title()) );

	}
	
endif;


if ( ! function_exists( 'castpress_get_latest_episodes_class_name' ) ) :
	
	/**
	  * Get Episodes archives title
	  */

	function castpress_get_latest_episodes_class_name() {

		if(get_theme_mod( 'latest_episodes' , 'style-1') == 'style-2'){
			echo esc_attr( 'c-latest-episodes--row-bg' );
		}
		elseif(get_theme_mod( 'latest_episodes' , 'style-1') == 'style-3'){
			echo esc_attr( 'c-latest-episodes--row' );
		}
		
	}
	
endif;


if ( ! function_exists( 'castpress_get_index_title' ) ) :
	
	/**
	  * Get index.php Title 
	  */
	function castpress_get_index_title() {
		if (is_home()) {
			if (get_option('page_for_posts')) {
				echo get_the_title(get_option('page_for_posts'));
			}
			else{
				echo esc_html__( "Blog" , "castpress" );
			}
		} 
	}
	
endif;