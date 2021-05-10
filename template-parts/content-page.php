<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="c-post__header c-post__header--page">
        <?php the_title('<h1 class="c-main__entry-title h1-lh--bg">','</h1>'); ?>
    </header><!-- .entry-header -->

    <?php castpress_post_thumbnail(); ?>

    <div class="c-post__content">
        <?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'castpress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'castpress' ),
					'after'  => '</div>',
				)
			);
		?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
    <footer class="c-post__footer">
        <?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'castpress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
    </footer><!-- .entry-footer -->
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->