<?php

class WPC_Shortcodes_Widgets extends WPC_Shortcodes_Vars {

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
		add_action( 'widgets_init', array( &$this, 'register_widgets' ) );
	}

	public function register_widgets() {
		register_widget( 'WC_Shortcodes_Social_Icons_Widget' );
		register_widget( 'WC_Shortcodes_Post_Slider_Widget' );
	}
}
