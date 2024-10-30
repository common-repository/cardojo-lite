<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://wpcardojoplugin.com
 * @since      1.0.2
 *
 * @package    CarDojo Lite
 * @subpackage CarDojo/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.2
 * @package    CarDojo Lite
 * @subpackage CarDojo/includes
 * @author     Your Name <email@example.com>
 */
class CarDojo {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      CarDojo_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $CarDojo    The string used to uniquely identify this plugin.
	 */
	protected $CarDojo;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.2
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the cardojo and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */
	public function __construct() {

		$this->CarDojo = 'cardojo';
		$this->version = '1.0.2';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		// Includes
		include( 'class-cardojo-install.php' );

		include( 'class-cardojo-car-post-types.php' );
		include( 'class-cardojo-car-metaboxes.php' );

		include( 'class-cardojo-filter-post-types.php' );

		include( 'cardojo-core-functions.php' );
		include( 'cardojo-template.php' );

		include( 'class-cardojo-geolocation.php' );

		// Forms
		include( 'forms/contact-request.php' );
		include( 'forms/pre-qualify-form.php' );
		include( 'forms/financial-application.php' );
		include( 'forms/trade-in-form.php' );
		include( 'forms/test-drive-form.php' );
		
		// Search Filter
		include( 'forms/search-horizontal-filter.php' );

		// Shortcodes
		include( 'class-cardojo-shortcode-dashboard.php' );
		include( 'class-cardojo-shortcode-inventory.php' );
		include( 'class-cardojo-shortcode-submit.php' );
		include( 'class-cardojo-shortcode-reports.php' );
		include( 'class-cardojo-shortcode-cars.php' );
		include( 'class-cardojo-shortcode-featured-cars.php' );
		include( 'class-cardojo-shortcode-recent-cars.php' );
		include( 'class-cardojo-shortcode-popular-cars.php' );
		include( 'class-cardojo-shortcode-search-filter.php' );
		include( 'class-cardojo-shortcode-financial-application.php' );
		include( 'class-cardojo-shortcode-pre-qualify-form.php' );
		include( 'class-cardojo-shortcode-test-drive-form.php' );
		include( 'class-cardojo-shortcode-trade-in-form.php' );
		include( 'class-cardojo-shortcode-login.php' );
		include( 'class-cardojo-shortcode-my-favorite.php' );
		include( 'class-cardojo-shortcode-notifications.php' );
		include( 'class-cardojo-shortcode-filter-subscriptions.php' );
		include( 'class-cardojo-shortcode-dealer.php' );
		include( 'class-cardojo-shortcode-settings.php' );

		// Init classes
		$this->vehicle_post_types = new CarDojo_Car_Post_Type();
		$this->vehicle_post_meta = new CarDojo_Car_Post_Type_MetaBoxes();

		$this->filter_post_types = new CarDojo_Filter_Post_Type();

		// Switch theme
		add_action( 'after_switch_theme', array( $this->vehicle_post_types, 'register_vehicle_post_type' ), 11 );
		add_action( 'after_switch_theme', 'flush_rewrite_rules', 15 );

		// Start Cron Jobs
		function cardojo_add_cron_recurrence_interval( $schedules ) {
 
		    $schedules['cardojo_every_five_minutes'] = array(
		            'interval'  => 300,
		            'display'   => __( 'Every 5 Minutes', 'cardojo' )
		    );
		     
		    return $schedules;
		}
		add_filter( 'cron_schedules', 'cardojo_add_cron_recurrence_interval' );

		if ( ! wp_next_scheduled( 'cardojo_payments_cron_jobs' ) ) {
		    wp_schedule_event( time(), 'cardojo_every_five_minutes', 'cardojo_payments_cron_jobs' );
		}
		add_action( 'cardojo_payments_cron_jobs', array( $this, 'cardojo_payments_cron_jobs' ) );


		//Allow Dealers to Add Media
		add_action('admin_init', 'allow_dealer_uploads');
		 
		function allow_dealer_uploads() {
		     $dealer = get_role('dealer');
		     $dealer->add_cap('upload_files');
		}

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CarDojo_Loader. Orchestrates the hooks of the plugin.
	 * - CarDojo_i18n. Defines internationalization functionality.
	 * - CarDojo_Admin. Defines all hooks for the admin area.
	 * - CarDojo_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cardojo-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cardojo-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-cardojo-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/public/class-cardojo-public.php';

		$this->loader = new CarDojo_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CarDojo_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new CarDojo_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new CarDojo_Admin( $this->get_CarDojo(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new CarDojo_Public( $this->get_CarDojo(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.2
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.2
	 * @return    string    The name of the plugin.
	 */
	public function get_CarDojo() {
		return $this->CarDojo;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.2
	 * @return    CarDojo_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Cron Featured & Promoted Listings
	 */
	public function cardojo_payments_cron_jobs() {
		global $wpdb;

		/**
		 * Featured Listings
		 */
		$featured_cron_jobs = array();
		$featured_cron_jobs = get_option( 'featured_cron_jobs' );
		$featured_cron_jobs[] = date("Y-m-d H:i:s");
		update_option( 'featured_cron_jobs', $featured_cron_jobs );

		// Change status to expired
		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'meta_query' => array(
			    array(
			        'key' => '_paid_featured',
			        'value' => 1
			    )
			)
		);

		$cars_query = new WP_Query( $search_args );
		if ( $cars_query->have_posts() ) :

			while ( $cars_query->have_posts() ) : $cars_query->the_post();

				$car_id = get_the_ID();
				$user_id = get_the_author_meta( 'ID' );
				$user_meta = get_userdata($user_id); 
				$user_roles = $user_meta->roles; 

				$now = strtotime(date("Y-m-d H:i:s"));
				$next_payment = get_post_meta( $car_id, '_featured_next_payment', true );

				$amount = get_option( 'cardojo_featured_listing_price' );

				if( $now >= $next_payment ) {

					if( !in_array("administrator", $user_roles) ) {

						if( cardojo_user_sufficient_funds( $user_id, $amount ) ) {

							update_post_meta( $car_id, '_promoted', 0 );
							update_post_meta( $car_id, '_featured', 1 );
							update_post_meta( $car_id, '_paid_featured', 1 );
							cardojo_update_menu_order( $car_id, '_featured', 1 );

							$new_date_payment = strtotime("+ 1 day");
							update_post_meta( $car_id, '_featured_next_payment', $new_date_payment );

						} else {

							update_post_meta( $car_id, '_promoted', 0 );
							update_post_meta( $car_id, '_featured', 0 );
							update_post_meta( $car_id, '_paid_featured', 0 );
							cardojo_update_menu_order( $car_id, '_featured', 0 );

							update_post_meta( $car_id, '_featured_next_payment', '' );

						}

					} else {

						update_post_meta( $car_id, '_promoted', 0 );
						update_post_meta( $car_id, '_featured', 1 );
						update_post_meta( $car_id, '_paid_featured', 1 );
						cardojo_update_menu_order( $car_id, '_featured', 1 );

						$new_date_payment = strtotime("+ 1 day");
						update_post_meta( $car_id, '_featured_next_payment', $new_date_payment );

					}

				}

			endwhile;

		endif; wp_reset_postdata();

		/**
		 * Promoted Listings
		 */
		$promoted_cron_jobs = array();
		$promoted_cron_jobs = get_option( 'promoted_cron_jobs' );
		$promoted_cron_jobs[] = date("Y-m-d H:i:s");
		update_option( 'promoted_cron_jobs', $promoted_cron_jobs );

		// Change status to expired
		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'meta_query' => array(
			    array(
			        'key' => '_promoted',
			        'value' => 1
			    )
			)
		);

		$cars_query = new WP_Query( $search_args );
		if ( $cars_query->have_posts() ) :

			while ( $cars_query->have_posts() ) : $cars_query->the_post();

				$car_id = get_the_ID();
				$user_id = get_the_author_meta( 'ID' );
				$user_meta = get_userdata($user_id); 
				$user_roles = $user_meta->roles;

				$now = strtotime(date("Y-m-d H:i:s"));
				$next_payment = get_post_meta( $car_id, '_promoted_next_payment', true );

				$amount = get_option( 'cardojo_promoted_listing_price' );

				if( $now >= $next_payment ) {

					if( !in_array("administrator", $user_roles) ) {

						if( cardojo_user_sufficient_funds( $user_id, $amount ) ) {

							update_post_meta( $car_id, '_promoted', 1 );

							$time = current_time('mysql');

							$my_post = array(
							  	'ID' => $car_id,
							  	'post_status' => 'publish',
							  	'post_date'     => $time,
				        		'post_date_gmt' => get_gmt_from_date( $time )
						  	);

						  	wp_update_post( $my_post );

							$new_date_payment = strtotime("+ 1 day");
							update_post_meta( $car_id, '_promoted_next_payment', $new_date_payment );

						} else {

							update_post_meta( $car_id, '_promoted', 0 );
							update_post_meta( $car_id, '_promoted_next_payment', '' );

						}

					} else {

						update_post_meta( $car_id, '_promoted', 1 );

						$time = current_time('mysql');

						$my_post = array(
						  	'ID' => $car_id,
						  	'post_status' => 'publish',
						  	'post_date'     => $time,
			        		'post_date_gmt' => get_gmt_from_date( $time )
					  	);

					  	wp_update_post( $my_post );

						$new_date_payment = strtotime("+ 1 day");
						update_post_meta( $car_id, '_promoted_next_payment', $new_date_payment );
						
					}

				}

			endwhile;

		endif; wp_reset_postdata();
	}

}