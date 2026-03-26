<?php
/**
 * Hero slider section for the home page.
 *
 * @package PNFPB_Theme
 */

$slides = pnfpb_get_slider_data();

if ( empty( $slides ) ) {
	return;
}
?>
<section class="pnfpb-hero-slider-section" aria-label="<?php esc_attr_e( 'Feature highlights', PNFPB_TEXT_DOMAIN ); ?>">
	<div class="pnfpb-hero-slider" id="pnfpb-hero-slider" role="region" aria-roledescription="carousel">
		<!-- Slides -->
		<div class="pnfpb-slider-track" id="pnfpb-slider-track">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<div class="pnfpb-slide <?php echo esc_attr( $slide['slide_class'] ); ?>"
				     id="pnfpb-slide-<?php echo esc_attr( $index + 1 ); ?>"
				     role="group"
				     aria-roledescription="slide"
				     aria-label="<?php echo esc_attr( sprintf( '%d of %d', $index + 1, count( $slides ) ) ); ?>"
				     <?php if ( 0 !== $index ) : ?>aria-hidden="true"<?php endif; ?>>
					<div class="pnfpb-slide-overlay"></div>
				<div class="pnfpb-slide-bg-pattern" aria-hidden="true"></div>
				<div class="pnfpb-slide-inner">
					<div class="pnfpb-slide-content">
						<span class="pnfpb-slide-label">
							<?php echo wp_kses_post( pnfpb_icon( $slide['icon'], array( 'width' => 20, 'height' => 20 ) ) ); ?>
							<?php echo esc_html( $slide['label'] ); ?>
						</span>
						<h2 class="pnfpb-slide-title"><?php echo esc_html( $slide['title'] ); ?></h2>
						<p class="pnfpb-slide-desc"><?php echo esc_html( $slide['desc'] ); ?></p>
						<div class="pnfpb-slide-actions">
							<?php if ( ! empty( $slide['cta_url'] ) ) : ?>
								<a href="<?php echo esc_url( $slide['cta_url'] ); ?>"
								   class="pnfpb-btn pnfpb-btn--primary"
								   <?php if ( str_starts_with( $slide['cta_url'], 'http' ) && ! str_contains( $slide['cta_url'], home_url() ) ) : ?>
								       target="_blank" rel="noopener noreferrer"
								   <?php endif; ?>>
									<?php echo esc_html( $slide['cta_text'] ); ?>
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $slide['cta2_url'] ) ) : ?>
								<a href="<?php echo esc_url( $slide['cta2_url'] ); ?>"
								   class="pnfpb-btn pnfpb-btn--outline-white"
								   target="_blank" rel="noopener noreferrer">
									<?php echo wp_kses_post( pnfpb_icon( 'external-link', array( 'width' => 14, 'height' => 14 ) ) ); ?>
									<?php echo esc_html( $slide['cta2_text'] ); ?>
								</a>
							<?php endif; ?>
						</div><!-- .pnfpb-slide-actions -->
					</div><!-- .pnfpb-slide-content -->

					<?php if ( ! empty( $slide['image'] ) ) : ?>
						<div class="pnfpb-slide-image-wrap" aria-hidden="true">
							<img src="<?php echo esc_url( $slide['image'] ); ?>"
							     alt=""
							     loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>">
						</div>
					<?php else : ?>
						<div class="pnfpb-slide-icon-wrap" aria-hidden="true">
							<div class="pnfpb-slide-icon">
								<?php echo wp_kses_post( pnfpb_icon( $slide['icon'], array( 'width' => 90, 'height' => 90 ) ) ); ?>
							</div>
						</div>
					<?php endif; ?>
				</div><!-- .pnfpb-slide-inner -->
				</div><!-- .pnfpb-slide -->
			<?php endforeach; ?>
		</div><!-- .pnfpb-slider-track -->

		<!-- Controls -->
		<button class="pnfpb-slider-btn pnfpb-slider-btn--prev"
		        id="pnfpb-slider-prev"
		        aria-label="<?php esc_attr_e( 'Previous slide', PNFPB_TEXT_DOMAIN ); ?>">
			<?php echo wp_kses_post( pnfpb_icon( 'chevron-left', array( 'width' => 24, 'height' => 24 ) ) ); ?>
		</button>
		<button class="pnfpb-slider-btn pnfpb-slider-btn--next"
		        id="pnfpb-slider-next"
		        aria-label="<?php esc_attr_e( 'Next slide', PNFPB_TEXT_DOMAIN ); ?>">
			<?php echo wp_kses_post( pnfpb_icon( 'chevron-right', array( 'width' => 24, 'height' => 24 ) ) ); ?>
		</button>

		<!-- Dots -->
		<div class="pnfpb-slider-dots" role="tablist" aria-label="<?php esc_attr_e( 'Slide indicators', PNFPB_TEXT_DOMAIN ); ?>">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<button class="pnfpb-slider-dot <?php echo 0 === $index ? 'pnfpb-slider-dot--active' : ''; ?>"
				        role="tab"
				        aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
				        aria-controls="pnfpb-slide-<?php echo esc_attr( $index + 1 ); ?>"
				        aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %d', PNFPB_TEXT_DOMAIN ), $index + 1 ) ); ?>"
				        data-slide="<?php echo esc_attr( $index ); ?>">
				</button>
			<?php endforeach; ?>
		</div><!-- .pnfpb-slider-dots -->
	</div><!-- .pnfpb-hero-slider -->
</section><!-- .pnfpb-hero-slider-section -->
