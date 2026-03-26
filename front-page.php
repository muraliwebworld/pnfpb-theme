<?php
/**
 * The home / front page template.
 *
 * @package PNFPB_Theme
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-home" role="main">

	<?php
	// ── 1. Hero Slider ──────────────────────────────────────────────
	if ( get_theme_mod( 'pnfpb_home_show_slider', true ) ) {
		get_template_part( 'template-parts/home/slider' );
	}

	// ── 1b. Stats bar ───────────────────────────────────────────────
	?>
	<div class="pnfpb-stats-bar" role="complementary" aria-label="<?php esc_attr_e( 'Plugin Statistics', PNFPB_TEXT_DOMAIN ); ?>">
		<div class="pnfpb-container">
			<ul class="pnfpb-stats-grid">
				<li class="pnfpb-stat-item">
					<span class="pnfpb-stat-number">100K+</span>
					<span class="pnfpb-stat-label"><?php esc_html_e( 'Active Users', PNFPB_TEXT_DOMAIN ); ?></span>
				</li>
				<li class="pnfpb-stat-item">
					<span class="pnfpb-stat-number">4.9 ★</span>
					<span class="pnfpb-stat-label"><?php esc_html_e( 'Plugin Rating', PNFPB_TEXT_DOMAIN ); ?></span>
				</li>
				<li class="pnfpb-stat-item">
					<span class="pnfpb-stat-number">12+</span>
					<span class="pnfpb-stat-label"><?php esc_html_e( 'Push Providers', PNFPB_TEXT_DOMAIN ); ?></span>
				</li>
				<li class="pnfpb-stat-item">
					<span class="pnfpb-stat-number"><?php esc_html_e( 'Free', PNFPB_TEXT_DOMAIN ); ?></span>
					<span class="pnfpb-stat-label"><?php esc_html_e( 'on WordPress.org', PNFPB_TEXT_DOMAIN ); ?></span>
				</li>
			</ul>
		</div>
	</div>

	<?php
	// ── 2. Plugin Features ──────────────────────────────────────────
	if ( get_theme_mod( 'pnfpb_home_show_features', true ) ) {
		get_template_part( 'template-parts/home/features' );
	}

	// ── 3. Push-notification subscribe prompt ───────────────────────
	?>
	<section class="pnfpb-subscribe-section" id="subscribe" aria-labelledby="subscribe-heading">
		<div class="pnfpb-container">
			<div class="pnfpb-subscribe-inner">
				<div class="pnfpb-subscribe-text">
					<span class="pnfpb-section-label">
						<?php echo wp_kses_post( pnfpb_icon( 'bell', array( 'width' => 18, 'height' => 18 ) ) ); ?>
						<?php esc_html_e( 'Stay Updated', PNFPB_TEXT_DOMAIN ); ?>
					</span>
					<h2 id="subscribe-heading" class="pnfpb-section-title">
						<?php esc_html_e( 'Get Push Notifications', PNFPB_TEXT_DOMAIN ); ?>
					</h2>
					<p><?php esc_html_e( 'Subscribe to receive instant push notifications whenever new content is published. No email required — just one click.', PNFPB_TEXT_DOMAIN ); ?></p>
				</div>
				<div class="pnfpb-subscribe-widget">
					<?php
					if ( shortcode_exists( 'subscribe_PNFPB_push_notification' ) ) {
						echo do_shortcode( '[subscribe_PNFPB_push_notification]' );
					} else {
						?>
						<div class="pnfpb-subscribe-notice">
							<span><?php echo wp_kses_post( pnfpb_icon( 'alert-circle', array( 'width' => 20, 'height' => 20 ) ) ); ?></span>
							<p>
								<?php
								printf(
									/* translators: %s link to PNFPB plugin */
									wp_kses(
										__( 'Install the <a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/" target="_blank" rel="noopener">PNFPB plugin</a> to show the subscribe button.', PNFPB_TEXT_DOMAIN ),
										array( 'a' => array( 'href' => array(), 'target' => array(), 'rel' => array() ) )
									)
								);
								?>
							</p>
						</div>
					<?php } ?>
				</div><!-- .pnfpb-subscribe-widget -->
			</div><!-- .pnfpb-subscribe-inner -->
		</div><!-- .pnfpb-container -->
	</section><!-- .pnfpb-subscribe-section -->

	<?php
	// ── 4. Latest Blog Posts ─────────────────────────────────────────
	$blog_posts = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'no_found_rows'  => true,
	) );

	if ( $blog_posts->have_posts() ) :
	?>
	<section class="pnfpb-latest-posts-section" aria-labelledby="latest-posts-heading">
		<div class="pnfpb-container">
			<div class="pnfpb-section-header">
				<span class="pnfpb-section-label">
					<?php echo wp_kses_post( pnfpb_icon( 'file-text', array( 'width' => 18, 'height' => 18 ) ) ); ?>
					<?php esc_html_e( 'Latest News', PNFPB_TEXT_DOMAIN ); ?>
				</span>
				<h2 id="latest-posts-heading" class="pnfpb-section-title">
					<?php esc_html_e( 'Plugin Updates &amp; Tutorials', PNFPB_TEXT_DOMAIN ); ?>
				</h2>
			</div>

			<div class="pnfpb-posts-grid">
				<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
					<article class="pnfpb-post-card" id="post-<?php the_ID(); ?>" <?php post_class( 'pnfpb-post-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="pnfpb-post-card__thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
								<?php the_post_thumbnail( 'pnfpb-card', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
							</a>
						<?php endif; ?>
						<div class="pnfpb-post-card__body">
							<div class="pnfpb-post-card__meta">
								<?php pnfpb_posted_on(); ?>
							</div>
							<h3 class="pnfpb-post-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="pnfpb-post-card__excerpt">
								<?php the_excerpt(); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="pnfpb-btn pnfpb-btn--sm pnfpb-btn--outline">
								<?php esc_html_e( 'Read More', PNFPB_TEXT_DOMAIN ); ?>
								<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 14, 'height' => 14 ) ) ); ?>
							</a>
						</div><!-- .pnfpb-post-card__body -->
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div><!-- .pnfpb-posts-grid -->

			<div class="pnfpb-section-cta">
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>" class="pnfpb-btn pnfpb-btn--outline">
					<?php esc_html_e( 'View All Posts', PNFPB_TEXT_DOMAIN ); ?>
					<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 14, 'height' => 14 ) ) ); ?>
				</a>
			</div>
		</div><!-- .pnfpb-container -->
	</section>
	<?php
	endif; // end latest posts.

	// ── 5. BuddyPress Community Groups ──────────────────────────────
	if ( get_theme_mod( 'pnfpb_home_show_groups', true ) ) {
		get_template_part( 'template-parts/home/bp-groups' );
	}

	// ── 6. Activity Feed Preview ─────────────────────────────────────
	if ( function_exists( 'bp_has_activities' ) ) :
		$activity_args = array(
			'max'    => 5,
			'type'   => 'activity_update',
		);
		?>
		<section class="pnfpb-activity-preview-section" aria-labelledby="activity-preview-heading">
			<div class="pnfpb-container">
				<div class="pnfpb-section-header">
					<span class="pnfpb-section-label">
						<?php echo wp_kses_post( pnfpb_icon( 'activity', array( 'width' => 18, 'height' => 18 ) ) ); ?>
						<?php esc_html_e( 'Community Activity', PNFPB_TEXT_DOMAIN ); ?>
					</span>
					<h2 id="activity-preview-heading" class="pnfpb-section-title">
						<?php esc_html_e( 'What\'s Happening', PNFPB_TEXT_DOMAIN ); ?>
					</h2>
				</div>
				<div class="pnfpb-activity-preview">
					<?php if ( bp_has_activities( $activity_args ) ) : ?>
						<div class="pnfpb-activity-list">
							<?php while ( bp_activities() ) : bp_the_activity(); ?>
								<div class="pnfpb-activity-item">
									<div class="pnfpb-activity-avatar">
										<?php bp_activity_avatar( array( 'width' => 48, 'height' => 48 ) ); ?>
									</div>
									<div class="pnfpb-activity-body">
										<div class="pnfpb-activity-header">
											<?php bp_activity_action(); ?>
										</div>
										<?php if ( bp_activity_has_content() ) : ?>
											<div class="pnfpb-activity-content">
												<?php bp_activity_content_body(); ?>
											</div>
										<?php endif; ?>
										<div class="pnfpb-activity-meta">
											<a href="<?php bp_activity_thread_permalink(); ?>" class="pnfpb-activity-time-since">
												<?php echo esc_html( bp_core_time_since( bp_get_activity_date_recorded() ) ); ?>
											</a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					<?php else : ?>
						<p class="pnfpb-notice pnfpb-notice--info">
							<?php esc_html_e( 'No recent activity yet. Be the first to post!', PNFPB_TEXT_DOMAIN ); ?>
						</p>
					<?php endif; ?>
				</div>
				<div class="pnfpb-section-cta">
					<?php
					$activity_url = pnfpb_bp_directory_url( 'activity' );
					?>
					<a href="<?php echo esc_url( $activity_url ); ?>" class="pnfpb-btn pnfpb-btn--outline">
						<?php esc_html_e( 'See All Activity', PNFPB_TEXT_DOMAIN ); ?>
						<?php echo wp_kses_post( pnfpb_icon( 'arrow-right', array( 'width' => 14, 'height' => 14 ) ) ); ?>
					</a>
				</div>
			</div>
		</section>
	<?php
	endif; // end activity preview.

	// ── 7. Documentation Links ───────────────────────────────────────
	get_template_part( 'template-parts/home/docs-links' );
	?>

</main><!-- #primary -->

<?php get_footer(); ?>
