<div class="c-latest-episodes">
    <?php
        // Show latest episodes in home page 
        if( get_query_var( 'paged' ) )
            $my_page = get_query_var( 'paged' );
        else {
        if( get_query_var( 'page' ) )
            $my_page = get_query_var( 'page' );
        else
            $my_page = 1;
            set_query_var( 'paged', $my_page );
            $paged_post = $my_page;
        }

        global $post;
        $tmp_post = $post;
        $paged_post = ( get_query_var("paged") ) ? get_query_var("paged") : 1;
        
        $args = array (
            "post_status"            => "publish",
            "post_type"              => "episodes",
            "paged"                  =>  $paged_post,
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
        endif;
    ?>
</div>