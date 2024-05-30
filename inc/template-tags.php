<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Good Fortune Jewelry
 */

/*
 * ARCHIVE Pagination (<< 1 of 10 >>)
 * -----------------------------------------------------------------
 */
if ( ! function_exists( 'good_fortune_jewelry_paging_nav' ) ) {
	/**
	 * Archive Pagination
	 */
	function good_fortune_jewelry_paging_nav() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( '&laquo; Previous', 'csstarter' ),
				'next_text' => __( 'Next &raquo;', 'csstarter' ),
			)
		);
	}
}
add_action( 'the_archive_navigation', 'good_fortune_jewelry_paging_nav' );


/*
 * POST Navigation (prev - next)
 * -----------------------------------------------------------------
 */
if ( ! function_exists( 'good_fortune_jewelry_post_nav' ) ) {
	/**
	 * Post Navigation (prev - next)
	 */
	function good_fortune_jewelry_post_nav() {
		the_post_navigation(
			array(
				'prev_text' => __( '<span>previous</span> %title', 'csstarter' ),
				'next_text' => __( '<span>next</span> %title', 'csstarter' ),
			)
		);
	}
}
add_action( 'the_post_navigation', 'good_fortune_jewelry_post_nav' );


if ( ! function_exists( 'good_fortune_jewelry_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function good_fortune_jewelry_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: publish date */
			_x( 'Posted on %s', 'post date', 'good-fortune-jewelry' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: author's name */
			_x( 'by %s', 'post author', 'good-fortune-jewelry' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	}
endif;

if ( ! function_exists( 'good_fortune_jewelry_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function good_fortune_jewelry_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'good-fortune-jewelry' ) );
			if ( $categories_list && good_fortune_jewelry_categorized_blog() ) {
				printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'good-fortune-jewelry' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'good-fortune-jewelry' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'good-fortune-jewelry' ) . '</span>', $tags_list );
			}
		}
	}
endif;


/**
 * WordPress Cleanup
 *
 * ARCHIVE TITLE
 * puts a div around prefix or deletes it.
 *
 * @param string $title The title.
 */
function gfj_archive_title_wrap( $title ) {
	if ( is_category() ) {
		/* translators: category name */
		$title = sprintf( __( 'Category: <span>%s</span>', 'good-fortune-jewelry' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		/* translators: tag name */
		$title = sprintf( __( 'Tag: <span>%s</span>', 'good-fortune-jewelry' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = __( 'written by: <span class="vcard">', 'good-fortune-jewelry' ) . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'archive by year: <span>', 'good-fortune-jewelry' ) . get_the_date( 'Y' ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'archive by month: <span>', 'good-fortune-jewelry' ) . get_the_date( 'F Y' ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'archive by day: <span>', 'good-fortune-jewelry' ) . get_the_date( 'F j, Y' ) . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = get_the_title( get_option( 'page_for_posts', true ) );
	} else {
		$title = __( 'Archives', 'good-fortune-jewelry' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'gfj_archive_title_wrap' );


/**
 * EXCERPT LENGTH FILTER - to 16 words.
 *
 * @param int $length Excerpt length.
 * @return int modified excerpt length.
 */
function gfj_custom_excerpt_length( $length ) {
	if ( is_admin() ) :
		return $length;
	else :
		return 16;
	endif;
}
add_filter( 'excerpt_length', 'gfj_custom_excerpt_length', 999 );


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function good_fortune_jewelry_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'good_fortune_jewelry_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'good_fortune_jewelry_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so good_fortune_jewelry_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so good_fortune_jewelry_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in good_fortune_jewelry_categorized_blog.
 */
function good_fortune_jewelry_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'good_fortune_jewelry_categories' );
}
add_action( 'edit_category', 'good_fortune_jewelry_category_transient_flusher' );
add_action( 'save_post', 'good_fortune_jewelry_category_transient_flusher' );
