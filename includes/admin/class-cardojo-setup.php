<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WP_CarDojo_Setup class.
 */
class WP_CarDojo_Setup {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'redirect' ) );
		if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'cardojo-setup' )
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 12 );
	}

	/**
	 * admin_menu function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_menu() {
		add_dashboard_page( __( 'Setup', 'cardojo' ), __( 'Setup', 'cardojo' ), 'manage_options', 'cardojo-setup', array( $this, 'output' ) );
	}

	/**
	 * Add styles just for this page, and remove dashboard page links.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_head() {
		remove_submenu_page( 'index.php', 'cardojo-setup' );
	}

	/**
	 * Sends user to the setup page on first activation
	 */
	public function redirect() {
		// Bail if no activation redirect transient is set
	    if ( ! get_transient( '_cardojo_activation_redirect' ) ) {
			return;
	    }

	    if ( ! current_user_can( 'manage_options' ) ) {
	    	return;
	    }

		// Delete the redirect transient
		delete_transient( '_cardojo_activation_redirect' );

		// Bail if activating from network, or bulk, or within an iFrame
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) || defined( 'IFRAME_REQUEST' ) ) {
			return;
		}

		if ( ( isset( $_GET['action'] ) && 'upgrade-plugin' == $_GET['action'] ) && ( isset( $_GET['plugin'] ) && strstr( $_GET['plugin'], 'cardojo.php' ) ) ) {
			return;
		}

		wp_redirect( admin_url( 'index.php?page=cardojo-setup' ) );
		exit;
	}

	/**
	 * Enqueue scripts for setup page
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'cardojo_setup_css', CARDOJO_PLUGIN_URL . '/assets/css/setup.css', array( 'dashicons' ) );
	}

	/**
	 * Create a page.
	 * @param  string $title
	 * @param  string $content
	 * @param  string $option
	 */
	public function create_page( $title, $content, $option ) {
		$page_data = array(
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'post_author'    => 1,
			'post_name'      => sanitize_title( $title ),
			'post_title'     => $title,
			'post_content'   => $content,
			'post_parent'    => 0,
			'comment_status' => 'closed'
		);
		$page_id = wp_insert_post( $page_data );

		if ( $option ) {
			update_option( $option, $page_id );
		}
	}

	/**
	 * Output addons page
	 */
	public function output() {
		$step = ! empty( $_GET['step'] ) ? absint( $_GET['step'] ) : 1;

		if ( 3 === $step && ! empty( $_POST ) ) {
			if ( false == wp_verify_nonce( $_REQUEST[ 'setup_wizard' ], 'step_3' ) )
				wp_die( 'Error in nonce. Try again.', 'cardojo' );
			$create_pages    = isset( $_POST['cardojo-create-page'] ) ? $_POST['cardojo-create-page'] : array();
			$page_titles     = sanitize_text_field($_POST['cardojo-page-title']);
			$pages_to_create = array(
				'submit_car_form' => '[submit_car_form]',
				'car_dashboard'   => '[car_dashboard]',
				'cars'            => '[cars]'
			);

			foreach ( $pages_to_create as $page => $content ) {
				if ( ! isset( $create_pages[ $page ] ) || empty( $page_titles[ $page ] ) ) {
					continue;
				}
				$this->create_page( sanitize_text_field( $page_titles[ $page ] ), $content, 'cardojo_' . $page . '_page_id' );
			}
		}
		?>
		<div class="wrap wp_cardojo wp_cardojo_addons_wrap">
			<h2><?php _e( 'CarDojo Setup', 'cardojo' ); ?></h2>

			<ul class="cardojo-setup-steps">
				<li class="<?php if ( $step === 1 ) echo 'cardojo-setup-active-step'; ?>"><?php _e( '1. Introduction', 'cardojo' ); ?></li>
				<li class="<?php if ( $step === 2 ) echo 'cardojo-setup-active-step'; ?>"><?php _e( '2. Page Setup', 'cardojo' ); ?></li>
				<li class="<?php if ( $step === 3 ) echo 'cardojo-setup-active-step'; ?>"><?php _e( '3. Done', 'cardojo' ); ?></li>
			</ul>

			<?php if ( 1 === $step ) : ?>

				<h3><?php _e( 'Setup Wizard Introduction', 'cardojo' ); ?></h3>

				<p><?php _e( 'Thanks for installing <em>CarDojo</em>!', 'cardojo' ); ?></p>
				<p><?php _e( 'This setup wizard will help you get started by creating the pages for car submission, car management, and listing your cars.', 'cardojo' ); ?></p>
				<p><?php printf( __( 'If you want to skip the wizard and setup the pages and shortcodes yourself manually, the process is still relatively simple. Refer to the %sdocumentation%s for help.', 'cardojo' ), '<a href="#">', '</a>' ); ?></p>

				<p class="submit">
					<a href="<?php echo esc_url( add_query_arg( 'step', 2 ) ); ?>" class="button button-primary"><?php _e( 'Continue to page setup', 'cardojo' ); ?></a>
					<a href="<?php echo esc_url( add_query_arg( 'skip-cardojo-setup', 1, admin_url( 'index.php?page=cardojo-setup&step=3' ) ) ); ?>" class="button"><?php _e( 'Skip setup. I will setup the plugin manually', 'cardojo' ); ?></a>
				</p>

			<?php endif; ?>
			<?php if ( 2 === $step ) : ?>

				<h3><?php _e( 'Page Setup', 'cardojo' ); ?></h3>

				<p><?php printf( __( '<em>CarDojo</em> includes %1$sshortcodes%2$s which can be used within your %3$spages%2$s to output content. These can be created for you below. For more information on the car shortcodes view the %4$sshortcode documentation%2$s.', 'cardojo' ), '<a href="http://codex.wordpress.org/Shortcode" title="What is a shortcode?" target="_blank" class="help-page-link">', '</a>', '<a href="http://codex.wordpress.org/Pages" target="_blank" class="help-page-link">', '<a href="#" target="_blank" class="help-page-link">' ); ?></p>

				<form action="<?php echo esc_url( add_query_arg( 'step', 3 ) ); ?>" method="post">
				<?php wp_nonce_field( 'step_3', 'setup_wizard' ); ?>
					<table class="cardojo-shortcodes widefat">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th><?php _e( 'Page Title', 'cardojo' ); ?></th>
								<th><?php _e( 'Page Description', 'cardojo' ); ?></th>
								<th><?php _e( 'Content Shortcode', 'cardojo' ); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="checkbox" checked="checked" name="cardojo-create-page[submit_car_form]" /></td>
								<td><input type="text" value="<?php echo esc_attr( _x( 'Post a car', 'Default page title (wizard)', 'cardojo' ) ); ?>" name="cardojo-page-title[submit_car_form]" /></td>
								<td>
									<p><?php _e( 'This page allows employers to post cars to your website from the front-end.', 'cardojo' ); ?></p>

									<p><?php _e( 'If you do not want to accept submissions from users in this way (for example you just want to post cars from the admin dashboard) you can skip creating this page.', 'cardojo' ); ?></p>
								</td>
								<td><code>[submit_car_form]</code></td>
							</tr>
							<tr>
								<td><input type="checkbox" checked="checked" name="cardojo-create-page[car_dashboard]" /></td>
								<td><input type="text" value="<?php echo esc_attr( _x( 'car Dashboard', 'Default page title (wizard)', 'cardojo' ) ); ?>" name="cardojo-page-title[car_dashboard]" /></td>
								<td>
									<p><?php _e( 'This page allows employers to manage and edit their own cars from the front-end.', 'cardojo' ); ?></p>

									<p><?php _e( 'If you plan on managing all listings from the admin dashboard you can skip creating this page.', 'cardojo' ); ?></p>
								</td>
								<td><code>[car_dashboard]</code></td>
							</tr>
							<tr>
								<td><input type="checkbox" checked="checked" name="cardojo-create-page[cars]" /></td>
								<td><input type="text" value="<?php echo esc_attr( _x( 'cars', 'Default page title (wizard)', 'cardojo' ) ); ?>" name="cardojo-page-title[cars]" /></td>
								<td><?php _e( 'This page allows users to browse, search, and filter car listings on the front-end of your site.', 'cardojo' ); ?></td>
								<td><code>[cars]</code></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4">
									<input type="submit" class="button button-primary" value="Create selected pages" />
									<a href="<?php echo esc_url( add_query_arg( 'step', 3 ) ); ?>" class="button"><?php _e( 'Skip this step', 'cardojo' ); ?></a>
								</th>
							</tr>
						</tfoot>
					</table>
				</form>

			<?php endif; ?>
			<?php if ( 3 === $step ) : ?>

				<h3><?php _e( 'All Done!', 'cardojo' ); ?></h3>

				<p><?php _e( 'Looks like you\'re all set to start using the plugin. In case you\'re wondering where to go next:', 'cardojo' ); ?></p>

				<ul class="cardojo-next-steps">
					<li><a href="<?php echo admin_url( 'edit.php?post_type=car_listing&page=cardojo-settings' ); ?>"><?php _e( 'Tweak the plugin settings', 'cardojo' ); ?></a></li>
					<li><a href="<?php echo admin_url( 'post-new.php?post_type=car_listing' ); ?>"><?php _e( 'Add a car via the back-end', 'cardojo' ); ?></a></li>

					<?php if ( $permalink = cardojo_get_permalink( 'submit_car_form' ) ) : ?>
						<li><a href="<?php echo esc_url( $permalink ); ?>"><?php _e( 'Add a car via the front-end', 'cardojo' ); ?></a></li>
					<?php else : ?>
						<li><a href="#"><?php _e( 'Find out more about the front-end car submission form', 'cardojo' ); ?></a></li>
					<?php endif; ?>

					<?php if ( $permalink = cardojo_get_permalink( 'cars' ) ) : ?>
						<li><a href="<?php echo esc_url( $permalink ); ?>"><?php _e( 'View submitted car listings', 'cardojo' ); ?></a></li>
					<?php else : ?>
						<li><a href="#"><?php _e( 'Add the [cars] shortcode to a page to list cars', 'cardojo' ); ?></a></li>
					<?php endif; ?>

					<?php if ( $permalink = cardojo_get_permalink( 'car_dashboard' ) ) : ?>
						<li><a href="<?php echo esc_url( $permalink ); ?>"><?php _e( 'View the car dashboard', 'cardojo' ); ?></a></li>
					<?php else : ?>
						<li><a href="#"><?php _e( 'Find out more about the front-end car dashboard', 'cardojo' ); ?></a></li>
					<?php endif; ?>
				</ul>

				<p><?php printf( __( 'And don\'t forget, if you need any more help using <em>CarDojo</em> you can consult the %1$sdocumentation%2$s or %3$spost on the forums%2$s!', 'cardojo' ), '<a href="#">', '</a>', '<a href="https://wordpress.org/support/plugin/cardojo">' ); ?></p>

				<div class="cardojo-support-the-plugin">
					<h3><?php _e( 'Support the Ongoing Development of this Plugin', 'cardojo' ); ?></h3>
					<p><?php _e( 'There are many ways to support open-source projects such as CarDojo, for example code contribution, translation, or even telling your friends how awesome the plugin (hopefully) is. Thanks in advance for your support - it is much appreciated!', 'cardojo' ); ?></p>
				</div>

			<?php endif; ?>
		</div>
		<?php
	}
}

new WP_CarDojo_Setup();
