<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Dashboard class.
 */
class CarDojo_Shortcode_Dashboard {

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
		//add_action( 'wp', array( $this, 'shortcode_dashboard_action_handler' ) );
		add_shortcode( 'cardojo_dashboard', array( $this, 'cardojo_dashboard' ) );
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_dashboard_action_handler() {
		global $post;

		if ( is_page() && strstr( $post->post_content, '[cardojo_dashboard' ) ) {
			$this->car_dashboard_handler();
		}
	}

	/**
	 * Handles actions on cardojo dashboard
	 */
	public function car_dashboard_handler() {
		
		if ( ! empty( $_REQUEST['action'] ) && ! empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'cardojo_dashboard_actions' ) ) {

			$action = sanitize_title( $_REQUEST['action'] );
			$car_id = absint( $_REQUEST['car_id'] );

			try {
				// Get car
				$car    = get_post( $car_id );

				// Check ownership
				if ( ! cardojo_user_can_edit_car( $car_id ) ) {
					throw new Exception( __( 'Invalid ID', 'cardojo' ) );
				}

				do_action( 'cardojo_dashboard_do_action', $action, $car_id );

			} catch ( Exception $e ) {
				$this->car_dashboard_message = '<div class="car-manager-error">' . $e->getMessage() . '</div>';
			}
		}

	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_dashboard( $atts ) {
		
		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		wp_enqueue_script( 'charts' );

		ob_start();

		// If doing an action, show conditional content if needed....
		if ( ! empty( $_REQUEST['action'] ) ) {
			$action = sanitize_title( $_REQUEST['action'] );

			// Show alternative content if a plugin wants to
			if ( has_action( 'cardojo_dashboard_content_' . $action ) ) {
				do_action( 'cardojo_dashboard_content_' . $action, $atts );

				return ob_get_clean();
			}
		}

		get_cardojo_template( 'cardojo-dashboard.php', array(  ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Dashboard();
