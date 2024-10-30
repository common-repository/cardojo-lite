<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Install
 */
class CarDojo_Install {

	/**
	 * Install CarDojo
	 */
	public static function install() {
		global $wpdb;

		self::init_user_roles();
		self::init_check_versions();

	}

	/**
	 * Init user roles
	 */
	private static function init_user_roles() {
		global $wp_roles;

		if ( class_exists( 'WP_Roles' ) && ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}

		if ( is_object( $wp_roles ) ) {

			add_role( 'dealer', __( 'Dealer', 'cardojo' ), array(
				'read'              => true, // Allows a user to read
		        'create_posts'      => true, // Allows user to create new posts
		        'edit_posts'        => true, // Allows user to edit their own posts
		        'edit_others_posts' => true, // Allows user to edit others posts too
		        'publish_posts'     => true, // Allows the user to publish posts
		        'manage_categories' => true, // Allows user to manage post categories
			) );

			$capabilities = self::get_core_capabilities();

			foreach ( $capabilities as $cap_group ) {
				foreach ( $cap_group as $cap ) {
					$wp_roles->add_cap( 'administrator', $cap );
				}
			}

		}
	}

	/**
	 * Get capabilities
	 * @return array
	 */
	private static function get_core_capabilities() {
		return array(
			'core' => array(
				'manage_vehicles'
			),
			'vehicle' => array(
				"edit_vehicle",
				"read_vehicle",
				"delete_vehicle",
				"edit_vehicles",
				"edit_others_vehicles",
				"publish_vehicles",
				"read_private_vehicles",
				"delete_vehicles",
				"delete_private_vehicles",
				"delete_published_vehicles",
				"delete_others_vehicles",
				"edit_private_vehicles",
				"edit_published_vehicles",
				"manage_vehicle_terms",
				"edit_vehicle_terms",
				"delete_vehicle_terms",
				"assign_vehicle_terms"
			),
			'core' => array(
				'manage_leads'
			),
			'lead' => array(
				"edit_lead",
				"read_lead",
				"delete_lead",
				"edit_leads",
				"edit_others_leads",
				"publish_leads",
				"read_private_leads",
				"delete_leads",
				"delete_private_leads",
				"delete_published_leads",
				"delete_others_leads",
				"edit_private_leads",
				"edit_published_leads",
				"manage_lead_terms",
				"edit_lead_terms",
				"delete_lead_terms",
				"assign_lead_terms"
			),
			'core' => array(
				'manage_deals'
			),
			'deal' => array(
				"edit_deal",
				"read_deal",
				"delete_deal",
				"edit_deals",
				"edit_others_deals",
				"publish_deals",
				"read_private_deals",
				"delete_deals",
				"delete_private_deals",
				"delete_published_deals",
				"delete_others_deals",
				"edit_private_deals",
				"edit_published_deals",
				"manage_deal_terms",
				"edit_deal_terms",
				"delete_deal_terms",
				"assign_deal_terms"
			)
		);
	}

	/**
	 * Init user roles
	 */
	private static function init_check_versions() {

		// If the user needs to install, send them to the setup wizard
		$current_cardojo_version = get_option( 'cardojo_version' );
		if ( empty( $current_cardojo_version ) ) {
			delete_option( 'cardojo_run_wizard' );
			add_option( 'cardojo_run_wizard', 'yes' );
		}

		self::update_cardojo_version();

	}

	/**
	 * Update WC version to current.
	 */
	private static function update_cardojo_version() {
		delete_option( 'cardojo_version' );
		add_option( 'cardojo_version', '1.0.2' );
	}

