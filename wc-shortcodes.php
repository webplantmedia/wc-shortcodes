<?php
/*
Plugin Name: WP Canvas - Shortcodes
Plugin URI: http://webplantmedia.com/starter-themes/wordpresscanvas/features/shortcodes/
Description: A family of shortcodes to enhance site functionality.
Author: Chris Baldelomar
Author URI: http://webplantmedia.com/
Version: 1.66
License: GPLv2 or later
*/

define( 'WC_SHORTCODES_VERSION', '1.66' );
define( 'WC_SHORTCODES_PREFIX', 'wc_shortcodes_' );
define( '_WC_SHORTCODES_PREFIX', '_wc_shortcodes_' );
define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WC_SHORTCODES_CURRENT_VERSION', get_option( WC_SHORTCODES_PREFIX . 'current_version' ) );
define( 'WC_SHORTCODES_FONT_AWESOME_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_font_awesome', true ) );
define( 'WC_SHORTCODES_PLUGIN_BASENAME', plugin_basename( plugin_dir_path( realpath( __FILE__ ) ) . 'wc-shortcodes.php' ) );

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
	'print' => 'Print',
);
$wc_shortcodes_theme_support = array(
	'fullwidth_container' => '#main',
	'social_icons_format' => 'image',
	'facebook_font_icon' => 'fa-facebook',
	'facebook_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/facebook.png',
	'twitter_font_icon' => 'fa-twitter',
	'twitter_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/twitter.png',
	'pinterest_font_icon' => 'fa-pinterest',
	'pinterest_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/pinterest.png',
	'google_font_icon' => 'fa-google-plus',
	'google_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/google.png',
	'bloglovin_font_icon' => 'fa-plus-square',
	'bloglovin_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/bloglovin.png',
	'email_font_icon' => 'fa-envelope',
	'email_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/email.png',
	'flickr_font_icon' => 'fa-flickr',
	'flickr_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/flickr.png',
	'instagram_font_icon' => 'fa-instagram',
	'instagram_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/instagram.png',
	'rss_font_icon' => 'fa-rss',
	'rss_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/rss.png',
	'custom1_font_icon' => 'fa-camera',
	'custom1_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/picasa.png',
	'custom2_font_icon' => 'fa-shopping-cart',
	'custom2_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/shopping.png',
	'custom3_font_icon' => 'fa-youtube',
	'custom3_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/youtube.png',
	'custom4_font_icon' => 'fa-dollar',
	'custom4_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/etsy.png',
	'custom5_font_icon' => 'fa-tumblr',
	'custom5_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/tumblr.png',
	'share_buttons_format' => 'image',
	'pinterest_share_text' => 'Pin it',
	'pinterest_share_font_icon' => 'fa-pinterest',
	'pinterest_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/pinterest.png',
	'facebook_share_text' => 'Share',
	'facebook_share_font_icon' => 'fa-facebook',
	'facebook_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/facebook.png',
	'twitter_share_text' => 'Tweet',
	'twitter_share_font_icon' => 'fa-twitter',
	'twitter_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/twitter.png',
	'google_share_text' => 'Share',
	'google_share_font_icon' => 'fa-google-plus',
	'google_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/google.png',
	'email_share_text' => 'Email',
	'email_share_font_icon' => 'fa-envelope',
	'email_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/email.png',
	'print_share_text' => 'Print',
	'print_share_font_icon' => 'fa-print',
	'print_share_button' => WC_SHORTCODES_PLUGIN_URL . 'includes/img/print.png',
);

require_once( plugin_dir_path( __FILE__ ) . 'includes/vendors/wpc-settings-framework/init.php' );
require_once( dirname(__FILE__) . '/includes/options.php' ); // define options array
require_once( dirname(__FILE__) . '/includes/functions.php' ); // Adds basic filters and actions
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php'); // Main shortcode functions
require_once( dirname(__FILE__) . '/includes/mce/shortcodes_tinymce.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/widgets.php' ); // include any widgets
