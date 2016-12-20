<?php
class WPC_Shortcodes_Vars {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '3.1';
	const DB_VERSION = '1.0';

	/**
	 * @TODO - Rename "plugin-name" to the name your your plugin
	 *
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected static $plugin_slug = 'wc-shortcodes';
	protected static $plugin_prefix = 'wc_shortcodes';

	protected static $options;
	protected static $social_icons;
	protected static $share_buttons;
	protected static $theme_support;

	public static function init_vars() {
		define( 'WC_SHORTCODES_IS_ACTIVATED', true );
		define( 'WC_SHORTCODES_VERSION', self::VERSION );
		define( 'WC_SHORTCODES_PREFIX', self::$plugin_prefix . '_' );
		define( '_WC_SHORTCODES_PREFIX', '_' . self::$plugin_prefix . '_' );
		define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( dirname( __FILE__ ) ) );
		define( 'WC_SHORTCODES_CURRENT_VERSION', get_option( WC_SHORTCODES_PREFIX . 'current_version' ) );
		define( 'WC_SHORTCODES_FONT_AWESOME_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_font_awesome', true ) );
		define( 'WC_SHORTCODES_SLIDE_POST_TYPE_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_slide_post_type', true ) );

		self::$options = array();
		self::$social_icons = array(
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
		self::$share_buttons = array(
			'pinterest' => 'Pinterest',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'google' => 'Google',
			'email' => 'Email',
			'print' => 'Print',
		);
		self::$theme_support = array(
			'theme_reset' => false,
			'fullwidth_container' => '#main',
			'social_icons_format' => 'image',
			'share_buttons_filter_disable' => false,
			'share_buttons_on_post_page' => false,
			'share_buttons_on_blog_page' => false,
			'share_buttons_on_archive_page' => false,
			'share_buttons_on_product_page' => false,
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
	}
}
