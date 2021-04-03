<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */

get_header();
?>

<main id="primary" class="c-main">

    <div class="c-main__content">

        <?php if ( have_posts() ) : ?>

        <header class="page-header">

        </header><!-- .page-header -->

        <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
			   echo "<div class='c-spacer'></div>";//qa-
			   makemeup_get_default_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

    </div>

</main><!-- #main -->

<?php
get_footer();