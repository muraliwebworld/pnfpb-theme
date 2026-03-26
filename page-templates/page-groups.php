<?php
/**
 * Template Name: BuddyPress Groups
 *
 * @package PNFPB_Theme
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-bp-groups-page" role="main">
	<div class="pnfpb-container">

		<div class="pnfpb-page-hero">

			<h1 class="pnfpb-page-hero__title">
				<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 28, 'height' => 28 ) ) ); ?>
				<?php esc_html_e( 'Community Groups', PNFPB_TEXT_DOMAIN ); ?>
			</h1>
			<p class="pnfpb-page-hero__desc">
				<?php esc_html_e( 'Join a group, collaborate with other PNFPB users, and stay updated on plugin news and feature discussions.', PNFPB_TEXT_DOMAIN ); ?>
			</p>
		</div>

		<?php if ( function_exists( 'bp_has_groups' ) ) : ?>
			<div class="pnfpb-bp-groups-wrap">
				<?php bp_groups_the_loop(); ?>
			</div>
		<?php else : ?>
			<!-- Fallback: show static community groups -->
			<?php get_template_part( 'template-parts/home/bp-groups' ); ?>
		<?php endif; ?>

	</div><!-- .pnfpb-container -->
</main><!-- #primary -->

<?php get_footer(); ?>
