<?php
class WPC_Shortcodes_Register extends WPC_Shortcodes_Vars {
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
		add_filter( 'the_content', array( &$this, 'pre_process' ), 7 );
		add_filter( 'wc_shortcodes_the_content', array( &$this, 'pre_process' ), 7 );
		add_action( 'wc_shortcodes_add_preprocess', array( &$this, 'add_preprocess' ) );
		add_shortcode( 'wc_html', array( &$this, 'displayhtml' ) );
		add_shortcode( 'wc_pre' , array( &$this, 'displaypre' ) );
		add_shortcode( 'wc_clear_floats', array( &$this, 'clear_floats' ) );
		add_shortcode( 'wc_skillbar', array( &$this, 'skillbar' ) );
		add_shortcode( 'wc_spacing', array( &$this, 'spacing' ) );
		add_shortcode( 'wc_social_icons', array( &$this, 'social_icons' ) );
		add_shortcode( 'wc_highlight', array( &$this, 'highlight' ) );
		add_shortcode( 'wc_button', array( &$this, 'button' ) );
		add_shortcode( 'wc_heading', array( &$this, 'heading' ) );
		add_shortcode( 'wc_googlemap', array( &$this, 'googlemap' ) );
		add_shortcode( 'wc_divider', array( &$this, 'divider' ) );
		add_shortcode( 'wc_countdown', array( &$this, 'countdown' ) );
		add_shortcode( 'wc_rsvp', array( &$this, 'rsvp' ) );
		add_shortcode( 'wc_posts', array( &$this, 'posts' ) );
		add_shortcode( 'wc_post_slider', array( &$this, 'post_slider' ) );
		add_shortcode( 'wc_image', array( &$this, 'image' ) );
		add_shortcode( 'wc_fa', array( &$this, 'fa' ) );
		add_shortcode( 'wc_share', array( &$this, 'share_buttons' ) );
		add_shortcode( 'wc_share_buttons', array( &$this, 'get_share_buttons' ) );
		// Allow shortcodes in widgets.
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Allow shortcodes to be executed before they go
	 * go through all of Wordpress' filters.
	 *
	 * @since 3.6.1
	 * @access public
	 *
	 * @param mixed $content
	 * @return void
	 */
	public function pre_process($content) {
		global $shortcode_tags;

		// Backup current registered shortcodes and clear them all out
		$orig_shortcode_tags = $shortcode_tags;
		$shortcode_tags = array();

		do_action( 'wc_shortcodes_add_preprocess' );

		// Do the shortcode (only the one above is registered)
		$content = do_shortcode($content);
	 
		// Put the original shortcodes back
		$shortcode_tags = $orig_shortcode_tags;
	 
		return $content;
	}

	/**
	 * Add all preprocessed shortcodes here
	 *
	 * @since 3.6.1
	 * @access public
	 *
	 * @return void
	 */
	public function add_preprocess() {
		add_shortcode( 'wc_fullwidth' , array( &$this, 'fullwidth' ) );
		add_shortcode( 'wc_column', array( &$this, 'column' ) );
		add_shortcode( 'wc_row', array( &$this, 'row' ) );
		add_shortcode( 'wc_center', array( &$this, 'center' ) );
		add_shortcode( 'wc_toggle', array( &$this, 'toggle' ) );
		add_shortcode( 'wc_accordion', array( &$this, 'accordion_main' ) );
		add_shortcode( 'wc_accordion_section', array( &$this, 'accordion_section' ) );
		add_shortcode( 'wc_tabgroup', array( &$this, 'tabgroup' ) );
		add_shortcode( 'wc_tab', array( &$this, 'tab' ) );
		add_shortcode( 'wc_testimonial', array( &$this, 'testimonial' ) );
		add_shortcode( 'wc_box', array( &$this, 'box' ) );
		add_shortcode( 'wc_pricing', array( &$this, 'pricing' ) );
		add_shortcode( 'wc_code' , array( &$this, 'displaycode' ) );
	}

	/**
	 * @since 3.6
	 * @access public
	 *
	 * @param array $atts 
	 * @param string $content 
	 * @return void
	 */
	public function fullwidth( $atts, $content = null ) {

		$atts = shortcode_atts( parent::$attr->fullwidth, $atts );
		$atts = WPC_Shortcodes_Sanitize::fullwidth_attr( $atts );

		if ( empty( $atts['selector'] ) ) {
			$atts['selector'] = parent::$theme_support[ 'fullwidth_container' ];
		}

		wp_enqueue_script('wc-shortcodes-fullwidth');

		return '<div class="wc-shortcodes-full-width wc-shortcodes-content" data-selector="' . esc_attr( $atts['selector'] ) . '">' . do_shortcode( $content ) . '</div>';
	}


	/**
	 * Easily Display HTML in post
	 * 
	 * @param mixed $atts 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	public function displayhtml( $atts, $content = null ) {
		global $post;
		$html = '';

		if ( $content != null )
			return $content;

		$atts = shortcode_atts( parent::$attr->html, $atts );
		$atts = WPC_Shortcodes_Sanitize::html_attr( $atts );

		if ( empty( $atts['name'] ) )
			return null;

		if ( $snippet = get_post_meta($post->ID, $atts['name'], true ) ) {
			$html = '<div class="wc-shortcodes-html-wrapper wc-shortcodes-item wc-shortcodes-content">' . $snippet . '</div>';
		}

		return $html;
	}


	/**
	 * @param mixed $atts 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	public function displaycode( $atts, $content = null ) {
		return '<code>'.$content.'</code>';
	}

	/**
	 * @param mixed $atts 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	public function displaypre( $atts, $content = null ) {
		global $post;
		$html = '';
		static $instance = 0;
		$instance++;

		if ( $content != null )
			return $content;

		$atts = shortcode_atts( parent::$attr->pre, $atts );
		$atts = WPC_Shortcodes_Sanitize::pre_attr( $atts );

		$class = array();
		if ( $atts['color'] ) {
			$class[] = 'prettyprint';
			if ( $atts['linenums'] )
				$class[] = 'linenums';
			if ( ! empty( $atts['lang'] ) )
				$class[] = 'lang-' . $atts['lang'];
		}
		if ( $atts['scrollable'] )
			$class[] = 'pre-scrollable';
		if ( $atts['wrap'] )
			$class[] = 'pre-wrap';

		$class = implode( ' ', $class );

		if ( empty( $atts['name'] ) )
			return null;

		if ( $code = get_post_meta($post->ID, $atts['name'], true ) ) {
			wp_enqueue_script('wc-shortcodes-prettify');
			wp_enqueue_script('wc-shortcodes-pre');
			//$code = preg_replace( '/[ ]{4,}|[\t]/', '  ', $code );
			$html .= '<pre id="prettycode-'.$instance.'" class="'.esc_attr( $class ).'">';
			$html .= htmlspecialchars( $code );
			$html .= '</pre>';
		}

		return $html;
	}


	/*
	 * Clear Floats
	 * @since v1.0
	 */
	public function clear_floats() {
	   return '<div class="wc-shortcodes-clear-floats"></div>';
	}


