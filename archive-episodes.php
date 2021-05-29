<?php
/**
 * The template for displaying episodes archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */

get_header();
?>

<main id="primary" class="c-main c-main--episode">
    <div class="c-main__content">
        <header class="c-post__header c-post__header--page">
            <h1 class="c-main__entry-title u-heading-1-line-height--bg">
				<?php esc_html_e( 'Episodes', 'castpress' ); ?>
			</h1>
        </header><!-- .entry-header -->
		
        <?php if ( have_posts() ) : ?>
        <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content',  'episodes' );
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