<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */
get_header();
?>
<main id="primary" class="c-main <?php castpress_get_main_class(); ?>">
    <div class="c-main__content">

		<?php castpress_get_archives_header(); ?>

        <?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content' , get_post_type() );
				endwhile;
				castpress_get_default_pagination();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
		?>
    </div>
</main><!-- #main -->
<?php
get_footer();