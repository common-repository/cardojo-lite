<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_My_Favorite class.
 * [cardojo_my_favorite]
 */
class CarDojo_Shortcode_My_Favorite {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_my_favorite', array( $this, 'cardojo_my_favorite' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_my_favorite( $atts ) {

		ob_start();

		get_cardojo_template( 'cardojo-my-favorite.php', array(  ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_My_Favorite();
