<?php
/**
 * PNFPB Theme – Theme Customizer options.
 *
 * Integrates with WordPress core Customizer sections (Site Identity) and adds
 * PNFPB-specific controls under the "PNFPB Theme" panel. Logo, Site Name,
 * Tagline, and Site Icon are managed natively by WordPress under
 * Appearance → Customize → Site Identity — no duplication needed here.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'pnfpb_customizer_register' );
/**
 * Register Customizer panels, sections, settings, and controls.
 *
 * @param WP_Customize_Manager $wp_customize WP Customizer manager instance.
 */
function pnfpb_customizer_register( WP_Customize_Manager $wp_customize ) : void {

	// ── WordPress built-in: Site Identity (title_tagline) ───────────────
	// Logo, Site Title, Tagline, and Site Icon are all handled natively by
	// WordPress in the 'title_tagline' section. The theme reads them via
	// has_custom_logo() / the_custom_logo() / get_bloginfo(). No duplication.
	//
	// We add the header CTA button here so it lives right alongside the
	// site identity controls the admin already visits.

	$wp_customize->add_setting( 'pnfpb_header_cta_text', array(
		'default'           => __( 'Get Plugin', PNFPB_TEXT_DOMAIN ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'pnfpb_header_cta_text', array(
		'label'       => esc_html__( 'PNFPB: Header CTA Button Text', PNFPB_TEXT_DOMAIN ),
		'description' => esc_html__( 'Label on the call-to-action button shown in the site header.', PNFPB_TEXT_DOMAIN ),
		'section'     => 'title_tagline',
		'type'        => 'text',
		'priority'    => 60,
	) );

	$wp_customize->add_setting( 'pnfpb_header_cta_url', array(
		'default'           => 'https://wordpress.org/plugins/push-notification-for-post-and-buddypress/',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'pnfpb_header_cta_url', array(
		'label'       => esc_html__( 'PNFPB: Header CTA Button URL', PNFPB_TEXT_DOMAIN ),
		'description' => esc_html__( 'Destination URL for the header call-to-action button.', PNFPB_TEXT_DOMAIN ),
		'section'     => 'title_tagline',
		'type'        => 'url',
		'priority'    => 61,
	) );

	// ── Panel: PNFPB Theme ──────────────────────────────────────────────
	$wp_customize->add_panel( 'pnfpb_theme_panel', array(
		'title'       => esc_html__( 'PNFPB Theme', PNFPB_TEXT_DOMAIN ),
		'description' => esc_html__( 'PNFPB-specific theme settings. Logo, Site Name, and Tagline are managed under Site Identity above.', PNFPB_TEXT_DOMAIN ),
		'priority'    => 130,
	) );

	// ── Section: Home Page ──────────────────────────────────────────────
	$wp_customize->add_section( 'pnfpb_home_section', array(
		'title'       => esc_html__( 'Home Page', PNFPB_TEXT_DOMAIN ),
		'description' => esc_html__( 'Toggle homepage sections on or off.', PNFPB_TEXT_DOMAIN ),
		'panel'       => 'pnfpb_theme_panel',
	) );

	// Show/hide slider.
	$wp_customize->add_setting( 'pnfpb_home_show_slider', array(
		'default'           => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
	) );
	$wp_customize->add_control( 'pnfpb_home_show_slider', array(
		'label'   => esc_html__( 'Show Hero Slider', PNFPB_TEXT_DOMAIN ),
		'section' => 'pnfpb_home_section',
		'type'    => 'checkbox',
	) );

	// Show/hide features section.
	$wp_customize->add_setting( 'pnfpb_home_show_features', array(
		'default'           => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
	) );
	$wp_customize->add_control( 'pnfpb_home_show_features', array(
		'label'   => esc_html__( 'Show Features Section', PNFPB_TEXT_DOMAIN ),
		'section' => 'pnfpb_home_section',
		'type'    => 'checkbox',
	) );

	// Show/hide BuddyPress groups section.
	$wp_customize->add_setting( 'pnfpb_home_show_groups', array(
		'default'           => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
	) );
	$wp_customize->add_control( 'pnfpb_home_show_groups', array(
		'label'   => esc_html__( 'Show BuddyPress Groups Section', PNFPB_TEXT_DOMAIN ),
		'section' => 'pnfpb_home_section',
		'type'    => 'checkbox',
	) );

	// ── Section: Footer ─────────────────────────────────────────────────
	$wp_customize->add_section( 'pnfpb_footer_section', array(
		'title' => esc_html__( 'Footer', PNFPB_TEXT_DOMAIN ),
		'panel' => 'pnfpb_theme_panel',
	) );

	// Footer about text.
	$wp_customize->add_setting( 'pnfpb_footer_about', array(
		'default'           => __( 'Push Notification for Post and BuddyPress (PNFPB) is a premium-quality free WordPress plugin that brings web push notifications, PWA support, and BuddyPress real‑time alerts to your site.', PNFPB_TEXT_DOMAIN ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'pnfpb_footer_about', array(
		'label'   => esc_html__( 'Footer About Text', PNFPB_TEXT_DOMAIN ),
		'section' => 'pnfpb_footer_section',
		'type'    => 'textarea',
	) );

	// Footer copyright text.
	$wp_customize->add_setting( 'pnfpb_footer_copyright', array(
		'default'           => sprintf(
			/* translators: %s: year */
			__( '&copy; %s Muralidharan Ramasamy / Indiacitys.com Technologies. All rights reserved.', PNFPB_TEXT_DOMAIN ),
			gmdate( 'Y' )
		),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'pnfpb_footer_copyright', array(
		'label'   => esc_html__( 'Copyright Text', PNFPB_TEXT_DOMAIN ),
		'section' => 'pnfpb_footer_section',
		'type'    => 'textarea',
	) );

	// ── Section: Social Media ───────────────────────────────────────────
	$wp_customize->add_section( 'pnfpb_social_section', array(
		'title'       => esc_html__( 'Social Media', PNFPB_TEXT_DOMAIN ),
		'description' => esc_html__( 'Social media profile URLs displayed in the footer.', PNFPB_TEXT_DOMAIN ),
		'panel'       => 'pnfpb_theme_panel',
	) );

	$social_networks = array(
		'twitter'   => __( 'Twitter / X URL', PNFPB_TEXT_DOMAIN ),
		'github'    => __( 'GitHub URL', PNFPB_TEXT_DOMAIN ),
		'wordpress' => __( 'WordPress.org URL', PNFPB_TEXT_DOMAIN ),
	);
	foreach ( $social_networks as $key => $label ) {
		$wp_customize->add_setting( 'pnfpb_social_' . $key, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'pnfpb_social_' . $key, array(
			'label'   => esc_html( $label ),
			'section' => 'pnfpb_social_section',
			'type'    => 'url',
		) );
	}
}

add_action( 'customize_preview_init', 'pnfpb_customizer_preview_js' );
/**
 * Enqueue the Customizer live preview script.
 */
function pnfpb_customizer_preview_js() : void {
	wp_enqueue_script(
		'pnfpb-customizer-preview',
		PNFPB_THEME_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		PNFPB_THEME_VERSION,
		true
	);
}
