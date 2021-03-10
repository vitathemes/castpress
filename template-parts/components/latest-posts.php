<div class="c-latest-posts">




    <H1 class="c-latest-posts__title h1-lh--bg">Latest Posts</h1>

    <?php     
    $args = array(
        'posts_per_page' => 2,
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post', 
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();


    get_template_part( 'template-parts/content', get_post_type() );



    endwhile; ?>

    <?php else : ?>
    <?php endif; ?>





</div>