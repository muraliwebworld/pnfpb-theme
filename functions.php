<?php
/**
 * PNFPB Theme – functions.php
 *
 * Entry point: loads all theme includes.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/buddypress.php';
require get_template_directory() . '/inc/seo.php';
require get_template_directory() . '/inc/security.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/widgets.php';
