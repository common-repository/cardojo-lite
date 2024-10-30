<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Submit class.
 */
class CarDojo_Shortcode_Submit {

	/**
	 * Inventory message
	 *
	 * @access private
	 * @var string
	 */
	private $car_submit_message = '';
	private $car_submit_status = '0';
	private $car_id = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'shortcode_submit_action_handler' ) );
		add_shortcode( 'cardojo_submit', array( $this, 'cardojo_submit' ) );
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_submit_action_handler() {
		global $post;

		if ( is_page() && strstr( $post->post_content, '[cardojo_submit' ) ) {
			$this->car_submit_handler();
		}
	}

	/**
	 * Handles actions on cardojo dashboard
	 */
	public function car_submit_handler() {

		if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

			if( isset( $_POST['submitVehicleFunction_nonce'] ) && wp_verify_nonce( $_POST['submitVehicleFunction_nonce'], 'submitVehicleFunction_html' ) ){

				if( isset($_POST['listing_id']) AND !empty($_POST['listing_id']) ) {
					$td_post_id = $_POST['listing_id'];
				} else {
					$td_post_id = "";
				}
				if( isset($_POST['action_name']) AND !empty($_POST['action_name']) ) {
					$action = sanitize_text_field($_POST['action_name']);
				} else {
					$action = "";
				}

				if( !empty($td_post_id) AND ! cardojo_user_can_edit_car( $td_post_id ) ) {

					$this->car_submit_message = "<div class='car-manager-error'>" . __( 'Invalid ID', 'cardojo' ). "</div>";
					$this->car_submit_status = "1";

				} else {

					$vehicle_year = sanitize_text_field( $_POST['cq-year'] );
					$vehicle_make_slug = sanitize_text_field( $_POST['cq-make'] );
					$vehicle_make_desc_init = sanitize_text_field( $_POST['vehicle_make_desc_init'] );
					$vehicle_model = sanitize_text_field( $_POST['cq-model'] );
					$vehicle_trim_desc_init = sanitize_text_field( $_POST['vehicle_trim_desc_init'] );
					$postNewTitle = $vehicle_year . " " . $vehicle_make_slug . " " . $vehicle_model . " " . $vehicle_trim_desc_init . " " . $td_post_id;
					$postNewName = $vehicle_year . " " . $vehicle_make_desc_init . " " . $vehicle_model . " " . $vehicle_trim_desc_init;

					if( empty($action) ) {

						$submit_fee = get_option("cardojo_submit_listing_price");

						if( !empty($submit_fee) AND $submit_fee > 0 AND !current_user_can('administrator') ) {
							$post_status = "draft";
						} else {
							$post_status = "publish";
						}

						$my_post = array(
						  	'post_name'     => sanitize_title( $postNewTitle ),
						  	'post_title'    => $postNewName,
						  	'post_type'     => 'vehicle',
						  	'post_status'   => $post_status,
						);
						 
						// Insert the post into the database
						$td_post_id = wp_insert_post( $my_post );
						update_post_meta( $td_post_id, '_sold', 0 );
						update_post_meta( $td_post_id, '_sold_date', 0 );
						update_post_meta( $td_post_id, '_submit_fee', 0 );

						$my_post = array(
							'ID'            => $td_post_id,
						  	'post_name'     => sanitize_title( $postNewTitle ),
						  	'post_title'    => $postNewName,
						  	'post_type'     => 'vehicle',
						  	'post_status'   => $post_status,
						);

						wp_update_post( $my_post );

					}

					$my_post = array(
						'ID'            => $td_post_id,
					  	'post_name'     => sanitize_title( $postNewTitle ),
					  	'post_title'    => $postNewName,
					);

					wp_update_post( $my_post );

					$this->car_id = $td_post_id;

					$td_allowed = true;

					// Car Info
					update_post_meta($td_post_id, 'vehicle_year', sanitize_text_field($_POST['cq-year']));
					update_post_meta($td_post_id, 'vehicle_make', sanitize_text_field($_POST['cq-make']));
					update_post_meta($td_post_id, 'vehicle_model', sanitize_text_field($_POST['cq-model']));
					update_post_meta($td_post_id, 'vehicle_trim_id', sanitize_text_field($_POST['cq-trim']));
					update_post_meta($td_post_id, 'vehicle_trim_desc_init', sanitize_text_field($_POST['vehicle_trim_desc_init']));
					update_post_meta($td_post_id, 'vehicle_make_desc_init', sanitize_text_field($_POST['vehicle_make_desc_init']));
					update_post_meta($td_post_id, 'vehicle_stock', sanitize_text_field($_POST['vehicle_stock']));
					update_post_meta($td_post_id, 'vehicle_vin', sanitize_text_field($_POST['vehicle_vin']));
					update_post_meta($td_post_id, 'vehicle_carfax_link', sanitize_text_field($_POST['vehicle_carfax_link']));

					update_post_meta($td_post_id, 'vehicle_condition', sanitize_text_field($_POST['vehicle_condition']));

					if(!isset($_POST['vehicle_mileage']) OR empty($_POST['vehicle_mileage'])) {
						$mileage = "0";
					} else {
						$mileage = sanitize_text_field($_POST['vehicle_mileage']);
					}
					update_post_meta($td_post_id, 'vehicle_mileage', $mileage);
					update_post_meta($td_post_id, 'vehicle_condition_num', sanitize_text_field($_POST['vehicle_condition_num']));
					update_post_meta($td_post_id, 'vehicle_owners', sanitize_text_field($_POST['vehicle_owners']));

					if( isset($_POST['vehicle_accident_free'])) {
						$vehicle_accident_free = sanitize_text_field($_POST['vehicle_accident_free']);
					} else {
						$vehicle_accident_free = "";
					}
					update_post_meta($td_post_id, 'vehicle_accident_free', $vehicle_accident_free);

					if( isset($_POST['vehicle_service_history'])) {
						$vehicle_service_history = sanitize_text_field($_POST['vehicle_service_history']);
					} else {
						$vehicle_service_history = "";
					}
					update_post_meta($td_post_id, 'vehicle_service_history', $vehicle_service_history);

					update_post_meta($td_post_id, 'vehicle_doors', sanitize_text_field($_POST['vehicle_doors']));
					update_post_meta($td_post_id, 'vehicle_seats', sanitize_text_field($_POST['vehicle_seats']));

					// Vehicle Body Style
					if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_body_style'] ), 'vehicle_body_style' ) ) {

						$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_body_style']), 'vehicle_body_style' );

						if ( ! is_wp_error( $submit_term ) ) {
						    // Get term_id, set default as 0 if not set
						    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
						    wp_set_post_terms( $td_post_id, $term_id, "vehicle_body_style", false );

						}

					} else {

						$terms_body_style = sanitize_text_field($_POST['vehicle_body_style']);
						wp_set_post_terms( $td_post_id, $terms_body_style, "vehicle_body_style", false );

					}

					// Vehicle Collection
					if(!empty($_POST['vehicle_collection'])) {
						$vehicle_collection = sanitize_text_field($_POST['vehicle_collection']);
					} else {
						$vehicle_collection = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_collection, "vehicle_collection", false );

					$terms_color = sanitize_text_field($_POST['vehicle_exterior_color']);
					wp_set_post_terms( $td_post_id, $terms_color, "vehicle_exterior_color", false );

					$terms_int_color = sanitize_text_field($_POST['vehicle_interior_color']);
					wp_set_post_terms( $td_post_id, $terms_int_color, "vehicle_interior_color", false );

					if( isset($_POST['vehicle_metalic_paint'])) {
						$vehicle_metalic_paint = sanitize_text_field($_POST['vehicle_metalic_paint']);
					} else {
						$vehicle_metalic_paint = "";
					}
					update_post_meta($td_post_id, 'vehicle_metalic_paint', $vehicle_metalic_paint);

					$vehicle_interior_material = sanitize_text_field($_POST['vehicle_interior_material']);
					wp_set_post_terms( $td_post_id, $vehicle_interior_material, "vehicle_interior_material", false );

					if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_fuel_type'] ), 'vehicle_fuel_type' ) ) {

						$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_fuel_type']), 'vehicle_fuel_type' );

						if ( ! is_wp_error( $submit_term ) ) {
						    // Get term_id, set default as 0 if not set
						    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
						    wp_set_post_terms( $td_post_id, $term_id, "vehicle_fuel_type", false );

						}

					} else {

						$vehicle_fuel_type = sanitize_text_field($_POST['vehicle_fuel_type']);
						wp_set_post_terms( $td_post_id, $vehicle_fuel_type, "vehicle_fuel_type", false );

					}

					update_post_meta($td_post_id, 'vehicle_engine_volume_l', sanitize_text_field($_POST['vehicle_engine_volume_l']));
					update_post_meta($td_post_id, 'vehicle_engine_volume_ccm', sanitize_text_field($_POST['vehicle_engine_volume_ccm']));
					update_post_meta($td_post_id, 'vehicle_engine_position', sanitize_text_field($_POST['vehicle_engine_position']));
					update_post_meta($td_post_id, 'vehicle_cilinders', sanitize_text_field($_POST['vehicle_cilinders']));
					update_post_meta($td_post_id, 'vehicle_engine_type', sanitize_text_field($_POST['vehicle_engine_type']));
					update_post_meta($td_post_id, 'vehicle_power_hp', sanitize_text_field($_POST['vehicle_power_hp']));
					update_post_meta($td_post_id, 'vehicle_power_kw', sanitize_text_field($_POST['vehicle_power_kw']));
					update_post_meta($td_post_id, 'vehicle_max_power_rpm', sanitize_text_field($_POST['vehicle_max_power_rpm']));
					update_post_meta($td_post_id, 'vehicle_torque_nm', sanitize_text_field($_POST['vehicle_torque_nm']));
					update_post_meta($td_post_id, 'vehicle_max_torque_rpm', sanitize_text_field($_POST['vehicle_max_torque_rpm']));
					update_post_meta($td_post_id, 'vehicle_gears_num', sanitize_text_field($_POST['vehicle_gears_num']));
					update_post_meta($td_post_id, 'vehicle_accel_0_100', sanitize_text_field($_POST['vehicle_accel_0_100']));

					// Car Description
					update_post_meta($td_post_id, 'vehicle_description', wp_kses($_POST['vehicle_description'], true));

					//
					if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_transmission'] ), 'vehicle_transmission' ) ) {

						$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_transmission']), 'vehicle_transmission' );

						if ( ! is_wp_error( $submit_term ) ) {
						    // Get term_id, set default as 0 if not set
						    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
						    wp_set_post_terms( $td_post_id, $term_id, "vehicle_transmission", false );

						}

					} else {

						$vehicle_transmission = sanitize_text_field($_POST['vehicle_transmission']);
						wp_set_post_terms( $td_post_id, $vehicle_transmission, "vehicle_transmission", false );

					}

					//
					if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_drive'] ), 'vehicle_drive' ) ) {

						$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_drive']), 'vehicle_drive' );

						if ( ! is_wp_error( $submit_term ) ) {
						    // Get term_id, set default as 0 if not set
						    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
						    wp_set_post_terms( $td_post_id, $term_id, "vehicle_drive", false );

						}

					} else {

						$vehicle_drive = sanitize_text_field($_POST['vehicle_drive']);
						wp_set_post_terms( $td_post_id, $vehicle_drive, "vehicle_drive", false );

					}

					// Car Fuel consumption and emissions
					update_post_meta($td_post_id, 'vehicle_consumption_combined', sanitize_text_field($_POST['vehicle_consumption_combined']));
					update_post_meta($td_post_id, 'vehicle_consumption_urban', sanitize_text_field($_POST['vehicle_consumption_urban']));
					update_post_meta($td_post_id, 'vehicle_consumption_highway', sanitize_text_field($_POST['vehicle_consumption_highway']));
					update_post_meta($td_post_id, 'vehicle_emissions', sanitize_text_field($_POST['vehicle_emissions']));
					update_post_meta($td_post_id, 'vehicle_emission_class', sanitize_text_field($_POST['vehicle_emission_class']));
					update_post_meta($td_post_id, 'vehicle_fuel_tank', sanitize_text_field($_POST['vehicle_fuel_tank']));

					// Car Dimensions and weight
					update_post_meta($td_post_id, 'vehicle_length', sanitize_text_field($_POST['vehicle_length']));
					update_post_meta($td_post_id, 'vehicle_width', sanitize_text_field($_POST['vehicle_width']));
					update_post_meta($td_post_id, 'vehicle_height', sanitize_text_field($_POST['vehicle_height']));
					update_post_meta($td_post_id, 'vehicle_wheelbase', sanitize_text_field($_POST['vehicle_wheelbase']));
					update_post_meta($td_post_id, 'vehicle_weight', sanitize_text_field($_POST['vehicle_weight']));

					// Car features and specifications
					if( isset($_POST['vehicle_wheel_size'])) {
						$vehicle_wheel_size = sanitize_text_field($_POST['vehicle_wheel_size']);
					} else {
						$vehicle_wheel_size = "";
					}
					update_post_meta($td_post_id, 'vehicle_wheel_size', $vehicle_wheel_size);

					if(!empty($_POST['vehicle_safety'])) {
						$vehicle_safety = esc_attr($_POST['vehicle_safety']);
					} else {
						$vehicle_safety = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_safety, "vehicle_safety", false );

					if(!empty($_POST['vehicle_comfort'])) {
						$vehicle_comfort = esc_attr($_POST['vehicle_comfort']);
					} else {
						$vehicle_comfort = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_comfort, "vehicle_comfort", false );

					if(!empty($_POST['vehicle_visibility'])) {
						$vehicle_visibility = esc_attr($_POST['vehicle_visibility']);
					} else {
						$vehicle_visibility = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_visibility, "vehicle_visibility", false );

					if(!empty($_POST['vehicle_exterior'])) {
						$vehicle_exterior = esc_attr($_POST['vehicle_exterior']);
					} else {
						$vehicle_exterior = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_exterior, "vehicle_exterior", false );

					if(!empty($_POST['vehicle_interior'])) {
						$vehicle_interior = esc_attr($_POST['vehicle_interior']);
					} else {
						$vehicle_interior = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_interior, "vehicle_interior", false );

					if(!empty($_POST['vehicle_multimedia'])) {
						$vehicle_multimedia = esc_attr($_POST['vehicle_multimedia']);
					} else {
						$vehicle_multimedia = "";
					}
					wp_set_post_terms( $td_post_id, $vehicle_multimedia, "vehicle_multimedia", false );

					// Car Price
					update_post_meta($td_post_id, 'vehicle_acquisition_price', sanitize_text_field($_POST['vehicle_acquisition_price']));
					update_post_meta($td_post_id, 'vehicle_retail_price', sanitize_text_field($_POST['vehicle_retail_price']));
					update_post_meta($td_post_id, 'vehicle_discounted_price', sanitize_text_field($_POST['vehicle_discounted_price']));

					if( isset($_POST['vehicle_discount'])) {
						$vehicle_discount = sanitize_text_field($_POST['vehicle_discount']);
					} else {
						$vehicle_discount = "";
					}
					update_post_meta($td_post_id, 'vehicle_discount', $vehicle_discount);

					$vehicle_retail_price = esc_attr(get_post_meta($td_post_id, 'vehicle_retail_price',true));
					$vehicle_discount = esc_attr(get_post_meta($td_post_id, 'vehicle_discount',true));
					$vehicle_discounted_price = esc_attr(get_post_meta($td_post_id, 'vehicle_discounted_price',true));
					if( $vehicle_discount == "on" AND !empty($vehicle_discounted_price) ) {
						$price = $vehicle_discounted_price;
					} else {
						$price = $vehicle_retail_price;
					}
					update_post_meta($td_post_id, 'vehicle_price', $price);

					if( isset($_POST['vehicle_cheaper_car_exg'])) {
						$vehicle_cheaper_car_exg = sanitize_text_field($_POST['vehicle_cheaper_car_exg']);
					} else {
						$vehicle_cheaper_car_exg = "";
					}
					update_post_meta($td_post_id, 'vehicle_cheaper_car_exg', $vehicle_cheaper_car_exg);

					if( isset($_POST['vehicle_expensive_car_exg'])) {
						$vehicle_expensive_car_exg = sanitize_text_field($_POST['vehicle_expensive_car_exg']);
					} else {
						$vehicle_expensive_car_exg = "";
					}
					update_post_meta($td_post_id, 'vehicle_expensive_car_exg', $vehicle_expensive_car_exg);

					if( isset($_POST['vehicle_negociable_price'])) {
						$vehicle_negociable_price = sanitize_text_field($_POST['vehicle_negociable_price']);
					} else {
						$vehicle_negociable_price = "";
					}
					update_post_meta($td_post_id, 'vehicle_negociable_price', $vehicle_negociable_price);

					// Car Location

					if(!empty($_POST['vehicle_location'])) {
						$vehicle_location = sanitize_text_field($_POST['vehicle_location']);
					} else {
						$vehicle_location = "";
					}

					if( $_POST['vehicle_location'] == "new" ) {

						$vehicle_location = "";

						if ( !get_term_by( 'slug', sanitize_title( $_POST['vehicle_location_address'] ), 'vehicle_location' ) ) {
										
							$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_location_address']), 'vehicle_location' );

							if ( ! is_wp_error( $submit_term ) ) {
							    // Get term_id, set default as 0 if not set
							    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;

							    update_term_meta( $term_id, 'vehicle_location_name', sanitize_text_field($_POST['vehicle_location_name']) );
							    update_term_meta( $term_id, 'vehicle_location_mobile_phone', sanitize_text_field($_POST['vehicle_location_mobile_phone']) );
							    update_term_meta( $term_id, 'vehicle_location_phone', sanitize_text_field($_POST['vehicle_location_phone']) );
							    update_term_meta( $term_id, 'vehicle_location_email', sanitize_text_field($_POST['vehicle_location_email']) );
							    update_term_meta( $term_id, 'vehicle_location_address', sanitize_text_field($_POST['vehicle_location_address']) );
							    update_term_meta( $term_id, 'vehicle_location_latitude', sanitize_text_field($_POST['vehicle_location_latitude']) );
							    update_term_meta( $term_id, 'vehicle_location_longitude', sanitize_text_field($_POST['vehicle_location_longitude']) );

								$vehicle_location = $term_id;

							}

						}

					}

					wp_set_post_terms( $td_post_id, $vehicle_location, "vehicle_location", false );

					// Update selected location meta
					if(!empty($vehicle_location)) {

						update_term_meta( $vehicle_location, 'vehicle_location_name', sanitize_text_field($_POST['vehicle_location_name']) );
				    	update_term_meta( $vehicle_location, 'vehicle_location_mobile_phone', sanitize_text_field($_POST['vehicle_location_mobile_phone']) );
				    	update_term_meta( $vehicle_location, 'vehicle_location_phone', sanitize_text_field($_POST['vehicle_location_phone']) );
				    	update_term_meta( $vehicle_location, 'vehicle_location_email', sanitize_text_field($_POST['vehicle_location_email']) );
				    	update_term_meta( $vehicle_location, 'vehicle_location_address', sanitize_text_field($_POST['vehicle_location_address']) );
				    	update_term_meta( $vehicle_location, 'vehicle_location_latitude', sanitize_text_field($_POST['vehicle_location_latitude']) );
					    update_term_meta( $vehicle_location, 'vehicle_location_longitude', sanitize_text_field($_POST['vehicle_location_longitude']) );

				    	// update name and slug
				    	wp_update_term( $vehicle_location, 'vehicle_location', array(
						  	'name' => sanitize_text_field($_POST['vehicle_location_address']),
						  	'slug' => sanitize_title( $_POST['vehicle_location_address'] )
						));

					}

					// Car Image Gallery
					if( isset($_POST['vehicle_image_gallery'])) {
						$vehicle_image_gallery = $_POST['vehicle_image_gallery'];
					} else {
						$vehicle_image_gallery = "";
					}
					update_post_meta($td_post_id, 'vehicle_image_gallery', $vehicle_image_gallery);

					if( isset($_POST['vehicle_image_extended_gallery'])) {
						$vehicle_image_extended_gallery = $_POST['vehicle_image_extended_gallery'];
					} else {
						$vehicle_image_extended_gallery = "";
					}
					update_post_meta($td_post_id, 'vehicle_image_extended_gallery', $vehicle_image_extended_gallery);

					// Cover image
					$vehicle_image_gallery = get_post_meta($td_post_id, 'vehicle_image_gallery',true);
					$vehicle_image_extended_gallery = get_post_meta($td_post_id, 'vehicle_image_extended_gallery',true);
					$vehicle_cover_image = "";

					if(!empty($vehicle_image_gallery)) {

						foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
							
							if( !empty($vehicle_image_gallery_item['url']) ) {

								if( empty($vehicle_cover_image) ) {

									$vehicle_cover_image = esc_url($vehicle_image_gallery_item['url']);

								}

							}

						}

					}

					if(!empty($vehicle_image_extended_gallery)) {

						foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
							
							if( !empty($vehicle_image_extended_gallery_item['url']) ) {

								if( empty($vehicle_cover_image) ) {

									$vehicle_cover_image = esc_url($vehicle_image_extended_gallery_item['url']);

								}

							}

						}

					}

					update_post_meta($td_post_id, 'vehicle_cover_image', $vehicle_cover_image);

					// Car Expenses
					if( isset($_POST['vehicle_expenses'])) {
						$vehicle_expenses = $_POST['vehicle_expenses'];
					} else {
						$vehicle_expenses = "";
					}
					update_post_meta($td_post_id, 'vehicle_expenses', $vehicle_expenses);

					// Car Cost
					$vehicle_expenses = get_post_meta($td_post_id, 'vehicle_expenses',true);
					$vehicle_acquisition_price = 0;
					$vehicle_acquisition_price = esc_attr(get_post_meta($td_post_id, 'vehicle_acquisition_price',true));
					$vehicle_expenses_num = $vehicle_acquisition_price;
					if(!empty($vehicle_expenses)) {
						foreach ($vehicle_expenses as $vehicle_expenses_item) {
							if( !empty($vehicle_expenses_item['price']) ) {
								$vehicle_expenses_num = $vehicle_expenses_num + $vehicle_expenses_item['price'];
							}
						}
					}

					update_post_meta($td_post_id, 'vehicle_cost', $vehicle_expenses_num);

					//
					$vehicle_year = esc_attr(get_post_meta($td_post_id, 'vehicle_year',true));
					$vehicle_make_slug = esc_attr(get_post_meta($td_post_id, 'vehicle_make',true));
					$vehicle_make_desc_init = esc_attr(get_post_meta($td_post_id, 'vehicle_make_desc_init',true));
					$vehicle_model = esc_attr(get_post_meta($td_post_id, 'vehicle_model',true));
					$vehicle_trim_desc_init = esc_attr(get_post_meta($td_post_id, 'vehicle_trim_desc_init',true));

					$postNewTitle = $vehicle_year . " " . $vehicle_make_slug . " " . $vehicle_model . " " . $vehicle_trim_desc_init . " " . $td_post_id;
					$postNewName = $vehicle_year . " " . $vehicle_make_desc_init . " " . $vehicle_model . " " . $vehicle_trim_desc_init;

					$this->car_submit_message = '<div class="car-manager-message">' . sprintf( __( '%s has been saved', 'cardojo' ), $postNewName ) . '</div>';
					$this->car_submit_status = "0";

					// Update Model Taxonomy
					function insert_term ($term, $taxonomy, $args = array()) {

				        if (isset($args['parent'])) {
				            $parent = $args['parent'];
				        } else {
				            $parent = 0;
				        }
				        $result = term_exists($term, $taxonomy, $parent);
				        if ($result == false || $result == 0) {
				            return wp_insert_term($term, $taxonomy, $args);             
				        } else {
				            return (array) $result;
				        }       

					}
					
					$cat_ids = array();

					$vehicle_year = esc_attr(get_post_meta($td_post_id, 'vehicle_year',true));
					$vehicle_make = esc_attr(get_post_meta($td_post_id, 'vehicle_make',true));
					$vehicle_model = esc_attr(get_post_meta($td_post_id, 'vehicle_model',true));
					$vehicle_trim_desc_init = esc_attr(get_post_meta($td_post_id, 'vehicle_trim_desc_init',true));
					$vehicle_make_desc_init = esc_attr(get_post_meta($td_post_id, 'vehicle_make_desc_init',true));
					
					if(!empty($vehicle_year)) {
						$v_year = insert_term( $vehicle_year, 'vehicle_model' );
					}
					
					if( !empty($vehicle_year) AND !empty($vehicle_make) ) {
						$v_make = insert_term( $vehicle_make_desc_init , 'vehicle_model', array('parent'=>$v_year['term_id']) );
					}

					if( !empty($vehicle_year) AND !empty($vehicle_make) AND !empty($vehicle_model) ) {
						$v_model = insert_term( $vehicle_model, 'vehicle_model', array('parent'=>$v_make['term_id']) );
					}

					if( !empty($vehicle_year) AND !empty($vehicle_make) AND !empty($vehicle_model) AND !empty($vehicle_trim_desc_init) ) {

						$v_trim = insert_term( $vehicle_trim_desc_init, 'vehicle_model', array('parent'=>$v_model['term_id']) );

						$cat_ids = array( $v_year['term_id'], $v_make['term_id'], $v_model['term_id'], $v_trim['term_id'] );
						$cat_ids = array_map( 'intval', $cat_ids );
						$cat_ids = array_unique( $cat_ids );

						$vehicle_model_set = wp_set_object_terms( $td_post_id, $cat_ids, 'vehicle_model' );
						
					}

				}

			}

		}

	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_submit( $atts ) {
		
		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		// Enqueue styles
		wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( 'bootstrap-select' );

		// Enqueue scripts
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'time-picker' );
		wp_enqueue_script( 'bootstrap-select' );

		ob_start();

		// If doing an action, show conditional content if needed....
		if ( ! empty( $_REQUEST['action'] ) ) {
			$action = sanitize_title( $_REQUEST['action'] );

			// Show alternative content if a plugin wants to
			if ( has_action( 'cardojo_submit_content_' . $action ) ) {
				do_action( 'cardojo_submit_content_' . $action, $atts );

				return ob_get_clean();
			}
		}

		echo $this->car_submit_message;

		if($this->car_submit_status == 0) {

			get_cardojo_template( 'cardojo-submit.php', array( 'car_id' => $this->car_id ) );

		}

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Submit();
