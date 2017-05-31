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
		add_action( 'admin_head', array( &$this, 'localize_script' ) );
		add_action( 'admin_head', array( &$this, 'localize_script_for_collage' ) );
    }

    public function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		

		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array( &$this, 'add_plugin' ) );  
			add_filter( 'mce_buttons', array( &$this,'register_button' ) ); 
		}  
    }  

	function clean_content( $content ) {
		$p = array();

		$first = true;
		$i = 0;

		$content = str_replace( "\n\n\n", "\n\n", $content );
		$content = preg_replace( "/(\<\/[a-zA-Z0-9]+\>)\s*\n+/", "\\1\n\n", $content );
		$content = explode( "\n\n", $content );
		$size = sizeof( $content ) - 1;

		foreach ( $content as $line) {
			$line = trim( $line );
			if ( $line ) {
				if ( $first ) {
					$p[] = $line;
				}
				else if ( isset( $line[0] ) && ( '<' == $line[0] ) ) {
					$p[] = $line;
				}
				else if ( $i >= $size ) {
					$p[] = $line;
				}
				else {
					$p[] = '<p>' . $line . '</p>';
				}

				$first = false;
			}
			$i++;
		}
		$content = implode( '', $p );
		$content = str_replace( "\n", "<br />", $content );

		return $content;
	}

	function clean_title( $filename ) {
		$title = basename( $filename, '.txt' );
		$title = preg_replace( '/^\d+/', '', $title );
		$title = str_replace( '-', ' ', $title );
		$title = str_replace( '_', ' ', $title );
		$title = trim( $title );
		$title = ucwords( $title );

		return $title;
	}
	function find_templates( $template_path ) {
		if ( empty( $template_path ) ) {
			return null;
		}
		
		if ( ! is_string( $template_path ) ) {
			return null;
		}

		$templates = array();
		$i = 0;
		if ( is_dir( $template_path ) ) {
			foreach ( glob( $template_path . '*.txt' ) as $filename ) {
				$content = file_get_contents( $filename );
				$title = $this->clean_title( $filename );
				$templates[ $i ]['title'] = $title;
				$templates[ $i ]['content'] = $this->clean_content( $content );
				$i++;
			}
		}

		return $templates;
	}

	public function debug() {
		if ( ! empty( $templates ) && is_array( $templates ) ) { 
			foreach( $templates as $key => $template ) {
				pr( htmlentities( $templates[ $key ]['content'] ) );
			}
		}
		die();
	}

	public function localize_script_for_collage() {
		?>
		<?php if (  WC_SHORTCODES_COLLAGE_POST_TYPE_ENABLED ) : ?>
			<script type="text/javascript">
				var wpc_shortcodes_collage_enabled = true;
			</script>
		<?php endif; ?>
		<?php
	}

	public function localize_script() {
		$template_path = apply_filters( 'wpc_shortcodes_template_path', null );

		if ( empty( $template_path ) ) {
			return;
		}

		$templates = $this->find_templates( $template_path );

		?>
		<?php if ( ! empty( $templates ) ) : ?>
			<script type="text/javascript">
				var wpc_shortcodes_template_buttons = <?php echo json_encode( $templates ); ?>;
			</script>
		<?php endif; ?>
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
