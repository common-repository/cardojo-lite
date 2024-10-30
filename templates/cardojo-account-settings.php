<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$user_id = get_current_user_id();

	$dealer_name = get_user_meta( $user_id, 'dealer_name', true );
	$mobile_phone = get_user_meta( $user_id, 'mobile_phone', true );
	$office_phone = get_user_meta( $user_id, 'office_phone', true );

	$dealer_address = get_user_meta( $user_id, 'dealer_address', true );
	$dealer_address_latitude = get_user_meta( $user_id, 'dealer_address_latitude', true );
	$dealer_address_longitude = get_user_meta( $user_id, 'dealer_address_longitude', true );

?>

<form action="<?php echo get_permalink(); ?>" method="post" id="cardojo-update-user-form" class="cardojo-form" enctype="multipart/form-data">

	<div class="options_group">

			<h2 class="options_group_heading"><?php esc_html_e('Account Info', 'cardojo' ); ?></h2>

			<fieldset>

				<div class="cardojo-row">

					<div class="cardojo-col-4">

						<label for="dealer_name" class="control-label"><?php esc_html_e('Name', 'cardojo' ); ?></label>
						<input type="text" id="dealer_name" name="dealer_name" value="<?php echo esc_attr($dealer_name); ?>" placeholder="" />

					</div>

					<div class="cardojo-col-4">

						<label for="mobile_phone" class="control-label"><?php esc_html_e('Mobile Phone', 'cardojo' ); ?></label>
						<input type="text" id="mobile_phone" name="mobile_phone" value="<?php echo esc_attr($mobile_phone); ?>" placeholder="" />

					</div>

					<div class="cardojo-col-4">

						<label for="office_phone" class="control-label"><?php esc_html_e('Office Phone', 'cardojo' ); ?></label>
						<input type="text" id="office_phone" name="office_phone" value="<?php echo esc_attr($office_phone); ?>" placeholder="" />

					</div>

					<div class="cardojo-col-12">

						<label for="dealer_address" class="control-label"><?php esc_html_e('Address', 'cardojo' ); ?></label>
						<input type="text" id="vehicle_location_address" name="dealer_address" value="<?php echo esc_attr($dealer_address); ?>" placeholder="">

						<input type="hidden" id="vehicle_location_latitude" name="dealer_address_latitude" value="<?php echo esc_attr($dealer_address_latitude); ?>" />
						<input type="hidden" id="vehicle_location_longitude" name="dealer_address_longitude" value="<?php echo esc_attr($dealer_address_longitude); ?>" />

					</div>

					<div class="cardojo-col-12">

						<div id="map-canvas"></div>

					</div>

					<div class="col-sm-6">

	                  	<label><?php esc_html_e( 'Password', 'cardojo' ) ?> <sup>*</sup></label>
	                  	<input type="password" name="password" id="password" class="form-control" >
	                  	<label id="password-error" class="error" for="password"><?php esc_html_e( 'Password required.', 'cardojo' ) ?></label>

	                </div>

	                <div class="col-sm-6">

	                  	<label><?php esc_html_e( 'Repet password', 'cardojo' ) ?> <sup>*</sup></label>
	                  	<input type="password" name="repeat_password" id="repeat_password" class="form-control" >
	                  	<label id="repeat_password-error" class="error" for="repeat_password"><?php esc_html_e( "Password doesn't match.", 'cardojo' ) ?></label>
	                  	
	                </div>

				</div>

			</fieldset>

			<fieldset class="cardojo-last-fieldset">

					<div class="cardojo-row">

						<div class="cardojo-col-12">

							<input type="hidden" name="user_id" value="<?php echo esc_attr($user_id); ?>" />
												
							<input type="hidden" name="action" value="updateAccountFunction" />
							<?php wp_nonce_field( 'updateAccountFunction_html', 'updateAccountFunction_nonce' ); ?>

							<a id="cardojo_update_account" href="#" class="btn btn-default"><?php esc_html_e( 'Update Account', 'cardojo' ) ?></a>

						</div>

					</div>

				</fieldset>

		</div>	<!-- end review_options_pop -->

</form>