<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package makemeup
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="o-page">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e( 'Skip to content', 'makemeup' ); ?>
        </a>

        <header id="masthead" class="c-header site-header">
            <div class="c-header__main" id="site-navigation">
                <div class="c-header__branding">
                    <?php makemeup_branding(); ?>
                </div><!-- .c-header__branding -->

                <button class="c-header__menu" aria-label="<?php esc_attr_e('Toggle menu', 'makemeup'); ?>"
                    aria-controls="primary-menu" aria-expanded="false">
                </button>

                <nav class="c-header__navigation">
                    <?php
                        if ( has_nav_menu( 'primary-menu' ) ) {
                            wp_nav_menu(
                                array(
                                    'walker'          => new Makemeup_walker_nav_menu(),
                                    'theme_location'  => 'primary-menu',
                                    'menu_id'         => 'primary-menu',
                                    "menu_class"      => "s-nav nav-menu",
                                    "container_class" => "c-nav",
                                )
                            );
                        }
                        ?>
                </nav><!-- #site-navigation -->

                <div class="c-header__search">
                    <a class="c-header__search-icon" aria-label="<?php esc_attr_e('Toggle menu', 'makemeup'); ?>"
                        aria-controls="primary-menu" aria-expanded="false">
                    </a>
                    <div class="c-header__search-form">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </header><!-- #masthead -->