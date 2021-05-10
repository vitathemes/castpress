<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package castpress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function castpress_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'castpress_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function castpress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'castpress_pingback_header' );


function castpress_branding() { 
	
	if ( has_custom_logo() ) {
		the_custom_logo();
	} 
	else {	
		
	?>
<h1 class="c-header__title site-title">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</h1>
<?php	
		}
	}


// Kirki color variables
function castpress_typography() {
	

	if ( get_theme_mod( 'typography_headings_color' ) == "" ) {
		$castpress_headings_color = "#222222";
	} else {
		$castpress_headings_color = get_theme_mod( 'typography_headings_color' );
	}

	if ( get_theme_mod( 'typography_primary_color' ) == "" ) {
		$castpress_primary_color = "#222222";
	} else {
		$castpress_primary_color = get_theme_mod( 'typography_primary_color' );
	}

	if ( get_theme_mod( 'typography_secondary_color' ) == "" ) {
		$castpress_second_color = "#555555";
	} else {
		$castpress_second_color = get_theme_mod( 'typography_secondary_color' );
	}
	
	if ( get_theme_mod( 'typography_third_color' ) == "" ) {
		$castpress_third_color = "#979797";
	} else {
		$castpress_third_color = get_theme_mod( 'typography_third_color' );
	}

	if ( get_theme_mod( 'typography_fourth_color' ) == "" ) {
		$castpress_fourth_color = "#7247ca";
	} else {
		$castpress_fourth_color = get_theme_mod( 'typography_fourth_color' );
	}
	
	
	$html = ':root {	
				--castpress_headings-color: ' . $castpress_headings_color . ';
				--castpress_primary-color: '. $castpress_primary_color .';
	            --castpress_second-color: ' . $castpress_second_color . ';
				--castpress_third-color: ' . $castpress_third_color . ';
				--castpress_fourth-color: ' . $castpress_fourth_color . ';
			}';
						
	return $html;
	
}

add_action( 'admin_head', 'castpress_theme_settings' );
add_action( 'wp_head', 'castpress_theme_settings' );

function castpress_theme_settings() {
	$castpress_theme_typography = castpress_typography();

?>
<style>
<?php echo esc_html($castpress_theme_typography);
?>
</style>
<?php
}


function castpress_home_components(){

	// Get the parts.
	$template_parts = get_theme_mod( 'home_component' , array( 'components/latest-episode/latest-episode-player', 'components/episodes', 'components/latest-posts' ));
	// Loop parts.
	foreach ( $template_parts as $template_part ) {
		get_template_part( 'template-parts/' . $template_part );
	}
	
}