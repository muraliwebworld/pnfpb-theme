<?php
/**
 * PNFPB Theme – BuddyPress integration.
 *
 * Handles BuddyPress compat setup, template hierarchy overrides,
 * member navigation items, and helper utilities.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only proceed when BuddyPress is active.
if ( ! function_exists( 'bp_is_active' ) ) {
	return;
}

// ─── BuddyPress native theme support ────────────────────────────────────────
// add_theme_support( 'buddypress' ) is declared in inc/setup.php.
// This tells BuddyPress the theme handles its pages natively via the
// buddypress/ template directory and the bp_get_template_stack filter below.

// ─── Use theme's buddypress/ directory for BP templates ──────────────────
add_filter( 'bp_get_template_stack', 'pnfpb_bp_template_stack' );
/**
 * Add the theme's buddypress/ directory to BuddyPress template stack.
 *
 * @param array $stack Template stack directories.
 * @return array
 */
function pnfpb_bp_template_stack( array $stack ) : array {
	$stack[] = PNFPB_THEME_DIR . '/buddypress';
	return $stack;
}

// ─── Body class helpers ───────────────────────────────────────────────────
add_filter( 'body_class', 'pnfpb_bp_body_classes' );
/**
 * Add BuddyPress component body classes.
 *
 * @param array $classes Body classes.
 * @return array
 */
function pnfpb_bp_body_classes( array $classes ) : array {
	if ( ! function_exists( 'bp_is_active' ) ) {
		return $classes;
	}
	if ( bp_is_user() ) {
		$classes[] = 'pnfpb-bp-member';
	}
	if ( bp_is_groups_component() ) {
		$classes[] = 'pnfpb-bp-groups';
	}
	if ( bp_is_activity_component() ) {
		$classes[] = 'pnfpb-bp-activity';
	}
	if ( bp_is_messages_component() ) {
		$classes[] = 'pnfpb-bp-messages';
	}
	if ( bp_is_notifications_component() ) {
		$classes[] = 'pnfpb-bp-notifications';
	}
	if ( bp_is_friends_component() ) {
		$classes[] = 'pnfpb-bp-friends';
	}
	return $classes;
}

// ─── Disable default BP sidebar widget area on BP pages ──────────────────
add_filter( 'bp_displayed_user_id', 'pnfpb_bp_set_displayed_user' );
/**
 * Ensure displayed user is available early for conditional checks.
 *
 * @param int $user_id Displayed user ID.
 * @return int
 */
function pnfpb_bp_set_displayed_user( int $user_id ) : int {
	return $user_id;
}

// ─── Register PNFPB BuddyPress groups on theme activation ────────────────
// Groups are managed from WP admin; this helper provides a reference list.
/**
 * Returns the pre-defined community groups for pnfpb.com.
 *
 * @return array<int, array{name: string, slug: string, desc: string, status: string, icon: string}>
 */
