<?php
/**
 * The main template file — used when no other template matches.
 *
 * @package PNFPB_Theme
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<div class="pnfpb-content-area-wrap <?php echo esc_attr( pnfpb_content_area_class() ); ?>">
	<main id="primary" class="pnfpb-main-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="pnfpb-archive-header">
					<div class="pnfpb-container">
						<h1 class="pnfpb-archive-title"><?php esc_html_e( 'Latest Posts', PNFPB_TEXT_DOMAIN ); ?></h1>
					</div>
				</header>
			<?php endif; ?>

			<div class="pnfpb-container">
				<div class="pnfpb-posts-loop">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() === 'post' ? 'post' : '' );
					endwhile;
					?>
				</div><!-- .pnfpb-posts-loop -->

				<?php pnfpb_pagination(); ?>
			</div><!-- .pnfpb-container -->

		<?php else : ?>
			<div class="pnfpb-container">
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</div>
		<?php endif; ?>

	</main><!-- #primary -->

	<?php if ( pnfpb_has_sidebar() ) : ?>
		<?php get_sidebar(); ?>
	<?php endif; ?>
</div><!-- .pnfpb-content-area-wrap -->

<?php get_footer(); ?>
