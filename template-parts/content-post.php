<?php
/**
 * Template part — blog post card (archive / home loops).
 *
 * @package PNFPB_Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'pnfpb-post-card' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="pnfpb-post-card__thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'pnfpb-card', array(
				'loading' => 'lazy',
				'alt'     => '',
			) ); ?>
		</a>
	<?php endif; ?>

	<div class="pnfpb-post-card__body">
		<div class="pnfpb-post-card__meta">
			<?php pnfpb_posted_on(); ?>
			<?php pnfpb_posted_by(); ?>
		</div>

		<h2 class="pnfpb-post-card__title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

		<?php if ( '' !== get_the_excerpt() ) : ?>
			<div class="pnfpb-post-card__excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		<div class="pnfpb-post-card__footer">
			<a href="<?php the_permalink(); ?>" class="pnfpb-btn pnfpb-btn--sm pnfpb-btn--outline"
			   aria-label="<?php echo esc_attr( sprintf(
			       /* translators: %s: post title */
			       __( 'Read more: %s', PNFPB_TEXT_DOMAIN ),
			       get_the_title()
			   ) ); ?>">
				<?php esc_html_e( 'Read More', PNFPB_TEXT_DOMAIN ); ?>
				<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 14, 'height' => 14 ) ) ); ?>
			</a>
		</div>
	</div><!-- .pnfpb-post-card__body -->

</article><!-- #post-<?php the_ID(); ?> -->
