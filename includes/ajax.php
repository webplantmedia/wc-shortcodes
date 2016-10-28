<?php

/**
 * webpm_send_email 
 *
 * Ajax function to send email without
 * reloading the page.
 * 
 * @access public
 * @return void
 */
function wc_shortcodes_send_rsvp_email() {
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

	$rsvp_name = trim( $_POST['rsvp_name'] );
	if ( $rsvp_name === '') {
		$error[] = 'Please enter your name.';
		$hasError = true;
	} else {
		$message[] = 'Name: ' . esc_html( $rsvp_name );
	}

	$rsvp_number = trim( $_POST['rsvp_number'] );
	if ( $rsvp_number === '') {
		$error[] = 'Please select a number.';
		$hasError = true;
	} else {
		$message[] = 'Number: ' . esc_html( $rsvp_number );
	}

	$rsvp_event = trim( $_POST['rsvp_event'] );
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
// send email when logged out
add_action( 'wp_ajax_nopriv_wc-send-rsvp-email', 'wc_shortcodes_send_rsvp_email' );
// send email when logged in
add_action( 'wp_ajax_wc-send-rsvp-email', 'wc_shortcodes_send_rsvp_email' );

function wc_shortcodes_post_lookup_callback() {
	global $wpdb; //get access to the WordPress database object variable

	//get names of all businesses
	$request = '%' . $wpdb->esc_like( stripslashes( $_POST['request'] ) ) . '%'; //escape for use in LIKE statement
	$post_type = stripslashes( $_POST['post_type'] );
	$sql = "
		select
			ID,
			post_title
		from
			$wpdb->posts
		where
			post_title like %s
			and post_type='%s'
			and post_status='publish'
		order by
			post_title ASC
		limit
			0,30
	";

	$sql = $wpdb->prepare($sql, $request, $post_type);

	$results = $wpdb->get_results($sql);

	//copy the business titles to a simple array
	$titles = array();
	$i = 0;
	foreach( $results as $r ) {
		$titles[ $i ][ 'label' ] = $r->post_title . " (" . $r->ID . ")";
		$titles[ $i ][ 'value' ] = $r->ID;
		$i++;
	}

	if ( empty( $titles ) ) {
		$titles[0]['label'] = "No results found in post type \"$post_type\".";
		$titles[0]['value'] = "0";
	}
		
	echo json_encode($titles); //encode into JSON format and output

	die(); //stop "0" from being output
}
add_action( 'wp_ajax_wc_post_lookup', 'wc_shortcodes_post_lookup_callback' );

function wc_shortcodes_terms_lookup_callback() {
	global $wpdb; //get access to the WordPress database object variable

	//get names of all businesses
	$request = '%' . $wpdb->esc_like( stripslashes( $_POST['request'] ) ) . '%'; //escape for use in LIKE statement
	$post_type = stripslashes( $_POST['post_type'] );
	$taxonomy = stripslashes( $_POST['taxonomy'] );

	if ( empty( $taxonomy ) ) {
		$titles = array();
		$titles[0]['label'] = "Please select a taxonomy.";
		$titles[0]['value'] = "0";
		
		echo json_encode($titles); //encode into JSON format and output

		die(); //stop "0" from being output
	}

	$sql = "
		SELECT
			t.slug,
			t.slug
		FROM $wpdb->terms AS t 
		INNER JOIN $wpdb->term_taxonomy AS tt ON (tt.term_id = t.term_id) 
		INNER JOIN $wpdb->term_relationships AS tr ON (tr.term_taxonomy_id = tt.term_taxonomy_id) 
		WHERE t.slug like %s 
			AND tt.taxonomy IN ('%s')
		GROUP BY
			t.slug
		ORDER BY
			t.name ASC
		limit
			0,30
	";

	$sql = $wpdb->prepare($sql, $request, $taxonomy);

	$results = $wpdb->get_results($sql);

	//copy the business titles to a simple array
	$titles = array();
	$i = 0;
	foreach( $results as $r ) {
		$titles[ $i ]['label'] = $r->slug;
		$titles[ $i ]['value'] = $r->slug;
		$i++;
	}
	
	if ( empty( $titles ) ) {
		$titles[0]['label'] = "No results found in selected taxonomy \"$taxonomy\".";
		$titles[0]['value'] = "0";
	}
		
	echo json_encode($titles); //encode into JSON format and output

	die(); //stop "0" from being output
}
add_action( 'wp_ajax_wc_terms_lookup', 'wc_shortcodes_terms_lookup_callback' );

function wc_shortcodes_mce_popup() {

	$tag = $_POST['tag'];
	$shortcode = stripslashes( $_POST['shortcode'] );
	$attr = wc_shortcodes_parse_shortcode( $tag, $shortcode );
	
	switch ( $tag ) {
		case 'wc_post_slider' :
			$widget = new WC_Shortcodes_Post_Slider_Widget();
			$widget->form( $attr );
			break;
	}

	die();
}
add_action( 'wp_ajax_wc_mce_popup', 'wc_shortcodes_mce_popup' );
