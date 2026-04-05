<?php
/**
 * Contact page template — matched by slug "contact".
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-hero">
	<div class="container">
		<p class="page-hero__eyebrow">Get in Touch</p>
		<h1 class="page-hero__title">Contact Us</h1>
		<p class="page-hero__subtitle">
			Reach out to the right person directly — click any position to send an email.
		</p>
	</div>
</section>

<section class="section">
	<div class="container">

		<div class="card" style="max-width: 640px; margin-inline: auto;">
			<div class="card-body" style="padding: 0;">

				<?php
				$contacts = [
					[ 'position' => 'President',      'name' => 'Carol Carbaugh', 'email' => 'VP@LittleHeiskellSkiClub.com' ],
					[ 'position' => 'Vice President', 'name' => 'Gwen Hard',      'email' => 'President@LittleHeiskellSkiClub.com' ],
					[ 'position' => 'Membership',     'name' => 'Kathy Sortore',  'email' => 'info@LittleheiskellSkiClub.com' ],
					[ 'position' => 'Treasurer',      'name' => 'Anita Wade',     'email' => 'Treasurer@LittleHeiskellSkiClub.com' ],
					[ 'position' => 'Secretary',      'name' => 'Vicki Martin',   'email' => 'Secretary@LittleHeiskellSkiClub.com' ],
					[ 'position' => 'Newsletter',     'name' => 'Sherry Itnyre',  'email' => 'Newsletter@LittleHeiskellSkiCLub.com' ],
					[ 'position' => 'Website',        'name' => 'Betsy Klein',    'email' => 'Website@LittleHeiskellSkiClub.com' ],
				];
				?>

				<table style="width: auto; border-collapse: collapse; font-size: var(--font-size-sm);">
					<?php foreach ( $contacts as $i => $c ) :
						$border = $i > 0 ? 'border-top: 1px solid var(--color-gray-100);' : '';
					?>
					<tr style="<?php echo $border; ?>">
						<td style="padding: var(--space-4) var(--space-6) var(--space-4) var(--space-6); white-space: nowrap;">
							<a href="mailto:<?php echo esc_attr( $c['email'] ); ?>"
							   style="font-weight: 600; color: var(--color-primary); text-decoration: none; transition: color 0.15s;"
							   onmouseover="this.style.color='var(--color-primary-dark)'"
							   onmouseout="this.style.color='var(--color-primary)'">
								<?php echo esc_html( $c['position'] ); ?>
							</a>
						</td>
						<td style="padding: var(--space-4) var(--space-6) var(--space-4) 0; color: var(--color-gray-600); white-space: nowrap;">
							<?php echo esc_html( $c['name'] ); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</table><?php // end contacts table ?>

			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>
