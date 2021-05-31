<?php
class Castpress_walker_nav_footer_menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;


		$output .= "<li class='c-footer__nav__item c-footer__nav__item--dynamic" . implode( " ", $item->classes ) . "'>";

		//Add SPAN if no Permalink
		if ( $permalink ) {
			$output .= '<h5 class="c-footer__context u-heading-5-line-height--sm h5--secondary" ><a class="c-footer__link u-link--tertiary" href="' . esc_url($permalink) . '">';
		}
		$output .= $title;
		if ( $permalink ) {
			$output .= '</a></h5>';
		}
	
	}
}