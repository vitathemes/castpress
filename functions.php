<?php
/**
 * makemeup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package makemeup
 */

if ( ! defined( 'MAKEMEUP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MAKEMEUP_VERSION', '1.0.0' );
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function makemeup_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'makemeup' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'makemeup' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'makemeup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function makemeup_scripts() {
	wp_enqueue_style( 'makemeup-style', get_stylesheet_uri(), array(), MAKEMEUP_VERSION );
	wp_style_add_data( 'makemeup-style', 'rtl', 'replace' );

	// enqueue css
	wp_enqueue_style( 'makemeup-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), MAKEMEUP_VERSION );
	// enqueue js
	wp_enqueue_script( 'makemeup-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( ), MAKEMEUP_VERSION, true );

	wp_enqueue_script( 'makemeup-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), MAKEMEUP_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'makemeup_scripts' );


function cavatina_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'cavatina_dashicons', 999);


function wpb_widgets_init() {
 	/**
	 * Footer widget area
	 */
    register_sidebar( array(
        'name'          => 'Footer Widget',
        'id'            => 'custom-footer-widget',
        'before_widget' => '<div class="c-footer__widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="c-footer__widget__title">',
        'after_title'   => '</h2>',
    ) );
 
}
add_action( 'widgets_init', 'wpb_widgets_init' );


//Exclude pages from WordPress Search
if (!is_admin()) {
	function wpb_search_filter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
	}
	add_filter('pre_get_posts','wpb_search_filter');
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
require get_template_directory() . '/classes/class_makemeup_walker_nav_menu.php';


/**
 * Comments walker
 */
require get_template_directory() . '/classes/class_makemeup_walker_comment.php';

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