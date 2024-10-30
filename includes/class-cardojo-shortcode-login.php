<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Login class.
 */
class CarDojo_Shortcode_Login {

	/**
	 * Inventory message
	 *
	 * @access private
	 * @var string
	 */
	private $car_inventory_message = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		//add_action( 'wp', array( $this, 'shortcode_login_action_handler' ) );
		add_shortcode( 'cardojo_login', array( $this, 'cardojo_login' ) );
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_login_action_handler() {
		global $post;

		if ( is_page() && strstr( $post->post_content, '[cardojo_login' ) ) {
			$this->car_login_handler();
		}
	}

	/**
	 * Handles actions on cardojo reports
	 */
	public function car_login_handler() {
		if ( ! empty( $_REQUEST['action'] ) && ! empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'cardojo_login_actions' ) ) {

			$action = sanitize_title( $_REQUEST['action'] );
			$car_id = absint( $_REQUEST['car_id'] );

			try {
				// Get car
				$car    = get_post( $car_id );

				// Check ownership
				if ( ! cardojo_user_can_edit_car( $car_id ) ) {
					throw new Exception( __( 'Invalid ID', 'cardojo' ) );
				}

				do_action( 'cardojo_login_do_action', $action, $car_id );

			} catch ( Exception $e ) {
				$this->car_reports_message = '<div class="car-manager-error">' . $e->getMessage() . '</div>';
			}
		}
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_login( $atts ) {

		ob_start();

		extract( shortcode_atts( array(
			'redirect' => '',
		), $atts ) );

		if ( ! is_user_logged_in() ) {

			get_cardojo_template( 'cardojo-login.php', array( 'redirect' => $redirect ) );

		} else {

			$current_user = wp_get_current_user();

			?>
			<p>
			<?php
				/* translators: 1: user display name 2: logout url */
				printf(
					__( 'Hello %1$s (not %1$s? <a href="%2$s">Sign out</a>)', 'cardojo' ),
					'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
					esc_url( wp_logout_url( home_url() ) )
				);
			?>
			</p>
			<?php
		}

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Login();
