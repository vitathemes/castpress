<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */
?>


<?php $postNumber = castpress_deciaml_post_number(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c-episode'); ?>>

    <section class="c-episode__header">

        <?php 
            castpress_get_category();
            echo '<span class="seprator h5 u-link--secondary"> | </span>';
            echo '<span class="c-episode__date h5  u-font--regular  u-heading-5-line-height--sm">'.esc_html( get_the_date( "M d, Y" ) ).'</span>'; 
        ?>

        <div class="c-episode__titles">
            <?php  the_title('<h2 class="c-episode__title"><a class="u-link--secondary" href="'.esc_url( get_permalink() ).'" rel="bookmark">'.$postNumber.' - ', '</a></h2>' ); ?>
        </div>


        <div class="c-episode__entry-content h4">
            <p class="c-episode__entry-context h4"><?php echo esc_html(get_the_excerpt()); ?></h4>
        </div>

        <a class="c-episode__read-more span u-font--semi-bold u-link--quaternary" href=" <?php esc_url( the_permalink() ) ?> "
            rel="bookmark">
            <span class="c-episode__play"></span>
            <?php esc_html_e( 'Listen Now', 'castpress' ); ?>
        </a>

        <?php
			wp_link_pages(
				array(
					'before' => '<div class="c-episode__page-links">' . esc_html__( 'Pages:', 'castpress' ),
					'after'  => '</div>',
				)
			);
		?>

    </section>

</article><!-- #post-<?php the_ID(); ?> -->