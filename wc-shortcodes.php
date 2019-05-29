<?php
/*
Plugin Name: Shortcodes by Angie Makes
Plugin URI: http://angiemakes.com/feminine-wordpress-blog-themes-women/
Description: A plugin that adds a useful family of shortcodes to your WordPress theme.
Author: Chris Baldelomar
Author URI: http://angiemakes.com/
Version: 3.46
License: GPLv2 or later
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-vars.php' );
WPC_Shortcodes_Vars::init_vars();

require_once( plugin_dir_path( __FILE__ ) . 'public/functions.php' ); // Adds basic filters and actions

require_once( plugin_dir_path( __FILE__ ) . 'public/class-public.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-sanitize.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-register.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-hooks.php' );

if ( WC_SHORTCODES_SLIDE_POST_TYPE_ENABLED ) {
	require_once( plugin_dir_path( __FILE__ ) . 'public/post-types/class-slide-post-type.php' ); //Adds basic filters and actions
} 

if ( WC_SHORTCODES_COLLAGE_POST_TYPE_ENABLED ) {
	require_once( plugin_dir_path( __FILE__ ) . 'public/post-types/class-collage-post-type.php' ); //Adds basic filters and actions
} 

require_once( plugin_dir_path( __FILE__ ) . 'public/class-ajax-front.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-widget-options.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-widget-base.php' );

foreach ( glob( plugin_dir_path( __FILE__ ) . 'public/widgets/widget-*.php' ) as $filename ) {
    require_once( $filename );
}

require_once( plugin_dir_path( __FILE__ ) . 'public/class-widgets.php' );


// Initialize classes.
add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Public', 'get_instance' ) );

add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Register', 'get_instance' ) );

add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Hooks', 'get_instance' ) );

if ( WC_SHORTCODES_SLIDE_POST_TYPE_ENABLED ) {
	add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Slide_Post_Type', 'get_instance' ) );
}

if ( WC_SHORTCODES_COLLAGE_POST_TYPE_ENABLED ) {
	add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Collage_Post_Type', 'get_instance' ) );
}

add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Ajax_Front', 'get_instance' ) );

add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Widgets', 'get_instance' ) );


/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
// register_activation_hook( __FILE__, array( 'WPC_Shortcode_Public', 'single_activate' ) );

// register_deactivation_hook( __FILE__, array( 'WPC_Shortcode_Public', 'single_deactivate' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() ) {
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {

		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-admin.php' );

		require_once( plugin_dir_path( __FILE__ ) . 'includes/vendors/wpc-settings-framework/init.php' );

		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-options.php' );

		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-tinymce-buttons.php' );

		add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Admin', 'get_instance' ) );

		add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Options', 'get_instance' ) );

		add_action( 'plugins_loaded', array( 'WPC_Shortcodes_TinyMCE_Buttons', 'get_instance' ) );

	}
	else {

		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-ajax.php' );

		add_action( 'plugins_loaded', array( 'WPC_Shortcodes_Ajax', 'get_instance' ) );

	}
}
