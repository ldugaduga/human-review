<?php
/**
 * Plugin Name: Human Review - Elementor Widgets
 * Description: Registered Elementor widgets for The Human Review's design sections (Header, Footer, ...), built from the pixel-perfect Tailwind HTML prototypes.
 * Version: 1.0.0
 * Author: Kane Sherwell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HUMAN_REVIEW_WIDGETS_DIR', __DIR__ );
define( 'HUMAN_REVIEW_WIDGETS_URL', plugins_url( '', __FILE__ ) );

/**
 * Enqueue the shared compiled CSS/JS/font on the frontend, so every widget
 * on this list can rely on the same Tailwind build regardless of which
 * pages/widgets are actually placed on a given page.
 */
function human_review_widgets_assets() {
	wp_enqueue_style(
		'human-review-fonts',
		'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'human-review-tailwind',
		HUMAN_REVIEW_WIDGETS_URL . '/assets/css/tailwind.css',
		array(),
		filemtime( HUMAN_REVIEW_WIDGETS_DIR . '/assets/css/tailwind.css' )
	);

	wp_enqueue_script(
		'human-review-widgets-main',
		HUMAN_REVIEW_WIDGETS_URL . '/assets/js/main.js',
		array(),
		filemtime( HUMAN_REVIEW_WIDGETS_DIR . '/assets/js/main.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'human_review_widgets_assets' );

/**
 * Registers a "Human Review" category in the Elementor panel so our widgets
 * are easy to find instead of buried in "General".
 */
function human_review_widgets_category( $elements_manager ) {
	$elements_manager->add_category(
		'human-review',
		array(
			'title' => __( 'Human Review', 'human-review' ),
			'icon'  => 'fa fa-plug',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'human_review_widgets_category' );

/**
 * Registers each widget class with Elementor.
 */
function human_review_widgets_register( $widgets_manager ) {
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-header-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-footer-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-hero-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-why-exist-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-beliefs-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-team-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-hiw-hero-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-steps-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-help-cards-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-unfiltered-truth-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-faq-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-contact-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-po-hero-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-po-steps-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-po-jobs-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-po-dashboard-widget.php';
	require_once HUMAN_REVIEW_WIDGETS_DIR . '/widgets/class-po-why-widget.php';

	$widgets_manager->register( new \Human_Review_Header_Widget() );
	$widgets_manager->register( new \Human_Review_Footer_Widget() );
	$widgets_manager->register( new \Human_Review_Hero_Widget() );
	$widgets_manager->register( new \Human_Review_Why_Exist_Widget() );
	$widgets_manager->register( new \Human_Review_Beliefs_Widget() );
	$widgets_manager->register( new \Human_Review_Team_Widget() );
	$widgets_manager->register( new \Human_Review_Hiw_Hero_Widget() );
	$widgets_manager->register( new \Human_Review_Steps_Widget() );
	$widgets_manager->register( new \Human_Review_Help_Cards_Widget() );
	$widgets_manager->register( new \Human_Review_Unfiltered_Truth_Widget() );
	$widgets_manager->register( new \Human_Review_Faq_Widget() );
	$widgets_manager->register( new \Human_Review_Contact_Widget() );
	$widgets_manager->register( new \Human_Review_Po_Hero_Widget() );
	$widgets_manager->register( new \Human_Review_Po_Steps_Widget() );
	$widgets_manager->register( new \Human_Review_Po_Jobs_Widget() );
	$widgets_manager->register( new \Human_Review_Po_Dashboard_Widget() );
	$widgets_manager->register( new \Human_Review_Po_Why_Widget() );
}
add_action( 'elementor/widgets/register', 'human_review_widgets_register' );
