<?php
/**
 * Trips page template — matched by slug "trips".
 *
 * Sections:
 *   1. Hero             — "2026 Ski Season"
 *   2. Trip cards       — WP_Query ALL published trips (full-width cards)
 *   3. Service Overview — 3 hardcoded service cards
 *   4. Past Destinations — destination badge tags
 *   5. CTA              — "Ready to Hit the Slopes?"
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>


<?php
/* ==========================================================================
   SECTION 1 — PAGE HERO
   ========================================================================== */
?>

<section class="page-hero">
	<div class="container">
		<p class="page-hero__eyebrow">Group Travel</p>
		<h1 class="page-hero__title">2026 Ski Season</h1>
		<p class="page-hero__subtitle">
			Expertly planned trips to world-class resorts. Transportation, lodging, and lift passes — all taken care of.
		</p>
	</div>
</section>


<?php
/* ==========================================================================
   SECTION 2 — TRIP CARDS (all published trips)
   ========================================================================== */

$trips_query = new WP_Query( [
	'post_type'      => 'trip',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
] );
?>

<section class="section">
	<div class="container">

		<?php if ( $trips_query->have_posts() ) : ?>

			<div class="trips-list">

				<?php while ( $trips_query->have_posts() ) : $trips_query->the_post(); ?>

					<?php
					$trip_id      = get_the_ID();
					$location     = ski_club_get_field( 'trip_location', $trip_id );
					$region       = ski_club_get_field( 'trip_region', $trip_id );
					$start_raw    = ski_club_get_field( 'trip_start_date', $trip_id );
					$end_raw      = ski_club_get_field( 'trip_end_date', $trip_id );
					$highlights   = ski_club_get_field( 'trip_highlights', $trip_id );
					$inquiry_text = ski_club_get_field( 'trip_inquiry_text', $trip_id );
					$inquiry_url  = ski_club_get_field( 'trip_inquiry_url', $trip_id );
					$featured     = ski_club_get_field( 'trip_featured', $trip_id );

					$start_label = $start_raw ? date_i18n( 'M j', strtotime( $start_raw ) ) : '';
					$end_label   = $end_raw   ? date_i18n( 'M j, Y', strtotime( $end_raw ) ) : '';
					$dates_label = ( $start_label && $end_label ) ? $start_label . '&ndash;' . $end_label : '';

					$inquiry_text = $inquiry_text ?: 'Inquire Now';
					$inquiry_url  = $inquiry_url  ?: home_url( '/contact' );

					$highlight_lines = $highlights
						? array_filter( array_map( 'trim', explode( "\n", $highlights ) ) )
						: [];
					?>

					<article class="trip-full-card">

						<!-- Image -->
						<div class="trip-full-card__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'trip-card' ); ?>
							<?php else : ?>
								<div class="trip-full-card__image-placeholder">
									<?php echo ski_club_icon( 'mountain', 'icon icon-xl' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $featured ) : ?>
								<div class="trip-full-card__badge">
									<span class="badge badge-primary">Featured</span>
								</div>
							<?php endif; ?>
						</div><!-- .trip-full-card__image -->

						<!-- Body -->
						<div class="trip-full-card__body">

							<?php if ( $region ) : ?>
								<span class="trip-full-card__region">
									<?php echo ski_club_icon( 'map-pin', 'icon' ); ?>
									<?php echo esc_html( $region ); ?>
								</span>
							<?php endif; ?>

							<h2 class="trip-full-card__title"><?php the_title(); ?></h2>

							<div class="trip-full-card__meta">
								<?php if ( $dates_label ) : ?>
									<div class="trip-full-card__meta-item">
										<?php echo ski_club_icon( 'calendar', 'icon' ); ?>
										<?php echo $dates_label; ?>
									</div>
								<?php endif; ?>
								<?php if ( $location ) : ?>
									<div class="trip-full-card__meta-item">
										<?php echo ski_club_icon( 'map-pin', 'icon' ); ?>
										<?php echo esc_html( $location ); ?>
									</div>
								<?php endif; ?>
							</div><!-- .trip-full-card__meta -->

							<?php if ( $highlight_lines ) : ?>
								<ul class="trip-full-card__highlights">
									<?php foreach ( $highlight_lines as $line ) : ?>
										<li>
											<?php echo ski_club_icon( 'check', 'icon' ); ?>
											<?php echo esc_html( $line ); ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<div class="trip-full-card__footer">
								<a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn-primary">
									<?php echo ski_club_icon( 'plane', 'icon' ); ?>
									<?php echo esc_html( $inquiry_text ); ?>
								</a>
							</div>

						</div><!-- .trip-full-card__body -->

					</article><!-- .trip-full-card -->

				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- .trips-list -->

		<?php else : ?>

			<div class="text-center" style="padding-block: var(--space-16);">
				<div style="margin-bottom: var(--space-6); color: var(--color-gray-400);">
					<?php echo ski_club_icon( 'mountain', 'icon icon-xl' ); ?>
				</div>
				<h2 style="font-size: var(--font-size-2xl); margin-bottom: var(--space-4);">Trips Coming Soon</h2>
				<p style="color: var(--color-gray-600); margin-bottom: var(--space-6);">
					Our 2026 trip lineup is being finalized. Check back soon or contact us to express your interest.
				</p>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
					Contact Us
					<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
				</a>
			</div>

		<?php endif; ?>

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 3 — SERVICE OVERVIEW
   ========================================================================== */
