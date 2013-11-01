<?php
/**
 * This file has all the main shortcode functions
 * @package wc Shortcodes Plugin
 * @since 1.0
 * @author AJ Clarke : http://wpexplorer.com
 * @copyright Copyright (c) 2012, AJ Clarke
 * @link http://wpexplorer.com
 * @License: GNU General Public License version 3.0
 * @License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 *
 * Special thank you to my buddy Syamil @ http://aquagraphite.com/
 */
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
	   $plugin_array['wordpresscanvas_shortcodes'] = plugin_dir_url( __FILE__ ) .'js/shortcodes_tinymce.js';
	   return $plugin_array; 
	}
	function register_button($buttons) {  
	   array_push($buttons, "wordpresscanvas_shortcodes_button");
	   return $buttons; 
	} 	
}
$wcshortcode = new WC_Shortcodes_TinyMCE_Buttons;
