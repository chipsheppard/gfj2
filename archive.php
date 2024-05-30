<?php
/**
 * The template for displaying archive pages.
 *
 * @package Good Fortune Jewelry
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="inner-wrap">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header>
					<div class="flex-wrap">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'content', get_post_format() );
						endwhile;
						?>
					</div>
					<?php
					good_fortune_jewelry_paging_nav();

				else :

					get_template_part( 'content', 'none' );

				endif;
				?>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
