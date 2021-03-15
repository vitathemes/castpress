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


//Exclude pages from WordPress Search //qa- 
if (!is_admin()) {
	function wpb_search_filter($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
			return $query;
		}
	add_filter('pre_get_posts','wpb_search_filter');
}



function add_additional_class_on_li($classes, $item, $args) {
	/**
	 *	Add class to menu items 
	 */
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


function cavatina_total_post_types( $isText = true ) {	
	/**
	 * count number of posts types (episodes) in a page
	 */

	if($isText === true){
		printf(esc_html($count_posts = wp_count_posts( 'episodes' )->publish));
	}
	else{
		return $count_posts = wp_count_posts( 'episodes' )->publish;
	}	
}


function cavatina_get_inverse_post_number(){
	/**
	 * Auto decrement number per posts ( in pages like archive-projects... )
	 */
	global $wp_query;
    $posts_per_page 	= get_option('posts_per_page');
	$paged          	= (get_query_var('paged')) ? get_query_var('paged') : 1;
	$offset         	= ($paged - 1) * $posts_per_page;
	$loop           	= $wp_query->current_post + 1;
	$posts_in_page	    = $offset + $loop;
	$total_post_numbers = cavatina_total_post_types(false) + 1;
	$posts_counter 	    = $total_post_numbers - $posts_in_page;

	return $posts_counter;
}


function cavatina_deciaml_post_number(){
	/**
	 * Add zero to the post numbers
	 */
	
    // get post number (auto increment)
    $decimalCounter = "0";
    $postNumber = cavatina_get_inverse_post_number();
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




if ( ! function_exists( 'pietergoosen_pagination' ) ) :

    function pietergoosen_pagination($pages = '', $range = 2) {   
       $showitems = ($range * 2)+1;  

      global $paged;
      if(empty($paged)) $paged = 1;

          if($pages == '')
          {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
                if(!$pages)
                {
                $pages = 1;
                }
            }   

           if(1 != $pages)
          {
            $string = _x( 'Page %1$s of %2$s' , '%1$s = current page, %2$s = all pages' , 'pietergoosen' );
            echo "<div class='pagination'><span>" . sprintf( $string, $paged, $pages ) . "</span>";
              if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>" . __( '&laquo; First', 'pietergoosen' ) . "</a>";
             if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>" . __( '&lsaquo; Previous', 'pietergoosen' ) . "</a>";

                for ($i=1; $i <= $pages; $i++)
                {
                   if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                   {
                        echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                   }
               }

               if ($paged < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged + 1)."'>" . __( 'Next &rsaquo;', 'pietergoosen' ) . "</a>";
               if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>" . __( 'Last &raquo;', 'pietergoosen' ) . "</a>";
               echo "</div>\n";
         }
        } //  pietergoosen_pagination

endif;


add_filter( 'comment_form_defaults', function( $defaults ){
    // Edit this to your needs:

	$button = '<button name="%1$s" type="submit" id="%2$s" class="%3$s comment-form-arrow" value="%4$s"> Submit<span class="dashicons dashicons-arrow-right-alt2"></span></button>';


    // Override the default submit button:
    $defaults['submit_button'] = $button;

    return $defaults;
} );


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