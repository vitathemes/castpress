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

    <?php makemeup_get_single_thumbnail( false ); ?>

    <header class="c-single__header">
        <?php the_title( '<h1 class="c-single__title c-main__entry-title"><a class="a--secondary h1 h1-lh--bg" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
        <div class="c-single__entry-meta">
            <?php 
				if ( 'episodes' == get_post_type() ){
					makemeup_get_category(false , true);
				}	
			?>

            <span class="c-post__date h5--secondary h5-lh--sm posted-on">
                <a class="a--tertiary" href="<?php esc_url( the_permalink() ) ?>">
                    <?php echo esc_html( get_the_date( "M d, Y" ) ) ?>
                </a>
            </span>

            <span class="seprator h5 a--secondary"> | </span>

            <?php makemeup_posted_by( true ); ?>

            <?php 
			if ( 'episodes' == get_post_type() ){
                makemeup_get_audio_podcast( $post );
			}	
			?>

        </div><!-- .entry-meta -->

        <?php 
		if ( 'episodes' == get_post_type() ){
            
            makemeup_get_podcast_player_link();
            
		}
		?>

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
        <?php if ( 'episodes' == get_post_type() ) {
            
          
            echo "<br />";
            echo "<br />";
            
            $my_meta1 = get_post_meta( $post->ID, 'podcast_audio_url', true ); 
            echo $my_meta1;
            echo "<br />";
            echo "<br />";

            $my_meta2 = get_post_meta( $post->ID, 'podcast_duration', true ); 
            echo $my_meta2;

            echo "<br />";
            echo "<br />";
            $my_meta3 = get_post_meta( $post->ID, 'podcast_filesize', true ); 
            echo $my_meta3;

            echo "<br />";
            echo "<br />";
            $my_meta4 = get_post_meta( $post->ID, 'podcast_enclosure', true ); 
            echo $my_meta4;

            echo "<br />";
            echo "<br />";
            $my_meta5 = get_post_meta( $post->ID, 'podcast_author', true ); 
            echo $my_meta5;

            echo "<br />";
            echo "<br />";
            
            $my_meta6 = get_post_meta( $post->ID, 'podcast_publish_date', true ); 
            echo $my_meta6;

            echo "<br />";
            echo "<br />";
            
        ?>
        <div class="c-single__transcript">

            <h2 class="c-single__transcript__title">Listening time: 86 minutes</h2>
            <span class="c-single__transcript__sep h2">|</span>
            <a class="c-single__transcript__more js-single__transcript__more h2">View transcript
                <span class="c-single__transcript__icon dashicons dashicons-arrow-right-alt"></span>
            </a>

        </div>
        <div class="c-single__transcript__content">
            <div class="c-single__transcript__wrapper" data-simplebar data-simplebar-auto-hide="false">
                <div class="c-single__transcript__context">
                    <div class="c-single__transcript__row">
                        <h3 class="font--semibold">Per Axbom</h3>
                        <p>Hello, I’m Per Axbom.</p>
                        <h3 class="font--semibold">James Royal-Lawson</h3>
                        <p>And I’m James Royal-Lawson.</p>
                    </div>

                    <div class="c-single__transcript__row">
                        <h3 class="font--semibold">Per Axbom</h3>
                        <p>
                            Vivamus et aliquet neque. Mauris feugiat blandit augue a vestibulum. Class aptent taciti
                            sociosqu ad
                            litora torquent per conubia nostra, per inceptos himenaeos. Aliquam a luctus magna, a
                            finibus
                            massa.
                            Proin ultricies, arcu ac dignissim sollicitudin, nibh nibh fermentum eros,
                        </p>

                        <p>
                            Vivamus et aliquet neque. Mauris feugiat blandit augue a vestibulum. Class aptent taciti
                            sociosqu ad
                            litora torquent per conubia nostra, per inceptos himenaeos. Aliquam a luctus magna, a
                            finibus
                            massa.
                            Proin ultricies, arcu ac dignissim sollicitudin, nibh nibh fermentum eros,
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="c-single__tags">
            <?php
			    // Show post tags 
			    makemeup_get_tags('c-single__tag');  
		    ?>
        </div>

        <div class="c-social-share c-social-share--single">

            <?php makemeup_share_links(); ?>

        </div>

        <?php 
            if ( 'episodes' !== get_post_type() ){
                    get_template_part( 'template-parts/components/related-posts' ); 
            }
        ?>

</article><!-- #post-<?php the_ID(); ?> -->