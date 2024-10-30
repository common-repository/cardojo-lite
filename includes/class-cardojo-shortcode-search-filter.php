<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Search_Filter class.
 * [cardojo_filter]
 */
class CarDojo_Shortcode_Search_Filter {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_filter', array( $this, 'cardojo_filter' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_filter( $atts ) {

		ob_start();

		$shortcode_filter = 1;

		cardojo_horizontal_search_filter( $shortcode_filter );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Search_Filter();
