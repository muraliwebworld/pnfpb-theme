/**
 * PNFPB Theme — Hero Slider JS
 *
 * Accessible, touch-enabled carousel for the home page hero section.
 * Relies only on standard DOM APIs — no jQuery.
 */
( function () {
	'use strict';

	var SLIDE_INTERVAL = 5000; // ms between auto-advances

	var slider     = null;
	var track      = null;
	var slides     = [];
	var dots       = [];
	var prevBtn    = null;
	var nextBtn    = null;
	var current    = 0;
	var total      = 0;
	var timer      = null;
	var touchStartX = 0;
	var touchMoved  = false;

	/**
	 * Initialise the hero slider.
	 */
	function init() {
		slider  = document.getElementById( 'pnfpb-hero-slider' );
		if ( ! slider ) return;

		track   = document.getElementById( 'pnfpb-slider-track' );
		slides  = Array.from( track.querySelectorAll( '.pnfpb-slide' ) );
		dots    = Array.from( slider.querySelectorAll( '.pnfpb-slider-dot' ) );
		prevBtn = document.getElementById( 'pnfpb-slider-prev' );
		nextBtn = document.getElementById( 'pnfpb-slider-next' );
		total   = slides.length;

		if ( total < 2 ) return;

		// Set up controls.
		if ( prevBtn ) prevBtn.addEventListener( 'click', function () { goTo( current - 1 ); } );
		if ( nextBtn ) nextBtn.addEventListener( 'click', function () { goTo( current + 1 ); } );

		dots.forEach( function ( dot, index ) {
			dot.addEventListener( 'click', function () { goTo( index ); } );
		} );

		// Keyboard support.
		slider.addEventListener( 'keydown', handleKeyDown );

		// Pause on hover / focus.
		slider.addEventListener( 'mouseenter', pause );
		slider.addEventListener( 'mouseleave', startAuto );
		slider.addEventListener( 'focusin',    pause );
		slider.addEventListener( 'focusout',   function ( e ) {
			if ( ! slider.contains( e.relatedTarget ) ) startAuto();
		} );

		// Touch / swipe support.
		track.addEventListener( 'touchstart', onTouchStart, { passive: true } );
		track.addEventListener( 'touchmove',  onTouchMove,  { passive: true } );
		track.addEventListener( 'touchend',   onTouchEnd );

		// Respect reduced-motion preference.
		var mediaQuery = window.matchMedia( '(prefers-reduced-motion: reduce)' );
		mediaQuery.addEventListener( 'change', function ( e ) {
			if ( e.matches ) { pause(); } else { startAuto(); }
		} );

		goTo( 0, false );
		if ( ! mediaQuery.matches ) startAuto();
	}

	/**
	 * Navigate to a specific slide index.
	 *
	 * @param {number}  index   Target slide index.
	 * @param {boolean} animate Whether to animate (default true).
	 */
	function goTo( index, animate ) {
		if ( typeof animate === 'undefined' ) animate = true;

		// Wrap around.
		if ( index < 0 )     index = total - 1;
		if ( index >= total ) index = 0;

		var prev = current;
		current  = index;

		// Move the track so the active slide is in view.
		track.style.transform = 'translateX(-' + ( current * 100 ) + '%)';

		slides.forEach( function ( slide, i ) {
			var active = ( i === current );
			slide.setAttribute( 'aria-hidden', active ? 'false' : 'true' );
			slide.classList.toggle( 'pnfpb-slide--active', active );
		} );

		dots.forEach( function ( dot, i ) {
			var active = ( i === current );
			dot.setAttribute( 'aria-selected', String( active ) );
			dot.classList.toggle( 'pnfpb-slider-dot--active', active );
		} );

		// Announce new slide to screen readers.
		slider.setAttribute( 'aria-label', 'Slide ' + ( current + 1 ) + ' of ' + total );
	}

	/**
	 * Start the auto-advance timer.
	 */
	function startAuto() {
		pause();
		timer = setInterval( function () { goTo( current + 1 ); }, SLIDE_INTERVAL );
	}

	/**
	 * Pause the auto-advance timer.
	 */
	function pause() {
		clearInterval( timer );
		timer = null;
	}

	/**
	 * Keyboard navigation handler.
	 * @param {KeyboardEvent} e
	 */
	function handleKeyDown( e ) {
		if ( e.key === 'ArrowLeft'  ) { goTo( current - 1 ); pause(); }
		if ( e.key === 'ArrowRight' ) { goTo( current + 1 ); pause(); }
	}

	/**
	 * Touch start event.
	 * @param {TouchEvent} e
	 */
	function onTouchStart( e ) {
		touchStartX = e.changedTouches[ 0 ].screenX;
		touchMoved  = false;
	}

	/**
	 * Touch move event — detect intent.
	 */
	function onTouchMove() {
		touchMoved = true;
	}

	/**
	 * Touch end event — execute swipe if enough distance.
	 * @param {TouchEvent} e
	 */
	function onTouchEnd( e ) {
		if ( ! touchMoved ) return;
		var delta = e.changedTouches[ 0 ].screenX - touchStartX;
		if ( Math.abs( delta ) < 50 ) return; // ignore tiny swipes
		if ( delta < 0 ) { goTo( current + 1 ); }
		else             { goTo( current - 1 ); }
		pause();
	}

	document.addEventListener( 'DOMContentLoaded', init );
}() );
