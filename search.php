<?php
/**
 * The template for displaying search results.
 *
 * @package PNFPB_Theme
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<div class="pnfpb-content-area-wrap <?php echo esc_attr( pnfpb_content_area_class() ); ?>">
	<main id="primary" class="pnfpb-main-content" role="main">
		<header class="pnfpb-archive-header pnfpb-page-hero">
			<div class="pnfpb-container">
				<h1 class="pnfpb-archive-title">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Search Results for: &#8220;%s&#8221;', PNFPB_TEXT_DOMAIN ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
			</div>
		</header>

		<div class="pnfpb-container">
			<?php if ( have_posts() ) : ?>
				<div class="pnfpb-posts-loop">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'search' );
					endwhile;
					?>
				</div><!-- .pnfpb-posts-loop -->
				<?php pnfpb_pagination(); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div><!-- .pnfpb-container -->

	</main><!-- #primary -->

	<?php if ( pnfpb_has_sidebar() ) : ?>
		<?php get_sidebar(); ?>
	<?php endif; ?>
</div><!-- .pnfpb-content-area-wrap -->

<?php get_footer(); ?>
