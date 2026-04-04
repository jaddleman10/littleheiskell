<?php
/**
 * Join page template — matched by slug "join".
 * Placeholder until membership application is built.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="page-placeholder">
	<div><?php echo ski_club_icon( 'users', 'icon icon-xl' ); ?></div>
	<h1>Join</h1>
	<p>Membership applications are coming soon. Check back shortly!</p>
	<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
		<?php echo ski_club_icon( 'arrow-right', 'icon' ); ?>
		Contact Us in the Meantime
	</a>
</main>

<?php get_footer(); ?>
