<?php
/**
 * Template Name: Privacy Policy
 *
 * @package PNFPB_Theme
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-legal-page" role="main">
	<div class="pnfpb-container">

		<div class="pnfpb-page-hero">
			<?php pnfpb_breadcrumbs(); ?>
			<h1 class="pnfpb-page-hero__title"><?php the_title(); ?></h1>
			<p class="pnfpb-page-hero__meta">
				<?php
				printf(
					/* translators: %s: last updated date */
					esc_html__( 'Last updated: %s', PNFPB_TEXT_DOMAIN ),
					esc_html( get_the_modified_date() )
				);
				?>
			</p>
		</div>

		<div class="pnfpb-legal-layout">
			<!-- Table of contents -->
			<nav class="pnfpb-legal-toc" aria-label="<?php esc_attr_e( 'Table of contents', PNFPB_TEXT_DOMAIN ); ?>">
				<h2><?php esc_html_e( 'Contents', PNFPB_TEXT_DOMAIN ); ?></h2>
				<ol>
					<li><a href="#pp-section-1"><?php esc_html_e( 'Introduction', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-2"><?php esc_html_e( 'Data We Collect', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-3"><?php esc_html_e( 'Push Notification Subscriptions', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-4"><?php esc_html_e( 'How We Use Your Data', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-5"><?php esc_html_e( 'Third-Party Services', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-6"><?php esc_html_e( 'Cookies', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-7"><?php esc_html_e( 'Your Rights', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-8"><?php esc_html_e( 'Data Retention', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#pp-section-9"><?php esc_html_e( 'Contact Us', PNFPB_TEXT_DOMAIN ); ?></a></li>
				</ol>
			</nav><!-- .pnfpb-legal-toc -->

			<!-- Main content: editor content + static fallback -->
			<div class="pnfpb-legal-content entry-content">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						$post_content = get_the_content();
					endwhile;
				endif;

				if ( ! empty( $post_content ) ) :
					the_content();
				else :
				?>
				<!-- Static privacy policy content (replace or supplement in the editor) -->
				<section id="pp-section-1">
					<h2><?php esc_html_e( '1. Introduction', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'This Privacy Policy explains how pnfpb.com ("we", "us", or "our") collects, uses, and protects information you provide when using this website and the PNFPB plugin.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="pp-section-2">
					<h2><?php esc_html_e( '2. Data We Collect', PNFPB_TEXT_DOMAIN ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Push notification device tokens (browser/mobile) when you subscribe.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Your name and email address if you register on our community site.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Contact form submissions (name, email, message).', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Standard web server logs (IP address, user-agent, page requests).', PNFPB_TEXT_DOMAIN ); ?></li>
					</ul>
				</section>

				<section id="pp-section-3">
					<h2><?php esc_html_e( '3. Push Notification Subscriptions', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'When you subscribe via the PNFPB plugin, your browser issues a unique push endpoint (device token) that is stored in our database. This is used solely to deliver push notifications to your browser. You may unsubscribe at any time by clicking the unsubscribe button or revoking notification permission in your browser settings.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="pp-section-4">
					<h2><?php esc_html_e( '4. How We Use Your Data', PNFPB_TEXT_DOMAIN ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'To deliver push notifications about new content or announcements.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'To respond to contact form submissions.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'To manage community accounts (BuddyPress).', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'We do not sell or share your data with third parties for marketing.', PNFPB_TEXT_DOMAIN ); ?></li>
					</ul>
				</section>

				<section id="pp-section-5">
					<h2><?php esc_html_e( '5. Third-Party Services', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'Push notifications may be delivered via Firebase Cloud Messaging (Google), Web Push (RFC 8030), OneSignal, or Progressier. Please review their respective privacy policies:', PNFPB_TEXT_DOMAIN ); ?>
					</p>
					<ul>
						<li><a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Google / Firebase Privacy Policy', PNFPB_TEXT_DOMAIN ); ?></a></li>
						<li><a href="https://onesignal.com/privacy_policy" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'OneSignal Privacy Policy', PNFPB_TEXT_DOMAIN ); ?></a></li>
						<li><a href="https://progressier.com/privacy" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Progressier Privacy Policy', PNFPB_TEXT_DOMAIN ); ?></a></li>
					</ul>
				</section>

				<section id="pp-section-6">
					<h2><?php esc_html_e( '6. Cookies', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'We use essential cookies for WordPress session management and security. We do not use tracking or advertising cookies.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="pp-section-7">
					<h2><?php esc_html_e( '7. Your Rights', PNFPB_TEXT_DOMAIN ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Right to access, rectify, or delete personal data we hold about you.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Right to withdraw consent (unsubscribe from push notifications at any time).', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Right to data portability (request an export of your data).', PNFPB_TEXT_DOMAIN ); ?></li>
					</ul>
					<p>
						<?php
						printf(
							wp_kses(
								/* translators: %s: contact page link */
								__( 'To exercise any of these rights, <a href="%s">contact us</a>.', PNFPB_TEXT_DOMAIN ),
								array( 'a' => array( 'href' => array() ) )
							),
							esc_url( home_url( '/contact/' ) )
						);
						?>
					</p>
				</section>

				<section id="pp-section-8">
					<h2><?php esc_html_e( '8. Data Retention', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'Push notification tokens are retained until you unsubscribe. Community account data is retained while your account is active. Contact form messages are retained for 12 months then deleted.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="pp-section-9">
					<h2><?php esc_html_e( '9. Contact Us', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php
						printf(
							wp_kses(
								/* translators: %s: link to contact page */
								__( 'If you have any privacy-related questions, please <a href="%s">contact us</a>.', PNFPB_TEXT_DOMAIN ),
								array( 'a' => array( 'href' => array() ) )
							),
							esc_url( home_url( '/contact/' ) )
						);
						?>
					</p>
				</section>
				<?php endif; ?>
			</div><!-- .pnfpb-legal-content -->
		</div><!-- .pnfpb-legal-layout -->
	</div><!-- .pnfpb-container -->
</main><!-- #primary -->

<?php get_footer(); ?>
