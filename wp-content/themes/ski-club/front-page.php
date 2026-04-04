<?php
/**
 * Home page template.
 * Loads when a static front page is set in Settings → Reading.
 *
 * Sections:
 *   1. Hero            — full-viewport, Customizer image, CTA buttons
 *   2. Activities      — 4-card grid with inline SVG icons
 *   3. About blurb     — "More Than Just a Ski Club" card
 *   4. 2026 Ski Trips  — featured trip CPT cards
 *   5. Beyond Slopes   — 3 gallery images from Customizer
 *   6. CTA             — "Ready for Your Next Adventure?"
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php
/* ==========================================================================
   SECTION 1 — HERO
   ========================================================================== */

$hero_url   = ski_club_get_hero_image_url();
$hero_style = $hero_url ? ' style="background-image: url(' . esc_url( $hero_url ) . ');"' : '';
$hero_class = 'hero' . ( $hero_url ? '' : ' hero--no-image' );
?>

<section class="<?php echo esc_attr( $hero_class ); ?>"<?php echo $hero_style; ?>>
	<div class="hero-overlay"></div>
	<div class="hero-content container">
		<p class="hero-eyebrow">Little Heiskell Ski Club &middot; Est. 1967</p>
		<h1 class="hero-title">Adventure Awaits<br>on Every Slope</h1>
		<p class="hero-tagline">
			Join Maryland's premier ski club for world-class trips, year-round outdoor activities, and lifelong friendships.
		</p>
		<div class="hero-actions">
			<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="btn btn-white btn-lg">
				<?php echo ski_club_icon( 'mountain', 'icon' ); ?>
				View 2026 Trips
			</a>
			<a href="<?php echo esc_url( home_url( '/join' ) ); ?>" class="btn btn-outline-white btn-lg">
				<?php echo ski_club_icon( 'users', 'icon' ); ?>
				Become a Member
			</a>
		</div>
		<p class="hero-footer-note">Serving Maryland, West Virginia &amp; Pennsylvania</p>
	</div>
</section>


<?php
/* ==========================================================================
   SECTION 2 — YEAR-ROUND ACTIVITIES
   ========================================================================== */
?>

<section class="section bg-gray-50">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">What We Do</span>
			<h2 class="section-title">Year-Round Adventures</h2>
			<p class="section-subtitle">
				From winter slopes to summer trails, LHSC keeps you active and connected all year long.
			</p>
		</div>

		<div class="cards-grid cards-4">

			<!-- Skiing -->
			<div class="activity-card">
				<div class="activity-card__icon-wrap">
					<?php echo ski_club_icon( 'mountain', 'icon icon-lg' ); ?>
				</div>
				<h3 class="activity-card__title">Skiing &amp; Snowboarding</h3>
				<p class="activity-card__desc">
					Organized group ski trips to premier resorts across the US and Europe every winter season.
				</p>
			</div>

			<!-- Biking -->
			<div class="activity-card">
				<div class="activity-card__icon-wrap">
					<?php echo ski_club_icon( 'bike', 'icon icon-lg' ); ?>
				</div>
				<h3 class="activity-card__title">Biking</h3>
				<p class="activity-card__desc">
					Scenic group rides through the Blue Ridge Mountains and C&amp;O Canal trails each spring and summer.
				</p>
			</div>

			<!-- Kayaking -->
			<div class="activity-card">
				<div class="activity-card__icon-wrap">
					<?php echo ski_club_icon( 'droplets', 'icon icon-lg' ); ?>
				</div>
				<h3 class="activity-card__title">Kayaking</h3>
				<p class="activity-card__desc">
					Paddling adventures on local rivers and lakes, perfect for all skill levels throughout summer.
				</p>
			</div>

			<!-- Social Events -->
			<div class="activity-card">
				<div class="activity-card__icon-wrap">
					<?php echo ski_club_icon( 'party-popper', 'icon icon-lg' ); ?>
				</div>
				<h3 class="activity-card__title">Social Events</h3>
				<p class="activity-card__desc">
					Monthly club meetings, picnics, and celebrations that bring our community together year-round.
				</p>
			</div>

		</div><!-- .cards-grid -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 3 — ABOUT BLURB
   ========================================================================== */
