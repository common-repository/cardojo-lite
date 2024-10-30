<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Cars class.
 * [cardojo_cars]
 */
class CarDojo_Shortcode_Cars {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_cars', array( $this, 'cardojo_cars' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_cars( $atts ) {

		ob_start();

		get_cardojo_template( 'cardojo-cars.php' );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Cars();
