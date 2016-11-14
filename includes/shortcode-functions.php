<?php
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
function wc_shortcodes_pre_process($content) {
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
add_filter('the_content', 'wc_shortcodes_pre_process', 7);
add_filter('wc_shortcodes_the_content', 'wc_shortcodes_pre_process', 7);

/**
 * Add all preprocessed shortcodes here
 *
 * @since 3.6.1
 * @access public
 *
 * @return void
 */
function wc_shortcodes_add_preprocess() {
	add_shortcode( 'wc_fullwidth' , 'wc_shortcodes_fullwidth' );
	add_shortcode( 'wc_column', 'wc_shortcodes_column' );
	add_shortcode( 'wc_row', 'wc_shortcodes_row' );
	add_shortcode( 'wc_center', 'wc_shortcodes_center' );
	add_shortcode( 'wc_toggle', 'wc_shortcodes_toggle' );
	add_shortcode( 'wc_accordion', 'wc_shortcodes_accordion_main' );
	add_shortcode( 'wc_accordion_section', 'wc_shortcodes_accordion_section' );
	add_shortcode( 'wc_tabgroup', 'wc_shortcodes_tabgroup' );
	add_shortcode( 'wc_tab', 'wc_shortcodes_tab' );
	add_shortcode( 'wc_testimonial', 'wc_shortcodes_testimonial' );
	add_shortcode( 'wc_box', 'wc_shortcodes_box' );
	add_shortcode( 'wc_pricing', 'wc_shortcodes_pricing' );
	add_shortcode( 'wc_code' , 'wc_shortcodes_displaycode' );
}
add_action( 'wc_shortcodes_add_preprocess', 'wc_shortcodes_add_preprocess' );


/*
 * Allow shortcodes in widgets
 * @since v1.0
 */
add_filter('widget_text', 'do_shortcode');


/**
 * @since 3.6
 * @access public
 *
 * @param array $atts 
 * @param string $content 
 * @return void
 */
function wc_shortcodes_fullwidth( $atts, $content = null ) {
	global $wc_shortcodes_theme_support;

	extract(shortcode_atts(array(
		'selector' => $wc_shortcodes_theme_support[ 'fullwidth_container' ],
	), $atts));

	if ( empty( $selector ) ) {
		$selector = $wc_shortcodes_theme_support[ 'fullwidth_container' ];
	}

	wp_enqueue_script('wc-shortcodes-fullwidth');

	return '<div class="wc-shortcodes-full-width wc-shortcodes-content" data-selector="' . esc_attr( $selector ) . '">' . do_shortcode( $content ) . '</div>';
}


/**
 * Easily Display HTML in post
 * 
 * @param mixed $atts 
 * @param mixed $content 
 * @access public
 * @return void
 */
function wc_shortcodes_displayhtml( $atts, $content = null ) {
	global $post;
	$html = '';

	if ( $content != null )
		return $content;

	extract(shortcode_atts(array(
		'name'			=>	''
	), $atts));

	// sanitize
	$name = WCShortcodes_Sanitize::text_field( $name );
	$name = preg_replace( '/^_/', '', $name );

	if ( empty( $name ) )
		return null;

	if ( $snippet = get_post_meta($post->ID, $name, true ) ) {
        $html = '<div class="wc-shortcodes-html-wrapper wc-shortcodes-item wc-shortcodes-content">' . $snippet . '</div>';
	}

	return $html;
}
add_shortcode( 'wc_html', 'wc_shortcodes_displayhtml' );


/**
 * @param mixed $atts 
 * @param mixed $content 
 * @access public
 * @return void
 */
function wc_shortcodes_displaycode( $atts, $content = null ) {
	return '<code>'.$content.'</code>';
}

/**
 * @param mixed $atts 
 * @param mixed $content 
 * @access public
 * @return void
 */
function wc_shortcodes_displaypre( $atts, $content = null ) {
	global $post;
	$html = '';
	static $instance = 0;
	$instance++;

	if ( $content != null )
		return $content;

	extract(shortcode_atts(array(
		'name'			=>	'',
		'scrollable'	=>	1,
		'color'			=>	1,
		'lang'			=>	'',
		'linenums'		=>	0,
		'wrap'			=>	0,
	), $atts));

	// sanitize
	$scrollable = WCShortcodes_Sanitize::bool( $scrollable );
	$color = WCShortcodes_Sanitize::bool( $color );
	$linenums = WCShortcodes_Sanitize::bool( $linenums );
	$wrap = WCShortcodes_Sanitize::bool( $wrap );
	$name = WCShortcodes_Sanitize::text_field( $name );

	$class = array();
	if ( (int) $color ) {
		$class[] = 'prettyprint';
		if ( (int) $linenums )
			$class[] = 'linenums';
		if ( ! empty( $lang ) )
			$class[] = 'lang-' . $lang;
	}
	if ( (int) $scrollable )
		$class[] = 'pre-scrollable';
	if ( (int) $wrap )
		$class[] = 'pre-wrap';

	$class = implode( ' ', $class );

	$name = preg_replace( '/^_/', '', $name );

	if ( empty( $name ) )
		return null;

	if ( $code = get_post_meta($post->ID, $name, true ) ) {
		wp_enqueue_script('wc-shortcodes-prettify');
		wp_enqueue_script('wc-shortcodes-pre');
		//$code = preg_replace( '/[ ]{4,}|[\t]/', '  ', $code );
		$html .= '<pre id="prettycode-'.$instance.'" class="'.esc_attr( $class ).'">';
		$html .= htmlspecialchars( $code );
		$html .= '</pre>';
	}

	return $html;
}
add_shortcode( 'wc_pre' , 'wc_shortcodes_displaypre' );


/*
 * Clear Floats
 * @since v1.0
 */
if( !function_exists('wc_shortcodes_clear_floats') ) {
	function wc_shortcodes_clear_floats() {
	   return '<div class="wc-shortcodes-clear-floats"></div>';
	}
	add_shortcode( 'wc_clear_floats', 'wc_shortcodes_clear_floats' );
}


/*
 * Skillbars
 * @since v1.3
 */
if( !function_exists('wc_shortcodes_skillbar') ) {
	function wc_shortcodes_skillbar( $atts  ) {		
		extract( shortcode_atts( array(
			'title'	=> '',
			'percentage'	=> '100',
			'color'	=> '#6adcfa',
			'class'	=> '',
			'show_percent'	=> 'true'
		), $atts ) );

		// sanitize
		$percentage = WCShortcodes_Sanitize::int_float( $percentage );
		$color = WCShortcodes_Sanitize::hex_color( $color );
		$show_percent = WCShortcodes_Sanitize::bool( $show_percent );
		
		// Enque scripts
		wp_enqueue_script('wc-shortcodes-skillbar');
		
		// Display the accordion	';
		$output = '<div class="wc-shortcodes-skillbar wc-shortcodes-item wc-shortcodes-clearfix '. esc_attr( $class ) .'" data-percent="'. esc_attr( $percentage ) .'%">';
			if ( $title !== '' ) $output .= '<div class="wc-shortcodes-skillbar-title" style="background: '. esc_attr( $color ) .';"><span>'. esc_html( $title ) .'</span></div>';
			$output .= '<div class="wc-shortcodes-skillbar-bar" style="background: '. esc_attr( $color ) .';"></div>';
			if ( $show_percent ) {
				$output .= '<div class="wc-shortcodes-skill-bar-percent">'.$percentage.'%</div>';
			}
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'wc_skillbar', 'wc_shortcodes_skillbar' );
}


/*
 * Spacing
 * @since v1.0
 */
if( !function_exists('wc_shortcodes_spacing') ) {
	function wc_shortcodes_spacing( $atts ) {
		extract( shortcode_atts( array(
			'size'	=> '20px',
			'class'	=> '',
		), $atts ) );

		// sanitize
		$size = WCShortcodes_Sanitize::css_unit( $size );

		return '<hr class="wc-shortcodes-spacing '. esc_attr( $class ) .'" style="height: '. esc_attr( $size ) .'" />';
	}
	add_shortcode( 'wc_spacing', 'wc_shortcodes_spacing' );
}


/**
* Social Icons
* @since 1.0
*/
if( !function_exists('wc_shortcodes_social_icons') ) {
	function wc_shortcodes_social_icons( $atts ){   
		extract(shortcode_atts(array(
			'class'      => '',
			'size'		 => 'large', // deprecated. using maxheight now
			'align'      => 'left',
			'maxheight'  => '0',
		), $atts));

		// sanitize
		$maxheight = (int) $maxheight;

		if ( empty( $maxheight ) ) {
			switch ( $size ) {
				case 'small' :
					$maxheight = 16;
					break;
				case 'medium' :
					$maxheight = 24;
					break;
				default :
					$maxheight = 48;
			}
		}

		$class = trim( 'wc-shortcodes-social-icons-wrapper wc-shortcodes-item ' . $class );

		$order = get_option( WC_SHORTCODES_PREFIX . 'social_icons_display' );
		$format = get_option( WC_SHORTCODES_PREFIX . 'social_icons_format', 'image' );
		$show_image = 'image' == $format ? true : false;

		if ( ! is_array( $order ) || empty( $order ) ) {
			return;
		}

		// classes
		$classes = array();

		$classes[] = 'wc-shortcodes-social-icons';
		$classes[] = 'wc-shortcodes-clearfix';
		$classes[] = 'wc-shortcodes-social-icons-align-'.$align;
		$classes[] = 'wc-shortcodes-maxheight-'.$maxheight;
		$classes[] = 'wc-shortcodes-social-icons-format-'.$format;

		$first = true;

		$html = '<div class="' . esc_attr( $class ) . '">';
			$html .= '<ul class="'.esc_attr( implode( ' ', $classes ) ).'">';
				foreach ( $order as $key => $value ) {
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
								$html .= '<img src="'.esc_url( $icon_url ).'" alt="'.esc_attr( $value ).'">';
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
	add_shortcode( 'wc_social_icons', 'wc_shortcodes_social_icons' );
}

/**
* Highlights
* @since 1.0
*/
if ( !function_exists( 'wc_shortcodes_highlight' ) ) {
	function wc_shortcodes_highlight( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color'	=> 'yellow',
			'class'	=> '',
		), $atts ) );

		return '<span class="wc-shortcodes-highlight wc-shortcodes-highlight-'. esc_attr( $color ) .' '. esc_attr( $class ) .'">' . do_shortcode( $content ) . '</span>';
	
	}
	add_shortcode( 'wc_highlight', 'wc_shortcodes_highlight' );
}


