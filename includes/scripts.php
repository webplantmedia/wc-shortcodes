<?php
/**
 * This file loads the CSS and JS necessary for your shortcodes display
 * @package wc Shortcodes Plugin
 * @since 1.0
 * @author AJ Clarke : http://wpexplorer.com
 * @copyright Copyright (c) 2012, AJ Clarke
 * @link http://wpexplorer.com
 * @License: GNU General Public License version 2.0
 * @License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if( !function_exists ('wc_shortcodes_scripts') ) :
	function wc_shortcodes_scripts() {
		$ver = '1.0';

		wp_enqueue_style( 'wc_shortcodes_style', plugin_dir_url( __FILE__ ) . 'css/style.css', array( ), '2.1.5' );

		wp_enqueue_script('jquery');
		wp_register_script( 'wc_shortcodes_tabs', plugin_dir_url( __FILE__ ) . 'js/tabs.js', array ( 'jquery', 'jquery-ui-tabs'), $ver, true );
		wp_register_script( 'wc_shortcodes_toggle', plugin_dir_url( __FILE__ ) . 'js/toggle.js', 'jquery', $ver, true );
		wp_register_script( 'wc_shortcodes_accordion', plugin_dir_url( __FILE__ ) . 'js/accordion.js', array ( 'jquery', 'jquery-ui-accordion'), $ver, true );
		wp_register_script( 'wc_shortcodes_prettify', plugin_dir_url( __FILE__ ) . 'js/prettify.js', array ( ), $ver, true );
		wp_register_script( 'wc_shortcodes_pre', plugin_dir_url( __FILE__ ) . 'js/pre.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc_shortcodes_googlemap',  plugin_dir_url( __FILE__ ) . 'js/googlemap.js', array('jquery'), $ver, true);
		wp_register_script( 'wc_shortcodes_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), $ver, true);
		wp_register_script( 'wc_shortcodes_skillbar', plugin_dir_url( __FILE__ ) . 'js/skillbar.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc_shortcodes_fullwidth', plugin_dir_url( __FILE__ ) . 'js/fullwidth.js', array ( 'jquery' ), $ver, true );
	}
	add_action('wp_enqueue_scripts', 'wc_shortcodes_scripts');
endif;
