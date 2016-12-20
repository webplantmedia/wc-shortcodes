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
			wp_enqueue_style( 'wc-shortcodes-admin-style', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/css/wc-shortcodes.css', array( ), $ver );
			wp_enqueue_style( 'wc-shortcodes-ui-theme-override-style', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/css/ui-theme-override.css', array( ), $ver );
			wp_enqueue_style( 'wc-shortcodes-post-slider-widget-style', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/css/wcpostsliderwidget.css', array( ), $ver );
			wp_enqueue_script( 'wc-shortcodes-post-slider-widget', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wcpostsliderwidget.js', array ( 'jquery', 'jquery-ui-autocomplete', 'jquery-ui-accordion' ), $ver, true );
			wp_enqueue_script( 'wc-shortcodes', WC_SHORTCODES_PLUGIN_URL . 'admin/assets/js/wc-shortcodes.js', array ( 'jquery' ), $ver, true );
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
				'settings' => '<a href="' . admin_url( 'themes.php?page=' . parent::$plugin_slug ) . '">' . __( 'Settings', 'wc-shortcodes' ) . '</a>'
			),
			$links
		);
	}
}
