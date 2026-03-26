<?php
/**
 * PNFPB Theme – Theme setup.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Constants ───────────────────────────────────────────────────────────────
define( 'PNFPB_THEME_VERSION', '1.0.0' );
define( 'PNFPB_THEME_DIR', get_template_directory() );
define( 'PNFPB_THEME_URI', get_template_directory_uri() );
define( 'PNFPB_TEXT_DOMAIN', 'pnfpb-theme' );

// ─── Theme setup ─────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', 'pnfpb_theme_setup' );
/**
 * Set up theme defaults and registers support for various WordPress features.
 */
function pnfpb_theme_setup() {
	// Translation ready.
	load_theme_textdomain( PNFPB_TEXT_DOMAIN, PNFPB_THEME_DIR . '/languages' );

	// Automatic feed — let WP add head feed links.
	add_theme_support( 'automatic-feed-links' );

	// Document title.
	add_theme_support( 'title-tag' );

	// Post thumbnails.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'pnfpb-hero',    1920, 600,  true );
	add_image_size( 'pnfpb-card',    600,  400,  true );
	add_image_size( 'pnfpb-thumb',   300,  200,  true );
	add_image_size( 'pnfpb-avatar',  150,  150,  true );
	add_image_size( 'pnfpb-cover',   1200, 300,  true );

	// HTML5 markup.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Custom logo.
	add_theme_support( 'custom-logo', array(
		'height'               => 60,
		'width'                => 240,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'pnfpb-site-name' ),
		'unlink-homepage-logo' => false,
	) );

	// Custom header.
	add_theme_support( 'custom-header', array(
		'default-image'      => '',
		'default-text-color' => 'ffffff',
		'width'              => 1920,
		'height'             => 600,
		'flex-height'        => true,
		'flex-width'         => true,
	) );

	// Custom background.
	add_theme_support( 'custom-background', array(
		'default-color' => 'f6f7f8',
	) );

	// Selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Align-wide blocks.
	add_theme_support( 'align-wide' );

	// Responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Editor styles.
	add_editor_style( 'assets/css/editor-style.css' );

	// Do NOT declare add_theme_support('buddypress') here.
	// That flag signals to BP that the theme provides 100% native component
	// templates. Since this theme only ships partial buddypress/ partials,
	// BP falls back to its own theme-compat layer, which injects component
	// output via the_content() into the theme's standard page templates.
	// The bp_get_template_stack filter in inc/buddypress.php ensures BP
	// checks the theme's buddypress/ directory for any overrides first.

	// Menus.
	register_nav_menus( array(
		'primary'    => esc_html__( 'Primary Navigation', PNFPB_TEXT_DOMAIN ),
		'secondary'  => esc_html__( 'Secondary Navigation', PNFPB_TEXT_DOMAIN ),
		'footer-1'   => esc_html__( 'Footer – Plugin', PNFPB_TEXT_DOMAIN ),
		'footer-2'   => esc_html__( 'Footer – Documentation', PNFPB_TEXT_DOMAIN ),
		'footer-3'   => esc_html__( 'Footer – Community', PNFPB_TEXT_DOMAIN ),
		'social'     => esc_html__( 'Social Media Links', PNFPB_TEXT_DOMAIN ),
		'buddypress' => esc_html__( 'BuddyPress Member Nav', PNFPB_TEXT_DOMAIN ),
	) );
}

// ─── Content width ───────────────────────────────────────────────────────────
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

// ─── Widget areas ────────────────────────────────────────────────────────────
add_action( 'widgets_init', 'pnfpb_widgets_init' );
/**
 * Register widget areas (sidebars).
 */
