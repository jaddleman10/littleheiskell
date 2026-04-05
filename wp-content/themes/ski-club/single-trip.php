<?php
/**
 * Single trip detail page.
 * Loaded automatically by WordPress for any individual `trip` post.
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( ! have_posts() ) {
	wp_redirect( home_url( '/trips' ) );
	exit;
}

the_post();

$trip_id      = get_the_ID();
$location     = ski_club_get_field( 'trip_location',   $trip_id );
$region       = ski_club_get_field( 'trip_region',     $trip_id );
$start_raw    = ski_club_get_field( 'trip_start_date', $trip_id );
$end_raw      = ski_club_get_field( 'trip_end_date',   $trip_id );
$highlights   = ski_club_get_field( 'trip_highlights', $trip_id );
$inquiry_text = ski_club_get_field( 'trip_inquiry_text', $trip_id ) ?: 'Inquire About This Trip';
$inquiry_url  = ski_club_get_field( 'trip_inquiry_url',  $trip_id ) ?: home_url( '/contact' );

$start_label = $start_raw ? date_i18n( 'F j', strtotime( $start_raw ) ) : '';
$end_label   = $end_raw   ? date_i18n( 'F j, Y', strtotime( $end_raw ) ) : '';
$dates_label = ( $start_label && $end_label ) ? $start_label . '&ndash;' . $end_label : '';

$highlight_lines = $highlights
	? array_filter( array_map( 'trim', explode( "\n", $highlights ) ) )
	: [];
?>


<?php /* ── Hero ── */ ?>
<section class="page-hero" <?php if ( has_post_thumbnail() ) : ?>style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( null, 'hero-full' ) ); ?>); background-size: cover; background-position: center; position: relative;"<?php endif; ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div style="position: absolute; inset: 0; background: var(--color-overlay);"></div>
		<div class="container" style="position: relative; z-index: 1;">
	<?php else : ?>
		<div class="container">
	<?php endif; ?>

		<?php if ( $region ) : ?>
			<p class="page-hero__eyebrow"><?php echo esc_html( $region ); ?></p>
		<?php endif; ?>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
		<?php if ( $dates_label ) : ?>
			<p class="page-hero__subtitle"><?php echo $dates_label; ?></p>
		<?php endif; ?>
	</div>
</section>


<?php /* ── Main content ── */ ?>
<section class="section">
	<div class="container">

		<div style="display: grid; grid-template-columns: 1fr 320px; gap: var(--space-12); align-items: start;">

			<?php /* ── Left: post content + highlights ── */ ?>
			<div>

				<?php /* Back link */ ?>
				<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="link-arrow" style="display: inline-flex; margin-bottom: var(--space-8); flex-direction: row-reverse; gap: var(--space-2);">
					<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
					Back to All Trips
				</a>

				<?php if ( get_the_content() ) : ?>
					<div style="color: var(--color-gray-600); line-height: 1.8; margin-bottom: var(--space-8);">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<?php if ( $highlight_lines ) : ?>
					<h2 style="font-size: var(--font-size-xl); font-weight: 700; margin-bottom: var(--space-4);">Trip Highlights</h2>
					<ul class="trip-card__highlights" style="gap: var(--space-3);">
						<?php foreach ( $highlight_lines as $line ) : ?>
							<li>
								<?php echo ski_club_icon( 'check', 'icon' ); ?>
								<?php echo esc_html( $line ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

			</div>

			<?php /* ── Right: summary card ── */ ?>
			<div class="card" style="position: sticky; top: calc(var(--header-height) + var(--space-6));">
				<div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-4);">

					<h3 style="font-size: var(--font-size-lg); font-weight: 700; margin: 0;">Trip Details</h3>

					<?php if ( $dates_label ) : ?>
						<div style="display: flex; align-items: center; gap: var(--space-2); font-size: var(--font-size-sm); color: var(--color-gray-600);">
							<?php echo ski_club_icon( 'calendar', 'icon' ); ?>
							<?php echo $dates_label; ?>
						</div>
					<?php endif; ?>

					<?php if ( $location ) : ?>
						<div style="display: flex; align-items: center; gap: var(--space-2); font-size: var(--font-size-sm); color: var(--color-gray-600);">
							<?php echo ski_club_icon( 'map-pin', 'icon' ); ?>
							<?php echo esc_html( $location ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $region ) : ?>
						<div style="display: flex; align-items: center; gap: var(--space-2); font-size: var(--font-size-sm); color: var(--color-gray-600);">
							<?php echo ski_club_icon( 'plane', 'icon' ); ?>
							<?php echo esc_html( $region ); ?>
						</div>
					<?php endif; ?>

					<hr style="border: none; border-top: 1px solid var(--color-gray-100); margin: var(--space-2) 0;">

					<a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn-primary" style="width: 100%; justify-content: center;">
						<?php echo ski_club_icon( 'plane', 'icon' ); ?>
						<?php echo esc_html( $inquiry_text ); ?>
					</a>

					<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>" class="btn btn-outline-primary" style="width: 100%; justify-content: center;">
						View All Trips
					</a>

				</div>
			</div>

		</div>

	</div>
</section>


<?php /* ── CTA ── */ ?>
<section class="cta-section cta-section--primary">
	<div class="container">
		<div class="cta-inner">
			<h2 class="cta-title">Ready to Book?</h2>
			<p class="cta-subtitle">Members get first access and group-rate pricing. Join today to claim your spot.</p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn-white btn-lg">
					<?php echo ski_club_icon( 'plane', 'icon' ); ?>
					<?php echo esc_html( $inquiry_text ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/join' ) ); ?>" class="btn btn-outline-white btn-lg">
					<?php echo ski_club_icon( 'users', 'icon' ); ?>
					Become a Member
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
