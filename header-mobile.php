<?php
/**
 * Mobile Header
 *
 * @package bGood Fortune Jewelry
 */

?>
<header class="site-header--mobile" role="banner">
	<div class="mobile-header-left">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
				<?php the_custom_logo(); ?>
			</a>
		</div>
	</div>
	<div class="mobile-header-right">
		<button type="button" class="js-toggle-nav menu-button"
			aria-controls="mobile-nav-tray"
			aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'boxpress' ); ?></span>
			<span class="menu-icon-wrap"><span class="menu-icon"></span></span>
		</button>
	</div>
	</header>

	<div id="mobile-nav-tray" class="mobile-nav-tray" aria-hidden="true">
	<div class="mobile-nav-header">
		<button type="button" class="js-toggle-nav close-button"
			aria-controls="mobile-nav-tray"
			aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Close', 'boxpress' ); ?></span>
			<span class="menu-icon-wrap"><span class="close-icon"></span></span>
		</button>
	</div>
	<nav class="navigation--mobile">

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<ul class="mobile-nav mobile-nav--main">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'walker'         => new Aria_Walker_Nav_Menu(),
						)
					);
				?>
			</ul>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<ul class="mobile-nav mobile-nav--utility">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'secondary',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'walker'         => new Aria_Walker_Nav_Menu(),
						)
					);
				?>
			</ul>
		<?php endif; ?>

		<div class="mobile-nav--search">
			<?php get_search_form(); ?>
		</div>
	</nav>
</div>
