<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */

get_header();
?>

<main id="primary" class="c-main c-main--blog">

    <div class="c-main__content">

        <header class="c-main__header">
            <h1 class="c-main__entry-title h1-lh--bg">
                <?php makemeup_archive_page_name() ?>
            </h1>
        </header><!-- .entry-header -->


        <?php
		if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
		?>
        <header>
            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>
        <?php
			endif;

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
				echo '<div class="c-spacer__blog qa-"></div>';
			 	makemeup_get_default_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

    </div>



</main><!-- #main -->

<?php
get_footer();