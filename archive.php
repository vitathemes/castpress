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
<main id="primary" class="c-main">
    <div class="c-main__content">
        <?php if ( have_posts() ) : ?>
        <header class="c-main__header">
            <h1 class="c-main__entry-title h1-lh--bg">
                <?php castpress_archive_page_name() ?>
            </h1>
        </header><!-- .-main__content -->
        <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content' );
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