	/*
	 * Skillbars
	 * @since v1.3
	 */
	public function skillbar( $atts  ) {
		$atts = shortcode_atts( parent::$attr->skillbar, $atts );
		$atts = WPC_Shortcodes_Sanitize::skillbar_attr( $atts );

		// Enque scripts
		wp_enqueue_script('wc-shortcodes-skillbar');
		
		// Display the accordion	';
		$output = '<div class="wc-shortcodes-skillbar wc-shortcodes-item wc-shortcodes-clearfix '. esc_attr( $atts['class'] ) .'" data-percent="'. esc_attr( $atts['percentage'] ) .'%">';
			if ( $atts['title'] !== '' ) $output .= '<div class="wc-shortcodes-skillbar-title" style="background: '. esc_attr( $atts['color'] ) .';"><span>'. esc_html( $atts['title'] ) .'</span></div>';
			$output .= '<div class="wc-shortcodes-skillbar-bar" style="background: '. esc_attr( $atts['color'] ) .';"></div>';
			if ( $atts['show_percent'] ) {
				$output .= '<div class="wc-shortcodes-skill-bar-percent">'.$atts['percentage'].'%</div>';
			}
		$output .= '</div>';
		
		return $output;
	}


	/*
	 * Spacing
	 * @since v1.0
	 */
	public function spacing( $atts ) {
		$atts = shortcode_atts( parent::$attr->spacing, $atts );
		$atts = WPC_Shortcodes_Sanitize::spacing_attr( $atts );

		return '<hr class="wc-shortcodes-spacing '. esc_attr( $atts['class'] ) .'" style="height: '. esc_attr( $atts['size'] ) .'" />';
	}


	/**
	* Social Icons
	* @since 1.0
	*/
	public function social_icons( $atts ){
		//deprecated value
		$size_is_set = false;
		$align_is_set = false;

		if ( isset( $atts['size'] ) && ! empty( $atts['size'] ) ) {
			$size_is_set = true;
		}

		if ( isset( $atts['align'] ) && ! empty( $atts['align'] ) ) {
			$align_is_set = true;
		}

		$atts = shortcode_atts( parent::$attr->social_icons, $atts );
		$atts = WPC_Shortcodes_Sanitize::social_icons_attr( $atts );

		if ( $size_is_set ) {
			switch ( $atts['size'] ) {
				case 'small' :
					$atts['maxheight'] = 16;
					break;
				case 'medium' :
					$atts['maxheight'] = 24;
					break;
				case 'large' :
					$atts['maxheight'] = 48;
					break;
			}
		}

		if ( $align_is_set ) {
			switch ( $atts['align'] ) {
				case 'left' :
					$atts['columns'] = 'float-left';
					break;
				case 'center' :
					$atts['columns'] = 'float-center';
					break;
				case 'right' :
					$atts['columns'] = 'float-right';
					break;
			}
		}

		$order = get_option( WC_SHORTCODES_PREFIX . 'social_icons_display' );

		if ( 'default' == $atts['format'] ) {
			$atts['format'] = get_option( WC_SHORTCODES_PREFIX . 'social_icons_format', 'icon' );
		}

		$show_image = 'image' == $atts['format'] ? true : false;

		if ( ! is_array( $order ) || empty( $order ) ) {
			return;
		}

		$first = true;

		$column_display = false;
		if ( is_numeric( $atts['columns'] ) & (int) $atts['columns'] > 0 ) {
			$column_display = true;
		}

		$classes = array();
		$classes[] = 'wc-shortcodes-social-icons';
		$classes[] = 'wc-shortcodes-clearfix';
		$classes[] = 'wc-shortcodes-columns-'.$atts['columns'];
		$classes[] = 'wc-shortcodes-maxheight-'.$atts['maxheight'];
		$classes[] = 'wc-shortcodes-social-icons-format-'.$atts['format'];

		if ( ! empty( $atts['class'] ) ) {
			$atts['class'] = ' ' . $atts['class'];
		}

		$html = '<div class="wc-shortcodes-social-icons-wrapper'.$atts['class'].'">';
			$html .= '<ul class="'.implode( ' ', $classes ).'">';
				$i = 0;
				foreach ($order as $key => $name) {
					$li_class = array();
					$li_class[] = 'wc-shortcodes-social-icon';
					$li_class[] = 'wc-shortcode-social-icon-' . $key;

					if ( $column_display && $i % $atts['columns'] == 0 ) {
						$li_class[] = 'clear-left';
					}

					$link_option_name = WC_SHORTCODES_PREFIX . $key . '_link';
					$image_icon_option_name = WC_SHORTCODES_PREFIX . $key . '_icon';
					$font_icon_option_name = WC_SHORTCODES_PREFIX . $key . '_font_icon';

					$social_link = get_option( $link_option_name );
					$social_link = apply_filters( 'wc_shortcodes_social_link', $social_link, $key );

					$first_class = $first ? ' first-icon' : '';
					$first = false;

					if ( $show_image ) {
						$icon_url = get_option( $image_icon_option_name );

						$html .= '<li class="wc-shortcodes-social-icon wc-shortcode-social-icon-' . esc_attr( $key . $first_class ) . '">';
							$html .='<a target="_blank" href="'.esc_url( $social_link ).'">';
								$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $name ).'">';
							$html .= '</a>';
						$html .= '</li>';
					}
					else {
						$icon_class = get_option( $font_icon_option_name );

						$html .= '<li class="wc-shortcodes-social-icon wc-shortcode-social-icon-' . esc_attr( $key . $first_class ) . '">';
							$html .='<a target="_blank" href="'.esc_url( $social_link ).'">';
								$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
							$html .= '</a>';
						$html .= '</li>';
					}
				}
			$html .= '</ul>';
		$html .= '</div>';