function pnfpb_get_community_groups() : array {
	return array(
		array(
			'name'   => __( 'PNFPB Features Discussion', PNFPB_TEXT_DOMAIN ),
			'slug'   => 'pnfpb-features-discussion',
			'desc'   => __( 'Discuss the features of the Push Notification for Post and BuddyPress plugin. Share how you use it, ask questions about specific features and exchange tips with other users.', PNFPB_TEXT_DOMAIN ),
			'status' => 'public',
			'icon'   => '💬',
			'color'  => 'blue',
		),
		array(
			'name'   => __( 'PNFPB Mobile Integration', PNFPB_TEXT_DOMAIN ),
			'slug'   => 'pnfpb-mobile-integration',
			'desc'   => __( 'Discuss integrating PNFPB with mobile apps using PNFPB REST APIs. Share your implementation, code snippets, and mobile app experiences.', PNFPB_TEXT_DOMAIN ),
			'status' => 'public',
			'icon'   => '📱',
			'color'  => 'orange',
		),
		array(
			'name'   => __( 'PNFPB Improvement Suggestions', PNFPB_TEXT_DOMAIN ),
			'slug'   => 'pnfpb-improvements',
			'desc'   => __( 'Post your improvement and enhancement suggestions for the PNFPB plugin. Help shape the future of the plugin by sharing your ideas and feedback.', PNFPB_TEXT_DOMAIN ),
			'status' => 'public',
			'icon'   => '💡',
			'color'  => 'green',
		),
		array(
			'name'   => __( 'PNFPB Customer Support', PNFPB_TEXT_DOMAIN ),
			'slug'   => 'pnfpb-support',
			'desc'   => __( 'Get help with your PNFPB plugin queries and problems. Post your issues here for community and author support.', PNFPB_TEXT_DOMAIN ),
			'status' => 'public',
			'icon'   => '🛟',
			'color'  => 'purple',
		),
		array(
			'name'   => __( 'PNFPB Release Updates', PNFPB_TEXT_DOMAIN ),
			'slug'   => 'pnfpb-release-updates',
			'desc'   => __( 'Stay up-to-date with the latest PNFPB plugin release updates, changelogs, and new feature announcements.', PNFPB_TEXT_DOMAIN ),
			'status' => 'public',
			'icon'   => '🚀',
			'color'  => 'teal',
		),
		array(
			'name'   => __( 'Other Plugins by Muralidharan', PNFPB_TEXT_DOMAIN ),
			'slug'   => 'muralidharan-other-plugins',
			'desc'   => __( 'Explore and discuss other WordPress plugins created by Muralidharan Ramasamy. Share your experiences and get support for those plugins here.', PNFPB_TEXT_DOMAIN ),
			'status' => 'public',
			'icon'   => '🔌',
			'color'  => 'red',
		),
	);
}

// ─── Helper: BuddyPress notifications count for header ───────────────────
/**
 * Returns the unread notification count for the current user (0 if not logged in).
 *
 * @return int
 */
function pnfpb_bp_notification_count() : int {
	if ( ! is_user_logged_in() || ! function_exists( 'bp_notifications_get_unread_notification_count' ) ) {
		return 0;
	}
	return (int) bp_notifications_get_unread_notification_count( get_current_user_id() );
}

/**
 * Returns the unread message count for the current user (0 if not logged in).
 *
 * @return int
 */
function pnfpb_bp_message_count() : int {
	if ( ! is_user_logged_in() || ! function_exists( 'messages_get_unread_count' ) ) {
		return 0;
	}
	return (int) messages_get_unread_count( get_current_user_id() );
}

// ─── BP 12.0+ URL helpers ────────────────────────────────────────────────────

/**
 * Returns the directory URL for a BuddyPress component.
 * Uses BP 12.0+ bp_get_{component}_directory_url(); falls back to home_url.
 *
 * @param string $component 'activity', 'groups', or 'members'.
 * @return string
 */
function pnfpb_bp_directory_url( string $component ) : string {
	switch ( $component ) {
		case 'activity':
			if ( function_exists( 'bp_get_activity_directory_url' ) ) {
				return bp_get_activity_directory_url();
			}
			break;
		case 'groups':
			if ( function_exists( 'bp_get_groups_directory_url' ) ) {
				return bp_get_groups_directory_url();
			}
			break;
		case 'members':
			if ( function_exists( 'bp_get_members_directory_url' ) ) {
				return bp_get_members_directory_url();
			}
			break;
	}
	return home_url( '/' . $component . '/' );
}

/**
 * Returns a BuddyPress group single-page URL.
 *
 * @param string $group_slug The group's URL slug.
 * @return string
 */
function pnfpb_bp_group_url( string $group_slug ) : string {
	return trailingslashit( pnfpb_bp_directory_url( 'groups' ) ) . $group_slug . '/';
}

/**
 * Returns the logged-in user's profile URL, optionally for a component tab.
 * Uses BP 12.0+ bp_loggedin_user_url() + bp_members_get_path_chunks().
 *
 * @param string $slug Optional component slug, e.g. 'messages', 'notifications'.
 * @return string Returns '#' when not logged in or BP is unavailable.
 */
function pnfpb_bp_loggedin_user_url( string $slug = '' ) : string {
	if ( ! is_user_logged_in() || ! function_exists( 'bp_loggedin_user_url' ) ) {
		return '#';
	}
	if ( '' === $slug ) {
		return bp_loggedin_user_url();
	}
	if ( function_exists( 'bp_members_get_path_chunks' ) ) {
		return bp_loggedin_user_url( bp_members_get_path_chunks( array( $slug ) ) );
	}
	// Older BP fallback.
	return trailingslashit( bp_loggedin_user_url() ) . $slug . '/';
}

