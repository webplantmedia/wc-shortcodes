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
		register_widget( 'WPC_Shortcodes_Widget_Social_Icons' );
		register_widget( 'WPC_Shortcodes_Widget_Post_Slider' );
		register_widget( 'WPC_Shortcodes_Widget_Image_Links' );
		register_widget( 'WPC_Shortcodes_Widget_Featured_Posts' );

		if ( WC_SHORTCODES_COLLAGE_POST_TYPE_ENABLED ) {
			register_widget( 'WPC_Shortcodes_Widget_Collage' );
		}
	}
}
