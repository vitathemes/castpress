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
               if($isMetaActive === true){
                    if ( 'episodes' == get_post_type() ){
                        makemeup_get_category();
                        echo " <span class='h5 a--secondary'> | </span> ";
                    }	 
                    makemeup_posted_on( true , true );
                    echo '<span class="h5 a--secondary"> | </span>';
                    makemeup_posted_by( true );
                } 
                
                if ( 'episodes' == get_post_type() ){
                    echo "<div class='c-episode__player'>";
                    echo do_shortcode('[audio mp3="https://chtbl.com/track/G2F3EG/api.spreaker.com/download/episode/16457419/suspicion_ep_10_the_final_verdict.mp3" ][/audio]');
                    echo "</div>";
                }	
			?>

        </div><!-- .entry-meta -->

        <?php 
		if ( 'episodes' == get_post_type() ){
			
			echo '<div class="c-episodes__share"><span class="c-episode__social-share__title font--semibold">Listen on</span>';
			echo '<a href="#"><svg class="c-episodes__social-share__icons icon--sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"><path d="M16 0C7.197 0 0 7.197 0 16s7.197 16 16 16s16-7.197 16-16S24.88 0 16 0zm7.36 23.12c-.319.479-.881.64-1.36.317c-3.76-2.317-8.479-2.797-14.083-1.52c-.557.165-1.037-.235-1.199-.72c-.156-.557.24-1.036.719-1.197c6.084-1.36 11.365-.803 15.521 1.76c.563.24.64.88.401 1.36zm1.921-4.401c-.401.563-1.12.803-1.683.401c-4.317-2.641-10.88-3.437-15.916-1.839c-.641.156-1.365-.161-1.521-.803c-.161-.64.156-1.359.797-1.52c5.844-1.761 13.041-.876 18 2.161c.484.24.724 1.041.323 1.599zm.162-4.479c-5.125-3.043-13.683-3.36-18.563-1.839c-.801.239-1.599-.24-1.839-.964c-.239-.797.24-1.599.959-1.839c5.683-1.681 15.041-1.359 20.964 2.161c.719.401.957 1.36.557 2.079c-.401.563-1.36.801-2.079.401z" fill="#222222"/><rect x="0" y="0" width="32" height="32" fill="rgba(0, 0, 0, 0)" /></svg></a>';
			echo '<a href="#"><svg class="c-episodes__social-share__icons icon--bg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1024" height="622" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 622" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"><path d="M864 576H512V49Q567 0 640 0q80 0 136 56t56 136q0 37-14 71q25-7 46-7q66 0 113 47t47 113t-47 113t-113 47zm-416 0h-64V132q35 7 64 29v415zM256 161q28-22 64-29v444h-64V161zM128 573V259q16-3 32-3q15 0 32 4v316h-32q-16 0-32-3zM64 289v254q-30-22-47-55.5T0 416t17-71.5T64 289z" fill="#222222"/><rect x="0" y="0" width="1024" height="622" fill="rgba(0, 0, 0, 0)" /></svg></a>';
			echo '<a href="#"><svg class="c-episodes__social-share__icons icon--md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1024" height="1024" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"><path d="M747.4 535.7c-.4-68.2 30.5-119.6 92.9-157.5c-34.9-50-87.7-77.5-157.3-82.8c-65.9-5.2-138 38.4-164.4 38.4c-27.9 0-91.7-36.6-141.9-36.6C273.1 298.8 163 379.8 163 544.6c0 48.7 8.9 99 26.7 150.8c23.8 68.2 109.6 235.3 199.1 232.6c46.8-1.1 79.9-33.2 140.8-33.2c59.1 0 89.7 33.2 141.9 33.2c90.3-1.3 167.9-153.2 190.5-221.6c-121.1-57.1-114.6-167.2-114.6-170.7zm-105.1-305c50.7-60.2 46.1-115 44.6-134.7c-44.8 2.6-96.6 30.5-126.1 64.8c-32.5 36.8-51.6 82.3-47.5 133.6c48.4 3.7 92.6-21.2 129-63.7z" fill="#222222"/><rect x="0" y="0" width="1024" height="1024" fill="rgba(0, 0, 0, 0)" /></svg></a></div>';        
			
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

		// Show post tags 
		echo "<div class='c-spacer--md -qa'></div>";
		makemeup_get_tags();

		?>

    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->