<?php
/**
 * Template for the content area on the blog page
 *
 * @package Good Fortune Jewelry
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	echo '<a href="' . esc_url( get_permalink() ) . '">';
	the_post_thumbnail(
		'thumbnail',
		array(
			'class' => 'featured-image',
			'title' => 'Feature image',
		)
	);
	echo '</a>';
	?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<?php good_fortune_jewelry_entry_footer(); ?>
	</footer>
</article>
