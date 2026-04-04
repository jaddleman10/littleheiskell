<?php
/**
 * Ski Club theme — functions.php
 * Master include file. Handles theme setup, registers nav menus,
 * image sizes, and all utility/helper functions used by templates.
 */

defined( 'ABSPATH' ) || exit;

/* ==========================================================================
   INCLUDES
   ========================================================================== */

require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/customizer.php';

/* ==========================================================================
   THEME SETUP
   ========================================================================== */

function ski_club_theme_setup() {

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable featured images (post thumbnails)
	add_theme_support( 'post-thumbnails' );

	// HTML5 markup
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );

	// Custom logo support
	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	// Customizer selective refresh
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Nav menus
	register_nav_menus( [
		'primary' => __( 'Primary Navigation', 'ski-club' ),
		'footer'  => __( 'Footer Navigation', 'ski-club' ),
	] );

	// Custom image sizes
	add_image_size( 'trip-card',  800,  500, true );  // trip card thumbnails
	add_image_size( 'gallery-md', 600,  400, true );  // beyond-the-slopes gallery
	add_image_size( 'hero-full',  1920, 1080, true ); // hero background
}
add_action( 'after_setup_theme', 'ski_club_theme_setup' );

/* ==========================================================================
   HELPER: ACF-AWARE FIELD GETTER
   ========================================================================== */

/**
 * Retrieve a custom field value using ACF if available, falling back to
 * standard post meta. This keeps templates working whether or not ACF is active.
 *
 * @param string $field_name  The ACF field name / meta key.
 * @param int    $post_id     The post ID.
 * @return mixed
 */
function ski_club_get_field( string $field_name, int $post_id ) {
	if ( function_exists( 'get_field' ) ) {
		return get_field( $field_name, $post_id );
	}
	return get_post_meta( $post_id, $field_name, true );
}

/* ==========================================================================
   HELPER: INLINE SVG ICON
   ========================================================================== */

/**
 * Output an inline SVG icon from the Lucide icon set.
 * Icons are keyed by name. Add new entries here as needed.
 *
 * @param string $name   Icon name (e.g. 'calendar', 'map-pin').
 * @param string $class  CSS class(es) to apply to the <svg> element.
 * @return string  Safe SVG markup.
 */
function ski_club_icon( string $name, string $class = 'icon' ): string {
	$attr = 'class="' . esc_attr( $class ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';

	$icons = [

		'calendar' => '<svg ' . $attr . '><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',

		'map-pin' => '<svg ' . $attr . '><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',

		'clock' => '<svg ' . $attr . '><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',

		'users' => '<svg ' . $attr . '><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',

		'award' => '<svg ' . $attr . '><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>',

		'mountain' => '<svg ' . $attr . '><polygon points="3 18 9 6 15 14 19 10 21 18"></polygon></svg>',

		'bike' => '<svg ' . $attr . '><circle cx="18.5" cy="17.5" r="3.5"></circle><circle cx="5.5" cy="17.5" r="3.5"></circle><circle cx="15" cy="5" r="1"></circle><path d="M12 17.5V14l-3-3 4-3 2 3h2"></path></svg>',

		'droplets' => '<svg ' . $attr . '><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path></svg>',

		'party-popper' => '<svg ' . $attr . '><path d="M5.8 11.3 2 22l10.7-3.79"></path><path d="M4 3h.01"></path><path d="M22 8h.01"></path><path d="M15 2h.01"></path><path d="M22 20h.01"></path><path d="m22 2-2.24.75a2.9 2.9 0 0 0-1.96 3.12v0c.1.86-.57 1.63-1.45 1.63h-.38c-.86 0-1.6.6-1.76 1.44L14 10"></path><path d="m22 13-.82-.33c-.86-.34-1.82.2-1.98 1.11v0c-.11.7-.72 1.22-1.43 1.22H17"></path><path d="m11 2 .33.82c.34.86-.2 1.82-1.11 1.98v0C9.52 4.9 9 5.52 9 6.23V7"></path><path d="M11 13c1.93 1.93 2.83 4.17 2 5-.83.83-3.07-.07-5-2-1.93-1.93-2.83-4.17-2-5 .83-.83 3.07.07 5 2z"></path></svg>',

		'plane' => '<svg ' . $attr . '><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"></path></svg>',

		'hotel' => '<svg ' . $attr . '><path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"></path><path d="m9 22 .01-4a3 3 0 0 1 2.99-3h0a3 3 0 0 1 3 3V22"></path><path d="M6 12h12"></path><path d="M6 7h1v5"></path><path d="M17 7h1v5"></path><path d="M10 7h4v5h-4z"></path></svg>',

		'ticket' => '<svg ' . $attr . '><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path><path d="M13 5v2"></path><path d="M13 17v2"></path><path d="M13 11v2"></path></svg>',

		'menu' => '<svg ' . $attr . '><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',

		'x' => '<svg ' . $attr . '><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',

		'arrow-right' => '<svg ' . $attr . '><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',

		'external-link' => '<svg ' . $attr . '><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>',

		'check' => '<svg ' . $attr . '><polyline points="20 6 9 17 4 12"></polyline></svg>',
	];

	return $icons[ $name ] ?? '';
}
