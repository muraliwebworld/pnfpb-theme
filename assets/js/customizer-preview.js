/**
 * PNFPB Theme — Customizer live-preview JS
 *
 * Handles real-time preview of theme customizer controls.
 */
( function ( $, api ) {
	'use strict';

	// Header CTA text.
	api( 'pnfpb_header_cta_text', function ( value ) {
		value.bind( function ( newVal ) {
			$( '.pnfpb-header-cta-text' ).text( newVal );
		} );
	} );

	// Footer about text.
	api( 'pnfpb_footer_about', function ( value ) {
		value.bind( function ( newVal ) {
			$( '.pnfpb-footer-desc' ).html( newVal );
		} );
	} );

	// Footer copyright.
	api( 'pnfpb_footer_copyright', function ( value ) {
		value.bind( function ( newVal ) {
			$( '.pnfpb-footer-bottom span:first-child' ).html( newVal );
		} );
	} );

}( jQuery, wp.customize ) );
