<?php
/**
 * PNFPB Theme – Template helper functions.
 *
 * Reusable display helpers used across template files.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── SVG icon helper ─────────────────────────────────────────────────────
/**
 * Returns inline SVG markup for a named icon.
 *
 * @param string $icon Icon name.
 * @param array  $atts Optional attributes (class, width, height, aria-label).
 * @return string Escaped SVG HTML.
 */
function pnfpb_icon( string $icon, array $atts = array() ) : string {
	$class  = isset( $atts['class'] ) ? ' class="' . esc_attr( $atts['class'] ) . '"' : '';
	$width  = isset( $atts['width'] ) ? (int) $atts['width'] : 24;
	$height = isset( $atts['height'] ) ? (int) $atts['height'] : 24;
	$label  = isset( $atts['aria-label'] ) ? ' aria-label="' . esc_attr( $atts['aria-label'] ) . '"' : ' aria-hidden="true"';

	$paths = array(
		'bell'            => '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>',
		'check'           => '<polyline points="20 6 9 17 4 12"/>',
		'smartphone'      => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>',
		'cloud'           => '<path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/>',
		'settings'        => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
		'users'           => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'user'            => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
		'message'         => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
		'book'            => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>',
		'file-text'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>',
		'zap'             => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
		'globe'           => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
		'shield'          => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
		'wifi'            => '<path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/>',
		'calendar'        => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
		'mail'            => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>',
		'map-pin'         => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
		'link'            => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>',
		'arrow-right'     => '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
		'external-link'   => '<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>',
		'chevron-right'   => '<polyline points="9 18 15 12 9 6"/>',
		'chevron-left'    => '<polyline points="15 18 9 12 15 6"/>',
		'home'            => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
		'search'          => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
		'info'            => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>',
		'alert-circle'    => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
		'star'            => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
		'activity'        => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>',
		'code'            => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
		'download'        => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
		'upload'          => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>',
		'plug'            => '<path d="M12 22v-5"/><path d="M9 8V2"/><path d="M15 8V2"/><path d="M18 8H6a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2z"/>',
		'menu'            => '<line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/>',
		'x'               => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
		'heart'           => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
		'thumbs-up'       => '<path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"/><path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>',
		'share-2'         => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>',
		'twitter'         => '<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>',
		'github'          => '<path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>',
		'wordpress'       => '<path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zM3.5 12c0-1.232.254-2.403.704-3.464l3.889 10.658A8.505 8.505 0 0 1 3.5 12zm8.5 8.5c-.828 0-1.628-.117-2.384-.336l2.531-7.355 2.594 7.105a.982.982 0 0 0 .07.135A8.532 8.532 0 0 1 12 20.5zM13.237 8.3l2.424 7.227-2.415.72-.009-.032-.026.009L10.68 8.3H13.237zM17.96 17.04l-1.997-5.953 1.22-4.456a8.5 8.5 0 0 1 .777 12.409z"/>',
	);

	$path  = $paths[ $icon ] ?? '';
	if ( empty( $path ) ) {
		return '';
	}

	return sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg" width="%d" height="%d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"%s%s>%s</svg>',
		$width,
		$height,
		$class,
		$label,
		$path
	);
}

// ─── Posted-on / posted-by metas ─────────────────────────────────────────
/**
 * Outputs the post date meta with schema markup.
 */
function pnfpb_posted_on() : void {
	$time_string = sprintf(
		'<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	printf(
		'<span class="posted-on">%s</span>',
		$time_string // Already escaped above.
	);
}

/**
 * Outputs the post author meta with schema markup.
 */
