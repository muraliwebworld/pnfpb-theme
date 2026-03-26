<?php
/**
 * Template Name: Full Width (no sidebar)
 *
 * @package PNFPB_Theme
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-full-width" role="main">
	<div class="pnfpb-container">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div><!-- .pnfpb-container -->
</main><!-- #primary -->

<?php get_footer(); ?>
