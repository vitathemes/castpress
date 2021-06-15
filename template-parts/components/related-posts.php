<?php

    global $post;
    $castpress_tags = wp_get_post_tags($post->ID);
    if ($castpress_tags) {
    
    $castpress_tag_ids = array();
    foreach($castpress_tags as $castpress_individual_tag) $castpress_tag_ids[] = $castpress_individual_tag->term_id;
        
    $castpress_args=array(
            
        'tag__in' => $castpress_tag_ids,
        'posts_per_page'=> 2, // Number of related posts that will be shown.
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=> 1
        
    );

    $castpress_loop = new wp_query( $castpress_args );
                
    if( $castpress_loop->have_posts() ) { ?>
    <div class="c-related-posts">
        <h1 class="u-heading-1-line-height--sm"><?php esc_html_e( 'Related Posts', 'castpress' ); ?></h1>
        <?php 
            while( $castpress_loop->have_posts() ) {
                $castpress_loop->the_post();
                get_template_part( 'template-parts/content' ); //Show Content.php
            }?>
    </div><!-- c-related-posts -->
    <?php
        }
    }
    wp_reset_postdata(); 
    ?>
    
   
    