<?php
/**
 * Events page template — matched by slug "events".
 *
 * Sections:
 *   1. Hero              — "Year-Round Adventure"
 *   2. Upcoming Events   — WP_Query event CPT ordered by event_date ASC
 *   3. Activities        — 4 alternating image/text rows
 *   4. Monthly Meetings  — info card
 *   5. CTA               — "Become a Member" + "View Ski Trips"
 */

defined( 'ABSPATH' ) || exit;

/**
 * Map an event category slug to a badge CSS modifier class.
 *
 * @param string $category
 * @return string
 */
function ski_club_event_badge_class( string $category ): string {
	$map = [
		'Meeting' => 'badge-blue-light',
		'Biking'  => 'badge-green',
		'Kayaking'=> 'badge-teal',
		'Social'  => 'badge-purple',
		'Skiing'  => 'badge-primary',
	];
	return $map[ $category ] ?? 'badge-blue-light';
}

get_header();
?>


<?php
/* ==========================================================================
   SECTION 1 — PAGE HERO
   ========================================================================== */
?>

<section class="page-hero">
	<div class="container">
		<p class="page-hero__eyebrow">Activities &amp; Events</p>
		<h1 class="page-hero__title">Year-Round Adventure</h1>
		<p class="page-hero__subtitle">
			From powder days to paddling trips, LHSC keeps the adventure going every season of the year.
		</p>
	</div>
</section>


<?php
/* ==========================================================================
   SECTION 2 — UPCOMING EVENTS
   ========================================================================== */

$events_query = new WP_Query( [
	'post_type'      => 'event',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'meta_key'       => 'event_date',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
] );
?>

<section class="section">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">What's Coming Up</span>
			<h2 class="section-title">Upcoming Events</h2>
			<p class="section-subtitle">
				Stay in the loop — new activities are added throughout the year.
			</p>
		</div>

		<?php if ( $events_query->have_posts() ) : ?>

			<div class="events-grid">

				<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>

					<?php
					$event_id = get_the_ID();
					$date_raw = ski_club_get_field( 'event_date', $event_id );
					$time     = ski_club_get_field( 'event_time', $event_id );
					$location = ski_club_get_field( 'event_location', $event_id );
					$category = ski_club_get_field( 'event_category', $event_id );

					// Format date: ACF Date Picker returns Ymd
					$date_label = $date_raw
						? date_i18n( 'l, F j, Y', strtotime( $date_raw ) )
						: '';

					$badge_class = ski_club_event_badge_class( (string) $category );
					?>

					<article class="event-card">

						<div class="event-card__header">
							<h3 class="event-card__title"><?php the_title(); ?></h3>
							<?php if ( $category ) : ?>
								<span class="badge <?php echo esc_attr( $badge_class ); ?>">
									<?php echo esc_html( $category ); ?>
								</span>
							<?php endif; ?>
						</div>

						<div class="event-card__meta">
							<?php if ( $date_label ) : ?>
								<div class="event-card__meta-item">
									<?php echo ski_club_icon( 'calendar', 'icon' ); ?>
									<?php echo esc_html( $date_label ); ?>
								</div>
							<?php endif; ?>
							<?php if ( $time ) : ?>
								<div class="event-card__meta-item">
									<?php echo ski_club_icon( 'clock', 'icon' ); ?>
									<?php echo esc_html( $time ); ?>
								</div>
							<?php endif; ?>
							<?php if ( $location ) : ?>
								<div class="event-card__meta-item">
									<?php echo ski_club_icon( 'map-pin', 'icon' ); ?>
									<?php echo esc_html( $location ); ?>
								</div>
							<?php endif; ?>
						</div><!-- .event-card__meta -->

						<?php if ( get_the_content() ) : ?>
							<div class="event-card__desc">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>

					</article><!-- .event-card -->

				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- .events-grid -->

		<?php else : ?>

			<div class="text-center" style="padding-block: var(--space-12);">
				<div style="margin-bottom: var(--space-6); color: var(--color-gray-400);">
					<?php echo ski_club_icon( 'calendar', 'icon icon-xl' ); ?>
				</div>
				<h3 style="font-size: var(--font-size-2xl); margin-bottom: var(--space-3);">No Upcoming Events</h3>
				<p style="color: var(--color-gray-600);">
					New events are added regularly. Check back soon or attend a monthly meeting for the latest schedule.
				</p>
			</div>

		<?php endif; ?>

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 3 — ACTIVITIES (alternating image/text rows)
   ========================================================================== */

