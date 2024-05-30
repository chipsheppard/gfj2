<?php
/**
 * The template for displaying search results pages.
 *
 * @package Good Fortune Jewelry
 */

get_header(); ?>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="inner-wrap">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: Search Term */
						printf( esc_html__( 'Search Results for: %s', 'good-fortune-jewelry' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header>

				<div class="flex-wrap">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'content', 'search' );
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
</section>

<?php get_footer(); ?>
