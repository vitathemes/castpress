<?php
/**
 * Template part for displaying single
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('c-single'); ?>>

    <div class="c-single__thumbnail">
        <div class="c-single__image">
            <?php makemeup_get_thumbnail(); ?>
        </div>
    </div>

    <header class="c-single__header">
        <?php
		the_title( '<h2 class="c-single__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		if ( 'post' === get_post_type() ) :
        ?>

        <div class="c-single__entry-meta">
            <?php makemeup_posted_on(); ?>
            |
            <?php makemeup_posted_by(); ?>

        </div><!-- .entry-meta -->

        <?php endif; ?>

    </header><!-- .entry-header -->

    <div class="c-single__entry-content">

        <?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'makemeup' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		// Show post tags 
		makemeup_get_tags();

		?>

    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->