function pnfpb_posted_by() : void {
	printf(
		'<span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

// ─── Post thumbnail with fallback ────────────────────────────────────────
/**
 * Returns post thumbnail HTML or a gradient placeholder.
 *
 * @param int|null $post_id   Post ID (default: current).
 * @param string   $size      Image size.
 * @param string   $css_class Extra CSS classes on <div>.
 * @return string
 */
function pnfpb_get_post_thumbnail( ?int $post_id = null, string $size = 'pnfpb-card', string $css_class = '' ) : string {
	$post_id = $post_id ?? get_the_ID();
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size, array( 'class' => 'attachment-' . esc_attr( $size ) . ' size-' . esc_attr( $size ) ) );
	}
	// Gradient placeholder with post title initial.
	$title   = get_the_title( $post_id );
	$initial = mb_strtoupper( mb_substr( $title, 0, 1 ) );
	return sprintf(
		'<div class="pnfpb-post-thumb-placeholder %s" aria-hidden="true">%s</div>',
		esc_attr( $css_class ),
		esc_html( $initial )
	);
}

// ─── Sidebar decision helper ──────────────────────────────────────────────
/**
 * Returns true when the current request should show the sidebar.
 *
 * @return bool
 */
function pnfpb_has_sidebar() : bool {
	if ( is_page_template( 'page-templates/page-full-width.php' ) ) {
		return false;
	}
	if ( is_front_page() ) {
		return false;
	}
	if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
		return is_active_sidebar( 'sidebar-buddypress' );
	}
	return is_active_sidebar( 'sidebar-main' );
}

// ─── Content grid class ───────────────────────────────────────────────────
/**
 * Returns the CSS classes for the main content grid wrapper.
 *
 * @return string
 */
function pnfpb_content_area_class() : string {
	$base = 'pnfpb-content-area';
	if ( ! pnfpb_has_sidebar() ) {
		return $base . ' no-sidebar';
	}
	return $base;
}

// ─── Documentation links data ─────────────────────────────────────────────
/**
 * Returns the array of documentation links for wiki.pnfpb.com.
 *
 * @return array<int, array{title: string, url: string, desc: string, icon: string}>
 */