?>

<section class="section bg-gray-50">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">What's Included</span>
			<h2 class="section-title">Everything Arranged for You</h2>
			<p class="section-subtitle">
				We handle the logistics so you can focus on the mountain.
			</p>
		</div>

		<div class="service-grid">

			<!-- Travel Arrangements -->
			<div class="service-card">
				<div class="service-card__icon">
					<?php echo ski_club_icon( 'plane', 'icon icon-lg' ); ?>
				</div>
				<h3 class="service-card__title">Travel Arrangements</h3>
				<p class="service-card__desc">
					Coordinated group transportation — from charter buses to flight bookings — so every member travels together and on time.
				</p>
			</div>

			<!-- Group Accommodations -->
			<div class="service-card">
				<div class="service-card__icon">
					<?php echo ski_club_icon( 'hotel', 'icon icon-lg' ); ?>
				</div>
				<h3 class="service-card__title">Group Accommodations</h3>
				<p class="service-card__desc">
					Negotiated rates at ski-in/ski-out lodges and resort hotels, keeping the whole group together and close to the slopes.
				</p>
			</div>

			<!-- Lift Passes -->
			<div class="service-card">
				<div class="service-card__icon">
					<?php echo ski_club_icon( 'ticket', 'icon icon-lg' ); ?>
				</div>
				<h3 class="service-card__title">Lift Passes</h3>
				<p class="service-card__desc">
					Group-rate lift tickets and resort passes included with every trip package — no waiting in ticket lines on arrival day.
				</p>
			</div>

		</div><!-- .service-grid -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 4 — PAST DESTINATIONS
   ========================================================================== */
?>

<section class="section">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">Where We've Been</span>
			<h2 class="section-title">Past Destinations</h2>
			<p class="section-subtitle">
				Over 57 years we've taken members to some of the world's most celebrated ski resorts.
			</p>
		</div>

		<div class="past-destinations">
			<div class="destination-tags">
				<span class="destination-tag">Timberline, WV</span>
				<span class="destination-tag">Jay Peak, VT</span>
				<span class="destination-tag">Zermatt, Switzerland</span>
				<span class="destination-tag">Whistler, BC</span>
				<span class="destination-tag">Steamboat Springs, CO</span>
				<span class="destination-tag">Park City, UT</span>
				<span class="destination-tag">Verbier, Switzerland</span>
				<span class="destination-tag">Vail, CO</span>
				<span class="destination-tag">Snowshoe, WV</span>
				<span class="destination-tag">Killington, VT</span>
				<span class="destination-tag">Stowe, VT</span>
				<span class="destination-tag">Taos, NM</span>
			</div>
		</div>

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
			<h2 class="cta-title">Ready to Hit the Slopes?</h2>
			<p class="cta-subtitle">
				Members get first access to trip reservations and group-rate pricing. Join today and claim your spot.
			</p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( home_url( '/join' ) ); ?>" class="btn btn-white btn-lg">
					<?php echo ski_club_icon( 'users', 'icon' ); ?>
					Become a Member
				</a>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-outline-white btn-lg">
					<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
					Contact Us
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
