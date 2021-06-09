
<?php 
/**
 * 
 * Template Name: Home2
 * 
 * The main template file for home page
 *
 * If this page doesn't exists index.php will show ( Recommended for using as home page )
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); 
?>

<main id="primary" class="c-main c-main--home">

    <div class="c-main__content">
    <?php 
               
               $args = array(
                   'posts_per_page' => 1, 
                   'offset' => 0,
                   'orderby' => 'post_date',
                   'order' => 'DESC',
                   'post_type' => 'episodes', 
                   'post_status' => 'publish'
               );
           
               $query = new WP_Query($args);
              
           
               if ($query->have_posts()) :
   
                   while ( $query->have_posts() ) : $query->the_post();
                       echo '<div class="c-latest-episode c-latest-episode--home">';
                    //    get_template_part( 'page-templates/test-latest-episodes-2');
                   endwhile;
                       echo '</div>';
               endif;
   
   
            /***-**************************************************************************** */

            echo '<div class="c-latest-episodes">';
            // Show latest episodes in home page 
            if( get_query_var( 'paged' ) )
                $castpress_paged = get_query_var( 'paged' );
            else {
            if( get_query_var( 'page' ) )
                $castpress_paged = get_query_var( 'page' );
            else
                $castpress_paged = 1;
                set_query_var( 'paged', $castpress_paged );
                $castpress_paged_post = $castpress_paged;
            }
    
            $castpress_paged_post = ( get_query_var("paged") ) ? get_query_var("paged") : 1;
            
            // Select last Episode
            $castpress_latest_episode = get_posts("post_type=episodes&numberposts=1");
            $castpress_latest_episode = $castpress_latest_episode[0]->ID;
    
            $castpress_args = array (
                "post_status"            => "publish",
                "post_type"              => "episodes",
                'post__not_in'           => array($castpress_latest_episode),
                "paged"                  => $castpress_paged_post,
                "posts_per_page"         => get_option("posts_per_page"),
            );
            
            global $castpress_query;
            $castpress_query = $wp_query;
    
            $castpress_query->query( $castpress_args );
    
            if ( $castpress_query->have_posts() ) :
            while ( $castpress_query->have_posts() ) : $castpress_query->the_post();
                get_template_part( 'template-parts/content', get_post_type() );	
            endwhile;
                castpress_get_default_pagination();
            endif;


            echo '</div>';
            /***-**************************************************************************** */
   
               get_template_part( 'template-parts/components/latest-posts' );
   
           ?>
    </div>

</main><!-- #main -->

<?php
get_footer();