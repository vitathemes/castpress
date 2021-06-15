<?php $castpress_postNumber = castpress_deciaml_post_number(); ?>
<div class="c-latest-episodes <?php castpress_get_latest_episodes_class_name(); ?>">
<div class="c-episode">
    <div class="c-episode__head">
        <div class="c-episode__thumbnail c-episode__thumbnail--row">
            <a href="<?php esc_url( the_permalink() ) ?>">
                <?php castpress_get_thumbnail('medium'); ?>
            </a>
        </div>
        
        <div class="c-episode__entry-meta c-episode__entry-meta--bg">
            <div class="c-episode__entry-content">
                <?php castpress_get_category(); ?>
                <span class="seprator h5 u-link--secondary"> <?php echo esc_html(" | ") ?> </span> <!-- No need to translate or sanitize it's a seprator --> 
                <?php  echo '<h5 class="c-episode__date u-font--regular">'.esc_html( get_the_date() ).'</h5>'; ?>

                <div class="c-episode__titles c-episode__titles--sm">
                <?php the_title('<h2 class="c-episode__title"><a class="u-link--secondary" href="'.esc_url( get_permalink() ).'" rel="bookmark">'.esc_html( $castpress_postNumber ).' - ', '</a></h2>' ); ?>
                </div>

                <?php 
                if(get_theme_mod( 'latest_episodes' , 'style-1') == 'style-2'){  ?>
                    <div class="c-episode__entry-content">
                        <p class="c-episode__entry-context"><?php echo esc_html(get_the_excerpt()); ?></p>
                    </div>
                <?php } ?>
            </div>

            <?php if(get_theme_mod( 'latest_episodes' , 'style-1') !== 'style-2'){  ?>
                <a class="c-episode__read-more h6 u-link--quaternary" href=" <?php esc_url( the_permalink() ) ?> "
                    rel="bookmark">
                    <span class="c-episode__play"></span>
                    <?php esc_html_e( 'Listen Now', 'castpress' ); ?>
                </a>
            <?php } ?>

        </div>
    </div>
</div>
</div>
