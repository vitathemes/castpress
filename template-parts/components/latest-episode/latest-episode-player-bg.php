
<div class="c-episode__featured">
    <div class="c-episode__head">
        <div class="c-episode__image">
            <?php castpress_get_thumbnail('medium'); ?>
        </div>

        <div class="c-episode__context">

            <div class="c-episode__title">
                <?php the_title( '<h1 class="c-single__title c-single__title--sm c-main__entry-title"><a class="u-link--secondary" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );?>
            </div>

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
            </div>

            <?php 
                if ( 'episodes' == get_post_type() ){
                    castpress_get_podcast_player_link( "c-episode__social-share--sm" );
                }
            ?>

        </div>

    </div>

    <div class="c-episode__palyer">
    
        <?php castpress_get_podcast_audio( $post , "c-episode__palyer" ); ?>

    </div>



</div>