$events_page_id = get_the_ID();

$activities = [
	[
		'icon'    => 'mountain',
		'reverse' => false,
		'title'   => ski_club_get_field( 'ep_skiing_title',  $events_page_id ) ?: 'Skiing &amp; Snowboarding',
		'season'  => ski_club_get_field( 'ep_skiing_season', $events_page_id ) ?: 'Winter',
		'desc'    => ski_club_get_field( 'ep_skiing_desc',   $events_page_id ) ?: 'Our flagship activity. Each winter season we organize multiple group trips to premier resorts, from nearby Timberline and Snowshoe to world-class destinations in Colorado, Vermont, and Europe. Group rates, coordinated travel, and shared lodging make every trip affordable and unforgettable.',
	],
	[
		'icon'    => 'bike',
		'reverse' => true,
		'title'   => ski_club_get_field( 'ep_biking_title',  $events_page_id ) ?: 'Biking',
		'season'  => ski_club_get_field( 'ep_biking_season', $events_page_id ) ?: 'Spring &amp; Summer',
		'desc'    => ski_club_get_field( 'ep_biking_desc',   $events_page_id ) ?: "When the snow melts, we trade ski poles for handlebars. Our biking program offers group rides through some of the region's most scenic trails — the C&amp;O Canal towpath, the Great Allegheny Passage, and the rolling hills of the Blue Ridge Mountains. All fitness levels welcome.",
	],
	[
		'icon'    => 'droplets',
		'reverse' => false,
		'title'   => ski_club_get_field( 'ep_kayaking_title',  $events_page_id ) ?: 'Kayaking',
		'season'  => ski_club_get_field( 'ep_kayaking_season', $events_page_id ) ?: 'Summer',
		'desc'    => ski_club_get_field( 'ep_kayaking_desc',   $events_page_id ) ?: 'Summer paddles on the Potomac, Shenandoah, and local lakes give members a fresh way to experience the outdoors. Guided outings are available for beginners, while more experienced paddlers can tackle longer river routes with the group.',
	],
	[
		'icon'    => 'party-popper',
		'reverse' => true,
		'title'   => ski_club_get_field( 'ep_social_title',  $events_page_id ) ?: 'Social Events',
		'season'  => ski_club_get_field( 'ep_social_season', $events_page_id ) ?: 'Year-Round',
		'desc'    => ski_club_get_field( 'ep_social_desc',   $events_page_id ) ?: 'The glue that holds everything together. Monthly club meetings, end-of-season celebrations, spring picnics, and holiday parties keep the LHSC community connected long after the ski season ends. New members are always welcomed at every event.',
	],
];
?>

