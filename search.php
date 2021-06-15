<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package castpress
 */

get_header();
?>

<main id="primary" class="c-main">
    <div class="c-main__content">
        <?php if ( have_posts() ) : ?>
        <header class="c-main__header">
            <h1 class="c-main__entry-title">
                <?php esc_html_e( 'Search Result', 'castpress' ); ?>
            </h1>
        </header><!-- .entry-header -->

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