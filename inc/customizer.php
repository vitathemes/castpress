<?php
/**
 * makemeup Theme Customizer
 *
 * @package makemeup
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function makemeup_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'makemeup_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'makemeup_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'makemeup_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function makemeup_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function makemeup_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function makemeup_customize_preview_js() {
	wp_enqueue_script( 'makemeup-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), MAKEMEUP_VERSION, true );
}
add_action( 'customize_preview_init', 'makemeup_customize_preview_js' );



if( function_exists( 'kirki' ) ) {

	/*
	 *	Kirki - Config
	 */
	Kirki::add_config( 'makemeup_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	/*
	 *	Kirki -> Panels
	 */

	// Footer
	Kirki::add_panel( 'footer', array(
		'priority' => 180,
		'title'    => esc_html__( 'Footer', 'makemeup' ),
	) );

	/*
	 *	Kirki -> Sections
	 */

	/* typography settings  */
	Kirki::add_section( 'typography_headings', array(
		'title'          => esc_html__( 'Typography Setting', 'makemeup' ),
		'description'    => esc_html__( 'Change Typography color and customize them.', 'makemeup' ),
		'panel'          => '',
		'priority'       => 160,
	) );

	/* Load more selection */
	Kirki::add_section( 'loadmore_pagination', array(
		'title'          => esc_html__( 'Pagination', 'makemeup' ),
		'description'    => esc_html__( 'You can add load more button to page that you want.', 'makemeup' ),
		'panel'          => '',
		'priority'       => 160,
	) );
	
	/* Social medias */
	Kirki::add_section( 'socials', array(
		'title'    => esc_html__( 'Socials', 'makemeup' ),
		'panel'    => 'footer',
		'priority' => 6,
	) );

	/* Home Components */
	Kirki::add_section( 'home_components', array(
		'title'    => esc_html__( 'Home Components', 'makemeup' ),
		'panel'    => '',
		'priority' => 6,
	) );
	
    /*
    *	Kirki -> fields
	*/
	/* Typography Settings */
	Kirki::add_field( 'makemeup', [
		'type'     => 'color',
		'settings' => 'typography_primary_color',
		'label'    => __( 'Primary Color', 'makemeup' ),
		'section'  => 'typography_headings',
		'default'  => '#222222',
		'priority' => 9,
		
	] );

	
	Kirki::add_field( 'makemeup', [
		'type'     => 'color',
		'settings' => 'typography_secondary_color',
		'label'    => __( 'Secondary Color', 'makemeup' ),
		'section'  => 'typography_headings',
		'default'  => '#555555',
		'priority' => 9,
		
	] );

	Kirki::add_field( 'makemeup', [
		'type'     => 'color',
		'settings' => 'typography_third_color',
		'label'    => __( 'Tertiary Color', 'makemeup' ),
		'section'  => 'typography_headings',
		'default'  => '#979797',
		'priority' => 10,
		
	] );

	Kirki::add_field( 'makemeup', [
		'type'     => 'color',
		'settings' => 'typography_fourth_color',
		'label'    => __( 'Quaternary Color', 'makemeup' ),
		'section'  => 'typography_headings',
		'default'  => '#7247ca',
		'priority' => 11,
		
	] );
	
	Kirki::add_field( 'makemeup', [
		'type'     => 'color',
		'settings' => 'typography_headings_color',
		'label'    => __( 'Typography Headings Color', 'makemeup' ),
		'section'  => 'typography_headings',
		'default'  => '#222222',
		'priority' => 11.5,
		'output'      => [
			[
				'element' => array('h1' , 'h2' ,'h3' ,'h4' ,'h5' ,'h6'),
			],
		],
		
	] );

	// Headings typography h1
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h1',
		'label'       => esc_html__( 'H1', 'makemeup' ),
		'section'     => 'typography_headings',
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
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h2',
		'label'       => esc_html__( 'H2', 'makemeup' ),
		'section'     => 'typography_headings',
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
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h3',
		'label'       => esc_html__( 'H3', 'makemeup' ),
		'section'     => 'typography_headings',
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
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h4',
		'label'       => esc_html__( 'H4', 'makemeup' ),
		'section'     => 'typography_headings',
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
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h5',
		'label'       => esc_html__( 'H5', 'makemeup' ),
		'section'     => 'typography_headings',
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
				'element' => array( 'h5' , '.h5'),
			],
		],
	] );

	
	// Headings typography h6
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h6',
		'label'       => esc_html__( 'H6', 'makemeup' ),
		'section'     => 'typography_headings',
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
				'element' => array( 'h6' , '.h6'),
			],
		],
	] );

	
	// Paragraph typography
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_paragraph',
		'label'       => esc_html__( 'Paragraph', 'makemeup' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Source Serif Pro',
			'font-size'          => '16px',
			'line-height'        => '25px',
			'variant'         	 => 'regular',
			'color'         	 => '#222222',
		],
		'priority'    => 18,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( 'p' , '.p' ),
			],
		],
	] );

	
	// Span typography
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'span_paragraph',
		'label'       => esc_html__( 'Span Color', 'makemeup' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Source Serif Pro',
			'font-size'          => '12px',
			'line-height'        => '15px',
			'variant'         	 => 'regular',
			'color'         	 => '#222222',
		],
		'priority'    => 19,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( 'span' , '.span' ),
			],
		],
	] );
	

	// A Primary color
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_link',
		'label'       => esc_html__( 'Link Primary', 'makemeup' ),
		'section'     => 'typography_headings',
		'default'     => [
			'color'		=> '#7247ca',
		],
		'priority'    => 20,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( 'a' , '.a' ),
			],
		],
	] );
	
	
	// A Secondary color
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_link_secondary',
		'label'       => esc_html__( 'Link Secondary', 'makemeup' ),
		'section'     => 'typography_headings',
		'default'     => [
			'color'		=> '#222222',
		],
		'priority'    => 20,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( '.a--secondary' ),
			],
		],
	] );

	
	// A Tertiary color
	Kirki::add_field( 'makemeup_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_link_tertiary',
		'label'       => esc_html__( 'Link Tertiary', 'makemeup' ),
		'section'     => 'typography_headings',
		'default'     => [
			'color'		=> '#979797',
		],
		'priority'    => 20,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( '.a--tertiary' , '.a--fourth' ),
			],
		],
	] );


	// -- Socials --
	Kirki::add_field( 'makemeup', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => esc_html__( 'Facebook', 'makemeup' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'makemeup', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => esc_html__( 'Twitter', 'makemeup' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'makemeup', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'makemeup' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'makemeup', [
		'type'     => 'link',
		'settings' => 'linkedin',
		'label'    => esc_html__( 'Linkedin', 'makemeup' ),
		'section'  => 'socials',
		'priority' => 10,
	] );
	
	Kirki::add_field( 'makemeup', [
		'type'     => 'link',
		'settings' => 'github',
		'label'    => esc_html__( 'Github', 'makemeup' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	// -- Home components --
	Kirki::add_field( 'makemeup', [
		'type'        => 'sortable',
		'settings'    => 'home_component',
		'label'       => esc_html__( 'Home Components', 'makemeup' ),
		'section'     => 'home_components',
		'default'     => [
			'components/latest-episode/latest-episode-player',
			'components/episodes',
			'components/latest-posts'
		],
		'choices'     => [
			'components/latest-episode/latest-episode-player' => esc_html__( 'Latest Episode with player', 'makemeup' ),
			'components/episodes' => esc_html__( 'Latest Episodes', 'makemeup' ),
			'components/latest-posts' => esc_html__( 'Latest posts from blog', 'makemeup' ),
		],
		'priority'    => 10,
	] );

}