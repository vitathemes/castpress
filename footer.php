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
    <div class="c-footer__content">
        <?php 
        if ( is_active_sidebar( 'custom-footer-widget' ) ) : ?>
        <div id="footer-widget-area" class="c-footer__widgets" role="complementary">

            <?php dynamic_sidebar( 'custom-footer-widget' ); ?>

            <?php //makemeup_render_newsletter(); //qa- ?>

            <?php endif; ?>

        </div>


        <div class="c-footer__site-info">
            <span class="c-footer__context h5--secondary h5-lh--sm font--regular">

                <?php
                        /* translators: %s: Theme creator name by */
                        printf( esc_html__( 'PodcastTheme by', 'makemeup' ), 'makemeup' );
                    ?>

            </span>

            <a class="c-footer__link h5--secondary h5-lh--sm font--regular u-link--tertiary"
                href="<?php echo esc_url( __( 'https://vitathemes.com/', 'makemeup' ) ); ?>">
                <?php 
                        /* translators: %s: Vita themes is the creator of the theme */
                        printf( esc_html__( 'VitaThemes', 'makemeup' ) );
                    ?>
            </a>

            <span class="c-footer__context h5--secondary h5-lh--sm sep u-link--tertiary"> | </span>

            <a class="c-footer__link h5--secondary h5-lh--sm font--regular u-link--tertiary"
                href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
                <?php
                        /* translators: Privacy Policy Link */
                        printf( esc_html__( 'Privacy Policy', 'makemeup' ), 'makemeup');
                    ?>
            </a>
        </div><!-- .site-info -->
        <div class="c-social-share c-social-share--footer">
            <?php makemeup_socials_links(); ?>
        </div>

</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>