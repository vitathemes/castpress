<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package castpress
 */

?>
<footer id="colophon" class="c-footer">
    <div class="c-footer__content">
        <?php 
        if ( is_active_sidebar( 'custom-footer-widget' ) ) : ?>
        <div id="footer-widget-area" class="c-footer__widgets" role="complementary">

            <?php dynamic_sidebar( 'custom-footer-widget' ); ?>

            <?php //castpress_render_newsletter(); //qa- ?>

            <?php endif; ?>

        </div>


        <div class="c-footer__site-info">
            <h5 class="c-footer__context u-font--regular  u-heading-5-line-height--sm u-font--regular">

                <?php
                        /* translators: %s: Theme creator name by */
                        printf( esc_html__( 'PodcastTheme by', 'castpress' ), 'castpress' );
                    ?>

            </h5>

            <h5 class="c-footer__context u-heading-5-line-height--sm u-font--regular u-font--regular">
                <a class="c-footer__link u-link--tertiary"
                    href="<?php echo esc_url( __( 'https://vitathemes.com/', 'castpress' ) ); ?>">
                    <?php 
                            /* translators: %s: Vita themes is the creator of the theme */
                            printf( esc_html__( 'VitaThemes', 'castpress' ) );
                        ?>
                </a>
            </h5>

            <h5 class="c-footer__context u-font--regular u-heading-5-line-height--sm sep u-link--tertiary"> | </h5>

            <h5 class="c-footer__context u-heading-5-line-height--sm u-font--regular u-font--regular">
                <a class="c-footer__link u-link--tertiary"
                    href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
                    <?php
                            /* translators: Privacy Policy Link */
                            printf( esc_html__( 'Privacy Policy', 'castpress' ), 'castpress');
                        ?>
                </a>
            </h5>
        </div><!-- .site-info -->
        <div class="c-social-share c-social-share--footer">
            <?php castpress_socials_links(); ?>
        </div>

</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>