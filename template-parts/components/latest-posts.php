<div class="c-latest-posts">
    <h1 class="c-latest-posts__title u-heading-1-line-height--bg"><?php esc_html_e( 'Latest Posts', 'castpress' ); ?></h1>
    <div class="c-latest-posts__content">
        <?php  
        $args = array(
            'posts_per_page' => 2,
            'offset' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post', 
            'post_status' => 'publish',
        );
        $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile; 
            endif;
        ?>
    </div>
    <a class="btn btn--text-arrow btn--arrows-small"
        href="<?php echo esc_url(get_permalink( get_option( 'page_for_posts' ) )); ?>">
        <?php esc_html_e( 'View Blog', 'castpress' ); ?>
        <span class="dashicons dashicons-arrow-right-alt2"></span>
    </a>
</div>