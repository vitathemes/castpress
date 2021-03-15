<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-post'); ?>>

    <div class="c-post__thumbnail">
        <a href=<?php esc_url(the_permalink()) ?> rel="bookmark">
            <?php makemeup_get_thumbnail(); ?>
        </a>
    </div>

    <header class="c-post__header">
        <?php
		    the_title( '<h2 class="c-post__title c-main__entry-title"><a class="a--secondary" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		    if ( 'post' === get_post_type() ) :
        ?>

        <div class="c-post__entry-meta">
            <span class="c-post__date h5 font--semibold  a--tertiary h5-lh--sm posted-on">
                <?php echo esc_html( get_the_date( "M d, Y" ) ) ?>
            </span>
        </div><!-- .entry-meta -->

        <a class="c-post__read-more h5" href=" <?php esc_url( the_permalink(  ) )  ?> " rel="bookmark">
            <?php esc_html_e( 'Read More', 'makemeup' ); ?>
        </a>

        <?php endif; ?>

        <?php
			wp_link_pages(
				array(
					'before' => '<div class="c-post__page-links">' . esc_html__( 'Pages:', 'makemeup' ),
					'after'  => '</div>',
				)
			);
		?>

    </header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->