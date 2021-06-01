<div class="c-latest-episodes">
    <?php
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
        
        $castpress_args = array (
            "post_status"            => "publish",
            "post_type"              => "episodes",
            "paged"                  =>  $castpress_paged_post,
            "posts_per_page"         =>  get_option("posts_per_page"),
            "offset"                 =>  1
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
    ?>
</div>