<?php
/**
 * PNFPB Theme – Enqueue scripts and styles.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'pnfpb_enqueue_assets' );
/**
 * Enqueue front-end stylesheets and scripts.
 */
function pnfpb_enqueue_assets() : void {
	// Main stylesheet.
	wp_enqueue_style(
		'pnfpb-theme-style',
		get_stylesheet_uri(),
		array(),
		PNFPB_THEME_VERSION
	);

	// Google Fonts (Inter).
	wp_enqueue_style(
		'pnfpb-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	// BuddyPress-specific styles (loaded only on BP pages).
	if ( function_exists( 'is_buddypress' ) && (
		is_buddypress() || bp_is_user() || bp_is_groups_component() || bp_is_activity_component() ||
		( function_exists( 'bp_is_messages_component' ) && bp_is_messages_component() ) ||
		( function_exists( 'bp_is_notifications_component' ) && bp_is_notifications_component() )
	) ) {
		wp_enqueue_style(
			'pnfpb-buddypress',
			PNFPB_THEME_URI . '/assets/css/buddypress.css',
			array( 'pnfpb-theme-style' ),
			PNFPB_THEME_VERSION
		);
	}

	// Main JS + navigation.
	wp_enqueue_script(
		'pnfpb-navigation',
		PNFPB_THEME_URI . '/assets/js/navigation.js',
		array(),
		PNFPB_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'pnfpb-main',
		PNFPB_THEME_URI . '/assets/js/main.js',
		array( 'pnfpb-navigation' ),
		PNFPB_THEME_VERSION,
		true
	);

	// Hero slider only on front page.
	if ( is_front_page() ) {
		wp_enqueue_script(
			'pnfpb-slider',
			PNFPB_THEME_URI . '/assets/js/slider.js',
			array(),
			PNFPB_THEME_VERSION,
			true
		);
	}

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Localise data for JS.
	wp_localize_script( 'pnfpb-main', 'pnfpbThemeData', array(
		'ajaxUrl'     => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce'       => wp_create_nonce( 'pnfpb_theme_nonce' ),
		'homeUrl'     => esc_url( home_url( '/' ) ),
		'isLoggedIn'  => is_user_logged_in(),
		'i18n'        => array(
			'menuOpen'  => esc_html__( 'Open menu', PNFPB_TEXT_DOMAIN ),
			'menuClose' => esc_html__( 'Close menu', PNFPB_TEXT_DOMAIN ),
		),
	) );
}

add_action( 'admin_enqueue_scripts', 'pnfpb_admin_enqueue_assets' );
/**
 * Enqueue admin-area (Customizer preview) assets.
 *
 * @param string $hook Current admin page hook.
 */
function pnfpb_admin_enqueue_assets( string $hook ) : void {
	if ( 'customize.php' !== $hook ) {
		return;
	}
	wp_enqueue_style(
		'pnfpb-admin-customizer',
		PNFPB_THEME_URI . '/assets/css/admin-customizer.css',
		array(),
		PNFPB_THEME_VERSION
	);
}

// ─── Preload hero slider fonts ─────────────────────────────────────────────
add_action( 'wp_head', 'pnfpb_add_preconnect', 1 );
/**
 * Add preconnect hints for external resources.
 */
function pnfpb_add_preconnect() : void {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