	public static function cardojo_create_page( $slug, $option = '', $page_title = '', $page_content = '', $post_parent = 0 ) {
		global $wpdb;

		$option_value = get_option( $option );

		if ( $option_value > 0 && ( $page_object = get_post( $option_value ) ) ) {
			if ( 'page' === $page_object->post_type && ! in_array( $page_object->post_status, array( 'pending', 'trash', 'future', 'auto-draft' ) ) ) {
				// Valid page is already in place
				return $page_object->ID;
			}
		}

		if ( strlen( $page_content ) > 0 ) {
			// Search for an existing page with the specified page content (typically a shortcode)
			$valid_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status NOT IN ( 'pending', 'trash', 'future', 'auto-draft' ) AND post_content LIKE %s LIMIT 1;", "%{$page_content}%" ) );
		} else {
			// Search for an existing page with the specified page slug
			$valid_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status NOT IN ( 'pending', 'trash', 'future', 'auto-draft' )  AND post_name = %s LIMIT 1;", $slug ) );
		}

		$valid_page_found = apply_filters( 'cardojo_create_page_id', $valid_page_found, $slug, $page_content );

		if ( $valid_page_found ) {
			if ( $option ) {
				update_option( $option, $valid_page_found );
			}
			return $valid_page_found;
		}

		// Search for a matching valid trashed page
		if ( strlen( $page_content ) > 0 ) {
			// Search for an existing page with the specified page content (typically a shortcode)
			$trashed_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = 'trash' AND post_content LIKE %s LIMIT 1;", "%{$page_content}%" ) );
		} else {
			// Search for an existing page with the specified page slug
			$trashed_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = 'trash' AND post_name = %s LIMIT 1;", $slug ) );
		}

		if ( $trashed_page_found ) {
			$page_id   = $trashed_page_found;
			$page_data = array(
				'ID'             => $page_id,
				'post_status'    => 'publish',
			);
		 	wp_update_post( $page_data );
		} else {
			$page_data = array(
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'post_author'    => 1,
				'post_name'      => $slug,
				'post_title'     => $page_title,
				'post_content'   => $page_content,
				'post_parent'    => $post_parent,
				'comment_status' => 'closed',
			);
			$page_id = wp_insert_post( $page_data );
		}

		if ( $option ) {
			update_option( $option, $page_id );
		}

		return $page_id;

	}

	public static function cardojo_get_page_id( $page ) {

		$page = apply_filters( 'cardojo_get_' . $page . '_page_id', get_option( 'cardojo_' . $page . '_page_id' ) );

		return $page ? absint( $page ) : -1;
	}

	/**
	 * Create pages that the plugin relies on, storing page IDs in variables.
	 */
	public static function create_pages() {

		$pages = apply_filters( 'cardojo_create_pages', array(
			'submit_car_form' => array(
				'name'    => _x( 'add-edit-vehicle', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Add/Edit Vehicle', 'Page title', 'cardojo' ),
				'content' => '[cardojo_submit]',
			),
			'dashboard' => array(
				'name'    => _x( 'dashboard', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Dashboard', 'Page title', 'cardojo' ),
				'content' => '[cardojo_dashboard]',
			),
			'inventory' => array(
				'name'    => _x( 'my-inventory', 'Page slug', 'cardojo' ),
				'title'   => _x( 'My Inventory', 'Page title', 'cardojo' ),
				'content' => '[cardojo_inventory]',
			),
			'cars' => array(
				'name'    => _x( 'cars', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Cars', 'Page title', 'cardojo' ),
				'content' => '[cardojo_cars]',
			),
			'reports' => array(
				'name'    => _x( 'reports', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Reports', 'Page title', 'cardojo' ),
				'content' => '[cardojo_reports]',
			),
			'notifications' => array(
				'name'    => _x( 'notifications', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Notifications', 'Page title', 'cardojo' ),
				'content' => '[cardojo_notifications]',
			),
			'my_favorites' => array(
				'name'    => _x( 'my_favorites', 'Page slug', 'cardojo' ),
				'title'   => _x( 'My Favorites', 'Page title', 'cardojo' ),
				'content' => '[cardojo_my_favorite]',
			),
			'filter_subscriptions' => array(
				'name'    => _x( 'filter_subscriptions', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Filter Subscriptions', 'Page title', 'cardojo' ),
				'content' => '[cardojo_filter_subscriptions]',
			),
			'user' => array(
				'name'    => _x( 'user', 'Page slug', 'cardojo' ),
				'title'   => _x( 'User', 'Page title', 'cardojo' ),
				'content' => '[cardojo_dealer_page]',
			),
			'settings' => array(
				'name'    => _x( 'settings', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Settings', 'Page title', 'cardojo' ),
				'content' => '[cardojo_account_settings]',
			),
			'login' => array(
				'name'    => _x( 'login', 'Page slug', 'cardojo' ),
				'title'   => _x( 'Login', 'Page title', 'cardojo' ),
				'content' => '[cardojo_login]',
			),
		) );

		foreach ( $pages as $key => $page ) {
			self::cardojo_create_page( esc_sql( $page['name'] ), 'cardojo_' . $key . '_page_id', $page['title'], $page['content'], ! empty( $page['parent'] ) ? cardojo_get_page_id( $page['parent'] ) : '' );
		}

	}

}
