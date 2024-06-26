<?php
/**
 * The template for displaying all single posts.
 *
 * @package Good Fortune Jewelry
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="inner-wrap">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'content', 'single' );

				good_fortune_jewelry_post_nav();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>
		</div>
	</main>
</div>

<?php get_footer(); ?>
