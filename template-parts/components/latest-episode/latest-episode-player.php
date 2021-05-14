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
        $episode_player = true;
        echo '<div class="c-latest-episode c-latest-episode--home">';
        while ( $query->have_posts() ) : $query->the_post();			
            get_template_part( 'template-parts/components/latest-episode/latest-episode' );
        endwhile;
        echo '</div>';
    endif;