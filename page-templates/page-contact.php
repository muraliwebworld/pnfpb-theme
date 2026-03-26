<?php
/**
 * Template Name: Contact Us
 *
 * @package PNFPB_Theme
 */

get_header();
?>
<main id="primary" class="pnfpb-main-content pnfpb-contact-page" role="main">
	<div class="pnfpb-container">

		<!-- Page hero -->
		<div class="pnfpb-page-hero">
			<?php pnfpb_breadcrumbs(); ?>
			<h1 class="pnfpb-page-hero__title"><?php the_title(); ?></h1>
			<p class="pnfpb-page-hero__desc">
				<?php esc_html_e( "Have a question or need help? Fill in the form below and we'll get back to you as soon as possible. For faster support, check the documentation first.", PNFPB_TEXT_DOMAIN ); ?>
			</p>
		</div><!-- .pnfpb-page-hero -->

		<div class="pnfpb-contact-grid">

			<!-- Contact form column -->
			<div class="pnfpb-contact-form-wrap">
				<h2><?php esc_html_e( 'Send a Message', PNFPB_TEXT_DOMAIN ); ?></h2>

				<div id="pnfpb-contact-response" class="pnfpb-contact-response" aria-live="polite" aria-atomic="true" hidden></div>

				<form id="pnfpb-contact-form"
				      class="pnfpb-form"
				      method="post"
				      novalidate>

					<?php wp_nonce_field( 'pnfpb_contact_nonce', 'pnfpb_contact_nonce_field' ); ?>

					<!-- Honeypot anti-spam -->
					<p class="pnfpb-form__hp" aria-hidden="true" style="display:none!important;visibility:hidden!important;">
						<label for="pnfpb_hp"><?php esc_html_e( 'Leave this field empty', PNFPB_TEXT_DOMAIN ); ?></label>
						<input type="text" id="pnfpb_hp" name="pnfpb_hp" autocomplete="off" tabindex="-1">
					</p>

					<!-- Name -->
					<div class="pnfpb-form__group">
						<label class="pnfpb-form__label" for="pnfpb_name">
							<?php esc_html_e( 'Full Name', PNFPB_TEXT_DOMAIN ); ?>
							<span class="pnfpb-form__required" aria-hidden="true">*</span>
						</label>
						<input type="text"
						       id="pnfpb_name"
						       name="pnfpb_name"
						       class="pnfpb-form__input"
						       required
						       maxlength="100"
						       autocomplete="name"
						       aria-required="true">
					</div>

					<!-- Email -->
					<div class="pnfpb-form__group">
						<label class="pnfpb-form__label" for="pnfpb_email">
							<?php esc_html_e( 'Email Address', PNFPB_TEXT_DOMAIN ); ?>
							<span class="pnfpb-form__required" aria-hidden="true">*</span>
						</label>
						<input type="email"
						       id="pnfpb_email"
						       name="pnfpb_email"
						       class="pnfpb-form__input"
						       required
						       maxlength="254"
						       autocomplete="email"
						       aria-required="true">
					</div>

					<!-- Subject -->
					<div class="pnfpb-form__group">
						<label class="pnfpb-form__label" for="pnfpb_subject">
							<?php esc_html_e( 'Subject', PNFPB_TEXT_DOMAIN ); ?>
							<span class="pnfpb-form__required" aria-hidden="true">*</span>
						</label>
						<select id="pnfpb_subject" name="pnfpb_subject" class="pnfpb-form__select" required aria-required="true">
							<option value=""><?php esc_html_e( '— Choose a topic —', PNFPB_TEXT_DOMAIN ); ?></option>
							<option value="general"><?php esc_html_e( 'General Enquiry', PNFPB_TEXT_DOMAIN ); ?></option>
							<option value="support"><?php esc_html_e( 'Technical Support', PNFPB_TEXT_DOMAIN ); ?></option>
							<option value="bug"><?php esc_html_e( 'Bug Report', PNFPB_TEXT_DOMAIN ); ?></option>
							<option value="feature"><?php esc_html_e( 'Feature Request', PNFPB_TEXT_DOMAIN ); ?></option>
							<option value="other"><?php esc_html_e( 'Other', PNFPB_TEXT_DOMAIN ); ?></option>
						</select>
					</div>

					<!-- Message -->
					<div class="pnfpb-form__group">
						<label class="pnfpb-form__label" for="pnfpb_message">
							<?php esc_html_e( 'Message', PNFPB_TEXT_DOMAIN ); ?>
							<span class="pnfpb-form__required" aria-hidden="true">*</span>
						</label>
						<textarea id="pnfpb_message"
						          name="pnfpb_message"
						          class="pnfpb-form__textarea"
						          rows="7"
						          required
						          maxlength="3000"
						          aria-required="true"
						          aria-describedby="pnfpb_message_hint"></textarea>
						<span id="pnfpb_message_hint" class="pnfpb-form__hint">
							<?php esc_html_e( 'Maximum 3000 characters.', PNFPB_TEXT_DOMAIN ); ?>
						</span>
					</div>

					<button type="submit" class="pnfpb-btn pnfpb-btn--primary pnfpb-btn--lg pnfpb-contact-submit" id="pnfpb-contact-submit">
						<?php echo wp_kses_post( pnfpb_icon( 'mail', array( 'width' => 18, 'height' => 18 ) ) ); ?>
						<span class="pnfpb-btn-text"><?php esc_html_e( 'Send Message', PNFPB_TEXT_DOMAIN ); ?></span>
						<span class="pnfpb-btn-loading" hidden><?php esc_html_e( 'Sending…', PNFPB_TEXT_DOMAIN ); ?></span>
					</button>
				</form><!-- #pnfpb-contact-form -->
			</div><!-- .pnfpb-contact-form-wrap -->

			<!-- Info column -->
			<div class="pnfpb-contact-info">
				<div class="pnfpb-contact-info-card">
					<div class="pnfpb-contact-info-card__icon">
						<?php echo wp_kses_post( pnfpb_icon( 'book', array( 'width' => 28, 'height' => 28 ) ) ); ?>
					</div>
					<h3><?php esc_html_e( 'Documentation', PNFPB_TEXT_DOMAIN ); ?></h3>
					<p><?php esc_html_e( 'Most questions are answered in the wiki — check it before reaching out.', PNFPB_TEXT_DOMAIN ); ?></p>
					<a href="https://wiki.pnfpb.com" class="pnfpb-btn pnfpb-btn--outline" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'Visit Documentation', PNFPB_TEXT_DOMAIN ); ?>
					</a>
				</div>

				<div class="pnfpb-contact-info-card">
					<div class="pnfpb-contact-info-card__icon">
						<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 28, 'height' => 28 ) ) ); ?>
					</div>
					<h3><?php esc_html_e( 'Community Support', PNFPB_TEXT_DOMAIN ); ?></h3>
					<p><?php esc_html_e( 'Post your question in the Support group — our community is very helpful.', PNFPB_TEXT_DOMAIN ); ?></p>
					<?php
					$support_url = function_exists( 'pnfpb_bp_group_url' )
						? pnfpb_bp_group_url( 'pnfpb-support' )
						: home_url( '/groups/pnfpb-support/' );
					?>
					<a href="<?php echo esc_url( $support_url ); ?>" class="pnfpb-btn pnfpb-btn--outline">
						<?php esc_html_e( 'Go to Support Group', PNFPB_TEXT_DOMAIN ); ?>
					</a>
				</div>

				<div class="pnfpb-contact-info-card">
					<div class="pnfpb-contact-info-card__icon">
						<?php echo wp_kses_post( pnfpb_icon( 'wordpress', array( 'width' => 28, 'height' => 28 ) ) ); ?>
					</div>
					<h3><?php esc_html_e( 'WordPress.org Forum', PNFPB_TEXT_DOMAIN ); ?></h3>
					<p><?php esc_html_e( 'For plugin-specific bugs, post on the official WordPress.org support forum.', PNFPB_TEXT_DOMAIN ); ?></p>
					<a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/"
					   class="pnfpb-btn pnfpb-btn--outline"
					   target="_blank"
					   rel="noopener noreferrer">
						<?php esc_html_e( 'WP.org Forum', PNFPB_TEXT_DOMAIN ); ?>
					</a>
				</div>
			</div><!-- .pnfpb-contact-info -->

		</div><!-- .pnfpb-contact-grid -->

		<?php
		// Render any additional page content set in the editor.
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				if ( get_the_content() ) :
					echo '<div class="pnfpb-page-content entry-content">';
					the_content();
					echo '</div>';
				endif;
			endwhile;
		endif;
		?>

	</div><!-- .pnfpb-container -->
</main><!-- #primary -->

<?php get_footer(); ?>
