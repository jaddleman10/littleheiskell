<footer class="site-footer">
	<div class="container footer-grid">

		<!-- Column 1: Branding -->
		<div class="footer-brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo" aria-label="Home">
				<span class="footer-logo__mark"><?php echo ski_club_icon( 'mountain', 'icon icon-footer-logo' ); ?></span>
				<span class="footer-logo__text">LHSC</span>
			</a>
			<p class="footer-tagline">Little Heiskell Ski Club</p>
			<p class="footer-est">Est. 1967 &middot; Hagerstown, MD</p>
			<p class="footer-council">Member of the Blue Ridge Ski Council</p>
		</div>

		<!-- Column 2: Quick Links -->
		<div class="footer-col">
			<h4 class="footer-heading">Quick Links</h4>
			<ul class="footer-links" role="list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a></li>
				<li><a href="<?php echo esc_url( home_url( '/trips' ) ); ?>">Trips</a></li>
				<li><a href="<?php echo esc_url( home_url( '/events' ) ); ?>">Events</a></li>
				<li><a href="<?php echo esc_url( home_url( '/join' ) ); ?>">Join</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
			</ul>
		</div>

		<!-- Column 3: Activities -->
		<div class="footer-col">
			<h4 class="footer-heading">Activities</h4>
			<ul class="footer-links" role="list">
				<li>Skiing &amp; Snowboarding</li>
				<li>Biking</li>
				<li>Kayaking</li>
				<li>Social Events</li>
				<li>Group Travel</li>
			</ul>
		</div>

		<!-- Column 4: Contact -->
		<div class="footer-col">
			<h4 class="footer-heading">Contact</h4>
			<address class="footer-address">
				<p>Hagerstown, MD</p>
				<p>Serving MD, WV &amp; PA</p>
				<p>
					<a href="mailto:info@littleheiskellskiclub.org">
						info@littleheiskellskiclub.org
					</a>
				</p>
			</address>
		</div>

	</div><!-- .footer-grid -->

	<div class="footer-bottom">
		<div class="container footer-bottom__inner">
			<p class="footer-copyright">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Little Heiskell Ski Club. All rights reserved.
			</p>
			<p class="footer-member">
				Member of the
				<a href="https://www.blueridgeskicouncil.org" target="_blank" rel="noopener noreferrer">
					Blue Ridge Ski Council
				</a>
			</p>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
