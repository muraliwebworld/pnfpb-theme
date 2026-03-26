<?php
/**
 * The template for displaying all single posts.
 *
 * @package PNFPB_Theme
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<div class="pnfpb-content-area-wrap <?php echo esc_attr( pnfpb_content_area_class() ); ?>">
	<main id="primary" class="pnfpb-main-content" role="main">
		<div class="pnfpb-container">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'single' );
				the_post_navigation( array(
					'prev_text' => sprintf(
						'<span class="pnfpb-nav-label">%s</span><span class="pnfpb-nav-title">%%title</span>',
						esc_html__( '&larr; Previous Post', PNFPB_TEXT_DOMAIN )
					),
					'next_text' => sprintf(
						'<span class="pnfpb-nav-label">%s</span><span class="pnfpb-nav-title">%%title</span>',
						esc_html__( 'Next Post &rarr;', PNFPB_TEXT_DOMAIN )
					),
					'class'     => 'pnfpb-post-navigation',
				) );
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</div><!-- .pnfpb-container -->
	</main><!-- #primary -->

	<?php if ( pnfpb_has_sidebar() ) : ?>
		<?php get_sidebar( 'blog' ); ?>
	<?php endif; ?>
</div><!-- .pnfpb-content-area-wrap -->

<?php get_footer(); ?>
