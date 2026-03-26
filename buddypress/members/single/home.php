<?php
/**
 * BuddyPress Single Member – Home tab partial template.
 *
 * Follows buddyx's BP Nouveau approach:
 * uses bp_nouveau_member_header_template_part() for the profile header and
 * bp_nouveau_member_template_part() for the active-tab content.
 *
 * @package PNFPB_Theme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

$bp_nouveau_appearance = bp_get_option( 'bp_nouveau_appearance' );
?>

<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

<div id="item-header"
	 role="complementary"
	 data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>"
	 data-bp-item-component="members"
	 class="users-header single-headers">

	<?php bp_nouveau_member_header_template_part(); ?>

</div><!-- #item-header -->

<div class="pnfpb-container">
<div class="site-wrapper member-home">
	<div class="bp-wrap">

		<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() && ! bp_is_user_change_avatar() && ! bp_is_user_change_cover_image() ) : ?>
			<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>
		<?php endif; ?>

		<div id="item-body" class="item-body">
			<?php bp_nouveau_member_template_part(); ?>
		</div><!-- #item-body -->

	</div><!-- .bp-wrap -->
</div><!-- .site-wrapper -->
</div><!-- .pnfpb-container -->

<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
