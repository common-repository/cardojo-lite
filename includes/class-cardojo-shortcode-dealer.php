<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Dealer class.
 */
class CarDojo_Shortcode_Dealer {

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
		add_shortcode( 'cardojo_dealer_page', array( $this, 'cardojo_dealer_page' ) );
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_login_action_handler() {
		global $post;

		if ( is_page() && strstr( $post->post_content, '[cardojo_dealer_page' ) ) {
			$this->car_login_handler();
		}
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_dealer_page( $atts ) {

		ob_start();

		get_cardojo_template( 'cardojo-single-dealer.php' );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Dealer();
