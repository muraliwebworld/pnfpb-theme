<?php
/**
 * The sidebar template.
 *
 * @package PNFPB_Theme
 */

if ( ! is_active_sidebar( 'sidebar-main' ) && ! is_active_sidebar( 'sidebar-blog' ) && ! is_active_sidebar( 'sidebar-buddypress' ) ) {
	return;
}

$sidebar_id = 'sidebar-main';
if ( is_singular( 'post' ) || is_archive() || is_home() ) {
	$sidebar_id = 'sidebar-blog';
} elseif ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
	$sidebar_id = 'sidebar-buddypress';
}
?>
<aside id="secondary" class="pnfpb-sidebar widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', PNFPB_TEXT_DOMAIN ); ?>">
	<?php dynamic_sidebar( $sidebar_id ); ?>
</aside><!-- #secondary -->
