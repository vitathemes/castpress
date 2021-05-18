<?php
/**
 * castpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package castpress
 */

if ( ! defined( 'CASTPRESS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$CASTPRESS_theme_data = wp_get_theme();
	define( 'CASTPRESS_VERSION', $CASTPRESS_theme_data->get( 'Version' ));
}


/**
  * Theme setup
  */
require get_template_directory() . '/inc/setup.php';

/**
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
* Nav menu walker
*/
require get_template_directory() . '/classes/class_castpress_walker_nav_menu.php';

/**
* Comments walker
*/
require get_template_directory() . '/classes/class_castpress_walker_comment.php';

/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Functions which enhance the theme by hooking into WordPress.
*/
require get_template_directory() . '/inc/template-functions.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
* Load TGMPA file
*/
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/tgmpa-config.php';