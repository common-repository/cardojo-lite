<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Trade_In_Form class.
 * [cardojo_trade_in_form]
 */
class CarDojo_Shortcode_Trade_In_Form {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_trade_in_form', array( $this, 'cardojo_trade_in_form' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_trade_in_form( $atts ) {

		ob_start();

		cardojo_trade_in_application( 1 );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Trade_In_Form();
