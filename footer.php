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
        
        <ul class="c-footer__nav">
                <li class="c-footer__nav__item">
                    <h5 class="c-footer__context u-heading-5-line-height--sm h5--secondary">
                        <?php esc_html_e( 'Castpress Theme by ', 'cavatina' ); ?>
                    </h5>
                </li>

                <li class="c-footer__nav__item">
                    <h5 class="c-footer__context u-heading-5-line-height--sm h5--secondary">
                        <a class="c-footer__link u-link--tertiary"
                            href="<?php echo esc_url('https://vitathemes.com/'); ?>">
                            <?php 
                                /* translators: %s: Vita themes is the creator of the theme */
                                printf( esc_html__( 'VitaThemes', 'castpress' ) );
                            ?>
                        </a>
                    </h5>
                </li>

                <?php
                    if ( has_nav_menu( 'primary-footer' ) ) {        
                        wp_nav_menu(
                                array(
                                    'walker'          => new Castpress_walker_nav_footer_menu(),
                                    'theme_location' => 'primary-footer',
                                    'menu_id'        => 'primary-footer-registered',
                                    'container'      => "c-footer__nav",
                                    'items_wrap'     => '%3$s'
                                ));
                    }
                ?>
            </ul>

        <div class="c-social-share c-social-share--footer">
            <?php castpress_socials_links(); ?>
        </div>

</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>