<div class="c-latest-posts">
    <h1 class="c-latest-posts__title h1-lh--bg">Latest Posts</h1>
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
            else : 
        endif;
        ?>
    </div>
    <a class="btn--blog-more btn btn--secondary" href="/blog">
        View Blog
        <span class="dashicons dashicons-arrow-right-alt2"></span>
    </a>
</div>