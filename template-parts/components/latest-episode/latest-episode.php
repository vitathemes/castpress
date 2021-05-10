<?php
/**
 * Template part for displaying latest episode
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makemeup
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c-single c-single--latest-episode'); ?>>

    <div class="c-single__thumbnail">
        <div class="c-single__image">
            <a href="<?php esc_url( the_permalink() ) ?>">
                <?php makemeup_get_thumbnail(); ?>
            </a>
        </div>
    </div>

    <header class="c-single__header">

        <?php the_title( '<h1 class="c-single__title c-main__entry-title"><a class="a--secondary h1 h1-lh--bg" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );?>

        <div class="c-single__entry-meta">
            <?php    
				if( $episode_player ){
					
					echo "<div class='c-episode__player'>";
					echo do_shortcode('[audio mp3="https://chtbl.com/track/G2F3EG/api.spreaker.com/download/episode/16457419/suspicion_ep_10_the_final_verdict.mp3" ][/audio]');
					echo "</div>";
					
				}
				else{

					echo "<div class='c-episode__player c-episode__player--button'>";
					echo "<button> Play </button>";
					echo "</div>";
					
				}
			?>

        </div><!-- .entry-meta -->

        <?php makemeup_get_podcast_player_link(); ?>

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
		?>

    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->