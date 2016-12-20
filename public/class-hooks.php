<?php
class WPC_Shortcodes_Hooks extends WPC_Shortcodes_Vars {
	protected static $instance = null;
	protected $sanitize = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		add_filter( 'body_class', array( &$this, 'body_class' ) );
		add_filter( 'wc_shortcodes_social_link' , array( &$this, 'smart_social_link' ), 10, 2 );
		add_action( 'init', array( &$this, 'add_filters_for_custom_content' ) );
		add_action( 'wp', array( &$this, 'share_buttons_filters' ), 11 );
	}

	function body_class( $classes ) {
		if ( WC_SHORTCODES_FONT_AWESOME_ENABLED )
			$classes[] = 'wc-shortcodes-font-awesome-enabled';

		return $classes;
	}

	public function smart_social_link( $social_link, $name ) {
		switch ( $name ) {
			case 'email' :
				// some users may have already inserted mailto:, so let's remove it.
				if ( is_email( $social_link ) ) {
					$social_link = str_replace( 'mailto:', '', $social_link );
					$social_link = 'mailto:'.$social_link;
				}
				break;
			default :
				$social_link = esc_url( $social_link );
				break;
		}

		return $social_link;
	}
	
	public function add_filters_for_custom_content() {
		add_filter( 'wc_shortcodes_the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
		add_filter( 'wc_shortcodes_the_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
		add_filter( 'wc_shortcodes_the_content', 'wptexturize' );
		add_filter( 'wc_shortcodes_the_content', 'convert_smilies' );
		add_filter( 'wc_shortcodes_the_content', 'convert_chars' );
		add_filter( 'wc_shortcodes_the_content', 'wpautop' );
		add_filter( 'wc_shortcodes_the_content', 'shortcode_unautop' );
		add_filter( 'wc_shortcodes_the_content', 'prepend_attachment' );
		add_filter( 'wc_shortcodes_the_content', 'do_shortcode', 11 ); // AFTER wpautop()

		add_filter( 'wc_shortcodes_get_the_excerpt', 'wc_shortcodes_wp_trim_excerpt'  );

		add_filter( 'wc_shortcodes_the_excerpt', 'wptexturize' );
		add_filter( 'wc_shortcodes_the_excerpt', 'convert_smilies' );
		add_filter( 'wc_shortcodes_the_excerpt', 'convert_chars' );
		add_filter( 'wc_shortcodes_the_excerpt', 'wpautop' );
		add_filter( 'wc_shortcodes_the_excerpt', 'shortcode_unautop');
	}

	public function echo_share_buttons() {
		$share = do_shortcode( '[wc_share_buttons]' );

		if ( ! empty( $share ) ) {
			echo $share;
		}
	}
	
	public function display_share_buttons( $content ) {
		global $wp_current_filter;

		$display = false;

		if ( is_single() && 'post' == get_post_type() ) {
			$display = true;
		}
		else if ( ( is_home() || is_archive() ) && 'post' == get_post_type() ) {
			$display = true;
		}
		// Don't output flair on excerpts
		if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) {
			$display = false;
		}

		if ( ! $display ) {
			return $content;
		}

		$share = do_shortcode( '[wc_share_buttons]' );
		$share = apply_filters( 'wc_shortcodes_display_share_buttons', $share );

		if ( empty( $share ) ) {
			return $content;
		}

		$content .= $share;

		return $content;
	}

	function share_buttons_filters() {
		if ( parent::$theme_support[ 'share_buttons_filter_disable' ] ) {
			return;
		}

		$share_buttons_on_post_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_post_page' );
		$share_buttons_on_blog_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_blog_page' );
		$share_buttons_on_archive_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_archive_page' );
		$share_buttons_on_product_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_product_page' );

		if ( $share_buttons_on_post_page ) {
			if ( is_single() && 'post' == get_post_type() ) {
				add_filter( 'the_content', array( &$this, 'display_share_buttons' ), 38, 1 );
			}
		}

		if ( $share_buttons_on_blog_page ) {
			if ( is_home() ) {
				add_filter( 'the_content', array( &$this, 'display_share_buttons' ), 38, 1 );
				// add_filter( 'the_excerpt', 'wc_shortcodes_display_share_buttons', 38, 1 );
			}
		}

		if ( $share_buttons_on_archive_page ) {
			if ( is_category() || is_tag() || is_author() || is_date() ) {
				add_filter( 'the_content', array( &$this, 'display_share_buttons' ), 38, 1 );
				// add_filter( 'the_excerpt', 'wc_shortcodes_display_share_buttons', 38, 1 );
			}
		}

		if ( $share_buttons_on_product_page ) {
			add_action( 'woocommerce_single_product_summary', array( &$this, 'echo_share_buttons' ), 99 );
		}
	}
}
