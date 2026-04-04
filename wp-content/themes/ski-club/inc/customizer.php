<?php
/**
 * WordPress Customizer settings.
 * Panel: "Ski Club Theme Options"
 *   Section 1: Hero Settings       — hero background image
 *   Section 2: Beyond the Slopes   — 3 gallery photos
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all Customizer panels, sections, settings, and controls.
 */
function ski_club_customizer_settings( WP_Customize_Manager $wp_customize ) {

	/* ------------------------------------------------------------------
	   Panel
	------------------------------------------------------------------ */
	$wp_customize->add_panel( 'ski_club_options', [
		'title'       => __( 'Ski Club Theme Options', 'ski-club' ),
		'description' => __( 'Settings specific to the Ski Club theme.', 'ski-club' ),
		'priority'    => 130,
	] );

	/* ------------------------------------------------------------------
	   Section 1: Hero Settings
	------------------------------------------------------------------ */
	$wp_customize->add_section( 'ski_club_hero', [
		'title'    => __( 'Hero Settings', 'ski-club' ),
		'panel'    => 'ski_club_options',
		'priority' => 10,
	] );

	$wp_customize->add_setting( 'ski_club_hero_image', [
		'default'           => 0,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	] );

	$wp_customize->add_control(
		new WP_Customize_Media_Control( $wp_customize, 'ski_club_hero_image', [
			'label'       => __( 'Hero Background Image', 'ski-club' ),
			'description' => __( 'Full-screen background image on the homepage hero. Recommended size: 1920×1080px.', 'ski-club' ),
			'section'     => 'ski_club_hero',
			'mime_type'   => 'image',
		] )
	);

	/* ------------------------------------------------------------------
	   Section 2: Beyond the Slopes Gallery
	------------------------------------------------------------------ */
	$wp_customize->add_section( 'ski_club_gallery', [
		'title'    => __( 'Beyond the Slopes Gallery', 'ski-club' ),
		'panel'    => 'ski_club_options',
		'priority' => 20,
	] );

	$gallery_photos = [
		1 => 'Biking Photo',
		2 => 'Kayaking Photo',
		3 => 'Social Events Photo',
	];

	foreach ( $gallery_photos as $index => $label ) {
		$setting_id = "ski_club_gallery_image_{$index}";

		$wp_customize->add_setting( $setting_id, [
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control(
			new WP_Customize_Media_Control( $wp_customize, $setting_id, [
				'label'       => __( "Gallery Photo {$index}: {$label}", 'ski-club' ),
				'description' => __( 'Recommended size: 600×400px.', 'ski-club' ),
				'section'     => 'ski_club_gallery',
				'mime_type'   => 'image',
				'priority'    => $index * 10,
			] )
		);
	}
}
add_action( 'customize_register', 'ski_club_customizer_settings' );

/* ==========================================================================
   HELPER FUNCTIONS
   ========================================================================== */

/**
 * Return the hero background image URL, or a fallback.
 *
 * @param string $fallback Full URL to use when no Customizer image is set.
 * @return string
 */
function ski_club_get_hero_image_url( string $fallback = '' ): string {
	$attachment_id = (int) get_theme_mod( 'ski_club_hero_image', 0 );
	if ( $attachment_id ) {
		$url = wp_get_attachment_image_url( $attachment_id, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return $fallback;
}

/**
 * Return a gallery image URL for the "Beyond the Slopes" section.
 *
 * @param int    $index    1, 2, or 3.
 * @param string $fallback Full URL to use when no Customizer image is set.
 * @return string
 */
function ski_club_get_gallery_image_url( int $index, string $fallback = '' ): string {
	$attachment_id = (int) get_theme_mod( "ski_club_gallery_image_{$index}", 0 );
	if ( $attachment_id ) {
		$url = wp_get_attachment_image_url( $attachment_id, 'large' );
		if ( $url ) {
			return $url;
		}
	}
	return $fallback;
}
