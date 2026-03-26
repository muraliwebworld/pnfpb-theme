<?php
/**
 * PNFPB Theme – Custom widgets.
 *
 * @package pnfpb-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── PNFPB Subscribe Widget ───────────────────────────────────────────────
/**
 * Widget: Add a PNFPB subscribe button in any widget area.
 */
class PNFPB_Subscribe_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'pnfpb_subscribe_widget',
			esc_html__( 'PNFPB – Subscribe Button', PNFPB_TEXT_DOMAIN ),
			array(
				'description' => esc_html__( 'Renders the PNFPB push-notification subscribe shortcode.', PNFPB_TEXT_DOMAIN ),
			)
		);
	}

	/**
	 * @param array $args     Widget wrapper args.
	 * @param array $instance Saved widget values.
	 */
	public function widget( $args, $instance ) : void {
		$title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', sanitize_text_field( $instance['title'] ) ) : '';
		echo wp_kses_post( $args['before_widget'] );
		if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		}
		echo '<div class="pnfpb-subscribe-widget">';
		if ( shortcode_exists( 'subscribe_PNFPB_push_notification' ) ) {
			echo do_shortcode( '[subscribe_PNFPB_push_notification]' );
		} else {
			echo '<p class="pnfpb-widget-notice">' . esc_html__( 'Please install & activate the PNFPB plugin to enable push notification subscriptions.', PNFPB_TEXT_DOMAIN ) . '</p>';
		}
		echo '</div>';
		echo wp_kses_post( $args['after_widget'] );
	}

	/** @param array $instance Saved values. */
	public function form( $instance ) : void {
		$title = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : esc_html__( 'Get Notified', PNFPB_TEXT_DOMAIN );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', PNFPB_TEXT_DOMAIN ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * @param array $new_instance New widget values.
	 * @param array $old_instance Old widget values.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) : array {
		$instance          = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}
}

// ─── PNFPB Groups Widget ──────────────────────────────────────────────────
/**
 * Widget: Display PNFPB community BuddyPress groups.
 */
class PNFPB_Groups_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'pnfpb_groups_widget',
			esc_html__( 'PNFPB – Community Groups', PNFPB_TEXT_DOMAIN ),
			array( 'description' => esc_html__( 'Lists PNFPB BuddyPress community groups.', PNFPB_TEXT_DOMAIN ) )
		);
	}

	/** @param array $args @param array $instance */
	public function widget( $args, $instance ) : void {
		$title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', sanitize_text_field( $instance['title'] ) ) : esc_html__( 'Community Groups', PNFPB_TEXT_DOMAIN );
		echo wp_kses_post( $args['before_widget'] );
		echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		echo '<ul class="pnfpb-groups-widget-list">';

		if ( function_exists( 'groups_get_groups' ) ) {
			$groups_result = groups_get_groups( array( 'per_page' => 6, 'orderby' => 'name', 'order' => 'ASC' ) );
			$groups        = $groups_result['groups'] ?? array();
			if ( ! empty( $groups ) ) {
				foreach ( $groups as $group ) {
					if ( ! is_object( $group ) ) {
						continue;
					}
					$group_url  = bp_get_group_url( $group );
					$group_name = bp_get_group_name( $group );
					printf(
						'<li><a href="%s">%s</a></li>',
						esc_url( $group_url ),
						esc_html( $group_name )
					);
				}
			} else {
				echo '<li>' . esc_html__( 'No groups found.', PNFPB_TEXT_DOMAIN ) . '</li>';
			}
		} else {
			$community_groups = pnfpb_get_community_groups();
			foreach ( $community_groups as $group ) {
				printf( '<li>%s</li>', esc_html( $group['name'] ) );
			}
		}

		echo '</ul>';
		echo wp_kses_post( $args['after_widget'] );
	}

	public function form( $instance ) : void {
		$title = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', PNFPB_TEXT_DOMAIN ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) : array {
		return array( 'title' => sanitize_text_field( $new_instance['title'] ) );
	}
}

add_action( 'widgets_init', 'pnfpb_register_widgets' );
/**
 * Register custom widgets.
 */
function pnfpb_register_widgets() : void {
	register_widget( 'PNFPB_Subscribe_Widget' );
	register_widget( 'PNFPB_Groups_Widget' );
}
