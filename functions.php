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
	$MAKEMEUP_theme_data = wp_get_theme();
	define( 'MAKEMEUP_VERSION', $MAKEMEUP_theme_data->get( 'Version' ));
}

function makemeup_footer_widgets_init() {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
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
add_action( 'widgets_init', 'makemeup_footer_widgets_init' );


function makemeup_scripts() {

	wp_enqueue_script('jquery');

	/**
	 * Enqueue scripts and styles.
	 */
	wp_enqueue_style( 'makemeup-style', get_stylesheet_uri(), array(), MAKEMEUP_VERSION );
	wp_style_add_data( 'makemeup-style', 'rtl', 'replace' );

	// enqueue css
	wp_enqueue_style( 'makemeup-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), MAKEMEUP_VERSION );
	// enqueue js
	wp_enqueue_script( 'makemeup-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( ), MAKEMEUP_VERSION, true );
	// Vendor
	wp_enqueue_script( 'makemeup-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.js', array( ), MAKEMEUP_VERSION, true );

	wp_enqueue_script( 'makemeup-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), MAKEMEUP_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'makemeup_scripts' );


function makemeup_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'makemeup_dashicons', 999);


function makemeup_add_additional_class_on_li($classes, $item, $args) {
	/**
	 *	Add class to menu items 
	 */
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'makemeup_add_additional_class_on_li', 1, 3);


function makemeup_total_post_types( $isText = true ) {	
	/**
	 * count number of posts types ( episodes ) in a page
	 */
	if($isText === true){
		printf( esc_html($count_posts = wp_count_posts( 'episodes' )->publish));
	}
	else{
		return $count_posts = wp_count_posts( 'episodes' )->publish;
	}	
}


function makemeup_get_inverse_post_number(){
	/**
	 * Auto decrement number per posts ( in pages like archive-episodes... )
	 */
	global $wp_query;
    $posts_per_page 	= get_option('posts_per_page');
	$paged          	= (get_query_var('paged')) ? get_query_var('paged') : 1;
	$offset         	= ($paged - 1) * $posts_per_page;
	$loop           	= $wp_query->current_post + 1;
	$posts_in_page	    = $offset + $loop;
	$total_post_numbers = makemeup_total_post_types(false) + 1;
	$posts_counter 	    = $total_post_numbers - $posts_in_page;

	return $posts_counter;
}


function makemeup_deciaml_post_number(){
	/**
	  * Add zero to the post numbers
	  */
	
    // get post number ( auto increment )
    $decimalCounter = "0";
    $postNumber = makemeup_get_inverse_post_number();
	
    // Remove zero when reaching 10
    if($postNumber >= 10){
        $decimalCounter = "";
		$postNumber = $postNumber;
		return $postNumber;
    }
    else{
		$postNumber = $decimalCounter.$postNumber;
		return $postNumber;
	}
}


function makemeup_comment_button($defaults) {
	/**
	  *	Change comment button type
	  */
	
   	// Edit this to your needs:
	$button = '<button name="%1$s" type="submit" id="%2$s" class="%3$s comment-form-arrow" value="%4$s"> Submit <span class="dashicons dashicons-arrow-right-alt2"></span></button>';
    // Override the default submit button:
    $defaults['submit_button'] = $button;
    return $defaults;
	
}
add_filter('comment_form_defaults', 'makemeup_comment_button');


function makemeup_add_custom_types( $query ) {
	/**
	 *	Add custom post type into archives
	 *
	 * @link https://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
	 */
	if( (is_category() || is_tag()) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
	  $query->set( 'post_type', array(
	   'post', 'episodes'
		  ));
	  }
  }
add_action( 'pre_get_posts', 'makemeup_add_custom_types' );


/**
 * Modify LibWP post type name
 */
function makemeup_modify_libwp_post_type_name($postTypeName){
	$postTypeName = 'episodes';
    return $postTypeName;
}
add_filter( 'libwp_post_type_1_name' , 'makemeup_modify_libwp_post_type_name');


/**
 * Modify LibWP post type arguments
 */
function makemeup_modify_post_type_argument($postTypeArguments){
	$postTypeArguments['labels'] = [
        'name'          => _x('Episodes', 'Post type general name', 'makemeup'),
        'singular_name' => _x('Episode', 'Post type singular name', 'makemeup'),
        'menu_name'     => _x('Episodes', 'Admin Menu text', 'makemeup'),
        'add_new'       => __('Add New', 'makemeup'),
        'edit_item'     => __('Edit Episode', 'makemeup'),
        'view_item'     => __('View Episode', 'makemeup'),
        'all_items'     => __('All Episodes', 'makemeup'),
    ];
    $postTypeArguments['rewrite']['slug'] 	  = 'episodes';
	$postTypeArguments['menu_position'] 	  = 5;
	$postTypeArguments['taxonomies']	      = array('category' , 'post_tag');
	$postTypeArguments['show_in_admin_bar']   = true;
	$postTypeArguments['show_in_admin_bar']   = true;
	$postTypeArguments['hierarchical'] 		  = true;
	$postTypeArguments['can_export'] 		  = true;
	$postTypeArguments['has_archive'] 		  = true;
	$postTypeArguments['exclude_from_search'] = false;
	$postTypeArguments['publicly_queryable']  = true;
	$postTypeArguments['capability_type'] 	  = 'post';
	$postTypeArguments['show_in_rest'] 		  = true;
	$postTypeArguments['supports'] 			  = array('title', 'editor' , 'comments', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields' ) ;	
    return $postTypeArguments;
}
add_filter('libwp_post_type_1_arguments', 'makemeup_modify_post_type_argument');

/**
 * Modify LibWP taxonomy name
 */
function makemeup_modify_libwp_taxonomy_name($taxonomyName){
	$taxonomyName = 'episodes';
    return $taxonomyName;
}
add_filter('libwp_taxonomy_1_name', 'makemeup_modify_libwp_taxonomy_name');

/**
 * Modify LibWP taxonomy name
 */
function makemeup_modify_libwp_taxonomy_arguments($taxonomyArguments){

	$taxonomyArguments['labels'] = [
        'name'          => _x('Episode Categories', 'taxonomy general name', 'makemeup'),
        'singular_name' => _x('Episode Category', 'taxonomy singular name', 'makemeup'),
        'search_items'  => __('Search Episode Categories', 'makemeup'),
        'all_items'     => __('All Episode Categories', 'makemeup'),
        'edit_item'     => __('Edit Episode Category', 'makemeup'),
        'add_new_item'  => __('Add New Episode Category', 'makemeup'),
        'new_item_name' => __('New Episode Category Name', 'makemeup'),
        'menu_name'     => __('Episode Categories', 'makemeup'),
    ];
    $taxonomyArguments['rewrite']['slug'] = 'episodes';
    return $taxonomyArguments;
	
}
add_filter('libwp_taxonomy_1_arguments', 'makemeup_modify_libwp_taxonomy_arguments');



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

/**
  * Load TGMPA file
  */
  require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
  require_once get_template_directory() . '/inc/tgmpa/tgmpa-config.php';