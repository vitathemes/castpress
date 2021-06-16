<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-post'); ?>>

    <div class="c-post__thumbnail">

        <a href=<?php esc_url(the_permalink()) ?> rel="bookmark">
            <?php castpress_get_thumbnail('medium'); ?>
        </a>

    </div><!-- .c-post__thumbnail -->

    <header class="c-post__header">
        <?php the_title( '<h2 class="c-post__title c-main__entry-title"><a class="u-link--secondary" aria-label="' . esc_attr( get_the_title() ) . '" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

        <div class="c-post__entry-meta">
            <h5 class="c-post__date u-font--regular u-link--tertiary posted-on">
                <?php echo esc_html( get_the_date() ) ?>
            </h5>
        </div><!-- .entry-meta -->

        <a class="c-post__read-more h5" href=" <?php esc_url( the_permalink() )  ?> " aria-label=" <?php esc_attr__( 'Read More', 'castpress' ); ?>" rel="bookmark">
            <?php esc_html_e( 'Read More', 'castpress' ); ?>
        </a><!-- .c-post__read-more -->

        <?php
			wp_link_pages(
				array(
					'before' => '<div class="c-post__page-links">' . esc_html__( 'Pages:', 'castpress' ),
					'after'  => '</div>',
				)
			);
		?>

    </header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->