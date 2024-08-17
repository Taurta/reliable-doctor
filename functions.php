<?php
/**
 * Your Startup functions and definitions
 *
 * @package Your_Startup
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function your_startup_setup() {
	register_nav_menus(
		array(
			'menu-header' 	=> esc_html__( 'Header', 'your-startup' ),
		)
	);
}
add_action( 'after_setup_theme', 'your_startup_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function your_startup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'your_startup_content_width', 640 );
}
add_action( 'after_setup_theme', 'your_startup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function your_startup_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'your-startup' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'your-startup' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'your_startup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function your_startup_scripts() {
	wp_enqueue_style( 'your-startup-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'your-startup-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'your_startup_scripts' );

/**
 * Custom-posts.
 */
require get_template_directory() . '/inc/custom-posts.php';

/**
 * API.
 */
require get_template_directory() . '/inc/api/index.php';

/**
 * Страница Доп. настроек
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Доп. настройки',
        'menu_title'    => 'Доп. настройки',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}





