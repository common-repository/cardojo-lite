<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Account_Settings class.
 */
class CarDojo_Shortcode_Account_Settings {

	/**
	 * Inventory message
	 *
	 * @access private
	 * @var string
	 */
	private $account_update_message = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'shortcode_account_settings_action_handler' ) );
		add_shortcode( 'cardojo_account_settings', array( $this, 'cardojo_account_settings' ) );
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_account_settings_action_handler() {
		global $post;

		if ( is_page() && strstr( $post->post_content, '[cardojo_account_settings' ) ) {
			$this->account_settings_handler();
		}
	}

	/**
	 * Handles actions on cardojo dashboard
	 */
	public function account_settings_handler() {

		if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

			if( isset( $_POST['updateAccountFunction_nonce'] ) && wp_verify_nonce( $_POST['updateAccountFunction_nonce'], 'updateAccountFunction_html' ) ){

				// Update user data
				if( isset($_POST['user_id']) AND !empty($_POST['user_id']) ) {

					$user_id = $_POST['user_id'];

					$demo_account = get_user_meta( $user_id, 'demo_account', true );

					if( $demo_account == "on" ) {

						$this->account_update_message = '<div class="car-manager-error">' . __('This is a demo account and cannot be updated', 'cardojo' ) . '</div>';

					} else {

						update_user_meta( $user_id, 'dealer_name', sanitize_text_field($_POST['dealer_name']) );
						update_user_meta( $user_id, 'mobile_phone', sanitize_text_field($_POST['mobile_phone']) );
						update_user_meta( $user_id, 'office_phone', sanitize_text_field($_POST['office_phone']) );

						update_user_meta( $user_id, 'dealer_address', sanitize_text_field($_POST['dealer_address']) );
						update_user_meta( $user_id, 'dealer_address_latitude', sanitize_text_field($_POST['dealer_address_latitude']) );
						update_user_meta( $user_id, 'dealer_address_longitude', sanitize_text_field($_POST['dealer_address_longitude']) );

						$user_password = $_POST['password'];
						if(!empty($user_password)) {
							wp_set_password( $user_password, $user_id );
						}

						$this->account_update_message = '<div class="car-manager-message">' . __('Account has been updated', 'cardojo' ) . '</div>';

					}

				}

			}

		}

	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_account_settings( $atts ) {

		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		// Enqueue styles
		wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( 'bootstrap-select' );

		// Enqueue scripts
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'time-picker' );
		wp_enqueue_script( 'bootstrap-select' );

		ob_start();

		echo $this->account_update_message;

		get_cardojo_template( 'cardojo-account-settings.php' );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Account_Settings();
