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

function castpress_footer_widgets_init() {
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
add_action( 'widgets_init', 'castpress_footer_widgets_init' );


function castpress_scripts() {

	wp_enqueue_script('jquery');

	/**
	 * Enqueue scripts and styles.
	 */
	wp_enqueue_style( 'castpress-style', get_stylesheet_uri(), array(), CASTPRESS_VERSION );
	wp_style_add_data( 'castpress-style', 'rtl', 'replace' );

	// enqueue css
	wp_enqueue_style( 'castpress-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), CASTPRESS_VERSION );
	// enqueue js
	wp_enqueue_script( 'castpress-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( ), CASTPRESS_VERSION, true );
	// Vendor
	wp_enqueue_script( 'castpress-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.js', array( ), CASTPRESS_VERSION, true );

	wp_enqueue_script( 'castpress-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), CASTPRESS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'castpress_scripts' );


function castpress_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'castpress_dashicons', 999);


function castpress_add_additional_class_on_li($classes, $item, $args) {
	/**
	 *	Add class to menu items 
	 */
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'castpress_add_additional_class_on_li', 1, 3);


function castpress_total_post_types( $isText = true ) {	
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


function castpress_get_inverse_post_number(){
	/**
	 * Auto decrement number per posts ( in pages like archive-episodes... )
	 */
	global $wp_query;
    $posts_per_page 	= get_option('posts_per_page');
	$paged          	= (get_query_var('paged')) ? get_query_var('paged') : 1;
	$offset         	= ($paged - 1) * $posts_per_page;
	$loop           	= $wp_query->current_post + 1;
	$posts_in_page	    = $offset + $loop;
	$total_post_numbers = castpress_total_post_types(false) + 1;
	$posts_counter 	    = $total_post_numbers - $posts_in_page;

	return $posts_counter;
}


function castpress_deciaml_post_number(){
	/**
	  * Add zero to the post numbers
	  */
	
    // get post number ( auto increment )
    $decimalCounter = "0";
    $postNumber = castpress_get_inverse_post_number();
	
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


function castpress_comment_button($defaults) {
	/**
	  *	Change comment button type
	  */
	
   	// Edit this to your needs:
	$button = '<button name="%1$s" type="submit" id="%2$s" class="%3$s comment-form-arrow" value="%4$s"> Submit <span class="dashicons dashicons-arrow-right-alt2"></span></button>';
    // Override the default submit button:
    $defaults['submit_button'] = $button;
    return $defaults;
	
}
add_filter('comment_form_defaults', 'castpress_comment_button');


function castpress_add_custom_types( $query ) {
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
add_action( 'pre_get_posts', 'castpress_add_custom_types' );


/**
 * Modify LibWP post type name
 */
function castpress_modify_libwp_post_type_name($postTypeName){
	$postTypeName = 'episodes';
    return $postTypeName;
}
add_filter( 'libwp_post_type_1_name' , 'castpress_modify_libwp_post_type_name');


/**
 * Modify LibWP post type arguments
 */
function castpress_modify_post_type_argument($postTypeArguments){
	$postTypeArguments['labels'] = [
        'name'          => _x('Episodes', 'Post type general name', 'castpress'),
        'singular_name' => _x('Episode', 'Post type singular name', 'castpress'),
        'menu_name'     => _x('Episodes', 'Admin Menu text', 'castpress'),
        'add_new'       => __('Add New', 'castpress'),
        'edit_item'     => __('Edit Episode', 'castpress'),
        'view_item'     => __('View Episode', 'castpress'),
        'all_items'     => __('All Episodes', 'castpress'),
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
add_filter('libwp_post_type_1_arguments', 'castpress_modify_post_type_argument');

/**
 * Modify LibWP taxonomy name
 */
function castpress_modify_libwp_taxonomy_name($taxonomyName){
	$taxonomyName = 'episodes';
    return $taxonomyName;
}
add_filter('libwp_taxonomy_1_name', 'castpress_modify_libwp_taxonomy_name');

/**
 * Modify LibWP taxonomy name
 */
function castpress_modify_libwp_taxonomy_arguments($taxonomyArguments){

	$taxonomyArguments['labels'] = [
        'name'          => _x('Episode Categories', 'taxonomy general name', 'castpress'),
        'singular_name' => _x('Episode Category', 'taxonomy singular name', 'castpress'),
        'search_items'  => __('Search Episode Categories', 'castpress'),
        'all_items'     => __('All Episode Categories', 'castpress'),
        'edit_item'     => __('Edit Episode Category', 'castpress'),
        'add_new_item'  => __('Add New Episode Category', 'castpress'),
        'new_item_name' => __('New Episode Category Name', 'castpress'),
        'menu_name'     => __('Episode Categories', 'castpress'),
    ];
    $taxonomyArguments['rewrite']['slug'] = 'episodes';
    return $taxonomyArguments;
	
}
add_filter('libwp_taxonomy_1_arguments', 'castpress_modify_libwp_taxonomy_arguments');



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