<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Reports class.
 */
class CarDojo_Shortcode_Reports {

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
		add_shortcode( 'cardojo_reports', array( $this, 'cardojo_reports' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_reports( $atts ) {
		
		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		wp_enqueue_script( 'charts' );

		ob_start();

		get_cardojo_template( 'cardojo-reports.php', array(  ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Reports();
