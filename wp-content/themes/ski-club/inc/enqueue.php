<?php
/**
 * Asset enqueuing — styles and scripts.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue theme stylesheets and scripts.
 */
function ski_club_enqueue_assets() {

	// Google Fonts — Inter
	wp_enqueue_style(
		'ski-club-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		[],
		null
	);

	// style.css — theme header + design tokens + reset
	wp_enqueue_style(
		'ski-club-style',
		get_stylesheet_uri(),
		[ 'ski-club-fonts' ],
		'1.0.0'
	);

	// main.css — all component styles
	wp_enqueue_style(
		'ski-club-main',
		get_template_directory_uri() . '/assets/css/main.css',
		[ 'ski-club-style' ],
		'1.0.0'
	);

	// responsive.css — media queries
	wp_enqueue_style(
		'ski-club-responsive',
		get_template_directory_uri() . '/assets/css/responsive.css',
		[ 'ski-club-main' ],
		'1.0.0'
	);

	// main.js — mobile nav, sticky header, smooth scroll (loaded in footer)
	wp_enqueue_script(
		'ski-club-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ski_club_enqueue_assets' );
