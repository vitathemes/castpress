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

        <?php if ( is_active_sidebar( 'custom-footer-widget' ) ) : ?>

        <div id="footer-widget-area" class="c-footer__widgets" role="complementary">

            <?php dynamic_sidebar( 'custom-footer-widget' );

         endif; ?>

        </div>
        
        <div class="c-footer__copy">

            <div class="c-footer__copy-text">
                <h5 class="c-footer__context u-heading-5-line-height--sm u-font--regular">
                    
                    <?php echo esc_html(get_theme_mod( 'copytext' , esc_html__( 'Castpress Theme by', 'castpress' ) )); ?>

                </h5>

                <h5 class="c-footer__context u-heading-5-line-height--sm u-font--regular">
                    <a class="c-footer__link u-link--tertiary"
                        href="<?php echo esc_url( get_theme_mod( 'copylink', esc_url('http://vitathemes.com/') ) ); ?>">
                     
                        <?php echo esc_html(get_theme_mod( 'copylink_text', esc_html( 'VitaThemes' ) )); ?>

                    </a>
                </h5>
            </div>

            <?php
                if ( has_nav_menu( 'primary-footer' ) ) {
                    wp_nav_menu(
                            array(
                                'theme_location'  => 'primary-footer',
                                'menu_id'         => 'primary-footer',
                                "menu_class"      => "s-footer__nav nav-menu",
                                "container_class" => "c-footer__nav",
                            ));
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