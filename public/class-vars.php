<?php
class WPC_Shortcodes_Vars {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '3.46';
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
	public static $theme_support;

	public static $google_maps_api_key;
	public static $attr;
	public static $plugin_settings_url = '';

	public static function init_vars() {
		define( 'WC_SHORTCODES_IS_ACTIVATED', true );
		define( 'WC_SHORTCODES_VERSION', self::VERSION );
		define( 'WC_SHORTCODES_PREFIX', self::$plugin_prefix . '_' );
		define( '_WC_SHORTCODES_PREFIX', '_' . self::$plugin_prefix . '_' );
		define( 'WC_SHORTCODES_PLUGIN_URL', plugin_dir_url( dirname( __FILE__ ) ) );
		define( 'WC_SHORTCODES_CURRENT_VERSION', get_option( WC_SHORTCODES_PREFIX . 'current_version' ) );
		define( 'WC_SHORTCODES_FONT_AWESOME_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_font_awesome', true ) );
		define( 'WC_SHORTCODES_SLIDE_POST_TYPE_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_slide_post_type', true ) );
		define( 'WC_SHORTCODES_COLLAGE_POST_TYPE_ENABLED', get_option( WC_SHORTCODES_PREFIX . 'enable_collage_post_type', true ) );

		self::$plugin_settings_url = admin_url( 'themes.php?page=' . self::$plugin_slug );
		self::$google_maps_api_key = get_option( WC_SHORTCODES_PREFIX . 'google_maps_api_key' );

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
			'facebook_small_social_icon' => '',
			'facebook_medium_social_icon' => '',
			'facebook_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/facebook.png',
			'twitter_font_icon' => 'fa-twitter',
			'twitter_small_social_icon' => '',
			'twitter_medium_social_icon' => '',
			'twitter_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/twitter.png',
			'pinterest_font_icon' => 'fa-pinterest',
			'pinterest_small_social_icon' => '',
			'pinterest_medium_social_icon' => '',
			'pinterest_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/pinterest.png',
			'google_font_icon' => 'fa-google-plus',
			'google_small_social_icon' => '',
			'google_medium_social_icon' => '',
			'google_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/google.png',
			'bloglovin_font_icon' => 'fa-plus-square',
			'bloglovin_small_social_icon' => '',
			'bloglovin_medium_social_icon' => '',
			'bloglovin_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/bloglovin.png',
			'email_font_icon' => 'fa-envelope',
			'email_small_social_icon' => '',
			'email_medium_social_icon' => '',
			'email_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/email.png',
			'flickr_font_icon' => 'fa-flickr',
			'flickr_small_social_icon' => '',
			'flickr_medium_social_icon' => '',
			'flickr_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/flickr.png',
			'instagram_font_icon' => 'fa-instagram',
			'instagram_small_social_icon' => '',
			'instagram_medium_social_icon' => '',
			'instagram_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/instagram.png',
			'rss_font_icon' => 'fa-rss',
			'rss_small_social_icon' => '',
			'rss_medium_social_icon' => '',
			'rss_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/rss.png',
			'custom1_font_icon' => 'fa-camera',
			'custom1_small_social_icon' => '',
			'custom1_medium_social_icon' => '',
			'custom1_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/picasa.png',
			'custom2_font_icon' => 'fa-shopping-cart',
			'custom2_small_social_icon' => '',
			'custom2_medium_social_icon' => '',
			'custom2_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/shopping.png',
			'custom3_font_icon' => 'fa-youtube',
			'custom3_small_social_icon' => '',
			'custom3_medium_social_icon' => '',
			'custom3_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/youtube.png',
			'custom4_font_icon' => 'fa-dollar',
			'custom4_small_social_icon' => '',
			'custom4_medium_social_icon' => '',
			'custom4_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/etsy.png',
			'custom5_font_icon' => 'fa-tumblr',
			'custom5_small_social_icon' => '',
			'custom5_medium_social_icon' => '',
			'custom5_social_icon' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/tumblr.png',
			'share_buttons_format' => 'image',
			'pinterest_share_text' => 'Pin it',
			'pinterest_share_font_icon' => 'fa-pinterest',
			'pinterest_small_share_button' => '',
			'pinterest_medium_share_button' => '',
			'pinterest_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/pinterest.png',
			'facebook_share_text' => 'Share',
			'facebook_share_font_icon' => 'fa-facebook',
			'facebook_small_share_button' => '',
			'facebook_medium_share_button' => '',
			'facebook_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/facebook.png',
			'twitter_share_text' => 'Tweet',
			'twitter_share_font_icon' => 'fa-twitter',
			'twitter_small_share_button' => '',
			'twitter_medium_share_button' => '',
			'twitter_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/twitter.png',
			'google_share_text' => 'Share',
			'google_share_font_icon' => 'fa-google-plus',
			'google_small_share_button' => '',
			'google_medium_share_button' => '',
			'google_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/google.png',
			'email_share_text' => 'Email',
			'email_share_font_icon' => 'fa-envelope',
			'email_small_share_button' => '',
			'email_medium_share_button' => '',
			'email_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/email.png',
			'print_share_text' => 'Print',
			'print_share_font_icon' => 'fa-print',
			'print_small_share_button' => '',
			'print_medium_share_button' => '',
			'print_share_button' => WC_SHORTCODES_PLUGIN_URL . 'public/assets/img/print.png',
			'social_icons_selected' => array( 'pinterest', 'instagram', 'facebook', 'twitter', 'email' ),
			'share_buttons_selected' => array( 'pinterest', 'facebook', 'twitter', 'email' ),
		);

		// Shortcode Options
		self::$attr = (object) array();
		self::$attr->spacing = array(
			'size'	=> '20px',
			'class'	=> '',
		);
		self::$attr->accordion_main = array(
			'class'	=> '',
			'collapse' => 0,
			'leaveopen' => 0,
			'layout' => 'box',
		);
		self::$attr->accordion_section = array(
			'title'	=> 'Title',
			'class'	=> '',
		);
		self::$attr->tabgroup = array(
			'class'	=> '',
			'layout' => 'box',
		);
		self::$attr->tab = array(
			'title'	=> 'Tab',
		);
		self::$attr->toggle = array(
			'title'	=> 'Toggle Title',
			'class'	=> '',
			'padding'	=> '',
			'border_width'	=> '',
			'layout' => 'box',
		);
		self::$attr->column = array(
			'size'		=> 'one-third',
			'position'	=>'',
			'class'		=> '',
			'text_align'=> '',
		);
		self::$attr->button = array(
			'type'			=> 'primary', // or inverse
			'url'			=> '',
			'title'			=> 'Visit Site',
			'target'		=> 'self',
			'rel'			=> '',
			'icon_left'		=> '',
			'icon_right'	=> '',
			'position'		=> 'float',
			'class'			=> '',
		);
		self::$attr->fa = array(
			'icon' => '',
			'margin_right' => '',
			'margin_left' => '',
			'class' => '',
		);
		self::$attr->googlemap = array(
			'title'		=> '', // content inside the info window
			'title_on_load' => 0, // should the info window display on map load
			'location'	=> '', // Enter a valid address that Google can geocode.
			'height'	=> '300', // set the height of your google map in pixels
			'zoom'		=> 10, // the lower the zoom, the farther away the map appears
			'class'		=> '', // add a custom class to your google map
		);
		self::$attr->heading = array(
			'title'			=> __('Sample Heading', 'wc'),
			'type'			=> 'h2',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'text_align'	=> '',
			'font_size'		=> '',
			'color'			=> '',
			'class'			=> '',
			'icon_left'		=> '',
			'icon_right'	=> '',
			'icon_spacing'	=> '',
		);
		self::$attr->fullwidth = array(
			'selector' => self::$theme_support[ 'fullwidth_container' ],
			'max_width' => '',
			'padding_top' => '',
			'padding_bottom' => '',
			'padding_side' => '',
			'background_color' => '',
			'border_color' => '',
			'style' => '',
			'class' => '',
		);
		self::$attr->pricing = array(
			'type'					=> 'primary', // primary, secondary, inverse
			'plan'					=> 'Basic', // string
			'cost'					=> '$20', // string
			'per'					=> 'month', // month, day, year, week, etc
			'button_url'			=> '', // url to payment gateway
			'button_text'			=> 'Purchase', // call to action button
			'button_target'			=> 'self', // self, blank
			'button_rel'			=> 'nofollow', // alternate, author, bookmark, help, license, next, nofollow, noreferrer, prefetch, prev, search, tag
			'class'					=> '', // add your own css class for customization.
		);
		self::$attr->skillbar = array(
			'title'	=> '',
			'percentage'	=> '100',
			'color'	=> '#6adcfa',
			'class'	=> '',
			'show_percent'	=> 1
		);
		self::$attr->social_icons = array(
			'title'      => '', // for widget title
			'format'      => 'default',
			'columns'      => 'float-left',
			'class'      => '',
			'size'		 => 'large', // deprecated. using maxheight now
			'align'      => 'left', //deprecated?
			'maxheight'  => '48',
		);
		self::$attr->share_buttons = array(
			// misc options
			'class' => '',
		);
		self::$attr->testimonial = array(
			'by' => '',
			'url' => '',
			'position' => 'left',
			'class'	=> '',
		);
		self::$attr->image = array(
			// attachment detail settings
			'title' => '',
			'alt' => '',
			'caption' => '',

			// attachment display settings
			'link_to' => '', // post, file, none
			'url' => '', // for custom link_to
			'align' => '', // none, left, center, right
			'attachment_id' => '', // int id
			'size' => 'large', // image size

			// flag options
			'flag' => '',
			'left' => '',
			'right' => '',
			'top' => '',
			'bottom' => '',
			'text_color' => '',
			'background_color' => '',
			'font_size' => '',
			'text_align' => '', // none, left, center, right
			'flag_width' => '',

			// misc options
			'class' => '',
		);
		self::$attr->collage = array(
			'pids' => '', //use post id.
			'p' => '', //use post id.
			'post__in' => '', //use post ids
			'order' => 'DESC', // DESC, ASC
			'orderby' => 'date',
			'post_status' => 'publish',
			'post_type' => 'wcs_collage', // post, page, wc_portfolio_item, etc
			'posts_per_page' => 10, //number of post to show per page
			'nopaging' => false, //show all posts or use pagination. Default value is 'false', use paging.
			'ignore_sticky_posts' => 1,

			'taxonomy' => '', // category, post_tag, wc_portfolio_tag, etc
			'field' => 'slug', // slug or id
			'terms' => '', // taxonomy terms.

			'button_class' => '', // show main content?

			'size' => 'full', // default thumbnail size

			'heading_size' => 26,
			'mobile_heading_size' => 18,
			'layout' => 'bxslider', // blog layout
			'template' => 'collage1',
			'gutter_space' => 7,
			'desktop_height' => 600,
			'laptop_height' => 500,
			'mobile_height' => 250,

			'slider_mode' => 'fade',
			'slider_pause' => 4000,
			'slider_auto' => 0,
		);
		self::$attr->call_to_action = array(
			// image
			'image' => '',
			'image_2x' => '',
			'image_max_width' => '200px',
			'image_position' => 'left',
			// settings
			'style_format' => 'image_left',
			'text_max_width' => '200px',
			'text_position' => 'center',
			'gutter_position' => '50',
			'gutter_spacing' => '80',
			'padding_top' => '20px',
			'padding_bottom' => '20px',
			'padding_side' => '',
			'class'	=> '',
		);
		self::$attr->image_links = array(
			// image 1
			'image_1' => '',
			'text_1'	=> '',
			'url_1' => '',
			// image 2
			'image_2' => '',
			'text_2'	=> '',
			'url_2' => '',
			// image 3
			'image_3' => '',
			'text_3'	=> '',
			'url_3' => '',
			// image 4
			'image_4' => '',
			'text_4'	=> '',
			'url_4' => '',
			// settings
			'text_position' => 'center',
			'heading_type' => 'h3',
			'text_color' => '',
			'background_color' => '',
			'height' => '250px',
			'style_format' => 'row',
			'class'	=> '',
		);
		self::$attr->countdown = array(
			'date' => '',
			'format' => 'wdHMs',
			'labels' => 'Years,Months,Weeks,Days,Hours,Minutes,Seconds',
			'labels1' => 'Year,Month,Week,Day,Hour,Minute,Second',
			'message' => 'Your Message Here!',
		);
		self::$attr->rsvp = array(
			'columns' => '3',
			'align' => 'left',
			'button_align' => 'center',
		);
		self::$attr->html = array(
			'name'			=>	''
		);
		self::$attr->box = array(
			'color'			=> 'primary',
			'text_align'	=> 'left',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'class'			=> '',
		);
		self::$attr->highlight = array(
			'color'	=> 'yellow',
			'class'	=> '',
		);
		self::$attr->divider = array(
			'style'			=> 'solid',
			'line'			=> 'single',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'class'			=> '',
		);
		self::$attr->pre = array(
			'name'			=>	'',
			'scrollable'	=>	1,
			'color'			=>	1,
			'lang'			=>	'',
			'linenums'		=>	0,
			'wrap'			=>	0,
		);
		self::$attr->center = array(
			'max_width'		=> '500px',
			'text_align'	=> 'center',
			'class'			=> '',
		);
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

			'readmore' => '', // show read more button?
			'button_class' => 'button', // show main content?

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
			'show_button' => 1, // show button?
			'readmore' => 'Continue Reading', // show read more button?
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
		self::$attr->featured_posts = array(
			'title' => '', //use author id
			'author' => '', //use author id
			'author_name' => '', //use 'user_nicename' (NOT name).
			'pids' => '', //use post id.
			'p' => '', //use post id.
			'post__in' => '', //use post ids
			'order' => 'DESC', // DESC, ASC
			'orderby' => 'date',
			'post_status' => 'publish',
			'post_type' => 'post', // post, page, wc_portfolio_item, etc
			'posts_per_page' => 4, //number of post to show per page
			'nopaging' => false, //show all posts or use pagination. Default value is 'false', use paging.
			'ignore_sticky_posts' => 1,

			'taxonomy' => '', // category, post_tag, wc_portfolio_tag, etc
			'field' => 'slug', // slug or id
			'terms' => '', // taxonomy terms.

			'show_meta_category' => 1, // show heading?
			'show_content' => 0, // show main content?

			'size' => 'medium', // default thumbnail size

			'heading_type' => 'h2', // heading tag for title
			'layout' => 'thumbnail',
			'template' => 'featured',
			'excerpt_length' => 20,
		);
	}
}
