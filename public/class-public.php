<?php

class WPC_Shortcodes_Public extends WPC_Shortcodes_Vars {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load theme support variables.
		add_action( 'init', array( &$this, 'check_supports' ) );

		// Load plugin text domain.
		add_action( 'init', array( &$this, 'load_plugin_textdomain' ) );

		// Load public-facing style sheet and JavaScript.
		// add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'scripts_override' ), 9999 );
	}

	public function check_supports() {
		if ( current_theme_supports( 'wpc-shortcodes' ) ) {
			$supports = get_theme_support( 'wpc-shortcodes' );

			if ( isset( $supports[0] ) && is_array( $supports[0] ) ) {
				// If theme support options are set, assume theme_reset is true, unless user-defined.
				if ( ! isset( $supports[0]['theme_reset'] ) ) {
					parent::$theme_support['theme_reset'] = true;
				}
				foreach ( $supports[0] as $key => $value ) {
					parent::$theme_support[ $key ] = $value;
				}
			}
		}
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = parent::$plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$ver = WC_SHORTCODES_VERSION;

		if ( get_option( WC_SHORTCODES_PREFIX . 'enable_shortcode_css', true ) ) {
			wp_enqueue_style( 'wc-shortcodes-style', WC_SHORTCODES_PLUGIN_URL . 'public/assets/css/style.css', array( ), $ver );
		}

		wp_enqueue_script('jquery');
		wp_register_script( 'wc-shortcodes-tabs', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/tabs.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-toggle', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/toggle.js', 'jquery', $ver, true );
		wp_register_script( 'wc-shortcodes-accordion', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/accordion.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-prettify', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/prettify.js', array ( ), $ver, true );
		wp_register_script( 'wc-shortcodes-pre', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/pre.js', array ( 'jquery' ), $ver, true );

		if ( parent::$google_maps_api_key ) {
			wp_register_script( 'wc-shortcodes-googlemap-api', 'https://maps.googleapis.com/maps/api/js?key=' . urlencode( parent::$google_maps_api_key ), array('jquery'), $ver, true);
			wp_register_script( 'wc-shortcodes-googlemap',  WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/googlemap.js', array('jquery', 'wc-shortcodes-googlemap-api'), $ver, true);
		}
		wp_register_script( 'wc-shortcodes-skillbar', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/skillbar.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-fullwidth', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/fullwidth.js', array ( 'jquery' ), $ver, true );

		// Masonry
		wp_enqueue_script( 'jquery-masonry' );

		// images loaded
		wp_register_script( 'wordpresscanvas-imagesloaded', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/imagesloaded.pkgd.min.js', array (), '4.1.1', true );

		// slider
		wp_register_script( 'wordpresscanvas-rslides', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/responsiveslides.min.js', array ( 'jquery' ), '1.54', true );
		wp_register_style( 'wc-shortcodes-bxslider', WC_SHORTCODES_PLUGIN_URL . 'includes/vendors/bxslider/jquery.bxslider.min.css', array( ), '4.2.12' );
		wp_register_script( 'wc-shortcodes-bxslider', WC_SHORTCODES_PLUGIN_URL . 'includes/vendors/bxslider/jquery.bxslider.min.js', array ( 'jquery' ), '4.2.12', true );
		wp_register_script( 'wc-shortcodes-post-slider', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/post-slider.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-collage', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/collage.js', array ( 'jquery' ), $ver, true );

		// posts
		wp_register_script( 'wc-shortcodes-posts', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/posts.js', array ( 'jquery', 'wordpresscanvas-rslides', 'jquery-masonry', 'wordpresscanvas-imagesloaded' ), $ver, true );
		wp_register_script( 'wc-shortcodes-posts-grid', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/posts-grid.js', array ( 'jquery', 'wordpresscanvas-rslides' ), $ver, true );

		// countdown
		wp_register_script( 'wc-shortcodes-jquery-countdown-js', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/jquery.countdown.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-countdown', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/countdown.js', array ( 'wc-shortcodes-jquery-countdown-js' ), $ver, true );

		// rsvp
		wp_register_script( 'wc-shortcodes-rsvp', WC_SHORTCODES_PLUGIN_URL . 'public/assets/js/rsvp.js', array ( 'jquery' ), $ver, true );

		$local = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'wc-shortcodes-rsvp', 'WCShortcodes', $local );
		wp_enqueue_script( 'wc-shortcodes-rsvp' );
	}

	public function scripts_override() {
		
		if ( WC_SHORTCODES_FONT_AWESOME_ENABLED ) {
			wp_deregister_style( 'wordpresscanvas-font-awesome' );
			wp_register_style( 'wordpresscanvas-font-awesome', WC_SHORTCODES_PLUGIN_URL . 'public/assets/css/font-awesome.min.css', array( ), '4.7.0' );
			wp_enqueue_style( 'wordpresscanvas-font-awesome' );
		}
		
		/* if ( ! wp_script_is( 'pinit', 'registered' ) ) {
			wp_register_script( 'pinit', '//assets.pinterest.com/js/pinit.js', array(), false, true);
		} */
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	public static function single_activate() {
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	public static function single_deactivate() {
	}
}
