<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cardojo_contact_request() { ?>

	<?php

	$mail_sent = 0; 

	// Contact Car Dealer
	if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

		if( isset( $_POST['contactCarDealerForm_nonce'] ) && wp_verify_nonce( $_POST['contactCarDealerForm_nonce'], 'contactCarDealerForm_html' ) ){

			$userName    = sanitize_text_field( $_POST['userName'] );
			$userMail    = sanitize_text_field( $_POST['userMail'] );
			$userPhone   = sanitize_text_field( $_POST['userPhone'] );
			$textMessage = wp_kses( $_POST['textMessage'], true );
			$car_name    = sanitize_text_field( $_POST['car_name'] );
			$car_url     = esc_url( $_POST['car_url'] );
			$site_name = get_bloginfo('name');

			if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
				$eol="\r\n";
			} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
				$eol="\r";
			} else {
				$eol="\n";
			}

			// Message for card dealer
			$from = $userMail;
			$email = get_option('admin_email');
		  	$subject = __('Contact Form from ', 'cardojo').$site_name;
		  	$headers = "From: " . $userMail . $eol;
			$headers .= "Reply-To: " . $userMail . $eol;
			$headers .= "MIME-Version: 1.0".$eol;
			$headers .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
		  	$msg = $textMessage . "\n\nVehicle url: $car_url";
		  	wp_mail( $email, $subject, $msg, $headers );

		  	if ( defined( 'CARDOJO_USE_WPMAIL' ) ) {
				wp_mail( $email, $subject, $msg, $headers );
			} else {
				mail( $email, $subject, $msg, $headers );
			}

		  	$mail_sent = 1;

		}

	}

	?>

	<div id="cd-form-wrapp" class="cd-form-wrapp">

		<input type="hidden" id="mail_sent_status" value="<?php echo esc_attr($mail_sent); ?>" />

	    <h4 class="heading"><?php esc_html_e('Contact form', 'cardojo' ); ?></h4>

	    <?php if($mail_sent == 1) { $thankyou_text = get_option( 'cardojo_contact_form_thankyou_text' ); if(!empty($thankyou_text)) { ?>
		
		<h5 class="heading"><?php echo wp_kses($thankyou_text, true); ?></h5>

	    <?php } } ?>

	    <?php $intro_text = get_option( 'cardojo_contact_form_header_text' ); if(!empty($intro_text)) { ?>

	    <p><?php echo wp_kses($intro_text, true); ?></p>

	    <?php } ?>

	    <form id="cardojo-contact-dealer" class="contact-form" action="<?php echo get_permalink(); ?>" method="post">
	      
	      	<div class="inputs-side">

	            <div class="form-group">
	              	<label for="userName"><?php esc_html_e('Your Name', 'cardojo' ); ?> *</label>
	              	<input type="text" class="form-control" id="userName" name="userName" placeholder="John Doe">
	              	<?php $name_error_text = get_option( 'cardojo_contact_form_name_error' ); if(!empty($name_error_text)) { ?>
	              	<label id="userName-error" class="error" for="userName"><?php echo esc_attr($name_error_text); ?></label>
	              	<?php } ?>
	            </div>

	            <div class="form-group">
	              	<label for="userMail"><?php esc_html_e('Email address', 'cardojo' ); ?> *</label>
	              	<input type="email" class="form-control" id="userMail" name="userMail" placeholder="email@domain.com">
	              	<?php $email_error_text = get_option( 'cardojo_contact_form_email_error' ); if(!empty($email_error_text)) { ?>
	              	<label id="userMail-error" class="error" for="userMail"><?php echo esc_attr($email_error_text); ?></label>
	              	<?php } ?>
	            </div>

	            <div class="form-group">
	              	<label for="userPhone"><?php esc_html_e('Phone number', 'cardojo' ); ?> *</label>
	              	<input type="text" class="form-control" id="userPhone" name="userPhone" placeholder="+123 456 7890">
	              	<?php $phone_error_text = get_option( 'cardojo_contact_form_phone_error' ); if(!empty($phone_error_text)) { ?>
	              	<label id="userPhone-error" class="error" for="userPhone"><?php echo esc_attr($phone_error_text); ?></label>
	              	<?php } ?>
	            </div>

	            <div class="form-group">
	              	<label for="textMessage"><?php esc_html_e('Message', 'cardojo' ); ?></label>
	              	<textarea class="form-control" cols="30" rows="10" id="textMessage" name="textMessage" placeholder=""><?php $default_message = get_option( 'cardojo_contact_form_default_message' ); if(!empty($default_message)) { echo wp_kses($default_message, true); } ?></textarea>
	            </div>

	            <button id="cardojo-contact-dealer-submit" type="submit" class="btn btn-default">
	              	<?php esc_html_e('Send message', 'cardojo' ); ?>
	              	<i class="fa fa-angle-right"></i>
	            </button>

	            <input type="hidden" name="car_name" value="<?php get_the_title(); ?>" />
	            <input type="hidden" name="car_url" value="<?php echo get_permalink(); ?>" />
	            <input type="hidden" name="dealer_email" value="<?php if(!empty($vehicle_location_email)) { echo esc_attr($vehicle_location_email); } else { echo get_option('admin_email'); } ?>" />

	            <input type="hidden" name="action" value="contactCarDealerForm" />
				<?php wp_nonce_field( 'contactCarDealerForm_html', 'contactCarDealerForm_nonce' ); ?>

	      	</div>
	      	<div class="clearfix"></div>

	    </form>

	</div>

<?php } ?>