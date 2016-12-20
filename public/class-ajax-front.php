<?php
class WPC_Shortcodes_Ajax_Front {
	protected static $instance = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		// send email when logged out
		add_action( 'wp_ajax_nopriv_wc-send-rsvp-email', array( &$this, 'send_rsvp_email' ) );
		// send email when logged in
		add_action( 'wp_ajax_wc-send-rsvp-email', array( &$this, 'send_rsvp_email' ) );
	}

	/**
	 * webpm_send_email 
	 *
	 * Ajax function to send email without
	 * reloading the page.
	 * 
	 * @access public
	 * @return void
	 */
	public function send_rsvp_email() {
		// get the submitted parameters
		$error = array();
		$emailSent = false;
		$message = array();

		$email_to = get_option( WC_SHORTCODES_PREFIX . 'rsvp_email');
		$email_title = trim( get_option( WC_SHORTCODES_PREFIX . 'rsvp_email_title') );
		$email_success_message = trim( get_option( WC_SHORTCODES_PREFIX . 'rsvp_success_message') );
		$email_success_message = empty( $email_success_message ) ? 'Message Sent' : $email_success_message;

		$admin_email = get_option('admin_email');
		if ( empty( $email_to ) ) {
			$email_to = $admin_email;
		}

		$email_to = sanitize_email( $email_to );
		$email_title = sanitize_text_field( $email_to );
		$email_success_message = sanitize_text_field( $email_to );

		$rsvp_name = trim( sanitize_text_field( $_POST['rsvp_name'] ) );
		if ( $rsvp_name === '') {
			$error[] = 'Please enter your name.';
			$hasError = true;
		} else {
			$message[] = 'Name: ' . esc_html( $rsvp_name );
		}

		$rsvp_number = trim( sanitize_text_field( $_POST['rsvp_number'] ) );
		if ( $rsvp_number === '') {
			$error[] = 'Please select a number.';
			$hasError = true;
		} else {
			$message[] = 'Number: ' . esc_html( $rsvp_number );
		}

		$rsvp_event = trim( sanitize_text_field( $_POST['rsvp_event'] ) );
		if ( $rsvp_event === '') {
			$error[] = 'Please select event.';
			$hasError = true;
		} else {
			$message[] = 'Event: ' . esc_html( $rsvp_event );
		}

		$status = trim(implode("<br />", $error));

		if ( empty( $error ) ) {
			$subject = $email_title;
			$name = $rsvp_name;
			$body = implode( "\n\n", $message );
			$body .= "\n\n\n\nThis message was sent through the contact form via ".get_bloginfo('url');
			$headers = "From: " . $admin_email . "\r\n";

			wp_mail($email_to, $subject, $body, $headers);
			$emailSent = true;
			$status = $email_success_message;
		}
	 
		// generate the response
		$response = json_encode( array( 'success' => (int) $emailSent, 'message' => $status ) );
	 
		// response output
		header( "Content-Type: application/json" );
		echo $response;
	 
		// IMPORTANT: don't forget to "exit"
		exit;
	}
}
