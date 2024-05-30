<?php
/**
 * Good Fortune Jewelry functions and definitions
 *
 * @package Good Fortune Jewelry
 */

if ( ! defined( '_CSS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_CSS_VERSION', '1.0.0' );
}


if ( ! function_exists( 'good_fortune_jewelry_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function good_fortune_jewelry_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Good Fortune Jewelry, use a find and replace
		* to change 'good-fortune-jewelry' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'good-fortune-jewelry', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in 2 locations.
		register_nav_menus(
			array(
				'primary'   => __( 'Primary Menu', 'good-fortune-jewelry' ),
				'secondary' => __( 'Secondary Menu', 'good-fortune-jewelry' ),
			)
		);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'good_fortune_jewelry_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Gutenberg.
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );

		/**
		* Enable support for Post Formats.
		* See http://codex.wordpress.org/Post_Formats

		Z add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);
		*/

	}
endif;
add_action( 'after_setup_theme', 'good_fortune_jewelry_setup' );


/**
 * Register widget area.
 */
function good_fortune_jewelry_widgets_init() {

	// Global Sidebar (for onesidebar page template ------------------ .
	register_sidebar(
		array(
			'name'          => __( 'Right Sidebar', 'good-fortune-jewelry' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Headerbar Widgets --------------------------------------------- .
	register_sidebar(
		array(
			'name'          => __( 'Headerbar Left', 'good-fortune-jewelry' ),
			'id'            => 'headerbar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="headerbar1 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Headerbar Middle', 'good-fortune-jewelry' ),
			'id'            => 'headerbar-2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="headerbar2 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Headerbar Right', 'good-fortune-jewelry' ),
			'id'            => 'headerbar-3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="headerbar3 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	// Footer Widgets ----------------------------------------------- .
	register_sidebar(
		array(
			'name'          => __( 'Footer Top 1', 'good-fortune-jewelry' ),
			'id'            => 'footer-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer1 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Top 2', 'good-fortune-jewelry' ),
			'id'            => 'footer-2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer2 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Middle 1', 'good-fortune-jewelry' ),
			'id'            => 'footer-3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer3 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Middle 2', 'good-fortune-jewelry' ),
			'id'            => 'footer-4',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer4 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Middle 3', 'good-fortune-jewelry' ),
			'id'            => 'footer-5',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer5 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Middle 4', 'good-fortune-jewelry' ),
			'id'            => 'footer-6',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer6 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Middle 5', 'good-fortune-jewelry' ),
			'id'            => 'footer-7',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footer7 widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Bottom Right', 'good-fortune-jewelry' ),
			'id'            => 'footer-br',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="footerbr widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

}
add_action( 'widgets_init', 'good_fortune_jewelry_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function good_fortune_jewelry_scripts() {

	wp_enqueue_style( 'good-fortune-jewelry-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), _CSS_VERSION );
	wp_enqueue_script( 'good-fortune-jewelry-js', get_template_directory_uri() . '/assets/js/build/site.min.js', array( 'jquery' ), _CSS_VERSION, true );
	wp_enqueue_style( 'googleFonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap', array(), _CSS_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_style( 'font-awesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0', 'all' );
	wp_enqueue_style( 'font-awesome-css' );
}
add_action( 'wp_enqueue_scripts', 'good_fortune_jewelry_scripts' );

/**
 * Implement the Custom Header feature.
	require get_template_directory() . '/inc/custom-header.php';
 */

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Accessibility
 */
require get_template_directory() . '/inc/class-aria-walker-nav-menu.php';

/**
 * Add support for Woo things.
 */
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );
