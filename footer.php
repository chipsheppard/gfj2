<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Good Fortune Jewelry
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner-wrap">

			<div class="flex-wrap foot-row1">

					<div class="foot-row1-1">
						<?php
						if ( is_active_sidebar( 'footer-1' ) ) {
							dynamic_sidebar( 'footer-1' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

					<div class="foot-row1-2">
						<?php
						if ( is_active_sidebar( 'footer-2' ) ) {
							dynamic_sidebar( 'footer-2' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

			</div>

			<div class="flex-wrap foot-row2">

					<div class="foot-row2-1">
						<?php
						if ( is_active_sidebar( 'footer-3' ) ) {
							dynamic_sidebar( 'footer-3' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

					<div class="foot-row2-2">
						<?php
						if ( is_active_sidebar( 'footer-4' ) ) {
							dynamic_sidebar( 'footer-4' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

					<div class="foot-row2-3">
						<?php
						if ( is_active_sidebar( 'footer-5' ) ) {
							dynamic_sidebar( 'footer-5' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

					<div class="foot-row2-4">
						<?php
						if ( is_active_sidebar( 'footer-6' ) ) {
							dynamic_sidebar( 'footer-6' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

					<div class="foot-row2-5">
						<?php
						if ( is_active_sidebar( 'footer-7' ) ) {
							dynamic_sidebar( 'footer-7' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

			</div>

			<div class="flex-wrap foot-row3">

					<div class="foot-row3-1">
						&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> All Rights Reserved.
					</div>

					<div class="foot-row3-2">
						<?php
						if ( is_active_sidebar( 'footer-br' ) ) {
							dynamic_sidebar( 'footer-br' );
						} else {
							echo '&nbsp;';
						}
						?>
					</div>

			</div>

		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