/*
 * Buttons
 * @since v1.0
 */
if( !function_exists('wc_shortcodes_button') ) {
	function wc_shortcodes_button( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type'			=> 'primary', // or inverse
			'url'			=> 'http://www.wordpresscanvas.com',
			'title'			=> 'Visit Site',
			'target'		=> 'self',
			'rel'			=> '',
			'border_radius'	=> '',
			'icon_left'		=> '',
			'icon_right'	=> '',
			'position'		=> 'float',
			'class'			=> '',
		), $atts ) );

		// sanitize
		$border_radius = WCShortcodes_Sanitize::css_unit( $border_radius );

		$custom_class = sanitize_title( $class );

		// $border_radius_style = ( $border_radius ) ? 'style="border-radius:'. $border_radius .'"' : NULL;		
		$rel = ( $rel ) ? 'rel="'.$rel.'"' : NULL;
		$type = 'wc-shortcodes-button-' . $type;
		
		$class = array();
		$class[] = 'wc-shortcodes-button';
		$class[] = $type;
		$class[] = 'wc-shortcodes-button-position-' . $position;
		if ( ! empty( $custom_class ) )
			$class[] = $custom_class;
		
		$button = null;
		$button .= '<a href="' . esc_url( $url ) . '" class="'.esc_attr( implode( ' ', $class ) ).'" target="_'.esc_attr( $target ).'" title="'. esc_attr( $title ) .'" rel="'. esc_attr( $rel ) .'">';
			$button .= '<span class="wc-shortcodes-button-inner">';
			if ( $icon_left ) {
				$button .= '<span class="wc-shortcodes-button-icon-left icon-'. esc_attr( $icon_left ) .'"></span>';
			}
			$button .= $content;
			if ( $icon_right ) {
				$button .= '<span class="wc-shortcodes-button-icon-right icon-'. esc_attr( $icon_right ) .'"></span>';
			}
			$button .= '</span>';			
		$button .= '</a>';

		$whitelist = array( 'center', 'left', 'right' );
		if ( in_array( $position, $whitelist ) ) {
			$button = '<div class="wc-shortcodes-item wc-shortcodes-button-'.$position.'">'. $button .'</div>';
		}

		return $button;
	}
	add_shortcode( 'wc_button', 'wc_shortcodes_button' );
}



