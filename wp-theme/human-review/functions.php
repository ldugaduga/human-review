<?php
/**
 * Human Review theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function human_review_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'human_review_setup' );

function human_review_assets() {
	wp_enqueue_style(
		'human-review-fonts',
		'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'human-review-tailwind',
		get_template_directory_uri() . '/assets/css/tailwind.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/tailwind.css' )
	);

	wp_enqueue_script(
		'human-review-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/main.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'human_review_assets' );

/**
 * Nav links shared by header.php's desktop and mobile menus. Active state is
 * matched by page slug rather than wp_nav_menu, since the whole nav is just
 * these 4 fixed links.
 */
function human_review_nav_links() {
	return array(
		'How it works' => array( 'url' => home_url( '/how-it-works/' ), 'slug' => 'how-it-works' ),
		'Solutions'    => array( 'url' => '#', 'slug' => null ),
		'Pricing'      => array( 'url' => '#', 'slug' => null ),
		'About'        => array( 'url' => home_url( '/about/' ), 'slug' => 'about' ),
	);
}

function human_review_is_current( $slug ) {
	return $slug && is_page( $slug );
}
