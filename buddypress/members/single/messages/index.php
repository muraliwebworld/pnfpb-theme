<?php
/**
 * BuddyPress Messages inbox template override.
 *
 * @package PNFPB_Theme
 */
?>
<div id="item-body" class="pnfpb-container pnfpb-bp-messages">
	<div class="pnfpb-bp-messages-header">
		<h2>
			<?php echo wp_kses_post( pnfpb_icon( 'message', array( 'width' => 22, 'height' => 22 ) ) ); ?>
			<?php esc_html_e( 'Messages', PNFPB_TEXT_DOMAIN ); ?>
		</h2>
		<a href="<?php echo esc_url( bp_get_message_compose_link() ); ?>"
		   class="pnfpb-btn pnfpb-btn--primary pnfpb-btn--sm">
			<?php echo wp_kses_post( pnfpb_icon( 'mail', array( 'width' => 14, 'height' => 14 ) ) ); ?>
			<?php esc_html_e( 'New Message', PNFPB_TEXT_DOMAIN ); ?>
		</a>
	</div>

	<?php if ( bp_has_message_threads() ) : ?>
		<table class="pnfpb-messages-table" role="grid">
			<thead>
				<tr>
					<th scope="col"><?php esc_html_e( 'From', PNFPB_TEXT_DOMAIN ); ?></th>
					<th scope="col"><?php esc_html_e( 'Subject', PNFPB_TEXT_DOMAIN ); ?></th>
					<th scope="col"><?php esc_html_e( 'Date', PNFPB_TEXT_DOMAIN ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php while ( bp_message_threads() ) : bp_message_thread(); ?>
					<tr class="pnfpb-messages-row <?php echo bp_message_thread_has_unread() ? 'pnfpb-messages-row--unread' : ''; ?>">
						<td class="pnfpb-messages-from">
							<?php bp_message_thread_avatar(); ?>
							<a href="<?php bp_message_thread_view_link(); ?>">
								<?php bp_message_thread_recipients( array( 'show_separator' => ', ' ) ); ?>
							</a>
						</td>
						<td class="pnfpb-messages-subject">
							<a href="<?php bp_message_thread_view_link(); ?>">
								<?php bp_message_thread_subject(); ?>
							</a>
							<?php if ( bp_message_thread_has_unread() ) : ?>
								<span class="pnfpb-badge pnfpb-badge--accent">
									<?php esc_html_e( 'New', PNFPB_TEXT_DOMAIN ); ?>
								</span>
							<?php endif; ?>
						</td>
						<td class="pnfpb-messages-date">
							<?php bp_message_thread_last_post_date(); ?>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table><!-- .pnfpb-messages-table -->

		<?php bp_messages_pagination(); ?>

	<?php else : ?>
		<div class="pnfpb-no-results">
			<?php echo wp_kses_post( pnfpb_icon( 'message', array( 'width' => 40, 'height' => 40 ) ) ); ?>
			<p><?php esc_html_e( 'No messages yet. Send one to start a conversation!', PNFPB_TEXT_DOMAIN ); ?></p>
			<a href="<?php echo esc_url( bp_get_message_compose_link() ); ?>" class="pnfpb-btn pnfpb-btn--primary">
				<?php esc_html_e( 'Compose New Message', PNFPB_TEXT_DOMAIN ); ?>
			</a>
		</div>
	<?php endif; ?>
</div><!-- .pnfpb-bp-messages -->
