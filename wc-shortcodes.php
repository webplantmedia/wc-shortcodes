<?php
/*
Plugin Name: WP Canvas - Shortcodes
Plugin URI: http://webplantmedia.com/starter-themes/wordpresscanvas/features/shortcodes/
Description: A family of shortcodes to enhance site functionality.
Author: Chris Baldelomar
Author URI: http://webplantmedia.com/
Version: 1.40
License: GPLv2 or later
*/

define( 'WC_SHORTCODES_VERSION', '1.40' );
define( 'WC_SHORTCODES_PREFIX', 'wc_shortcodes_' );
define( '_WC_SHORTCODES_PREFIX', '_wc_shortcodes_' );
define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WC_SHORTCODES_CURRENT_VERSION', get_option( WC_SHORTCODES_PREFIX . 'current_version' ) );
define( 'WC_SHORTCODES_FONT_AWESOME_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_font_awesome', true ) );

global $wc_shortcodes_options;
global $wc_shortcodes_plugin_screen_hook_suffix;

require_once( dirname(__FILE__) . '/includes/options.php' ); // define options array
require_once( dirname(__FILE__) . '/includes/functions.php' ); // Adds basic filters and actions
require_once( dirname(__FILE__) . '/includes/settings.php' ); // Adds settings
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php'); // Main shortcode functions
require_once( dirname(__FILE__) . '/includes/mce/shortcodes_tinymce.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/widgets.php' ); // include any widgets
