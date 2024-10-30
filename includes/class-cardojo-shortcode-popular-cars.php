<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Popular_Cars class.
 * [cardojo_popular_cars]
 */
class CarDojo_Shortcode_Popular_Cars {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_popular_cars', array( $this, 'cardojo_popular_cars' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_popular_cars( $atts ) {

		ob_start();

		extract( shortcode_atts( array(
			'show' => '6',
		), $atts ) );

		get_cardojo_template( 'cardojo-cars.php', array( 'cars_type' => 'popular', 'show' => $show ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Popular_Cars();
