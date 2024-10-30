<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Settings class.
 */
class CarDojo_Settings {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->settings_group = 'car';
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * init_settings function.
	 *
	 * @access protected
	 * @return void
	 */
	protected function init_settings() {
		
		// Prepare roles option
		$roles         = get_editable_roles();
		$account_roles = array();

		foreach ( $roles as $key => $role ) {
			if ( $key == 'administrator' ) {
				continue;
			}
			$account_roles[ $key ] = $role['name'];
		}

		$currency_code_options = get_cardojo_currencies();

		foreach ( $currency_code_options as $code => $name ) {
			$currency_code_options[ $code ] = $name . ' (' . get_cardojo_currency_symbol( $code ) . ')';
		}

		$this->settings = apply_filters( 'car_settings',
			array(
				'main_settings' => array(
					__( 'Main Settings', 'cardojo' ),
					array(
						array(
							'name'       => 'cardojo_webiste_type',
							'std'        => 'dealer',
							'label'      => __( 'Website Type', 'cardojo' ),
							'type'       => 'select',
							'options' => array(
								'dealer'  => __( 'Vehicles shop (Car dealer)', 'cardojo' ),
								'marketplace' => __( 'Marketplace', 'cardojo' ),
							)
						),
						array(
							'name'        => 'cardojo_posts_per_page',
							'std'         => '9',
							'placeholder' => '',
							'label'       => __( 'Vehicles per page', 'cardojo' ),
							'attributes'  => array()
						),
						array(
							'name'       => 'cardojo_measurement_type',
							'std'        => 'metric',
							'label'      => __( 'System of Measurement', 'cardojo' ),
							'type'       => 'select',
							'options' => array(
								'metric'  => __( 'Metric', 'cardojo' ),
								'usa' => __( 'U.S.', 'cardojo' ),
							)
						),
						array(
							'name'       => 'cardojo_currency',
							'std'        => 'USD',
							'label'      => __( 'Currency', 'cardojo' ),
							'type'       => 'select',
							'options'    => $currency_code_options
						),
						array(
							'name'       => 'cardojo_currency_position',
							'std'        => 'left',
							'label'      => __( 'Currency Position', 'cardojo' ),
							'type'       => 'select',
							'options' => array(
								'left'  => __( 'Left ($99.99)', 'cardojo' ),
								'right' => __( 'Right (99.99$)', 'cardojo' ),
								'left_space'  => __( 'Left with space ($ 99.99)', 'cardojo' ),
								'right_space' => __( 'Right with space (99.99 $)', 'cardojo' ),
							)
						),
						array(
							'name'        => 'cardojo_thousand_separator',
							'std'         => ',',
							'placeholder' => '',
							'label'       => __( 'Thousand Separator', 'cardojo' ),
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_decimal_separator',
							'std'         => '.',
							'placeholder' => '',
							'label'       => __( 'Decimal Separator', 'cardojo' ),
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_price_num_decimals',
							'std'         => '0',
							'placeholder' => '',
							'label'       => __( 'Number of Decimals', 'cardojo' ),
							'attributes'  => array()
						),
						array(
							'name'       => 'cardojo_ssl_hide_forms',
							'std'        => '0',
							'label'      => __( 'SSL Verification', 'cardojo' ),
							'cb_label'   => __( 'Verify SSL Certification', 'cardojo' ),
							'desc'       => __( 'If enabled and missing https, sensitive fileds will be hidden.', 'cardojo' ),
							'type'       => 'checkbox',
							'attributes' => array()
						),
						array(
							'name'        => 'cardojo_googlemap_key',
							'std'         => '',
							'placeholder' => '',
							'label'       => __( 'Google Maps API Key', 'cardojo' ),
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_finance_disclaimer',
							'std'         => __( "The following terms of agreement apply to all of our online applications; we, us, our and ours as used below refer to the dealer and to the Financial Institutions selected to receive your application. You authorize the dealer, as part of the credit underwriting process, to submit this application and any other application submitted in connection with the proposed transaction to the Financial Institutions disclosed to you by the dealer, for review. In addition, in accordance with the Fair Credit Reporting Act, you authorize that such Financial Institutions may submit your applications for review to other Financial Institutions that may want to purchase your contract.

								<br><br>

								You agree that we and any Financial Institutions to which your application is submitted may obtain a consumer credit report periodically from one or more consumer reporting agencies (credit bureaus) in connection with the proposed transaction and any update, renewal, refinancing, modification or extension of that transaction. You agree that we may verify your employment, pay, assets and debts, and that anyone receiving a copy of this is authorized to provide us with such information. You further authorize us to gather whatever credit and employment history we consider necessary and appropriate in reviewing this application and any other applications submitted in connection with the proposed transaction. We may keep this application and any other application submitted to us, and information about you whether or not the application is approved. You certify that the information on this application and in any other application submitted to us, is true and complete. You understand that false statements may subject you to criminal penalties.

								<br><br>

								<strong>FEDERAL NOTICES</strong>

								<br><br>

								<strong>IMPORTANT INFORMATION ABOUT PROCEDURES FOR OPENING A NEW ACCOUNT</strong>

								<br><br>

								To help the government fight the funding of terrorism and money laundering activities, Federal law requires all financial institutions to obtain, verify, and record information that identifies each person who opens an account. What this means for you: When you open an account, we will ask for your name, address, date of birth, and other information that will allow us to identify you. We may also ask to see your driver's license or other identifying documents.

								<br><br>

								<strong>STATE NOTICES</strong>

								<br><br>

								<strong>Arizona, California, Idaho, Louisiana, Nevada, New Mexico, Texas, Washington or Wisconsin Residents</strong>: If you, the applicant, are married and live in a community property state, you should also provide the personal credit information on your spouse in the co-buyer section. Your spouse is not required to be a co-buyer for the credit requested unless he/she wishes to be a co-buyer.

								<br><br>

								<strong>California Residents</strong>: An applicant, if married, may apply for a separate account.

								<br><br>

								<strong>Ohio Residents</strong>: Ohio laws against discrimination require that all creditors make credit equally available to all creditworthy customers and that credit reporting agencies maintain separate credit histories on each individual upon request. The Ohio Civil Rights Commission administers compliance with this law.

								<br><br>

								<strong>New Hampshire Residents</strong>: If this is an application for balloon financing, you are entitled to receive, upon request, a written estimate of the monthly payment amount that would be required to refinance the balloon payment at the time such payment is due based on the creditor's current refinancing programs.

								<br><br>

								<strong>New Hampshire Residents</strong>: In connection with your application for credit, we may request a consumer report that contains information on your credit worthiness, credit standing, personal characteristics and general reputation. If we grant you credit, we or our servicer may order additional consumer reports in connection with any update, renewal or extension of the credit. If you ask us, we will tell you whether we obtained a consumer report and if we did, we will tell you the name and address of the consumer reporting agency that gave us the report.

								<br><br>

								<strong>Vermont Residents</strong>: By clicking on Submit, you authorize us and our employees or agents to obtain and verify information about you (including one or more credit reports, information about your employment and banking and credit relationships) that we may deem necessary or appropriate in reviewing your application. If your application is approved and credit is extended, you also authorize us, and our employees and agents, to obtain additional credit reports and other information about you in connection with reviewing the account, increasing the available credit on the account (if applicable), taking collection on the account, or for any other legitimate purpose.

								<br><br>

								<strong>Married Wisconsin Residents</strong>: Wisconsin law provides that no provision of any marital property agreement, or unilateral statement, or court order applied to marital property will adversely affect a creditor's interests unless, prior to the time that the credit is granted, the creditor is furnished with a copy of the agreement, statement or decree, or has actual  knowledge of the adverse provision. If you are making this application individually, and not jointly with your spouse, the full name and current address of your spouse must be properly disclosed in the co-buyer section of this application.
	", 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Financial Disclaimer', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
					),
				),
				'contact_settings' => array(
					__( 'Contact Form', 'cardojo' ),
					array(
						array(
							'name'        => 'cardojo_contact_form_header_text',
							'std'         => __( 'Use the contact form to get in touch, whether you want to schedule for a test-drive, make an offer for this vehicle, trade-in your vehicle for this one or you want us to call you back.', 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Intro text', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_contact_form_thankyou_text',
							'std'         => __( 'Thank you for contacting us. We will get back to you shortly.', 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Thank you text', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_contact_form_name_error',
							'std'         => __( 'Please add a name.', 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Name error text', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_contact_form_email_error',
							'std'         => __( 'Please use a valid email.', 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Email error text', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_contact_form_phone_error',
							'std'         => __( 'Please add a phone number.', 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Phone error text', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
						array(
							'name'        => 'cardojo_contact_form_default_message',
							'std'         => __( 'I am interested in getting a price quote for this vehicle. Please let me know at your earliest convenience the best price for this vehicle.', 'cardojo' ),
							'placeholder' => '',
							'label'       => __( 'Default message text', 'cardojo' ),
							'type'        => 'textarea',
							'attributes'  => array()
						),
					),
				),
				'car_pages' => array(
					__( 'Pages', 'cardojo' ),
					array(
						array(
							'name' 		=> 'cardojo_submit_car_form_page_id',
							'std' 		=> '',
							'label' 	=> __( 'Add/Edit Vehicle Page', 'cardojo' ),
							'desc'		=> __( 'Select the page where you have placed the [cardojo_submit] shortcode. This lets the plugin know where the form is located.', 'cardojo' ),
							'type'      => 'page'
						),
						array(
							'name' 		=> 'cardojo_dashboard_page_id',
							'std' 		=> '',
							'label' 	=> __( 'Dealer Dashboard Page', 'cardojo' ),
							'desc'		=> __( 'Select the page where you have placed the [cardojo_dashboard] shortcode. This lets the plugin know where the dashboard is located.', 'cardojo' ),
							'type'      => 'page'
						),
						array(
							'name' 		=> 'cardojo_inventory_page_id',
							'std' 		=> '',
							'label' 	=> __( 'Dealer Inventory Page', 'cardojo' ),
							'desc'		=> __( 'Select the page where you have placed the [cardojo_inventory] shortcode. This lets the plugin know where the my inventory is located.', 'cardojo' ),
							'type'      => 'page'
						),
						array(
							'name' 		=> 'cardojo_cars_page_id',
							'std' 		=> '',
							'label' 	=> __( 'Browse all Cars Page', 'cardojo' ),
							'desc'		=> __( 'Select the page where you have placed the [cardojo_cars] shortcode. This lets the plugin know where the car listings page is located.', 'cardojo' ),
							'type'      => 'page'
						),
						array(
							'name' 		=> 'cardojo_user_page_id',
							'std' 		=> '',
							'label' 	=> __( 'User Profile Page', 'cardojo' ),
							'desc'		=> __( 'Select the page where you have placed the [cardojo_dealer_page] shortcode. This lets the plugin know where the user profile page is located (for marketplace only).', 'cardojo' ),
							'type'      => 'page'
						),
					)
				),
			)
		);
	}

	/**
	 * register_settings function.
	 *
	 * @access public
	 * @return void
	 */
	public function register_settings() {
		$this->init_settings();

		foreach ( $this->settings as $section ) {
			foreach ( $section[1] as $option ) {
				if ( isset( $option['std'] ) )
					add_option( $option['name'], $option['std'] );
				register_setting( $this->settings_group, $option['name'] );
			}
		}
	}

	/**
	 * output function.
	 *
	 * @access public
	 * @return void
	 */
	public function output() {
		$this->init_settings();
		?>
		<div class="wrap cardojo-settings-wrap">
			<form method="post" action="options.php">

				<?php settings_fields( $this->settings_group ); ?>

			    <h2 class="nav-tab-wrapper">
			    	<?php
			    		foreach ( $this->settings as $key => $section ) {
			    			echo '<a href="#settings-' . sanitize_title( $key ) . '" class="nav-tab">' . esc_html( $section[0] ) . '</a>';
			    		}
			    	?>
			    </h2>

				<?php
					if ( ! empty( $_GET['settings-updated'] ) ) {
						flush_rewrite_rules();
						echo '<div class="updated fade car-manager-updated"><p>' . __( 'Settings successfully saved', 'cardojo' ) . '</p></div>';
					}

					foreach ( $this->settings as $key => $section ) {

						echo '<div id="settings-' . sanitize_title( $key ) . '" class="settings_panel">';

						echo '<table class="form-table">';

						foreach ( $section[1] as $option ) {

							$placeholder    = ( ! empty( $option['placeholder'] ) ) ? 'placeholder="' . $option['placeholder'] . '"' : '';
							$class          = ! empty( $option['class'] ) ? $option['class'] : '';
							$value          = get_option( $option['name'] );
							$option['type'] = ! empty( $option['type'] ) ? $option['type'] : '';
							$attributes     = array();

							if ( ! empty( $option['attributes'] ) && is_array( $option['attributes'] ) )
								foreach ( $option['attributes'] as $attribute_name => $attribute_value )
									$attributes[] = esc_attr( $attribute_name ) . '="' . esc_attr( $attribute_value ) . '"';

							echo '<tr valign="top" class="' . $class . '"><th scope="row"><label for="setting-' . $option['name'] . '">' . $option['label'] . '</a></th><td>';

							switch ( $option['type'] ) {

								case "checkbox" :

									?><label><input id="setting-<?php echo $option['name']; ?>" name="<?php echo $option['name']; ?>" type="checkbox" value="1" <?php echo implode( ' ', $attributes ); ?> <?php checked( '1', $value ); ?> /> <?php echo $option['cb_label']; ?></label><?php

									if ( !empty($option['desc']) )
										echo ' <p class="description">' . $option['desc'] . '</p>';

								break;
								case "textarea" :

									?><textarea id="setting-<?php echo $option['name']; ?>" class="large-text" cols="50" rows="3" name="<?php echo $option['name']; ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?>><?php echo esc_textarea( $value ); ?></textarea><?php

									if ( !empty($option['desc']) )
										echo ' <p class="description">' . $option['desc'] . '</p>';

								break;
								case "select" :

									?><select id="setting-<?php echo $option['name']; ?>" class="regular-text" name="<?php echo $option['name']; ?>" <?php echo implode( ' ', $attributes ); ?>><?php
										foreach( $option['options'] as $key => $name )
											echo '<option value="' . esc_attr( $key ) . '" ' . selected( $value, $key, false ) . '>' . esc_html( $name ) . '</option>';
									?></select><?php

									if ( !empty($option['desc']) ) {
										echo ' <p class="description">' . $option['desc'] . '</p>';
									}

								break;
								case "page" :

									$args = array(
										'name'             => $option['name'],
										'id'               => $option['name'],
										'sort_column'      => 'menu_order',
										'sort_order'       => 'ASC',
										'show_option_none' => __( '--no page--', 'cardojo' ),
										'echo'             => false,
										'selected'         => absint( $value )
									);

									echo str_replace(' id=', " data-placeholder='" . __( 'Select a page&hellip;', 'cardojo' ) .  "' id=", wp_dropdown_pages( $args ) );

									if ( !empty($option['desc']) ) {
										echo ' <p class="description">' . $option['desc'] . '</p>';
									}

								break;
								case "password" :

									?><input id="setting-<?php echo $option['name']; ?>" class="regular-text" type="password" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?> /><?php

									if ( !empty($option['desc']) ) {
										echo ' <p class="description">' . $option['desc'] . '</p>';
									}

								break;
								case "number" :
									?><input id="setting-<?php echo $option['name']; ?>" class="regular-text" type="number" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?> /><?php

									if ( !empty($option['desc']) ) {
										echo ' <p class="description">' . $option['desc'] . '</p>';
									}
								break;
								case "" :
								case "input" :
								case "text" :
									?><input id="setting-<?php echo $option['name']; ?>" class="regular-text" type="text" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?> /><?php

									if ( !empty($option['desc']) ) {
										echo ' <p class="description">' . $option['desc'] . '</p>';
									}
								break;
								default :
									do_action( 'CarDojo_admin_field_' . $option['type'], $option, $attributes, $value, $placeholder );
								break;

							}

							echo '</td></tr>';
						}

						echo '</table></div>';

					}
				?>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'cardojo' ); ?>" />
				</p>
		    </form>
		</div>
		<script type="text/javascript">
			jQuery('.nav-tab-wrapper a').click(function() {
				jQuery('.settings_panel').hide();
				jQuery('.nav-tab-active').removeClass('nav-tab-active');
				jQuery( jQuery(this).attr('href') ).show();
				jQuery(this).addClass('nav-tab-active');
				return false;
			});
			jQuery('.nav-tab-wrapper a:first').click();
			jQuery('#setting-cardojo_enable_registration').change(function(){
				if ( jQuery( this ).is(':checked') ) {
					jQuery('#setting-cardojo_registration_role').closest('tr').show();
					jQuery('#setting-cardojo_registration_username_from_email').closest('tr').show();
				} else {
					jQuery('#setting-cardojo_registration_role').closest('tr').hide();
					jQuery('#setting-cardojo_registration_username_from_email').closest('tr').hide();
				}
			}).change();
		</script>
		<?php
	}
}
