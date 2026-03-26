	</div><!-- #main .pnfpb-main-wrap -->

	<!-- ===== SITE FOOTER ===== -->
	<footer class="pnfpb-site-footer" id="colophon" role="contentinfo">
		<div class="pnfpb-container">
			<div class="pnfpb-footer-grid">

				<!-- Brand column -->
				<div class="pnfpb-footer-brand">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a class="pnfpb-site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
						</a>
					<?php endif; ?>

					<p class="pnfpb-footer-desc">
						<?php echo wp_kses_post( get_theme_mod( 'pnfpb_footer_about',
							esc_html__( 'Push Notification for Post and BuddyPress (PNFPB) is a premium-quality free WordPress plugin that brings web push notifications, PWA support, and BuddyPress real-time alerts to your site.', PNFPB_TEXT_DOMAIN )
						) ); ?>
					</p>

					<!-- Social links -->
					<div class="pnfpb-footer-social">
						<?php
						$social = array(
							'twitter'   => array(
								'url'   => get_theme_mod( 'pnfpb_social_twitter', '' ),
								'icon'  => 'twitter',
								'label' => __( 'Twitter / X', PNFPB_TEXT_DOMAIN ),
							),
							'github'    => array(
								'url'   => get_theme_mod( 'pnfpb_social_github', '' ),
								'icon'  => 'github',
								'label' => __( 'GitHub', PNFPB_TEXT_DOMAIN ),
							),
							'wordpress' => array(
								'url'   => get_theme_mod( 'pnfpb_social_wordpress', 'https://wordpress.org/plugins/push-notification-for-post-and-buddypress/' ),
								'icon'  => 'wordpress',
								'label' => __( 'WordPress.org', PNFPB_TEXT_DOMAIN ),
							),
						);
						foreach ( $social as $key => $item ) :
							if ( ! empty( $item['url'] ) ) :
						?>
							<a href="<?php echo esc_url( $item['url'] ); ?>"
							   aria-label="<?php echo esc_attr( $item['label'] ); ?>"
							   target="_blank"
							   rel="noopener noreferrer">
								<?php echo wp_kses_post( pnfpb_icon( $item['icon'], array( 'width' => 16, 'height' => 16 ) ) ); ?>
							</a>
						<?php
							endif;
						endforeach;
						?>
					</div><!-- .pnfpb-footer-social -->
				</div><!-- .pnfpb-footer-brand -->

				<!-- Plugin column -->
				<div class="pnfpb-footer-col">
					<h3 class="pnfpb-footer-col-title"><?php esc_html_e( 'Plugin', PNFPB_TEXT_DOMAIN ); ?></h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-1',
						'container'      => false,
						'menu_class'     => 'pnfpb-footer-menu',
						'depth'          => 1,
						'fallback_cb'    => 'pnfpb_footer_plugin_menu_fallback',
					) );
					?>
				</div><!-- .pnfpb-footer-col -->

				<!-- Documentation column -->
				<div class="pnfpb-footer-col">
					<h3 class="pnfpb-footer-col-title"><?php esc_html_e( 'Documentation', PNFPB_TEXT_DOMAIN ); ?></h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-2',
						'container'      => false,
						'menu_class'     => 'pnfpb-footer-menu',
						'depth'          => 1,
						'fallback_cb'    => 'pnfpb_footer_docs_menu_fallback',
					) );
					?>
				</div><!-- .pnfpb-footer-col -->

				<!-- Community column -->
				<div class="pnfpb-footer-col">
					<h3 class="pnfpb-footer-col-title"><?php esc_html_e( 'Community', PNFPB_TEXT_DOMAIN ); ?></h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-3',
						'container'      => false,
						'menu_class'     => 'pnfpb-footer-menu',
						'depth'          => 1,
						'fallback_cb'    => 'pnfpb_footer_community_menu_fallback',
					) );
					?>
				</div><!-- .pnfpb-footer-col -->

			</div><!-- .pnfpb-footer-grid -->

			<!-- Footer bottom bar -->
			<div class="pnfpb-footer-bottom">
				<span>
					<?php
					echo wp_kses_post( get_theme_mod( 'pnfpb_footer_copyright', sprintf(
						/* translators: %s: current year */
						__( '&copy; %s Muralidharan Ramasamy / <a href="https://www.muraliwebworld.com" target="_blank" rel="noopener">Indiacitys.com Technologies</a>. All rights reserved.', PNFPB_TEXT_DOMAIN ),
						esc_html( gmdate( 'Y' ) )
					) ) );
					?>
				</span>
				<span>
					<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', PNFPB_TEXT_DOMAIN ); ?></a>
					&nbsp;&middot;&nbsp;
					<a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>"><?php esc_html_e( 'Terms &amp; Conditions', PNFPB_TEXT_DOMAIN ); ?></a>
					&nbsp;&middot;&nbsp;
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', PNFPB_TEXT_DOMAIN ); ?></a>
				</span>
				<span>
					<?php
					/* translators: 1: WordPress URL, 2: theme name */
					printf(
						esc_html__( 'Powered by %1$s · Theme: %2$s', PNFPB_TEXT_DOMAIN ),
						'<a href="https://wordpress.org/" target="_blank" rel="noopener">WordPress</a>',
						'<a href="https://pnfpb.com/">PNFPB</a>'
					);
					?>
				</span>
			</div><!-- .pnfpb-footer-bottom -->
		</div><!-- .pnfpb-container -->
	</footer><!-- #colophon -->

