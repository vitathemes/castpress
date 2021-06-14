<?php
/**
 * Template part for displaying latest episode
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-single c-single--latest-episode'); ?>>

    <div class="c-single__thumbnail">
        <div class="c-single__image">
            <a href="<?php esc_url( the_permalink() ) ?>">
                <?php castpress_get_thumbnail('medium'); ?>
            </a>
        </div>
    </div>

    <header class="c-single__header">
        <?php the_title( '<h1 class="c-single__title c-single__title--sm c-main__entry-title u-heading-1-line-height--bg"><a class="u-link--secondary" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );?>
        <div class="c-single__podcast-audio">
            <?php 
                if ( 'episodes' == get_post_type() ){
                    // castpress_get_podcast_audio( $post , "c-single__audio" );

                    echo "<div class='c-episode__player c-episode__player--button'>";
					echo "<button> Play </button>";
					echo "</div>";


                }	
            ?>
        </div>

        <?php castpress_get_podcast_player_link(); ?>

    </header><!-- .entry-header -->

    <div class="s-single__entry-content">

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
        ?>
        
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->