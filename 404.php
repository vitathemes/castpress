<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package makemeup
 */

get_header();
?>

<main id="primary" class="c-main">

    <section class="c-main__error c-main__error--error error-404 not-found">
        <header class="c-main__page-header">
            <h1 class="c-main__page-title"><?php esc_html_e( '404', 'makemeup' ); ?></h1>
        </header><!-- .page-header -->

        <div class="c-main__page-content">
            <h1 class="c-main__desc h1-lh--sm">
                <?php esc_html_e( 'Page not found!', 'makemeup' ); ?>
            </h1>

            <a href=<?php echo esc_url( home_url() ); ?>>
                <button class="h5">
                    HOMEPAGE<span class="c-main__button-arrow dashicons dashicons-arrow-right-alt2"></span>
                </button>
            </a>
        </div><!-- .page-content -->



    </section><!-- .error-404 -->
</main><!-- #main -->

<?php
get_footer();