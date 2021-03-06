<?php 

    $castpress_args = array(
        'posts_per_page' => 2, // Recommended for design 
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post', 
        'post_status' => 'publish',
    );
    $castpress_latest_posts = new WP_Query($castpress_args);
        if ($castpress_latest_posts->have_posts()) :

?>
<div class="c-latest-posts">
    <h1 class="c-latest-posts__title">
        <?php esc_html_e( 'Latest Posts', 'castpress' ); ?>
    </h1><!-- .c-latest-posts__title  -->

    <div class="c-latest-posts__content">
        <?php  
       
                while ($castpress_latest_posts->have_posts()) : $castpress_latest_posts->the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile; 

                wp_reset_postdata();
            
        ?>
    </div><!-- .c-latest-posts__content -->

    <a class="c-btn c-btn--text-arrow c-btn--arrows-small" aria-label="<?php esc_attr__( 'View Blog', 'castpress' ); ?>"
        href="<?php echo esc_url(get_permalink( get_option( 'page_for_posts' ) )); ?>">
        <?php esc_html_e( 'View Blog', 'castpress' ); ?>
        <span class="dashicons dashicons-arrow-right-alt2"></span>
    </a><!-- .c-btn  -->
</div><!-- .c-latest-posts  -->
<?php endif; ?>