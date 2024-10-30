<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Featured_Cars class.
 * [cardojo_featured_cars]
 */
class CarDojo_Shortcode_Featured_Cars {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_featured_cars', array( $this, 'cardojo_featured_cars' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_featured_cars( $atts ) {

		ob_start();

		extract( shortcode_atts( array(
			'show' => '6',
		), $atts ) );

		get_cardojo_template( 'cardojo-cars.php', array( 'cars_type' => 'featured', 'show' => $show ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Featured_Cars();
