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




/**
 * Kirki Plugin initialization
 */
if( function_exists( 'kirki' ) ) {

	/*
	 *	Kirki - Config
	 */
	Kirki::add_config( 'my_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );
	
	/*
	 *	Kirki -> Sections
	 */
	// typography settings  
	Kirki::add_section( 'typography_headings', array(
		'title'          => esc_html__( 'Typography Setting', 'makemeup' ),
		'description'    => esc_html__( 'Change Typography color and customize them.', 'makemeup' ),
		'panel'          => '',
		'priority'       => 160,
	) );

	
	/* Typography Settings */
	// Headings typography h1

	// Kirki::add_field( 'cavatina_theme', [
	// 	'type'        => 'typography',
	// 	'settings'    => 'typography_h1',
	// 	'label'       => esc_html__( 'p', 'makemeup' ),
	// 	'section'     => 'typography_headings',
	// 	'default'     => [
	// 		'font-family'   	 => 'Montserrat',
	// 		'font-size'          => '24px',
	// 		'variant'         	 => '600',
	// 		'color'         	 => '#000000',
	// 		'line-height'     	 => '30px',
	// 	],
	// 	'priority'    => 10,
	// 	'transport'   => 'auto',
	// 	'output'      => [
	// 		[
	// 			'element' => array( 'p' ),
	// 		],
	// 	],
	// ] );

}