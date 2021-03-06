<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package makemeup
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function makemeup_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'makemeup_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function makemeup_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'makemeup_pingback_header' );


function makemeup_branding() { 

	if ( has_custom_logo() ) {
		the_custom_logo();
	} 
	else {	
	?>
<h1 class="site-title">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</h1>
<?php
		
	}

}


// Kirki color variables
function makemeup_typography() {
	
	if ( get_theme_mod( 'typography_primary_color' ) == "" ) {
		$makemeup_primary_color = "#222222";
	} else {
		$makemeup_primary_color = get_theme_mod( 'typography_primary_color' );
	}

	if ( get_theme_mod( 'typography_secondary_color' ) == "" ) {
		$makemeup_second_color = "#555555";
	} else {
		$makemeup_second_color = get_theme_mod( 'typography_secondary_color' );
	}
	
	if ( get_theme_mod( 'typography_third_color' ) == "" ) {
		$makemeup_third_color = "#979797";
	} else {
		$makemeup_third_color = get_theme_mod( 'typography_third_color' );
	}

	if ( get_theme_mod( 'typography_fourth_color' ) == "" ) {
		$makemeup_fourth_color = "#7247ca";
	} else {
		$makemeup_fourth_color = get_theme_mod( 'typography_fourth_color' );
	}
	
	
	$html = ':root {	
	            --primary-color: '. $makemeup_primary_color .';
	            --second-color: ' . $makemeup_second_color . ';
				--third-color: ' . $makemeup_third_color . ';
				--fourth-color: ' . $makemeup_fourth_color . ';
			}';
						
	return $html;
	
}

add_action( 'admin_head', 'makemeup_theme_settings' );
add_action( 'wp_head', 'makemeup_theme_settings' );

function makemeup_theme_settings() {
	$makemeup_theme_typography = makemeup_typography();

	?>
<style>
<?php echo esc_html($makemeup_theme_typography);
?>
</style>
<?php
}