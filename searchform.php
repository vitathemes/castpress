<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_e( 'Search for:', 'makemeup' ) ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr( 'Search…', 'makemeup' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr( 'Search for:', 'makemeup' ) ?>" />
    </label>
    <button aria-label="<?php esc_attr_e('Search', 'makemeup'); ?>" type="submit"
        class="c-search-form__submit search-submit btn--sm">

    </button>
</form>