<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wpcardojoplugin.com
 * @since             1.0.2
 * @package           CarDojo
 *
 * @wordpress-plugin
 * Plugin Name:       CarDojo Lite
 * Plugin URI:        http://wpcardojoplugin.com
 * Description:       Vehicles shop or automotive marketplace plugin
 * Version:           1.0.2
 * Author:            ThemesDojo
 * Author URI:        http://themesdojo.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cardojo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cardojo-activator.php
 */
function activate_CarDojo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cardojo-activator.php';
	CarDojo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cardojo-deactivator.php
 */
function deactivate_CarDojo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cardojo-deactivator.php';
	CarDojo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_CarDojo' );
register_deactivation_hook( __FILE__, 'deactivate_CarDojo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cardojo.php';

// Define constants
define( 'CARDOJO_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CARDOJO_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.2
 */
function run_CarDojo() {

	$plugin = new CarDojo();
	$plugin->run();

}
run_CarDojo();
