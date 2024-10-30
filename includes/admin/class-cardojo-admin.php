<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wpcardojoplugin.com
 * @since      1.0.2
 *
 * @package    CarDojo Lite
 * @subpackage CarDojo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the cardojo, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CarDojo Lite
 * @subpackage CarDojo/admin
 * @author     Your Name <email@example.com>
 */
class CarDojo_Admin {

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
	 * @param      string    $CarDojo       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $CarDojo, $version ) {

		$this->CarDojo = $CarDojo;
		$this->version = $version;

		include_once( 'class-cardojo-settings.php' );

		$this->settings_page = new CarDojo_Settings();

		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
		add_action( 'admin_menu', array( $this, 'addons_menu' ), 70 );
		add_action( 'admin_init', array( $this, 'admin_redirects' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_register_style( 'jquery-ui',          "http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css", false, "1.0.2", "all");
		wp_enqueue_style( 'select2',             CARDOJO_PLUGIN_URL . '/assets/css/select2.min.css', array(), '4.0.3', 'all' );
		//wp_enqueue_style( 'bootstratp',        CARDOJO_PLUGIN_URL . '/assets/css/bootstrap.min.css', array(), '4.0.3', 'all' );
		wp_register_style( 'bootstrap-select',   CARDOJO_PLUGIN_URL . '/assets/css/bootstrap-select.min.css', array(), '4.0.3', 'all' );
		wp_enqueue_style( 'fontawesome',         CARDOJO_PLUGIN_URL . '/assets/css/font-awesome.min.css', array(), '4.5.0', 'all' );
		wp_enqueue_style( 'cardojo_admin_css',   CARDOJO_PLUGIN_URL . '/assets/css/cardojo-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		// Enqueue the color picker
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		
		wp_enqueue_script( 'carquery-api-js',    CARDOJO_PLUGIN_URL . '/assets/js/carquery.0.3.4.js', array('jquery'), '0.3.4', true );
		wp_enqueue_script( 'select2',            CARDOJO_PLUGIN_URL . '/assets/js/select2.min.js', array('jquery'), '4.0.3', true );
		wp_enqueue_script( 'bootstrap',          CARDOJO_PLUGIN_URL . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.3', true );
		wp_register_script( 'bootstrap-select',  CARDOJO_PLUGIN_URL . '/assets/js/bootstrap-select.min.js', array('jquery'), '4.0.3', true );
		wp_register_script( 'loan-rate',         CARDOJO_PLUGIN_URL . '/assets/js/loan_rate.js', array('jquery'), '1.0.2', true );
		wp_enqueue_script( 'google-maps',        'https://maps.googleapis.com/maps/api/js?key='.get_google_map_api_key(), array( 'jquery' ) );
		wp_register_script( 'time-picker',       CARDOJO_PLUGIN_URL . '/assets/js/jquery.timePicker.min.js', array('jquery'), '2013-07-18', true );
		wp_enqueue_script( 'cardojo_admin_js',   CARDOJO_PLUGIN_URL . '/assets/js/cardojo-admin.js', array( 'jquery' ), $this->version, false );

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
		wp_localize_script( 'cardojo_admin_js', 'cardojoSettings', apply_filters( 'cardojo_admin_js', $settings ) );
		

	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		// Setup/welcome
		if ( ! empty( $_GET['page'] ) ) {
			switch ( $_GET['page'] ) {
				case 'cardojo-setup' :
					include_once( dirname( __FILE__ ) . '/class-cardojo-setup-wizard.php' );
				break;
			}
		}
	}

	/**
	 * admin_menu function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=vehicle', __( 'CarDojo Lite Settings', 'cardojo' ), __( 'CarDojo Lite Settings', 'cardojo' ), 'manage_options', 'cardojo-settings', array( $this->settings_page, 'output' ) );
	}

	/**
	 * Addons menu item.
	 */
	public function addons_menu() {
		add_submenu_page( 'edit.php?post_type=vehicle', __( 'CarDojo Pro & Extensions', 'cardojo' ), __( 'Extensions', 'cardojo' ), 'manage_options', 'cardojo-addons', array( $this, 'addons_page' ) );
	}

	/**
	 * Init the addons page.
	 */
	public function addons_page() {
		?>

		<div class="wrap cardojo_extensions">

			<h1><?php echo get_admin_page_title(); ?></h1>

			<div class="cardojo_addons">

				<div class="cardojo_addons_wrap">

					<div class="cardojo_addon_block">

						<div class="cardojo_addon_block_featured">

							<a class="cardojo_addon_block_image" href="<?php echo esc_url( 'https://codecanyon.net/item/cardojo-the-most-advanced-cardealer-marketplace-wordpress-plugin/20613160?ref=themes-dojo' ); ?>" target="_blank"><img src="<?php echo CARDOJO_PLUGIN_URL; ?>/assets/images/cardojo_pro.png" alt="CarDojo Pro" /></a>
							<h2><?php _e( 'CarDojo Premium Plugin', 'cardojo' ); ?></h2>
							<p><?php _e( 'CarDojo Premium Plugin includes exclusive features as <strong>Leads</strong>, <strong>Deals</strong>, <strong>Monetization</strong>, submit form with automatic completion using <strong>Make</strong>, <strong>Model</strong>, <strong>Year and Trim</strong> database, <strong>Loan Calculator</strong>, <strong>Amortization Schedule Table</strong> and many more.', 'cardojo' ); ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://codecanyon.net/item/cardojo-the-most-advanced-cardealer-marketplace-wordpress-plugin/20613160?ref=themes-dojo' ); ?>" class="cardojo_addons_button"><?php _e( 'From: $39', 'cardojo' ); ?></a>
							</p>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php
	}

	/**
	 * Handle redirects to setup/welcome page after install and updates.
	 *
	 * For setup wizard, transient must be present, the user must have access rights, and we must ignore the network/bulk plugin updaters.
	 */
	public function admin_redirects() {

		// Setup wizard redirect
		if ( ( ! empty( $_GET['page'] ) && in_array( $_GET['page'], array( 'cardojo-setup' ) ) ) || is_network_admin() ) {
			return;
		}

		// If the user needs to install, send them to the setup wizard
		$cardojo_run_wizard = get_option( 'cardojo_run_wizard', null );
		if ( !empty($cardojo_run_wizard) AND $cardojo_run_wizard == "yes" ) {

			wp_safe_redirect( admin_url( 'index.php?page=cardojo-setup' ) );
			delete_option( 'cardojo_run_wizard' );
			exit;
			
		}
		
	}

}
