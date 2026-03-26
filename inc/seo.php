<?php
/**
 * PNFPB Theme – SEO helpers.
 *
 * Outputs meta tags, Open Graph, and Twitter Card markup unless an SEO
 * plugin (Yoast, RankMath, AIOSEO) is already present.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', 'pnfpb_seo_meta_tags', 1 );
/**
 * Output meta description, Open Graph, and Twitter Card tags.
 */
function pnfpb_seo_meta_tags() : void {
	// Bail out if a dedicated SEO plugin is active.
	if (
		class_exists( 'WPSEO_Frontend' )        // Yoast SEO
		|| class_exists( 'RankMath' )             // Rank Math
		|| class_exists( 'AIOSEO\Plugin\AIOSEO' ) // All in One SEO
	) {
		return;
	}

	$description = '';
	$image_url   = '';

	if ( is_front_page() || is_home() ) {
		$description = get_bloginfo( 'description', 'display' );
		if ( empty( $description ) ) {
			$description = esc_html__( 'Push Notification for Post and BuddyPress (PNFPB) – the must-have WordPress plugin for web push notifications, PWA, BuddyPress activity notifications and mobile app integration.', PNFPB_TEXT_DOMAIN );
		}
	} elseif ( is_singular() ) {
		global $post;
		$description = get_the_excerpt();
		if ( has_post_thumbnail( $post ) ) {
			$image_url = get_the_post_thumbnail_url( $post, 'pnfpb-hero' );
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$term_obj    = get_queried_object();
		$description = wp_strip_all_tags( term_description( $term_obj ) );
	} elseif ( is_author() ) {
		$author_id   = get_queried_object_id();
		$description = wp_strip_all_tags( get_the_author_meta( 'description', $author_id ) );
	} elseif ( is_search() ) {
		/* translators: %s: search query */
		$description = sprintf( esc_html__( 'Search results for: %s', PNFPB_TEXT_DOMAIN ), get_search_query() );
	}

	// Fallback image: custom logo or site icon.
	if ( empty( $image_url ) ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$image_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		} else {
			$image_url = get_site_icon_url( 512 );
		}
	}

	$description = wp_strip_all_tags( $description );
	$description = wp_trim_words( $description, 30, '' );
	$description = esc_attr( $description );

	$title    = esc_attr( wp_get_document_title() );
	$site_url = esc_url( get_permalink() ?: home_url( '/' ) );

	if ( ! empty( $description ) ) {
		printf( '<meta name="description" content="%s">' . "\n", $description );
	}

	// Open Graph.
	printf( '<meta property="og:type"        content="%s">' . "\n", is_single() ? 'article' : 'website' );
	printf( '<meta property="og:url"         content="%s">' . "\n", $site_url );
	printf( '<meta property="og:title"       content="%s">' . "\n", $title );
	printf( '<meta property="og:site_name"   content="%s">' . "\n", esc_attr( get_bloginfo( 'name', 'display' ) ) );
	if ( ! empty( $description ) ) {
		printf( '<meta property="og:description" content="%s">' . "\n", $description );
	}
	if ( ! empty( $image_url ) ) {
		printf( '<meta property="og:image"      content="%s">' . "\n", esc_url( $image_url ) );
	}

	// Twitter Card.
	printf( '<meta name="twitter:card"        content="summary_large_image">' . "\n" );
	printf( '<meta name="twitter:title"       content="%s">' . "\n", $title );
	if ( ! empty( $description ) ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", $description );
	}
	if ( ! empty( $image_url ) ) {
		printf( '<meta name="twitter:image"      content="%s">' . "\n", esc_url( $image_url ) );
	}

	// Canonical.
	if ( is_singular() ) {
		printf( '<link rel="canonical" href="%s">' . "\n", $site_url );
	}

	// Robots: noindex on search and 404.
	if ( is_search() || is_404() ) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	}
}

// ─── Breadcrumbs ─────────────────────────────────────────────────────────
/**
 * Outputs a simple accessible breadcrumb trail.
 * Uses BuddyPress breadcrumb when on BP pages.
 */
function pnfpb_breadcrumbs() : void {
	return; // Breadcrumbs removed — delete this line to re-enable.
	if ( is_front_page() ) { // phpcs:ignore Squiz.PHP.NonExecutableCode.ReturnNotRequired
		return;
	}

	// No breadcrumb on any BuddyPress page — BP renders its own context.
	if (
		( function_exists( 'is_buddypress' ) && is_buddypress() ) ||
		( function_exists( 'bp_is_user' ) && bp_is_user() ) ||
		( function_exists( 'bp_is_group' ) && bp_is_group() ) ||
		( function_exists( 'bp_is_activity_component' ) && bp_is_activity_component() ) ||
		( function_exists( 'bp_is_groups_component' ) && bp_is_groups_component() ) ||
		( function_exists( 'bp_is_members_component' ) && bp_is_members_component() )
	) {
		return;
	}

	$separator   = '<span class="pnfpb-breadcrumb-sep" aria-hidden="true"> › </span>';
	$items       = array();
	$items[]     = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', PNFPB_TEXT_DOMAIN ) . '</a>';

	if ( is_category() ) {
		$cat_obj = get_queried_object();
		$items[] = '<span>' . esc_html( $cat_obj->name ) . '</span>';
	} elseif ( is_tag() ) {
		$tag_obj = get_queried_object();
		$items[] = '<span>' . esc_html( $tag_obj->name ) . '</span>';
	} elseif ( is_author() ) {
		$items[] = '<span>' . esc_html( get_the_author() ) . '</span>';
	} elseif ( is_search() ) {
		/* translators: %s: search query */
		$items[] = '<span>' . sprintf( esc_html__( 'Search: %s', PNFPB_TEXT_DOMAIN ), '<q>' . esc_html( get_search_query() ) . '</q>' ) . '</span>';
	} elseif ( is_singular() ) {
		if ( is_attachment() ) {
			$items[] = '<a href="' . esc_url( get_permalink( get_post()->post_parent ) ) . '">' . esc_html( get_the_title( get_post()->post_parent ) ) . '</a>';
		} elseif ( get_post_type() === 'post' ) {
			$cats = get_the_category();
			if ( $cats ) {
				$items[] = '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
			}
		}
		$items[] = '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_page() ) {
		$page_obj = get_queried_object();
		if ( $page_obj->post_parent ) {
			$items[] = '<a href="' . esc_url( get_permalink( $page_obj->post_parent ) ) . '">' . esc_html( get_the_title( $page_obj->post_parent ) ) . '</a>';
		}
		$items[] = '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_404() ) {
		$items[] = '<span>' . esc_html__( '404 – Not Found', PNFPB_TEXT_DOMAIN ) . '</span>';
	}

	echo '<nav class="pnfpb-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', PNFPB_TEXT_DOMAIN ) . '">';
	echo '<ol class="pnfpb-breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
	foreach ( $items as $index => $item ) {
		$pos = $index + 1;
		echo '<li class="pnfpb-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		echo wp_kses( $item, array( 'a' => array( 'href' => array() ), 'span' => array(), 'q' => array() ) );
		echo '<meta itemprop="position" content="' . esc_attr( (string) $pos ) . '">';
		echo '</li>';
		if ( $index < count( $items ) - 1 ) {
			echo wp_kses( $separator, array( 'span' => array( 'class' => array(), 'aria-hidden' => array() ) ) );
		}
	}
	echo '</ol></nav>';
}
