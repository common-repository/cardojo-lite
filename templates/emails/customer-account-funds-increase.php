<?php
/**
 * Customer Account Funds Increase Email
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

	<p><?php printf( __( 'Your account funds on %1$s have increased from %2$s to %3$s.', 'cardojo' ), $home_url, $current_funds, $new_funds ) ?></p>

<?php do_action( 'woocommerce_email_footer', $email );
