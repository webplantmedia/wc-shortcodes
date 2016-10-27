<?php
if( ! function_exists('wc_shortcodes_scripts') ) :
	function wc_shortcodes_scripts() {
		$ver = WC_SHORTCODES_VERSION;

		if ( get_option( WC_SHORTCODES_PREFIX . 'enable_shortcode_css', true ) ) {
			wp_enqueue_style( 'wc-shortcodes-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array( ), $ver );
		}

		wp_enqueue_script('jquery');
		wp_register_script( 'wc-shortcodes-tabs', plugin_dir_url( __FILE__ ) . 'js/tabs.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-toggle', plugin_dir_url( __FILE__ ) . 'js/toggle.js', 'jquery', $ver, true );
		wp_register_script( 'wc-shortcodes-accordion', plugin_dir_url( __FILE__ ) . 'js/accordion.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-prettify', plugin_dir_url( __FILE__ ) . 'js/prettify.js', array ( ), $ver, true );
		wp_register_script( 'wc-shortcodes-pre', plugin_dir_url( __FILE__ ) . 'js/pre.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-googlemap',  plugin_dir_url( __FILE__ ) . 'js/googlemap.js', array('jquery'), $ver, true);
		wp_register_script( 'wc-shortcodes-googlemap-api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), $ver, true);
		wp_register_script( 'wc-shortcodes-skillbar', plugin_dir_url( __FILE__ ) . 'js/skillbar.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-fullwidth', plugin_dir_url( __FILE__ ) . 'js/fullwidth.js', array ( 'jquery' ), $ver, true );

		// Masonry
		wp_enqueue_script( 'jquery-masonry' );

		// images loaded
		wp_register_script( 'wordpresscanvas-imagesloaded', plugin_dir_url( __FILE__ ) . 'js/imagesloaded.pkgd.min.js', array (), '4.1.0', true );

		// slider
		wp_register_script( 'wordpresscanvas-rslides', plugin_dir_url( __FILE__ ) . 'js/responsiveslides.min.js', array ( 'jquery' ), '1.54', true );
		wp_register_style( 'wc-shortcodes-bxslider', plugin_dir_url( __FILE__ ) . 'vendors/bxslider/jquery.bxslider.min.css', array( ), '4.2.5' );
		wp_register_script( 'wc-shortcodes-bxslider', plugin_dir_url( __FILE__ ) . 'vendors/bxslider/jquery.bxslider.min.js', array ( 'jquery' ), '4.2.5', true );
		wp_register_script( 'wc-shortcodes-post-slider', plugin_dir_url( __FILE__ ) . 'js/post-slider.js', array ( 'jquery' ), $ver, true );

		// posts
		wp_register_script( 'wc-shortcodes-posts', plugin_dir_url( __FILE__ ) . 'js/posts.js', array ( 'jquery', 'wordpresscanvas-rslides', 'jquery-masonry', 'wordpresscanvas-imagesloaded' ), $ver, true );
		wp_register_script( 'wc-shortcodes-posts-grid', plugin_dir_url( __FILE__ ) . 'js/posts-grid.js', array ( 'jquery', 'wordpresscanvas-rslides' ), $ver, true );

		// countdown
		wp_register_script( 'wc-shortcodes-jquery-countdown-js', plugin_dir_url( __FILE__ ) . 'js/jquery.countdown.js', array ( 'jquery' ), $ver, true );
		wp_register_script( 'wc-shortcodes-countdown', plugin_dir_url( __FILE__ ) . 'js/countdown.js', array ( 'wc-shortcodes-jquery-countdown-js' ), $ver, true );

		// rsvp
		wp_register_script( 'wc-shortcodes-rsvp', plugin_dir_url( __FILE__ ) . 'js/rsvp.js', array ( 'jquery' ), $ver, true );

		$local = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'wc-shortcodes-rsvp', 'WCShortcodes', $local );
		wp_enqueue_script( 'wc-shortcodes-rsvp' );
	}
	add_action('wp_enqueue_scripts', 'wc_shortcodes_scripts');
endif;

if( ! function_exists('wc_shortcodes_scripts_override') ) :
	function wc_shortcodes_scripts_override() {
		
		if ( WC_SHORTCODES_FONT_AWESOME_ENABLED ) {
			wp_deregister_style( 'wordpresscanvas-font-awesome' );
			wp_register_style( 'wordpresscanvas-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array( ), '4.6.3' );
			wp_enqueue_style( 'wordpresscanvas-font-awesome' );
		}
		
		/* if ( ! wp_script_is( 'pinit', 'registered' ) ) {
			wp_register_script( 'pinit', '//assets.pinterest.com/js/pinit.js', array(), false, true);
		} */
	}
	add_action('wp_enqueue_scripts', 'wc_shortcodes_scripts_override', 9999 );
endif;

function wc_shortcodes_admin_enqueue_scripts( $hook ) {
	$ver = WC_SHORTCODES_VERSION;

	if ( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'widgets.php' ) {
		wp_enqueue_style( 'wc-shortcodes-admin-style', plugin_dir_url( __FILE__ ) . 'admin/css/wc-shortcodes.css', array( ), $ver );
		wp_enqueue_style( 'wc-shortcodes-post-slider-widget-style', plugin_dir_url( __FILE__ ) . 'admin/css/wcpostsliderwidget.css', array( ), $ver );
		wp_enqueue_script( 'wc-shortcodes-post-slider-widget', plugin_dir_url( __FILE__ ) . 'admin/js/wcpostsliderwidget.js', array ( 'jquery', 'jquery-ui-autocomplete', 'jquery-ui-accordion' ), $ver, true );
		wp_enqueue_script( 'wc-shortcodes', plugin_dir_url( __FILE__ ) . 'admin/js/wc-shortcodes.js', array ( 'jquery' ), $ver, true );
	}
}
add_action( 'admin_enqueue_scripts', 'wc_shortcodes_admin_enqueue_scripts' );
