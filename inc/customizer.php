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

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function castpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function castpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function castpress_customize_preview_js() {
	wp_enqueue_script( 'castpress-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CASTPRESS_VERSION, true );
}
add_action( 'customize_preview_init', 'castpress_customize_preview_js' );



if( function_exists( 'kirki' ) ) {

	/*
	 *	Kirki - Config
	 */
	Kirki::add_config( 'castpress_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	/*
	 *	Kirki -> Panels
	 */

	// Footer
	Kirki::add_panel( 'footer', array(
		'priority' => 180,
		'title'    => esc_html__( 'Footer', 'castpress' ),
	) );

	// Typography Settings
	Kirki::add_panel( 'typography_setting', array(
		'priority' => 180,
		'title'    => esc_html__( 'Typography Settings', 'castpress' ),
	) );
	
	/*
	 *	Kirki -> Sections
	 */
	
	/* Home Components */
	Kirki::add_section( 'home_components', array(
		'title'    => esc_html__( 'Home Components', 'castpress' ),
		'panel'    => '',
		'priority' => 5,
	) );

	/* Episodes Page  */
	Kirki::add_section( 'episodes_page', array(
		'title'    => esc_html__( 'Episodes Options', 'castpress' ),
		'panel'    => '',
		'priority' => 6,
	) );

	/* Podcast Player Link */
	Kirki::add_section( 'podcast_player_link' , array(
		'title'    => esc_html__( 'Podcast Player Links', 'castpress' ),
		'panel'    => '',
		'priority' => 7,
	) );

	/* Typography Colors */
	Kirki::add_section( 'colors', array(
		'title'          => esc_html__( 'Theme Colors', 'castpress' ),
		'description'    => esc_html__( 'Change Theme color and customize them.', 'castpress' ),
		'panel'          => '',
		'priority'       => 8,
	) );

	/* Typography Fonts */
	Kirki::add_section( 'typography_fonts', array(
		'title'          => esc_html__( 'Typography Fonts', 'castpress' ),
		'description'    => esc_html__( 'Change Typography Fonts and sizes.', 'castpress' ),
		'panel'          => 'typography_setting',
		'priority'       => 9,
	) );
	
	/* Footer Social medias */
	Kirki::add_section( 'socials', array(
		'title'    => esc_html__( 'Socials', 'castpress' ),
		'panel'    => 'footer',
		'priority' => 6,
	) );

    /*
	 *	Kirki -> fields
	 */

	/* Typography Colors */
	Kirki::add_field( 'castpress', [
		'type'     => 'color',
		'settings' => 'typography_primary_color',
		'label'    => __( 'Primary Color', 'castpress' ),
		'section'  => 'colors',
		'default'  => '#7247ca',
		'priority' => 7,
		
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'color',
		'settings' => 'typography_primary_accent_color',
		'label'    => __( 'Primary Accent Color', 'castpress' ),
		'section'  => 'colors',
		'default'  => '#58379b',
		'priority' => 8,
		
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'color',
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
		
	]);
	
	Kirki::add_field( 'castpress', [
		'type'     => 'color',
		'settings' => 'typography_secondary_color',
		'label'    => __( 'Primary Texts Color', 'castpress' ),
		'section'  => 'colors',
		'default'  => '#555555',
		'priority' => 9,
		
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'color',
		'settings' => 'typography_tertiary_color',
		'label'    => __( 'Secondary Texts Color', 'castpress' ),
		'section'  => 'colors',
		'default'  => '#707070',
		'priority' => 10,
		
	] );

	/* Typography Fonts */
	
	// Paragraph tag
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	]);

	// Headings typography h1
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	] );

	
	// Headings typography h2
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	] );

	
	// Headings typography h3
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	] );


	// Headings typography h4
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	] );


	// Headings typography h5
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	] );

	
	// Headings typography h6
	Kirki::add_field( 'castpress_theme', [
		'type'        => 'typography',
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
	] );



	

	// -- Socials --
	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => esc_html__( 'Facebook', 'castpress' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => esc_html__( 'Twitter', 'castpress' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'castpress' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'linkedin',
		'label'    => esc_html__( 'Linkedin', 'castpress' ),
		'section'  => 'socials',
		'priority' => 10,
	] );
	
	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'github',
		'label'    => esc_html__( 'Github', 'castpress' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	
	// -- Home Components --
	Kirki::add_field( 'castpress', [
		'type'        => 'radio-buttonset',
		'settings'    => 'homepage_last_ep_single',
		'label'       => esc_html__( 'Last Episode Style', 'castpress' ),
		'section'     => 'home_components',
		'default'     => 'style-1',
		'priority'    => 10,
		'choices'     => [
			'style-1'   => esc_html__( 'Last Episode Style 1', 'castpress' ),
			'style-2' => esc_html__( 'Last Episode Style 2', 'castpress' ),
			'style-3' => esc_html__( 'Last Episode Style 3', 'castpress' ),
		],
	] );


	Kirki::add_field( 'castpress', [
		'type'        => 'sortable',
		'settings'    => 'home_component',
		'label'       => esc_html__( 'Home Components Order', 'castpress' ),
		'section'     => 'home_components',
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
		'priority'    => 10,
	] );

	
	// -- Podcast Player Links --
	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_spotify_link',
		'label'    => __( 'Spotify', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 12,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_soundcloud_link',
		'label'    => __( 'Soundcloud', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 13,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_apple_link',
		'label'    => __( 'Podcasts (Apple Podcasts)', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 14,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_youtube_link',
		'label'    => __( 'Youtube', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 15,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_stitcher_link',
		'label'    => __( 'Stitcher', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 16,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_deezer_link',
		'label'    => __( 'Deezer', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 17,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_google_podcasts_link',
		'label'    => __( 'Google podcasts', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 18,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_iheartradio_link',
		'label'    => __( 'I heart radio', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 19,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_overcast_link',
		'label'    => __( 'Overcast', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 20,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_pandora_link',
		'label'    => __( 'Pandora', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 21,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_pocketcasts_link',
		'label'    => __( 'Pocket casts', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 22,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_radiopublic_link',
		'label'    => __( 'Radio public', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 23,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_rss_link',
		'label'    => __( 'Rss Feed', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 24,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_spreaker_link',
		'label'    => __( 'Spreaker', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 24,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_castro_link',
		'label'    => __( 'Castro', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 24,
	] );

	
	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_audible_link',
		'label'    => __( 'Audible', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 24,
	] );

	Kirki::add_field( 'castpress', [
		'type'     => 'link',
		'settings' => 'p_castbox_link',
		'label'    => __( 'Castbox', 'castpress' ),
		'section'  => 'podcast_player_link',
		'default'  => '',
		'priority' => 24,
	] );

	// -- Episodes Page options --

	// Archives title
	Kirki::add_field( 'castpress', [
		'type'     => 'text',
		'settings' => 'post_type_archive_custom_title',
		'label'    => esc_html__( 'Post Type Archive title', 'castpress' ),
		'section'  => 'episodes_page',
		'priority' => 10,
	] );

	// Episodes template part
	Kirki::add_field( 'castpress', [
		'type'        => 'radio-buttonset',
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
	] );


}