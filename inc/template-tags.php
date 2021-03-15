<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package makemeup
 */

if ( ! function_exists( 'makemeup_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function makemeup_posted_on( $is_bold = false , $link_class = " " ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		if( $is_bold ) {
			$is_bold = "font--semibold";
		} else {
			$is_bold = "font--regular";
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html( '%s', 'makemeup' ),
			'<a class="a--tertiary" href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="c-post__date h5 h5-lh--sm '. esc_html($is_bold) .' posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'makemeup_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function makemeup_posted_by( $is_bold = false) {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'makemeup' ),
			'<span class="author vcard h5 h5-lh--sm"><a class="url fn n c-post__author__link a--tertiary" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		if( $is_bold ){
			$is_bold = "font--semibold";
		}else{
			$is_bold = "font--regular";
		}

		echo '<span class="byline h5 h5-lh--sm c-post__author '. esc_html($is_bold) .'"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'makemeup_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function makemeup_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'makemeup' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'makemeup' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'makemeup' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'makemeup' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'makemeup' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'makemeup' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'makemeup_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function makemeup_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

<div class="post-thumbnail">
    <?php the_post_thumbnail(); ?>
</div><!-- .post-thumbnail -->

<?php else : ?>

<?php 

	if ( has_post_thumbnail() ) {
		
	?>

<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
    <?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
</a>
<?php 
	}
	else {
		echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
	}
?>
<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/* qa- */
if (! function_exists('makemeup_get_page_name')) :
	/**
	 * get current page name (slug)
	 */
	function makemeup_get_page_name() {

		global $post;
		$post_slug = $post->post_name;
		$post_slug = str_replace("-", " ", $post_slug);
		echo esc_html(esc_html($post_slug));
		
	}
endif;


if (! function_exists('makemeup_archive_page_name')) :
	/**
	 * get archive page name
	 */
	function makemeup_archive_page_name() {
		if ( !is_front_page() && is_home() ) {
			echo "blog";
		}

		if( is_archive() ){
			echo "archives";
		}

	}
endif;


if (! function_exists('makemeup_get_thumbnail')) :
	/**
	 * Return thumbnail if exist
	 */
	function makemeup_get_thumbnail() {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		else{
			echo '<img src="' . esc_url(get_bloginfo( 'stylesheet_directory' )). '/assets/images/no-thumbnail.png" />';
		}
}
endif;


if (! function_exists('makemeup_get_tags')) :
	/**
	 * Return Post tags
	 */
	function makemeup_get_tags() {
	
		$post_tags = get_the_tags();
		if ($post_tags) {
			foreach($post_tags as $post_tag) {
				echo '<a class="c-post__tags h4" href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">#'. esc_html( $post_tag->name ). '</a>';
			}
		}
	}
endif;






if (! function_exists('makemeup_get_category')) :
	/**
	 * Return Post category
	 */
	function makemeup_get_category() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'makemeup' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */

			echo '<span class="c-episode__category h5 h5-lh--sm">' .$categories_list. '</span>';
		}
	}
endif;



if (! function_exists('makemeup_get_category_seperator')) :
	/**
	 * Return Post category
	 */
	function makemeup_get_category_seperator() {
		

		if( ! empty( get_the_category() ) ){
			/* get category */
			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			$category_counter = 0;
			if ( ! empty( $categories ) ) {
			
				foreach( $categories as $category ) {

					if( $isLimited === true && $category_counter === 3){
						break;
					}

					$category_counter++;
					/* translators: used between list items, there is a space after the comma */
					$output .= '<a class="c-post__meta__link" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo  wp_kses_post(trim( $output, $separator ));
			}
		}
	}
endif;



if (! function_exists('makemeup_get_default_pagination')) :
	/**
	* Show numeric pagination
	*/
	function makemeup_get_default_pagination() {
		echo'  <div class="c-pagination">' . wp_kses_post(
			paginate_links(
				array(
				'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
				'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
				)
			)) .'</div>';
	}
endif;


if (! function_exists('makemeup_get_featured_episode')) :
	/**
	  * Get Featured Episode
	  */
	function makemeup_get_featured_episode( $isMetaActive = false ) {
		$args = array(
			'posts_per_page' => 1, 
			'offset' => 0,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'episodes', 
			'post_status' => 'publish'
		);
		$query = new WP_Query($args);
		if ($query->have_posts()) :
			$isMetaActive = $isMetaActive; 
			while ($query->have_posts()) : $query->the_post();			
			include( locate_template( 'template-parts/components/latest-episode.php', false, false ) ); 
			endwhile;
		endif;
	}
endif;