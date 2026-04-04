<?php
/**
 * Custom Post Types: trip and event.
 * ACF field groups are registered in PHP so no database configuration is needed.
 * If ACF is not active the CPTs still register; fields just won't appear in the editor.
 */

defined( 'ABSPATH' ) || exit;

/* ==========================================================================
   TRIP CPT
   ========================================================================== */

function ski_club_register_trip_cpt() {
	$labels = [
		'name'               => 'Trips',
		'singular_name'      => 'Trip',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Trip',
		'edit_item'          => 'Edit Trip',
		'new_item'           => 'New Trip',
		'view_item'          => 'View Trip',
		'search_items'       => 'Search Trips',
		'not_found'          => 'No trips found',
		'not_found_in_trash' => 'No trips found in trash',
		'menu_name'          => 'Trips',
	];

	$args = [
		'labels'        => $labels,
		'public'        => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-airplane',
		'menu_position' => 5,
		'supports'      => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
		'has_archive'   => false,
		'rewrite'       => [ 'slug' => 'trip' ],
		'show_in_rest'  => false,
	];

	register_post_type( 'trip', $args );
}
add_action( 'init', 'ski_club_register_trip_cpt' );

/* ==========================================================================
   EVENT CPT
   ========================================================================== */

function ski_club_register_event_cpt() {
	$labels = [
		'name'               => 'Events',
		'singular_name'      => 'Event',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Event',
		'edit_item'          => 'Edit Event',
		'new_item'           => 'New Event',
		'view_item'          => 'View Event',
		'search_items'       => 'Search Events',
		'not_found'          => 'No events found',
		'not_found_in_trash' => 'No events found in trash',
		'menu_name'          => 'Events',
	];

	$args = [
		'labels'        => $labels,
		'public'        => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-calendar-alt',
		'menu_position' => 6,
		'supports'      => [ 'title', 'editor' ],
		'has_archive'   => false,
		'rewrite'       => [ 'slug' => 'event' ],
		'show_in_rest'  => false,
	];

	register_post_type( 'event', $args );
}
add_action( 'init', 'ski_club_register_event_cpt' );

/* ==========================================================================
   ACF FIELD GROUPS
   ========================================================================== */

function ski_club_register_acf_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	/* -----------------------------------------------------------------------
	   Trip Fields
	----------------------------------------------------------------------- */
	acf_add_local_field_group( [
		'key'    => 'group_trip_details',
		'title'  => 'Trip Details',
		'fields' => [
			[
				'key'           => 'field_trip_start_date',
				'label'         => 'Trip Start Date',
				'name'          => 'trip_start_date',
				'type'          => 'date_picker',
				'display_format' => 'F j, Y',
				'return_format'  => 'F j, Y',
				'first_day'      => 1,
			],
			[
				'key'           => 'field_trip_end_date',
				'label'         => 'Trip End Date',
				'name'          => 'trip_end_date',
				'type'          => 'date_picker',
				'display_format' => 'F j, Y',
				'return_format'  => 'F j, Y',
				'first_day'      => 1,
			],
			[
				'key'   => 'field_trip_location',
				'label' => 'Location / Resort Name',
				'name'  => 'trip_location',
				'type'  => 'text',
				'instructions' => 'e.g. Verbier, Switzerland',
			],
			[
				'key'   => 'field_trip_region',
				'label' => 'Region / Area',
				'name'  => 'trip_region',
				'type'  => 'text',
				'instructions' => 'e.g. 4 Vallées or Canyons Resort',
			],
			[
				'key'          => 'field_trip_highlights',
				'label'        => 'Trip Highlights',
				'name'         => 'trip_highlights',
				'type'         => 'textarea',
				'instructions' => 'One highlight per line. These appear as a bullet list on the trips page.',
				'rows'         => 6,
			],
			[
				'key'          => 'field_trip_inquiry_text',
				'label'        => 'Inquiry Button Text',
				'name'         => 'trip_inquiry_text',
				'type'         => 'text',
				'default_value' => 'Inquire About This Trip',
			],
			[
				'key'   => 'field_trip_inquiry_url',
				'label' => 'Inquiry Button URL',
				'name'  => 'trip_inquiry_url',
				'type'  => 'url',
			],
			[
				'key'          => 'field_trip_featured',
				'label'        => 'Featured on Homepage',
				'name'         => 'trip_featured',
				'type'         => 'true_false',
				'message'      => 'Show this trip in the 2026 Ski Trips section on the homepage',
				'default_value' => 0,
				'ui'           => 1,
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'trip',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	] );

	/* -----------------------------------------------------------------------
	   Event Fields
	----------------------------------------------------------------------- */
	acf_add_local_field_group( [
		'key'    => 'group_event_details',
		'title'  => 'Event Details',
		'fields' => [
			[
				'key'            => 'field_event_date',
				'label'          => 'Event Date',
				'name'           => 'event_date',
				'type'           => 'date_picker',
				'display_format' => 'F j, Y',
				'return_format'  => 'F j, Y',
				'first_day'      => 1,
			],
			[
				'key'          => 'field_event_time',
				'label'        => 'Event Time',
				'name'         => 'event_time',
				'type'         => 'text',
				'instructions' => 'e.g. 7:00 PM',
			],
			[
				'key'          => 'field_event_location',
				'label'        => 'Event Location',
				'name'         => 'event_location',
				'type'         => 'text',
				'instructions' => 'e.g. Ledo Pizza, Foxshire Plaza, Hagerstown, MD',
			],
			[
				'key'     => 'field_event_category',
				'label'   => 'Event Category',
				'name'    => 'event_category',
				'type'    => 'select',
				'choices' => [
					'meeting' => 'Meeting',
					'biking'  => 'Biking',
					'kayaking' => 'Kayaking',
					'social'  => 'Social',
					'skiing'  => 'Skiing',
				],
				'default_value' => 'meeting',
				'allow_null'    => 0,
				'ui'            => 1,
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'event',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	] );
}
add_action( 'acf/init', 'ski_club_register_acf_fields' );
