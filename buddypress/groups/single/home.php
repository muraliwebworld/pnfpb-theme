<?php
/**
 * BuddyPress Single Group – Home tab partial template.
 *
 * Follows buddyx's BP Nouveau approach:
 * uses bp_nouveau_group_header_template_part() for the header and
 * bp_nouveau_group_template_part() for the active-tab content.
 *
 * @package PNFPB_Theme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

$bp_nouveau_appearance = bp_get_option( 'bp_nouveau_appearance' );

if ( bp_has_groups() ) :
	while ( bp_groups() ) :
		bp_the_group();
		?>

		<?php bp_nouveau_group_hook( 'before', 'home_content' ); ?>

		<div id="item-header"
			 role="complementary"
			 data-bp-item-id="<?php bp_group_id(); ?>"
			 data-bp-item-component="groups"
			 class="groups-header single-headers">

			<?php bp_nouveau_group_header_template_part(); ?>

		</div><!-- #item-header -->

		<div class="pnfpb-container">
		<div class="site-wrapper group-home">
			<div class="bp-wrap">

				<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>
					<?php bp_get_template_part( 'groups/single/parts/item-nav' ); ?>
				<?php endif; ?>

				<div id="item-body" class="item-body">
					<?php bp_nouveau_group_template_part(); ?>
				</div><!-- #item-body -->

			</div><!-- .bp-wrap -->
		</div><!-- .site-wrapper -->
		</div><!-- .pnfpb-container -->

		<?php bp_nouveau_group_hook( 'after', 'home_content' ); ?>

	<?php endwhile; ?>
<?php endif;
