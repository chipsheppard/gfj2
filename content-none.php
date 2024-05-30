<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Good Fortune Jewelry
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'good-fortune-jewelry' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
			<?php
			/* translators: %1$s is the post URL */
			printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'good-fortune-jewelry' ), esc_url( admin_url( 'post-new.php' ) ) );
			?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'good-fortune-jewelry' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'good-fortune-jewelry' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
