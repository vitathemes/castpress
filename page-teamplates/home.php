<?php
/**
 *  Template Name: Home
 * 
 */

get_header();
?>

<main id="primary" class="c-main c-main--home">

    <div class="c-main__content">
        <?php makemeup_home_components(); ?>
        <?php //get_template_part( 'template-parts/components/latest-episode/latest', 'episodes-column'); ?>
    </div>

</main><!-- #main -->

<?php
get_footer();