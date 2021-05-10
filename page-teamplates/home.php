<?php 
/**
 * 
 * Template Name: Home
 * 
 * The main template file for home page
 *
 * If this page doesn't exists index.php will show ( recommended for using as home page )
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); 
?>

<main id="primary" class="c-main c-main--home">

    <div class="c-main__content">
        <?php castpress_home_components(); ?>
    </div>

</main><!-- #main -->

<?php
get_footer();