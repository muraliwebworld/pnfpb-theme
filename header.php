<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="pnfpb-site-wrapper">

	<a class="skip-link screen-reader-text" href="#main">
		<?php esc_html_e( 'Skip to content', PNFPB_TEXT_DOMAIN ); ?>
	</a>

	<!-- ===== SITE HEADER ===== -->
	<header class="pnfpb-site-header" id="masthead" role="banner">
		<div class="pnfpb-header-inner">

			<!-- Logo / site name -->
			<!-- Logo image: uses WordPress Custom Logo (Appearance → Customize → Site Identity). -->
			<!-- Site name and tagline: pulled from WordPress Settings → General via get_bloginfo(). -->
			<div class="pnfpb-logo-wrap">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="pnfpb-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/logo/pnfpb-logo.svg' ); ?>"
						     width="44" height="44"
						     alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						     loading="eager">
					</a>
				<?php endif; ?>
				<a class="pnfpb-site-name-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="pnfpb-site-name">
						<?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
						<?php $pnfpb_tagline = get_bloginfo( 'description', 'display' ); if ( $pnfpb_tagline ) : ?>
							<span class="pnfpb-site-tagline"><?php echo esc_html( $pnfpb_tagline ); ?></span>
						<?php endif; ?>
					</span>
				</a>
			</div><!-- .pnfpb-logo-wrap -->

			<!-- Site search -->
			<div class="pnfpb-header-search" role="search">
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="pnfpb-header-search-form">
					<label class="screen-reader-text" for="pnfpb-header-s">
						<?php esc_html_e( 'Search', PNFPB_TEXT_DOMAIN ); ?>
					</label>
					<input
						type="search"
						id="pnfpb-header-s"
						name="s"
						autocomplete="off"
						placeholder="<?php esc_attr_e( 'Search…', PNFPB_TEXT_DOMAIN ); ?>"
						value="<?php echo esc_attr( get_search_query() ); ?>"
					>
					<button type="submit" aria-label="<?php esc_attr_e( 'Submit search', PNFPB_TEXT_DOMAIN ); ?>">
						<?php echo wp_kses_post( pnfpb_icon( 'search', array( 'width' => 16, 'height' => 16 ) ) ); ?>
					</button>
				</form>
			</div><!-- .pnfpb-header-search -->

			<!-- Header actions: BP nav + CTA -->
			<div class="pnfpb-header-actions">

				<?php if ( function_exists( 'bp_is_active' ) ) : ?>
				<!-- BuddyPress quick links -->
				<nav class="pnfpb-bp-nav" aria-label="<?php esc_attr_e( 'BuddyPress', PNFPB_TEXT_DOMAIN ); ?>">

					<?php if ( is_user_logged_in() ) : ?>
						<!-- Activity -->
					<a href="<?php echo esc_url( pnfpb_bp_directory_url( 'activity' ) ); ?>" title="<?php esc_attr_e( 'Activity', PNFPB_TEXT_DOMAIN ); ?>">
						<?php echo wp_kses_post( pnfpb_icon( 'activity', array( 'width' => 18, 'height' => 18 ) ) ); ?>
						<span class="screen-reader-text"><?php esc_html_e( 'Activity', PNFPB_TEXT_DOMAIN ); ?></span>
					</a>

					<!-- Groups -->
					<a href="<?php echo esc_url( pnfpb_bp_directory_url( 'groups' ) ); ?>" title="<?php esc_attr_e( 'Groups', PNFPB_TEXT_DOMAIN ); ?>">
							<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 18, 'height' => 18 ) ) ); ?>
							<span class="screen-reader-text"><?php esc_html_e( 'Groups', PNFPB_TEXT_DOMAIN ); ?></span>
						</a>

						<!-- Messages -->
						<?php
						$msg_count = pnfpb_bp_message_count();
					$msg_url   = pnfpb_bp_loggedin_user_url( bp_get_messages_slug() );
						?>
						<a href="<?php echo esc_url( $msg_url ); ?>" title="<?php esc_attr_e( 'Messages', PNFPB_TEXT_DOMAIN ); ?>">
							<?php echo wp_kses_post( pnfpb_icon( 'message', array( 'width' => 18, 'height' => 18 ) ) ); ?>
							<?php if ( $msg_count > 0 ) : ?>
								<span class="pnfpb-notif-count"><?php echo esc_html( (string) min( $msg_count, 99 ) ); ?></span>
							<?php endif; ?>
							<span class="screen-reader-text"><?php esc_html_e( 'Messages', PNFPB_TEXT_DOMAIN ); ?></span>
						</a>

						<!-- Notifications -->
						<?php
						$notif_count = pnfpb_bp_notification_count();
					$notif_url   = pnfpb_bp_loggedin_user_url( bp_get_notifications_slug() );
						?>
						<a href="<?php echo esc_url( $notif_url ); ?>" title="<?php esc_attr_e( 'Notifications', PNFPB_TEXT_DOMAIN ); ?>">
							<?php echo wp_kses_post( pnfpb_icon( 'bell', array( 'width' => 18, 'height' => 18 ) ) ); ?>
							<?php if ( $notif_count > 0 ) : ?>
								<span class="pnfpb-notif-count"><?php echo esc_html( (string) min( $notif_count, 99 ) ); ?></span>
							<?php endif; ?>
							<span class="screen-reader-text"><?php esc_html_e( 'Notifications', PNFPB_TEXT_DOMAIN ); ?></span>
						</a>

						<!-- Profile -->
					<?php $profile_url = pnfpb_bp_loggedin_user_url(); ?>
						<a href="<?php echo esc_url( $profile_url ); ?>" title="<?php esc_attr_e( 'My Profile', PNFPB_TEXT_DOMAIN ); ?>">
							<?php
							$avatar = function_exists( 'bp_get_loggedin_user_avatar' )
								? bp_get_loggedin_user_avatar( array( 'type' => 'thumb', 'width' => 32, 'height' => 32 ) )
								: get_avatar( get_current_user_id(), 32 );
							echo wp_kses_post( $avatar );
							?>
							<span class="screen-reader-text"><?php esc_html_e( 'My Profile', PNFPB_TEXT_DOMAIN ); ?></span>
						</a>

					<?php else : ?>
						<!-- Login / Register -->
					<a href="<?php echo esc_url( pnfpb_bp_directory_url( 'members' ) ); ?>">
							<?php echo wp_kses_post( pnfpb_icon( 'users', array( 'width' => 18, 'height' => 18 ) ) ); ?>
							<span><?php esc_html_e( 'Members', PNFPB_TEXT_DOMAIN ); ?></span>
						</a>
						<a href="<?php echo esc_url( wp_login_url() ); ?>">
							<?php echo wp_kses_post( pnfpb_icon( 'user', array( 'width' => 18, 'height' => 18 ) ) ); ?>
							<span><?php esc_html_e( 'Log In', PNFPB_TEXT_DOMAIN ); ?></span>
						</a>
					<?php endif; ?>
				</nav><!-- .pnfpb-bp-nav -->
				<?php endif; ?>

				<!-- CTA button -->
				<a href="<?php echo esc_url( get_theme_mod( 'pnfpb_header_cta_url', 'https://wordpress.org/plugins/push-notification-for-post-and-buddypress/' ) ); ?>"
				   class="pnfpb-btn-cta"
				   target="_blank"
				   rel="noopener noreferrer">
					<?php echo esc_html( get_theme_mod( 'pnfpb_header_cta_text', __( 'Get Plugin', PNFPB_TEXT_DOMAIN ) ) ); ?>
				</a>

				<!-- Mobile toggle -->
				<button class="pnfpb-menu-toggle" id="pnfpb-menu-toggle" aria-controls="pnfpb-nav-bar" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Open menu', PNFPB_TEXT_DOMAIN ); ?></span>
				</button>

			</div><!-- .pnfpb-header-actions -->
		</div><!-- .pnfpb-header-inner -->
	</header><!-- #masthead -->

	<!-- ===== NAVIGATION BAR ===== -->
	<div class="pnfpb-nav-bar" id="pnfpb-nav-bar" role="navigation">
		<div class="pnfpb-nav-inner">
			<nav class="pnfpb-primary-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', PNFPB_TEXT_DOMAIN ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'pnfpb-menu',
					'fallback_cb'    => 'pnfpb_primary_nav_fallback',
					'depth'          => 3,
					'walker'         => new PNFPB_Nav_Walker(),
				) );
				?>
			</nav><!-- .pnfpb-primary-nav -->
		</div><!-- .pnfpb-nav-inner -->
	</div><!-- .pnfpb-nav-bar -->

	<!-- ===== MAIN CONTENT ===== -->
	<div id="main" class="pnfpb-main-wrap">

