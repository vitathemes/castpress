<?php
/**
 * 
 *  Template Name: Home
 * 
 * 
 */

get_header();
?>

<main id="primary" class="c-main">

    <div class="c-main__content">

        <div class="c-main__featured-episode c-main__featured-episode--home">
            <?php makemeup_get_featured_episode(); ?>
        </div><!-- .c-main__featured-episode -->

        <div class="spacer"></div>

        <?php
		   $loop = new WP_Query( array( 'post_type' => 'episodes', 'paged' => $paged ) );
		   if ( $loop->have_posts() ) :
			   while ( $loop->have_posts() ) : $loop->the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
				makemeup_get_default_pagination();
		else :
			return;
		endif;
		?>

        <?php
			get_template_part( 'template-parts/components/latest-posts');
		?>
    </div>

</main><!-- #main -->

<?php
get_footer();