function pnfpb_widgets_init() {
	$defaults = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array_merge( $defaults, array(
		'name'        => esc_html__( 'Main Sidebar', PNFPB_TEXT_DOMAIN ),
		'id'          => 'sidebar-main',
		'description' => esc_html__( 'Appears on posts and pages with a sidebar.', PNFPB_TEXT_DOMAIN ),
	) ) );

	register_sidebar( array_merge( $defaults, array(
		'name'        => esc_html__( 'Blog Sidebar', PNFPB_TEXT_DOMAIN ),
		'id'          => 'sidebar-blog',
		'description' => esc_html__( 'Appears on blog archive and single post pages.', PNFPB_TEXT_DOMAIN ),
	) ) );

	register_sidebar( array_merge( $defaults, array(
		'name'        => esc_html__( 'BuddyPress Sidebar', PNFPB_TEXT_DOMAIN ),
		'id'          => 'sidebar-buddypress',
		'description' => esc_html__( 'Appears on BuddyPress pages.', PNFPB_TEXT_DOMAIN ),
	) ) );

	register_sidebar( array_merge( $defaults, array(
		'name'        => esc_html__( 'Footer – Column 1', PNFPB_TEXT_DOMAIN ),
		'id'          => 'footer-1',
		'description' => esc_html__( 'First footer widget column.', PNFPB_TEXT_DOMAIN ),
	) ) );

	register_sidebar( array_merge( $defaults, array(
		'name'        => esc_html__( 'Footer – Column 2', PNFPB_TEXT_DOMAIN ),
		'id'          => 'footer-2',
		'description' => esc_html__( 'Second footer widget column.', PNFPB_TEXT_DOMAIN ),
	) ) );

	register_sidebar( array_merge( $defaults, array(
		'name'        => esc_html__( 'Footer – Column 3', PNFPB_TEXT_DOMAIN ),
		'id'          => 'footer-3',
		'description' => esc_html__( 'Third footer widget column.', PNFPB_TEXT_DOMAIN ),
	) ) );
}

// ─── Body class extras ───────────────────────────────────────────────────────
add_filter( 'body_class', 'pnfpb_body_classes' );
/**
 * Adds custom classes to the body element.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function pnfpb_body_classes( array $classes ) : array {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
		$classes[] = 'pnfpb-buddypress-page';
	}
	if ( is_front_page() ) {
		$classes[] = 'pnfpb-front-page';
	}
	$classes[] = 'pnfpb-theme';
	return $classes;
}

// ─── Excerpt ─────────────────────────────────────────────────────────────────
add_filter( 'excerpt_length', 'pnfpb_excerpt_length' );
function pnfpb_excerpt_length() : int {
	return 28;
}

add_filter( 'excerpt_more', 'pnfpb_excerpt_more' );
function pnfpb_excerpt_more() : string {
	return '&hellip;';
}

// ─── Password-protected post form ────────────────────────────────────────────
add_filter( 'the_password_form', 'pnfpb_password_form' );
/**
 * Custom password-protected post form.
 *
 * @param string $output Existing form HTML.
 * @return string
 */
function pnfpb_password_form( string $output ) : string {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : (int) $post->ID );
	return sprintf(
		'<form action="%s" class="pnfpb-password-form" method="post">
			<p>%s</p>
			<label for="%s">%s<br>
				<input name="post_password" id="%s" type="password" class="pnfpb-form-control" size="20" autocomplete="current-password">
			</label>
			<input type="submit" name="Submit" value="%s" class="pnfpb-btn pnfpb-btn-primary">
		</form>',
		esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ),
		esc_html__( 'This content is password-protected. Enter your password to view it.', PNFPB_TEXT_DOMAIN ),
		esc_attr( $label ),
		esc_html__( 'Password:', PNFPB_TEXT_DOMAIN ),
		esc_attr( $label ),
		esc_attr__( 'Enter', PNFPB_TEXT_DOMAIN )
	);
}

// ─── Allow inline SVG through wp_kses_post ───────────────────────────────────
add_filter( 'wp_kses_allowed_html', 'pnfpb_kses_allow_svg', 10, 2 );
/**
 * Extends wp_kses_post to allow the inline SVG elements produced by pnfpb_icon().
 * Required on WordPress < 6.5 where SVG support was not yet part of kses_post.
 *
 * @param array  $allowed_tags Allowed tags and attributes.
 * @param string $context      KSES context name.
 * @return array
 */
function pnfpb_kses_allow_svg( array $allowed_tags, string $context ) : array {
	if ( 'post' !== $context ) {
		return $allowed_tags;
	}

	$svg_atts = array(
		'xmlns'            => true,
		'width'            => true,
		'height'           => true,
		'viewbox'          => true,
		'fill'             => true,
		'stroke'           => true,
		'stroke-width'     => true,
		'stroke-linecap'   => true,
		'stroke-linejoin'  => true,
		'class'            => true,
		'aria-hidden'      => true,
		'aria-label'       => true,
		'role'             => true,
		'focusable'        => true,
	);

	$allowed_tags['svg']      = $svg_atts;
	$allowed_tags['path']     = array( 'd' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true );
	$allowed_tags['circle']   = array( 'cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true );
	$allowed_tags['line']     = array( 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true );
	$allowed_tags['polyline'] = array( 'points' => true, 'fill' => true, 'stroke' => true );
	$allowed_tags['polygon']  = array( 'points' => true, 'fill' => true, 'stroke' => true );
	$allowed_tags['rect']     = array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true );

	return $allowed_tags;
}