/*
 * Boxes
 * @since v1.0
 *
 */
if( !function_exists('wc_shortcodes_box') ) { 
	function wc_shortcodes_box( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color'			=> 'primary',
			'text_align'	=> 'left',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'class'			=> '',
		), $atts ) );

		$margin_top = WCShortcodes_Sanitize::css_unit( $margin_top );
		$margin_bottom = WCShortcodes_Sanitize::css_unit( $margin_bottom );

		$style_attr = '';

		if( $margin_bottom ) {
			$style_attr .= 'margin-bottom: '. $margin_bottom .';';
		}
		if ( $margin_top ) {
			$style_attr .= 'margin-top: '. $margin_top .';';
		}

		$alert_content = '';
		$alert_content .= '<div class="wc-shortcodes-box wc-shortcodes-item wc-shortcodes-content wc-shortcodes-clearfix wc-shortcodes-box-' . esc_attr( $color ) . ' '. esc_attr( $class ) .'" style="text-align:'. esc_attr( $text_align ) .';'. esc_attr( $style_attr ) .'">';

		$alert_content .= ' '. do_shortcode($content) .'</div>';

		return $alert_content;
	}
}



/*
 * Testimonial
 * @since v1.0
 *
 */
if( !function_exists('wc_shortcodes_testimonial') ) { 
	function wc_shortcodes_testimonial( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'by' => '',
			'url' => '',
			'position' => 'left',
			'class'	=> '',
		), $atts ) );

		if ( ! empty( $url ) ) {
			$by = '<a href="' . esc_url( $url ) . '">' . $by . '</a>';
		}

		$testimonial_content = '';
		$testimonial_content .= '<div class="wc-shortcodes-testimonial wc-shortcodes-item wc-shortcodes-clearfix wc-shortcodes-testimonial-'.esc_attr( $position ).' '. esc_attr( $class ) .'"><div class="wc-shortcodes-testimonial-content wc-shortcodes-content">';
		$testimonial_content .= $content;
		$testimonial_content .= '</div><div class="wc-shortcodes-testimonial-author">';
		$testimonial_content .= $by .'</div></div>';	

		return $testimonial_content;
	}
}



/*
 * Center
 * @since v1.0
 *
 */
if( !function_exists('wc_shortcodes_center') ) {
	function wc_shortcodes_center( $atts, $content = null ){
		extract( shortcode_atts( array(
			'max_width'		=> '500px',
			'text_align'	=> 'center',
			'class'			=> '',
		), $atts ) );

		$max_width = WCShortcodes_Sanitize::css_unit( $max_width );

		// $append_clearfix = '<div class="wc-shortcodes-clear-floats"></div>';
		$style = empty( $max_width ) ? '' : ' style="max-width:'.esc_attr( $max_width ).';"';

		return '<div class="wc-shortcodes-center wc-shortcodes-item wc-shortcodes-content wc-shortcodes-clearfix wc-shortcodes-center-inner-align-'. esc_attr( $text_align ) .' '. esc_attr( $class ) .'"' . $style . '>' . do_shortcode($content) . '</div>';
	}
}



/*
 * Columns
 * @since v1.0
 *
 */
if( !function_exists('wc_shortcodes_column') ) {
	function wc_shortcodes_column( $atts, $content = null ){
		extract( shortcode_atts( array(
			'size'		=> 'one-third',
			'position'	=>'',
			'class'		=> '',
			'text_align'=> '',
		), $atts ) );

		$style = '';
		if ( $text_align ) {
			if ( 'left' == $text_align )
				$style = ' style="text-align: '.esc_attr( $text_align ).';"';
			if ( 'center' == $text_align )
				$style = ' style="text-align: '.esc_attr( $text_align ).';"';
			if ( 'right' == $text_align )
				$style = ' style="text-align: '.esc_attr( $text_align ).';"';
		}

		$append_clearfix = 'last' == $position ? '<div class="wc-shortcodes-clear-floats"></div>' : '';

		return '<div'.$style.' class="wc-shortcodes-column wc-shortcodes-content wc-shortcodes-' . esc_attr( $size ) . ' wc-shortcodes-column-'.esc_attr( $position ).' '. esc_attr( $class ) .'">' . do_shortcode($content) . '</div>';
	}
}




/*
 * Rows
 * @since v1.0
 *
 */
if( !function_exists('wc_shortcodes_row') ) {
	function wc_shortcodes_row( $atts, $content = null ){
		return '<div class="wc-shortcodes-row wc-shortcodes-item wc-shortcodes-clearfix">' . do_shortcode($content) . '</div>';
	}
}



/*
 * Toggle
 * @since v1.0
 */
if( !function_exists('wc_shortcodes_toggle') ) {
	function wc_shortcodes_toggle( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'	=> 'Toggle Title',
			'class'	=> '',
			'padding'	=> '',
			'border_width'	=> '',
			'layout' => 'box',
		), $atts ) );

		$padding = WCShortcodes_Sanitize::css_unit( $padding );

		$classes = array();

		$classes[] = 'wc-shortcodes-toggle';
		$classes[] = 'wc-shortcodes-item';

		if ( ! empty( $class ) )
			$classes[] = $class;

		if ( ! empty( $layout ) )
			$classes[] = 'wc-shortcodes-toggle-layout-' . $layout;

		$class = implode( ' ', $classes );

		$style = array();

		if ( ! empty( $padding ) || '0' === $padding )
			$style[] = 'padding:'.$padding;
		if ( ! empty( $border_width ) || '0' === $border_width )
			$style[] = 'border-width:'.$border_width;

		$style = implode( ';', $style );
		 
		// Enque scripts
		wp_enqueue_script('wc-shortcodes-toggle');
		
		// Display the Toggle
		return '<div class="'. esc_attr( $class ) .'"><div class="wc-shortcodes-toggle-trigger"><a href="#">'. esc_html( $title ) .'</a></div><div style="'.esc_attr( $style ).'" class="wc-shortcodes-toggle-container wc-shortcodes-content">' . do_shortcode($content) . '</div></div>';
	}
}


