<?php
/*
Plugin Name: WordPress Canvas Shortcodes
Plugin URI: http://wordpresscanvas.com/features/shortcodes/
Description: A family of shortcodes to enhance site functionality.
Author: Chris Baldelomar
Author URI: http://webplantmedia.com/
Version: 1.11
License: GPLv2 or later
*/

define( 'WC_SHORTCODES_VERSION', '1.11' );
define( 'WC_SHORTCODES_PREFIX', 'wc_shortcodes_' );
define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

global $wc_shortcodes_options;

require_once( dirname(__FILE__) . '/includes/functions.php' ); // Adds basic filters and actions
require_once( dirname(__FILE__) . '/includes/options.php' ); // define options array
require_once( dirname(__FILE__) . '/includes/settings.php' ); // Adds settings
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php'); // Main shortcode functions
require_once( dirname(__FILE__) . '/includes/mce/shortcodes_tinymce.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/widgets.php' ); // include any widgets

function wc_shortcodes_options_activation_hook() {
	global $wc_shortcodes_options;

	foreach ( $wc_shortcodes_options as $o ) {
		foreach ( $o['sections'] as $oo ) {
			foreach ( $oo['options'] as $ooo ) {
				$option_name = WC_SHORTCODES_PREFIX . $ooo['id'];
				add_option( $option_name, $ooo['default'] );
			}
		}
	}
}
register_activation_hook( __FILE__, 'wc_shortcodes_options_activation_hook' );
