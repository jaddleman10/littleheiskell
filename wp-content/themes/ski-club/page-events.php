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

			<!-- Row 1: Skiing (image left) -->
			<div class="activity-row">

				<div class="activity-row__image">
					<div class="activity-row__image-placeholder">
						<?php echo ski_club_icon( 'mountain', 'icon icon-xl' ); ?>
					</div>
				</div>

				<div class="activity-row__content">
					<span class="activity-row__season">Winter</span>
					<div class="activity-row__icon-wrap">
						<?php echo ski_club_icon( 'mountain', 'icon icon-lg' ); ?>
					</div>
					<h3 class="activity-row__title">Skiing &amp; Snowboarding</h3>
					<p class="activity-row__desc">
						Our flagship activity. Each winter season we organize multiple group trips to premier resorts, from nearby Timberline and Snowshoe to world-class destinations in Colorado, Vermont, and Europe. Group rates, coordinated travel, and shared lodging make every trip affordable and unforgettable.
					</p>
				</div>

			</div><!-- .activity-row -->

			<!-- Row 2: Biking (image right) -->
			<div class="activity-row activity-row--reverse">

				<div class="activity-row__image">
					<div class="activity-row__image-placeholder">
						<?php echo ski_club_icon( 'bike', 'icon icon-xl' ); ?>
					</div>
				</div>

				<div class="activity-row__content">
					<span class="activity-row__season">Spring &amp; Summer</span>
					<div class="activity-row__icon-wrap">
						<?php echo ski_club_icon( 'bike', 'icon icon-lg' ); ?>
					</div>
					<h3 class="activity-row__title">Biking</h3>
					<p class="activity-row__desc">
						When the snow melts, we trade ski poles for handlebars. Our biking program offers group rides through some of the region's most scenic trails — the C&amp;O Canal towpath, the Great Allegheny Passage, and the rolling hills of the Blue Ridge Mountains. All fitness levels welcome.
					</p>
				</div>

			</div><!-- .activity-row activity-row--reverse -->

			<!-- Row 3: Kayaking (image left) -->
			<div class="activity-row">

				<div class="activity-row__image">
					<div class="activity-row__image-placeholder">
						<?php echo ski_club_icon( 'droplets', 'icon icon-xl' ); ?>
					</div>
				</div>

				<div class="activity-row__content">
					<span class="activity-row__season">Summer</span>
					<div class="activity-row__icon-wrap">
						<?php echo ski_club_icon( 'droplets', 'icon icon-lg' ); ?>
					</div>
					<h3 class="activity-row__title">Kayaking</h3>
					<p class="activity-row__desc">
						Summer paddles on the Potomac, Shenandoah, and local lakes give members a fresh way to experience the outdoors. Guided outings are available for beginners, while more experienced paddlers can tackle longer river routes with the group.
					</p>
				</div>

			</div><!-- .activity-row -->

			<!-- Row 4: Social Events (image right) -->
			<div class="activity-row activity-row--reverse">

				<div class="activity-row__image">
					<div class="activity-row__image-placeholder">
						<?php echo ski_club_icon( 'party-popper', 'icon icon-xl' ); ?>
					</div>
				</div>

				<div class="activity-row__content">
					<span class="activity-row__season">Year-Round</span>
					<div class="activity-row__icon-wrap">
						<?php echo ski_club_icon( 'party-popper', 'icon icon-lg' ); ?>
					</div>
					<h3 class="activity-row__title">Social Events</h3>
					<p class="activity-row__desc">
						The glue that holds everything together. Monthly club meetings, end-of-season celebrations, spring picnics, and holiday parties keep the LHSC community connected long after the ski season ends. New members are always welcomed at every event.
					</p>
				</div>

			</div><!-- .activity-row activity-row--reverse -->

		</div><!-- .activity-rows -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 4 — MONTHLY MEETINGS INFO CARD
   ========================================================================== */
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
				<span class="meetings-card__value">Third Thursday of Every Month</span>
				<span class="meetings-card__note">Doors open at 6:30 PM &mdash; meeting begins at 7:00 PM</span>
			</div>

			<div class="meetings-card__item">
				<span class="meetings-card__label">Time</span>
				<span class="meetings-card__value">7:00 PM</span>
				<span class="meetings-card__note">Typically 60&ndash;90 minutes</span>
			</div>

			<div class="meetings-card__item">
				<span class="meetings-card__label">Location</span>
				<span class="meetings-card__value">Ledo Pizza</span>
				<span class="meetings-card__note">Hagerstown, MD</span>
			</div>

			<div class="meetings-card__item">
				<span class="meetings-card__label">Who Can Attend</span>
				<span class="meetings-card__value">All Are Welcome</span>
				<span class="meetings-card__note">Members and prospective members encouraged to attend</span>
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