?>

<section class="section">
	<div class="container">
		<div class="card about-blurb-card">
			<div class="card-body">
				<span class="section-eyebrow">About LHSC</span>
				<h2>More Than Just a Ski Club</h2>
				<p>
					Founded in 1967, the Little Heiskell Ski Club has been connecting outdoor enthusiasts across Maryland, West Virginia, and Pennsylvania for over five decades. What started as a small group of skiing devotees has grown into a vibrant community of 5,000+ members who share a passion for adventure in every season.
				</p>
				<p>
					As a proud member of the Blue Ridge Ski Council, we offer expertly organized group travel, exclusive resort partnerships, and the camaraderie of fellow adventurers who become lifelong friends.
				</p>
				<a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="link-arrow">
					Our Story
					<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>


<?php
/* ==========================================================================
   SECTION 4 — 2026 SKI TRIPS (featured CPT)
   ========================================================================== */

$featured_trips = new WP_Query( [
	'post_type'      => 'trip',
	'post_status'    => 'publish',
	'posts_per_page' => 6,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'meta_query'     => [
		[
			'key'     => 'trip_featured',
			'value'   => '1',
			'compare' => '=',
		],
	],
] );
?>

<section class="section bg-gray-50">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">Upcoming Adventures</span>
			<h2 class="section-title">2026 Ski Trips</h2>
			<p class="section-subtitle">
				Expertly planned group travel to world-class resorts. All transportation, lodging, and lift passes arranged.
			</p>
		</div>

		<?php if ( $featured_trips->have_posts() ) : ?>

			<div class="cards-grid cards-3">

				<?php while ( $featured_trips->have_posts() ) : $featured_trips->the_post(); ?>

					<?php
					$trip_id       = get_the_ID();
					$location      = ski_club_get_field( 'trip_location', $trip_id );
					$region        = ski_club_get_field( 'trip_region', $trip_id );
					$start_raw     = ski_club_get_field( 'trip_start_date', $trip_id );
					$end_raw       = ski_club_get_field( 'trip_end_date', $trip_id );
					$highlights    = ski_club_get_field( 'trip_highlights', $trip_id );
					$inquiry_text  = ski_club_get_field( 'trip_inquiry_text', $trip_id );
					$inquiry_url   = ski_club_get_field( 'trip_inquiry_url', $trip_id );

					// Format dates: ACF Date Picker returns Ymd, display as "M j, Y"
					$start_label = $start_raw ? date_i18n( 'M j', strtotime( $start_raw ) ) : '';
					$end_label   = $end_raw   ? date_i18n( 'M j, Y', strtotime( $end_raw ) ) : '';
					$dates_label = ( $start_label && $end_label ) ? $start_label . '&ndash;' . $end_label : '';

					$inquiry_text = $inquiry_text ?: 'Inquire Now';
					$inquiry_url  = $inquiry_url  ?: home_url( '/trips' );
					?>

					<article class="trip-card card-hover">

						<!-- Thumbnail -->
						<div class="trip-card__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'trip-card' ); ?>
							<?php else : ?>
								<div class="trip-card__image-placeholder">
									<?php echo ski_club_icon( 'mountain', 'icon icon-xl' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $location ) : ?>
								<div class="trip-card__badge">
									<span class="badge badge-primary"><?php echo esc_html( $location ); ?></span>
								</div>
							<?php endif; ?>
						</div><!-- .trip-card__image -->

						<!-- Body -->
						<div class="trip-card__body">

							<?php if ( $region ) : ?>
								<span class="trip-card__region">
									<?php echo ski_club_icon( 'map-pin', 'icon' ); ?>
									<?php echo esc_html( $region ); ?>
								</span>
							<?php endif; ?>

							<h3 class="trip-card__title"><?php the_title(); ?></h3>

							<?php if ( $dates_label ) : ?>
								<div class="trip-card__meta">
									<div class="trip-card__meta-item">
										<?php echo ski_club_icon( 'calendar', 'icon' ); ?>
										<?php echo $dates_label; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( $highlights ) :
								$lines = array_filter( array_map( 'trim', explode( "\n", $highlights ) ) );
								$lines = array_slice( $lines, 0, 3 );
								if ( $lines ) : ?>
									<ul class="trip-card__highlights">
										<?php foreach ( $lines as $line ) : ?>
											<li>
												<?php echo ski_club_icon( 'check', 'icon' ); ?>
												<?php echo esc_html( $line ); ?>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif;
							endif; ?>

						</div><!-- .trip-card__body -->

						<!-- Footer CTA -->
						<div class="trip-card__footer">
							<a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn-primary btn-sm">
								<?php echo esc_html( $inquiry_text ); ?>
								<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
							</a>
						</div>

					</article><!-- .trip-card -->

				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- .cards-grid -->

		<?php else : ?>

			<!-- No featured trips yet — direct to trips page -->
			<div class="text-center" style="padding-block: var(--space-10);">
				<p style="color: var(--color-gray-600); margin-bottom: var(--space-6);">
					Check back soon — our 2026 trip lineup is being finalized.
				</p>
				<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="btn btn-primary">
					View All Trips
					<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
				</a>
			</div>

		<?php endif; ?>

		<!-- "See all trips" link -->
		<?php if ( $featured_trips->found_posts > 0 ) : ?>
			<div class="text-center" style="margin-top: var(--space-10);">
				<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="btn btn-outline-primary">
					View All Trips
					<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 5 — BEYOND THE SLOPES (gallery)
   ========================================================================== */

