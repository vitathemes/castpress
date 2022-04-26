<?php
/**
 * castpress Theme Customizer
 *
 * @package castpress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function castpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'castpress_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'castpress_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'castpress_customize_register' );


if( ! function_exists('castpress_customize_partial_blogname') ) : 
	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	function castpress_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;


if( ! function_exists('castpress_customize_partial_blogdescription') ) : 
	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	function castpress_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously. Core Function
 */
function castpress_customize_preview_js() {
	wp_enqueue_script( 'castpress-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CASTPRESS_VERSION, true );
}
add_action( 'customize_preview_init', 'castpress_customize_preview_js' );


if( function_exists( 'kirki' ) ) {

	if (class_exists('\Kirki\Section')) {

		/*------------------------------------*\
		############# Panels ###############
		\*------------------------------------*/
		// Footer
		new \Kirki\Panel(
			'footer',
			[
				'priority' => 180,
				'title'    => esc_html__( 'Footer', 'castpress' ),
			]
		);

		// Typography Settings
		new \Kirki\Panel(
			'typography_setting',
			[
				'priority' => 190,
				'title'    => esc_html__( 'Typography Settings', 'castpress' ),
			]
		);
		
		/*------------------------------------*\
		############# Sections #############
		\*------------------------------------*/
		/* Home Components */
		new \Kirki\Section(
			'home_components',
			[
				'title'          => esc_html__( 'Home Components', 'castpress' ),
				'panel'          => '',
				'priority'       => 5,
			]
		);

		/* Episodes Page  */
		new \Kirki\Section(
			'episodes_page',
			[
				'title'          => esc_html__( 'Episodes Options', 'castpress' ),
				'panel'          => '',
				'priority'       => 6,
			]
		);

		/* Podcast Player Link */
		new \Kirki\Section(
			'podcast_player_link',
			[
				'title'          => esc_html__( 'Podcast Player Links', 'castpress' ),
				'panel'          => '',
				'priority'       => 7,
			]
		);

		/* Typography Colors */
		new \Kirki\Section(
			'colors',
			[
				'title'          => esc_html__( 'Theme Colors', 'castpress' ),
				'description'    => esc_html__( 'Change Theme color and customize them.', 'castpress' ),
				'panel'          => '',
				'priority'       => 8,
			]
		);


		/* Typography Fonts */
		new \Kirki\Section(
			'typography_fonts',
			[
				'title'          => esc_html__( 'Typography Fonts', 'castpress' ),
				'description'    => esc_html__( 'Change Typography Fonts and sizes.', 'castpress' ),
				'panel'          => 'typography_setting',
				'priority'       => 9,
			]
		);
		
		/* Footer Social medias */
		new \Kirki\Section(
			'socials',
			[
				'title'          => esc_html__( 'Socials', 'castpress' ),
				'panel'          => 'footer',
				'priority'       => 6,
			]
		);

		/*------------------------------------*\
		############# Fields #############
		\*------------------------------------*/
		/* Typography Colors */
		new \Kirki\Field\Color(
			[
				'settings' => 'typography_primary_color',
				'label'    => __( 'Primary Color', 'castpress' ),
				'section'  => 'colors',
				'default'  => '#7247ca',
				'priority' => 7,
			]
		);

		new \Kirki\Field\Color(
			[
				'settings' => 'typography_primary_accent_color',
				'label'    => __( 'Primary Accent Color', 'castpress' ),
				'section'  => 'colors',
				'default'  => '#58379b',
				'priority' => 8,
			]
		);

		new \Kirki\Field\Color(
			[
				'settings' => 'typography_headings_color',
				'label'    => __( 'Theme Headings Color', 'castpress' ),
				'section'  => 'colors',
				'default'  => '#222222',
				'priority' => 9,
				'output'      => [
					[
						'element' => array('h1' , 'h2' ,'h3' ,'h4' ,'h5' ,'h6'),
					],
				],
			]
		);

		new \Kirki\Field\Color(
			[
				'settings' => 'typography_secondary_color',
				'label'    => __( 'Primary Texts Color', 'castpress' ),
				'section'  => 'colors',
				'default'  => '#555555',
				'priority' => 10,
			]
		);

		new \Kirki\Field\Color(
			[
				'settings' => 'typography_tertiary_color',
				'label'    => __( 'Secondary Texts Color', 'castpress' ),
				'section'  => 'colors',
				'default'  => '#707070',
				'priority' => 11,
			]
		);

		/* Typography Fonts */
		
		// Paragraph tag
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_p',
				'label'       => esc_html__( 'Base Font', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '16px',
					'line-height'     	 => '25px',
					'variant'         	 => 'regular',
				],
				'priority'    => 11,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'p' , '.p'),
					],
				],
			]
		);

		// Headings typography h1
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h1',
				'label'       => esc_html__( 'H1', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '26px',
					'line-height'     	 => '32px',
					'variant'         	 => '600',
				],
				'priority'    => 12,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h1' , '.h1'),
					],
				],
			]
		);

		// Headings typography h2
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h2',
				'label'       => esc_html__( 'H2', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '21px',
					'line-height'     	 => '25px',
					'variant'         	 => '600',
				],
				'priority'    => 13,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h2' , '.h2'),
					],
				],
			]
		);
		
		// Headings typography h3
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h3',
				'label'       => esc_html__( 'H3', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '18px',
					'line-height'     	 => '25px',
					'variant'         	 => 'regular',
				],
				'priority'    => 14,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h3' , '.h3'),
					],
				],
			]
		);

		// Headings typography h4
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h4',
				'label'       => esc_html__( 'H4', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '16px',
					'line-height'     	 => '25px',
					'variant'         	 => 'regular',
				],
				'priority'    => 15,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h4' , '.h4'),
					],
				],
			]
		);

		// Headings typography h5
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h5',
				'label'       => esc_html__( 'H5', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '14px',
					'line-height'     	 => '25px',
					'variant'         	 => '600',
				],
				'priority'    => 16,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array('h5' , '.h5'),
					],
				],
			]
		);

		
		// Headings typography h6
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h6',
				'label'       => esc_html__( 'H6', 'castpress' ),
				'section'     => 'typography_fonts',
				'default'     => [
					'font-family'   	 => 'Source Serif Pro',
					'font-size'          => '12px',
					'line-height'     	 => '25px',
					'variant'         	 => '600',
				],
				'priority'    => 17,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h6' , '.h6' , '.menu-item__link'),
					],
				],
			]
		);


		// -- Socials --
		new \Kirki\Field\URL(
			[
				'settings' => 'linkedin',
				'label'    => esc_html__( 'Linkedin', 'castpress' ),
				'section'  => 'socials',
				'priority' => 10,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'facebook',
				'label'    => esc_html__( 'Facebook', 'castpress' ),
				'section'  => 'socials',
				'priority' => 20,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'github',
				'label'    => esc_html__( 'Github', 'castpress' ),
				'section'  => 'socials',
				'priority' => 30,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'twitter',
				'label'    => esc_html__( 'Twitter', 'castpress' ),
				'section'  => 'socials',
				'priority' => 40,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'instagram',
				'label'    => esc_html__( 'Instagram', 'castpress' ),
				'section'  => 'socials',
				'priority' => 50,
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'mail',
				'label'    => esc_html__( 'Email', 'castpress' ),
				'section'  => 'socials',
				'priority' => 60,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'pinterest',
				'label'    => esc_html__( 'Pinterest', 'castpress' ),
				'section'  => 'socials',
				'priority' => 60,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'youtube',
				'label'    => esc_html__( 'Youtube', 'castpress' ),
				'section'  => 'socials',
				'priority' => 70,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'spotify',
				'label'    => esc_html__( 'Spotify', 'castpress' ),
				'section'  => 'socials',
				'priority' => 80,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'gitlab',
				'label'    => esc_html__( 'Gitlab', 'castpress' ),
				'section'  => 'socials',
				'priority' => 90,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'lastfm',
				'label'    => esc_html__( 'Lastfm', 'castpress' ),
				'section'  => 'socials',
				'priority' => 100,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'stackoverflow',
				'label'    => esc_html__( 'Stackoverflow', 'castpress' ),
				'section'  => 'socials',
				'priority' => 110,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'quora',
				'label'    => esc_html__( 'Quora', 'castpress' ),
				'section'  => 'socials',
				'priority' => 120,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'reddit',
				'label'    => esc_html__( 'Reddit', 'castpress' ),
				'section'  => 'socials',
				'priority' => 130,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'medium',
				'label'    => esc_html__( 'Medium', 'castpress' ),
				'section'  => 'socials',
				'priority' => 140,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'vimeo',
				'label'    => esc_html__( 'Vimeo', 'castpress' ),
				'section'  => 'socials',
				'priority' => 150,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'lanyrd',
				'label'    => esc_html__( 'Lanyrd', 'castpress' ),
				'section'  => 'socials',
				'priority' => 160,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'dribbble',
				'label'    => esc_html__( 'Dribbble', 'castpress' ),
				'section'  => 'socials',
				'priority' => 170,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'behance',
				'label'    => esc_html__( 'Behance', 'castpress' ),
				'section'  => 'socials',
				'priority' => 280,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'codepen',
				'label'    => esc_html__( 'Codepen', 'castpress' ),
				'section'  => 'socials',
				'priority' => 290,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'telegram',
				'label'    => esc_html__( 'Telegram', 'castpress' ),
				'section'  => 'socials',
				'priority' => 300,
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'phone_number',
				'label'    => esc_html__( 'Phone Number', 'castpress' ),
				'section'  => 'socials',
				'priority' => 310,
			]
		);
		
		
		// -- Home Components --
		new \Kirki\Field\Radio_Buttonset(
			[
				'settings'    => 'homepage_last_ep_single',
				'label'       => esc_html__( 'Last Episode Style', 'castpress' ),
				'section'     => 'home_components',
				'default'     => 'style-1',
				'priority'    => 10,
				'choices'     => [
					'style-1'   => esc_html__( 'Last Episode Style 1', 'castpress' ),
					'style-2' => esc_html__( 'Last Episode Style 2', 'castpress' ),
				],
			]
		);

		new \Kirki\Field\Sortable(
			[
				'settings' => 'home_component',
				'label'    => __( 'Home Components Order', 'castpress' ),
				'section'  => 'home_components',
				'default'     => [
					'components/latest-episode/latest-episode',
					'components/episodes',
					'components/latest-posts'
				],
				'choices'     => [
					'components/latest-episode/latest-episode' => esc_html__( 'Single Latest Episode', 'castpress' ),
					'components/episodes' => esc_html__( 'Latest Episodes', 'castpress' ),
					'components/latest-posts' => esc_html__( 'Latest posts from blog', 'castpress' ),
				],
				'priority' => 10,
			]
		);
		
		// -- Podcast Player Links --
		new \Kirki\Field\URL(
			[
				'settings' => 'p_spotify_link',
				'label'    => esc_html__( 'Spotify', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 12,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_soundcloud_link',
				'label'    => esc_html__( 'Soundcloud', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 13,
			]
		);
		
		new \Kirki\Field\URL(
			[
				'settings' => 'p_apple_link',
				'label'    => esc_html__( 'Podcasts (Apple Podcasts)', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 14,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_youtube_link',
				'label'    => esc_html__( 'Youtube', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 15,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_stitcher_link',
				'label'    => esc_html__( 'Stitcher', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 16,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_deezer_link',
				'label'    => esc_html__( 'Deezer', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 17,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_google_podcasts_link',
				'label'    => esc_html__( 'Google podcasts', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 18,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_iheartradio_link',
				'label'    => esc_html__( 'I heart radio', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 19,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_overcast_link',
				'label'    => esc_html__( 'Overcast', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 20,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_pandora_link',
				'label'    => esc_html__( 'Pandora', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 21,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_pocketcasts_link',
				'label'    => esc_html__( 'Pocket casts', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 22,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_radiopublic_link',
				'label'    => esc_html__( 'Radio public', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 23,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_rss_link',
				'label'    => esc_html__( 'Rss Feed', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 24,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_spreaker_link',
				'label'    => esc_html__( 'Spreaker', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 25,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_castro_link',
				'label'    => esc_html__( 'Castro', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 26,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_audible_link',
				'label'    => esc_html__( 'Audible', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 27,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'p_castbox_link',
				'label'    => esc_html__( 'Castbox', 'castpress' ),
				'section'  => 'podcast_player_link',
				'default'  => '',
				'priority' => 28,
			]
		);
		// -- Episodes Page options --

		// Archives title
		new \Kirki\Field\Text(
			[
				'settings' => 'post_type_archive_custom_title',
				'label'    => esc_html__( 'Post Type Archive title', 'castpress' ),
				'section'  => 'episodes_page',
				'priority' => 10,
			]
		);

		// Episodes template part
		new \Kirki\Field\Radio_Buttonset(
			[
				'settings'    => 'latest_episodes',
				'label'       => esc_html__( 'Latest Episodes Style', 'castpress' ),
				'section'     => 'episodes_page',
				'default'     => 'style-1',
				'priority'    => 10,
				'choices'     => [
					'style-1' => esc_html__( 'Episodes Style 1', 'castpress' ),
					'style-2' => esc_html__( 'Episodes Style 2', 'castpress' ),
					'style-3' => esc_html__( 'Episodes Style 3', 'castpress' ),
				],
			]
		);
	}

}