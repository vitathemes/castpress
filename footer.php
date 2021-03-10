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


        </div>


        <?php endif; ?>

        <div class="c-footer__site-info">
            <span class="c-footer__context h5 h5-lh--sm font--regular">
                <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( 'PodcastTheme by', 'makemeup' ), 'WordPress' );
            ?>
            </span>
            <a class="c-footer__link h5 h5-lh--sm font--regular"
                href="<?php echo esc_url( __( 'https://vitathemes.com/', 'makemeup' ) ); ?>">
                <?php 
            /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'VitaThemes', 'makemeup' ) );
            ?>
            </a>
            <span class="c-footer__context h5 h5-lh--sm sep"> | </span>
            <a class="c-footer__link h5 h5-lh--sm font--regular"
                href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
                <?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Privacy Policy', 'makemeup' ), 'makemeup', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
            </a>
        </div><!-- .site-info -->

        <div class="c-social-share">
            <div class="c-social-media__item">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                    height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"
                    style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);">
                    <path
                        d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"
                        fill="#000000" />
                    <rect x="0" y="0" width="24" height="24" fill="rgba(0, 0, 0, 0)" />
                </svg>

            </div>
            <div class="c-social-media__item">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                    height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"
                    style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974c0 4.406 2.857 8.145 6.821 9.465c.499.09.679-.217.679-.481c0-.237-.008-.865-.011-1.696c-2.775.602-3.361-1.338-3.361-1.338c-.452-1.152-1.107-1.459-1.107-1.459c-.905-.619.069-.605.069-.605c1.002.07 1.527 1.028 1.527 1.028c.89 1.524 2.336 1.084 2.902.829c.091-.645.351-1.085.635-1.334c-2.214-.251-4.542-1.107-4.542-4.93c0-1.087.389-1.979 1.024-2.675c-.101-.253-.446-1.268.099-2.64c0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336a9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021c.545 1.372.203 2.387.099 2.64c.64.696 1.024 1.587 1.024 2.675c0 3.833-2.33 4.675-4.552 4.922c.355.308.675.916.675 1.846c0 1.334-.012 2.41-.012 2.737c0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974C22 6.465 17.535 2 12.026 2z"
                        fill="#000000" />
                    <rect x="0" y="0" width="24" height="24" fill="rgba(0, 0, 0, 0)" />
                </svg>

            </div>
            <div class="c-social-media__item">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                    height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"
                    style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);">
                    <path
                        d="M19.633 7.997c.013.175.013.349.013.523c0 5.325-4.053 11.461-11.46 11.461c-2.282 0-4.402-.661-6.186-1.809c.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721a4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062c.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973a4.02 4.02 0 0 1-1.771 2.22a8.073 8.073 0 0 0 2.319-.624a8.645 8.645 0 0 1-2.019 2.083z"
                        fill="#000000" />
                    <rect x="0" y="0" width="24" height="24" fill="rgba(0, 0, 0, 0)" />
                </svg>

            </div>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>