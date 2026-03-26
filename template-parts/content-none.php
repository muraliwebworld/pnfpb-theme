<?php
/**
 * Template part — displayed when no content is found.
 *
 * @package PNFPB_Theme
 */
?>
<section class="pnfpb-no-results">
	<div class="pnfpb-no-results__icon" aria-hidden="true">
		<?php echo wp_kses_post( pnfpb_icon( 'search', array( 'width' => 60, 'height' => 60 ) ) ); ?>
	</div>
	<h2 class="pnfpb-no-results__title"><?php esc_html_e( 'Nothing Found', PNFPB_TEXT_DOMAIN ); ?></h2>

	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, no results matched your search terms. Please try different keywords.', PNFPB_TEXT_DOMAIN ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p>
			<?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", PNFPB_TEXT_DOMAIN ); ?>
		</p>
		<?php get_search_form(); ?>
		<div class="pnfpb-no-results__actions">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="pnfpb-btn pnfpb-btn--primary">
				<?php echo wp_kses_post( pnfpb_icon( 'home', array( 'width' => 16, 'height' => 16 ) ) ); ?>
				<?php esc_html_e( 'Back to Home', PNFPB_TEXT_DOMAIN ); ?>
			</a>
			<a href="https://wiki.pnfpb.com" class="pnfpb-btn pnfpb-btn--outline" target="_blank" rel="noopener noreferrer">
				<?php echo wp_kses_post( pnfpb_icon( 'book', array( 'width' => 16, 'height' => 16 ) ) ); ?>
				<?php esc_html_e( 'Browse Documentation', PNFPB_TEXT_DOMAIN ); ?>
			</a>
		</div>
	<?php endif; ?>
</section><!-- .pnfpb-no-results -->
