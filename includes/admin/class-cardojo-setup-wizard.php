<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Template Core Functions
 *
 * Template Core Functions specifically created for car listings
 *
 * @author 		Alex Gurghis
 * @category 	Core
 * @package 	CarDojo/Core Functions
 * @version     1.0.2
 */

/**
 * Get and include template files.
 *
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */

/**
 * CarDojo_Admin_Setup_Wizard class.
 */
class CarDojo_Admin_Setup_Wizard {

	/** @var string Currenct Step */
	private $step   = '';

	/** @var array Steps for the setup wizard */
	private $steps  = array();

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_init', array( $this, 'setup_wizard' ) );
	}

	/**
	 * Add admin menus/screens.
	 */
	public function admin_menus() {
		add_dashboard_page( '', '', 'manage_options', 'cardojo-setup', '' );
	}

	/**
	 * Show the setup wizard.
	 */
	public function setup_wizard() {
		if ( empty( $_GET['page'] ) || 'cardojo-setup' !== $_GET['page'] ) {
			return;
		}
		$default_steps = array(
			'introduction' => array(
				'name'    => __( 'Introduction', 'cardojo' ),
				'view'    => array( $this, 'cardojo_setup_introduction' ),
				'handler' => '',
			),
			'type' => array(
				'name'    => __( 'Website Type', 'cardojo' ),
				'view'    => array( $this, 'cardojo_select_type' ),
				'handler' => array( $this, 'cardojo_select_type_save' ),
			),
			'pages' => array(
				'name'    => __( 'Page Setup', 'cardojo' ),
				'view'    => array( $this, 'cardojo_setup_pages' ),
				'handler' => array( $this, 'cardojo_setup_pages_save' ),
			),
			'locale' => array(
				'name'    => __( 'Website Locale', 'cardojo' ),
				'view'    => array( $this, 'cardojo_setup_locale' ),
				'handler' => array( $this, 'cardojo_setup_locale_save' ),
			),
			'next_steps' => array(
				'name'    => __( 'All Done!', 'cardojo' ),
				'view'    => array( $this, 'cardojo_setup_ready' ),
				'handler' => '',
			),
		);

		$this->steps = apply_filters( 'cardojo_setup_wizard_steps', $default_steps );
		$this->step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : current( array_keys( $this->steps ) );

		wp_register_script( 'jquery-blockui', CARDOJO_PLUGIN_URL . '/assets/js/jquery.blockUI.min.js', array( 'jquery' ), '2.70', true );
		wp_register_script( 'select2', CARDOJO_PLUGIN_URL . '/assets/js/select2.min.js', array( 'jquery' ), '4.0.3' );
		wp_register_script( 'wc-enhanced-select', CARDOJO_PLUGIN_URL . '/assets/js/enhanced-select.min.js', array( 'jquery', 'select2' ) );
		wp_localize_script( 'wc-enhanced-select', 'cardojo_enhanced_select_params', array(
			'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'cardojo' ),
			'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'cardojo' ),
			'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'cardojo' ),
			'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'cardojo' ),
			'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'cardojo' ),
			'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'cardojo' ),
			'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'cardojo' ),
			'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'cardojo' ),
			'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'cardojo' ),
			'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'cardojo' ),
			'ajax_url'                  => admin_url( 'admin-ajax.php' ),
			'search_products_nonce'     => wp_create_nonce( 'search-products' ),
			'search_customers_nonce'    => wp_create_nonce( 'search-customers' ),
		) );
		wp_enqueue_style( 'cardojo_admin_styles', CARDOJO_PLUGIN_URL . '/assets/css/setup-wizard.css', array() );
		wp_enqueue_style( 'cardojo-setup', CARDOJO_PLUGIN_URL . '/assets/css/cardojo-setup.css', array( 'dashicons', 'install' ) );
		wp_enqueue_style( 'fontawesome',         CARDOJO_PLUGIN_URL . '/assets/css/font-awesome.min.css', array(), '4.5.0', 'all' );

		wp_register_script( 'cardojo-setup', CARDOJO_PLUGIN_URL . '/assets/js/cardojo-setup.min.js', array( 'jquery', 'wc-enhanced-select', 'jquery-blockui' ) );
		wp_localize_script( 'cardojo-setup', 'cardojo_setup_params', array(
			'locale_info' => json_encode( include( CARDOJO_PLUGIN_DIR . '/i18n/locale-info.php' ) ),
		) );

		if ( ! empty( $_POST['save_step'] ) && isset( $this->steps[ $this->step ]['handler'] ) ) {
			call_user_func( $this->steps[ $this->step ]['handler'], $this );
		}

		ob_start();
		$this->setup_wizard_header();
		$this->setup_wizard_steps();
		$this->setup_wizard_content();
		$this->setup_wizard_footer();
		exit;
	}

	/**
	 * Get the URL for the next step's screen.
	 * @param string step   slug (default: current step)
	 * @return string       URL for next step if a next step exists.
	 *                      Admin URL if it's the last step.
	 *                      Empty string on failure.
	 * @since 3.0.0
	 */
	public function get_next_step_link( $step = '' ) {
		if ( ! $step ) {
			$step = $this->step;
		}

		$keys = array_keys( $this->steps );
		if ( end( $keys ) === $step ) {
			return admin_url();
		}

		$step_index = array_search( $step, $keys );
		if ( false === $step_index ) {
			return '';
		}

		return add_query_arg( 'step', $keys[ $step_index + 1 ] );
	}

	/**
	 * Setup Wizard Header.
	 */
	public function setup_wizard_header() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title><?php esc_html_e( 'CarDojo &rsaquo; Setup Wizard', 'cardojo' ); ?></title>
			<?php wp_print_scripts( 'cardojo-setup' ); ?>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="cardojo-setup wp-core-ui">
			<h1 id="cardojo-setup-wizard-logo">
				<a href="http://wpcardojoplugin.com/">
					<img src="<?php echo CARDOJO_PLUGIN_URL; ?>/assets/images/logo-setup-wizard-2.png" alt="cardojo" />
				</a>
				<span><?php esc_html_e( 'Quick Setup Wizard', 'cardojo' ); ?></span>
			</h1>
		<?php
	}

	/**
	 * Setup Wizard Footer.
	 */
	public function setup_wizard_footer() {
		// Nothing here
	}

	/**
	 * Output the steps.
	 */
	public function setup_wizard_steps() {
		$ouput_steps = $this->steps;
		array_shift( $ouput_steps );
		?>
		<ol class="cardojo-setup-steps">
			<?php foreach ( $ouput_steps as $step_key => $step ) : ?>
				<li class="<?php
					if ( $step_key === $this->step ) {
						echo 'active';
					} elseif ( array_search( $this->step, array_keys( $this->steps ) ) > array_search( $step_key, array_keys( $this->steps ) ) ) {
						echo 'done';
					}
				?>"><?php echo esc_html( $step['name'] ); ?></li>
			<?php endforeach; ?>
		</ol>
		<?php
	}

	/**
	 * Output the content for the current step.
	 */
	public function setup_wizard_content() {
		echo '<div class="cardojo-setup-content">';
		call_user_func( $this->steps[ $this->step ]['view'], $this );
		echo '</div>';
	}

	/**
	 * Introduction step.
	 */
	public function cardojo_setup_introduction() {
		?>
		<h1><?php esc_html_e( 'Overview!', 'cardojo' ); ?></h1>
		<p><?php _e( 'This quick setup wizard will help you <strong>configure the basic settings</strong> of the CarDojo WordPress Plugin. It shouldn’t take more than 5 minutes and it’s optional, though recomendable.', 'cardojo' ); ?></p>
		<p><?php esc_html_e( 'If you’re in a hurry now, don’t worry, just skip it and return to the WordPress Admin Dashboard. You can get back to this when you have the time.', 'cardojo' ); ?></p>
		<p><?php esc_html_e( 'Thank you for choosing CarDojo WordPress Plugin to power your vehicles shop or automotive marketplace.', 'cardojo' ); ?></p>
		<p class="cardojo-setup-actions step">
			<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button-primary button button-large button-next button-padding-right"><?php esc_html_e( 'Let’s do this!', 'cardojo' ); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="<?php echo esc_url( admin_url() ); ?>" class="button button-clean align-left"><?php esc_html_e( 'Not now, I’ll do this later', 'cardojo' ); ?></a>
		</p>
		<?php
	}

	/**
	 * Select website type step.
	 */
	public function cardojo_select_type() {
		?>
		<h1><?php esc_html_e( 'Website Type', 'cardojo' ); ?></h1>
		<form method="post">
			<p><?php esc_html_e( 'Here you will select the type of your website, a vehicles shop (car dealer) or automotive marketplace.', 'cardojo' ); ?></p>

			<div class="middle">

			  	<label>
				  	<input type="radio" value="dealer" name="website_type" checked/>
				  	<div class="front-end box">
				    	<span><?php esc_html_e( 'Vehicles Shop', 'cardojo' ); ?></span>
				  	</div>
				</label>

				<label>
			 	 	<input type="radio" value="marketplace" name="website_type"/>
				  	<div class="back-end box">
				    	<span><?php esc_html_e( 'Marketplace', 'cardojo' ); ?></span>
				  	</div>
				</label>

			</div>


			<p class="cardojo-setup-actions step">
				<input type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Continue', 'cardojo' ); ?>" name="save_step" />
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php esc_html_e( 'Skip this step', 'cardojo' ); ?></a>
				<?php wp_nonce_field( 'cardojo-setup' ); ?>
			</p>
		</form>
		<?php
	}

	/**
	 * Save website type.
	 */
	public function cardojo_select_type_save() {
		check_admin_referer( 'cardojo-setup' );

		$website_type = sanitize_text_field( $_POST['website_type'] );
		update_option( 'cardojo_webiste_type', $website_type );

		wp_redirect( esc_url_raw( $this->get_next_step_link() ) );
		exit;
	}

	/**
	 * Page setup.
	 */
	public function cardojo_setup_pages() {
		?>
		<h1><?php esc_html_e( 'Page setup', 'cardojo' ); ?></h1>
		<form method="post">
			<p><?php printf( __( 'Your store needs a few essential <a href="%s" target="_blank">pages</a>. The following will be created automatically (if they do not already exist):', 'cardojo' ), esc_url( admin_url( 'edit.php?post_type=page' ) ) ); ?></p>
			<table class="cardojo-setup-pages" cellspacing="0">
				<thead>
					<tr>
						<th class="page-name"><?php esc_html_e( 'Page name', 'cardojo' ); ?></th>
						<th class="page-description"><?php esc_html_e( 'Description', 'cardojo' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="page-name"><?php echo _x( 'Add/Edit Vehicle', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end submit/edit vehicle page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Dealer Dashboard Page', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end dealer dashboard page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Dealer Inventory Page', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end dealer inventory page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Browse All Cars Page', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end all cars page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Reports', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end reports page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Notifications', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end notifications page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'My Favorites', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end my favorites page.', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Login/Register', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end login/register page.', 'cardojo' ); ?></td>
					</tr>

					<?php
						$website_type = get_option('cardojo_webiste_type');
						if($website_type == "dealer") {
					?>
					<tr>
						<td class="page-name"><?php echo _x( 'Filter Subscriptions', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end filter subscriptions page.', 'cardojo' ); ?></td>
					</tr>
					<?php } ?>

					<?php
						$website_type = get_option('cardojo_webiste_type');
						if($website_type == "marketplace") {
					?>
					<tr>
						<td class="page-name"><?php echo _x( 'User Profile Page', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end user profile page (for marketplace only).', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Account Funds', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end account funds page (for marketplace only).', 'cardojo' ); ?></td>
					</tr>
					<tr>
						<td class="page-name"><?php echo _x( 'Settings', 'Page title', 'cardojo' ); ?></td>
						<td><?php esc_html_e( 'This is front-end settings page.', 'cardojo' ); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<p><?php printf( __( 'Once created, these pages can be managed from your admin dashboard on the <a href="%1$s" target="_blank">Pages screen</a>. You can control which pages are shown on your website via <a href="%2$s" target="_blank">Appearance > Menus</a>.', 'cardojo' ), esc_url( admin_url( 'edit.php?post_type=page' ) ), esc_url( admin_url( 'nav-menus.php' ) ) ); ?></p>

			<p class="cardojo-setup-actions step">
				<input type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Continue', 'cardojo' ); ?>" name="save_step" />
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php esc_html_e( 'Skip this step', 'cardojo' ); ?></a>
				<?php wp_nonce_field( 'cardojo-setup' ); ?>
			</p>
		</form>
		<?php
	}

	/**
	 * Save Page Settings.
	 */
	public function cardojo_setup_pages_save() {
		check_admin_referer( 'cardojo-setup' );

		CarDojo_Install::create_pages();
		wp_redirect( esc_url_raw( $this->get_next_step_link() ) );
		exit;
	}

	/**
	 * Locale settings.
	 */
	public function cardojo_setup_locale() {
		$user_location  = CarDojo_Geolocation::geolocate_ip();
		$country        = ! empty( $user_location['country'] ) ? $user_location['country'] : 'US';
		$state          = ! empty( $user_location['state'] ) ? $user_location['state'] : '*';
		$state          = 'US' === $country && '*' === $state ? 'AL' : $state;

		// Defaults
		$currency           = get_option( 'cardojo_currency', 'USD' );
		$currency_pos       = get_option( 'cardojo_currency_position', 'left' );
		$measurement_type   = get_option( 'cardojo_measurement_type', 'metric' );
		$decimal_sep        = get_option( 'cardojo_decimal_separator', '.' );
		$num_decimals       = get_option( 'cardojo_price_num_decimals', '2' );
		$thousand_sep       = get_option( 'cardojo_thousand_separator', ',' );
		?>
		<h1><?php esc_html_e( 'Store locale setup', 'cardojo' ); ?></h1>
		<form method="post">
			<table class="form-table">
				<tr>
					<th scope="row"><label for="currency_pos"><?php esc_html_e( 'Systems of Measurement', 'cardojo' ); ?></label></th>
					<td>
						<select id="measurement_type" name="measurement_type" class="wc-enhanced-select">
							<option value="metric" <?php selected( $measurement_type, 'metric' ); ?>><?php esc_html_e( 'Metric', 'cardojo' ); ?></option>
							<option value="usa" <?php selected( $measurement_type, 'usa' ); ?>><?php esc_html_e( 'U.S.', 'cardojo' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="currency_code"><?php esc_html_e( 'Currency', 'cardojo' ); ?></label></th>
					<td>
						<select id="currency_code" name="currency_code" style="width:100%;" data-placeholder="<?php esc_attr_e( 'Choose a currency&hellip;', 'cardojo' ); ?>" class="wc-enhanced-select">
							<option value=""><?php esc_html_e( 'Choose a currency&hellip;', 'cardojo' ); ?></option>
							<?php
							foreach ( get_cardojo_currencies() as $code => $name ) {
								echo '<option value="' . esc_attr( $code ) . '" ' . selected( $currency, $code, false ) . '>' . sprintf( esc_html__( '%1$s (%2$s)', 'cardojo' ), $name, get_cardojo_currency_symbol( $code ) ) . '</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="currency_pos"><?php esc_html_e( 'Currency position', 'cardojo' ); ?></label></th>
					<td>
						<select id="currency_pos" name="currency_pos" class="wc-enhanced-select">
							<option value="left" <?php selected( $currency_pos, 'left' ); ?>><?php esc_html_e( 'Left', 'cardojo' ); ?></option>
							<option value="right" <?php selected( $currency_pos, 'right' ); ?>><?php esc_html_e( 'Right', 'cardojo' ); ?></option>
							<option value="left_space" <?php selected( $currency_pos, 'left_space' ); ?>><?php esc_html_e( 'Left with space', 'cardojo' ); ?></option>
							<option value="right_space" <?php selected( $currency_pos, 'right_space' ); ?>><?php esc_html_e( 'Right with space', 'cardojo' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="thousand_sep"><?php esc_html_e( 'Thousand separator', 'cardojo' ); ?></label></th>
					<td>
						<input type="text" id="thousand_sep" name="thousand_sep" size="2" value="<?php echo esc_attr( $thousand_sep ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="decimal_sep"><?php esc_html_e( 'Decimal separator', 'cardojo' ); ?></label></th>
					<td>
						<input type="text" id="decimal_sep" name="decimal_sep" size="2" value="<?php echo esc_attr( $decimal_sep ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="num_decimals"><?php esc_html_e( 'Number of decimals', 'cardojo' ); ?></label></th>
					<td>
						<input type="text" id="num_decimals" name="num_decimals" size="2" value="<?php echo esc_attr( $num_decimals ); ?>" />
					</td>
				</tr>
			</table>
			<p class="cardojo-setup-actions step">
				<input type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Continue', 'cardojo' ); ?>" name="save_step" />
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php esc_html_e( 'Skip this step', 'cardojo' ); ?></a>
				<?php wp_nonce_field( 'cardojo-setup' ); ?>
			</p>
		</form>
		<?php
	}

	/**
	 * Save Locale Settings.
	 */
	public function cardojo_setup_locale_save() {
		check_admin_referer( 'cardojo-setup' );

		$currency_code     = sanitize_text_field( $_POST['currency_code'] );
		$currency_pos      = sanitize_text_field( $_POST['currency_pos'] );
		$measurement_type  = sanitize_text_field( $_POST['measurement_type'] );
		$decimal_sep       = sanitize_text_field( $_POST['decimal_sep'] );
		$num_decimals      = sanitize_text_field( $_POST['num_decimals'] );
		$thousand_sep      = sanitize_text_field( $_POST['thousand_sep'] );

		update_option( 'cardojo_currency', $currency_code );
		update_option( 'cardojo_currency_position', $currency_pos );
		update_option( 'cardojo_measurement_type', $measurement_type );
		update_option( 'cardojo_decimal_separator', $decimal_sep );
		update_option( 'cardojo_price_num_decimals', $num_decimals );
		update_option( 'cardojo_thousand_separator', $thousand_sep );

		wp_redirect( esc_url_raw( $this->get_next_step_link() ) );
		exit;
	}

	/**
	 * Final step.
	 */
	public function cardojo_setup_ready() {
		
		?>

		<h1><?php esc_html_e( 'Well Done!', 'cardojo' ); ?></h1>

		<p><?php esc_html_e( 'Thank you for choosing CarDojo WordPress Plugin to power your vehicles shop or automotive marketplace.', 'cardojo' ); ?></p>
		<p class="cardojo-setup-actions step">
			<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=vehicle' ) ); ?>" class="button-primary button button-large button-next button-padding-right"><?php esc_html_e( 'Submit your first vehicle!', 'cardojo' ); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="<?php echo esc_url( admin_url() ); ?>" class="button button-large button-next"><?php esc_html_e( 'Return to the WordPress Dashboard', 'cardojo' ); ?></a>
		</p>
		<?php
	}
}

new CarDojo_Admin_Setup_Wizard();
