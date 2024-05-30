<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php good_fortune_jewelry_posted_on(); ?>
		</div>
		<?php endif; ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<!--footer class="entry-footer">
		<?php // good _ fortune_jewelry_entry_footer();. ?>
	</footer-->
</article>
