<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */
?>


<?php $postNumber = makemeup_deciaml_post_number(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c-episode'); ?>>

    <section class="c-episode__header">

        <?php 

            makemeup_get_category();
            echo '<span class="seprator h5 a--secondary"> | </span>';
            echo '<span class="c-episode__date h5--secondary h5-lh--sm">'.esc_html( get_the_date( "M d, Y" ) ).'</span>'; 
            
        ?>

        <div class="c-episode__titles">
            <?php  the_title('<h2 class="c-episode__title"><a class="a--secondary" href="'.esc_url( get_permalink() ).'" rel="bookmark">'.$postNumber.' - ', '</a></h2>' ); ?>
        </div>


        <div class="c-episode__entry-content h4">
            <p class="c-episode__entry-context h4"><?php echo get_the_excerpt(); ?></h4>
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

    </section>

</article><!-- #post-<?php the_ID(); ?> -->