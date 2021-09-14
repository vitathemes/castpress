<?php 
    $castpress_args = array(
        'posts_per_page' => 1, 
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'episodes', 
        'post_status' => 'publish'
    );

    $castpress_query = new WP_Query($castpress_args);
   
    if ($castpress_query->have_posts()) :

        echo '<div class="c-latest-episode c-latest-episode--home">';

        while ( $castpress_query->have_posts() ) : $castpress_query->the_post();

            if( get_theme_mod( 'homepage_last_ep_single' , 'style-1') == 'style-1'){
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player');
            }
            elseif(get_theme_mod( 'homepage_last_ep_single' , 'style-1') == 'style-2' ){
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player-bg');
            }
            else{
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player');
            }

        endwhile;

        wp_reset_postdata();

        echo '</div>';
        
    endif;
