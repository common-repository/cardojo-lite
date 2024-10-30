<?php
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div id="cardojo-dashboard">

	<div class="row">

		<div class="col-md-6">

			<div class="options_group">

				<h3><?php esc_html_e( 'Login', 'cardojo' ) ?></h3>

				<?php if(!empty($errors)) {  //  to print errors, ?>
											
					<div class="row">

			        	<div class="col-md-12">

			        		<div class="credentials-errors-block">

							<?php

								foreach($errors as $err )
								echo $err; 

							?>

							</div>

						</div>

					</div>

				<?php } ?>

				<?php if(!empty($success)) {  //  to print errors, ?>
					
					<div class="row">

			        	<div class="col-lg-12">

			        		<div class="credentials-success-block">

							<?php

								foreach($success as $err )
								echo $err; 

							?>

							</div>

						</div>

					</div>

				<?php } ?>
			  	
			  	<form id="autentification-form" class="autentification-form row" name="loginform" action="<?php if(!empty($redirect)) { echo esc_url($redirect); } else { echo get_permalink(); } ?>" method="post">

			        <div class="form-group col-sm-6 col-lg-6">
			     	 	<label><?php esc_html_e( 'Email', 'cardojo' ) ?></label>
			          	<input type="email" name="email" class="form-control" placeholder="<?php esc_html_e( 'Adresa de email', 'cardojo' ) ?>">
			        </div>

			        <div class="form-group col-sm-6 col-lg-6">
			          	<label><?php esc_html_e( 'Password', 'cardojo' ) ?></label>
			          	<input type="password" name="password" class="form-control">
			        </div>

			        <input type="hidden" name="action" value="ajaxLoginFunction" />
					<?php wp_nonce_field( 'ajaxLoginFunction_html', 'ajaxLoginFunction_nonce' ); ?>

					<div class="col-lg-6">
			          	<a href="#" id="autentificare" class="btn btn-default"><?php esc_html_e( 'Login', 'cardojo' ) ?></a>
			        </div>
			        <div class="col-lg-6 text-right">
			          	<a id="show_reset_password" href="#" class="btn btn-link"><i class="fa fa-question-circle-o"></i><?php esc_html_e( 'Forgot password', 'cardojo' ) ?></a>
			        </div>

			  	</form>

			  	<form id="reset-password-form" class="reset-password-form row" name="loginform" action="<?php echo get_permalink(); ?>" method="post">

			        <div class="form-group col-sm-12 col-lg-12">
			     	 	<label><?php esc_html_e( 'Email', 'cardojo' ) ?></label>
			          	<input type="email" name="email" class="form-control" placeholder="<?php esc_html_e( 'Adresa de email', 'cardojo' ) ?>">
			        </div>

			        <input type="hidden" name="action" value="ajaxResetPasswordFunction" />
					<?php wp_nonce_field( 'ajaxResetPasswordFunction_html', 'ajaxResetPasswordFunction_nonce' ); ?>

					<div class="col-lg-6">
			          	<a href="#" id="reset_password" class="btn btn-default"><?php esc_html_e( 'Reset Password', 'cardojo' ) ?></a>
			        </div>
			        <div class="col-lg-6 text-right">
			          	<a id="hide_reset_password" href="#" class="btn btn-link"><i class="fa fa-question-circle-o"></i><?php esc_html_e( 'Back to login', 'cardojo' ) ?></a>
			        </div>

			  	</form>

			</div>

		</div>

		<div class="col-md-6">

			<div class="options_group">

				<h3><?php esc_html_e( 'Register', 'cardojo' ) ?></h3>

				<?php if ( ! get_option( 'users_can_register' ) ) { ?>

				<p><?php esc_html_e( 'Registering new users is currently not allowed.', 'cardojo' ) ?></p>

				<?php } else { ?>

				<form id="register-employer-form" class="row submit-form" name="loginform" action="<?php if(!empty($redirect)) { echo esc_url($redirect); } else { echo get_permalink(); } ?>" method="post">

					<div class="form-group col-sm-12">
	                  	<label><?php esc_html_e( 'Username', 'cardojo' ) ?> <sup>*</sup></label>
	                  	<input type="username" class="form-control" name="username" id="username" placeholder="" >
	                  	<label id="username-error" class="error" for="username"><?php esc_html_e( 'Username required', 'cardojo' ) ?></label>
	                </div>

	                <div class="form-group col-sm-12">
	                  	<label><?php esc_html_e( 'Email', 'cardojo' ) ?> <sup>*</sup></label>
	                  	<input type="email" class="form-control" name="email" id="email" placeholder="" >
	                  	<label id="email-error" class="error" for="email"><?php esc_html_e( 'Email required', 'cardojo' ) ?></label>
	                </div>

	                <div class="form-group col-sm-6">
	                  	<label><?php esc_html_e( 'Password', 'cardojo' ) ?> <sup>*</sup></label>
	                  	<input type="password" name="password" id="password" class="form-control" >
	                  	<label id="password-error" class="error" for="password"><?php esc_html_e( 'Password required.', 'cardojo' ) ?></label>
	                </div>

	                <div class="form-group col-sm-6">
	                  	<label><?php esc_html_e( 'Repet password', 'cardojo' ) ?> <sup>*</sup></label>
	                  	<input type="password" name="repeat_password" id="repeat_password" class="form-control" >
	                  	<label id="repeat_password-error" class="error" for="repeat_password"><?php esc_html_e( "Password doesn't match.", 'cardojo' ) ?></label>
	                </div>
					
					<div class="col-sm-12 col-lg-12">
	                	<button id="register_company_form" type="submit" class="btn btn-default pull-left"><?php esc_html_e( 'Register', 'cardojo' ) ?></button>
	            	</div>

	                <input type="hidden" name="action" value="ajaxRegisterDealerFunction" />
					<?php wp_nonce_field( 'ajaxRegisterDealerFunction_html', 'ajaxRegisterDealerFunction_nonce' ); ?>

	          	</form>

	          	<?php } ?>

	        </div>

		</div>

	</div>

</div>