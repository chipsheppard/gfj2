<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Good Fortune Jewelry
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'good-fortune-jewelry' ); ?></a>

<div class="header-bar">
	<div class="inner-wrap">
		<div class="flex-wrap">
			<div class="headerbar-left">
				<?php
				if ( is_active_sidebar( 'headerbar-1' ) ) {
					dynamic_sidebar( 'headerbar-1' );
				}
				?>
			</div>
			<div class="headerbar-mid">
				<?php
				if ( is_active_sidebar( 'headerbar-2' ) ) {
					dynamic_sidebar( 'headerbar-2' );
				}
				?>
			</div>
			<div class="headerbar-right">
				<?php
				if ( is_active_sidebar( 'headerbar-3' ) ) {
					dynamic_sidebar( 'headerbar-3' );
				}
				?>
			</div>
		</div>
	</div>
</div>

	<?php require get_template_directory() . '/header-mobile.php'; ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="inner-wrap">
			<div class="header-flex-wrap">

				<div class="menu-left">
					<div class="main-navigation">
						<div class="menu-wrap">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
								'container'      => '',
							)
						);
						?>
						</div>
					</div>
					<div class="header-search">
						<?php get_search_form(); ?>
					</div>
				</div>

				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
						<?php the_custom_logo(); ?>
					</a>
				</div>

				<div class="menu-right">
					<div class="main-navigation">
						<div class="menu-wrap">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'menu_id'        => 'primary-menu',
								'container'      => '',
							)
						);
						?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
