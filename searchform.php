<?php
/**
 * Display Search Form 
 *
 * @package castpress
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_e( 'Search for:', 'castpress' ) ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search…', 'castpress' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr__( 'Search for:', 'castpress' ) ?>" />
    </label>
    <button aria-label="<?php esc_attr_e('Search', 'castpress'); ?>" type="submit" class="c-search-form__submit search-submit c-btn--sm">
    </button>
</form>