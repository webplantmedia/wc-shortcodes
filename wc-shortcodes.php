<?php
/*
Plugin Name: WP Canvas - Shortcodes
Plugin URI: http://webplantmedia.com/starter-themes/wordpresscanvas/features/shortcodes/
Description: A family of shortcodes to enhance site functionality.
Author: Chris Baldelomar
Author URI: http://webplantmedia.com/
Version: 1.46
License: GPLv2 or later
*/

define( 'WC_SHORTCODES_VERSION', '1.46' );
define( 'WC_SHORTCODES_PREFIX', 'wc_shortcodes_' );
define( '_WC_SHORTCODES_PREFIX', '_wc_shortcodes_' );
define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WC_SHORTCODES_CURRENT_VERSION', get_option( WC_SHORTCODES_PREFIX . 'current_version' ) );
define( 'WC_SHORTCODES_FONT_AWESOME_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_font_awesome', true ) );

global $wc_shortcodes_options;
global $wc_shortcodes_social_icons;
global $wc_shortcodes_share_buttons;
global $wc_shortcodes_theme_support;
global $wc_shortcodes_plugin_screen_hook_suffix;

$wc_shortcodes_options = array();
$wc_shortcodes_social_icons = array(
	'facebook' => 'Facebook',
	'google' => 'Google',
	'twitter' => 'Twitter',
	'pinterest' => 'Pinterest',
	'instagram' => 'Instagram',
	'bloglovin' => 'BlogLovin',
	'flickr' => 'Flickr',
	'rss' => 'RSS',
	'email' => 'Email',
	'custom1' => 'Custom 1',
	'custom2' => 'Custom 2',
	'custom3' => 'Custom 3',
	'custom4' => 'Custom 4',
	'custom5' => 'Custom 5',
);
$wc_shortcodes_share_buttons = array(
	'pinterest' => 'Pinterest',
	'facebook' => 'Facebook',
	'twitter' => 'Twitter',
	'google' => 'Google',
	'email' => 'Email',
);
$wc_shortcodes_theme_support = array(
	'fullwidth_container' => '#main',
	'facebook_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/facebook.png',
	'twitter_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/twitter.png',
	'pinterest_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/pinterest.png',
	'google_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/google.png',
	'bloglovin_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/bloglovin.png',
	'email_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/email.png',
	'flickr_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/flickr.png',
	'instagram_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/instagram.png',
	'rss_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/rss.png',
	'custom1_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/picasa.png',
	'custom2_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/shopping.png',
	'custom3_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/youtube.png',
	'custom4_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/etsy.png',
	'custom5_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/tumblr.png',
	'pinterest_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/pinterest.png',
	'facebook_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/facebook.png',
	'twitter_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/twitter.png',
	'google_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/google.png',
	'email_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/email.png',
);

require_once( dirname(__FILE__) . '/includes/options.php' ); // define options array
require_once( dirname(__FILE__) . '/includes/functions.php' ); // Adds basic filters and actions
require_once( dirname(__FILE__) . '/includes/settings.php' ); // Adds settings
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php'); // Main shortcode functions
require_once( dirname(__FILE__) . '/includes/mce/shortcodes_tinymce.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/widgets.php' ); // include any widgets
