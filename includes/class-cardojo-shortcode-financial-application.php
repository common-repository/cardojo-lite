<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Finanical_Application class.
 * [cardojo_financial_form]
 */
class CarDojo_Shortcode_Finanical_Application {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_financial_form', array( $this, 'cardojo_financial_form' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_financial_form( $atts ) {

		ob_start();

		cardojo_financial_application( 1 );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Finanical_Application();
