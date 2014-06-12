<?php
/**
 * filter social url. For example, we want to add
 * mailto: to an email address.
 * 
 * @access public
 * @return void
 */
function wc_shortcodes_smart_social_link( $social_link, $name ) {
    switch ( $name ) {
        case 'email' :
            // some users may have already inserted mailto:, so let's remove it.
			if ( is_email( $social_link ) ) {
				$social_link = str_replace( 'mailto:', '', $social_link );
				$social_link = 'mailto:'.$social_link;
			}
            break;
		default :
			$social_link = esc_url( $social_link );
			break;
    }

    return $social_link;
}
add_filter( 'wc_shortcodes_social_link' , 'wc_shortcodes_smart_social_link', 10, 2 );

/*
 * On New Version
 */
function wc_shortcodes_options_activation() {
	global $wc_shortcodes_options;

	$initialize = false;

	if ( ! WC_SHORTCODES_CURRENT_VERSION ) {
		$initialize = true;
	}
	else if ( version_compare( WC_SHORTCODES_VERSION, WC_SHORTCODES_CURRENT_VERSION ) > 0 ) {
		$initialize = true;
	}

	if ( $initialize ) {
		update_option( WC_SHORTCODES_PREFIX . 'current_version', WC_SHORTCODES_VERSION );
		foreach ( $wc_shortcodes_options as $o ) {
			foreach ( $o['sections'] as $oo ) {
				foreach ( $oo['options'] as $ooo ) {
					$option_name = WC_SHORTCODES_PREFIX . $ooo['id'];
					if ( WC_SHORTCODES_PREFIX . 'social_icons_display' == $option_name ) {
						$default = wc_shortcodes_default_social_icons();
						add_option( $option_name, $default );
					}
					else {
						add_option( $option_name, $ooo['default'] );
					}
				}
			}
		}
	} 
}
add_action( 'init', 'wc_shortcodes_options_activation' );

function wc_shortcodes_default_social_icons() {
	global $wc_shortcodes_social_icons;

	$default = $wc_shortcodes_social_icons;

	foreach ( $wc_shortcodes_social_icons as $key => $value ) {
		$link_option_name = WC_SHORTCODES_PREFIX . $key . '_link';
		$icon_option_name = WC_SHORTCODES_PREFIX . $key . '_icon';

		if (  $icon_url = get_option( $icon_option_name ) ) {
			$social_link = get_option( $link_option_name );

			if ( empty( $social_link ) )
				unset( $default[ $key ] );
		}
	}

	if ( empty( $default ) ) {
		$default = $wc_shortcodes_social_icons;
	}

	return $default;
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

if ( ! function_exists( 'wc_shortcodes_display_term_classes' ) ) {
	function wc_shortcodes_display_term_classes( $taxonomy ) {
		global $post;

		$classes = array();

		if ( is_object_in_taxonomy( $post->post_type, $taxonomy ) ) {
			foreach ( (array) wp_get_post_terms( $post->ID, $taxonomy ) as $term ) {
				if ( empty( $term->slug ) )
					continue;
				$classes[] = 'wc-shortcodes-filter-' . sanitize_html_class($term->slug, $term->term_id);
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'wc_shortcodes_comma_delim_to_array' ) ) {
	function wc_shortcodes_comma_delim_to_array( $string ) {
		$a = explode( ',', $string );

		foreach ( $a as $key => $value ) {
			$value = trim( $value );

			if ( empty( $value ) )
				unset( $a[ $key ] );
			else
				$a[ $key ] = $value;
		}

		if ( empty( $a ) )
			return '';
		else
			return $a;
	}
}

function wc_shortcodes_body_class( $classes ) {
	if ( WC_SHORTCODES_FONT_AWESOME_ENABLED )
		$classes[] = 'wc-shortcodes-font-awesome-enabled';

	return $classes;
}
add_filter( 'body_class', 'wc_shortcodes_body_class' );
