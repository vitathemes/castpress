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
		the_title( '<h1 class="c-single__title c-main__entry-title"><a class="a--secondary h1 h1-lh--bg" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
        ?>
        <div class="c-single__entry-meta">
            <?php 
				if ( 'episodes' == get_post_type() ){
					makemeup_get_category();
					echo " <span class='seprator h5 a--secondary'> | </span> ";					

				}	
			?>

            <span class="c-post__date h5 h5-lh--sm font--semibold posted-on">
                <?php echo esc_html( get_the_date( "M d, Y" ) ) ?>
            </span>

            <span class="seprator h5 a--secondary"> | </span>
            <?php makemeup_posted_by( true ); ?>
            <?php 
			if ( 'episodes' == get_post_type() ){
		
				echo "<div class='c-episode__player'>";
				echo do_shortcode('[audio mp3="https://chtbl.com/track/G2F3EG/api.spreaker.com/download/episode/16457419/suspicion_ep_10_the_final_verdict.mp3" ][/audio]');
				echo "</div>";
			}	
			?>


        </div><!-- .entry-meta -->

        <?php 
		if ( 'episodes' == get_post_type() ){
            
			echo '<div class="c-episodes__share"> <span class="c-episode__social-share__title font--semibold">Listen on</span>';
			echo '<a href="#"><svg class="c-episodes__social-share__icons icon--sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"><path d="M16 0C7.197 0 0 7.197 0 16s7.197 16 16 16s16-7.197 16-16S24.88 0 16 0zm7.36 23.12c-.319.479-.881.64-1.36.317c-3.76-2.317-8.479-2.797-14.083-1.52c-.557.165-1.037-.235-1.199-.72c-.156-.557.24-1.036.719-1.197c6.084-1.36 11.365-.803 15.521 1.76c.563.24.64.88.401 1.36zm1.921-4.401c-.401.563-1.12.803-1.683.401c-4.317-2.641-10.88-3.437-15.916-1.839c-.641.156-1.365-.161-1.521-.803c-.161-.64.156-1.359.797-1.52c5.844-1.761 13.041-.876 18 2.161c.484.24.724 1.041.323 1.599zm.162-4.479c-5.125-3.043-13.683-3.36-18.563-1.839c-.801.239-1.599-.24-1.839-.964c-.239-.797.24-1.599.959-1.839c5.683-1.681 15.041-1.359 20.964 2.161c.719.401.957 1.36.557 2.079c-.401.563-1.36.801-2.079.401z" fill="#222222"/><rect x="0" y="0" width="32" height="32" fill="rgba(0, 0, 0, 0)" /></svg></a>';
			echo '<a href="#"><svg class="c-episodes__social-share__icons icon--bg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1024" height="622" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 622" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"><path d="M864 576H512V49Q567 0 640 0q80 0 136 56t56 136q0 37-14 71q25-7 46-7q66 0 113 47t47 113t-47 113t-113 47zm-416 0h-64V132q35 7 64 29v415zM256 161q28-22 64-29v444h-64V161zM128 573V259q16-3 32-3q15 0 32 4v316h-32q-16 0-32-3zM64 289v254q-30-22-47-55.5T0 416t17-71.5T64 289z" fill="#222222"/><rect x="0" y="0" width="1024" height="622" fill="rgba(0, 0, 0, 0)" /></svg></a>';
			echo '<a href="#"><svg class="c-episodes__social-share__icons icon--md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1024" height="1024" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"><path d="M747.4 535.7c-.4-68.2 30.5-119.6 92.9-157.5c-34.9-50-87.7-77.5-157.3-82.8c-65.9-5.2-138 38.4-164.4 38.4c-27.9 0-91.7-36.6-141.9-36.6C273.1 298.8 163 379.8 163 544.6c0 48.7 8.9 99 26.7 150.8c23.8 68.2 109.6 235.3 199.1 232.6c46.8-1.1 79.9-33.2 140.8-33.2c59.1 0 89.7 33.2 141.9 33.2c90.3-1.3 167.9-153.2 190.5-221.6c-121.1-57.1-114.6-167.2-114.6-170.7zm-105.1-305c50.7-60.2 46.1-115 44.6-134.7c-44.8 2.6-96.6 30.5-126.1 64.8c-32.5 36.8-51.6 82.3-47.5 133.6c48.4 3.7 92.6-21.2 129-63.7z" fill="#222222"/><rect x="0" y="0" width="1024" height="1024" fill="rgba(0, 0, 0, 0)" /></svg></a>';        
			echo '</div>';	

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

        <?php if ( 'episodes' == get_post_type() ) { ?>
        <div class="c-single__transcript">

            <h2 class="c-single__transcript__title">Listening time: 86 minutes </h2>
            <span class="h2">|</span>
            <a class="c-single__transcript__more js-single__transcript__more">View transcript</a>
            <span class="dashicons dashicons-arrow-right-alt2"></span>

        </div>

        <div class="c-single__transcript__content">

            <div class="c-single__transcript__wrapper">

                <div class="c-single__transcript__context">
                    <div class="c-single__transcript__col">
                        <h3 class="font--semibold">Per Axbom</h3>
                        <p>Hello, I’m Per Axbom.</p>
                        <h3 class="font--semibold">James Royal-Lawson</h3>
                        <p>And I’m James Royal-Lawson.</p>
                    </div>

                    <div class="c-single__transcript__col">
                        <h3 class="font--semibold">Per Axbom</h3>
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

        <?php
			// Show post tags 
			echo "<div class='c-spacer--md qa-'></div>";
			makemeup_get_tags();
		?>

        <div class="c-single__social-media">

            <span class="c-social-media__title h4 h4-lh--sm">Share:</span>

            <a href="#" class="c-social-media__item">
                <span class="dashicons dashicons-facebook-alt"></span>
            </a>

            <a href="#" class="c-social-media__item c-social-media__item--github">
                <svg width="14pt" height="14pt" viewBox="0 0 14 14" version="1.1">
                    <g id="surface1">
                        <path class="c-social-media__icon" style=" stroke:none;fill-rule:nonzero;fill-opacity:1;"
                            d="M 13.046875 3.652344 C 12.421875 2.582031 11.574219 1.734375 10.503906 1.109375 C 9.429688 0.484375 8.261719 0.171875 6.992188 0.171875 C 5.722656 0.171875 4.554688 0.484375 3.484375 1.109375 C 2.410156 1.734375 1.5625 2.582031 0.9375 3.652344 C 0.3125 4.726562 0 5.894531 0 7.164062 C 0 8.6875 0.445312 10.058594 1.332031 11.273438 C 2.222656 12.492188 3.371094 13.332031 4.78125 13.800781 C 4.945312 13.832031 5.066406 13.808594 5.144531 13.738281 C 5.222656 13.664062 5.261719 13.574219 5.261719 13.464844 C 5.261719 13.445312 5.261719 13.28125 5.257812 12.972656 C 5.253906 12.664062 5.253906 12.394531 5.253906 12.164062 L 5.042969 12.199219 C 4.910156 12.222656 4.742188 12.234375 4.539062 12.230469 C 4.335938 12.226562 4.125 12.207031 3.90625 12.167969 C 3.6875 12.128906 3.484375 12.035156 3.296875 11.894531 C 3.109375 11.75 2.972656 11.566406 2.894531 11.335938 L 2.804688 11.125 C 2.742188 10.984375 2.648438 10.832031 2.515625 10.660156 C 2.386719 10.492188 2.253906 10.375 2.121094 10.3125 L 2.058594 10.269531 C 2.015625 10.238281 1.976562 10.203125 1.9375 10.160156 C 1.902344 10.117188 1.875 10.074219 1.855469 10.03125 C 1.839844 9.988281 1.855469 9.953125 1.902344 9.925781 C 1.953125 9.898438 2.039062 9.886719 2.167969 9.886719 L 2.347656 9.914062 C 2.46875 9.9375 2.621094 10.011719 2.800781 10.132812 C 2.980469 10.253906 3.125 10.410156 3.242188 10.605469 C 3.382812 10.855469 3.550781 11.042969 3.746094 11.175781 C 3.945312 11.304688 4.144531 11.371094 4.34375 11.371094 C 4.542969 11.371094 4.714844 11.355469 4.863281 11.324219 C 5.007812 11.292969 5.144531 11.25 5.273438 11.1875 C 5.328125 10.78125 5.476562 10.46875 5.71875 10.25 C 5.371094 10.214844 5.0625 10.160156 4.785156 10.085938 C 4.507812 10.011719 4.222656 9.894531 3.929688 9.730469 C 3.632812 9.566406 3.390625 9.363281 3.195312 9.121094 C 3 8.878906 2.84375 8.558594 2.71875 8.164062 C 2.59375 7.769531 2.53125 7.316406 2.53125 6.800781 C 2.53125 6.066406 2.769531 5.441406 3.25 4.921875 C 3.027344 4.371094 3.046875 3.753906 3.3125 3.066406 C 3.488281 3.011719 3.75 3.050781 4.097656 3.1875 C 4.441406 3.324219 4.695312 3.441406 4.859375 3.539062 C 5.019531 3.636719 5.148438 3.71875 5.246094 3.785156 C 5.808594 3.628906 6.390625 3.550781 6.992188 3.550781 C 7.59375 3.550781 8.175781 3.628906 8.742188 3.785156 L 9.085938 3.566406 C 9.324219 3.421875 9.601562 3.289062 9.925781 3.167969 C 10.246094 3.046875 10.492188 3.011719 10.664062 3.066406 C 10.933594 3.753906 10.960938 4.371094 10.734375 4.921875 C 11.214844 5.441406 11.453125 6.066406 11.453125 6.800781 C 11.453125 7.316406 11.390625 7.773438 11.269531 8.167969 C 11.144531 8.566406 10.984375 8.886719 10.785156 9.125 C 10.589844 9.367188 10.34375 9.566406 10.046875 9.730469 C 9.753906 9.894531 9.46875 10.011719 9.191406 10.085938 C 8.914062 10.160156 8.605469 10.214844 8.257812 10.25 C 8.574219 10.523438 8.730469 10.953125 8.730469 11.542969 L 8.730469 13.464844 C 8.730469 13.574219 8.769531 13.664062 8.847656 13.738281 C 8.921875 13.808594 9.042969 13.832031 9.207031 13.800781 C 10.613281 13.332031 11.761719 12.492188 12.652344 11.273438 C 13.539062 10.058594 13.984375 8.6875 13.984375 7.164062 C 13.984375 5.894531 13.671875 4.726562 13.046875 3.652344 Z M 13.046875 3.652344 " />
                    </g>
                </svg>
            </a>

            <a href="#" class="c-social-media__item">
                <span class="c-social-media__icon dashicons dashicons-twitter"></span>
            </a>

        </div>



    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->