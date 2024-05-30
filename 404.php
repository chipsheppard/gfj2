<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Good Fortune Jewelry
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<div class="inner-wrap">

					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'good-fortune-jewelry' ); ?></h1>
					</header>

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'good-fortune-jewelry' ); ?></p>
						<div class="error-message">ERROR - ERROR - ERROR</div>

						<?php get_search_form(); ?>

					</div>
				</div>
			</section>
		</main>
	</div>

<?php get_footer(); ?>
