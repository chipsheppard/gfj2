<?php
/**
 * Template Name: One Sidebar
 *
 * @package Good Fortune Jewelry
 */

?>

<?php get_header(); ?>
	<div class="inner-wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
				?>

			</main>
		</div>

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
