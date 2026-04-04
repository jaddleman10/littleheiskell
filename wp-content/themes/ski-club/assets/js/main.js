(function () {
	'use strict';

	/* -------------------------------------------------------------------------
	   1. Mobile nav toggle
	------------------------------------------------------------------------- */
	var toggle = document.getElementById('nav-toggle');
	var menu   = document.getElementById('nav-menu');

	if (toggle && menu) {
		toggle.addEventListener('click', function () {
			var isOpen = menu.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', String(isOpen));
		});

		// Close when clicking outside the nav
		document.addEventListener('click', function (e) {
			if (!toggle.contains(e.target) && !menu.contains(e.target)) {
				menu.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});

		// Close on Escape key
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && menu.classList.contains('is-open')) {
				menu.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
				toggle.focus();
			}
		});
	}

	/* -------------------------------------------------------------------------
	   2. Sticky header — add .scrolled class for enhanced shadow
	------------------------------------------------------------------------- */
	var header = document.getElementById('site-header');

	if (header) {
		function onScroll() {
			header.classList.toggle('scrolled', window.scrollY > 20);
		}
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll(); // run once on load in case page is already scrolled
	}

	/* -------------------------------------------------------------------------
	   3. Smooth scroll for same-page anchor links
	------------------------------------------------------------------------- */
	document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
		anchor.addEventListener('click', function (e) {
			var targetId = this.getAttribute('href');
			if (targetId === '#') return;
			var target = document.querySelector(targetId);
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
		});
	});

}());
