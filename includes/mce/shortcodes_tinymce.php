<?php
class WC_Shortcodes_TinyMCE_Buttons {
	function __construct() {
    	add_action( 'init', array(&$this,'init') );
    }
    function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		

		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array(&$this, 'add_plugin') );  
			add_filter( 'mce_buttons', array(&$this,'register_button') ); 
		}  
    }  
	function add_plugin($plugin_array) {  
		$ver = WC_SHORTCODES_VERSION;
		$plugin_array['wc_shortcodes'] = plugin_dir_url( __FILE__ ) .'js/shortcodes_tinymce.js?ver=' . $ver;
		return $plugin_array; 
	}
	function register_button($buttons) {  
		array_push($buttons, "wc_shortcodes_button");
		return $buttons; 
	} 	
}
$wcshortcode = new WC_Shortcodes_TinyMCE_Buttons;