/*
 * Accordion
 * @since v1.0
 *
 */

// Main
if( !function_exists('wc_shortcodes_accordion_main') ) {
	function wc_shortcodes_accordion_main( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'class'	=> '',
			'collapse' => 0,
			'leaveopen' => 0,
			'layout' => 'box',
		), $atts ) );

		$collapse = WCShortcodes_Sanitize::bool( $collapse );
		$leaveopen = WCShortcodes_Sanitize::bool( $leaveopen );

		$classes = array();

		$classes[] = 'wc-shortcodes-accordion';
		$classes[] = 'wc-shortcodes-item';

		$behavior = 'autoclose';
		if ( $leaveopen ) {
			$behavior = 'leaveopen';
		}

		$state = 'default';
		if ( $collapse ) {
			$classes[] = 'wc-shortcodes-accordion-collapse';
			$state = 'collapse';
		}
		else {
			$classes[] = 'wc-shortcodes-accordion-default';
		}

		if ( ! empty( $class ) )
			$classes[] = $class;

		if ( ! empty( $layout ) )
			$classes[] = 'wc-shortcodes-accordion-layout-' . $layout;

		$class = implode( ' ', $classes );

		// Enque scripts
		wp_enqueue_script('wc-shortcodes-accordion');
		
		// Display the accordion	
		return '<div class="'. esc_attr( $class ) .'" data-behavior="'.esc_attr( $behavior ).'" data-start-state="'.esc_attr( $state ).'">' . do_shortcode($content) . '</div>';
	}
}


// Section
if( !function_exists('wc_shortcodes_accordion_section') ) {
	function wc_shortcodes_accordion_section( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'title'	=> 'Title',
			'class'	=> '',
		), $atts ) );

		return '<div class="wc-shortcodes-accordion-trigger '. esc_attr( $class ) .'"><a href="#">'. esc_html( $title ) .'</a></div><div class="wc-shortcodes-accordion-content wc-shortcodes-content">' . do_shortcode($content) . '</div>';
	}
	
}


/*
 * Tabs
 * @since v1.0
 *
 */
if (!function_exists('wc_shortcodes_tabgroup')) {
	function wc_shortcodes_tabgroup( $atts, $content = null ) {
		static $instance = 0;
		$instance++;
		
		//Enque scripts
		wp_enqueue_script('wc-shortcodes-tabs');
		
		// Display Tabs
		$defaults = array(
			'class'	=> '',
			'layout' => 'box',
		);
		extract( shortcode_atts( $defaults, $atts ) );

		$classes = array();

		$classes[] = 'wc-shortcodes-tabs';
		$classes[] = 'wc-shortcodes-item';

		if ( ! empty( $class ) )
			$classes[] = $class;

		if ( ! empty( $layout ) )
			$classes[] = 'wc-shortcodes-tabs-layout-' . $layout;

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
}
if (!function_exists('wc_shortcodes_tab')) {
	function wc_shortcodes_tab( $atts, $content = null ) {
		$defaults = array(
			'title'	=> 'Tab',
		);
		extract( shortcode_atts( $defaults, $atts ) );

		$classes = array();

		$classes[] = 'tab-content';
		$classes[] = 'wc-shortcodes-content';

		$class = implode( ' ', $classes );

		return '<div id="wc-shortcodes-tab-'. sanitize_title( $title ) .'" class="'. esc_attr( $class ) .'">'. do_shortcode( $content ) .'</div>';
	}
}




/*
 * Pricing Table
 * @since v1.0
 *
 */
/*section*/
if( !function_exists('wc_shortcodes_pricing') ) {
	function wc_shortcodes_pricing( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'type'					=> 'primary', // primary, secondary, inverse
			'plan'					=> 'Basic', // string
			'cost'					=> '$20', // string
			'per'					=> 'month', // month, day, year, week, etc
			'button_url'			=> '', // url to payment gateway
			'button_text'			=> 'Purchase', // call to action button
			'button_target'			=> 'self', // self, blank
			'button_rel'			=> 'nofollow', // alternate, author, bookmark, help, license, next, nofollow, noreferrer, prefetch, prev, search, tag
			'class'					=> '', // add your own css class for customization.
		), $atts ) );
		
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="wc-shortcodes-pricing wc-shortcodes-pricing-type-'. esc_attr( $type ) .' '. esc_attr( $class ) .'">';
			$pricing_content .= '<div class="wc-shortcodes-pricing-header">';
				$pricing_content .= '<h5>'. esc_html( $plan ). '</h5>';
				$pricing_content .= '<div class="wc-shortcodes-pricing-cost">'. esc_html( $cost ) .'</div><div class="wc-shortcodes-pricing-per">'. esc_html( $per ) .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="wc-shortcodes-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_url ) {
				$pricing_content .= '<div class="wc-shortcodes-pricing-button"><a href="'. esc_url( $button_url ) .'" class="wc-shortcodes-button wc-shortcodes-button-'.esc_attr( $type ).'" target="_'. esc_attr( $button_target ) .'" rel="'. esc_attr( $button_rel ) .'"><span class="wc-shortcodes-button-inner">'. esc_html( $button_text ) .'</span></a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
	
}


/*
 * Heading
 * @since v1.1
 */
