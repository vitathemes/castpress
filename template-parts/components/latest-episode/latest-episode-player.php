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
        echo '<div class="c-main__featured-episode c-main__featured-episode--home">';
        while ( $query->have_posts() ) : $query->the_post();			
        include( locate_template( 'template-parts/components/content-episode.php', false, false ) ); 
        endwhile;
        echo '</div>';
    endif;
    
?>