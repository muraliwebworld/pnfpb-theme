/**
 * PNFPB Theme — Main JS
 *
 * General site JavaScript:
 * - Smooth scroll for anchor links
 * - Header scroll shrink on scroll
 * - Contact form AJAX submission
 * - Lazy image loading polyfill (for older browsers)
 * - Skip-link fix for Safari
 */
( function () {
	'use strict';

	/* ── Smooth-scroll for hash links ──────────────────────────────── */
	function initSmoothScroll() {
		document.querySelectorAll( 'a[href^="#"]' ).forEach( function ( link ) {
			link.addEventListener( 'click', function ( e ) {
				var href   = link.getAttribute( 'href' );
				var target = href && href.length > 1 ? document.querySelector( href ) : null;
				if ( ! target ) return;
				e.preventDefault();
				target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
				// Set focus for accessibility.
				if ( ! target.hasAttribute( 'tabindex' ) ) {
					target.setAttribute( 'tabindex', '-1' );
				}
				target.focus( { preventScroll: true } );
			} );
		} );
	}

	/* ── Header shrink on scroll ────────────────────────────────────── */
	function initHeaderScroll() {
		var header    = document.getElementById( 'masthead' );
		var threshold = 80;

		if ( ! header ) return;

		var ticking = false;
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				window.requestAnimationFrame( function () {
					header.classList.toggle( 'pnfpb-header--scrolled', window.scrollY > threshold );
					ticking = false;
				} );
				ticking = true;
			}
		}, { passive: true } );
	}

	/* ── Contact form AJAX ──────────────────────────────────────────── */
	function initContactForm() {
		var form = document.getElementById( 'pnfpb-contact-form' );
		if ( ! form ) return;

		form.addEventListener( 'submit', function ( e ) {
			e.preventDefault();
			submitContactForm( form );
		} );
	}

	/**
	 * Submit the contact form via fetch/AJAX.
	 * @param {HTMLFormElement} form
	 */
	function submitContactForm( form ) {
		var submitBtn   = form.querySelector( '#pnfpb-contact-submit' );
		var responseEl  = document.getElementById( 'pnfpb-contact-response' );
		var btnText     = submitBtn.querySelector( '.pnfpb-btn-text' );
		var btnLoading  = submitBtn.querySelector( '.pnfpb-btn-loading' );

		// Disable button, show loading state.
		submitBtn.disabled = true;
		if ( btnText )    btnText.hidden    = true;
		if ( btnLoading ) btnLoading.hidden = false;

		var data = new FormData( form );
		data.append( 'action', 'pnfpb_contact_form' );

		fetch( pnfpbThemeData.ajaxUrl, {
			method:      'POST',
			credentials: 'same-origin',
			body:        data,
		} )
		.then( function ( response ) {
			if ( ! response.ok ) {
				throw new Error( 'Network error' );
			}
			return response.json();
		} )
		.then( function ( json ) {
			showFormResponse( responseEl, json.success, json.data && json.data.message );
			if ( json.success ) {
				form.reset();
			}
		} )
		.catch( function () {
			showFormResponse( responseEl, false, pnfpbThemeData.i18n.serverError || 'A server error occurred. Please try again.' );
		} )
		.finally( function () {
			submitBtn.disabled = false;
			if ( btnText )    btnText.hidden    = false;
			if ( btnLoading ) btnLoading.hidden = true;
		} );
	}

	/**
	 * Display a success or error message for the contact form.
	 *
	 * @param {Element} el      The response container element.
	 * @param {boolean} success Whether it's a success message.
	 * @param {string}  message The message text.
	 */
	function showFormResponse( el, success, message ) {
		if ( ! el || ! message ) return;
		el.className  = 'pnfpb-contact-response pnfpb-notice pnfpb-notice--' + ( success ? 'success' : 'error' );
		el.textContent = message;
		el.hidden     = false;
		el.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
		el.focus();
	}

	/* ── Native lazy-loading polyfill ──────────────────────────────── */
	function initLazyLoad() {
		if ( 'loading' in HTMLImageElement.prototype ) return; // native support
		document.querySelectorAll( 'img[loading="lazy"]' ).forEach( function ( img ) {
			img.src = img.dataset.src || img.src;
		} );
	}

	/* ── Skip link focus fix for Safari ────────────────────────────── */
	function initSkipLink() {
		var skipLink = document.querySelector( '.skip-link' );
		if ( ! skipLink ) return;
		skipLink.addEventListener( 'click', function () {
			var target = document.querySelector( skipLink.getAttribute( 'href' ) );
			if ( target ) {
				target.setAttribute( 'tabindex', '-1' );
				target.focus();
			}
		} );
	}

	/* ── Back-to-top button ─────────────────────────────────────────── */
	function initBackToTop() {
		var btn = document.querySelector( '.pnfpb-back-to-top' );
		if ( ! btn ) return;

		window.addEventListener( 'scroll', function () {
			btn.classList.toggle( 'pnfpb-back-to-top--visible', window.scrollY > 400 );
		}, { passive: true } );

		btn.addEventListener( 'click', function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}

	/* ── Init all modules ───────────────────────────────────────────── */
	document.addEventListener( 'DOMContentLoaded', function () {
		initSmoothScroll();
		initHeaderScroll();
		initContactForm();
		initLazyLoad();
		initSkipLink();
		initBackToTop();
	} );
}() );