function pnfpb_get_doc_links() : array {
	$base = 'https://wiki.pnfpb.com';
	return array(
		array(
			'title' => __( 'Installation Guide', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/installation/',
			'desc'  => __( 'Step-by-step installation & activation', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'download',
		),
		array(
			'title' => __( 'Firebase Configuration', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/firebase-configuration/',
			'desc'  => __( 'Set up Firebase HTTP v1 & FCM', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'cloud',
		),
		array(
			'title' => __( 'WebPush Configuration', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/webpush-configuration/',
			'desc'  => __( 'Self-hosted VAPID-based push', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'wifi',
		),
		array(
			'title' => __( 'OneSignal Integration', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/onesignal-integration/',
			'desc'  => __( 'Connect your OneSignal account', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'bell',
		),
		array(
			'title' => __( 'Progressier Integration', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/progressier-integration/',
			'desc'  => __( 'Progressier push notification setup', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'zap',
		),
		array(
			'title' => __( 'PWA Setup', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/pwa-setup/',
			'desc'  => __( 'Progressive Web App configuration', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'smartphone',
		),
		array(
			'title' => __( 'Mobile App Integration', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/mobile-app-integration/',
			'desc'  => __( 'Integrate with native mobile apps', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'code',
		),
		array(
			'title' => __( 'REST API Reference', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/rest-api/',
			'desc'  => __( 'API endpoints for token registration', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'globe',
		),
		array(
			'title' => __( 'Shortcodes Reference', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/shortcodes/',
			'desc'  => __( 'Available shortcodes and parameters', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'code',
		),
		array(
			'title' => __( 'BuddyPress Integration', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/buddypress-integration/',
			'desc'  => __( 'Activity, groups & message notifications', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'users',
		),
		array(
			'title' => __( 'Scheduled Notifications', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/scheduled-notifications/',
			'desc'  => __( 'Cron & Action Scheduler setup', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'calendar',
		),
		array(
			'title' => __( 'Troubleshooting', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/troubleshooting/',
			'desc'  => __( 'Common issues and solutions', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'alert-circle',
		),
		array(
			'title' => __( 'Multisite Support', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/multisite/',
			'desc'  => __( 'WordPress Multisite network setup', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'globe',
		),
		array(
			'title' => __( 'Delivery Statistics', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/delivery-statistics/',
			'desc'  => __( 'Track notification delivery & opens', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'activity',
		),
		array(
			'title' => __( 'On-Demand Notifications', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/on-demand-notifications/',
			'desc'  => __( 'Send one-time and scheduled pushes', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'zap',
		),
		array(
			'title' => __( 'FAQ', PNFPB_TEXT_DOMAIN ),
			'url'   => $base . '/faq/',
			'desc'  => __( 'Frequently asked questions', PNFPB_TEXT_DOMAIN ),
			'icon'  => 'info',
		),
	);
}

// ─── PNFPB features data ─────────────────────────────────────────────────
/**
 * Returns the full list of PNFPB plugin features for display on the home page.
 *
 * @return array<int, array{title: string, desc: string, icon: string}>
 */
function pnfpb_get_plugin_features() : array {
	return array(
		array(
			'title'   => __( 'Post Push Notifications', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Automatically send push notifications to all subscribers whenever a post is published or transitions to a selected status. Supports custom post types.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'bell',
			'color'   => 'blue',
			'doc_url' => 'https://wiki.pnfpb.com/post-notifications/',
		),
		array(
			'title'   => __( 'BuddyPress Integration', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Notify users about BuddyPress activities, group events, likes, comments, private messages, friendship requests and more — in real time.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'users',
			'color'   => 'orange',
			'doc_url' => 'https://wiki.pnfpb.com/buddypress-notifications/',
		),
		array(
			'title'   => __( 'Firebase FCM (HTTP v1)', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Leverage the latest Firebase Cloud Messaging HTTP v1 API with automatic OAuth token refresh and service account support.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'cloud',
			'color'   => 'green',
			'doc_url' => 'https://wiki.pnfpb.com/firebase-configuration/',
		),
		array(
			'title'   => __( 'WebPush (Self-hosted)', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Send push notifications without relying on any third-party service using VAPID keys and the W3C WebPush standard.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'wifi',
			'color'   => 'purple',
			'doc_url' => 'https://wiki.pnfpb.com/webpush-configuration/',
		),
		array(
			'title'   => __( 'OneSignal & Progressier', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Seamlessly integrate with OneSignal or Progressier platforms as alternative delivery backends with simple API key configuration.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'zap',
			'color'   => 'teal',
			'doc_url' => 'https://wiki.pnfpb.com/onesignal-configuration/',
		),
		array(
			'title' => __( 'Progressive Web App (PWA)', PNFPB_TEXT_DOMAIN ),
			'desc'  => __( 'Turn your WordPress site into an installable PWA with auto-generated manifest, service worker, custom install prompt shortcode, and offline caching.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'smartphone',
			'color'   => 'red',
			'doc_url' => 'https://wiki.pnfpb.com/pwa-settings/',
		),
		array(
			'title' => __( 'On-Demand & Scheduled Push', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Send one-time targeted notifications immediately or schedule them for a future time. Powered by WP Cron and Action Scheduler for reliability.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'calendar',
			'color'   => 'blue',
			'doc_url' => 'https://wiki.pnfpb.com/scheduled-notifications/',
		),
		array(
			'title' => __( 'Mobile App REST API', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Register mobile app device tokens via REST API endpoints and receive push notifications on Android and iOS apps alongside web browsers.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'code',
			'color'   => 'orange',
			'doc_url' => 'https://wiki.pnfpb.com/mobile-app-integration/',
		),
		array(
			'title' => __( 'Delivery & Open Statistics', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Track notification delivery rates and open statistics per campaign with browser-level breakdowns and per-device token reports.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'activity',
			'color'   => 'green',
			'doc_url' => 'https://wiki.pnfpb.com/delivery-statistics/',
		),
		array(
			'title' => __( 'Subscribe / Unsubscribe Shortcodes', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Add branded subscribe and unsubscribe buttons anywhere on your site using the [subscribe_PNFPB_push_notification] and [PNFPB_PWA_PROMPT] shortcodes.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'plug',
			'color'   => 'purple',
			'doc_url' => 'https://wiki.pnfpb.com/shortcodes/',
		),
		array(
			'title' => __( 'Multisite Support', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'Fully compatible with WordPress Multisite. Per-site device token tables are created on network activation and removed on site deletion.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'globe',
			'color'   => 'teal',
			'doc_url' => 'https://wiki.pnfpb.com/multisite-support/',
		),
		array(
			'title' => __( 'NGINX Static Service Worker', PNFPB_TEXT_DOMAIN ),
			'desc'    => __( 'On NGINX servers where PHP cannot serve dynamic files from the webroot, the plugin can write static service worker and manifest files for you.', PNFPB_TEXT_DOMAIN ),
			'icon'    => 'settings',
			'color'   => 'red',
			'doc_url' => 'https://wiki.pnfpb.com/nginx-setup/',
		),
	);
}

// ─── Slider data ─────────────────────────────────────────────────────────
/**
 * Returns the hero slider slide data.
 *
 * @return array<int, array{label: string, title: string, desc: string, cta_text: string, cta_url: string, cta2_text: string, cta2_url: string, icon: string, slide_class: string}>
 */
function pnfpb_get_slider_data() : array {
	return array(
		array(
			'label'      => __( 'Web Push Notifications', PNFPB_TEXT_DOMAIN ),
			'title'      => __( 'Instant Push Notifications for Every Post', PNFPB_TEXT_DOMAIN ),
			'desc'       => __( 'Automatically notify all your subscribers the moment a post goes live. Supports Firebase FCM, WebPush, OneSignal, and Progressier — all in one plugin.', PNFPB_TEXT_DOMAIN ),
			'cta_text'   => __( 'Get the Plugin', PNFPB_TEXT_DOMAIN ),
			'cta_url'    => 'https://wordpress.org/plugins/push-notification-for-post-and-buddypress/',
			'cta2_text'  => __( 'Read Documentation', PNFPB_TEXT_DOMAIN ),
			'cta2_url'   => 'https://wiki.pnfpb.com',
			'icon'       => 'bell',
			'image'      => get_template_directory_uri() . '/assets/slider_images/pnfpb-hero-banner.svg',
			'slide_class' => 'pnfpb-slide--1',
		),
		array(
			'label'      => __( 'BuddyPress Notifications', PNFPB_TEXT_DOMAIN ),
			'title'      => __( 'Real-Time BuddyPress Activity Alerts', PNFPB_TEXT_DOMAIN ),
			'desc'       => __( 'Push notifications for BuddyPress activities, group updates, new messages, friendship events, and comment replies — keeping your community engaged 24/7.', PNFPB_TEXT_DOMAIN ),
			'cta_text'   => __( 'Explore Community', PNFPB_TEXT_DOMAIN ),
			'cta_url'    => function_exists( 'pnfpb_bp_directory_url' ) ? pnfpb_bp_directory_url( 'activity' ) : home_url( '/activity/' ),
			'cta2_text'  => __( 'View Groups', PNFPB_TEXT_DOMAIN ),
			'cta2_url'   => function_exists( 'pnfpb_bp_directory_url' ) ? pnfpb_bp_directory_url( 'groups' ) : home_url( '/groups/' ),
			'icon'       => 'users',
			'image'      => get_template_directory_uri() . '/assets/slider_images/pnfpb-buddypress-banner.svg',
			'slide_class' => 'pnfpb-slide--2',
		),
		array(
			'label'      => __( 'Progressive Web App', PNFPB_TEXT_DOMAIN ),
			'title'      => __( 'Transform Your Site Into a PWA', PNFPB_TEXT_DOMAIN ),
			'desc'       => __( 'Auto-generated manifest, custom service worker, offline page caching and a branded install prompt with the [PNFPB_PWA_PROMPT] shortcode.', PNFPB_TEXT_DOMAIN ),
			'cta_text'   => __( 'PWA Docs', PNFPB_TEXT_DOMAIN ),
			'cta_url'    => 'https://wiki.pnfpb.com/pwa-setup/',
			'cta2_text'  => __( 'Try It Free', PNFPB_TEXT_DOMAIN ),
			'cta2_url'   => 'https://wordpress.org/plugins/push-notification-for-post-and-buddypress/',
			'icon'       => 'smartphone',
			'image'      => get_template_directory_uri() . '/assets/slider_images/hero-banner.svg',
			'slide_class' => 'pnfpb-slide--3',
		),
		array(
			'label'      => __( 'Mobile App Integration', PNFPB_TEXT_DOMAIN ),
			'title'      => __( 'Push Notifications to Native Mobile Apps', PNFPB_TEXT_DOMAIN ),
			'desc'       => __( 'Register Android and iOS device tokens via the built-in REST API and send push notifications to your mobile apps seamlessly alongside web browsers.', PNFPB_TEXT_DOMAIN ),
			'cta_text'   => __( 'REST API Docs', PNFPB_TEXT_DOMAIN ),
			'cta_url'    => 'https://wiki.pnfpb.com/rest-api/',
			'cta2_text'  => __( 'Mobile Integration Group', PNFPB_TEXT_DOMAIN ),
			'cta2_url'   => function_exists( 'pnfpb_bp_group_url' ) ? pnfpb_bp_group_url( 'pnfpb-mobile-integration' ) : '#',
			'icon'       => 'code',
			'slide_class' => 'pnfpb-slide--4',
		),
		array(
			'label'      => __( 'On-Demand & Scheduled Push', PNFPB_TEXT_DOMAIN ),
			'title'      => __( 'Send the Right Message at the Right Time', PNFPB_TEXT_DOMAIN ),
			'desc'       => __( 'Compose targeted one-time notifications or schedule delivery for any future date using Action Scheduler — built right into the WordPress admin.', PNFPB_TEXT_DOMAIN ),
			'cta_text'   => __( 'Scheduling Docs', PNFPB_TEXT_DOMAIN ),
			'cta_url'    => 'https://wiki.pnfpb.com/scheduled-notifications/',
			'cta2_text'  => __( 'See All Features', PNFPB_TEXT_DOMAIN ),
			'cta2_url'   => '#pnfpb-features',
			'icon'       => 'calendar',
			'slide_class' => 'pnfpb-slide--5',
		),
		array(
			'label'      => __( 'Multiple Delivery Providers', PNFPB_TEXT_DOMAIN ),
			'title'      => __( 'Choose Your Push Delivery Backend', PNFPB_TEXT_DOMAIN ),
			'desc'       => __( 'Switch between Firebase HTTP v1, self-hosted WebPush, OneSignal, or Progressier without changing your workflow. All providers managed from one settings page.', PNFPB_TEXT_DOMAIN ),
			'cta_text'   => __( 'Firebase Setup', PNFPB_TEXT_DOMAIN ),
			'cta_url'    => 'https://wiki.pnfpb.com/firebase-configuration/',
			'cta2_text'  => __( 'WebPush Setup', PNFPB_TEXT_DOMAIN ),
			'cta2_url'   => 'https://wiki.pnfpb.com/webpush-configuration/',
			'icon'       => 'cloud',
			'slide_class' => 'pnfpb-slide--6',
		),
	);
}

// ─── Pagination helper ────────────────────────────────────────────────────
/**
 * Outputs custom numeric pagination.
 *
 * @param WP_Query|null $query Optional custom query object.
 */
function pnfpb_pagination( ?WP_Query $query = null ) : void {
	global $wp_query;
	$query         = $query ?? $wp_query;
	$total_pages   = (int) $query->max_num_pages;

	if ( $total_pages <= 1 ) {
		return;
	}

	$current  = max( 1, (int) get_query_var( 'paged' ) );

	echo '<nav class="pnfpb-pagination" aria-label="' . esc_attr__( 'Posts navigation', PNFPB_TEXT_DOMAIN ) . '">';
	echo wp_kses_post( paginate_links( array(
		'base'               => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
		'format'             => '?paged=%#%',
		'current'            => $current,
		'total'              => $total_pages,
		'mid_size'           => 2,
		'type'               => 'plain',
		'prev_text'          => pnfpb_icon( 'chevron-left', array( 'width' => 16, 'height' => 16 ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous', PNFPB_TEXT_DOMAIN ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', PNFPB_TEXT_DOMAIN ) . '</span>' . pnfpb_icon( 'chevron-right', array( 'width' => 16, 'height' => 16 ) ),
		'before_page_number' => '',
		'after_page_number'  => '',
	) ) );
	echo '</nav>';
}
