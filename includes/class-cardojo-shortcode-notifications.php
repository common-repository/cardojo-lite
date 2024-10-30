<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Notifications class.
 * [cardojo_notifications]
 */
class CarDojo_Shortcode_Notifications {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'cardojo_notifications', array( $this, 'cardojo_notifications' ) );
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_notifications( $atts ) {

		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		ob_start();

		get_cardojo_template( 'cardojo-notifications.php', array(  ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Notifications();
