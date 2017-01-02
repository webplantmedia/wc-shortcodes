<?php
class WPC_Shortcodes_Vars {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '3.2';
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
	public static $attr;

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
			'facebook_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/facebook.png',
			'twitter_font_icon' => 'fa-twitter',
			'twitter_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/twitter.png',
			'pinterest_font_icon' => 'fa-pinterest',
			'pinterest_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/pinterest.png',
			'google_font_icon' => 'fa-google-plus',
			'google_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/google.png',
			'bloglovin_font_icon' => 'fa-plus-square',
			'bloglovin_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/bloglovin.png',
			'email_font_icon' => 'fa-envelope',
			'email_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/email.png',
			'flickr_font_icon' => 'fa-flickr',
			'flickr_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/flickr.png',
			'instagram_font_icon' => 'fa-instagram',
			'instagram_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/instagram.png',
			'rss_font_icon' => 'fa-rss',
			'rss_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/rss.png',
			'custom1_font_icon' => 'fa-camera',
			'custom1_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/picasa.png',
			'custom2_font_icon' => 'fa-shopping-cart',
			'custom2_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/shopping.png',
			'custom3_font_icon' => 'fa-youtube',
			'custom3_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/youtube.png',
			'custom4_font_icon' => 'fa-dollar',
			'custom4_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/etsy.png',
			'custom5_font_icon' => 'fa-tumblr',
			'custom5_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/tumblr.png',
			'share_buttons_format' => 'image',
			'pinterest_share_text' => 'Pin it',
			'pinterest_share_font_icon' => 'fa-pinterest',
			'pinterest_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/pinterest.png',
			'facebook_share_text' => 'Share',
			'facebook_share_font_icon' => 'fa-facebook',
			'facebook_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/facebook.png',
			'twitter_share_text' => 'Tweet',
			'twitter_share_font_icon' => 'fa-twitter',
			'twitter_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/twitter.png',
			'google_share_text' => 'Share',
			'google_share_font_icon' => 'fa-google-plus',
			'google_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/google.png',
			'email_share_text' => 'Email',
			'email_share_font_icon' => 'fa-envelope',
			'email_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/email.png',
			'print_share_text' => 'Print',
			'print_share_font_icon' => 'fa-print',
			'print_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/print.png',
		);

		// Shortcode Options
		self::$attr = (object) array();
		self::$attr->posts = array(
			'author' => '', //use author id
			'author_name' => '', //use 'user_nicename' (NOT name).
			'pids' => '', //use post id.
			'p' => '', //use post id.
			'post__in' => false, //use post ids
			'order' => 'DESC', // DESC, ASC
			'orderby' => 'date',
			'post_status' => 'publish',
			'post_type' => 'post', // post, page, wc_portfolio_item, etc
			'posts_per_page' => 10, //number of post to show per page
			'nopaging' => false, //show all posts or use pagination. Default value is 'false', use paging.
			'paged' => 1, // number of page. Show the posts that would normally show up just on page X when using the "Older Entries" link.
			'ignore_sticky_posts' => 0,

			'taxonomy' => '', // category, post_tag, wc_portfolio_tag, etc
			'field' => 'slug', // slug or id
			'terms' => '', // taxonomy terms.

			'show_title' => 1, // show heading?
			'show_meta_all' => 1, // show all meta info?
			'show_meta_author' => 1, // show author?
			'show_meta_date' => 1, // show date?
			'show_meta_comments' => 1, // show comments?
			'show_thumbnail' => 1, // show thumbnail?
			'show_content' => 1, // show main content?
			'show_paging' => 1, // show pagination navigation?

			'size' => 'large', // default thumbnail size

			'filtering' => 1, // insert isotope filter navigation
			'columns' => '3', // default number of isotope columns
			'gutter_space' => '20', // gutter width percentage relative to parent element width
			'heading_type' => 'h2', // heading tag for title
			'layout' => 'masonry', // blog layout
			'template' => 'box',
			'excerpt_length' => '30',
			'date_format' => 'M j, Y',
		);
		self::$attr->post_slider = array(
			'author' => '', //use author id
			'author_name' => '', //use 'user_nicename' (NOT name).
			'pids' => '', //use post id.
			'p' => '', //use post id.
			'post__in' => '', //use post ids
			'order' => 'DESC', // DESC, ASC
			'orderby' => 'date',
			'post_status' => 'publish',
			'post_type' => 'post', // post, page, wc_portfolio_item, etc
			'posts_per_page' => 10, //number of post to show per page
			'nopaging' => false, //show all posts or use pagination. Default value is 'false', use paging.
			'ignore_sticky_posts' => 1,

			'taxonomy' => '', // category, post_tag, wc_portfolio_tag, etc
			'field' => 'slug', // slug or id
			'terms' => '', // taxonomy terms.

			'show_meta_category' => 1, // show heading?
			'show_title' => 1, // show heading?
			'show_content' => 1, // show main content?
			'readmore' => 'Continue Reading', // show main content?
			'button_class' => 'button secondary-button', // show main content?

			'size' => 'full', // default thumbnail size

			'heading_type' => 'h2', // heading tag for title
			'heading_size' => 30,
			'mobile_heading_size' => 24,
			'layout' => 'bxslider', // blog layout
			'template' => 'slider2',
			'excerpt_length' => 55,
			'desktop_height' => 600,
			'laptop_height' => 500,
			'mobile_height' => 350,

			'slider_mode' => 'fade',
			'slider_pause' => 4000,
			'slider_auto' => 0,
		);
	}
}
