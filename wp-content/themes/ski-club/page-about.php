<?php
/**
 * About page template — matched by slug "about".
 *
 * Sections:
 *   1. Hero         — "A Legacy of Adventure Since 1967"
 *   2. Stats grid   — 4 milestone cards
 *   3. Our History  — 2-column: text left, image placeholder right
 *   4. Legend       — full-width origin story card
 *   5. BRSC         — Blue Ridge Ski Council blurb + external link
 *   6. CTA          — "Join Our Community"
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
		<p class="page-hero__eyebrow">Our Story</p>
		<h1 class="page-hero__title">A Legacy of Adventure Since 1967</h1>
		<p class="page-hero__subtitle">
			Over five decades of bringing outdoor enthusiasts together across Maryland, West Virginia, and Pennsylvania.
		</p>
	</div>
</section>


<?php
/* ==========================================================================
   SECTION 2 — STATS GRID
   ========================================================================== */
?>

<section class="section bg-gray-50">
	<div class="container">

		<div class="stats-grid">

			<!-- Founded -->
			<div class="stat-card">
				<div class="stat-card__icon">
					<?php echo ski_club_icon( 'calendar', 'icon icon-lg' ); ?>
				</div>
				<span class="stat-card__value">1967</span>
				<span class="stat-card__label">Year Founded</span>
			</div>

			<!-- Members -->
			<div class="stat-card">
				<div class="stat-card__icon">
					<?php echo ski_club_icon( 'users', 'icon icon-lg' ); ?>
				</div>
				<span class="stat-card__value">5,000+</span>
				<span class="stat-card__label">Members &amp; Alumni</span>
			</div>

			<!-- States served -->
			<div class="stat-card">
				<div class="stat-card__icon">
					<?php echo ski_club_icon( 'map-pin', 'icon icon-lg' ); ?>
				</div>
				<span class="stat-card__value">3</span>
				<span class="stat-card__label">States Served</span>
			</div>

			<!-- Years of adventure -->
			<div class="stat-card">
				<div class="stat-card__icon">
					<?php echo ski_club_icon( 'award', 'icon icon-lg' ); ?>
				</div>
				<span class="stat-card__value">57+</span>
				<span class="stat-card__label">Years of Adventure</span>
			</div>

		</div><!-- .stats-grid -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 3 — OUR HISTORY
   ========================================================================== */
?>

<section class="section">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">How It Started</span>
			<h2 class="section-title">Our History</h2>
		</div>

		<div class="history-cols">

			<!-- Text: 3 paragraphs -->
			<div class="history-text">
				<p>
					The Little Heiskell Ski Club was born in the winter of 1967 when a small group of skiing enthusiasts from Hagerstown, Maryland decided to pool their resources and organize a group trip to a local ski resort. What began as a handful of friends carpooling to the slopes quickly grew into a formal club with elected officers and a growing membership list.
				</p>
				<p>
					Throughout the 1970s and 1980s, the club expanded its reach, organizing trips to iconic destinations along the East Coast and eventually venturing to the Rocky Mountains and European Alps. Membership swelled as word spread about the affordable, expertly organized getaways that LHSC provided — complete with transportation, lodging, and lift passes arranged for every participant.
				</p>
				<p>
					Today, the club offers far more than ski trips. A full calendar of year-round activities — biking, kayaking, social gatherings, and monthly meetings — ensures that members stay connected and active every season. The same spirit of adventure and community that launched LHSC in 1967 continues to define who we are more than half a century later.
				</p>
			</div>

			<!-- Image placeholder -->
			<div class="history-image">
				<div class="history-image-placeholder">
					<p>Club history photo<br><small>Upload via Media Library</small></p>
				</div>
			</div>

		</div><!-- .history-cols -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 4 — LEGEND OF LITTLE HEISKELL
   ========================================================================== */
?>

<section class="section bg-gray-50">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">The Legend</span>
			<h2 class="section-title">The Legend of Little Heiskell</h2>
		</div>

		<div class="legend-card card">
			<div class="card-body">
				<h3 class="legend-card__title">Who Was Little Heiskell?</h3>
				<div class="legend-card__text">
					<p>
						The name "Little Heiskell" traces its roots to a colorful character of Hagerstown folklore — a spirited, adventurous soul who was said to roam the surrounding mountains long before ski resorts were a glimmer in anyone's eye. According to local legend, Little Heiskell was a trapper and outdoorsman of remarkable skill, equally comfortable navigating deep snow, rushing rivers, or the dense forests of the Appalachian foothills.
					</p>
					<p>
						When the founding members gathered to name their new club, they chose this legendary figure as a nod to the region's heritage and to the free-spirited, adventurous attitude they wanted their organization to embody. The name was a reminder that the love of the outdoors runs deep in the tri-state area — and that the best adventures are always shared with good company.
					</p>
					<p>
						Whether the legend is entirely true is left to the imagination. What is certain is that the Little Heiskell Ski Club has more than lived up to its namesake's reputation for bold adventure and a deep connection to the natural world.
					</p>
				</div>
			</div>
		</div><!-- .legend-card -->

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 5 — BLUE RIDGE SKI COUNCIL
   ========================================================================== */
?>

<section class="section">
	<div class="container">

		<div class="section-header">
			<span class="section-eyebrow">Our Affiliation</span>
			<h2 class="section-title">Blue Ridge Ski Council</h2>
		</div>

		<div class="brsc-section">
			<p>
				The Little Heiskell Ski Club is a proud member of the <strong>Blue Ridge Ski Council</strong>, a regional alliance of ski clubs serving the mid-Atlantic and Appalachian region. Membership in the BRSC gives our members access to discounted lift tickets, coordinated multi-club events, and a broader network of fellow ski and outdoor enthusiasts.
			</p>
			<p>
				The council represents dozens of clubs across Maryland, Virginia, West Virginia, Pennsylvania, and the Carolinas — working together to promote skiing, snowboarding, and winter recreation throughout the region.
			</p>
			<a
				href="https://www.blueridgeskicouncil.org"
				target="_blank"
				rel="noopener noreferrer"
				class="btn btn-outline-primary"
			>
				<?php echo ski_club_icon( 'external-link', 'icon' ); ?>
				Visit BlueRidgeSkiCouncil.org
			</a>
		</div>

	</div>
</section>


<?php
/* ==========================================================================
   SECTION 6 — CTA
   ========================================================================== */
?>

<section class="cta-section cta-section--dark">
	<div class="container">
		<div class="cta-inner">
			<h2 class="cta-title">Join Our Community</h2>
			<p class="cta-subtitle">
				Become part of a tradition that's been connecting adventurers since 1967. New members are always welcome.
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
