<?php
class WPC_Shortcodes_Admin extends WPC_Shortcodes_Vars {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load admin style sheet and JavaScript.
		// add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_scripts' ), 10, 1 );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . parent::$plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( &$this, 'add_action_links' ) );
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts( $hook ) {

		$ver = WC_SHORTCODES_VERSION;

		if ( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'widgets.php' ) {
			wp_enqueue_style( 'wc-shortcodes-visual-manager-style', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/css/wcvisualmanager.css', array( ), $ver );
			wp_enqueue_style( 'wc-shortcodes-ui-theme-override-style', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/css/ui-theme-override.css', array( ), $ver );
			wp_enqueue_script( 'wc-shortcodes-posts-widget', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wcpostswidget.js', array ( 'jquery', 'jquery-ui-autocomplete', 'jquery-ui-accordion' ), $ver, true );
			wp_enqueue_script( 'wc-shortcodes-font-awesome-widget', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wcfontawesomewidget.js', array ( 'jquery', 'jquery-ui-autocomplete' ), $ver, true );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wc-shortcodes-color-picker-widget', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wccolorpickerwidget.js', array ( 'wp-color-picker' ), $ver, true );
			wp_enqueue_script( 'wc-shortcodes', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wc-shortcodes.js', array ( 'jquery' ), $ver, true );

			wp_deregister_style( 'wpc-widgets-admin-style' );
			wp_deregister_script( 'wpc-widgets-admin-js' );

			wp_register_style( 'wpc-widgets-admin-style', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/css/wpc-image.css', array(), $ver, 'all' );
			wp_enqueue_style( 'wpc-widgets-admin-style' );

			wp_enqueue_media();
			wp_register_script( 'wpc-widgets-admin-js', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wpc-image.js', array ( 'jquery' ), $ver, true );
			wp_enqueue_script( 'wpc-widgets-admin-js' );

		}

		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			wp_enqueue_style('wc-font-awesome-styles', WC_SHORTCODES_PLUGIN_URL . 'public/assets/css/font-awesome.css', array(), '4.7.0', 'all');
		}
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . parent::$plugin_settings_url . '">' . __( 'Settings', 'wc-shortcodes' ) . '</a>'
			),
			$links
		);
	}
}
