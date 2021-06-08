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

        echo '<div class="c-latest-episode c-latest-episode--home">';

        while ( $query->have_posts() ) : $query->the_post();

            if( get_theme_mod( 'homepage_header_single' , 'style-1') == 'style-1'){
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player');
            }
            elseif(get_theme_mod( 'homepage_header_single' , 'style-1') == 'style-2' ){
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player-bg');
            }
            else{
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player');
            }


        endwhile;

        echo '</div>';
        
    endif;