<section class="section bg-gray-50">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">All Seasons</span>
			<h2 class="section-title">Something for Everyone</h2>
			<p class="section-subtitle">
				Four distinct activity programs keep our members active and connected all year long.
			</p>
		</div>

		<div class="activity-rows">

			<?php foreach ( $activities as $activity ) :
				$row_class = 'activity-row' . ( $activity['reverse'] ? ' activity-row--reverse' : '' );
			?>

				<div class="<?php echo esc_attr( $row_class ); ?>">

					<div class="activity-row__image">
						<div class="activity-row__image-placeholder">
							<?php echo ski_club_icon( $activity['icon'], 'icon icon-xl' ); ?>
						</div>
					</div>

					<div class="activity-row__content">
						<span class="activity-row__season"><?php echo esc_html( $activity['season'] ); ?></span>
						<div class="activity-row__icon-wrap">
							<?php echo ski_club_icon( $activity['icon'], 'icon icon-lg' ); ?>
						</div>
						<h3 class="activity-row__title"><?php echo esc_html( $activity['title'] ); ?></h3>
						<p class="activity-row__desc"><?php echo esc_html( $activity['desc'] ); ?></p>
					</div>

				</div><!-- .activity-row -->

			<?php endforeach; ?>

		</div><!-- .activity-rows -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 4 — MONTHLY MEETINGS INFO CARD
   ========================================================================== */

$meeting_schedule = ski_club_get_field( 'ep_meeting_schedule', $events_page_id ) ?: 'Third Thursday of Every Month';
$meeting_doors    = ski_club_get_field( 'ep_meeting_doors',    $events_page_id ) ?: 'Doors open at 6:30 PM — meeting begins at 7:00 PM';
$meeting_time     = ski_club_get_field( 'ep_meeting_time',     $events_page_id ) ?: '7:00 PM';
$meeting_duration = ski_club_get_field( 'ep_meeting_duration', $events_page_id ) ?: 'Typically 60–90 minutes';
$meeting_venue    = ski_club_get_field( 'ep_meeting_venue',    $events_page_id ) ?: 'Ledo Pizza';
$meeting_city     = ski_club_get_field( 'ep_meeting_city',     $events_page_id ) ?: 'Hagerstown, MD';
$meeting_open_to  = ski_club_get_field( 'ep_meeting_open_to',  $events_page_id ) ?: 'Members and prospective members encouraged to attend';
?>

<section class="section">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">Stay Connected</span>
			<h2 class="section-title">Monthly Club Meetings</h2>
			<p class="section-subtitle">
				Our monthly meetings are open to all members and prospective members. Come meet the club and hear about upcoming trips and events.
			</p>
		</div>

		<div class="meetings-card card">

			<div class="meetings-card__item">
				<span class="meetings-card__label">When</span>
				<span class="meetings-card__value"><?php echo esc_html( $meeting_schedule ); ?></span>
				<span class="meetings-card__note"><?php echo esc_html( $meeting_doors ); ?></span>
			</div>

			<div class="meetings-card__item">
				<span class="meetings-card__label">Time</span>
				<span class="meetings-card__value"><?php echo esc_html( $meeting_time ); ?></span>
				<span class="meetings-card__note"><?php echo esc_html( $meeting_duration ); ?></span>
			</div>

			<div class="meetings-card__item">
				<span class="meetings-card__label">Location</span>
				<span class="meetings-card__value"><?php echo esc_html( $meeting_venue ); ?></span>
				<span class="meetings-card__note"><?php echo esc_html( $meeting_city ); ?></span>
			</div>

			<div class="meetings-card__item">
				<span class="meetings-card__label">Who Can Attend</span>
				<span class="meetings-card__value">All Are Welcome</span>
				<span class="meetings-card__note"><?php echo esc_html( $meeting_open_to ); ?></span>
			</div>

		</div><!-- .meetings-card -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 5 — CTA
   ========================================================================== */
?>

<section class="cta-section cta-section--primary">
	<div class="container">
		<div class="cta-inner">
			<h2 class="cta-title">Be Part of the Adventure</h2>
			<p class="cta-subtitle">
				Members get early access to event registration, group-rate pricing, and a community that adventures together.
			</p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( home_url( '/join' ) ); ?>" class="btn btn-white btn-lg">
					<?php echo ski_club_icon( 'users', 'icon' ); ?>
					Become a Member
				</a>
				<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="btn btn-outline-white btn-lg">
					<?php echo ski_club_icon( 'mountain', 'icon' ); ?>
					View Ski Trips
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
