
<div class="c-latest-episodes c-latest-episodes--row">
<div class="c-episode">

    <div class="c-episode__head">
        <div class="c-episode__thumbnail c-episode__thumbnail--row">

            <a href="<?php esc_url( the_permalink() ) ?>">
                <?php castpress_get_thumbnail(); ?>
            </a>
        </div>

        <div class="c-episode__entry-meta">

            <?php  
                castpress_get_category(true);
                echo '<span class="c-episode__date h5 h5-lh--sm">'.esc_html( get_the_date( "M d, Y" ) ).'</span>';
             ?>

            <div class="c-episode__titles">
                <?php  the_title('<h2 class="c-episode__title c-episode__title--row"><a class="a--secondary" href="'.esc_url( get_permalink() ).'" rel="bookmark">', '</a></h2>' ); ?>
            </div>

            <div class="c-episode__entry-content h4">
                <p class="c-episode__entry-context h4"><?php echo get_the_excerpt(); ?></h4>
            </div>

        </div>

    </div>

</div>
</div>