if( !function_exists('wc_shortcodes_heading') ) {
	function wc_shortcodes_heading( $atts ) {
		extract( shortcode_atts( array(
			'title'			=> __('Sample Heading', 'wc'),
			'type'			=> 'h2',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'text_align'	=> '',
			'font_size'		=> '',
			'color'			=> '',
			'class'			=> '',
			'icon_left'		=> '',
			'icon_right'	=> '',
			'icon_spacing'	=> '',
		), $atts ) );

		$type = WCShortcodes_Sanitize::heading_type( $type );

		$style_attr = '';

		if ( $font_size ) {
			$style_attr .= 'font-size: '. $font_size .';';
		}
		if ( $color ) {
			$style_attr .= 'color: '. $color .';';
		}
		if( $margin_bottom ) {
			$style_attr .= 'margin-bottom: '. $margin_bottom .';';
		}
		if ( $margin_top ) {
			$style_attr .= 'margin-top: '. $margin_top .';';
		}
		
		if ( $text_align ) {
			$text_align = 'text-align-'. $text_align;
		} else {
			$text_align = 'text-align-left';
		}
		
		if ( 'h1' == $type )
			$class = trim( 'entry-title ' . $class );

	 	$output = '<'.$type.' class="wc-shortcodes-heading '. esc_attr( $text_align ) .' '. esc_attr( $class ) .'" style="'.esc_attr( $style_attr ).'"><span>';

		if ( $icon_left )
			$output .= '<i class="wc-shortcodes-button-icon-left fa fa-'. esc_attr( $icon_left ) .'" style="margin-right:'.esc_attr( $icon_spacing ).'"></i>';

		$output .= esc_html( $title );

		if ( $icon_right )
			$output .= '<i class="wc-shortcodes-button-icon-right fa fa-'. esc_attr( $icon_right ) .'" style="margin-left:'.esc_attr( $icon_spacing ).'"></i>';

		$output .= '</span></'.$type.'>';

		if ( 'h1' == $type )
			$output = '<header class="entry-header">'. $output . '</header>';
		
		return $output;
	}
	add_shortcode( 'wc_heading', 'wc_shortcodes_heading' );
}


/*
 * Google Maps
 * @since v1.1
 */
if (! function_exists( 'wc_shortcodes_googlemaps' ) ) :
	function wc_shortcodes_googlemaps($atts, $content = null) {
		static $instance = 0;
		$instance++;
		
		extract(shortcode_atts(array(
			'title'		=> '', // content inside the info window
			'title_on_load' => 'no', // should the info window display on map load
			'location'	=> '', // Enter a valid address that Google can geocode.
			'height'	=> '300', // set the height of your google map in pixels
			'zoom'		=> 8, // the lower the zoom, the farther away the map appears
			'class'		=> '', // add a custom class to your google map
		), $atts));

		$height = WCShortcodes_Sanitize::pixel( $height );
		$zoom = WCShortcodes_Sanitize::number( $zoom );

		$title_on_load = 'yes' == $title_on_load ? 1 : 0;
		
		// load scripts
		wp_enqueue_script('wc-shortcodes-googlemap');
		wp_enqueue_script('wc-shortcodes-googlemap-api');
		
		$class = array();
		$class[] = 'googlemap';
		$class[] = 'wc-shortcodes-item';
		
		$output = '<div id="map_canvas_'.$instance.'" class="' . esc_attr( implode( ' ', $class ) ) . '" style="height:'.$height.';width:100%">';
			$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.esc_html( $title ).'" />' : '';
			$output .= '<input class="location" type="hidden" value="'.esc_attr( $location ).'" />';
			$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
			$output .= '<input class="title-on-load" type="hidden" value="'.$title_on_load.'" />';
			$output .= '<div class="map_canvas"></div>';
		$output .= '</div>';
		
		return $output;
	   
	}
	add_shortcode( 'wc_googlemap', 'wc_shortcodes_googlemaps' );
endif;


/*
 * Divider
 * @since v1.1
 */
if( !function_exists('wc_shortcodes_divider') ) {
	function wc_shortcodes_divider( $atts ) {
		extract( shortcode_atts( array(
			'style'			=> 'solid',
			'line'			=> 'single',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'class'			=> '',
		), $atts ) );

		$margin_top = WCShortcodes_Sanitize::css_unit( $margin_top );
		$margin_bottom = WCShortcodes_Sanitize::css_unit( $margin_bottom );

		$style_attr = array();

		if ( $margin_top && $margin_bottom ) {  
			$style_attr[] = 'margin-top: '. $margin_top .';margin-bottom: '. $margin_bottom .';';
		} elseif( $margin_bottom ) {
			$style_attr[] = 'margin-bottom: '. $margin_bottom .';';
		} elseif ( $margin_top ) {
			$style_attr[] = 'margin-top: '. $margin_top .';';
		}

		if ( ! empty ( $style_attr ) ) {
			$style_attr = 'style="' . esc_attr( implode( '', $style_attr ) ) . '"';
		}
		else {
			$style_attr = '';
		}

		 return '<hr class="wc-shortcodes-divider wc-shortcodes-item wc-shortcodes-divider-line-'.esc_attr( $line ).' wc-shortcodes-divider-style-'. esc_attr( $style ) .' '. esc_attr( $class ) .'" '.$style_attr.' />';
	}
	add_shortcode( 'wc_divider', 'wc_shortcodes_divider' );
}


/*
 * Countdown
 * @since v1.10
 */
if( !function_exists('wc_shortcodes_countdown') ) {
	function wc_shortcodes_countdown( $atts ) {
		extract( shortcode_atts( array(
			'date' => '',
			'format' => 'wdHMs',
			'labels' => 'Years,Months,Weeks,Days,Hours,Minutes,Seconds',
			'labels1' => 'Year,Month,Week,Day,Hour,Minute,Second',
			'message' => 'Your Message Here!',
		), $atts ) );

		if ( empty( $date ) ) {
			return '<p>*Please enter a date for your countdown*</p>';
		}

		wp_enqueue_script('wc-shortcodes-countdown');

		$html = '<div class="wc-shortcodes-countdown" data-labels="'.esc_attr($labels).'" data-labels1="'.esc_attr($labels1).'" data-date="'.esc_attr( $date ).'" data-format="'.esc_attr( $format ).'" data-message="'.esc_attr( $message ).'"></div>';
		$html = '<div class="wc-shortcodes-countdown-bg1">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg2">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg3">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg4">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-item">'.$html.'</div>';

		return $html;
	}
	add_shortcode( 'wc_countdown', 'wc_shortcodes_countdown' );
}



