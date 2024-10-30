<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wpcardojoplugin.com
 * @since      1.0.2
 *
 * @package    CarDojo Lite
 * @subpackage CarDojo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the cardojo, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CarDojo Lite
 * @subpackage CarDojo/public
 * @author     ThemesDojo <hi@themesdojo.com>
 */
class CarDojo_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $CarDojo    The ID of this plugin.
	 */
	private $CarDojo;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.2
	 * @param      string    $CarDojo       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $CarDojo, $version ) {

		$this->CarDojo = $CarDojo;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CarDojo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CarDojo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( 'jquery-ui',           "http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css", false, "1.0.2", "all");
		wp_register_style( 'bootstrap-select',    CARDOJO_PLUGIN_URL . '/assets/css/bootstrap-select.min.css', array(), '4.0.3', 'all' );

		wp_enqueue_style( 'plugins',             CARDOJO_PLUGIN_URL . '/assets/css/plugins.css', array(), '1.0.2', 'all' );
		
		wp_enqueue_style( 'cardojo_public_css',  CARDOJO_PLUGIN_URL . '/assets/css/cardojo-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'responsive',          CARDOJO_PLUGIN_URL . '/assets/css/responsive.css', array(), '1.0.2', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CarDojo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CarDojo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( 'carquery-api-js',    CARDOJO_PLUGIN_URL . '/assets/js/carquery.0.3.4.js', array('jquery'), '0.3.4', true );
		wp_enqueue_script( 'google-maps',        'https://maps.googleapis.com/maps/api/js?key='.get_google_map_api_key(), array( 'jquery' ) );
		wp_register_script( 'bootstrap-select',  CARDOJO_PLUGIN_URL . '/assets/js/bootstrap-select.min.js', array('jquery'), '4.0.3', true );
		wp_register_script( 'loan-rate',         CARDOJO_PLUGIN_URL . '/assets/js/loan_rate.js', array('jquery'), '1.0.2', true );
		wp_register_script( 'time-picker',       CARDOJO_PLUGIN_URL . '/assets/js/jquery.timePicker.min.js', array('jquery'), '2013-07-18', true );
		wp_register_script( 'charts',            CARDOJO_PLUGIN_URL . '/assets/js/charts.js', array('jquery'), '2013-07-18', true );
		wp_enqueue_script( 'plugins',            CARDOJO_PLUGIN_URL . '/assets/js/plugins.js', array( 'jquery' ), '1.0.2', false );
		wp_enqueue_script( 'form',               CARDOJO_PLUGIN_URL . '/assets/js/jquery.form.js', array( 'jquery' ), '1.0.2', false );
		wp_register_script( 'time-picker',       CARDOJO_PLUGIN_URL . '/assets/js/jquery.timePicker.min.js', array('jquery'), '2013-07-18', true );
		wp_enqueue_script( 'cardojo_public_js',  CARDOJO_PLUGIN_URL . '/assets/js/cardojo-public.js', array( 'jquery' ), $this->version, false );

		$expense_currency = "";
		$cardojo_currency = get_option( 'cardojo_currency' ); 
		if(!empty($cardojo_currency)) { 
			$expense_currency = esc_html__('in', 'cardojo' ) . " " . $cardojo_currency; 
		}
		$settings = array(
			'url_theme' => get_template_directory_uri(),
			'cardojo_ajaxurl' => esc_url( admin_url('admin-ajax.php', 'relative') ),
			'remove_image' => esc_html__("Remove Image", "cardojo"),
			'upload_image' => esc_html__("Upload Image", "cardojo"),
			'expense_label' => esc_html__("Price", "cardojo"),
			'expense_currency' => $expense_currency,
			'expense_desc' => esc_html__("Description", "cardojo"),
			'expense_desc_placeholder' => esc_html__("Write down vehicle’s expense description here...", "cardojo"),
			'expense_delete' => esc_html__("Delete", "cardojo"),
			'measurement_type' => get_option( 'cardojo_measurement_type' ),
		);
		wp_localize_script( 'cardojo_public_js', 'cardojoSettings', apply_filters( 'cardojo_public_js', $settings ) );

	}

}
