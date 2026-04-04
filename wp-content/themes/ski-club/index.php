<?php
/**
 * Fallback template — WordPress requires this file to exist.
 * In normal operation this is never rendered; front-page.php,
 * page-{slug}.php, and single-trip.php handle all routes.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="container" style="padding-top: var(--space-20); padding-bottom: var(--space-20);">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<div><?php the_content(); ?></div>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found.', 'ski-club' ); ?></p>
	<?php endif; ?>
</main>

<?php get_footer();
