<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
	<nav class="site-nav container" aria-label="Primary navigation">

		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php bloginfo( 'name' ); ?> — Home">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="logo-mark"><?php echo ski_club_icon( 'mountain', 'icon icon-logo' ); ?></span>
				<span class="logo-text">LHSC</span>
			<?php endif; ?>
		</a>

		<!-- Primary nav links -->
		<ul class="nav-menu" id="nav-menu" role="list">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				   class="nav-link<?php echo is_front_page() ? ' nav-link--active' : ''; ?>">
					Home
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/about' ) ); ?>"
				   class="nav-link<?php echo is_page( 'about' ) ? ' nav-link--active' : ''; ?>">
					About
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/trips' ) ); ?>"
				   class="nav-link<?php echo is_page( 'trips' ) ? ' nav-link--active' : ''; ?>">
					Trips
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/events' ) ); ?>"
				   class="nav-link<?php echo is_page( 'events' ) ? ' nav-link--active' : ''; ?>">
					Events
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/join' ) ); ?>"
				   class="nav-link<?php echo is_page( 'join' ) ? ' nav-link--active' : ''; ?>">
					Join
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
				   class="nav-link<?php echo is_page( 'contact' ) ? ' nav-link--active' : ''; ?>">
					Contact
				</a>
			</li>
		</ul>

		<!-- CTA button (hidden on mobile, shown via CSS at ≥ 768px) -->
		<a href="<?php echo esc_url( home_url( '/join' ) ); ?>" class="btn btn-primary nav-cta">
			Apply Now
		</a>

		<!-- Hamburger toggle (visible only on mobile) -->
		<button
			class="nav-toggle"
			id="nav-toggle"
			aria-label="Toggle navigation"
			aria-expanded="false"
			aria-controls="nav-menu"
		>
			<span class="nav-toggle__open"><?php echo ski_club_icon( 'menu', 'icon' ); ?></span>
			<span class="nav-toggle__close"><?php echo ski_club_icon( 'x', 'icon' ); ?></span>
		</button>

	</nav>
</header>
