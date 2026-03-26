<?php
/**
 * BuddyPress community groups section for the home page.
 *
 * @package PNFPB_Theme
 */

$community_groups = pnfpb_get_community_groups();

if ( empty( $community_groups ) ) {
	return;
}

// Determine the BuddyPress groups directory URL.
?>
<section class="pnfpb-groups-section" id="community" aria-labelledby="community-heading">
	<div class="pnfpb-container">
		<div class="pnfpb-section-header">
			<span class="pnfpb-section-label">
				<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 18, 'height' => 18 ) ) ); ?>
				<?php esc_html_e( 'Community', PNFPB_TEXT_DOMAIN ); ?>
			</span>
			<h2 id="community-heading" class="pnfpb-section-title">
				<?php esc_html_e( 'Join the PNFPB Community', PNFPB_TEXT_DOMAIN ); ?>
			</h2>
			<p class="pnfpb-section-desc">
				<?php esc_html_e( 'Connect with other PNFPB users, share feedback, get support, and stay updated. Join a group that matches your interests.', PNFPB_TEXT_DOMAIN ); ?>
			</p>
		</div><!-- .pnfpb-section-header -->

		<div class="pnfpb-groups-grid">
			<?php foreach ( $community_groups as $group ) :
				// Build the group URL using either live BuddyPress data or slug fallback.
				if ( function_exists( 'groups_get_id' ) ) {
					$group_id  = groups_get_id( $group['slug'] );
					$group_url = $group_id ? bp_get_group_permalink( groups_get_group( $group_id ) ) : pnfpb_bp_group_url( $group['slug'] );
					$count_raw = $group_id ? groups_get_total_member_count( $group_id ) : null;
				} else {
					$group_url = pnfpb_bp_group_url( $group['slug'] );
					$count_raw = null;
				}
			?>
				<article class="pnfpb-group-card pnfpb-group-card--<?php echo esc_attr( $group['color'] ); ?>">
					<div class="pnfpb-group-card__icon">
						<?php echo wp_kses_post( pnfpb_icon( $group['icon'], array( 'width' => 32, 'height' => 32 ) ) ); ?>
					</div>
					<div class="pnfpb-group-card__body">
						<h3 class="pnfpb-group-card__name"><?php echo esc_html( $group['name'] ); ?></h3>
						<p class="pnfpb-group-card__desc"><?php echo esc_html( $group['desc'] ); ?></p>
						<div class="pnfpb-group-card__meta">
							<?php if ( null !== $count_raw ) : ?>
								<span class="pnfpb-group-card__count">
									<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 13, 'height' => 13 ) ) ); ?>
									<?php echo esc_html( sprintf(
										/* translators: %d: member count */
										_n( '%d member', '%d members', (int) $count_raw, PNFPB_TEXT_DOMAIN ),
										(int) $count_raw
									) ); ?>
								</span>
							<?php endif; ?>
							<span class="pnfpb-group-card__status
							             <?php echo 'public' === $group['status'] ? 'pnfpb-group-card__status--public' : 'pnfpb-group-card__status--private'; ?>">
								<?php echo 'public' === $group['status']
									? esc_html__( 'Public', PNFPB_TEXT_DOMAIN )
									: esc_html__( 'Private', PNFPB_TEXT_DOMAIN ); ?>
							</span>
						</div>
					</div><!-- .pnfpb-group-card__body -->
					<div class="pnfpb-group-card__footer">
						<a href="<?php echo esc_url( $group_url ); ?>"
						   class="pnfpb-btn pnfpb-btn--sm pnfpb-btn--<?php echo esc_attr( $group['color'] ); ?>">
							<?php esc_html_e( 'Join Group', PNFPB_TEXT_DOMAIN ); ?>
							<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 14, 'height' => 14 ) ) ); ?>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div><!-- .pnfpb-groups-grid -->

		<div class="pnfpb-section-cta">
			<?php
			$all_groups_url = pnfpb_bp_directory_url( 'groups' );
			?>
			<a href="<?php echo esc_url( $all_groups_url ); ?>" class="pnfpb-btn pnfpb-btn--outline">
				<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 18, 'height' => 18 ) ) ); ?>
				<?php esc_html_e( 'Browse All Groups', PNFPB_TEXT_DOMAIN ); ?>
			</a>
		</div><!-- .pnfpb-section-cta -->
	</div><!-- .pnfpb-container -->
</section><!-- .pnfpb-groups-section -->
