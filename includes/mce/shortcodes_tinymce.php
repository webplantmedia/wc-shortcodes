<?php
class WC_Shortcodes_TinyMCE_Buttons {
	function __construct() {
    	add_action( 'admin_head', array(&$this,'init') );
    }
    function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		

		if ( get_user_option('rich_editing') == 'true' ) {  
			// add_action('admin_enqueue_scripts', array(&$this, 'register_plugin_styles'));

			add_filter( 'mce_external_plugins', array(&$this, 'add_plugin') );  
			add_filter( 'mce_buttons', array(&$this,'register_button') ); 
		}  
    }  
	function add_plugin($plugin_array) {  
		global $wp_version;
		$ver = WC_SHORTCODES_VERSION;

		// version 3.9 updated to tinymce 4.0
		if ( version_compare( $wp_version, '3.9', '>=' ) ) {
			$plugin_array['wc_shortcodes'] = plugin_dir_url( __FILE__ ) .'js/shortcodes-tinymce-4.js?ver=' . $ver;
			$plugin_array['wc_font_awesome'] = plugin_dir_url( __FILE__ ) .'js/font-awesome-tinymce-4.js?ver=' . $ver;
		}
		else {
			$plugin_array['wc_shortcodes'] = plugin_dir_url( __FILE__ ) .'js/shortcodes_tinymce.js?ver=' . $ver;
			$plugin_array['wc_font_awesome'] = plugin_dir_url( __FILE__ ) .'js/font_awesome_tinymce.js?ver=' . $ver;
		}
		return $plugin_array; 
	}
	function register_button($buttons) {  
		array_push($buttons, "wc_shortcodes_button");
        array_push($buttons, 'wcfontAwesomeGlyphSelect');
		
		return $buttons; 
	}
	function register_plugin_styles() {
        global $wp_styles;

        wp_enqueue_style('wc-font-awesome-styles', WC_SHORTCODES_PLUGIN_URL . 'includes/css/font-awesome.css', array(), WC_SHORTCODES_VERSION, 'all');
    }
}
$wcshortcode = new WC_Shortcodes_TinyMCE_Buttons;
