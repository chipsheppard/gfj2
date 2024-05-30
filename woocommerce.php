<?php
/**
 * Template Name: Woocommerce
 *
 * @package Good Fortune Jewelry
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="inner-wrap">

				<?php woocommerce_content(); ?>

			</div>
		</main>
	</div>


<?php get_footer(); ?>
