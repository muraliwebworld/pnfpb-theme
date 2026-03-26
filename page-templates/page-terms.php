<?php
/**
 * Template Name: Terms & Conditions
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
				<?php printf( esc_html__( 'Last updated: %s', PNFPB_TEXT_DOMAIN ), esc_html( get_the_modified_date() ) ); ?>
			</p>
		</div>

		<div class="pnfpb-legal-layout">
			<nav class="pnfpb-legal-toc" aria-label="<?php esc_attr_e( 'Table of contents', PNFPB_TEXT_DOMAIN ); ?>">
				<h2><?php esc_html_e( 'Contents', PNFPB_TEXT_DOMAIN ); ?></h2>
				<ol>
					<li><a href="#tc-section-1"><?php esc_html_e( 'Acceptance of Terms', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-2"><?php esc_html_e( 'Use of the Website', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-3"><?php esc_html_e( 'Community Rules', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-4"><?php esc_html_e( 'Plugin Licence', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-5"><?php esc_html_e( 'Intellectual Property', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-6"><?php esc_html_e( 'Disclaimer of Warranties', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-7"><?php esc_html_e( 'Limitation of Liability', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-8"><?php esc_html_e( 'Changes to Terms', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-9"><?php esc_html_e( 'Governing Law', PNFPB_TEXT_DOMAIN ); ?></a></li>
					<li><a href="#tc-section-10"><?php esc_html_e( 'Contact', PNFPB_TEXT_DOMAIN ); ?></a></li>
				</ol>
			</nav>

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
				<section id="tc-section-1">
					<h2><?php esc_html_e( '1. Acceptance of Terms', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'By accessing pnfpb.com you agree to these Terms &amp; Conditions. If you do not agree, please do not use this website.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="tc-section-2">
					<h2><?php esc_html_e( '2. Use of the Website', PNFPB_TEXT_DOMAIN ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'You agree to use the site only for lawful purposes.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'You must not interfere with the security or availability of the site.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'You must not scrape, harvest, or misuse data published on this site.', PNFPB_TEXT_DOMAIN ); ?></li>
					</ul>
				</section>

				<section id="tc-section-3">
					<h2><?php esc_html_e( '3. Community Rules', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p><?php esc_html_e( 'When participating in community groups or discussions you agree to:', PNFPB_TEXT_DOMAIN ); ?></p>
					<ul>
						<li><?php esc_html_e( 'Be respectful and constructive in all interactions.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Not post spam, advertising, or irrelevant content.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Not post harmful, abusive, or illegal content.', PNFPB_TEXT_DOMAIN ); ?></li>
						<li><?php esc_html_e( 'Respect the intellectual property of others.', PNFPB_TEXT_DOMAIN ); ?></li>
					</ul>
					<p><?php esc_html_e( 'We reserve the right to remove content or ban users who violate these rules.', PNFPB_TEXT_DOMAIN ); ?></p>
				</section>

				<section id="tc-section-4">
					<h2><?php esc_html_e( '4. Plugin Licence', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php
						printf(
							wp_kses(
								/* translators: %s: GPL-2.0 link */
								__( 'The PNFPB plugin is free software distributed under the <a href="https://www.gnu.org/licenses/gpl-2.0.html" target="_blank" rel="noopener">GNU GPL v2 (or later)</a> licence. You are free to use, modify, and redistribute it under those licence terms.', PNFPB_TEXT_DOMAIN ),
								array( 'a' => array( 'href' => array(), 'target' => array(), 'rel' => array() ) )
							)
						);
						?>
					</p>
				</section>

				<section id="tc-section-5">
					<h2><?php esc_html_e( '5. Intellectual Property', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'All written content, graphics, and branding on pnfpb.com (excluding GPL-licensed code) are © Muralidharan Ramasamy / Indiacitys.com Technologies and may not be reproduced without permission.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="tc-section-6">
					<h2><?php esc_html_e( '6. Disclaimer of Warranties', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'The website and plugin are provided "as is" without warranty of any kind. We do not guarantee uninterrupted, error-free operation.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="tc-section-7">
					<h2><?php esc_html_e( '7. Limitation of Liability', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, or consequential damages arising from your use of the site or plugin.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="tc-section-8">
					<h2><?php esc_html_e( '8. Changes to Terms', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'We may update these Terms at any time. Continued use of the site after changes constitutes acceptance.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="tc-section-9">
					<h2><?php esc_html_e( '9. Governing Law', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php esc_html_e( 'These Terms are governed by the laws of India. Disputes shall be subject to the exclusive jurisdiction of courts in Chennai, Tamil Nadu.', PNFPB_TEXT_DOMAIN ); ?>
					</p>
				</section>

				<section id="tc-section-10">
					<h2><?php esc_html_e( '10. Contact', PNFPB_TEXT_DOMAIN ); ?></h2>
					<p>
						<?php
						printf(
							wp_kses(
								/* translators: %s: contact page link */
								__( 'Questions about these Terms? <a href="%s">Contact us</a>.', PNFPB_TEXT_DOMAIN ),
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
