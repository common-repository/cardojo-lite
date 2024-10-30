<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Shortcode_Inventory class.
 */
class CarDojo_Shortcode_Inventory {

	/**
	 * Inventory message
	 *
	 * @access private
	 * @var string
	 */
	private $car_inventory_message = '';
	private $car_expenses_status = '0';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'shortcode_inventory_action_handler' ) );
		add_shortcode( 'cardojo_inventory', array( $this, 'cardojo_inventory' ) );
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_inventory_action_handler() {
		global $post;

		if ( is_page() && strstr( $post->post_content, '[cardojo_inventory' ) ) {
			$this->car_inventory_handler();
		}
	}

	/**
	 * Handles actions on car inventory
	 */
	public function car_inventory_handler() {
		if ( ! empty( $_REQUEST['action'] ) && ! empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'cardojo_inventory_actions' ) ) {

			$action = sanitize_title( $_REQUEST['action'] );
			$car_id = absint( $_REQUEST['car_id'] );
			if(!empty($_REQUEST['expense_status'])) {
				$expense_status = absint( $_REQUEST['expense_status'] );
			}

			try {
				// Get car
				$car    = get_post( $car_id );

				// Check ownership
				if ( ! cardojo_user_can_edit_car( $car_id ) ) {
					throw new Exception( __( 'Invalid ID', 'cardojo' ) );
				}

				switch ( $action ) {
					case 'unpublish' :

						// Unpublish
						$my_post = array(
							'ID'            => $car_id,
						  	'post_type'     => 'vehicle',
						  	'post_status'   => 'draft',
						);
						wp_update_post( $my_post );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been unpublished', 'cardojo' ), $car->post_title ) . '</div>';
						break;
					case 'publish' :

						// Publish

						$my_post = array(
							'ID'            => $car_id,
						  	'post_type'     => 'vehicle',
						  	'post_status'   => 'publish',
						);
						wp_update_post( $my_post );
						update_post_meta( $car_id, '_submit_fee', 1 );

						break;
					case 'mark_sold' :
						// Check status
						if ( $car->_sold == 1 )
							throw new Exception( __( 'This car has already been sold', 'cardojo' ) );

						// Update
						update_post_meta( $car_id, '_sold', 1 );
						$date = strtotime(date("Y-m-d H:i:s"));
						$date_year = date("Y");
						$date_month = date("m");
						update_post_meta( $car_id, '_sold_date', $date );
						update_post_meta( $car_id, '_sold_date_year', $date_year );
						update_post_meta( $car_id, '_sold_date_month', $date_month );
						update_post_meta( $car_id, '_featured', 0 );
						update_post_meta( $car_id, '_paid_featured', 0 );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been sold', 'cardojo' ), $car->post_title ) . '</div>';
						break;
					case 'mark_not_sold' :
						// Check status
						if ( $car->_sold != 1 ) {
							throw new Exception( __( 'This car is not sold', 'cardojo' ) );
						}

						// Update
						update_post_meta( $car_id, '_sold', 0 );
						update_post_meta( $car_id, '_sold_date', "" );
						update_post_meta( $car_id, '_sold_date_year', "" );
						update_post_meta( $car_id, '_sold_date_month', "" );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been marked as not sold', 'cardojo' ), $car->post_title ) . '</div>';
						break;
					case 'mark_featured' :
						// Check status
						if ( $car->_featured == 1 )
							throw new Exception( __( 'This car has already been featured', 'cardojo' ) );

						// Update
						update_post_meta( $car_id, '_promoted', 0 );
						update_post_meta( $car_id, '_featured', 1 );
						cardojo_update_menu_order( $car_id, '_featured', 1 );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been featured', 'cardojo' ), $car->post_title ) . '</div>';
						
						break;
					case 'mark_not_featured' :
						// Check status
						if ( $car->_featured != 1 ) {
							throw new Exception( __( 'This car is not featured', 'cardojo' ) );
						}

						// Update
						update_post_meta( $car_id, '_featured', 0 );
						update_post_meta( $car_id, '_paid_featured', 0 );
						cardojo_update_menu_order( $car_id, '_featured', 0 );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been marked as not featured', 'cardojo' ), $car->post_title ) . '</div>';
						break;
					case 'mark_promoted' :
						// Check status
						if ( $car->_promoted == 1 )
							throw new Exception( __( 'This car is in promotion', 'cardojo' ) );

						// Update
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

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been promoted', 'cardojo' ), $car->post_title ) . '</div>';
						
						break;
					case 'mark_not_promoted' :
						// Check status
						if ( $car->_promoted != 1 ) {
							throw new Exception( __( 'This car is not promoted', 'cardojo' ) );
						}

						// Update
						update_post_meta( $car_id, '_promoted', 0 );
						update_post_meta( $car_id, '_promoted_next_payment', '' );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( 'Promotion has been stopped for %s', 'cardojo' ), $car->post_title ) . '</div>';
						break;
					case 'delete' :
						// Trash it
						wp_trash_post( $car_id );

						// Message
						$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( '%s has been deleted', 'cardojo' ), $car->post_title ) . '</div>';

						break;
					case 'edit' :
						if ( ! cardojo_get_permalink( 'submit_car_form' ) ) {
							throw new Exception( __( 'Missing submission page.', 'cardojo' ) );
						}

						if ( $car_id ) {
							wp_redirect( add_query_arg( array( 'action' => 'edit', 'car_id' => absint( $car_id ) ), cardojo_get_permalink( 'submit_car_form' ) ) );
							exit;
						}

						break;
					case 'duplicate' :
						if ( ! cardojo_get_permalink( 'submit_car_form' ) ) {
							throw new Exception( __( 'Missing submission page.', 'cardojo' ) );
						}

						$new_car_id = cardojo_duplicate_listing( $car_id );

						if ( $new_car_id ) {
							wp_redirect( add_query_arg( array( 'action' => 'duplicate', 'car_id' => absint( $new_car_id ) ), cardojo_get_permalink( 'submit_car_form' ) ) );
							exit;
						}

						break;
					case 'add_expenses' :
						// Update expenses
						if($expense_status == 1) {

							// Car Expenses
							update_post_meta($car_id, 'vehicle_expenses', $_POST['vehicle_expenses']);

							// Car Cost
							$vehicle_expenses = get_post_meta($car_id, 'vehicle_expenses',true);
							$vehicle_acquisition_price = 0;
							$vehicle_acquisition_price = esc_attr(get_post_meta($car_id, 'vehicle_acquisition_price',true));
							$vehicle_expenses_num = $vehicle_acquisition_price;
							if(!empty($vehicle_expenses)) {
								foreach ($vehicle_expenses as $vehicle_expenses_item) {
									if( !empty($vehicle_expenses_item[price]) ) {
										$vehicle_expenses_num = $vehicle_expenses_num + $vehicle_expenses_item[price];
									}
								}
							}

							update_post_meta($car_id, 'vehicle_cost', $vehicle_expenses_num);

							// Message
							$this->car_inventory_message = '<div class="car-manager-message">' . sprintf( __( 'Expenses added to %s', 'cardojo' ), $car->post_title ) . '</div>';
							$this->car_expenses_status = '1';
							
						}
						break;
					default :
						do_action( 'cardojo_inventory_do_action_' . $action );
						break;
				}

				do_action( 'cardojo_my_car_do_action', $action, $car_id );

			} catch ( Exception $e ) {
				$this->car_inventory_message = '<div class="car-manager-error">' . $e->getMessage() . '</div>';
			}
		}
	}

	/**
	 * Shortcode which lists the logged in user's cars
	 */
	public function cardojo_inventory( $atts ) {

		if ( ! is_user_logged_in() ) {
			ob_start();
			get_cardojo_template( 'cardojo-login.php' );
			return ob_get_clean();
		}

		ob_start();

		// If doing an action, show conditional content if needed....
		if ( ! empty( $_REQUEST['action'] ) ) {
			$action = sanitize_title( $_REQUEST['action'] );

			// Show alternative content if a plugin wants to
			if ( has_action( 'cardojo_inventory_content_' . $action ) ) {
				do_action( 'cardojo_inventory_content_' . $action, $atts );

				return ob_get_clean();
			}
		}

		echo $this->car_inventory_message;

		get_cardojo_template( 'cardojo-inventory.php', array( 'expenses_status' => $this->car_expenses_status ) );

		return ob_get_clean();
	}

}

new CarDojo_Shortcode_Inventory();
