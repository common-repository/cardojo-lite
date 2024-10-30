<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fired during plugin activation
 *
 * @link       http://wpcardojoplugin.com
 * @since      1.0.2
 *
 * @package    CarDojo Lite
 * @subpackage CarDojo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.2
 * @package    CarDojo Lite
 * @subpackage CarDojo/includes
 * @author     Your Name <email@example.com>
 */
class CarDojo_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.2
	 */
	public static function activate() {

		CarDojo_Install::install();
		flush_rewrite_rules();

	}

}
