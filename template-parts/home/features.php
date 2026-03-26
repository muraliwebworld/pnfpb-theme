<?php
/**
 * Plugin features section for the home page.
 *
 * @package PNFPB_Theme
 */

$features = pnfpb_get_plugin_features();

if ( empty( $features ) ) {
	return;
}
?>
<section class="pnfpb-features-section" id="features" aria-labelledby="features-heading">
	<div class="pnfpb-container">
		<div class="pnfpb-section-header">
			<span class="pnfpb-section-label">
				<?php echo wp_kses_post( pnfpb_icon( 'zap', array( 'width' => 18, 'height' => 18 ) ) ); ?>
				<?php esc_html_e( 'Why Choose PNFPB?', PNFPB_TEXT_DOMAIN ); ?>
			</span>
			<h2 id="features-heading" class="pnfpb-section-title">
				<?php esc_html_e( 'Powerful Push Notification Features', PNFPB_TEXT_DOMAIN ); ?>
			</h2>
			<p class="pnfpb-section-desc">
				<?php esc_html_e( 'Everything you need to keep your community engaged — from automatic post notifications to BuddyPress activity alerts, PWA support, and mobile app integration.', PNFPB_TEXT_DOMAIN ); ?>
			</p>
		</div><!-- .pnfpb-section-header -->

		<div class="pnfpb-features-grid">
			<?php foreach ( $features as $feature ) : ?>
				<article class="pnfpb-feature-card pnfpb-feature-card--<?php echo esc_attr( $feature['color'] ?? 'blue' ); ?>">
					<div class="pnfpb-feature-card__icon">
						<?php echo wp_kses_post( pnfpb_icon( $feature['icon'], array( 'width' => 28, 'height' => 28 ) ) ); ?>
					</div>
					<h3 class="pnfpb-feature-card__title"><?php echo esc_html( $feature['title'] ); ?></h3>
					<p class="pnfpb-feature-card__desc"><?php echo esc_html( $feature['desc'] ); ?></p>
					<?php if ( ! empty( $feature['doc_url'] ) ) : ?>
						<a href="<?php echo esc_url( $feature['doc_url'] ); ?>"
						   class="pnfpb-feature-card__link"
						   target="_blank"
						   rel="noopener noreferrer"
						   aria-label="<?php echo esc_attr( sprintf( __( 'Learn about %s', PNFPB_TEXT_DOMAIN ), $feature['title'] ) ); ?>">
							<?php esc_html_e( 'Learn more', PNFPB_TEXT_DOMAIN ); ?>
							<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 14, 'height' => 14 ) ) ); ?>
						</a>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div><!-- .pnfpb-features-grid -->

		<div class="pnfpb-section-cta">
			<a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/"
			   class="pnfpb-btn pnfpb-btn--primary pnfpb-btn--lg"
			   target="_blank"
			   rel="noopener noreferrer">
				<?php echo wp_kses_post( pnfpb_icon( 'download', array( 'width' => 18, 'height' => 18 ) ) ); ?>
				<?php esc_html_e( 'Download Free from WordPress.org', PNFPB_TEXT_DOMAIN ); ?>
			</a>
			<a href="https://wiki.pnfpb.com"
			   class="pnfpb-btn pnfpb-btn--outline"
			   target="_blank"
			   rel="noopener noreferrer">
				<?php echo wp_kses_post( pnfpb_icon( 'book', array( 'width' => 18, 'height' => 18 ) ) ); ?>
				<?php esc_html_e( 'Browse Documentation', PNFPB_TEXT_DOMAIN ); ?>
			</a>
		</div><!-- .pnfpb-section-cta -->
	</div><!-- .pnfpb-container -->
</section><!-- .pnfpb-features-section -->
