<?php 
    $args = array(
        'posts_per_page' => get_option("posts_per_page"), 
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'episodes', 
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        echo '<div class="c-latest-episodes c-latest-episodes--column">';
        while ( $query->have_posts() ) : $query->the_post();		
?>

<div class="c-episode">

    <div class="c-episode__head">
        <div class="c-episode__thumbnail c-episode__thumbnail--column">

            <a href="<?php esc_url( the_permalink() ) ?>">
                <?php makemeup_get_thumbnail(); ?>
            </a>
        </div>

        <div class="c-episode__entry-meta">

            <?php  
                makemeup_get_category(true);
                echo '<span class="seprator h5 a--secondary"> | </span>';
                echo '<span class="c-episode__date h5 h5-lh--sm">'.esc_html( get_the_date( "M d, Y" ) ).'</span>';
             ?>

            <div class="c-episode__titles">
                <?php  the_title('<h2 class="c-episode__title c-episode__title--row"><a class="a--secondary" href="'.esc_url( get_permalink() ).'" rel="bookmark">', '</a></h2>' ); ?>
            </div>

            <div class="c-episode__entry-content h4">
                <p class="c-episode__entry-context h4"><?php echo esc_html(get_the_excerpt()); ?></h4>
            </div>

        </div>

    </div>

</div>

<?php 
        endwhile;
        echo '</div>';
    endif;
    
?>