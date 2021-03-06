<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package makemeup
 */

?>

<footer id="colophon" class="c-footer">
    <div class="site-info">
        <span class="c-footer__context h5 h5-lh--sm font--regular">
            <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( 'PodcastTheme by', 'makemeup' ), 'WordPress' );
            ?>
        </span>
        <a class="c-footer__link h5 h5-lh--sm font--regular"
            href="<?php echo esc_url( __( 'https://wordpress.org/', 'makemeup' ) ); ?>">
            <?php 
        /* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'VitaThemes', 'makemeup' ) );

        ?>
        </a>
        <span class="c-footer__context h5 h5-lh--sm sep"> | </span>
        <a class="c-footer__link h5 h5-lh--sm font--regular"
            href="<?php echo esc_url( __( 'https://wordpress.org/', 'makemeup' ) ); ?>">
            <?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Privacy Policy', 'makemeup' ), 'makemeup', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
        </a>
    </div><!-- .site-info -->

    <div class="c-social-share">

    </div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>