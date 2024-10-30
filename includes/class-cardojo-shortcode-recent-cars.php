<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Recent_Cars class.
 * [cardojo_recent_cars]
 */
class CarDojo_Shortcode_Recent_Cars {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_recent_cars', array( $this, 'cardojo_recent_cars' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_recent_cars( $atts ) {

		ob_start();

		extract( shortcode_atts( array(
			'show' => '6',
		), $atts ) );

		get_cardojo_template( 'cardojo-cars.php', array( 'cars_type' => 'recent', 'show' => $show ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Recent_Cars();
