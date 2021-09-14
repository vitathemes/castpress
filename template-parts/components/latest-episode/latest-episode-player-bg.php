
<div class="c-episode__featured">
    <div class="c-episode__head">
        <div class="c-episode__image">
            <?php castpress_get_thumbnail('medium'); ?>
        </div>

        <div class="c-episode__context">

            <div class="c-episode__title">
                <?php the_title( '<h1 class="c-single__title c-single__title--sm c-main__entry-title"><a class="u-link--secondary" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );?>
            </div>

            <?php 
                if ( 'episodes' == get_post_type() ){
                     /* translator %s : aria label play button , translator 2 %s: aria control, translator 3 %s: Play text  */
                     echo sprintf("<div class='c-episode__player c-episode__player--button-left'><a href='%s' class='c-btn c-btn--play js-btn--play' aria-label='%s' >%s</a></div>" , esc_url( get_permalink() ), esc_attr__( 'Play button' , 'castpress' ) , esc_html__( 'Episode page', 'castpress' ));
                }
            ?>

            <div class="c-episode__meta">

                <?php 
                    if ( 'episodes' == get_post_type() ){
                        castpress_get_category( true);
                    }
			    ?>
                
                <h5 class="c-post__date u-font--regular posted-on">
                <a class="u-link--tertiary" href="<?php esc_url( the_permalink() ) ?>">
                    <?php echo esc_html( get_the_date() ) ?>
                </a>
                </h5>
                
                <span class="seprator h5 u-link--secondary"> | </span><!-- * This part does not need to be translated it's a seprator -->
                
                <?php castpress_posted_by(); ?>

                
                <?php 
                    if ( 'episodes' == get_post_type() ){
                        castpress_get_podcast_player_link( "c-episode__social-share--sm" );
                    }
                ?>

            </div>


        </div>

    </div>

</div>