<?php
/**
 * Fallback for primary nav when no menu is assigned.
 *
 * @param array $args wp_nav_menu() arguments.
 */
function pnfpb_primary_nav_fallback( array $args ) : void {
	$pages = array(
		home_url( '/' )                       => __( 'Home', PNFPB_TEXT_DOMAIN ),
		home_url( '/features/' )              => __( 'Features', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_directory_url( 'activity' )  => __( 'Activity', PNFPB_TEXT_DOMAIN ),
		pnfpb_bp_directory_url( 'groups' )    => __( 'Community', PNFPB_TEXT_DOMAIN ),
		home_url( '/docs/' )                  => __( 'Documentation', PNFPB_TEXT_DOMAIN ),
		home_url( '/contact/' )               => __( 'Contact', PNFPB_TEXT_DOMAIN ),
	);
	echo '<ul class="pnfpb-menu">';
	foreach ( $pages as $url => $label ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Custom nav walker that adds ARIA attributes and dropdown arrows.
 */
class PNFPB_Nav_Walker extends Walker_Nav_Menu {

	/** @inheritdoc */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) : void {
		// Validate that $item is expected type.
		if ( ! $item instanceof WP_Post ) {
			return;
		}
		$indent     = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes    = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[]  = 'menu-item-' . (int) $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id_attr = apply_filters( 'nav_menu_item_id', 'menu-item-' . (int) $item->ID, $item, $args, $depth );
		$id_attr = $id_attr ? ' id="' . esc_attr( $id_attr ) . '"' : '';

		$output .= $indent . '<li' . $id_attr . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? sanitize_text_field( $item->attr_title ) : '';
		$atts['target'] = ! empty( $item->target ) ? sanitize_text_field( $item->target ) : '';
		if ( '_blank' === $atts['target'] ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = ! empty( $item->xfn ) ? sanitize_text_field( $item->xfn ) : '';
		}
		$atts['href']         = ! empty( $item->url ) ? esc_url( $item->url ) : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . esc_attr( $attr ) . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', esc_html( $item->title ), $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = isset( $args->before ) ? $args->before : '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );
		$item_output .= '</a>';
		$item_output .= isset( $args->after ) ? $args->after : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
