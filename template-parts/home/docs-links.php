<?php
/**
 * Documentation links section for the home page.
 *
 * @package PNFPB_Theme
 */

$doc_links = pnfpb_get_doc_links();

if ( empty( $doc_links ) ) {
	return;
}
?>
<section class="pnfpb-docs-section" id="documentation" aria-labelledby="docs-heading">
	<div class="pnfpb-container">
		<div class="pnfpb-section-header">
			<span class="pnfpb-section-label">
				<?php echo wp_kses_post( pnfpb_icon( 'book', array( 'width' => 18, 'height' => 18 ) ) ); ?>
				<?php esc_html_e( 'Documentation', PNFPB_TEXT_DOMAIN ); ?>
			</span>
			<h2 id="docs-heading" class="pnfpb-section-title">
				<?php esc_html_e( 'Complete PNFPB Documentation', PNFPB_TEXT_DOMAIN ); ?>
			</h2>
			<p class="pnfpb-section-desc">
				<?php esc_html_e( 'Step-by-step guides and tutorials for every PNFPB feature — from initial installation to advanced customisation and mobile app integration.', PNFPB_TEXT_DOMAIN ); ?>
			</p>
		</div><!-- .pnfpb-section-header -->

		<div class="pnfpb-docs-grid">
			<?php foreach ( $doc_links as $doc ) : ?>
				<a href="<?php echo esc_url( $doc['url'] ); ?>"
				   class="pnfpb-doc-link"
				   target="_blank"
				   rel="noopener noreferrer"
				   aria-label="<?php echo esc_attr( $doc['title'] ); ?>">
					<span class="pnfpb-doc-link__icon">
						<?php echo wp_kses_post( pnfpb_icon( $doc['icon'], array( 'width' => 22, 'height' => 22 ) ) ); ?>
					</span>
					<span class="pnfpb-doc-link__body">
						<span class="pnfpb-doc-link__title"><?php echo esc_html( $doc['title'] ); ?></span>
						<?php if ( ! empty( $doc['desc'] ) ) : ?>
							<span class="pnfpb-doc-link__desc"><?php echo esc_html( $doc['desc'] ); ?></span>
						<?php endif; ?>
					</span>
					<span class="pnfpb-doc-link__arrow" aria-hidden="true">
						<?php echo wp_kses_post( pnfpb_icon( 'external-link', array( 'width' => 14, 'height' => 14 ) ) ); ?>
					</span>
				</a>
			<?php endforeach; ?>
		</div><!-- .pnfpb-docs-grid -->

		<!-- Documentation CTA banner -->
		<aside class="pnfpb-docs-cta-banner" role="complementary">
			<div class="pnfpb-docs-cta-banner__text">
				<h3><?php esc_html_e( 'Can\'t find what you\'re looking for?', PNFPB_TEXT_DOMAIN ); ?></h3>
				<p><?php esc_html_e( 'Our full documentation wiki covers every configuration option and advanced use case.', PNFPB_TEXT_DOMAIN ); ?></p>
			</div>
			<div class="pnfpb-docs-cta-banner__actions">
				<a href="https://wiki.pnfpb.com"
				   class="pnfpb-btn pnfpb-btn--primary"
				   target="_blank"
				   rel="noopener noreferrer">
					<?php echo wp_kses_post( pnfpb_icon( 'book', array( 'width' => 16, 'height' => 16 ) ) ); ?>
					<?php esc_html_e( 'Visit Full Wiki', PNFPB_TEXT_DOMAIN ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
				   class="pnfpb-btn pnfpb-btn--outline">
					<?php echo wp_kses_post( pnfpb_icon( 'mail', array( 'width' => 16, 'height' => 16 ) ) ); ?>
					<?php esc_html_e( 'Ask the Community', PNFPB_TEXT_DOMAIN ); ?>
				</a>
			</div>
		</aside><!-- .pnfpb-docs-cta-banner -->
	</div><!-- .pnfpb-container -->
</section><!-- .pnfpb-docs-section -->
