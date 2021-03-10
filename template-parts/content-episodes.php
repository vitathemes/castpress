<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-episode'); ?>>

    <section class="c-episode__header">

        <?php 
              makemeup_get_category();
              echo " <span class='h5 a--secondary'> | </span> ";
              makemeup_posted_on( true , true );
        ?>

        <?php
		the_title( '<h2 class="c-episode__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		if ( 'post' === get_post_type() ) :
        ?>

        <div class="c-episode__entry-meta">
            <?php makemeup_posted_on(); ?>
        </div><!-- .entry-meta -->

        <?php endif; ?>


        <div class="c-episode__entry-content h4">
            <?php the_excerpt(); ?>
        </div>

        <a class="c-episode__read-more span font--semibold a--fourth" href=" <?php esc_url( the_permalink() ) ?> "
            rel="bookmark">
            <span class="c-episode__play"></span>
            <?php esc_html_e( 'Listen Now', 'makemeup' ); ?>
        </a>


        <?php
			wp_link_pages(
				array(
					'before' => '<div class="c-episode__page-links">' . esc_html__( 'Pages:', 'makemeup' ),
					'after'  => '</div>',
				)
			);
		?>

    </section><!-- -->


</article><!-- #post-<?php the_ID(); ?> -->