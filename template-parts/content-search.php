<?php
/**
 * Template part — search result card (minimal excerpt display).
 *
 * @package PNFPB_Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'pnfpb-search-result' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="pnfpb-search-result__thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'pnfpb-thumb', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="pnfpb-search-result__body">
		<div class="pnfpb-search-result__meta">
			<span class="pnfpb-search-result__type">
				<?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ?? get_post_type() ); ?>
			</span>
			<?php pnfpb_posted_on(); ?>
		</div>
		<h2 class="pnfpb-search-result__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="pnfpb-search-result__excerpt"><?php the_excerpt(); ?></p>
		<a href="<?php the_permalink(); ?>" class="pnfpb-btn pnfpb-btn--sm pnfpb-btn--outline">
			<?php esc_html_e( 'View', PNFPB_TEXT_DOMAIN ); ?>
			<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 13, 'height' => 13 ) ) ); ?>
		</a>
	</div><!-- .pnfpb-search-result__body -->

</article><!-- #post-<?php the_ID(); ?> -->
