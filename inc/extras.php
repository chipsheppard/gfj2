<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Good Fortune Jewelry
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function good_fortune_jewelry_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'good_fortune_jewelry_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function good_fortune_jewelry_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'good_fortune_jewelry_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function good_fortune_jewelry_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		/* translators: Page */
		$title .= " $sep " . sprintf( __( 'Page %s', 'good-fortune-jewelry' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'good_fortune_jewelry_wp_title', 10, 2 );


/**
 * Hide Out-of-Stock products from Search.
 *
 * @link  https://quadlayers.com/hide-out-of-stock-products-woocommerce/
 * @param Object $query the query object.
function good_fortune_jewelry_hide_out_of_stock_in_search( $query ) {
	if ( $query->is_search() && $query->is_main_query() ) {
		$query->set( 'meta_key', '_stock_status' );
		$query->set( 'meta_value', 'instock' );
	}
}
add_action( 'pre_get_posts', 'good_fortune_jewelry_hide_out_of_stock_in_search' );
 */


/**
 * Default number of product columns.
 */
if ( ! function_exists( 'loop_columns' ) ) {
	/**
	 * Change number or products per row to 3
	 */
	function loop_columns() {
		return 4; // products per row.
	}
}
add_filter( 'loop_shop_columns', 'loop_columns' );


/**
 * Woo Sub-category terms
 *
 * @param array $terms the terms.
 * @param array $taxonomies the taxonomies.
 * @param array $args the args.
 */
function get_subcategory_terms( $terms, $taxonomies, $args ) {

	$new_terms = array();

	// if a product category and on the shop page.
	if ( in_array( 'product_cat', $taxonomies, true ) && ! is_admin() && is_shop() ) {

		foreach ( $terms as $key => $term ) {
			if ( ! in_array( $term->slug, array( 'collections' ), true ) ) {
				$new_terms[] = $term;
			}
		}
		$terms = $new_terms;
	}
	return $terms;
}
add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );


/**
 * Add stuff under the Add To Cart button
 *
 * @link https://rudrastyh.com/woocommerce/before-and-after-add-to-cart.html
 */
function misha_after_add_to_cart_btn() {
	echo '<div class="custom-under-atc">';
	echo '<a href="/returns-refunds/">Free Shipping and Free Returns &rarr;</a>';
	echo '</div>';
}
add_action( 'woocommerce_after_add_to_cart_button', 'misha_after_add_to_cart_btn' );


/**
 * Remove the product count on category lists
 *
 * @link https://www.businessbloomer.com/woocommerce-categories/
 */
add_filter( 'woocommerce_subcategory_count_html', '__return_null' );
