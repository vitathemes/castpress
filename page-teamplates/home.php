<?php
/**
 *  Template Name: Home
 * 
 */

get_header();
?>

<main id="primary" class="c-main c-main--home">

    <div class="c-main__content">

        <div class="c-main__featured-episode c-main__featured-episode--home">
            <?php makemeup_get_featured_episode(); ?>
        </div><!-- .c-main__featured-episode -->

        <div class="spacer"></div>

        <div class="posts">
            <?php
            
                if( get_query_var( 'paged' ) )
                    $my_page = get_query_var( 'paged' );
                else {
                if( get_query_var( 'page' ) )
                    $my_page = get_query_var( 'page' );
                else
                    $my_page = 1;
                    set_query_var( 'paged', $my_page );
                    $paged = $my_page;
                }

                global $post;
                $tmp_post = $post;
                $paged = ( get_query_var("paged") ) ? get_query_var("paged") : 1;
                
                $args = array (
                    "post_status"            => "publish",
                    "post_type"              => "episodes",
                    "paged"                  =>  $paged,
                    "posts_per_page"         =>  get_option("posts_per_page"),
                );
                
                $wp_query = null;
                $wp_query = new WP_Query();
                $wp_query->query( $args );
                
                if ( $wp_query->have_posts() ) :
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    get_template_part( 'template-parts/content', get_post_type() );	
                endwhile;
                    makemeup_get_default_pagination();
                    $post = $tmp_post; 
                endif;
                
            ?>
        </div>
        <?php get_template_part( 'template-parts/components/latest-posts'); ?>
    </div>

</main><!-- #main -->

<?php
get_footer();