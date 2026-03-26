<?php
/**
 * Template Name: BuddyPress Activity
 *
 * @package PNFPB_Theme
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-bp-activity-page" role="main">
	<div class="pnfpb-container">

		<div class="pnfpb-page-hero">

			<h1 class="pnfpb-page-hero__title">
				<?php echo wp_kses_post( pnfpb_icon( 'activity', array( 'width' => 28, 'height' => 28 ) ) ); ?>
				<?php esc_html_e( 'Community Activity', PNFPB_TEXT_DOMAIN ); ?>
			</h1>
			<p class="pnfpb-page-hero__desc">
				<?php esc_html_e( "See what's happening across the PNFPB community — posts, comments, group activity, and member updates.", PNFPB_TEXT_DOMAIN ); ?>
			</p>
		</div>

		<?php if ( function_exists( 'bp_has_activities' ) ) : ?>
			<div id="activity-stream" class="activity pnfpb-bp-activity-wrap" data-bp-list="activity">
				<ul class="bp-list">
					<?php if ( bp_has_activities( array( 'max' => 20 ) ) ) : ?>
						<?php while ( bp_activities() ) : bp_the_activity(); ?>
							<?php bp_get_template_part( 'activity/entry' ); ?>
						<?php endwhile; ?>
					<?php else : ?>
						<li class="pnfpb-no-results">
							<p><?php esc_html_e( 'No activity yet. Be the first to post!', PNFPB_TEXT_DOMAIN ); ?></p>
						</li>
					<?php endif; ?>
				</ul>
			</div><!-- #activity-stream -->
		<?php elseif ( is_user_logged_in() ) : ?>
			<div class="pnfpb-notice pnfpb-notice--info">
				<?php echo wp_kses_post( pnfpb_icon( 'alert-circle', array( 'width' => 20, 'height' => 20 ) ) ); ?>
				<?php esc_html_e( 'BuddyPress is required for the activity feed. Please install and activate the BuddyPress plugin.', PNFPB_TEXT_DOMAIN ); ?>
			</div>
		<?php else : ?>
			<div class="pnfpb-notice pnfpb-notice--info">
				<?php esc_html_e( 'Please log in to view the activity feed.', PNFPB_TEXT_DOMAIN ); ?>
				<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="pnfpb-btn pnfpb-btn--primary pnfpb-btn--sm">
					<?php esc_html_e( 'Log In', PNFPB_TEXT_DOMAIN ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div><!-- .pnfpb-container -->
</main><!-- #primary -->

<?php get_footer(); ?>