if( !function_exists('wc_shortcodes_rsvp') ) {
	function wc_shortcodes_rsvp( $atts ) {
		extract( shortcode_atts( array(
			'columns' => '3',
			'align' => 'left',
			'button_align' => 'center',
		), $atts ) );

		wp_enqueue_script('wc-shortcodes-rsvp');

		$columns = WCShortcodes_Sanitize::positive_number( $columns );
		$columns = 3 == $columns ? $columns : 1;

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

		if ( 3 == $columns ) {
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

		return '<div class="wc-shortcodes-rsvp wc-shortcodes-content wc-shortcodes-item wc-shortcodes-rsvp-columns-'.$columns.' wc-shortcodes-rsvp-align-'.esc_attr($align).' rsvp-button-align-'.esc_attr($button_align).'">' . do_shortcode( $html ) . '</div>';
	}
	add_shortcode( 'wc_rsvp', 'wc_shortcodes_rsvp' );
}

if( ! function_exists( 'wc_shortcodes_posts' ) ) {
	/**
	 * Display posts in various formats
	 *
	 * @since 3.8
	 * @access public
	 *
	 * @param mixed $atts
	 * @return void
	 */
	function wc_shortcodes_posts( $atts ) {
		global $data;
		global $post;
		global $wc_shortcodes_posts_query;

		static $instance = 0;
		$instance++;

		if ( (is_front_page() || is_home() ) ) {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
		} else {
			$paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
		}

		$atts = shortcode_atts( array(
			'author' => '', //use author id
			'author_name' => '', //use 'user_nicename' (NOT name).
			'p' => false, //use post id.
			'post__in' => false, //use post ids
			'order' => 'DESC', // DESC, ASC
			'orderby' => 'date',
			'post_status' => 'publish',
			'post_type' => 'post', // post, page, wc_portfolio_item, etc
			'posts_per_page' => 10, //number of post to show per page
			'nopaging' => false, //show all posts or use pagination. Default value is 'false', use paging.
			'paged' => $paged, // number of page. Show the posts that would normally show up just on page X when using the "Older Entries" link.
			'ignore_sticky_posts' => 0,

			'taxonomy' => '', // category, post_tag, wc_portfolio_tag, etc
			'field' => 'slug', // slug or id
			'terms' => '', // taxonomy terms.

			'title' => true, // show heading?
			'meta_all' => true, // show all meta info?
			'meta_author' => true, // show author?
			'meta_date' => true, // show date?
			'meta_comments' => true, // show comments?
			'thumbnail' => true, // show thumbnail?
			'content' => true, // show main content?
			'paging' => true, // show pagination navigation?

			'size' => 'large', // default thumbnail size

			'filtering' => true, // insert isotope filter navigation
			'columns' => '3', // default number of isotope columns
			'gutter_space' => '20', // gutter width percentage relative to parent element width
			'heading_type' => 'h2', // heading tag for title
			'layout' => 'masonry', // blog layout
			'template' => 'box',
			'excerpt_length' => '55',
			'date_format' => 'M j, Y',
		), $atts );

		// fix bug with title argument being added to WP_Query() in 4.4
		$keys = array(
			'title',
			'meta_all',
			'meta_author',
			'meta_date',
			'meta_comments',
			'thumbnail',
			'content',
			'paging',
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

		// changed default layout name. Let's catch old inputs
		$valid_layouts = array( 'masonry', 'grid' );
		if ( ! in_array( $display['layout'], $valid_layouts ) ) {
			$display['layout'] = "masonry";
		}

		$valid_templates = array( 'box', 'borderless' );
		if ( ! in_array( $display['template'], $valid_templates ) ) {
			$display['template'] = "box";
		}

		// clean input values
		$atts['terms'] = wc_shortcodes_comma_delim_to_array( $atts['terms'] );
		$wpc_term = null;
		if ( isset( $_GET['wpc_term'] ) && ! empty( $_GET['wpc_term'] ) ) {
			$wpc_term = $_GET['wpc_term'];
		}
		$atts['post__in'] = wc_shortcodes_comma_delim_to_array( $atts['post__in'] );
		$display['columns'] == (int) $display['columns'];
		$display['excerpt_length'] = (int) $display['excerpt_length'];
		$atts['order'] = strtoupper( $atts['order'] );
		$display['heading_type'] = strtolower( $display['heading_type'] );

		if ( ! is_numeric( $display['gutter_space'] ) ) {
			$display['gutter_space'] = 20;
		}
		if ( $display['gutter_space'] > 0 && $display['gutter_space'] < 1 ) {
			$display['gutter_space'] = (int) ( $display['gutter_space'] * 1000 );
		}
		$display['gutter_space'] = (int) $display['gutter_space'];
		if ( $display['gutter_space'] > 50 || $display['gutter_space'] < 0 ) {
			$display['gutter_space'] = 20;
		}

		if (isset($atts['posts_per_page']) && $atts['posts_per_page']) {
			$atts['posts_per_page'] = (int) $atts['posts_per_page'];
		}
		else {
			$atts['posts_per_page'] = 0;
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

		// no paging needed when showing all posts
		if(isset($atts['posts_per_page']) && $atts['posts_per_page'] == -1) {
			$atts['nopaging'] = true;
		}

		// setting attributes right for the php script
		$valid_headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		$display['heading_type'] = in_array( $display['heading_type'], $valid_headings ) ? $display['heading_type'] : 'h2';

		$valid_columns = array( 1, 2, 3, 4, 5, 6, 7, 8, 9 );
		$display['columns'] = in_array( $display['columns'], $valid_columns ) ? $display['columns'] : 2;
		if ( $display['columns'] == 1 ) {
			$display['layout'] = 'single-column';
		}
		
		($display['title'] == "yes") ? ($display['title'] = true) : ($display['title'] = false);
		($display['meta_all'] == "yes") ? ($display['meta_all'] = true) : ($display['meta_all'] = false);
		($display['meta_author'] == "yes") ? ($display['meta_author'] = true) : ($display['meta_author'] = false);
		($display['meta_date'] == "yes") ? ($display['meta_date'] = true) : ($display['meta_date'] = false);
		($display['meta_comments'] == "yes") ? ($display['meta_comments'] = true) : ($display['meta_comments'] = false);
		($display['thumbnail'] == "yes") ? ($display['thumbnail'] = true) : ($display['thumbnail'] = false);
		($display['content'] == "yes") ? ($display['content'] = true) : ($display['content'] = false);
		($display['paging'] == "yes" && ! $atts['nopaging']) ? ($display['paging'] = true) : ($display['paging'] = false);
		($display['filtering'] == "yes") ? ($display['filtering'] = true) : ($display['filtering'] = false);
		($atts['order'] == "ASC") ? ($atts['order'] = "ASC") : ($atts['order'] = "DESC");

		$is_masonry =  'masonry' == $display['layout'] ? true : false;
		$is_grid =  'grid' == $display['layout'] ? true : false;

		if ( $is_masonry ) {
			wp_enqueue_script('wc-shortcodes-posts');
		}
		else if ( $is_grid ) {
			wp_enqueue_script('wc-shortcodes-posts-grid');
		}

		$nav_filter_hard_links = false;
		if ( $display['paging'] ) {
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
				
				if ( $display['content'] && empty( $post->post_excerpt ) && empty( $post->post_content ) )
					$display['content'] = false;

				ob_start();
				include('templates/'.$display['template'].'/index.php');
				$html .= ob_get_clean();

			endwhile;

		$html .= '</div>';
		$html .= '</div>';

		//no paging if only the latest posts are shown
		if ( $display['paging'] ) {
			ob_start();
			include('templates/nav-pagination.php');
			$html .= ob_get_clean();
		}
		wp_reset_query();
		return $html;
	}
}
add_shortcode( 'wc_posts', 'wc_shortcodes_posts' );

if( ! function_exists( 'wc_shortcodes_post_slider' ) ) {
	function wc_shortcodes_post_slider( $atts ) {
		global $data;
		global $post;
		global $wc_shortcodes_posts_query;

		static $instance = 0;
		$instance++;

		$atts = shortcode_atts( array(
			'author' => '', //use author id
			'author_name' => '', //use 'user_nicename' (NOT name).
			'pids' => '', //use post id.
			'p' => '', //use post id.
			'post__in' => '', //use post ids
			'order' => 'DESC', // DESC, ASC
			'orderby' => 'date',
			'post_status' => 'publish',
			'post_type' => 'post', // post, page, wc_portfolio_item, etc
			'posts_per_page' => 10, //number of post to show per page
			'nopaging' => false, //show all posts or use pagination. Default value is 'false', use paging.
			'ignore_sticky_posts' => 1,

			'taxonomy' => '', // category, post_tag, wc_portfolio_tag, etc
			'field' => 'slug', // slug or id
			'terms' => '', // taxonomy terms.

			'show_meta_category' => 1, // show heading?
			'show_title' => 1, // show heading?
			'show_content' => 1, // show main content?
			'readmore' => 'Continue Reading', // show main content?
			'button_class' => 'button secondary-button', // show main content?

			'size' => 'full', // default thumbnail size

			'heading_type' => 'h2', // heading tag for title
			'heading_size' => 30,
			'mobile_heading_size' => 24,
			'layout' => 'bxslider', // blog layout
			'template' => 'slider2',
			'excerpt_length' => 55,
			'desktop_height' => 600,
			'laptop_height' => 500,
			'mobile_height' => 350,

			'slider_mode' => 'fade',
			'slider_pause' => 4000,
			'slider_auto' => 0,
		), $atts );

		// sanitize bools
		$bools = array( 'ignore_sticky_posts', 'show_meta_category', 'show_title', 'show_content', 'slider_auto' );
		foreach ( $bools as $key ) {
			if ( isset( $atts[ $key ] ) ) {
				if ( "no" == $key ) {
					$atts[ $key ] = 0;
				}
				else {
					$atts[ $key ] = (bool) $atts[ $key ];
					$atts[ $key ] = $atts[ $key ] ? 1 : 0;
				}
			}
		}

		// sanitize ints
		$ints = array( 'p', 'posts_per_page', 'heading_size', 'mobile_heading_size', 'excerpt_length', 'desktop_height', 'laptop_height', 'mobile_height', 'slider_pause' );
		foreach ( $ints as $key ) {
			if ( isset( $atts[ $key ] ) ) {
				$atts[ $key ] = (int) $atts[ $key ];
			}
		}
		$atts['slider_pause'] = abs( $atts['slider_pause'] );

		$pids = explode( ',', $atts['pids'] );
		$p = array();
		if ( ! empty( $pids ) ) {
			foreach ( $pids as $id ) {
				$id = (int) $id;
				if ( ! empty( $id ) ) {
					$p[] = $id;
				}
			}

			$size = sizeof( $p );
			if ( 1 < $size ) {
				$atts['p'] = '';
				$atts['post__in'] = $p;
			}
			else if ( 1 == $size ) {
				$atts['p'] = $p[0];
				$atts['post__in'] = '';
			}
			else {
				$atts['p'] = '';
				$atts['post__in'] = '';
			}
		}

		// sanitize limit
		if ( $atts['posts_per_page'] < 0 ) {
			$atts['posts_per_page'] = -1;
			$atts['nopaging'] = true;
		}
		else if ( 0 == $atts['posts_per_page'] ) {
			return;
		}

		// sanitize dropdown
		$valid_layouts = array( 'bxslider' );
		if ( ! in_array( $atts['layout'], $valid_layouts ) ) {
			$atts['layout'] = 'bxslider';
		}

		$valid_templates = array( 'slider1', 'slider2' );
		if ( ! in_array( $atts['template'], $valid_templates ) ) {
			$atts['template'] = 'slider1';
		}

		$valid_slider_modes = array( 'fade', 'vertical', 'horizontal' );
		if ( ! in_array( $atts['slider_mode'], $valid_slider_modes ) ) {
			$atts['slider_mode'] = 'fade';
		}

		$valid_orders = array( 'ASC', 'DESC' );
		$atts['order'] = strtoupper( $atts['order'] );
		if ( ! in_array( $atts['order'], $valid_orders ) ) {
			$atts['order'] = 'DESC';
		}

		$atts['heading_type'] = strtolower( $atts['heading_type'] );
		$valid_headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		$atts['heading_type'] = in_array( $atts['heading_type'], $valid_headings ) ? $atts['heading_type'] : 'h2';

		// sanitize inputs
		$atts['button_class'] = trim( $atts['button_class'] );
		$atts['button_class'] = empty( $atts['button_class'] ) ? 'wc-shortcodes-post-slide-button' : $atts['button_class'];

		$terms = explode( ',', trim( $atts['terms'] ) );
		$t = array();
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$term = trim( $term );
				if ( ! empty( $term ) ) {
					$t[] = $term;
				}
			}
			$atts['terms'] = $t;
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
}
add_shortcode( 'wc_post_slider', 'wc_shortcodes_post_slider' );

if( !function_exists('wc_shortcodes_image') ) {
	function wc_shortcodes_image( $atts ) {
		extract( shortcode_atts( array(
			// attachment detail settings
			'title' => '',
			'alt' => '',
			'caption' => '',

			// attachment display settings
			'link_to' => '', // post, file, none
			'url' => '', // for custom link_to
			'align' => '', // none, left, center, right
			'attachment_id' => '', // int id
			'size' => 'large', // image size

			// flag options
			'flag' => '',
			'left' => '',
			'right' => '',
			'top' => '',
			'bottom' => '',
			'text_color' => '',
			'background_color' => '',
			'font_size' => '',
			'text_align' => '', // none, left, center, right
			'flag_width' => '',

			// misc options
			'class' => '',
		), $atts ) );

		$font_size = WCShortcodes_Sanitize::css_unit( $font_size );
		$flag_width = WCShortcodes_Sanitize::css_unit( $flag_width );

		// function options
		$div_wrapper = false;

		// sanitize
		$attachment_id = WCShortcodes_Sanitize::number( $attachment_id );

		// classes
		$classes = array();

		$classes[] = 'wc-shortcodes-image';

		$whitelist = array( 'none', 'left', 'center', 'right' );
		if ( in_array( $align, $whitelist ) )
			$classes[] = 'align' . $align;

		if ( ! empty( $size ) )
			$classes[] = 'size-' . $size;

		if ( ! empty( $attachment_id ) )
			$classes[] = 'wp-image-' . $attachment_id;

		if ( ! empty( $class ) )
			$classes[] = $class;

		// check if src is set
		list( $src, $width, $height ) = wp_get_attachment_image_src( $attachment_id, $size );
		if ( empty( $src ) ) {
			return '<p>Please insert a valid image</p>';
		}

		$html = '<img alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" src="' . esc_url( $src ) . '" class="' . esc_attr( implode( ' ', $classes ) ) . '" />';

		// insert flag
		if ( ! empty( $flag ) ) {
			$style = array();
			if ( is_numeric( $top ) )
				$style[] = 'top:' . (int) $top . 'px';
			if ( is_numeric( $right ) )
				$style[] = 'right:' . (int) $right . 'px';
			if ( is_numeric( $bottom ) )
				$style[] = 'bottom:' . (int) $bottom . 'px';
			if ( is_numeric( $left ) )
				$style[] = 'left:' . (int) $left . 'px';
			if ( ! empty( $background_color ) )
				$style[] = 'background-color:' . $background_color;
			if ( ! empty( $text_color ) )
				$style[] = 'color:' . $text_color;
			if ( ! empty( $font_size ) )
				$style[] = 'font-size:' . $font_size;
			if ( in_array( $text_align, $whitelist ) )
				$style[] = 'text-align:' . $text_align;
			if ( ! empty( $flag_width ) )
				$style[] = 'width:' . $flag_width;


			$html .= '<span style="' . esc_attr( implode( ';', $style ) ) . '" class="wc-shortcodes-image-flag-bg"><span class="wc-shortcodes-image-flag-text">' . esc_html( $flag ) . '</span></span>';
			$div_wrapper = true;
			
		}

		// check link_to
		if ( empty( $url ) ) {
			if ( 'file' == $link_to )
				$url = wp_get_attachment_url( $attachment_id );
			else if ( 'post' == $link_to )
				$url = get_attachment_link( $attachment_id );
		}

		if ( 'none' != $link_to )
			$html = '<a class="wc-shortcodes-image-anchor" href="' . esc_url( $url ) . '">' . $html . '</a>';

		// insert caption
		if ( ! empty( $caption ) ) {
			$html .= '<p class="wp-caption-text">' . esc_html( $caption ) . '</p>';
			$div_wrapper = true;
		}

		// do we need a div wrapper?
		if ( $div_wrapper ) {
			$html = preg_replace( '/(class=["\'][^\'"]*)align(none|left|right|center)\s?/', '$1', $html );
			$html = '<div id="attachment_' . esc_attr( $attachment_id ) . '" class="wc-shortcodes-image-wrapper wc-shortcodes-item wp-caption align' . esc_attr( $align ) . '" style="width:' . $width . 'px">' . $html . '</div>';
		}
		else if ( in_array( $align, array( 'none', 'center' ) ) ) {
			$html = '<p>' . $html . '</p>';
		}

		return $html;
	}
	add_shortcode( 'wc_image', 'wc_shortcodes_image' );
}

if( !function_exists('wc_shortcodes_fa') ) {
	function wc_shortcodes_fa( $atts ) {
		extract( shortcode_atts( array(
			// icon options
			'icon' => '',
			'margin_right' => '0',
			'margin_left' => '0',

			// misc options
			'class' => '',
		), $atts ) );

		$margin_right = WCShortcodes_Sanitize::css_unit( $margin_right );
		$margin_left = WCShortcodes_Sanitize::css_unit( $margin_left );

		if ( empty( $icon ) )
			return '';

		// classes
		$classes = array();

		$classes[] = 'wc-shortcodes-fa';
		$classes[] = 'fa';
		$classes[] = 'fa-' . $icon;
		if ( empty( $class ) )
			$classes[] = $class;

		$style_attr = '';

		if( $margin_right ) {
			$style_attr .= 'margin-right: '. $margin_right .';';
		}
		if ( $margin_left ) {
			$style_attr .= 'margin-left: '. $margin_left .';';
		}

		$html = '<i class="' . esc_attr( implode( ' ', $classes ) ) . '" style="'.esc_attr( $style_attr ).'"></i>';

		return $html;
	}
	add_shortcode( 'wc_fa', 'wc_shortcodes_fa' );
}

if ( ! function_exists('wc_shortcodes_share_buttons') ) {
	function wc_shortcodes_share_buttons( $atts ) {
		extract( shortcode_atts( array(
			// misc options
			'class' => '',
		), $atts ) );

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
	add_shortcode( 'wc_share', 'wc_shortcodes_share_buttons' );
}

if ( ! function_exists('wc_shortcodes_get_share_buttons') ) {
	function wc_shortcodes_get_share_buttons() {
		$html = null;
		$share_buttons = null;

		$share_buttons = wc_shortcodes_share_buttons( null );

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
	add_shortcode( 'wc_share_buttons', 'wc_shortcodes_get_share_buttons' );
}
