<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Pre_Qualify_Form class.
 * [cardojo_pre_qualify_form]
 */
class CarDojo_Shortcode_Pre_Qualify_Form {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_pre_qualify_form', array( $this, 'cardojo_pre_qualify_form' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_pre_qualify_form( $atts ) {

		ob_start();

		cardojo_pre_qualify_application( 1 );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Pre_Qualify_Form();
