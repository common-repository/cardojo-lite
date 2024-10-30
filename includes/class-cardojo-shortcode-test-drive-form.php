<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Test_Drive_Form class.
 * [cardojo_test_drive_form]
 */
class CarDojo_Shortcode_Test_Drive_Form {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_test_drive_form', array( $this, 'cardojo_test_drive_form' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_test_drive_form( $atts ) {

		ob_start();

		cardojo_test_drive_application( 1 );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Test_Drive_Form();
