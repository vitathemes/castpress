<div class="c-related-posts">

    <h1 class="h1-lh--sm">Related Posts</h1>

    <?php
        $orig_post = $post;
        global $post;

        $tags = wp_get_post_tags($post->ID);

        if ($tags) {
            
            $tag_ids = array();
            foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                
            $args=array(
                    
                'tag__in' => $tag_ids,
                'posts_per_page'=> 2, // Number of related posts that will be shown.
                'post__not_in' => array($post->ID),
                'ignore_sticky_posts'=> 1
                
            );

            $loop = new wp_query( $args );
                        
            if( $loop->have_posts() ) {
                while( $loop->have_posts() ) {
                $loop->the_post();
                
                    get_template_part( 'template-parts/content' ); //Show Content.php
                    
                }
            }
        }
        $post = $orig_post; 
        wp_reset_query(); 
    ?>

</div>