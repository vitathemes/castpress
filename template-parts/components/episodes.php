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

            if( get_theme_mod( 'homepage_header_single' , 'style-1') == 'style-1') {
                get_template_part( 'template-parts/content', get_post_type() );	
            }
            elseif(get_theme_mod( 'homepage_header_single' , 'style-1') == 'style-2') {
                get_template_part( 'template-parts/components/latest-episode/latest-episode-player');
            }
            else{
                get_template_part( 'template-parts/content', get_post_type() );	
            }

            get_template_part( 'template-parts/components/latest-episode/latest-episodes-row' );	

        endwhile;
            castpress_get_default_pagination();
        endif;
    ?>
</div>