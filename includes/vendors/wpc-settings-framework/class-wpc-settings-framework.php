<?php
namespace WC_Shortcodes;

/**
 * WPC Settings Framework.
 *
 * @package   WPC_Settings_Framework
 * @author    Chris Baldelomar <chris@webplantmedia.com>
 * @license   GPL-2.0+
 * @link      http://webplantmedia.com
 * @copyright 2014 Chris Baldelomar
 */

/**
 * Settings framework class.
 *
 * @package WPC_Settings_Framework
 * @author  Chris Baldelomar <chris@webplantmedia.com>
 */
class WPC_Settings_Framework {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;
	protected $sanitize = null;
	protected $display = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;
	protected $views = array();

	/**
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = null;
	protected $plugin_prefix = null;
	protected $plugin_version = null;
	protected $theme_options = array();


	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		require_once( 'class-wpc-settings-framework-sanitize.php' );
		$this->sanitize = WPC_Settings_Framework_Sanitize::get_instance();

		$this->set_slug_prefix();

		add_action( 'init', array( $this, 'set_options' ), 100 );
		add_action( 'admin_init', array( $this, 'theme_options_init' ) );
		add_action( 'admin_menu', array( $this, 'theme_options_admin_menu' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function set_slug_prefix() {
		$plugin_basename = plugin_basename( __FILE__ );
		$plugin_name = substr( $plugin_basename, 0, strpos( $plugin_basename, '/' ) );

		if ( empty( $plugin_name ) ) {
			return;
		}

		$this->plugin_slug = $this->sanitize->id( $plugin_name );
		$this->plugin_prefix = $this->sanitize->key( $plugin_name );
	}

	public function set_options() {
		$this->theme_options = apply_filters ( $this->plugin_prefix . '_theme_options' , $this->theme_options );
	}

	/**
	 * Register theme options from user defined options array
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @return void
	 */
	public function theme_options_init() {
		foreach ( $this->theme_options as $menu_slug => $o ) {
			if ( isset( $o['option_group'] ) &&
			isset( $o['tabs'] ) &&
			is_array( $o['tabs'] ) ) {
				foreach( $o['tabs'] as $key => $oo ) {
					if ( isset( $oo['sections'] ) &&
					is_array( $oo['sections'] ) ) {
						foreach( $oo['sections'] as $ooo ) {
							if ( isset( $ooo['id'] ) &&
							isset( $ooo['title'] ) &&
							isset( $ooo['options'] ) &&
							is_array( $ooo['options'] ) ) {
								// add_settings_section( $id, $title, $callback, $page );
								// @page should match @menu_slug from add_theme_page
								if ( isset( $ooo['add_section'] ) && $ooo['add_section'] ) {
									add_settings_section( $ooo['id'], $ooo['title'], '', $menu_slug );
								}

								foreach( $ooo['options'] as $oooo ) {
									if ( isset( $oooo['group'] ) && is_array( $oooo['group'] ) ) {
										foreach ( $oooo['group'] as $ooooo ) {
											if ( isset( $ooooo['option_name'] ) ) {
												$callback = $this->sanitize->callback( $ooooo['type'] );
												// register_setting( $option_group, $option_name, $callback );
												register_setting( $o['option_group'], $ooooo['option_name'], array( $this, $callback ) );
											}
										}
										if ( isset( $oooo['id'] ) && isset( $oooo['title'] ) ) {
											// add_settings_field( $id, $title, $callback, $page, $section, $args );
											// @page should match @menu_slug from add_theme_page
											// @section the section you added with add_settings_section
											add_settings_field($oooo['id'], $oooo['title'], array( $this, 'display_group' ), $menu_slug, $ooo['id'], $oooo );
										}
									}
									else {
										if ( isset( $oooo['option_name'] ) ) {
											$callback = $this->sanitize->callback( $oooo['type'] );
											// register_setting( $option_group, $option_name, $callback );
											register_setting( $o['option_group'], $oooo['option_name'], array( $this, $callback ) );

											// add_settings_field( $id, $title, $callback, $page, $section, $args );
											// @page should match @menu_slug from add_theme_page
											// @section the section you added with add_settings_section
											add_settings_field($oooo['option_name'], '<label for="'.$oooo['option_name'].'">'.$oooo['title'].'</label>' , array( $this, 'display_setting' ), $menu_slug, $ooo['id'], $oooo );
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Add submenu pages from user defined options array
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @return void
	 */
	public function theme_options_admin_menu() {
		if ( ! empty( $this->theme_options ) ) {
			foreach ( $this->theme_options as $menu_slug => $v ) {
				if ( isset( $v['parent_slug'] ) &&
				isset( $v['page_title'] ) &&
				isset( $v['menu_title'] ) &&
				isset( $v['capability'] ) &&
				isset( $v['option_group'] ) ) {
					$function = 'display_page';
					// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
					$view_hook_name = add_submenu_page( $v['parent_slug'], $v['page_title'], $v['menu_title'], $v['capability'], $menu_slug, array( $this, $function ) );
					$this->views[$view_hook_name] = $menu_slug;
				}
			}
		}
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

		if ( ! isset( $this->views ) || empty( $this->views ) ) {
			return;
		}

		if ( array_key_exists( $hook, $this->views ) ) {
			// CSS
			wp_enqueue_style( $this->plugin_slug .'-theme-options-styles', plugins_url( 'css/theme-options.css', __FILE__ ), array(), $this->plugin_version );
			wp_enqueue_style( $this->plugin_slug .'-media-uploader-styles', plugins_url( 'css/media-uploader.css', __FILE__ ), array(), $this->plugin_version );
			wp_enqueue_style( 'wp-color-picker' );

			// JS
			wp_enqueue_script( $this->plugin_slug . '-theme-options-script', plugins_url( 'js/theme-options.js', __FILE__ ), array( 'jquery' ), $this->plugin_version, true );
			wp_enqueue_media();
			wp_enqueue_script( $this->plugin_slug . '-media-uploader-script', plugins_url( 'js/media-uploader.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), $this->plugin_version, true );
		}

	}

	/**
	 * Get current filter, check with available views
	 * created when adding sub_pages, and return
	 * menu slug
	 *
	 * @since 3.6.1
	 * @access public
	 *
	 * @return void
	 */
	function get_current_view() {
		$current_filter = current_filter();
		if ( ! isset ( $this->views[ $current_filter ] ) )
			return false;

		$menu_slug = $this->views[ $current_filter ];

		return $menu_slug;
	}

	/**
	 * Display default settings page.
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @return void
	 */
	function display_page() {
		if ( ! $menu_slug = $this->get_current_view() )
			return;

		$o = $this->theme_options[$menu_slug];

		include_once( 'views/page.php' );
	}

	/**
	 * Call all the options displays in a given option
	 * group
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param array $args 
	 * @return void
	 */
	function display_group( $args ) {
		foreach ( $args['group'] as $g ) {
			$this->display_setting( $g );
		}

		include_once( 'views/group.php' );
	}

	/**
	 * Controls which display function should be called
	 * given a option type passed.
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param array $args 
	 * @return void
	 */
	function display_setting( $args ) {
		if ( !isset( $args['type'] ) )
			return;

		if ( !isset( $args['option_name'] ) )
			return;

		if ( !isset( $args['default'] ) )
			return;

		extract( $args );
		$val = get_option( $option_name, $default );

		switch ( $args['type'] ) {
			case 'image' :
				require( 'views/settings/image-field.php' );
				break;
			case 'positive_pixel' :
				require( 'views/settings/positive-pixel-input-field.php' );
				break;
			case 'pixel' :
				require( 'views/settings/pixel-input-field.php' );
				break;
			case 'number' :
				require( 'views/settings/number-input-field.php' );
				break;
			case 'decimal' :
				require( 'views/settings/decimal-input-field.php' );
				break;
			case 'radio' :
				require( 'views/settings/custom-radio.php' );
				break;
			case 'checkboxes' :
				require( 'views/settings/custom-checkboxes.php' );
				break;
			case 'dropdown' :
				require( 'views/settings/custom-dropdown.php' );
				break;
			case 'background' :
				require( 'views/settings/background-options.php' );
				break;
			case 'color' :
				require( 'views/settings/color-field.php' );
				break;
			case 'checkbox' :
				require( 'views/settings/checkbox-field.php' );
				break;
			case 'font' :
				require( 'views/settings/font-fields.php' );
				break;
			case 'font_appearance' :
				require( 'views/settings/font-appearance-fields.php' );
				break;
			case 'font_hover' :
				require( 'views/settings/font-hover-fields.php' );
				break;
			case 'font_weight' :
				require( 'views/settings/font-weight-field.php' );
				break;
			case 'border' :
				require( 'views/settings/border-fields.php' );
				break;
			case 'gallery' :
				require( 'views/settings/gallery-fields.php' );
				break;
			case 'textarea' :
				require( 'views/settings/textarea-field.php' );
				break;
			case 'wp_editor' :
				require( 'views/settings/wp-editor.php' );
				break;
			case 'sidebar' :
				require( 'views/settings/sidebar-field.php' );
				break;
			case 'emails' :
			default :
				require( 'views/settings/input-field.php' );
				break;
		}
	}
}
