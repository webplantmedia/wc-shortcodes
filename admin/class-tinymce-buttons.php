<?php
class WPC_Shortcodes_TinyMCE_Buttons {
	protected static $instance = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
    	add_action( 'admin_head', array( &$this,'init' ) );
		// add_action( 'admin_head', array( &$this, 'localize_script' ) );
    }

    public function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		

		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array( &$this, 'add_plugin' ) );  
			add_filter( 'mce_buttons', array( &$this,'register_button' ) ); 
		}  
    }  

	public function localize_script() {
		global $wc_shortcodes_theme_support;

		?>
		<script type="text/javascript">
			var wpc_shortcodes = <?php echo json_encode( $wc_shortcodes_theme_support ); ?>;
		</script>
		<?php
	}

	public function add_plugin($plugin_array) {  
		global $wp_version;
		$ver = WC_SHORTCODES_VERSION;

		// version 3.9 updated to tinymce 4.0
		if ( version_compare( $wp_version, '3.9', '>=' ) ) {
			$plugin_array['wpc_shortcodes'] = WC_SHORTCODES_PLUGIN_URL .'admin/assets/js/shortcodes-tinymce-4.js?ver=' . $ver;
		}
		else {
			$plugin_array['wpc_shortcodes'] = WC_SHORTCODES_PLUGIN_URL .'admin/assets/js/shortcodes_tinymce.js?ver=' . $ver;
			$plugin_array['wpc_font_awesome'] = WC_SHORTCODES_PLUGIN_URL .'admin/assets/js/font_awesome_tinymce.js?ver=' . $ver;
		}
		return $plugin_array; 
	}

	public function register_button($buttons) {  
		array_push($buttons, "wpc_shortcodes_button");
		
		return $buttons; 
	}
}
