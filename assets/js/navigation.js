/**
 * PNFPB Theme — Navigation JS
 *
 * Handles mobile menu toggle, keyboard navigation, and focus trapping.
 */
( function () {
	'use strict';

	const TOGGLE_CLASS  = 'pnfpb-nav--open';
	const ACTIVE_CLASS  = 'pnfpb-menu-item--active';
	const FOCUS_VISIBLE = 'pnfpb-focus-visible';

	let menuToggle = null;
	let navBar     = null;

	/**
	 * Initialise navigation behaviour.
	 */
	function init() {
		menuToggle = document.getElementById( 'pnfpb-menu-toggle' );
		navBar     = document.getElementById( 'pnfpb-nav-bar' );

		if ( ! menuToggle || ! navBar ) {
			return;
		}

		menuToggle.addEventListener( 'click', toggleMenu );
		document.addEventListener( 'keydown', handleKeyDown );
		document.addEventListener( 'click', closeOnOutsideClick );

		// Mark visible-focus only during keyboard navigation.
		document.addEventListener( 'keydown', () => document.body.classList.add( FOCUS_VISIBLE ) );
		document.addEventListener( 'mousedown', () => document.body.classList.remove( FOCUS_VISIBLE ) );

		initSubMenus();
	}

	/**
	 * Toggle the mobile menu open/closed.
	 */
	function toggleMenu() {
		const expanded = menuToggle.getAttribute( 'aria-expanded' ) === 'true';
		menuToggle.setAttribute( 'aria-expanded', String( ! expanded ) );
		navBar.classList.toggle( TOGGLE_CLASS, ! expanded );
		menuToggle.setAttribute( 'aria-label', expanded
			? ( pnfpbThemeData.i18n.menuOpen  || 'Open menu'  )
			: ( pnfpbThemeData.i18n.menuClose || 'Close menu' )
		);
	}

	/**
	 * Close the menu when ESC is pressed.
	 * @param {KeyboardEvent} e
	 */
	function handleKeyDown( e ) {
		if ( e.key === 'Escape' && navBar.classList.contains( TOGGLE_CLASS ) ) {
			closeMenu();
			menuToggle.focus();
		}
	}

	/**
	 * Close the menu when clicking outside.
	 * @param {MouseEvent} e
	 */
	function closeOnOutsideClick( e ) {
		if (
			navBar.classList.contains( TOGGLE_CLASS ) &&
			! navBar.contains( e.target ) &&
			! menuToggle.contains( e.target )
		) {
			closeMenu();
		}
	}

	/**
	 * Close the mobile menu.
	 */
	function closeMenu() {
		menuToggle.setAttribute( 'aria-expanded', 'false' );
		navBar.classList.remove( TOGGLE_CLASS );
	}

	/**
	 * Wire up keyboard-accessible sub-menus.
	 */
	function initSubMenus() {
		const menuItems = navBar.querySelectorAll( '.pnfpb-menu-item.menu-item-has-children' );

		menuItems.forEach( function ( item ) {
			const link     = item.querySelector( ':scope > a' );
			const subMenu  = item.querySelector( ':scope > .sub-menu' );

			if ( ! link || ! subMenu ) {
				return;
			}

			// Create a toggle button inside the link text for keyboard + mobile.
			const btn = document.createElement( 'button' );
			btn.type       = 'button';
			btn.className  = 'pnfpb-submenu-toggle';
			btn.setAttribute( 'aria-expanded', 'false' );
			btn.setAttribute( 'aria-label', ( pnfpbThemeData.i18n.subMenuToggle || 'Toggle submenu' ) );
			btn.innerHTML  = '<svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>';

			link.insertAdjacentElement( 'afterend', btn );

			btn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				const open = btn.getAttribute( 'aria-expanded' ) === 'true';
				closeAllSubMenus( navBar );
				if ( ! open ) {
					btn.setAttribute( 'aria-expanded', 'true' );
					item.classList.add( ACTIVE_CLASS );
					subMenu.hidden = false;
				}
			} );

			// Close sub-menu when focus leaves.
			item.addEventListener( 'focusout', function ( e ) {
				if ( ! item.contains( e.relatedTarget ) ) {
					btn.setAttribute( 'aria-expanded', 'false' );
					item.classList.remove( ACTIVE_CLASS );
					subMenu.hidden = true;
				}
			} );
		} );
	}

	/**
	 * Close all open sub-menus within a context.
	 * @param {Element} context
	 */
	function closeAllSubMenus( context ) {
		context.querySelectorAll( '.pnfpb-submenu-toggle[aria-expanded="true"]' ).forEach( function ( btn ) {
			btn.setAttribute( 'aria-expanded', 'false' );
			btn.closest( '.pnfpb-menu-item' ).classList.remove( ACTIVE_CLASS );
			const sub = btn.closest( '.pnfpb-menu-item' ).querySelector( ':scope > .sub-menu' );
			if ( sub ) {
				sub.hidden = true;
			}
		} );
	}

	document.addEventListener( 'DOMContentLoaded', init );
}() );
