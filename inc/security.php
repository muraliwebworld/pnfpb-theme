<?php
/**
 * PNFPB Theme – Security hardening.
 *
 * Implements WordPress security best practices at the theme level.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── 1. Remove WordPress version from <head> ─────────────────────────────
remove_action( 'wp_head', 'wp_generator' );

// ─── 2. Remove wlwmanifest, RSD, and shortlink from <head> ───────────────
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

// ─── 3. Disable XML-RPC ───────────────────────────────────────────────────
add_filter( 'xmlrpc_enabled', '__return_false' );

// ─── 4. Restrict REST API to authenticated users for private endpoints ────
add_filter( 'rest_authentication_errors', 'pnfpb_rest_restrict', 99 );
/**
 * Allow public endpoints; block user enumeration via REST API.
 *
 * @param WP_Error|null|true $result Existing result.
 * @return WP_Error|null|true
 */
function pnfpb_rest_restrict( $result ) {
	if ( ! empty( $result ) ) {
		return $result; // Let other plugins handle first.
	}
	// Block /wp/v2/users unauthenticated access.
	$rest_route = $GLOBALS['wp']->query_vars['rest_route'] ?? '';
	if ( strpos( $rest_route, '/wp/v2/users' ) === 0 && ! current_user_can( 'list_users' ) ) {
		return new WP_Error(
			'rest_forbidden',
			esc_html__( 'Authentication required.', PNFPB_TEXT_DOMAIN ),
			array( 'status' => 401 )
		);
	}
	return $result;
}

// ─── 5. Remove version query strings from scripts/styles ─────────────────
add_filter( 'style_loader_src',  'pnfpb_remove_ver_from_scripts', 999 );
add_filter( 'script_loader_src', 'pnfpb_remove_ver_from_scripts', 999 );
/**
 * Strip ?ver= from asset URLs in production.
 *
 * @param string $src Asset URL.
 * @return string
 */
function pnfpb_remove_ver_from_scripts( string $src ) : string {
	if ( is_admin() || defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		return $src;
	}
	$parts = explode( '?', $src );
	return $parts[0];
}

// ─── 6. Disable author archive URL enumeration ───────────────────────────
add_action( 'template_redirect', 'pnfpb_disable_author_enumeration' );
/**
 * Redirect /?author=N requests to 404.
 */
function pnfpb_disable_author_enumeration() : void {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['author'] ) && ! is_admin() ) {
		wp_safe_redirect( home_url( '/404/' ), 301 );
		exit;
	}
	// phpcs:enable
}

// ─── 7. Send security HTTP headers ───────────────────────────────────────
add_action( 'send_headers', 'pnfpb_security_headers' );
/**
 * Add security-oriented HTTP response headers.
 */
function pnfpb_security_headers() : void {
	if ( headers_sent() ) {
		return;
	}
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-XSS-Protection: 1; mode=block' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
}

// ─── 8. Sanitize all comment input ───────────────────────────────────────
add_filter( 'pre_comment_content', 'pnfpb_sanitize_comment_content' );
/**
 * Extra sanitization on comment content.
 *
 * @param string $content Raw comment content.
 * @return string
 */
function pnfpb_sanitize_comment_content( string $content ) : string {
	return wp_kses_post( $content );
}

// ─── 9. Contact form AJAX handler (with nonce + capability check) ─────────
add_action( 'wp_ajax_nopriv_pnfpb_contact_form',  'pnfpb_handle_contact_form' );
add_action( 'wp_ajax_pnfpb_contact_form',          'pnfpb_handle_contact_form' );
/**
 * Processes the contact form AJAX submission.
 * All inputs are validated and sanitized; nonce verified.
 */
function pnfpb_handle_contact_form() : void {
	// CSRF check.
	check_ajax_referer( 'pnfpb_contact_nonce', 'nonce' );

	// Rate limit: 5 submissions per hour per IP.
	$ip        = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) );
	$cache_key = 'pnfpb_contact_' . md5( $ip );
	$count     = (int) get_transient( $cache_key );
	if ( $count >= 5 ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Too many submissions. Please try again later.', PNFPB_TEXT_DOMAIN ) ), 429 );
	}

	// Sanitize inputs.
	$name    = sanitize_text_field( wp_unslash( $_POST['contact_name']    ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['contact_email']   ?? '' ) );
	$subject = sanitize_text_field( wp_unslash( $_POST['contact_subject'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) );

	// Validate.
	if ( empty( $name ) || strlen( $name ) > 100 ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Please enter a valid name (max 100 characters).', PNFPB_TEXT_DOMAIN ) ), 400 );
	}
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Please enter a valid email address.', PNFPB_TEXT_DOMAIN ) ), 400 );
	}
	if ( empty( $subject ) || strlen( $subject ) > 200 ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Please enter a valid subject (max 200 characters).', PNFPB_TEXT_DOMAIN ) ), 400 );
	}
	if ( empty( $message ) || strlen( $message ) > 5000 ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Please enter your message (max 5000 characters).', PNFPB_TEXT_DOMAIN ) ), 400 );
	}

	// Honeypot check.
	// phpcs:disable WordPress.Security.NonceVerification.Missing
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => esc_html__( 'Thank you for your message!', PNFPB_TEXT_DOMAIN ) ) );
	}
	// phpcs:enable

	// Build email.
	$admin_email = get_option( 'admin_email' );
	$subject_line = sprintf(
		/* translators: 1: site name, 2: user subject. */
		'[%1$s] %2$s',
		esc_html( get_bloginfo( 'name', 'display' ) ),
		$subject
	);
	$body = sprintf(
		"Name: %s\nEmail: %s\n\nMessage:\n%s",
		$name,
		$email,
		$message
	);

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'From: ' . $name . ' <' . $admin_email . '>',
		'Reply-To: ' . $email,
	);

	$sent = wp_mail( $admin_email, $subject_line, $body, $headers );

	if ( $sent ) {
		set_transient( $cache_key, $count + 1, HOUR_IN_SECONDS );
		wp_send_json_success( array( 'message' => esc_html__( 'Thank you! Your message has been sent.', PNFPB_TEXT_DOMAIN ) ) );
	} else {
		wp_send_json_error( array( 'message' => esc_html__( 'Sorry, your message could not be sent. Please try again.', PNFPB_TEXT_DOMAIN ) ), 500 );
	}
}