// ─── BuddyPress login redirect ────────────────────────────────────────────
add_filter( 'login_redirect', 'pnfpb_bp_login_redirect', 10, 3 );
/**
 * Redirect to activity feed after login.
 *
 * @param string           $redirect_to          Requested redirect URL.
 * @param string           $requested_redirect_to URL from 'redirect_to' parameter.
 * @param WP_User|WP_Error $user                 User object.
 * @return string
 */
function pnfpb_bp_login_redirect( string $redirect_to, string $requested_redirect_to, $user ) : string {
	if ( is_wp_error( $user ) || ! function_exists( 'bp_get_activity_directory_url' ) ) {
		return $redirect_to;
	}
	if ( empty( $requested_redirect_to ) ) {
		return bp_get_activity_directory_url();
	}
	return $redirect_to;
}

// ─── BP Nouveau directory nav count fallback ─────────────────────────────────
// BP Nouveau always outputs '-' as a placeholder for every count tab and
// relies on its Backbone/AJAX layer to replace them. If that AJAX request
// doesn't complete (JS conflict, caching, slow network), the '-' stays
// forever. This hook picks up the counts BP already computed during the
// page render (no extra DB query) and primes them via a tiny inline script.
add_action( 'wp_footer', 'pnfpb_bp_nav_count_fallback', 20 );
/**
 * Output a minimal inline script that replaces any '-' count placeholders
 * with PHP-computed values. Runs on DOMContentLoaded and again after 1.5 s
 * so it works regardless of whether BP Nouveau's AJAX fires first.
 */
function pnfpb_bp_nav_count_fallback() : void {
	if ( ! function_exists( 'bp_is_activity_component' ) ) {
		return;
	}

	$counts = array();

	// Activity directory: total activity count (already in BP global after loop).
	if ( function_exists( 'bp_is_activity_component' ) && bp_is_activity_component() ) {
		$total = isset( buddypress()->activity->total_activity_count )
			? (int) buddypress()->activity->total_activity_count
			: 0;
		// Fallback: run a lightweight count-only query if the global wasn't set.
		if ( 0 === $total && function_exists( 'bp_activity_get' ) ) {
			$r     = bp_activity_get( array( 'per_page' => 1, 'count_total' => 'count_query' ) );
			$total = isset( $r['total'] ) ? (int) $r['total'] : 0;
		}
		$counts['activity_all'] = $total;
	}

	// Groups directory: total public group count.
	if ( function_exists( 'bp_is_groups_component' ) && bp_is_groups_component() && ! bp_is_group() ) {
		$total = isset( buddypress()->groups->total_group_count )
			? (int) buddypress()->groups->total_group_count
			: 0;
		if ( 0 === $total && function_exists( 'bp_groups_get_total_group_count' ) ) {
			$total = (int) bp_groups_get_total_group_count();
		}
		$counts['groups_all'] = $total;
	}

	if ( empty( $counts ) ) {
		return;
	}

	$json = wp_json_encode( $counts );
	?>
<script>
( function () {
	'use strict';
	var c = <?php echo $json; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_json_encode produces safe JSON ?>;

	function setIfDash( selector, val ) {
		var els = document.querySelectorAll( selector );
		for ( var i = 0; i < els.length; i++ ) {
			var txt = els[ i ].textContent.trim();
			if ( txt === '-' || txt === '' ) {
				els[ i ].textContent = val;
			}
		}
	}

	function run() {
		if ( c.activity_all !== undefined ) {
			setIfDash( '.activity-type-navs li[data-bp-scope="all"] .count', c.activity_all );
		}
		if ( c.groups_all !== undefined ) {
			setIfDash( '.groups-type-navs li[data-bp-scope="all"] .count', c.groups_all );
		}
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', run );
	} else {
		run();
	}
	// Run again after a short delay in case BP Nouveau's own AJAX fires and
	// overwrites our value — if it does, great; if counts are still '-', fix them.
	setTimeout( run, 1500 );
} )();
</script>
	<?php
}
