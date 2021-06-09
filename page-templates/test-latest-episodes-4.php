
<?php $postNumber = castpress_deciaml_post_number(); ?>
<div class="c-latest-episodes c-latest-episodes--row">
<div class="c-episode">

    <div class="c-episode__head">
        <div class="c-episode__thumbnail c-episode__thumbnail--row">

            <a href="<?php esc_url( the_permalink() ) ?>">
                <?php castpress_get_thumbnail(); ?>
            </a>
        </div>

        <div class="c-episode__entry-meta c-episode__entry-meta--bg">

            <div class="c-episode__entry-content">

                <?php castpress_get_category(); ?>
                <span class="seprator h5 u-link--secondary"> | </span> <!-- No need to translate or sanitize it's a seprator --> 
                <?php  echo '<h5 class="c-episode__date u-font--regular u-heading-5-line-height--sm">'.esc_html( get_the_date() ).'</h5>'; ?>

                <div class="c-episode__titles c-episode__titles--sm">
                <?php  the_title('<h2 class="c-episode__title"><a class="u-link--secondary" href="'.esc_url( get_permalink() ).'" rel="bookmark">', '</a></h2>' ); ?>
                </div>

            </div>
            
            <a class="c-episode__read-more h6 u-line-height--sm u-link--quaternary" href=" <?php esc_url( the_permalink() ) ?> "
                rel="bookmark">
                <span class="c-episode__play"></span>
                <?php esc_html_e( 'Listen Now', 'castpress' ); ?>
            </a>


        </div>

    </div>

</div>
</div>
