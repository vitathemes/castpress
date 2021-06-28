<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package castpress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $castpress_classes Classes for the body element.
 * @return array
 */
function castpress_body_classes( $castpress_classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$castpress_classes[] = 'hfeed';
	}

	return $castpress_classes;
}
add_filter( 'body_class', 'castpress_body_classes' );


function castpress_footer_widgets_left_init() {
	/**
	 * Register widget area left side.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
   register_sidebar( array(
	   'name'          => esc_html__( 'Footer Widget Left Side' , 'castpress'),
	   'id'            => 'castpress-custom-footer-widget-left',
	   'before_widget' => '<div class="c-footer__widget">',
	   'after_widget'  => '</div>',
	   'before_title'  => '<h2 class="c-footer__widget__title">',
	   'after_title'   => '</h2>',
   ) );

}
add_action( 'widgets_init', 'castpress_footer_widgets_left_init' );


function castpress_footer_widgets_right_init() {
	/**
	 * Register widget area right side.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
   register_sidebar( array(
	   'name'          => esc_html__( 'Footer Widget Right Side' , 'castpress'),
	   'id'            => 'castpress-custom-footer-widget-right',
	   'before_widget' => '<div class="c-footer__widget">',
	   'after_widget'  => '</div>',
	   'before_title'  => '<h2 class="c-footer__widget__title">',
	   'after_title'   => '</h2>',
   ) );

}
add_action( 'widgets_init', 'castpress_footer_widgets_right_init' );


function castpress_scripts() {

	/**
	 * Enqueue scripts and styles.
	 */

	wp_enqueue_script('jquery');

	wp_enqueue_style( 'castpress-style', get_stylesheet_uri(), array(), CASTPRESS_VERSION );
	wp_style_add_data( 'castpress-style', 'rtl', 'replace' );
	// enqueue css
	wp_enqueue_style( 'castpress-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), CASTPRESS_VERSION );
	// enqueue js
	wp_enqueue_script( 'castpress-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( ), CASTPRESS_VERSION, true );
	// Vendor
	wp_enqueue_script( 'castpress-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.js', array( ), CASTPRESS_VERSION, true );
	// Navigation JS
	wp_enqueue_script( 'castpress-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), CASTPRESS_VERSION, true );
	// Dash icons
	wp_enqueue_style('dashicons');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'castpress_scripts' );


function castpress_add_additional_class_on_li($castpress_classes, $castpress_item, $castpress_args) {
	/**
	 *	Add class to menu items 
	 */
    if(isset($castpress_args->add_li_class)) {
        $castpress_classes[] = $castpress_args->add_li_class;
    }
    return $castpress_classes;
}
add_filter('nav_menu_css_class', 'castpress_add_additional_class_on_li', 1, 3);


function castpress_total_post_types( $castpress_isText = true ) {	
	/**
	  * Count number of posts types ( episodes ) in a page
	  */
	if($castpress_isText === true){
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
	$loop           	= $wp_query->current_post + 2;
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
		return $postNumber;// Output will scape when it use eg. $castpress_postNumber in content-episodes
    }
    else{
		$postNumber = $decimalCounter.$postNumber;
		return $postNumber;// Output will scape when it use eg. $castpress_postNumber in content-episodes
	}
}

function castpress_comment_button($castpress_defaults) {
	/**
	  *	Change comment button type
	  */

   	// Edit button 
	$button = '<button name="%1$s" type="submit" id="%2$s" class="%3$s comment-form-arrow" value="%4$s"> '.esc_html__( 'Submit', 'castpress' ).' <span class="dashicons dashicons-arrow-right-alt2"></span></button>';

    // Override the default submit button:
    $castpress_defaults['submit_button'] = $button;

    return $castpress_defaults;
	
}
add_filter('comment_form_defaults', 'castpress_comment_button');


function castpress_add_custom_types( $query ) {
	/**
	 *	Add custom post type into default WordPress archives
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


function castpress_modify_libwp_post_type_name($castpress_postTypeName){
	/**
	 * Modify LibWP post type name
	 */
	$castpress_postTypeName = 'episodes';
    return $castpress_postTypeName;
}
add_filter( 'libwp_post_type_1_name' , 'castpress_modify_libwp_post_type_name');


function castpress_modify_post_type_argument($castpress_postTypeArguments){
	/**
	 * Modify LibWP post type arguments
	 */
	$castpress_postTypeArguments['labels'] = [
        'name'          => _x('Episodes', 'Post type general name', 'castpress'),
        'singular_name' => _x('Episode', 'Post type singular name', 'castpress'),
        'menu_name'     => _x('Episodes', 'Admin Menu text', 'castpress'),
        'add_new'       => __('Add New', 'castpress'),
        'edit_item'     => __('Edit Episode', 'castpress'),
        'view_item'     => __('View Episode', 'castpress'),
        'all_items'     => __('All Episodes', 'castpress'),
    ];
    $castpress_postTypeArguments['rewrite']['slug'] 	  = 'episodes';
	$castpress_postTypeArguments['menu_position'] 	  	  = 5;
	$castpress_postTypeArguments['taxonomies']	      	  = array('category' , 'post_tag');
	$castpress_postTypeArguments['show_in_admin_bar']     = true;
	$castpress_postTypeArguments['show_in_admin_bar']     = true;
	$castpress_postTypeArguments['hierarchical'] 		  = true;
	$castpress_postTypeArguments['can_export'] 		  	  = true;
	$castpress_postTypeArguments['has_archive'] 		  = true;
	$castpress_postTypeArguments['exclude_from_search']   = false;
	$castpress_postTypeArguments['publicly_queryable']    = true;
	$castpress_postTypeArguments['capability_type'] 	  = 'post';
	$castpress_postTypeArguments['show_in_rest'] 		  = true;
	$castpress_postTypeArguments['supports'] 			  = array('title', 'editor' , 'comments', 'excerpt', 'author', 'medium', 'revisions', 'custom-fields' ) ;	
    return $castpress_postTypeArguments;
}
add_filter('libwp_post_type_1_arguments', 'castpress_modify_post_type_argument');


function castpress_modify_libwp_taxonomy_name($castpress_taxonomyName){
	/**
	 * Modify LibWP taxonomy name
	 */
	$castpress_taxonomyName = 'episodes';
    return $castpress_taxonomyName;
}
add_filter('libwp_taxonomy_1_name', 'castpress_modify_libwp_taxonomy_name');


function castpress_modify_libwp_taxonomy_arguments($castpress_taxonomyArguments){
	/**
	 * Modify LibWP taxonomy name
	 */
	$castpress_taxonomyArguments['labels'] = [
        'name'          => _x('Episode Categories', 'taxonomy general name', 'castpress'),
        'singular_name' => _x('Episode Category', 'taxonomy singular name', 'castpress'),
        'search_items'  => __('Search Episode Categories', 'castpress'),
        'all_items'     => __('All Episode Categories', 'castpress'),
        'edit_item'     => __('Edit Episode Category', 'castpress'),
        'add_new_item'  => __('Add New Episode Category', 'castpress'),
        'new_item_name' => __('New Episode Category Name', 'castpress'),
        'menu_name'     => __('Episode Categories', 'castpress'),
    ];
    $castpress_taxonomyArguments['rewrite']['slug'] = 'episodes';
    return $castpress_taxonomyArguments;
	
}
add_filter('libwp_taxonomy_1_arguments', 'castpress_modify_libwp_taxonomy_arguments');


function castpress_custom_post_author_archive($query) {
	/**
	 *
	 * Include custom post type in author author page 
	 *
	 **/
    if ($query->is_author)
        $query->set( 'post_type', array('episodes', 'post') );
    remove_action( 'pre_get_posts', 'castpress_custom_post_author_archive' );
}
add_action('pre_get_posts', 'castpress_custom_post_author_archive');


function castpress_branding() { 
	/**
	 * Get Custom Logo if exist
	 */
	if ( has_custom_logo() ) {
		the_custom_logo();
	} 
	else {	

		// Display the Text title with link 
		/* translator %s : link of main page. translator %s 2: Site title  */
		echo sprintf('<h1 class="c-header__title site-title"><a href="%s" rel="home">%s</a></h1>' , esc_attr(esc_url( home_url( '/' ))),  esc_html(get_bloginfo( 'name' )) );

		}
}


// Kirki color variables
function castpress_typography() {

	(get_theme_mod( 'typography_primary_color' ) == "" ) ? $castpress_primary_color = "#7247ca" : $castpress_primary_color = get_theme_mod( 'typography_primary_color' ); 

	(get_theme_mod( 'typography_primary_accent_color' ) == "" ) ? $castpress_primary_accent_color = "#58379B" : $castpress_primary_accent_color = get_theme_mod( 'typography_primary_accent_color' ); 

	(get_theme_mod( 'typography_headings_color' ) == "" ) ? $castpress_headingss_color = "#222222" : $castpress_headingss_color = get_theme_mod( 'typography_headings_color' ); 

	(get_theme_mod( 'typography_secondary_color' ) == "" ) ? $castpress_second_color = "#555555" : $castpress_second_color = get_theme_mod( 'typography_secondary_color' ); 

	(get_theme_mod( 'typography_tertiary_color' ) == "" ) ? $castpress_tertiary_color = "#707070" : $castpress_tertiary_color = get_theme_mod( 'typography_tertiary_color' ); 


	$html = ':root {	
				--castpress_primary-color: 			' . $castpress_primary_color . ';
				--castpress_primary_accent-color: 	' . $castpress_primary_accent_color . ';
				--castpress_headings-color:   		' . $castpress_headingss_color . ';
				--castpress_headings-color:    		' . $castpress_headingss_color .';
	            --castpress_second-color:     		' . $castpress_second_color . ';
				--castpress_tertiary-color:   		' . $castpress_tertiary_color . ';
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


function castpress_home_components() {
	/**
      *
	  * Display Home Components and make them customizable from Kirki  
	  *
	  **/

	// Get the parts.
	$template_parts = get_theme_mod( 'home_component' , array( 'components/latest-episode/latest-episode', 'components/episodes', 'components/latest-posts' ) );
	// Loop parts.
	foreach ( $template_parts as $template_part ) {
		get_template_part( 'template-parts/' . $template_part );
	}

}


function castpress_modify_archive_title( $castpress_title ) {
	/**
	 * Modify Archive title 
	 */

    if(is_post_type_archive('episodes')){
		if(get_theme_mod( 'post_type_archive_custom_title' , 'Episodes')){
			return get_theme_mod( 'post_type_archive_custom_title' , 'Episodes');
		}
		else{
			return 'episodes';
		}
	}
	
    return $castpress_title;
}
add_filter( 'wp_title', 'castpress_modify_archive_title' );
add_filter( 'get_the_archive_title', 'castpress_modify_archive_title' );