<?php
/**
 * The template for displaying the 404 error page.
 *
 * @package PNFPB_Theme
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-error-404" role="main">
	<div class="pnfpb-container">
		<div class="pnfpb-404-wrap">
			<div class="pnfpb-404-icon" aria-hidden="true">
				<?php echo wp_kses_post( pnfpb_icon( 'alert-circle', array( 'width' => 80, 'height' => 80 ) ) ); ?>
			</div>
			<h1 class="pnfpb-404-title"><?php esc_html_e( '404', PNFPB_TEXT_DOMAIN ); ?></h1>
			<h2 class="pnfpb-404-heading"><?php esc_html_e( 'Page Not Found', PNFPB_TEXT_DOMAIN ); ?></h2>
			<p class="pnfpb-404-desc">
				<?php esc_html_e( "The page you're looking for doesn't exist or has been moved. Try the search below, or head back to the home page.", PNFPB_TEXT_DOMAIN ); ?>
			</p>

			<div class="pnfpb-404-search">
				<?php get_search_form(); ?>
			</div>

			<div class="pnfpb-404-actions">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="pnfpb-btn pnfpb-btn--primary">
					<?php echo wp_kses_post( pnfpb_icon( 'home', array( 'width' => 16, 'height' => 16 ) ) ); ?>
					<?php esc_html_e( 'Back to Home', PNFPB_TEXT_DOMAIN ); ?>
				</a>
				<a href="https://wiki.pnfpb.com" class="pnfpb-btn pnfpb-btn--outline" target="_blank" rel="noopener noreferrer">
					<?php echo wp_kses_post( pnfpb_icon( 'book', array( 'width' => 16, 'height' => 16 ) ) ); ?>
					<?php esc_html_e( 'Documentation', PNFPB_TEXT_DOMAIN ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="pnfpb-btn pnfpb-btn--outline">
					<?php echo wp_kses_post( pnfpb_icon( 'mail', array( 'width' => 16, 'height' => 16 ) ) ); ?>
					<?php esc_html_e( 'Contact Support', PNFPB_TEXT_DOMAIN ); ?>
				</a>
			</div>
		</div><!-- .pnfpb-404-wrap -->
	</div><!-- .pnfpb-container -->
</main><!-- #primary -->

<?php get_footer(); ?>
