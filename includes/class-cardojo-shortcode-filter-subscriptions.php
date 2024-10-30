<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Filter_Subscriptions class.
 */
class CarDojo_Shortcode_Filter_Subscriptions {

	/**
	 * Leads message
	 *
	 * @access private
	 * @var string
	 */
	private $car_leads_message = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_filter_subscriptions', array( $this, 'cardojo_filter_subscriptions' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_filter_subscriptions( $atts ) {

		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		ob_start();

		get_cardojo_template( 'cardojo-filter-subscriptions.php' );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Filter_Subscriptions();