</div><!-- .pnfpb-site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>

<?php
// ─── Footer menu fallback callbacks ─────────────────────────────────────

/**
 * Fallback for footer Plugin column menu.
 */
function pnfpb_footer_plugin_menu_fallback() : void {
	$items = array(
		'https://wordpress.org/plugins/push-notification-for-post-and-buddypress/' => __( 'WordPress.org Listing', PNFPB_TEXT_DOMAIN ),
		home_url( '/features/' )  => __( 'Features', PNFPB_TEXT_DOMAIN ),
		home_url( '/changelog/' ) => __( 'Changelog', PNFPB_TEXT_DOMAIN ),
		home_url( '/contact/' )   => __( 'Support', PNFPB_TEXT_DOMAIN ),
		'https://www.muraliwebworld.com' => __( 'Author Site', PNFPB_TEXT_DOMAIN ),
	);
	echo '<ul class="pnfpb-footer-menu">';
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback for footer Documentation column menu.
 */
function pnfpb_footer_docs_menu_fallback() : void {
	$wikis = array(
		'https://wiki.pnfpb.com'                             => __( 'Documentation Home', PNFPB_TEXT_DOMAIN ),
		'https://wiki.pnfpb.com/installation/'               => __( 'Installation', PNFPB_TEXT_DOMAIN ),
		'https://wiki.pnfpb.com/firebase-configuration/'     => __( 'Firebase Setup', PNFPB_TEXT_DOMAIN ),
		'https://wiki.pnfpb.com/pwa-setup/'                  => __( 'PWA Setup', PNFPB_TEXT_DOMAIN ),
		'https://wiki.pnfpb.com/rest-api/'                   => __( 'REST API', PNFPB_TEXT_DOMAIN ),
		'https://wiki.pnfpb.com/troubleshooting/'            => __( 'Troubleshooting', PNFPB_TEXT_DOMAIN ),
		'https://wiki.pnfpb.com/faq/'                        => __( 'FAQ', PNFPB_TEXT_DOMAIN ),
	);
	echo '<ul class="pnfpb-footer-menu">';
	foreach ( $wikis as $url => $label ) {
		printf( '<li><a href="%s" target="_blank" rel="noopener">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback for footer Community column menu.
 */
function pnfpb_footer_community_menu_fallback() : void {
	$items = array(
		pnfpb_bp_directory_url( 'activity' )                       => __( 'Activity Feed', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_group_url( 'pnfpb-features-discussion' )          => __( 'Features Discussion', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_group_url( 'pnfpb-mobile-integration' )           => __( 'Mobile Integration', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_group_url( 'pnfpb-support' )                      => __( 'Customer Support', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_group_url( 'pnfpb-release-updates' )              => __( 'Release Updates', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_directory_url( 'members' )                        => __( 'Members', PNFPB_TEXT_DOMAIN ),
	);
	echo '<ul class="pnfpb-footer-menu">';
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
