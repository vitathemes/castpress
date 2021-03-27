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

            <div class="c-footer__widget">
                <h2 class="c-footer__widget__title">NEWSLETTER</h2>
                <p class="c-footer__widget__desc span">Sign up now; get closer to our action.</p>

                <div class="tnp tnp-widget">
                    <form method="post" action="//localhost:3000/?na=s">

                        <input type="hidden" name="nr" value="widget" />
                        <input type="hidden" name="nlang" value="" />

                        <div class="tnp-field tnp-field-email">
                            <label for="tnp-email"></label>
                            <input class="c-tnp-email" type="email" name="ne" value="" required=""
                                placeholder="Email  address..." />
                        </div>

                        <button aria-label="Search" type="submit" class="c-footer__newsletter-submit">
                        </button>

                    </form>
                </div>

            </div>

        </div>
        <?php endif; ?>

        <div class="c-footer__site-info">
            <span class="c-footer__context h5--secondary h5-lh--sm font--regular">
                <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( 'PodcastTheme by', 'makemeup' ), 'WordPress' );
            ?>
            </span>
            <a class="c-footer__link h5--secondary h5-lh--sm font--regular a--tertiary"
                href="<?php echo esc_url( __( 'https://vitathemes.com/', 'makemeup' ) ); ?>">
                <?php 
            /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'VitaThemes', 'makemeup' ) );
            ?>
            </a>
            <span class="c-footer__context h5--secondary h5-lh--sm sep a--tertiary"> | </span>
            <a class="c-footer__link h5--secondary h5-lh--sm font--regular a--tertiary"
                href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
                <?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Privacy Policy', 'makemeup' ), 'makemeup');
				?>
            </a>
        </div><!-- .site-info -->

        <div class="c-social-share c-social-share--footer">

            <?php makemeup_socials_links(); ?>

        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>