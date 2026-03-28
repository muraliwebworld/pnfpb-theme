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
 * Build structured breadcrumb data for the current page.
 *
 * Returns an array of [ 'label' => string, 'url' => string ] entries.
 * Items without a meaningful URL (e.g. search results) use an empty string.
 */
function pnfpb_get_breadcrumb_items() : array {
	if ( is_front_page() ) {
		return array();
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
		return array();
	}

	$items   = array();
	$items[] = array(
		'label' => __( 'Home', PNFPB_TEXT_DOMAIN ),
		'url'   => home_url( '/' ),
	);

	if ( is_category() ) {
		$cat_obj = get_queried_object();
		$items[] = array(
			'label' => $cat_obj->name,
			'url'   => (string) get_category_link( $cat_obj->term_id ),
		);
	} elseif ( is_tag() ) {
		$tag_obj = get_queried_object();
		$items[] = array(
			'label' => $tag_obj->name,
			'url'   => (string) get_tag_link( $tag_obj->term_id ),
		);
	} elseif ( is_author() ) {
		$author_id = get_queried_object_id();
		$items[]   = array(
			'label' => get_the_author_meta( 'display_name', $author_id ),
			'url'   => (string) get_author_posts_url( $author_id ),
		);
	} elseif ( is_search() ) {
		/* translators: %s: search query */
		$items[] = array(
			'label' => sprintf( __( 'Search: %s', PNFPB_TEXT_DOMAIN ), get_search_query() ),
			'url'   => '',
		);
	} elseif ( is_singular() ) {
		if ( is_attachment() ) {
			$parent_id = get_post()->post_parent;
			$items[]   = array(
				'label' => get_the_title( $parent_id ),
				'url'   => (string) get_permalink( $parent_id ),
			);
		} elseif ( get_post_type() === 'post' ) {
			$cats = get_the_category();
			if ( $cats ) {
				$items[] = array(
					'label' => $cats[0]->name,
					'url'   => (string) get_category_link( $cats[0]->term_id ),
				);
			}
		}
		$items[] = array(
			'label' => get_the_title(),
			'url'   => (string) get_permalink(),
		);
	} elseif ( is_page() ) {
		$page_obj = get_queried_object();
		if ( $page_obj->post_parent ) {
			$items[] = array(
				'label' => get_the_title( $page_obj->post_parent ),
				'url'   => (string) get_permalink( $page_obj->post_parent ),
			);
		}
		$items[] = array(
			'label' => get_the_title(),
			'url'   => (string) get_permalink(),
		);
	} elseif ( is_404() ) {
		$items[] = array(
			'label' => __( '404 – Not Found', PNFPB_TEXT_DOMAIN ),
			'url'   => '',
		);
	}

	return $items;
}

add_action( 'wp_head', 'pnfpb_breadcrumb_json_ld', 5 );
/**
 * Output a JSON-LD BreadcrumbList structured data block in <head>.
 *
 * JSON-LD is Google's recommended format. Each ListItem includes both
 * "name" (required) and "item" (the URL, required when available) so
 * Search Console reports no missing-field errors.
 *
 * Skipped when a dedicated SEO plugin is active (they own their Schema output).
 */
function pnfpb_breadcrumb_json_ld() : void {
	if (
		class_exists( 'WPSEO_Frontend' )         // Yoast SEO
		|| class_exists( 'RankMath' )              // Rank Math
		|| class_exists( 'AIOSEO\Plugin\AIOSEO' )  // All in One SEO
	) {
		return;
	}

	$items = pnfpb_get_breadcrumb_items();
	if ( empty( $items ) ) {
		return;
	}

	$list_elements = array();
	foreach ( $items as $index => $item ) {
		$element = array(
			'@type'    => 'ListItem',
			'position' => $index + 1,
			'name'     => $item['label'],
		);
		if ( ! empty( $item['url'] ) ) {
			$element['item'] = $item['url'];
		}
		$list_elements[] = $element;
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $list_elements,
	);

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}

/**
 * Outputs a simple accessible breadcrumb trail (HTML only).
 * Structured data (JSON-LD) is handled separately by pnfpb_breadcrumb_json_ld().
 */
function pnfpb_breadcrumbs() : void {
	$items = pnfpb_get_breadcrumb_items();
	if ( empty( $items ) ) {
		return;
	}

	echo '<nav class="pnfpb-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', PNFPB_TEXT_DOMAIN ) . '">';
	echo '<ol class="pnfpb-breadcrumb-list">';
	foreach ( $items as $item ) {
		echo '<li class="pnfpb-breadcrumb-item">';
		if ( ! empty( $item['url'] ) ) {
			echo '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['label'] ) . '</a>';
		} else {
			echo '<span>' . esc_html( $item['label'] ) . '</span>';
		}
		echo '</li>';
	}
	echo '</ol></nav>';
}
