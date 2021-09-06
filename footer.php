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

        <?php if ( is_active_sidebar( 'custom-footer-widget-left' ) ) : ?>
        <div id="footer-widget-area" class="c-footer__widgets c-footer__widgets--left" role="complementary">
            <?php dynamic_sidebar( 'custom-footer-widget-left' ); ?>
        </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'custom-footer-widget-right' ) ) : ?>
        <div id="footer-second-widget-area" class="c-footer__widgets c-footer__widgets--right" role="complementary">
            <?php dynamic_sidebar( 'custom-footer-widget-right' ); ?>
        </div>
        <?php endif; ?>
        
        <div class="c-footer__copy">

            <div class="c-footer__copy-text">
                <h5 class="c-footer__context u-font--regular">
                    <?php echo esc_html__( 'Castpress Theme by', 'castpress' ) ?>
                </h5>

                <h5 class="c-footer__context u-font--regular">
                    <a class="c-footer__link u-link--tertiary" href="<?php echo esc_url('http://vitathemes.com/'); ?>">
                        <?php echo esc_html__( 'VitaThemes', 'castpress' ) ?>
                    </a>
                </h5>
            </div>

            <?php
                if ( has_nav_menu( 'primary-footer' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary-footer',
                            'menu_id'         => 'primary-footer',
                            'menu_class'      => 's-footer__nav nav-menu',
                            'container_class' => 'c-footer__nav',
                        )
                    );
                }
            ?>
    
        </div>

        <div class="c-social-share c-social-share--footer">
            <?php castpress_socials_links(); ?>
        </div>
    </div>

</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>