<?php
/**
 * Template part — generic page content.
 *
 * @package PNFPB_Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'pnfpb-page-content' ); ?>>

	<?php if ( ! function_exists( 'is_buddypress' ) || ! is_buddypress() ) : ?>
	<header class="pnfpb-page-content__header">
		<?php pnfpb_breadcrumbs(); ?>
		<?php if ( ! is_front_page() ) : ?>
			<h1 class="pnfpb-page-content__title"><?php the_title(); ?></h1>
		<?php endif; ?>
	</header><!-- .pnfpb-page-content__header -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="pnfpb-page-content__featured">
			<?php the_post_thumbnail( 'pnfpb-hero', array( 'loading' => 'lazy' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="pnfpb-page-content__body entry-content">
		<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="pnfpb-page-links">' . esc_html__( 'Pages:', PNFPB_TEXT_DOMAIN ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .pnfpb-page-content__body -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="pnfpb-page-content__footer">
			<?php
			edit_post_link(
				esc_html__( 'Edit this page', PNFPB_TEXT_DOMAIN ),
				'<span class="pnfpb-edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
