<?php
/**
 * Template part for displaying single
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package castpress
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c-single'); ?>>

    <?php castpress_get_single_thumbnail( false , 'medium' ); ?>

    <header class="c-single__header">

        <?php the_title( '<h1 class="c-single__title c-main__entry-title"><a class="u-link--secondary" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

        <div class="c-single__entry-meta">

            <?php castpress_get_category(true); ?>

            <h5 class="c-post__date u-font--regular posted-on">
                <a class="u-link--tertiary" href="<?php esc_url( the_permalink() ) ?>">
                    <?php echo esc_html( get_the_date() ) ?>
                </a>
            </h5>

            <span class="seprator h5 u-link--secondary"> <?php echo esc_html( " | " ) ?> </span><!-- Simple Seprator -->

            <?php castpress_posted_by(); ?>

            <div class="c-single__podcast-audio">
                <?php 
                    if ('episodes' == get_post_type()){
                        castpress_get_podcast_audio( $post , "c-single__audio" );
                    }
			    ?>
            </div>

            <?php 
                if ( 'episodes' == get_post_type() ){
                    castpress_get_podcast_player_link();
                }
		    ?>
        </div><!-- .entry-meta -->

    </header><!-- .entry-header -->

    <section class="s-single__entry-content">
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

        <?php 
        if ( 'episodes' == get_post_type() ) :
          $castpress_podcast_audio_duratiuon = get_post_meta( $post->ID, 'podcast_duration', true ); 
          $castpress_podcast_audio_duratiuon = substr($castpress_podcast_audio_duratiuon,0,-3);          
        ?>

        <div class="c-single__transcript">
            <h2 class="c-single__transcript__title">
                <?php
                    echo esc_html__('Listening time: ','castpress' );
                    echo esc_html( $castpress_podcast_audio_duratiuon ); // Dynamic number (show episode duration) 
                    echo esc_html__( ' minutes', 'castpress' );
                ?>
            </h2>

            <?php if ( class_exists('ACF') && get_field('transcript') ) { ?>
                <span class="c-single__transcript__sep h2"><?php echo esc_html( " | " ) ?></span> <!-- * Simple seprator -->
                <a class="c-single__transcript__more js-single__transcript__more h2"><?php esc_html_e( 'View transcript', 'castpress' ); ?>
                    <span class="c-single__transcript__icon dashicons dashicons-arrow-right-alt"></span>
                </a>
            <?php } // check Acf fields is exist  ?>

        </div>

        <?php if ( class_exists('ACF') && get_field('transcript') ) { ?>
            <div class="c-single__transcript__content">
                <div class="c-single__transcript__wrapper">
                    <div class="c-single__transcript__context">
                        <div class="c-single__transcript__row">
                            <?php the_field('transcript'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } // check Acf fields is exist  ?>

        <?php             
            endif; // check post type is episodes 

            castpress_get_tags('c-single__tag');  // Show post tags 
        ?>

        <div class="c-social-share c-social-share--single">
            <?php castpress_share_links(); // Get social share Links ?>
        </div><!-- s-single__entry-content -->

        <?php 
            // Get related posts
            if ( 'episodes' !== get_post_type() ){
                get_template_part( 'template-parts/components/related-posts' ); 
            }
        ?>
    </section>

</article><!-- #post-<?php the_ID(); ?> -->