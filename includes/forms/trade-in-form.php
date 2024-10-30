<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cardojo_trade_in_application( $shortcode_page ) { ?>

	<?php

	// Enqueue styles
	wp_enqueue_style( 'jquery-ui' );
	wp_enqueue_style( 'bootstrap-select' );

	// Enqueue scripts
    wp_enqueue_script( 'jquery-ui-autocomplete' );
    wp_enqueue_script( 'time-picker' );
	wp_enqueue_script( 'bootstrap-select' ); 

	$mail_sent = 0; 

	// Contact Car Dealer
	if( 'POST' == $_SERVER['REQUEST_METHOD'] AND ($_POST['cardojo_form_name'] == "trade_in" ) ) {

		if( isset( $_POST['TradeInRequestForm_nonce'] ) && wp_verify_nonce( $_POST['TradeInRequestForm_nonce'], 'TradeInRequestForm_html' ) ){

			// Personal Info
			$lead_first_name      = sanitize_text_field( $_POST['lead_first_name'] );
			$lead_middle_name     = sanitize_text_field( $_POST['lead_middle_name'] );
			$lead_last_name       = sanitize_text_field( $_POST['lead_last_name'] );

			$lead_address_1       = sanitize_text_field( $_POST['lead_address_1'] );
			$lead_address_2       = sanitize_text_field( $_POST['lead_address_2'] );

			$lead_city            = sanitize_text_field( $_POST['lead_city'] );
			$lead_state           = sanitize_text_field( $_POST['lead_state'] );
			$lead_zip             = sanitize_text_field( $_POST['lead_zip'] );

			$lead_home_phone      = sanitize_text_field( $_POST['lead_home_phone'] );
			$lead_mobile_phone    = sanitize_text_field( $_POST['lead_mobile_phone'] );
			$lead_work_phone      = sanitize_text_field( $_POST['lead_work_phone'] );

			$time_at_address      = sanitize_text_field( $_POST['time_at_address'] );
			$residence_type       = sanitize_text_field( $_POST['residence_type'] );
			$residence_price      = sanitize_text_field( $_POST['residence_price'] );

			$lead_email           = sanitize_email( $_POST['lead_email'] );
			$lead_birth_date      = sanitize_text_field( $_POST['lead_birth_date'] );

			// Employment Info
			$employer             = $_POST['employer'];
			$employer_name        = $employer['name'];
			$employer_income      = $employer['income'];
			$employer_occupation  = $employer['occupation'];
			$employer_address_1   = $employer['address_1'];
			$employer_address_2   = $employer['address_2'];
			$employer_city        = $employer['city'];
			$employer_state       = $employer['state'];
			$employer_zip         = $employer['zip'];
			$employer_phone       = $employer['phone'];
			$employer_years       = sanitize_text_field( $_POST['employer_years'] );
			$employer_months      = sanitize_text_field( $_POST['employer_months'] );

			// Trade In
			$lead_tradein_vehicle_year    = sanitize_text_field( $_POST['cq-year'] );
			$lead_tradein_vehicle_make    = sanitize_text_field( $_POST['vehicle_make_desc_init'] );
			$lead_tradein_vehicle_model   = sanitize_text_field( $_POST['cq-model'] );
			$lead_tradein_vehicle_trim_id = sanitize_text_field( $_POST['cq-trim'] );
			$lead_tradein_vehicle_trim_desc_init = sanitize_text_field( $_POST['vehicle_trim_desc_init'] );
			$lead_tradein_vehicle_make_desc_init = sanitize_text_field( $_POST['vehicle_make_desc_init'] );

			$lead_tradein_vehicle_vin     = sanitize_text_field( $_POST['lead_tradein_vehicle_vin'] );
			$lead_tradein_vehicle_mileage = sanitize_text_field( $_POST['lead_tradein_vehicle_mileage'] );
			$lead_tradein_vehicle_color   = sanitize_text_field( $_POST['lead_tradein_vehicle_color'] );

			$textMessage = wp_kses($_POST['lead_comments'], true);
			$site_name   = get_bloginfo('name');

			// Interested in Vehicle
			$lead_vehicle_id = sanitize_text_field( $_POST['lead_vehicle_id'] );

			$lead_vehicle_sku = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_stock',true));
			$lead_vehicle_year = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_year',true));
			$lead_vehicle_make = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_make_desc_init',true));
			$lead_vehicle_model = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_model',true));
			$lead_vehicle_trim = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_trim_desc_init',true));
			$lead_vehicle_vin = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_vin',true));

			$postNewTitle = $lead_first_name . " " . $lead_middle_name . " " . $lead_last_name;

			// Create New Lead
			$website_type = get_option("cardojo_webiste_type");
  			if( !empty($website_type) AND $website_type == "marketplace" ) {
  				$user_id = sanitize_text_field( $_POST['cardojo_dealer_id'] );
  			} else {
  				$user_id = '1';
  			}

			$my_post = array(
				'post_author'   => $user_id,
			  	'post_name'     => sanitize_title( $postNewTitle ),
			  	'post_title'    => $postNewTitle,
			  	'post_type'     => 'lead',
			  	'post_status'   => 'publish',
			);
			 
			// Insert the post into the database
			$td_post_id = wp_insert_post( $my_post );

			// Lead Meta
			update_post_meta($td_post_id, 'lead_first_name', sanitize_text_field($_POST['lead_first_name']));
			update_post_meta($td_post_id, 'lead_middle_name', sanitize_text_field($_POST['lead_middle_name']));
			update_post_meta($td_post_id, 'lead_last_name', sanitize_text_field($_POST['lead_last_name']));

			update_post_meta($td_post_id, 'lead_address_1', sanitize_text_field($_POST['lead_address_1']));
			update_post_meta($td_post_id, 'lead_address_2', sanitize_text_field($_POST['lead_address_2']));

			update_post_meta($td_post_id, 'lead_city', sanitize_text_field($_POST['lead_city']));
			update_post_meta($td_post_id, 'lead_state', sanitize_text_field($_POST['lead_state']));
			update_post_meta($td_post_id, 'lead_zip', sanitize_text_field($_POST['lead_zip']));

			update_post_meta($td_post_id, 'lead_home_phone', sanitize_text_field($_POST['lead_home_phone']));
			update_post_meta($td_post_id, 'lead_mobile_phone', sanitize_text_field($_POST['lead_mobile_phone']));
			update_post_meta($td_post_id, 'lead_work_phone', sanitize_text_field($_POST['lead_work_phone']));

			update_post_meta($td_post_id, 'lead_email', sanitize_email($_POST['lead_email']));
			update_post_meta($td_post_id, 'lead_birth_date', sanitize_text_field($_POST['lead_birth_date']));

			update_post_meta($td_post_id, 'lead_current_residence_years', sanitize_text_field($_POST['time_at_address']));
			update_post_meta($td_post_id, 'lead_current_residence_type', sanitize_text_field($_POST['residence_type']));
			update_post_meta($td_post_id, 'lead_current_residence_price', sanitize_text_field($_POST['residence_price']));

			update_post_meta($td_post_id, 'lead_website_lead_type', 'Trade-In');

			// Employer
			update_post_meta($td_post_id, 'lead_current_employer', $_POST['employer']);
			update_post_meta($td_post_id, 'lead_current_employer_years', sanitize_text_field($_POST['employer_years']));
			update_post_meta($td_post_id, 'lead_current_employer_months', sanitize_text_field($_POST['employer_months']));

			//
			$term = get_term_by('name', 'New', 'lead_status');
			$term_id = $term->term_id;

			update_post_meta($td_post_id, 'lead_status', $term_id);
			wp_set_post_terms( $td_post_id, $term_id, "lead_status", false );

			//
			$term = get_term_by('name', 'Internet Up', 'lead_up_type');
			$term_id = $term->term_id;

			wp_set_post_terms( $td_post_id, $term_id, "lead_up_type", false );
			update_post_meta($td_post_id, 'lead_up_type', $term_id);

			//
			$term = get_term_by('name', 'Dealer Website', 'lead_ad_source');
			$term_id = $term->term_id;

			wp_set_post_terms( $td_post_id, $term_id, "lead_ad_source", false );
			update_post_meta($td_post_id, 'lead_ad_source', $term_id);

			// Lead Comments
			update_post_meta($td_post_id, 'lead_comments', wp_kses($_POST['lead_comments'], true));

			// Co-Buyer
			$lead_cobuyer_current_residence = array(); 
			update_post_meta($td_post_id, 'lead_cobuyer_current_residence', $lead_cobuyer_current_residence);

			$lead_cobuyer_current_employer = array();
			update_post_meta($td_post_id, 'lead_cobuyer_current_employer', $lead_cobuyer_current_employer);

			//
			update_post_meta($td_post_id, 'lead_tradein_vehicle_year', sanitize_text_field($_POST['cq-year']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_make', sanitize_text_field($_POST['cq-make']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_model', sanitize_text_field($_POST['cq-model']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_trim_id', sanitize_text_field($_POST['cq-trim']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_trim_desc_init', sanitize_text_field($_POST['vehicle_trim_desc_init']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_make_desc_init', sanitize_text_field($_POST['vehicle_make_desc_init']));

			update_post_meta($td_post_id, 'lead_tradein_vehicle_vin', sanitize_text_field($_POST['lead_tradein_vehicle_vin']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_mileage', sanitize_text_field($_POST['lead_tradein_vehicle_mileage']));
			update_post_meta($td_post_id, 'lead_tradein_vehicle_color', sanitize_text_field($_POST['lead_tradein_vehicle_color']));

			// Interested in Vehicle
			update_post_meta($td_post_id, 'lead_vehicle_id', sanitize_text_field($_POST['lead_vehicle_id']));
			$lead_vehicle_id = esc_attr(get_post_meta($td_post_id, 'lead_vehicle_id',true));
			$lead_vehicle_sku_own = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_stock',true));
			update_post_meta($td_post_id, 'lead_vehicle_sku', $lead_vehicle_sku_own);

			// End Lead Meta


			// Admin Email Content
			$admin_email_content = '
			<table width="100%" border="0">
				<tr>
					<td colspan="2" style="font-size: 20px;font-weight:bold;color: #333;padding: 10px 0;">'.__('Trade-In Application', 'cardojo').'</td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="height: 30px;"></td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="font-size: 16px;font-weight:bold;color: #333;padding: 10px 0;">'.__('Buyer Personal Info', 'cardojo').'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Name', 'cardojo').'</td>
					<td>'.$postNewTitle.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Address 1', 'cardojo').'</td>
					<td>'.$lead_address_1.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Address 2', 'cardojo').'</td>
					<td>'.$lead_address_2.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('City', 'cardojo').'</td>
					<td>'.$lead_city.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('State', 'cardojo').'</td>
					<td>'.$lead_state.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Zip', 'cardojo').'</td>
					<td>'.$lead_zip.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Home Phone', 'cardojo').'</td>
					<td>'.$lead_home_phone.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Mobile Phone', 'cardojo').'</td>
					<td>'.$lead_mobile_phone.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Work Phone', 'cardojo').'</td>
					<td>'.$lead_work_phone.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Time at Residence (Years)', 'cardojo').'</td>
					<td>'.$time_at_address.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Residence Type', 'cardojo').'</td>
					<td>'.$residence_type.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Rent/Mortgage', 'cardojo').'</td>
					<td>'.$residence_price.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Email', 'cardojo').'</td>
					<td>'.$lead_email.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Birth Date', 'cardojo').'</td>
					<td>'.$lead_birth_date.'</td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="height: 30px;"></td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="font-size: 16px;font-weight:bold;color: #333;padding: 10px 0;">'.__('Buyer Employment Info', 'cardojo').'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Employer', 'cardojo').'</td>
					<td>'.$employer_name.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Monthly Income', 'cardojo').'</td>
					<td>'.$employer_income.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Occupation', 'cardojo').'</td>
					<td>'.$employer_occupation.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Address 1', 'cardojo').'</td>
					<td>'.$employer_address_1.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Address 2', 'cardojo').'</td>
					<td>'.$employer_address_2.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('City', 'cardojo').'</td>
					<td>'.$employer_city.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('State', 'cardojo').'</td>
					<td>'.$employer_state.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Zip', 'cardojo').'</td>
					<td>'.$employer_zip.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Phone Number', 'cardojo').'</td>
					<td>'.$employer_phone.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Time On Job - Years', 'cardojo').'</td>
					<td>'.$employer_years.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Time On Job - Months', 'cardojo').'</td>
					<td>'.$employer_months.'</td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="height: 30px;"></td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="font-size: 16px;font-weight:bold;color: #333;padding: 10px 0;">'.__('Questions and Comments', 'cardojo').'</td>
			  	</tr>
			  	<tr>
					<td colspan="2">'.wp_kses($textMessage, true).'</td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="font-size: 16px;font-weight:bold;color: #333;padding: 10px 0;">'.__('Trade-In', 'cardojo').'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Year', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_year.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Make', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_make.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Model', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_model.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Trim', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_trim_desc_init.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('VIN', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_vin.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Mileage', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_mileage.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Color', 'cardojo').'</td>
					<td>'.$lead_tradein_vehicle_color.'</td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="height: 30px;"></td>
			  	</tr>
			  	<tr>
					<td colspan="2" style="font-size: 16px;font-weight:bold;color: #333;padding: 10px 0;">'.__('Interested in Vehicle', 'cardojo').'</td>
			  	</tr>
			  	<tr>
					<td>'.__('SKU', 'cardojo').'</td>
					<td>'.$lead_vehicle_sku.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Year', 'cardojo').'</td>
					<td>'.$lead_vehicle_year.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Make', 'cardojo').'</td>
					<td>'.$lead_vehicle_make.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Model', 'cardojo').'</td>
					<td>'.$lead_vehicle_model.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('Trim', 'cardojo').'</td>
					<td>'.$lead_vehicle_trim.'</td>
			  	</tr>
			  	<tr>
					<td>'.__('VIN', 'cardojo').'</td>
					<td>'.$lead_vehicle_vin.'</td>
			  	</tr>
			</table>
			';

			// End Post Data

			if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
				$eol="\r\n";
			} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
				$eol="\r";
			} else {
				$eol="\n";
			}

			// Message for car dealer
			$from = sanitize_text_field( $_POST['lead_email'] );
			
			$website_type = get_option("cardojo_webiste_type");
  			if( !empty($website_type) AND $website_type == "marketplace" ) {
  				$email = sanitize_text_field( $_POST['cardojo_dealer_email'] );
  			} else {
  				$email = get_option('admin_email');
  			}

		  	$subject = __('Trade-In Application Form from ', 'cardojo').$site_name;
		  	$headers = "From: " . $from . $eol;
			$headers .= "Reply-To: " . $from . $eol;
			$headers .= "MIME-Version: 1.0".$eol;
			$headers .= "Content-Type: text/html; charset=ISO-8859-1".$eol;

		  	$msg = $admin_email_content;

		  	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
		  	$mail_sent = wp_mail( $email, $subject, $msg, $headers );

		} else {

			echo esc_html_e('Form key error! Submission could not be validated.', 'cardojo' ); 
			exit("No naughty business please");

		}

	}

	?>

	<div id="cd-form-wrapp" class="cd-form-wrapp">

		<input type="hidden" id="mail_sent_status" value="<?php echo esc_attr($mail_sent); ?>" />

		<?php if( $shortcode_page == 0 ) { ?>

	    <h4 class="heading"><?php esc_html_e('Trade-In', 'cardojo' ); ?></h4>

	    <?php } ?>

	    <?php if($mail_sent == 1) { ?>
		
		<h5 class="heading">
			<?php esc_html_e('Thank You.', 'cardojo' ); ?><br>
			<?php esc_html_e('Your Trade-In Request has been sent.', 'cardojo' ); ?><br>
			<?php esc_html_e('You should receive a confirmation shortly.', 'cardojo' ); ?><br>
			<?php esc_html_e('If you have questions or concerns please call and let us know.', 'cardojo' ); ?>
		</h5>

	    <?php } ?>

	    <?php if($mail_sent == 0) { ?>

	    <form id="submit-lead-cardojo-form" class="contact-form trade-in-form-application" action="<?php echo get_permalink(); ?>?form=trade_in#cardojo-contact-forms-holder" method="post">

	    	<div class="options_group">

				<h2 class="options_group_heading"><?php esc_html_e('Trade-In', 'cardojo' ); ?></h2>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-3">

							<label for="cq-make" class="control-label"><?php esc_html_e('Make', 'cardojo' ); ?></label>
							<input type="text" id="cq-make" name="cq-make" value="" placeholder="" />

						</div>

						<div class="cardojo-col-3">

							<label for="cq-model" class="control-label"><?php esc_html_e('Model', 'cardojo' ); ?></label>
							<input type="text" id="cq-model" name="cq-model" value="" placeholder="" />

						</div>

						<div class="cardojo-col-3">

							<label for="cq-year" class="control-label"><?php esc_html_e('Year', 'cardojo' ); ?></label>
							<input type="text" id="cq-year" name="cq-year" value="" placeholder="" />

						</div>

						<div class="cardojo-col-3">

							<label for="cq-trim" class="control-label"><?php esc_html_e('trim', 'cardojo' ); ?></label>
							<input type="text" id="cq-trim" name="cq-trim" value="" placeholder="" />

						</div>

					</div>

				</fieldset>

				<fieldset>
					
					<div class="cardojo-row">

						<div class="cardojo-col-4">

							<label for="lead_tradein_vehicle_vin" class="control-label"><?php esc_html_e('VIN:', 'cardojo' ); ?></label>
							<input type="text" id="lead_tradein_vehicle_vin" name="lead_tradein_vehicle_vin" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_tradein_vehicle_mileage" class="control-label"><?php esc_html_e('Mileage:', 'cardojo' ); ?></label>
							<input type="text" id="lead_tradein_vehicle_mileage" name="lead_tradein_vehicle_mileage" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_tradein_vehicle_color" class="control-label"><?php esc_html_e('Color:', 'cardojo' ); ?></label>
							<input type="text" id="lead_tradein_vehicle_color" name="lead_tradein_vehicle_color" value="" placeholder="" />

						</div>

					</div>
					
				</fieldset>

			</div>

			<?php if( $shortcode_page == 1 ) { ?>

			<div class="options_group">

				<h2 class="options_group_heading"><?php esc_html_e('Vehicle Interested In', 'cardojo' ); ?></h2>

				<fieldset>
				
					<div class="cardojo-row">

						<div class="cardojo-col-12">

							<label for="lead_vehicle_id" class="control-label"><?php esc_html_e('Select Vehicle', 'cardojo' ); ?></label>
							<select class="selectpicker" name="lead_vehicle_id" id="deal_vehicle_id" data-show-subtext="true" data-live-search="true" style="display: none;">

								<?php 

									$search_args = apply_filters( 'cardojo_get_inventory_cars_args', array(
										'post_type'           => 'vehicle',
										'post_status'         => 'publish',
										'posts_per_page'      => -1,
										'orderby'             => 'date',
										'order'               => 'desc'
									) );
									$cars_query = new WP_Query;
									$cars = $cars_query->query( $search_args );

									if ( $cars ) : 

										foreach ( $cars as $car ) :

											$car_ID = $car->ID; 

											$vehicle_year = esc_attr(get_post_meta($car_ID, 'vehicle_year',true));
											$vehicle_make = esc_attr(get_post_meta($car_ID, 'vehicle_make',true));
											$vehicle_model = esc_attr(get_post_meta($car_ID, 'vehicle_model',true));
											$vehicle_trim_desc_init = esc_attr(get_post_meta($car_ID, 'vehicle_trim_desc_init',true));
											$vehicle_make_desc_init = esc_attr(get_post_meta($car_ID, 'vehicle_make_desc_init',true));
											$vehicle_stock = esc_attr(get_post_meta($car_ID, 'vehicle_stock',true));
											$vehicle_vin = esc_attr(get_post_meta($car_ID, 'vehicle_vin',true));

											$vehicle_exterior_color = get_the_terms($car_ID, 'vehicle_exterior_color' );
											if(!empty($vehicle_exterior_color)) {
												$color      = cardojo_get_term_color( $vehicle_exterior_color[0]->term_id, true );
												$color_id   = $vehicle_exterior_color[0]->term_id;
												$color_name = $vehicle_exterior_color[0]->name;
											} else {
												$color_name = "";
											}

											$vehicle_mileage = esc_attr(get_post_meta($car_ID, 'vehicle_mileage',true));

											$price = esc_attr(get_post_meta($car_ID, 'vehicle_price',true));
											$cost = esc_attr(get_post_meta($car_ID, 'vehicle_cost',true));

											$lead_vehicle_id = 0;

								?>
									<option data-sku="<?php echo esc_attr($vehicle_stock); ?>" data-year="<?php echo esc_attr($vehicle_year); ?>" data-make="<?php echo esc_attr($vehicle_make_desc_init); ?>" data-model="<?php echo esc_attr($vehicle_model); ?>" data-trim="<?php echo esc_attr($vehicle_trim_desc_init); ?>" data-vin="<?php echo esc_attr($vehicle_vin); ?>" data-color="<?php echo esc_attr($color_name); ?>" data-mileage="<?php echo cardojo_number($vehicle_mileage); ?>" data-price="<?php echo cardojo_clean_price($price); ?>" data-clean-price="<?php echo esc_attr($price); ?>" data-cost="<?php echo esc_attr($cost); ?>" value="<?php echo esc_attr($car_ID); ?>" <?php selected( $car_ID, $lead_vehicle_id ); ?>><?php if(!empty($vehicle_stock)) { echo esc_attr($vehicle_stock); } else { echo esc_attr($car_ID); } ?> - <?php echo esc_attr($vehicle_year); ?> <?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?></option>
								<?php 

										endforeach; 

									endif;

								?>
								
							</select>

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_sku" class="control-label"><?php esc_html_e('Stock Number:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_sku" name="deal_vehicle_sku" value="<?php if(!empty($deal_vehicle_sku)) { echo esc_attr($deal_vehicle_sku); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_year" class="control-label"><?php esc_html_e('Year:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_year" name="deal_vehicle_year" value="<?php if(!empty($deal_vehicle_year)) { echo esc_attr($deal_vehicle_year); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_make" class="control-label"><?php esc_html_e('Make:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_make" name="deal_vehicle_make" value="<?php if(!empty($deal_vehicle_make)) { echo esc_attr($deal_vehicle_make); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_model" class="control-label"><?php esc_html_e('Model:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_model" name="deal_vehicle_model" value="<?php if(!empty($deal_vehicle_model)) { echo esc_attr($deal_vehicle_model); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_trim" class="control-label"><?php esc_html_e('Trim:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_trim" name="deal_vehicle_trim" value="<?php if(!empty($deal_vehicle_trim)) { echo esc_attr($deal_vehicle_trim); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_vin" class="control-label"><?php esc_html_e('VIN:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_vin" name="deal_vehicle_vin" value="<?php if(!empty($deal_vehicle_vin)) { echo esc_attr($deal_vehicle_vin); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_color" class="control-label"><?php esc_html_e('Color:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_color" name="deal_vehicle_color" value="<?php if(!empty($deal_vehicle_color)) { echo esc_attr($deal_vehicle_color); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_mileage" class="control-label"><?php esc_html_e('Mileage:', 'cardojo' ); ?></label>
							<input type="text" id="deal_vehicle_mileage" name="deal_vehicle_mileage" value="<?php if(!empty($deal_vehicle_mileage)) { echo esc_attr($deal_vehicle_mileage); } ?>" placeholder="" disabled="disabled" />

						</div>

						<div class="cardojo-col-4">

							<label for="deal_vehicle_price" class="control-label"><?php esc_html_e('Price:', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
							<input type="text" id="deal_vehicle_price" name="deal_vehicle_price" value="<?php if(!empty($deal_vehicle_price)) { echo esc_attr($deal_vehicle_price); } ?>" placeholder="" disabled="disabled" />

						</div>

					</div>
					
				</fieldset>
			
			</div>

			<?php } ?>

	    	<div class="options_group">

	    		<h2 class="options_group_heading"><?php esc_html_e('Personal Info', 'cardojo' ); ?></h2>

	    		<fieldset>
	      
			      	<div class="cardojo-row">

						<div class="cardojo-col-4 has-error-alert">

							<label for="lead_first_name" class="control-label"><?php esc_html_e('First Name:', 'cardojo' ); ?></label>
							<input type="text" id="lead_first_name" name="lead_first_name" value="" placeholder="" />
							<label id="lead_first_name-error" class="error" for="lead_first_name"><?php esc_html_e('Please add a name', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-4">

							<label for="lead_middle_name" class="control-label"><?php esc_html_e('Middle Name:', 'cardojo' ); ?></label>
							<input type="text" id="lead_middle_name" name="lead_middle_name" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_last_name" class="control-label"><?php esc_html_e('Last Name:', 'cardojo' ); ?></label>
							<input type="text" id="lead_last_name" name="lead_last_name" value="" placeholder="" />

						</div>

						<div class="cardojo-col-half">

							<label for="lead_address_1" class="control-label"><?php esc_html_e('Address 1:', 'cardojo' ); ?></label>
							<input type="text" id="lead_address_1" name="lead_address_1" value="" placeholder="" />

						</div>

						<div class="cardojo-col-half">

							<label for="lead_address_2" class="control-label"><?php esc_html_e('Address 2:', 'cardojo' ); ?></label>
							<input type="text" id="lead_address_2" name="lead_address_2" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_city" class="control-label"><?php esc_html_e('City:', 'cardojo' ); ?></label>
							<input type="text" id="lead_city" name="lead_city" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_state" class="control-label"><?php esc_html_e('State:', 'cardojo' ); ?></label>
							<input type="text" id="lead_state" name="lead_state" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_zip" class="control-label"><?php esc_html_e('Zip:', 'cardojo' ); ?></label>
							<input type="text" id="lead_zip" name="lead_zip" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="lead_home_phone" class="control-label"><?php esc_html_e('Home Phone:', 'cardojo' ); ?></label>
							<input type="text" id="lead_home_phone" name="lead_home_phone" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4 has-error-alert">

							<label for="lead_mobile_phone" class="control-label"><?php esc_html_e('Mobile Phone:', 'cardojo' ); ?></label>
							<input type="text" id="lead_mobile_phone" name="lead_mobile_phone" value="" placeholder="" />
							<label id="lead_mobile_phone-error" class="error" for="lead_mobile_phone"><?php esc_html_e('Please add a phone', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-4">

							<label for="lead_work_phone" class="control-label"><?php esc_html_e('Work Phone:', 'cardojo' ); ?></label>
							<input type="text" id="lead_work_phone" name="lead_work_phone" value="" placeholder="" />

						</div>

						<div class="cardojo-col-4">

							<label for="time_at_address" class="control-label"><?php esc_html_e('Time At Residence:', 'cardojo' ); ?></label>
							<select name="time_at_address" id="time_at_address" class="form-control input-lg">
								<option value=""></option>
								<option value="0"><?php esc_html_e('0 Years', 'cardojo' ); ?></option>
								<option value="1"><?php esc_html_e('1 Year', 'cardojo' ); ?></option>
								<option value="2"><?php esc_html_e('2 Years', 'cardojo' ); ?></option>
								<option value="3"><?php esc_html_e('3 Years', 'cardojo' ); ?></option>
								<option value="4"><?php esc_html_e('4 Years', 'cardojo' ); ?></option>
								<option value="5"><?php esc_html_e('5 Years', 'cardojo' ); ?></option>
								<option value="6"><?php esc_html_e('6 Years', 'cardojo' ); ?></option>
								<option value="7"><?php esc_html_e('7 Years', 'cardojo' ); ?></option>
								<option value="8"><?php esc_html_e('8 Years', 'cardojo' ); ?></option>
								<option value="9"><?php esc_html_e('9 Years', 'cardojo' ); ?></option>
								<option value="10"><?php esc_html_e('10 Years', 'cardojo' ); ?></option>
								<option value="11"><?php esc_html_e('11 Years', 'cardojo' ); ?></option>
								<option value="12"><?php esc_html_e('12+ Years', 'cardojo' ); ?></option>
							</select>

						</div>

						<div class="cardojo-col-4">

							<label for="residence_type" class="control-label"><?php esc_html_e('Residence Type:', 'cardojo' ); ?></label>
							<select name="residence_type" id="residence_type" class="form-control input-lg">
								<option value=""></option>
								<option value="Rent" ><?php esc_html_e('Rent', 'cardojo' ); ?></option>
								<option value="Own" ><?php esc_html_e('Own', 'cardojo' ); ?></option>

							</select>

						</div>

						<div class="cardojo-col-4">

							<label for="residence_price" class="control-label"><?php esc_html_e('Rent/Mortgage:', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
							<input type="text" id="residence_price" name="residence_price" value="" placeholder="" />

						</div>

						<div class="cardojo-col-half has-error-alert">

							<label for="lead_email" class="control-label"><?php esc_html_e('Email Address:', 'cardojo' ); ?></label>
							<input type="text" id="lead_email" name="lead_email" value="" placeholder="" />
							<label id="lead_email-error" class="error" for="lead_email"><?php esc_html_e('Please add an email', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-half">

							<label for="lead_birth_date" class="control-label"><?php esc_html_e('Date of Birth:', 'cardojo' ); ?></label>

							<div class="cardojo-input-has-icon">
								<input class="date_picker_past cardojo-input-icon-left" type="text" id="lead_birth_date" name="lead_birth_date" placeholder="<?php esc_html_e('Select Date', 'cardojo' ); ?>" value="" />
								<span class="fa fa-calendar cardojo-input-icon left" aria-hidden="true"></span>
							</div>

						</div>

					</div>

				</fieldset>

			</div>

			<div class="options_group">

				<h2 class="options_group_heading"><?php esc_html_e('Employment Info', 'cardojo' ); ?></h2>

				<fieldset>
						
					<div class="cardojo-row">

						<div id="buyer_employer" class="lead_buyer_employers active">

							<div class="cardojo-col-half">

								<label for="employer_name" class="control-label"><?php esc_html_e('Employer:', 'cardojo' ); ?></label>
								<input type="text" id="employer_name" name="employer[name]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_income" class="control-label"><?php esc_html_e('Monthly Income:', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
								<input type="text" id="employer_income" name="employer[income]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_occupation" class="control-label"><?php esc_html_e('Occupation:', 'cardojo' ); ?></label>
								<input type="text" id="employer_occupation" name="employer[occupation]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_address_1" class="control-label"><?php esc_html_e('Address 1:', 'cardojo' ); ?></label>
								<input type="text" id="employer_address_1" name="employer[address_1]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_address_2" class="control-label"><?php esc_html_e('Address 2:', 'cardojo' ); ?></label>
								<input type="text" id="employer_address_2" name="employer[address_2]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_city" class="control-label"><?php esc_html_e('City:', 'cardojo' ); ?></label>
								<input type="text" id="employer_city" name="employer[city]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_state" class="control-label"><?php esc_html_e('State:', 'cardojo' ); ?></label>
								<input type="text" id="employer_state" name="employer[state]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-half">

								<label for="employer_zip" class="control-label"><?php esc_html_e('Zip:', 'cardojo' ); ?></label>
								<input type="text" id="employer_zip" name="employer[zip]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-12">

								<label for="employer_phone" class="control-label"><?php esc_html_e('Phone Number:', 'cardojo' ); ?></label>
								<input type="text" id="employer_phone" name="employer[phone]" value="" placeholder="" />

							</div>

							<div class="cardojo-col-12">

								<h2 class="options_group_header"><span><?php esc_html_e('Time On Job', 'cardojo' ); ?></span></h2>

							</div>

							<div class="cardojo-col-half">

								<label for="employer_years" class="control-label"><?php esc_html_e('Years:', 'cardojo' ); ?></label>
								<select name="employer_years" id="employer_years" class="form-control input-lg">
									<option value=""></option>
									<option value="0" ><?php esc_html_e('0 Years', 'cardojo' ); ?></option>
									<option value="1" ><?php esc_html_e('1 Year', 'cardojo' ); ?></option>
									<option value="2" ><?php esc_html_e('2 Years', 'cardojo' ); ?></option>
									<option value="3" ><?php esc_html_e('3 Years', 'cardojo' ); ?></option>
									<option value="4" ><?php esc_html_e('4 Years', 'cardojo' ); ?></option>
									<option value="5" ><?php esc_html_e('5 Years', 'cardojo' ); ?></option>
									<option value="6" ><?php esc_html_e('6 Years', 'cardojo' ); ?></option>
									<option value="7" ><?php esc_html_e('7 Years', 'cardojo' ); ?></option>
									<option value="8" ><?php esc_html_e('8 Years', 'cardojo' ); ?></option>
									<option value="9" ><?php esc_html_e('9 Years', 'cardojo' ); ?></option>
									<option value="10" ><?php esc_html_e('10 Years', 'cardojo' ); ?></option>
									<option value="11" ><?php esc_html_e('11 Years', 'cardojo' ); ?></option>
									<option value="12" ><?php esc_html_e('12+ Years', 'cardojo' ); ?></option>

								</select>

							</div>

							<div class="cardojo-col-half">

								<label for="employer_months" class="control-label"><?php esc_html_e('Months:', 'cardojo' ); ?></label>
								<select name="employer_months" id="employer_months" class="form-control input-lg">
									<option value=""></option>
									<option value="0" ><?php esc_html_e('0 Months', 'cardojo' ); ?></option>
									<option value="1" ><?php esc_html_e('1 Month', 'cardojo' ); ?></option>
									<option value="2" ><?php esc_html_e('2 Months', 'cardojo' ); ?></option>
									<option value="3" ><?php esc_html_e('3 Months', 'cardojo' ); ?></option>
									<option value="4" ><?php esc_html_e('4 Months', 'cardojo' ); ?></option>
									<option value="5" ><?php esc_html_e('5 Months', 'cardojo' ); ?></option>
									<option value="6" ><?php esc_html_e('6 Months', 'cardojo' ); ?></option>
									<option value="7" ><?php esc_html_e('7 Months', 'cardojo' ); ?></option>
									<option value="8" ><?php esc_html_e('8 Months', 'cardojo' ); ?></option>
									<option value="9" ><?php esc_html_e('9 Months', 'cardojo' ); ?></option>
									<option value="10" ><?php esc_html_e('10 Months', 'cardojo' ); ?></option>
									<option value="11" ><?php esc_html_e('11 Months', 'cardojo' ); ?></option>

								</select>

							</div>

						</div>

					</div>

				</fieldset>

			</div>

			<div class="options_group">

				<h2 class="options_group_heading"><?php esc_html_e('Questions and Comments', 'cardojo' ); ?></h2>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-12">

							<textarea  cols="20" rows="7" class="input-text" name="lead_comments" placeholder=""></textarea>

						</div>

					</div>

				</fieldset>

			</div>
			
			<?php if( $shortcode_page == 0 ) { ?>
			<input type="hidden" name="lead_vehicle_id" value="<?php echo get_the_ID(); ?>" />
			<?php } ?>
			<input type="hidden" name="cardojo_form_name" value="trade_in" />

			<?php

				$website_type = get_option("cardojo_webiste_type");
  				if( !empty($website_type) AND $website_type == "marketplace" ) {

					$user_id = get_the_author_meta('ID');
					$user = get_userdata( $user_id ); 
					$dealer_email = $user->user_email;

			?>
			<input type="hidden" name="cardojo_dealer_id" value="<?php echo esc_attr($user_id); ?>" />
			<input type="hidden" name="cardojo_dealer_email" value="<?php echo esc_attr($dealer_email); ?>" />
			<?php } ?>

			<input type="hidden" name="action" value="TradeInRequestForm" />
			<?php wp_nonce_field( 'TradeInRequestForm_html', 'TradeInRequestForm_nonce' ); ?>

			<a id="cardojo_submit_tradein" href="#" class="btn btn-default"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <?php esc_html_e( 'Request Trade-In', 'cardojo' ) ?></a>

	    </form>

	    <?php } ?>

	</div>

<?php } ?>