		return $html;
	}

	/**
	* Highlights
	* @since 1.0
	*/
	public function highlight( $atts, $content = null ) {
		$atts = shortcode_atts( parent::$attr->highlight, $atts );
		$atts = WPC_Shortcodes_Sanitize::highlight_attr( $atts );

		return '<span class="wc-shortcodes-highlight wc-shortcodes-highlight-'. esc_attr( $atts['color'] ) .' '. esc_attr( $atts['class'] ) .'">' . do_shortcode( $content ) . '</span>';
	}


	/*
	 * Buttons
	 * @since v1.0
	 */
	public function button( $atts, $content = null ) {
		$atts = shortcode_atts( parent::$attr->button, $atts );
		$atts = WPC_Shortcodes_Sanitize::button_attr( $atts );

		$url_rel = ! empty( $atts['rel'] ) ? ' rel="'.esc_attr( $atts['rel'] ).'"' : '';
		$url_target = ! empty( $atts['target'] ) ? ' target="_'.esc_attr( $atts['target'] ).'"' : '';

		$atts['type'] = 'wc-shortcodes-button-' . $atts['type'];
		
		$class = array();
		$class[] = 'wc-shortcodes-button';
		$class[] = $atts['type'];
		$class[] = 'wc-shortcodes-button-position-' . $atts['position'];
		if ( ! empty( $atts['class'] ) ) {
			$class[] = $atts['class'];
		}
		
		$button = null;
		$button .= '<a href="' . esc_url( $atts['url'] ) . '" class="'.esc_attr( implode( ' ', $class ) ).'"'.$url_rel.$url_target.' title="'. esc_attr( $atts['title'] ) .'">';
			$button .= '<span class="wc-shortcodes-button-inner">';
			if ( $atts['icon_left'] ) {
				$button .= '<span class="wc-shortcodes-button-icon-left fa fa-'. esc_attr( $atts['icon_left'] ) .'"></span>';
			}
			$button .= $content;
			if ( $atts['icon_right'] ) {
				$button .= '<span class="wc-shortcodes-button-icon-right fa fa-'. esc_attr( $atts['icon_right'] ) .'"></span>';
			}
			$button .= '</span>';			
		$button .= '</a>';

		if ( ! empty( $atts['position'] ) ) {
			$button = '<div class="wc-shortcodes-item wc-shortcodes-button-'.$atts['position'].'">'. $button .'</div>';
		}

		return $button;
	}



	/*
	 * Boxes
	 * @since v1.0
	 *
	 */
	public function box( $atts, $content = null ) {
		$atts = shortcode_atts( parent::$attr->box, $atts );
		$atts = WPC_Shortcodes_Sanitize::box_attr( $atts );

		$style_attr = '';

		if( $atts['margin_bottom'] ) {
			$style_attr .= 'margin-bottom: '. $atts['margin_bottom'] .';';
		}
		if ( $atts['margin_top'] ) {
			$style_attr .= 'margin-top: '. $atts['margin_top'] .';';
		}

		$alert_content = '<div class="wc-shortcodes-box wc-shortcodes-item wc-shortcodes-content wc-shortcodes-clearfix wc-shortcodes-box-' . esc_attr( $atts['color'] ) . ' '. esc_attr( $atts['class'] ) .'" style="text-align:'. esc_attr( $atts['text_align'] ) .';'. esc_attr( $style_attr ) .'">';

		$alert_content .= ' '. do_shortcode($content) .'</div>';

		return $alert_content;
	}



	/*
	 * Testimonial
	 * @since v1.0
	 *
	 */
	public function testimonial( $atts, $content = null  ) {
		$atts = shortcode_atts( parent::$attr->testimonial, $atts );
		$atts = WPC_Shortcodes_Sanitize::testimonial_attr( $atts );

		if ( ! empty( $atts['url'] ) ) {
			$atts['by'] = '<a href="' . esc_url( $atts['url'] ) . '">' . $atts['by'] . '</a>';
		}

		$testimonial_content = '';
		$testimonial_content .= '<div class="wc-shortcodes-testimonial wc-shortcodes-item wc-shortcodes-clearfix wc-shortcodes-testimonial-'.esc_attr( $atts['position'] ).' '. esc_attr( $atts['class'] ) .'"><div class="wc-shortcodes-testimonial-content wc-shortcodes-content">';
		$testimonial_content .= $content;
		$testimonial_content .= '</div><div class="wc-shortcodes-testimonial-author">';
		$testimonial_content .= $atts['by'] .'</div></div>';	

		return $testimonial_content;
	}



	/*
	 * Center
	 * @since v1.0
	 *
	 */
	public function center( $atts, $content = null ){
		$atts = shortcode_atts( parent::$attr->center, $atts );
		$atts = WPC_Shortcodes_Sanitize::center_attr( $atts );

		// $append_clearfix = '<div class="wc-shortcodes-clear-floats"></div>';
		$style = empty( $atts['max_width'] ) ? '' : ' style="max-width:'.esc_attr( $atts['max_width'] ).';"';

		return '<div class="wc-shortcodes-center wc-shortcodes-item wc-shortcodes-content wc-shortcodes-clearfix wc-shortcodes-center-inner-align-'. esc_attr( $atts['text_align'] ) .' '. esc_attr( $atts['class'] ) .'"' . $style . '>' . do_shortcode($content) . '</div>';
	}



	/*
	 * Columns
	 * @since v1.0
	 *
	 */
	public function column( $atts, $content = null ){
		$atts = shortcode_atts( parent::$attr->column, $atts );
		$atts = WPC_Shortcodes_Sanitize::column_attr( $atts );

		$style = '';
		if ( $atts['text_align'] ) {
			if ( 'left' == $atts['text_align'] )
				$style = ' style="text-align: '.esc_attr( $atts['text_align'] ).';"';
			if ( 'center' == $atts['text_align'] )
				$style = ' style="text-align: '.esc_attr( $atts['text_align'] ).';"';
			if ( 'right' == $atts['text_align'] )
				$style = ' style="text-align: '.esc_attr( $atts['text_align'] ).';"';
		}

		$append_clearfix = 'last' == $atts['position'] ? '<div class="wc-shortcodes-clear-floats"></div>' : '';

		return '<div'.$style.' class="wc-shortcodes-column wc-shortcodes-content wc-shortcodes-' . esc_attr( $atts['size'] ) . ' wc-shortcodes-column-'.esc_attr( $atts['position'] ).' '. esc_attr( $atts['class'] ) .'">' . do_shortcode($content) . '</div>';
	}




	/*
	 * Rows
	 * @since v1.0
	 *
	 */
	public function row( $atts, $content = null ){
		return '<div class="wc-shortcodes-row wc-shortcodes-item wc-shortcodes-clearfix">' . do_shortcode($content) . '</div>';
	}



	/*
	 * Toggle
	 * @since v1.0
	 */
	public function toggle( $atts, $content = null ) {
		$atts = shortcode_atts( parent::$attr->toggle, $atts );
		$atts = WPC_Shortcodes_Sanitize::toggle_attr( $atts );

		$classes = array();

		$classes[] = 'wc-shortcodes-toggle';
		$classes[] = 'wc-shortcodes-item';

		if ( ! empty( $atts['class'] ) )
			$classes[] = $atts['class'];

		if ( ! empty( $atts['layout'] ) )
			$classes[] = 'wc-shortcodes-toggle-layout-' . $atts['layout'];

		$class = implode( ' ', $classes );

		$style = array();

		if ( ! empty( $atts['padding'] ) || '0' === $atts['padding'] )
			$style[] = 'padding:'.$atts['padding'];
		if ( ! empty( $atts['border_width'] ) || '0' === $atts['border_width'] )
			$style[] = 'border-width:'.$atts['border_width'];

		$style = implode( ';', $style );
		 
		// Enque scripts
		wp_enqueue_script('wc-shortcodes-toggle');
		
		// Display the Toggle
		return '<div class="'. esc_attr( $class ) .'"><div class="wc-shortcodes-toggle-trigger"><a href="#">'. esc_html( $atts['title'] ) .'</a></div><div style="'.esc_attr( $style ).'" class="wc-shortcodes-toggle-container wc-shortcodes-content">' . do_shortcode($content) . '</div></div>';
	}


	/*
	 * Accordion
	 * @since v1.0
	 *
	 */

	// Main
	public function accordion_main( $atts, $content = null  ) {
		
		$atts = shortcode_atts( parent::$attr->accordion_main, $atts );
		$atts = WPC_Shortcodes_Sanitize::accordion_main_attr( $atts );

		$classes = array();

		$classes[] = 'wc-shortcodes-accordion';
		$classes[] = 'wc-shortcodes-item';

		$behavior = 'autoclose';
		if ( $atts['leaveopen'] ) {
			$behavior = 'leaveopen';
		}

		$state = 'default';
		if ( $atts['collapse'] ) {
			$classes[] = 'wc-shortcodes-accordion-collapse';
			$state = 'collapse';
		}
		else {
			$classes[] = 'wc-shortcodes-accordion-default';
		}

		if ( ! empty( $atts['class'] ) )
			$classes[] = $class;

		if ( ! empty( $atts['layout'] ) )
			$classes[] = 'wc-shortcodes-accordion-layout-' . $atts['layout'];

		$class = implode( ' ', $classes );

		// Enque scripts
		wp_enqueue_script('wc-shortcodes-accordion');
		
		// Display the accordion	
		return '<div class="'. esc_attr( $class ) .'" data-behavior="'.esc_attr( $behavior ).'" data-start-state="'.esc_attr( $state ).'">' . do_shortcode($content) . '</div>';
	}


	// Section
	public function accordion_section( $atts, $content = null  ) {
		$atts = shortcode_atts( parent::$attr->accordion_section, $atts );
		$atts = WPC_Shortcodes_Sanitize::accordion_section_attr( $atts );

		return '<div class="wc-shortcodes-accordion-trigger '. esc_attr( $atts['class'] ) .'"><a href="#">'. esc_html( $atts['title'] ) .'</a></div><div class="wc-shortcodes-accordion-content wc-shortcodes-content">' . do_shortcode($content) . '</div>';
	}
		


	/*
	 * Tabs
	 * @since v1.0
	 *
	 */
	public function tabgroup( $atts, $content = null ) {
		static $instance = 0;
		$instance++;
		
		//Enque scripts
		wp_enqueue_script('wc-shortcodes-tabs');
		
		// Display Tabs
		$atts = shortcode_atts( parent::$attr->tabgroup, $atts );
		$atts = WPC_Shortcodes_Sanitize::tabgroup_attr( $atts );

		$classes = array();

		$classes[] = 'wc-shortcodes-tabs';
		$classes[] = 'wc-shortcodes-item';

		if ( ! empty( $atts['class'] ) )
			$classes[] = $atts['class'];

		if ( ! empty( $atts['layout'] ) )
			$classes[] = 'wc-shortcodes-tabs-layout-' . $atts['layout'];

		$class = implode( ' ', $classes );

		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
		if( count($tab_titles) ){
			$output .= '<div id="wc-shortcodes-tab-'. esc_attr( $instance ) .'" class="'.esc_attr( $class ).'">';
			$output .= '<ul class="wcs-tabs-nav wc-shortcodes-clearfix">';
			$i = 0;
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#" data-index="'.$i++.'" data-id="#wc-shortcodes-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
			$output .= '</ul>';
			$output .= do_shortcode( $content );
			$output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		return $output;
	}

	public function tab( $atts, $content = null ) {
		$atts = shortcode_atts( parent::$attr->tab, $atts );
		$atts = WPC_Shortcodes_Sanitize::tab_attr( $atts );

		$classes = array();

		$classes[] = 'tab-content';
		$classes[] = 'wc-shortcodes-content';

		$class = implode( ' ', $classes );

		return '<div id="wc-shortcodes-tab-'. sanitize_title( $atts['title'] ) .'" class="'. esc_attr( $class ) .'">'. do_shortcode( $content ) .'</div>';
	}




	/*
	 * Pricing Table
	 * @since v1.0
	 *
	 */
	/*section*/
	public function pricing( $atts, $content = null  ) {
		$atts = shortcode_atts( parent::$attr->pricing, $atts );
		$atts = WPC_Shortcodes_Sanitize::pricing_attr( $atts );
		
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="wc-shortcodes-pricing wc-shortcodes-pricing-type-'. esc_attr( $atts['type'] ) .' '. esc_attr( $atts['class'] ) .'">';
			$pricing_content .= '<div class="wc-shortcodes-pricing-header">';
				$pricing_content .= '<h5>'. esc_html( $atts['plan'] ). '</h5>';
				$pricing_content .= '<div class="wc-shortcodes-pricing-cost">'. esc_html( $atts['cost'] ) .'</div><div class="wc-shortcodes-pricing-per">'. esc_html( $atts['per'] ) .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="wc-shortcodes-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $atts['button_url'] ) {
				$pricing_content .= '<div class="wc-shortcodes-pricing-button"><a href="'. esc_url( $atts['button_url'] ) .'" class="wc-shortcodes-button wc-shortcodes-button-'.esc_attr( $atts['type'] ).'" target="_'. esc_attr( $atts['button_target'] ) .'" rel="'. esc_attr( $atts['button_rel'] ) .'"><span class="wc-shortcodes-button-inner">'. esc_html( $atts['button_text'] ) .'</span></a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
		


	/*
	 * Heading
	 * @since v1.1
	 */
	public function heading( $atts ) {
		$atts = shortcode_atts( parent::$attr->heading, $atts );
		$atts = WPC_Shortcodes_Sanitize::heading_attr( $atts );
		
		$style_attr = '';

		if ( $atts['font_size'] ) {
			$style_attr .= 'font-size: '. $atts['font_size'] .';';
		}
		if ( $atts['color'] ) {
			$style_attr .= 'color: '. $atts['color'] .';';
		}
		if( $atts['margin_bottom'] ) {
			$style_attr .= 'margin-bottom: '. $atts['margin_bottom'] .';';
		}
		if ( $atts['margin_top'] ) {
			$style_attr .= 'margin-top: '. $atts['margin_top'] .';';
		}
		
		if ( $atts['text_align'] ) {
			$text_align = 'text-align-'. $atts['text_align'];
		} else {
			$text_align = 'text-align-left';
		}
		
		if ( 'h1' == $atts['type'] ) {
			$atts['class'] = trim( 'entry-title ' . $atts['class'] );
		}

		$output = '<'.$atts['type'].' class="wc-shortcodes-heading '. esc_attr( $text_align ) .' '. esc_attr( $atts['class'] ) .'" style="'.esc_attr( $style_attr ).'"><span>';

		if ( $atts['icon_left'] )
			$output .= '<i class="wc-shortcodes-button-icon-left fa fa-'. esc_attr( $atts['icon_left'] ) .'" style="margin-right:'.esc_attr( $atts['icon_spacing'] ).'"></i>';

		$output .= esc_html( $atts['title'] );

		if ( $atts['icon_right'] )
			$output .= '<i class="wc-shortcodes-button-icon-right fa fa-'. esc_attr( $atts['icon_right'] ) .'" style="margin-left:'.esc_attr( $atts['icon_spacing'] ).'"></i>';

		$output .= '</span></'.$atts['type'].'>';

		if ( 'h1' == $atts['type'] )
			$output = '<header class="entry-header">'. $output . '</header>';
		
		return $output;
	}


	/*
	 * Google Maps
	 * @since v1.1
	 */
	public function googlemap($atts, $content = null) {
		static $instance = 0;
		$instance++;

		if ( empty( parent::$google_maps_api_key ) ) {
			return '<div class="wc-shortcodes-googlemap-api-key-needed"><p>Google requires an <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">API key</a> to embed Google Maps. Enter your key in your <a href="' . parent::$plugin_settings_url . '&wpcsf_active_tab=wc-shortcodes-options-google-maps-options-tab" target="_blank">Shortcodes option</a> page under the "Maps" tab.</p></div>';
		}

		$atts = shortcode_atts( parent::$attr->googlemap, $atts );
		$atts = WPC_Shortcodes_Sanitize::googlemap_attr( $atts );
		
		// load scripts
		wp_enqueue_script('wc-shortcodes-googlemap');
		
		$class = array();
		$class[] = 'googlemap';
		$class[] = 'wc-shortcodes-item';
		
		$output = '<div id="map_canvas_'.$instance.'" class="' . esc_attr( implode( ' ', $class ) ) . '" style="height:'.$atts['height'].';width:100%">';
			$output .= (!empty($atts['title'])) ? '<input class="title" type="hidden" value="'.esc_html( $atts['title'] ).'" />' : '';
			$output .= '<input class="location" type="hidden" value="'.esc_attr( $atts['location'] ).'" />';
			$output .= '<input class="zoom" type="hidden" value="'.$atts['zoom'].'" />';
			$output .= '<input class="title-on-load" type="hidden" value="'.$atts['title_on_load'].'" />';
			$output .= '<div class="map_canvas"></div>';
		$output .= '</div>';
		
		return $output;
	}


	/*
	 * Divider
	 * @since v1.1
	 */
	public function divider( $atts ) {
		$atts = shortcode_atts( parent::$attr->divider, $atts );
		$atts = WPC_Shortcodes_Sanitize::divider_attr( $atts );

		$style_attr = array();

		if( $atts['margin_bottom'] ) {
			$style_attr[] = 'margin-bottom: '. $atts['margin_bottom'] .';';
		}
		if ( $atts['margin_top'] ) {
			$style_attr[] = 'margin-top: '. $atts['margin_top'] .';';
		}

		if ( ! empty ( $style_attr ) ) {
			$style_attr = 'style="' . esc_attr( implode( '', $style_attr ) ) . '"';
		}
		else {
			$style_attr = '';
		}

		return '<hr class="wc-shortcodes-divider wc-shortcodes-item wc-shortcodes-divider-line-'.esc_attr( $atts['line'] ).' wc-shortcodes-divider-style-'. esc_attr( $atts['style'] ) .' '. esc_attr( $atts['class'] ) .'" '.$style_attr.' />';
	}


	/*
	 * Countdown
	 * @since v1.10
	 */
	public function countdown( $atts ) {
		$atts = shortcode_atts( parent::$attr->countdown, $atts );
		$atts = WPC_Shortcodes_Sanitize::countdown_attr( $atts );

		if ( empty( $atts['date'] ) ) {
			return '<p>*Please enter a date for your countdown*</p>';
		}

		wp_enqueue_script('wc-shortcodes-countdown');

		$html = '<div class="wc-shortcodes-countdown" data-labels="'.esc_attr($atts['labels']).'" data-labels1="'.esc_attr($atts['labels1']).'" data-date="'.esc_attr( $atts['date'] ).'" data-format="'.esc_attr( $atts['format'] ).'" data-message="'.esc_attr( $atts['message'] ).'"></div>';
		$html = '<div class="wc-shortcodes-countdown-bg1">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg2">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg3">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg4">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-item">'.$html.'</div>';

		return $html;
	}



	public function rsvp( $atts ) {
		$atts = shortcode_atts( parent::$attr->rsvp, $atts );
		$atts = WPC_Shortcodes_Sanitize::rsvp_attr( $atts );

		wp_enqueue_script('wc-shortcodes-rsvp');

		$html = '';

		// RSVP Name
		$name_title = get_option( WC_SHORTCODES_PREFIX . 'rsvp_name_title' );
		$name_html = '<p class="rsvp-name-wrapper"><span>'.esc_html($name_title).'</span><br /><input name="rsvp_name" class="rsvp-name rsvp-data" type="text" value="" /></p>';

		// RSVP Number
		$number_title = get_option( WC_SHORTCODES_PREFIX . 'rsvp_number_title' );
		$number_options = get_option( WC_SHORTCODES_PREFIX . 'rsvp_number_options' );
		$number_options = explode( "\n", $number_options );
		$options = '';
		foreach ( $number_options as $o ) {
			$o = trim( $o );
			if ( empty( $o ) )
				continue;

			$options .= '<option value="'.esc_attr( $o ).'">'.esc_html( $o ).'</option>';
		}
		$options = '<select name="rsvp_number" class="rsvp-number rsvp-data">'.$options.'</select>';
		$number_html = '<p class="rsvp-number-wrapper"><span>'.esc_html( $number_title ).'</span><br />'.$options.'</p>';

		// RSVP Event
		$event_title = get_option( WC_SHORTCODES_PREFIX . 'rsvp_event_title' );
		$event_options = get_option( WC_SHORTCODES_PREFIX . 'rsvp_event_options' );
		$event_options = explode( "\n", $event_options );
		$options = '';
		foreach ( $event_options as $o ) {
			$o = trim( $o );
			if ( empty( $o ) )
				continue;

			$options .= '<option value="'.esc_attr( $o ).'">'.esc_html( $o ).'</option>';
		}
		$options = '<select name="rsvp_event" class="rsvp-event rsvp-data">'.$options.'</select>';
		$event_html = '<p class="rsvp-event-options"><span>'.esc_html( $event_title ).'</span><br />'.$options.'</p>';

		// RSVP Button
		$button_title = get_option( WC_SHORTCODES_PREFIX . 'rsvp_button_title' );
		$button_html = '<p class="rsvp-button-wrapper"><input name="rsvp_button" class="rsvp-button" type="button" value="'.esc_attr( $button_title ).'" /></p>';

		// RSVP Action
		$action_html = '<input name="action" class="rsvp-action rsvp-data" type="hidden" value="wc-send-rsvp-email">';

		// RSVP Message
		$message_html = '<div class="wc-shortcodes-box wc-shortcodes-item wc-shortcodes-content wc-shortcodes-clearfix wc-shortcodes-box-info"><p class="rsvp-message">Hello</p></div>';

		// Style

		if ( 3 == $atts['columns'] ) {
			$html .= '<div class="wc-shortcodes-row wc-shortcodes-item wc-shortcodes-clearfix">';
			$html .= '	<div class="wc-shortcodes-column wc-shortcodes-one-third wc-shortcodes-column-first ">'.$name_html.'</div>';
			$html .= '	<div class="wc-shortcodes-column wc-shortcodes-one-third wc-shortcodes-column- ">'.$number_html.'</div>';
			$html .= '	<div class="wc-shortcodes-column wc-shortcodes-one-third wc-shortcodes-column-last ">'.$event_html.'</div>';
			$html .= '</div>';
			$html .= $action_html;
			$html .= $message_html;
			$html .= $button_html;
		}
		else {
			$html .= $name_html . $number_html . $event_html . $action_html . $message_html . $button_html;
		}

		return '<div class="wc-shortcodes-rsvp wc-shortcodes-content wc-shortcodes-item wc-shortcodes-rsvp-columns-'.esc_attr($atts['columns']).' wc-shortcodes-rsvp-align-'.esc_attr($atts['align']).' rsvp-button-align-'.esc_attr($atts['button_align']).'">' . do_shortcode( $html ) . '</div>';
	}

		/**
		 * Display posts in various formats
		 *
		 * @since 3.8
		 * @access public
		 *
		 * @param mixed $atts
		 * @return void
		 */
	public function posts( $atts ) {
		global $data;
		global $post;
		global $wc_shortcodes_posts_query;

		static $instance = 0;
		$instance++;

		$atts = WPC_Shortcodes_Sanitize::posts_attr_key_change( $atts );
		$atts = shortcode_atts( parent::$attr->posts, $atts );
		$atts = WPC_Shortcodes_Sanitize::posts_attr( $atts );

		// Set paged variable.
		if ( (is_front_page() || is_home() ) ) {
			$atts['paged'] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
		} else {
			$atts['paged'] = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
		}

		// Convert comma delimeted string to array
		$p = WPC_Shortcodes_Sanitize::comma_delim_to_array( $atts['pids'] );

		$atts['p'] = '';
		$atts['post__in'] = '';

		if ( is_array( $p ) && ! empty( $p ) ) {
			$size = sizeof( $p );
			if ( 1 < $size ) {
				$atts['post__in'] = $p;
			}
			else if ( 1 == $size ) {
				$atts['p'] = $p[0];
			}
		}

		$atts['terms'] = WPC_Shortcodes_Sanitize::comma_delim_to_array( $atts['terms'] );

		// Return if posts_per_page is set to 0.
		if ( 0 == $atts['posts_per_page'] ) {
			return;
		}

		// fix bug with title argument being added to WP_Query() in 4.4
		$keys = array(
			'show_title',
			'show_meta_all',
			'show_meta_author',
			'show_meta_date',
			'show_meta_comments',
			'show_thumbnail',
			'show_content',
			'show_paging',
			'size',
			'filtering',
			'columns',
			'gutter_space',
			'heading_type',
			'layout',
			'template',
			'excerpt_length',
			'date_format',
		);

		$display = array();
		foreach ( $keys as $key ) {
			$display[ $key ] = $atts[ $key ];
			unset( $atts[ $key ] );
		}

		$wpc_term = null;
		if ( isset( $_GET['wpc_term'] ) && ! empty( $_GET['wpc_term'] ) ) {
			$wpc_term = $_GET['wpc_term'];
		}

		// add tax query if user specified
		if ( ! empty( $wpc_term ) ) {
			$atts['tax_query'] = array(
				array(
					'taxonomy' => $atts['taxonomy'],
					'field' => $atts['field'],
					'terms' => $wpc_term,
				),
			);
		}
		else if ( ! empty( $atts['terms'] ) ) {
			$atts['tax_query'] = array(
				array(
					'taxonomy' => $atts['taxonomy'],
					'field' => $atts['field'],
					'terms' => $atts['terms'],
				),
			);
		}

		$is_masonry =  'masonry' == $display['layout'] ? true : false;
		$is_grid =  'grid' == $display['layout'] ? true : false;

		if ( $is_masonry ) {
			wp_enqueue_script('wc-shortcodes-posts');
		}
		else if ( $is_grid ) {
			wp_enqueue_script('wc-shortcodes-posts-grid');
		}

		$nav_filter_hard_links = false;
		if ( $display['show_paging'] ) {
			$nav_filter_hard_links = true;
		}

		$wc_shortcodes_posts_query = new WP_Query($atts);
		$wc_shortcodes_posts_query->excerpt_length = $display['excerpt_length'];

		$html = '';

		$class = array();
		$class[] = 'wc-shortcodes-posts';
		$class[] = 'wc-shortcodes-clearfix';
		$class[] = 'wc-shortcodes-posts-col-' . $display["columns"];
		$class[] = 'wc-shortcodes-posts-layout-' . $display['layout'];
		$class[] = 'wc-shortcodes-posts-template-' . $display['template'];
		$class[] = 'wc-shortcodes-posts-gutter-space-' . $display['gutter_space'];
		if ( ! $is_masonry ) {
			$class[] = 'wc-shortcodes-posts-no-masonry';
		}
		if ( $display['filtering'] ) {
			ob_start();
			include( 'templates/nav-filtering.php' );
			$html .= ob_get_clean();
		}

		$html .= '<div class="wc-shortcodes-posts-wrapper">';
		$html .= '<div id="wc-shortcodes-posts-'.$instance.'" data-gutter-space="'.esc_attr( $display["gutter_space"] ).'" data-columns="'.esc_attr( $display["columns"] ).'" class="' . esc_attr( implode( ' ', $class ) ) . '">';

			while( $wc_shortcodes_posts_query->have_posts() ) :
				$wc_shortcodes_posts_query->the_post();
				
				if ( $display['show_content'] && empty( $post->post_excerpt ) && empty( $post->post_content ) )
					$display['content'] = false;

				ob_start();
				include('templates/'.$display['template'].'/index.php');
				$html .= ob_get_clean();

			endwhile;

		$html .= '</div>';
		$html .= '</div>';

		//no paging if only the latest posts are shown
		if ( $display['show_paging'] ) {
			ob_start();
			include('templates/nav-pagination.php');
			$html .= ob_get_clean();
		}
		wp_reset_query();
		return $html;
	}

	public function post_slider( $atts ) {
		global $post;
		global $wc_shortcodes_posts_query;

		static $instance = 0;
		$instance++;

		$atts = shortcode_atts( parent::$attr->post_slider, $atts );
		$atts = WPC_Shortcodes_Sanitize::post_slider_attr( $atts );

		// Convert comma delimeted string to array
		$p = WPC_Shortcodes_Sanitize::comma_delim_to_array( $atts['pids'] );

		$atts['p'] = '';
		$atts['post__in'] = '';

		if ( is_array( $p ) && ! empty( $p ) ) {
			$size = sizeof( $p );
			if ( 1 < $size ) {
				$atts['post__in'] = $p;
			}
			else if ( 1 == $size ) {
				$atts['p'] = $p[0];
			}
		}

		$atts['terms'] = WPC_Shortcodes_Sanitize::comma_delim_to_array( $atts['terms'] );

		// Return if posts_per_page is set to 0.
		if ( 0 == $atts['posts_per_page'] ) {
			return;
		}

		// fix bug with title argument being added to WP_Query() in 4.4
		$display_keys = array(
			'show_meta_category', 'show_title', 'show_content', 'readmore', 'button_class', 'size', 'heading_type', 'heading_size', 'mobile_heading_size', 'layout', 'template', 'excerpt_length', 'desktop_height', 'laptop_height', 'mobile_height', 'slider_mode', 'slider_pause', 'slider_auto',
		);
		$display = array();
		foreach ( $display_keys as $key ) {
			$display[ $key ] = $atts[ $key ];
			unset( $atts[ $key ] );
		}

		// remove not query keys
		unset( $atts[ 'pids' ] );

		// check for get variable
		$wpc_term = null;
		if ( isset( $_GET['wpc_term'] ) && ! empty( $_GET['wpc_term'] ) ) {
			$wpc_term = $_GET['wpc_term'];
		}

		// add tax query if user specified
		if ( ! empty( $wpc_term ) ) {
			$atts['tax_query'] = array(
				array(
					'taxonomy' => $atts['taxonomy'],
					'field' => $atts['field'],
					'terms' => $wpc_term,
				),
			);
		}
		else if ( ! empty( $atts['terms'] ) ) {
			$atts['tax_query'] = array(
				array(
					'taxonomy' => $atts['taxonomy'],
					'field' => $atts['field'],
					'terms' => $atts['terms'],
				),
			);
		}

		// run query
		$wc_shortcodes_posts_query = new WP_Query($atts);
		$wc_shortcodes_posts_query->excerpt_length = $display['excerpt_length'];


		// enqueue scripts
		if ( 'bxslider' == $display['layout'] ) {
			wp_enqueue_script('wc-shortcodes-bxslider');
			wp_enqueue_script('wc-shortcodes-post-slider');
		}

		// display
		$html = '';

		$html .= '<style>';
		$html .= '#wc-shortcodes-post-slider-'.$instance.' .wc-shortcodes-post-slide {';
			$html .= 'height: ' . $display['desktop_height'] . 'px;';
		$html .= '}';
		$html .= '#wc-shortcodes-post-slider-'.$instance.' .wc-shortcodes-entry-title {';
			$html .= 'font-size: ' . $display['heading_size'] . 'px;';
		$html .= '}';
		$html .= '@media (max-width: 1150px) {';
			$html .= '#wc-shortcodes-post-slider-'.$instance.' .wc-shortcodes-post-slide {';
				$html .= 'height: ' . $display['laptop_height'] . 'px;';
			$html .= '}';
		$html .= '}';
		$html .= '@media (max-width: 767px) {';
			$html .= '#wc-shortcodes-post-slider-'.$instance.' .wc-shortcodes-post-slide {';
				$html .= 'height: ' . $display['mobile_height'] . 'px;';

			$html .= '}';
			$html .= '#wc-shortcodes-post-slider-'.$instance.' .wc-shortcodes-entry-title {';
				$html .= 'font-size: ' . $display['mobile_heading_size'] . 'px;';
			$html .= '}';
		$html .= '}';
		$html .= '</style>';

		$class = array();
		$class[] = 'wc-shortcodes-post-slider';
		$class[] = 'wc-shortcodes-clearfix';
		$class[] = 'wc-shortcodes-posts-layout-' . $display['layout'];
		$class[] = 'wc-shortcodes-posts-template-' . $display['template'];

		$html .= '<div id="" class="wc-shortcodes-post-slider-wrapper">';
			$html .= '<div id="wc-shortcodes-post-slider-'.$instance.'" class="' . esc_attr( implode( ' ', $class ) ) . '" data-mode="' . esc_attr( $display['slider_mode'] ) . '" data-pause="' . esc_attr( $display['slider_pause'] ) . '" data-auto="' . esc_attr( $display['slider_auto'] ) . '">';

				while( $wc_shortcodes_posts_query->have_posts() ) {
					$wc_shortcodes_posts_query->the_post();
					
					if ( $display['show_content'] && empty( $post->post_excerpt ) && empty( $post->post_content ) )
						$display['show_content'] = false;

					ob_start();
					include('templates/'.$display['template'].'/index.php');
					$html .= ob_get_clean();
				}

			$html .= '</div>';
		$html .= '</div>';

		// reset query
		wp_reset_query();

		return $html;
	}

	public function image( $atts ) {
		$atts = shortcode_atts( parent::$attr->image, $atts );
		$atts = WPC_Shortcodes_Sanitize::image_attr( $atts );

		// function options
		$div_wrapper = false;

		// classes
		$classes = array();

		$classes[] = 'wc-shortcodes-image';

		if ( ! empty( $atts['align'] ) )
			$classes[] = 'align' . $atts['align'];

		if ( ! empty( $atts['size'] ) )
			$classes[] = 'size-' . $atts['size'];

		if ( ! empty( $atts['attachment_id'] ) )
			$classes[] = 'wp-image-' . $atts['attachment_id'];

		if ( ! empty( $atts['class'] ) )
			$classes[] = $atts['class'];

		// check if src is set
		list( $src, $width, $height ) = wp_get_attachment_image_src( $atts['attachment_id'], $atts['size'] );
		if ( empty( $src ) ) {
			return '<p>Please insert a valid image</p>';
		}

		$html = '<img alt="' . esc_attr( $atts['alt'] ) . '" title="' . esc_attr( $atts['title'] ) . '" src="' . esc_url( $src ) . '" class="' . esc_attr( implode( ' ', $classes ) ) . '" />';

		// insert flag
		if ( ! empty( $atts['flag'] ) ) {
			$style = array();
			if ( ! empty( $atts['top'] ) )
				$style[] = 'top:' . $atts['top'];
			if ( ! empty( $atts['right'] ) )
				$style[] = 'right:' . $atts['right'];
			if ( ! empty( $atts['bottom'] ) )
				$style[] = 'bottom:' . $atts['bottom'];
			if ( ! empty( $atts['left'] ) )
				$style[] = 'left:' . $atts['left'];
			if ( ! empty( $atts['background_color'] ) )
				$style[] = 'background-color:' . $atts['background_color'];
			if ( ! empty( $atts['text_color'] ) )
				$style[] = 'color:' . $atts['text_color'];
			if ( ! empty( $atts['font_size'] ) )
				$style[] = 'font-size:' . $atts['font_size'];
			if ( ! empty( $atts['text_align'] ) )
				$style[] = 'text-align:' . $atts['text_align'];
			if ( ! empty( $atts['flag_width'] ) )
				$style[] = 'width:' . $atts['flag_width'];


			$html .= '<span style="' . esc_attr( implode( ';', $style ) ) . '" class="wc-shortcodes-image-flag-bg"><span class="wc-shortcodes-image-flag-text">' . esc_html( $atts['flag'] ) . '</span></span>';
			$div_wrapper = true;
			
		}

		// check link_to
		if ( empty( $atts['url'] ) ) {
			if ( 'file' == $atts['link_to'] )
				$atts['url'] = wp_get_attachment_url( $atts['attachment_id'] );
			else if ( 'post' == $atts['link_to'] )
				$atts['url'] = get_attachment_link( $atts['attachment_id'] );
		}

		if ( 'none' != $atts['link_to'] )
			$html = '<a class="wc-shortcodes-image-anchor" href="' . esc_url( $atts['url'] ) . '">' . $html . '</a>';

		// insert caption
		if ( ! empty( $atts['caption'] ) ) {
			$html .= '<p class="wp-caption-text">' . esc_html( $atts['caption'] ) . '</p>';
			$div_wrapper = true;
		}

		// do we need a div wrapper?
		if ( $div_wrapper ) {
			$html = preg_replace( '/(class=["\'][^\'"]*)align(none|left|right|center)\s?/', '$1', $html );
			$html = '<div id="attachment_' . esc_attr( $atts['attachment_id'] ) . '" class="wc-shortcodes-image-wrapper wc-shortcodes-item wp-caption align' . esc_attr( $atts['align'] ) . '" style="width:' . $width . 'px">' . $html . '</div>';
		}
		else if ( in_array( $align, array( 'none', 'center' ) ) ) {
			$html = '<p>' . $html . '</p>';
		}

		return $html;
	}

	public function fa( $atts ) {
		$atts = shortcode_atts( parent::$attr->fa, $atts );
		$atts = WPC_Shortcodes_Sanitize::fa_attr( $atts );

		if ( empty( $atts['icon'] ) )
			return '';

		// classes
		$classes = array();

		$classes[] = 'wc-shortcodes-fa';
		$classes[] = 'fa';
		$classes[] = 'fa-' . $atts['icon'];
		if ( empty( $atts['class'] ) )
			$classes[] = $atts['class'];

		$style_attr = '';

		if( $atts['margin_right'] ) {
			$style_attr .= 'margin-right: '. $atts['margin_right'] .';';
		}
		if ( $atts['margin_left'] ) {
			$style_attr .= 'margin-left: '. $atts['margin_left'] .';';
		}

		$html = '<i class="' . esc_attr( implode( ' ', $classes ) ) . '" style="'.esc_attr( $style_attr ).'"></i>';

		return $html;
	}

	public function share_buttons( $atts ) {
		$atts = shortcode_atts( parent::$attr->share_buttons, $atts );
		$atts = WPC_Shortcodes_Sanitize::share_buttons_attr( $atts );

		$share_buttons = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_display' );
		$size = sizeof( $share_buttons );
		$format = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_format', 'image' );

		if ( empty( $share_buttons ) || ! is_array( $share_buttons ) )
			return '';
		
		$charset = get_bloginfo('charset');
		
		// classes
		$classes = array();

		$classes[] = 'wc-shortcodes-share-buttons';
		$classes[] = 'wc-shortcodes-share-buttons-format-'.$format;
		$classes[] = 'wc-shortcodes-share-buttons-size-'.$size;
		if ( ! empty( $class ) ) {
			$classes[] = $class;
		}

		$style_attr = '';

		$first = true;

		$html = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '" style="'.esc_attr( $style_attr ).'">';
			$html .= '<ul class="wc-shortcodes-clearfix">';
				foreach ( $share_buttons as $key => $name ) {
					$icon_option_name = WC_SHORTCODES_PREFIX . $key . '_share_icon';
					$icon_url = get_option( $icon_option_name );

					$icon_option_name = WC_SHORTCODES_PREFIX . $key . '_share_text';
					$icon_text = get_option( $icon_option_name );

					$font_icon_option_name = WC_SHORTCODES_PREFIX . $key . '_share_font_icon';
					$icon_class = get_option( $font_icon_option_name );

					$first_class = $first ? ' first-share-button' : '';

					switch ( $key ) {
						case 'pinterest' :
							$html .= '<li class="wc-shortcodes-share-button-icon wc-shortcode-share-button-icon-' . $key . $first_class . '">';
								$html .='<a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;https://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());">';
									switch ( $format ) {
										case 'image' :
											$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $icon_text ).'">';
											break;
										case 'icon' :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
											break;
										default :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i><span class="wc-share-button-'.$key.'">'.esc_html( $icon_text ).'</span>';
											break;
									}
								$html .= '</a>';
							$html .= '</li>';
							break;
						case 'facebook' :
							$html .= '<li class="wc-shortcodes-share-button-icon wc-shortcode-share-button-icon-' . $key . $first_class . '">';
								$html .='<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'&amp;t='.rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, $charset ) ).'">';
									switch ( $format ) {
										case 'image' :
											$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $icon_text ).'">';
											break;
										case 'icon' :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
											break;
										default :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i><span class="wc-share-button-'.$key.'">'.esc_html( $icon_text ).'</span>';
											break;
									}
								$html .= '</a>';
							$html .= '</li>';
							break;
						case 'twitter' :
							$html .= '<li class="wc-shortcodes-share-button-icon wc-shortcode-share-button-icon-' . $key . $first_class . '">';
								$html .='<a target="_blank" href="https://twitter.com/share?text='.rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, $charset ) ).'&amp;url='.get_permalink().'" class="share-button-twitter" data-lang="en">';
									switch ( $format ) {
										case 'image' :
											$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $icon_text ).'">';
											break;
										case 'icon' :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
											break;
										default :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i><span class="wc-share-button-'.$key.'">'.esc_html( $icon_text ).'</span>';
											break;
									}
								$html .= '</a>';
							$html .= '</li>';
							break;
						case 'email' :
							$html .= '<li class="wc-shortcodes-share-button-icon wc-shortcode-share-button-icon-' . $key . $first_class . '">';
								$html .='<a title="Share by Email" href="mailto:?subject='.rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, $charset ) ).'&amp;body='.get_permalink().'">';
									switch ( $format ) {
										case 'image' :
											$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $icon_text ).'">';
											break;
										case 'icon' :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
											break;
										default :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i><span class="wc-share-button-'.$key.'">'.esc_html( $icon_text ).'</span>';
											break;
									}
								$html .= '</a>';
							$html .= '</li>';
							break;
						case 'google' :
							$html .= '<li class="wc-shortcodes-share-button-icon wc-shortcode-share-button-icon-' . $key . $first_class . '">';
								$html .='<a target="_blank" href="https://plus.google.com/share?url='.get_permalink().'">';
									switch ( $format ) {
										case 'image' :
											$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $icon_text ).'">';
											break;
										case 'icon' :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
											break;
										default :
											$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i><span class="wc-share-button-'.$key.'">'.esc_html( $icon_text ).'</span>';
											break;
									}
								$html .= '</a>';
							$html .= '</li>';
							break;
						case 'print' :
							$html .= '<li class="wc-shortcodes-share-button-icon wc-shortcode-share-button-icon-' . $key . $first_class . '">';
								if ( is_single() ) {
									$html .='<a href="#" onclick="javascript:window.print();return false;">';
								}
								else {
									$html .='<a href="#" onclick="javascript:void((function($){w=window.open(\''.get_permalink().'\');$(w).load(function(){setTimeout(function(){w.print();},1000);});})(jQuery));return false;">';
								}
										switch ( $format ) {
											case 'image' :
												$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $icon_text ).'">';
												break;
											case 'icon' :
												$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i>';
												break;
											default :
												$html .= '<i class="fa '.esc_attr( $icon_class ).'"></i><span class="wc-share-button-'.$key.'">'.esc_html( $icon_text ).'</span>';
												break;
										}
								$html .= '</a>';
							$html .= '</li>';
							break;
					}
				}
			$html .= '</ul>';
		$html .= '</div>';

		return $html;
	}

	public function get_share_buttons() {
		$html = null;
		$share_buttons = null;

		$share_buttons = $this->share_buttons( null );

		if ( empty( $share_buttons ) ) {
			return '';
		}

		$html .= '<div class="wc-share-buttons-container">';
			$html .= apply_filters( 'wc_shortcodes_before_share_buttons', '' );
			$html .= '<div class="share-buttons">';
				$html .= '<div class="share-text">' . __( 'Share', 'wpcanvas2' ) . '</div>';
				$html .= $share_buttons;
			$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}
