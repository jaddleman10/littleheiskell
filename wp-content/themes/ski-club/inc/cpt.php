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
					'Meeting'  => 'Meeting',
					'Biking'   => 'Biking',
					'Kayaking' => 'Kayaking',
					'Social'   => 'Social',
					'Skiing'   => 'Skiing',
				],
				'default_value' => 'Meeting',
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
	/* -----------------------------------------------------------------------
	   Contact Page — fixed-slot officer directory (10 slots, 7 in use)
	----------------------------------------------------------------------- */

	$contact_fields = [];
	$contact_defaults = [
		1 => [ 'name' => 'Carol Carbaugh', 'position' => 'President',      'email' => 'VP@LittleHeiskellSkiClub.com' ],
		2 => [ 'name' => 'Gwen Hard',      'position' => 'Vice President', 'email' => 'President@LittleHeiskellSkiClub.com' ],
		3 => [ 'name' => 'Kathy Sortore',  'position' => 'Membership',     'email' => 'info@LittleheiskellSkiClub.com' ],
		4 => [ 'name' => 'Anita Wade',     'position' => 'Treasurer',      'email' => 'Treasurer@LittleHeiskellSkiClub.com' ],
		5 => [ 'name' => 'Vicki Martin',   'position' => 'Secretary',      'email' => 'Secretary@LittleHeiskellSkiClub.com' ],
		6 => [ 'name' => 'Sherry Itnyre',  'position' => 'Newsletter',     'email' => 'Newsletter@LittleHeiskellSkiCLub.com' ],
		7 => [ 'name' => 'Betsy Klein',    'position' => 'Website',        'email' => 'Website@LittleHeiskellSkiClub.com' ],
	];

	for ( $i = 1; $i <= 10; $i++ ) {
		$default = $contact_defaults[ $i ] ?? [ 'name' => '', 'position' => '', 'email' => '' ];

		$contact_fields[] = [
			'key'   => "field_cp_tab_{$i}",
			'label' => "Contact {$i}",
			'type'  => 'tab',
		];
		$contact_fields[] = [
			'key'           => "field_cp_name_{$i}",
			'label'         => 'Name',
			'name'          => "cp_name_{$i}",
			'type'          => 'text',
			'default_value' => $default['name'],
			'instructions'  => 'Full name of the officer.',
		];
		$contact_fields[] = [
			'key'           => "field_cp_position_{$i}",
			'label'         => 'Position / Title',
			'name'          => "cp_position_{$i}",
			'type'          => 'text',
			'default_value' => $default['position'],
			'instructions'  => 'e.g. President, Treasurer, Newsletter',
		];
		$contact_fields[] = [
			'key'           => "field_cp_email_{$i}",
			'label'         => 'Email Address',
			'name'          => "cp_email_{$i}",
			'type'          => 'email',
			'default_value' => $default['email'],
		];
	}

	// ACF 'page' location rule requires a post ID, not a slug.
	$contact_page    = get_page_by_path( 'contact' );
	$contact_page_id = $contact_page ? (string) $contact_page->ID : '0';

	acf_add_local_field_group( [
		'key'    => 'group_contact_page',
		'title'  => 'Contact Directory',
		'fields' => $contact_fields,
		'location' => [ [ [
			'param'    => 'post_type',
			'operator' => '==',
			'value'    => 'page',
		], [
			'param'    => 'page',
			'operator' => '==',
			'value'    => $contact_page_id,
		] ] ],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	] );

	/* -----------------------------------------------------------------------
	   Events Page — editable activities & meeting details
	----------------------------------------------------------------------- */
	acf_add_local_field_group( [
		'key'   => 'group_events_page',
		'title' => 'Events Page Settings',
		'fields' => [

			// ── Activity rows ──────────────────────────────────────────────
			[
				'key'   => 'field_ep_tab_activities',
				'label' => 'Activity Sections',
				'type'  => 'tab',
			],
			// Skiing
			[
				'key'          => 'field_ep_skiing_title',
				'label'        => 'Skiing — Title',
				'name'         => 'ep_skiing_title',
				'type'         => 'text',
				'default_value' => 'Skiing & Snowboarding',
			],
			[
				'key'          => 'field_ep_skiing_season',
				'label'        => 'Skiing — Season Label',
				'name'         => 'ep_skiing_season',
				'type'         => 'text',
				'default_value' => 'Winter',
			],
			[
				'key'          => 'field_ep_skiing_desc',
				'label'        => 'Skiing — Description',
				'name'         => 'ep_skiing_desc',
				'type'         => 'textarea',
				'rows'         => 4,
				'default_value' => 'Our flagship activity. Each winter season we organize multiple group trips to premier resorts, from nearby Timberline and Snowshoe to world-class destinations in Colorado, Vermont, and Europe. Group rates, coordinated travel, and shared lodging make every trip affordable and unforgettable.',
			],
			// Biking
			[
				'key'          => 'field_ep_biking_title',
				'label'        => 'Biking — Title',
				'name'         => 'ep_biking_title',
				'type'         => 'text',
				'default_value' => 'Biking',
			],
			[
				'key'          => 'field_ep_biking_season',
				'label'        => 'Biking — Season Label',
				'name'         => 'ep_biking_season',
				'type'         => 'text',
				'default_value' => 'Spring & Summer',
			],
			[
				'key'          => 'field_ep_biking_desc',
				'label'        => 'Biking — Description',
				'name'         => 'ep_biking_desc',
				'type'         => 'textarea',
				'rows'         => 4,
				'default_value' => "When the snow melts, we trade ski poles for handlebars. Our biking program offers group rides through some of the region's most scenic trails — the C&O Canal towpath, the Great Allegheny Passage, and the rolling hills of the Blue Ridge Mountains. All fitness levels welcome.",
			],
			// Kayaking
			[
				'key'          => 'field_ep_kayaking_title',
				'label'        => 'Kayaking — Title',
				'name'         => 'ep_kayaking_title',
				'type'         => 'text',
				'default_value' => 'Kayaking',
			],
			[
				'key'          => 'field_ep_kayaking_season',
				'label'        => 'Kayaking — Season Label',
				'name'         => 'ep_kayaking_season',
				'type'         => 'text',
				'default_value' => 'Summer',
			],
			[
				'key'          => 'field_ep_kayaking_desc',
				'label'        => 'Kayaking — Description',
				'name'         => 'ep_kayaking_desc',
				'type'         => 'textarea',
				'rows'         => 4,
				'default_value' => 'Summer paddles on the Potomac, Shenandoah, and local lakes give members a fresh way to experience the outdoors. Guided outings are available for beginners, while more experienced paddlers can tackle longer river routes with the group.',
			],
			// Social
			[
				'key'          => 'field_ep_social_title',
				'label'        => 'Social Events — Title',
				'name'         => 'ep_social_title',
				'type'         => 'text',
				'default_value' => 'Social Events',
			],
			[
				'key'          => 'field_ep_social_season',
				'label'        => 'Social Events — Season Label',
				'name'         => 'ep_social_season',
				'type'         => 'text',
				'default_value' => 'Year-Round',
			],
			[
				'key'          => 'field_ep_social_desc',
				'label'        => 'Social Events — Description',
				'name'         => 'ep_social_desc',
				'type'         => 'textarea',
				'rows'         => 4,
				'default_value' => 'The glue that holds everything together. Monthly club meetings, end-of-season celebrations, spring picnics, and holiday parties keep the LHSC community connected long after the ski season ends. New members are always welcomed at every event.',
			],

			// ── Monthly meetings ───────────────────────────────────────────
			[
				'key'   => 'field_ep_tab_meetings',
				'label' => 'Monthly Meeting Details',
				'type'  => 'tab',
			],
			[
				'key'          => 'field_ep_meeting_schedule',
				'label'        => 'Schedule',
				'name'         => 'ep_meeting_schedule',
				'type'         => 'text',
				'instructions' => 'e.g. Third Thursday of Every Month',
				'default_value' => 'Third Thursday of Every Month',
			],
			[
				'key'          => 'field_ep_meeting_doors',
				'label'        => 'Doors Open Note',
				'name'         => 'ep_meeting_doors',
				'type'         => 'text',
				'instructions' => 'Shown as a sub-note under the schedule.',
				'default_value' => 'Doors open at 6:30 PM — meeting begins at 7:00 PM',
			],
			[
				'key'          => 'field_ep_meeting_time',
				'label'        => 'Start Time',
				'name'         => 'ep_meeting_time',
				'type'         => 'text',
				'default_value' => '7:00 PM',
			],
			[
				'key'          => 'field_ep_meeting_duration',
				'label'        => 'Duration Note',
				'name'         => 'ep_meeting_duration',
				'type'         => 'text',
				'default_value' => 'Typically 60–90 minutes',
			],
			[
				'key'          => 'field_ep_meeting_venue',
				'label'        => 'Venue Name',
				'name'         => 'ep_meeting_venue',
				'type'         => 'text',
				'default_value' => 'Ledo Pizza',
			],
			[
				'key'          => 'field_ep_meeting_city',
				'label'        => 'Venue City',
				'name'         => 'ep_meeting_city',
				'type'         => 'text',
				'default_value' => 'Hagerstown, MD',
			],
			[
				'key'          => 'field_ep_meeting_open_to',
				'label'        => 'Who Can Attend',
				'name'         => 'ep_meeting_open_to',
				'type'         => 'text',
				'default_value' => 'Members and prospective members encouraged to attend',
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				],
				[
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'top_level_page',
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