$gallery_items = [
	1 => [ 'label' => 'Biking',        'icon' => 'bike' ],
	2 => [ 'label' => 'Kayaking',      'icon' => 'droplets' ],
	3 => [ 'label' => 'Social Events', 'icon' => 'party-popper' ],
];
?>

<section class="section bg-gray-900" style="color: var(--color-white);">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow" style="color: var(--color-accent);">More to Explore</span>
			<h2 class="section-title" style="color: var(--color-white);">Beyond the Slopes</h2>
			<p class="section-subtitle" style="color: rgba(255,255,255,0.7);">
				Four seasons of adventure with people who love the outdoors as much as you do.
			</p>
		</div>

		<div class="gallery-grid">

			<?php foreach ( $gallery_items as $index => $item ) :
				$img_url = ski_club_get_gallery_image_url( $index );
			?>

				<div class="gallery-item">

					<?php if ( $img_url ) : ?>
						<img src="<?php echo esc_url( $img_url ); ?>"
						     alt="<?php echo esc_attr( $item['label'] ); ?>"
						     loading="lazy">
					<?php else : ?>
						<div class="gallery-item--placeholder" style="min-height: 280px;">
							<p><?php echo esc_html( $item['label'] ); ?><br><small>Upload via Customizer</small></p>
						</div>
					<?php endif; ?>

					<div class="gallery-item__overlay">
						<span class="gallery-item__label">
							<?php echo ski_club_icon( $item['icon'], 'icon' ); ?>
							<?php echo esc_html( $item['label'] ); ?>
						</span>
					</div>

				</div><!-- .gallery-item -->

			<?php endforeach; ?>

		</div><!-- .gallery-grid -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 6 — CTA
   ========================================================================== */
?>

<section class="cta-section cta-section--primary">
	<div class="container">
		<div class="cta-inner">
			<h2 class="cta-title">Ready for Your Next Adventure?</h2>
			<p class="cta-subtitle">
				Join hundreds of members who explore the world's best slopes — and much more — with Little Heiskell Ski Club.
			</p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( home_url( '/join' ) ); ?>" class="btn btn-white btn-lg">
					<?php echo ski_club_icon( 'users', 'icon' ); ?>
					Become a Member
				</a>
				<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="btn btn-outline-white btn-lg">
					<?php echo ski_club_icon( 'mountain', 'icon' ); ?>
					View 2026 Trips
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
