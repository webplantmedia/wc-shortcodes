<?php
/*
Plugin Name: WordPress Canvas Shortcodes
Plugin URI: http://contactform7.com/
Description: Just another shortcode plugin. Simple but flexible.
Author: Chris Baldelomar
Author URI: http://webplantmedia.com/
Version: 1.0
License: GPLv2 or later
*/

define( 'WC_SHORTCODES_VERSION', '1.0' );
define( 'WC_SHORTCODES_PREFIX', 'wc_shortcodes_' );
define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once( dirname(__FILE__) . '/includes/options.php' ); // define options array
require_once( dirname(__FILE__) . '/includes/settings.php' ); // Adds settings
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php'); // Main shortcode functions
require_once( dirname(__FILE__) . '/includes/mce/shortcodes_tinymce.php'); // Add mce buttons to post editor
