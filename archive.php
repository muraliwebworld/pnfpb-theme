<?php
/**
 * The template for displaying Category, Date, Author, and Tag archive pages.
 *
 * @package PNFPB_Theme
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<div class="pnfpb-content-area-wrap <?php echo esc_attr( pnfpb_content_area_class() ); ?>">
	<main id="primary" class="pnfpb-main-content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="pnfpb-archive-header pnfpb-page-hero">
				<div class="pnfpb-container">
					<?php
					the_archive_title( '<h1 class="pnfpb-archive-title">', '</h1>' );
					the_archive_description( '<div class="pnfpb-archive-desc">', '</div>' );
					?>
				</div>
			</header><!-- .pnfpb-archive-header -->

			<div class="pnfpb-container">
				<div class="pnfpb-posts-loop">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'post' );
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
