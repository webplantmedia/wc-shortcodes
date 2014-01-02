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
	extract(shortcode_atts(array(
		'selector' => '#main',
	), $atts));

	wp_enqueue_script('wc-shortcodes-fullwidth');

	return '<div class="wc-shortcodes-full-width" data-selector="' . esc_attr($selector) . '">' . do_shortcode( $content ) . '</div>';
}


// /*
//  * Fix Shortcodes
//  * @since v1.0
//  */
// if( !function_exists('wc_shortcodes_fix') ) {
// 	function wc_shortcodes_fix($content){   
// 		$array = array (
// 			'<p>['		=> '[', 
// 			']</p>'		=> ']', 
// 			']<br />'	=> ']'
// 		);
// 		$content = strtr($content, $array);
// 		return $content;
// 	}
// 	add_filter('the_content', 'wc_shortcodes_fix');
// }


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


	$name = trim( $name );
	$name = preg_replace( '/^_/', '', $name );

	if ( empty( $name ) )
		return null;

	if ( $snippet = get_post_meta($post->ID, $name, true ) ) {
        $html = '<div class="wc-shortcodes-html-wrapper">' . $snippet . '</div>';
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

	$name = trim( $name );
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
		$html .= '<pre id="prettycode-'.$instance.'" class="'.$class.'">';
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
 * @since v1.4
 */
if( !function_exists('wc_shortcodes_callout') ) {
	function wc_shortcodes_callout( $atts, $content = NULL  ) {		
		extract( shortcode_atts( array(
			'caption'				=> '',
			'button_text'			=> '',
			'button_color'			=> 'blue',
			'button_url'			=> 'http://www.wpexplorer.com',
			'button_rel'			=> 'nofollow',
			'button_target'			=> 'blank',
			'button_border_radius'	=> '',
			'class'					=> '',
			'icon_left'				=> '',
			'icon_right'			=> ''
		), $atts ) );
		
		$border_radius_style = ( $button_border_radius ) ? 'style="border-radius:'. $button_border_radius .'"' : NULL;
		$output = '<div class="wc-shortcodes-callout wc-shortcodes-clearfix '. $class .'">';
		$output .= '<div class="wc-shortcodes-callout-caption">';
			if ( $icon_left ) $output .= '<span class="wc-shortcodes-callout-icon-left icon-'. $icon_left .'"></span>';
			$output .= do_shortcode ( $content );
			if ( $icon_right ) $output .= '<span class="wc-shortcodes-callout-icon-right icon-'. $icon_right .'"></span>';
		$output .= '</div>';	
		if ( $button_text !== '' ) {
			$output .= '<div class="wc-shortcodes-callout-button">';
				$output .='<a href="'. $button_url .'" title="'. $button_text .'" target="_'. $button_target .'" class="wc-shortcodes-button '.$button_color .'" '. $border_radius_style .'><span class="wc-shortcodes-button-inner">'. $button_text .'</span></a>';
			$output .='</div>';
		}
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'wc_callout', 'wc_shortcodes_callout' );
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
		
		// Enque scripts
		wp_enqueue_script('wc-shortcodes-skillbar');
		
		// Display the accordion	';
		$output = '<div class="wc-shortcodes-skillbar wc-shortcodes-clearfix '. $class .'" data-percent="'. $percentage .'%">';
			if ( $title !== '' ) $output .= '<div class="wc-shortcodes-skillbar-title" style="background: '. $color .';"><span>'. $title .'</span></div>';
			$output .= '<div class="wc-shortcodes-skillbar-bar" style="background: '. $color .';"></div>';
			if ( $show_percent == 'true' ) {
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
		  ),
		  $atts ) );
	 return '<hr class="wc-shortcodes-spacing '. $class .'" style="height: '. $size .'" />';
	}
	add_shortcode( 'wc_spacing', 'wc_shortcodes_spacing' );
}


/**
* Social Icons
* @since 1.0
*/
if( !function_exists('wc_shortcodes_social_icons') ) {
	function wc_shortcodes_social_icons( $atts ){   
		$social = array(
			'facebook' => 'Facebook',
			'google' => 'Google',
			'twitter' => 'Twitter',
			'pinterest' => 'Pinterest',
			'instagram' => 'Instagram',
			'bloglovin' => 'BlogLovin',
			'flickr' => 'Flickr',
			'rss' => 'RSS',
			'email' => 'Email',
			'custom1' => 'Custom 1',
			'custom2' => 'Custom 2',
			'custom3' => 'Custom 3',
			'custom4' => 'Custom 4',
			'custom5' => 'Custom 5',
		);

		extract(shortcode_atts(array(
			'class'      => '',
			'size'		 => 'large',
			'align' => 'left',
			'display' => 'facebook,google,twitter,pinterest,instagram,bloglovin,flickr,rss,email,custom1,custom2,custom3,custom4,custom5',
		), $atts));

		$class = trim( 'wc-shortcodes-social-icons-wrapper ' . $class );

		$order = explode( ',', $display );
		$first = true;

		$html = '<div class="' . $class . '">';
			$html .= '<ul class="wc-shortcodes-social-icons wc-shortcodes-clearfix wc-shortcodes-social-icons-align-'.$align.' wc-shortcodes-social-icons-size-'.$size.'">';
				foreach ( $order as $key ) {
					if ( ! array_key_exists( $key, $social ) )
						continue;

					$link_option_name = WC_SHORTCODES_PREFIX . $key . '_link';
					$icon_option_name = WC_SHORTCODES_PREFIX . $key . '_icon';

					if (  $icon_url = get_option( $icon_option_name ) ) {
						$social_link = get_option( $link_option_name );
						$social_link = apply_filters( 'wc_shortcodes_social_link', $social_link, $key );

						if ( empty( $social_link ) )
							continue;

						$first_class = $first ? ' first-icon' : '';
						$first = false;

						$html .= '<li class="wc-shortcodes-social-icon wc-shortcode-social-icon-' . $key . $first_class . '">';
							$html .='<a href="'.$social_link.'">';
								$html .= '<img src="'.$icon_url.'">';
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
		  ),
		  $atts ) );
		  return '<span class="wc-shortcodes-highlight wc-shortcodes-highlight-'. $color .' '. $class .'">' . do_shortcode( $content ) . '</span>';
	
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
		), $atts ) );

		$whitelist = array( 'center', 'left', 'right' );
		
		// $border_radius_style = ( $border_radius ) ? 'style="border-radius:'. $border_radius .'"' : NULL;		
		$rel = ( $rel ) ? 'rel="'.$rel.'"' : NULL;
		$type = 'wc-shortcodes-button-' . $type;
		
		$class = array();
		$class[] = 'wc-shortcodes-button';
		$class[] = $type;
		$class[] = 'wc-shortcodes-button-position-' . $position;
		
		$button = NULL;
		$button .= '<a href="' . $url . '" class="'.implode( ' ', $class ).'" target="_'.$target.'" title="'. $title .'" '. $rel .'>';
			$button .= '<span class="wc-shortcodes-button-inner">';
				if ( $icon_left ) $button .= '<span class="wc-shortcodes-button-icon-left icon-'. $icon_left .'"></span>';
				$button .= $content;
				if ( $icon_right ) $button .= '<span class="wc-shortcodes-button-icon-right icon-'. $icon_right .'"></span>';
			$button .= '</span>';			
		$button .= '</a>';

		if ( in_array( $position, $whitelist ) ) {
			$button = '<div class="wc-shortcodes-button-'.$position.'">'. $button .'</div>';
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

		$style_attr = '';

		if( $margin_bottom ) {
			$style_attr .= 'margin-bottom: '. $margin_bottom .';';
		}
		if ( $margin_top ) {
			$style_attr .= 'margin-top: '. $margin_top .';';
		}

		$alert_content = '';
		$alert_content .= '<div class="wc-shortcodes-box wc-shortcodes-clearfix wc-shortcodes-box-' . $color . ' '. $class .'" style="text-align:'. $text_align .';'. $style_attr .'">';
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
			$url = esc_url( $url );
			$by = '<a href="' . $url . '">' . $by . '</a>';
		}

		$testimonial_content = '';
		$testimonial_content .= '<div class="wc-shortcodes-testimonial wc-shortcodes-clearfix wc-shortcodes-testimonial-'.$position.' '. $class .'"><div class="wc-shortcodes-testimonial-content">';
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

		// $append_clearfix = '<div class="wc-shortcodes-clear-floats"></div>';
		$style = empty( $max_width ) ? '' : ' style="max-width:'.$max_width.';"';

		return '<div class="wc-shortcodes-center wc-shortcodes-clearfix wc-shortcodes-center-inner-align-'. $text_align .' '. $class .'"' . $style . '>' . do_shortcode($content) . '</div>';
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
				$style = ' style="text-align: '.$text_align.';"';
			if ( 'center' == $text_align )
				$style = ' style="text-align: '.$text_align.';"';
			if ( 'right' == $text_align )
				$style = ' style="text-align: '.$text_align.';"';
		}

		$append_clearfix = 'last' == $position ? '<div class="wc-shortcodes-clear-floats"></div>' : '';

		return '<div'.$style.' class="wc-shortcodes-column wc-shortcodes-' . $size . ' wc-shortcodes-column-'.$position.' '. $class .'">' . do_shortcode($content) . '</div>';
	}
}




/*
 * Rows
 * @since v1.0
 *
 */
if( !function_exists('wc_shortcodes_row') ) {
	function wc_shortcodes_row( $atts, $content = null ){
		return '<div class="wc-shortcodes-row wc-shortcodes-clearfix">' . do_shortcode($content) . '</div>';
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
		), $atts ) );

		$style = array();

		if ( ! empty( $padding ) || '0' === $padding )
			$style[] = 'padding:'.$padding;
		if ( ! empty( $border_width ) || '0' === $border_width )
			$style[] = 'border-width:'.$border_width;

		$style = implode( ';', $style );
		 
		// Enque scripts
		wp_enqueue_script('wc-shortcodes-toggle');
		
		// Display the Toggle
		return '<div class="wc-shortcodes-toggle '. $class .'"><div class="wc-shortcodes-toggle-trigger"><a href="#">'. $title .'</a></div><div style="'.$style.'" class="wc-shortcodes-toggle-container">' . do_shortcode($content) . '</div></div>';
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
		), $atts ) );

		$type = 'wc-shortcodes-accordion-default';

		if ( (int) $collapse )
			$type = 'wc-shortcodes-accordion-collapse';
		
		// Enque scripts
		wp_enqueue_script('wc-shortcodes-accordion');
		
		// Display the accordion	
		return '<div class="wc-shortcodes-accordion '.$type.' '. $class .'">' . do_shortcode($content) . '</div>';
	}
}


// Section
if( !function_exists('wc_shortcodes_accordion_section') ) {
	function wc_shortcodes_accordion_section( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'title'	=> 'Title',
			'class'	=> '',
			'padding'	=> '',
			'border_width'	=> '',
		), $atts ) );

		$style = array();

		if ( ! empty( $padding ) || '0' === $padding )
			$style[] = 'padding:'.$padding;
		if ( ! empty( $border_width ) || '0' === $border_width )
			$style[] = 'border-width:'.$border_width;

		$style = implode( ';', $style );
		  
		return '<div class="wc-shortcodes-accordion-trigger '. $class .'"><a href="#">'. $title .'</a></div><div style="'.$style.'" class="wc-shortcodes-accordion-content">' . do_shortcode($content) . '</div>';
	}
	
}


/*
 * Tabs
 * @since v1.0
 *
 */
if (!function_exists('wc_shortcodes_tabgroup')) {
	function wc_shortcodes_tabgroup( $atts, $content = null ) {
		
		//Enque scripts
		wp_enqueue_script('wc-shortcodes-tabs');
		
		// Display Tabs
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
		if( count($tab_titles) ){
		    $output .= '<div id="wc-shortcodes-tab-'. rand(1, 100) .'" class="wc-shortcodes-tabs">';
			$output .= '<ul class="ui-tabs-nav wc-shortcodes-clearfix">';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#wc-shortcodes-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
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
			'class'	=> ''
		);
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="wc-shortcodes-tab-'. sanitize_title( $title ) .'" class="tab-content '. $class .'">'. do_shortcode( $content ) .'</div>';
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
			'type'					=> 'primary',
			'plan'					=> 'Basic',
			'cost'					=> '$20',
			'per'					=> 'month',
			'button_url'			=> '',
			'button_text'			=> 'Purchase',
			'button_target'			=> 'self',
			'button_rel'			=> 'nofollow',
			'class'					=> '',
		), $atts ) );
		
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="wc-shortcodes-pricing wc-shortcodes-pricing-type-'. $type .' '. $class .'">';
			$pricing_content .= '<div class="wc-shortcodes-pricing-header">';
				$pricing_content .= '<h5>'. $plan. '</h5>';
				$pricing_content .= '<div class="wc-shortcodes-pricing-cost">'. $cost .'</div><div class="wc-shortcodes-pricing-per">'. $per .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="wc-shortcodes-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_url ) {
				$pricing_content .= '<div class="wc-shortcodes-pricing-button"><a href="'. $button_url .'" class="wc-shortcodes-button wc-shortcodes-button-'.$type.'" target="_'. $button_target .'" rel="'. $button_rel .'"><span class="wc-shortcodes-button-inner">'. $button_text .'</span></a></div>';
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
			'icon_right'	=> ''
		), $atts ) );

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

	 	$output = '<'.$type.' class="wc-shortcodes-heading '. $text_align .' '. $class .'" style="'.$style_attr.'"><span>';
		if ( $icon_left ) $output .= '<i class="wc-shortcodes-button-icon-left icon-'. $icon_left .'"></i>';
			$output .= $title;
		if ( $icon_right ) $output .= '<i class="wc-shortcodes-button-icon-right icon-'. $icon_right .'"></i>';
		$output .= '</'.$type.'></span>';

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
		
		extract(shortcode_atts(array(
				'title'		=> '',
				'location'	=> '',
				'width'		=> '',
				'height'	=> '300',
				'zoom'		=> 8,
				'align'		=> '',
				'class'		=> '',
		), $atts));
		
		// load scripts
		wp_enqueue_script('wc-shortcodes-googlemap');
		wp_enqueue_script('wc-shortcodes-googlemap-api');
		
		
		$output = '<div id="map_canvas_'.rand(1, 100).'" class="googlemap '. $class .'" style="height:'.$height.'px;width:100%">';
			$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
			$output .= '<input class="location" type="hidden" value="'.$location.'" />';
			$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
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

		$style_attr = array();

		if ( $margin_top && $margin_bottom ) {  
			$style_attr[] = 'margin-top: '. $margin_top .';margin-bottom: '. $margin_bottom .';';
		} elseif( $margin_bottom ) {
			$style_attr[] = 'margin-bottom: '. $margin_bottom .';';
		} elseif ( $margin_top ) {
			$style_attr[] = 'margin-top: '. $margin_top .';';
		}

		if ( ! empty ( $style_attr ) ) {
			$style_attr = 'style="' . implode( '', $style_attr ) . '"';
		}
		else {
			$style_attr = '';
		}

	 return '<hr class="wc-shortcodes-divider wc-shortcodes-divider-line-'.$line.' wc-shortcodes-divider-style-'. $style .' '. $class .'" '.$style_attr.' />';
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
			'message' => 'Your Message Here!',
		), $atts ) );

		if ( empty( $date ) ) {
			return '<p>*Please enter a date for your countdown*</p>';
		}

		wp_enqueue_script('wc-shortcodes-countdown');

		$html = '<div class="wc-shortcodes-countdown" data-date="'.esc_attr( $date ).'" data-format="'.esc_attr( $format ).'" data-message="'.esc_attr( $message ).'"></div>';
		$html = '<div class="wc-shortcodes-countdown-bg1">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg2">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg3">'.$html.'</div>';
		$html = '<div class="wc-shortcodes-countdown-bg4">'.$html.'</div>';

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

		$columns = (int) $columns;
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
		$message_html = '<div class="wc-shortcodes-box wc-shortcodes-clearfix wc-shortcodes-box-info"><p class="rsvp-message">Hello</p></div>';

		// Style

		$html .= $action_html;

		if ( 3 == $columns ) {
			$html .= '<div class="wc-shortcodes-row wc-shortcodes-clearfix">';
			$html .= '	<div class="wc-shortcodes-column wc-shortcodes-one-third wc-shortcodes-column-first ">'.$name_html.'</div>';
			$html .= '	<div class="wc-shortcodes-column wc-shortcodes-one-third wc-shortcodes-column- ">'.$number_html.'</div>';
			$html .= '	<div class="wc-shortcodes-column wc-shortcodes-one-third wc-shortcodes-column-last ">'.$event_html.'</div>';
			$html .= '</div>';
			$html .= $message_html;
			$html .= $button_html;
		}
		else {
			$html .= $name_html . $number_html . $event_html . $message_html . $button_html;
		}

		return '<div class="wc-shortcodes-rsvp wc-shortcodes-rsvp-columns-'.$columns.' wc-shortcodes-rsvp-align-'.esc_attr($align).' rsvp-button-align-'.esc_attr($button_align).'">' . do_shortcode( $html ) . '</div>';
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

		wp_enqueue_script('wordpresscanvas-isotope');
		wp_enqueue_script('wc-shortcodes-posts');

		if((is_front_page() || is_home() ) ) {
			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		} else {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}

		// get specified number of posts per page
		if (isset($atts['number_posts']) && $atts['number_posts']) {
			$atts['number_posts'] = (int) $atts['number_posts'];
		}
		else {
			$atts['number_posts'] = 0;
		}

		$atts = shortcode_atts( array(
			'author'              => '',
			'author_name'		  => '',
			'category_name'       => '',
			'cat'      			  => '',
			'id'                  => false,
			'p'					  => false,
			'post__in'			  => false,
			'order'               => 'DESC',
			'orderby'             => 'date',
			'post_status'         => 'publish',
			'post_type'           => 'post',
			'posts_per_page'	  => (int) $atts['number_posts'],
			'nopaging'			  => false,
			'paged'				  => $paged,
			'tag'                 => '',
			'tax_operator'        => 'IN',
			'tax_term'            => false,
			'taxonomy'            => 'category',
			'title_meta'		  => '',
			'include_shortcodes'  => false,
			'layout' 			  => 'large',

			'cat_slug'			  => '',
			'title'				  => true,
			'meta_all'			  => true,
			'meta_author' 		  => true,
			'meta_date' 		  => true,
			'meta_categories'  	  => true,
			'meta_comments'  	  => true,
			'meta_link'  	  	  => true,
			'thumbnail'			  => true,
			'excerpt'			  => true,
			'excerpt_words'		  => '50',
			'strip_html'		  => true,
			'paging'			  => true,
			'scrolling'		      => 'infinite',
			'posts_grid_columns'  => '3',
			'heading_type'        => 'h2',
		), $atts );



		if(isset($atts['posts_per_page']) && $atts['posts_per_page'] == -1) {
			$atts['nopaging'] = true;
		}

		// setting attributes right for the php script
		$valid_headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		$atts['heading_type'] = in_array( $atts['heading_type'], $valid_headings ) ? $atts['heading_type'] : 'h2';

		$valid_posts = array( 2, 3, 4 );
		$atts['posts_grid_columns'] == (int) $atts['posts_grid_columns'];
		$atts['posts_grid_columns'] = in_array( $atts['posts_grid_columns'], $valid_posts ) ? $atts['posts_grid_columns'] : 2;
		
		($atts['title'] == "yes") ? ($atts['title'] = true) : ($atts['title'] = false);
		($atts['meta_all'] == "yes") ? ($atts['meta_all'] = true) : ($atts['meta_all'] = false);
		($atts['meta_author'] == "yes") ? ($atts['meta_author'] = true) : ($atts['meta_author'] = false);
		($atts['meta_date'] == "yes") ? ($atts['meta_date'] = true) : ($atts['meta_date'] = false);
		($atts['meta_categories'] == "yes") ? ($atts['meta_categories'] = true) : ($atts['meta_categories'] = false);
		($atts['meta_comments'] == "yes") ? ($atts['meta_comments'] = true) : ($atts['meta_comments'] = false);
		($atts['meta_link'] == "yes") ? ($atts['meta_link'] = true) : ($atts['meta_link'] = false);

		//checking if there are categories that are excluded using "-"; transform slugs to ids
		$cat_ids ='';
		$categories = explode(',', $atts['cat_slug']);
		if ( isset($cateogries) && $categories) {
			foreach ($categories as $category) {
				if(strpos($category, '-') === 0) {
					$cat_ids .= '-' .get_category_by_slug( $category )->cat_ID .',';
				} else {
					$cat_ids .= get_category_by_slug( $category )->cat_ID .',';
				}
			}
		}
		$atts['cat'] = substr($cat_ids, 0, -1);

		($atts['thumbnail'] == "yes") ? ($atts['thumbnail'] = true) : ($atts['thumbnail'] = false);
		($atts['thumbnail'] == "yes") ? ($atts['thumbnail'] = true) : ($atts['thumbnail'] = false);
		($atts['excerpt'] == "yes") ? ($atts['excerpt'] = true) : ($atts['excerpt'] = false);
		($atts['strip_html'] == "yes") ? ($atts['strip_html'] = 1) : ($atts['strip_html'] = 0);
		($atts['paging'] == "yes") ? ($atts['paging'] = true) : ($atts['paging'] = false);
		($atts['scrolling'] == "infinite") ? ($atts['paging'] = true) : ($atts['paging'] = $atts['paging']);

		$ml_query = new WP_Query($atts);

		$html = '';

		$html .= '<div data-posts-grid-columns="'.$atts["posts_grid_columns"].'" class="wc-shortcodes-posts wc-shortcodes-posts-col-'.$atts["posts_grid_columns"].'">';

		while( $ml_query->have_posts() ) :
			$ml_query->the_post();

			ob_start();
			include('templates/posts-grid.php');
			$html .= ob_get_clean();

		endwhile;

		$html .= '</div>';

		//no paging if only the latest posts are shown
		if ($atts['paging']) {
			$html .= wc_shortcodes_posts_pagination($ml_query, $pages = '', $range = 2, $atts['scrolling']);
		}
		wp_reset_query();
		return $html;
	}
}
add_shortcode( 'wc_posts', 'wc_shortcodes_posts' );

if( ! function_exists( 'wc_shortcodes_posts_pagination' ) ):
	function wc_shortcodes_posts_pagination($ml_query, $pages = '', $range = 2, $infinite_scrolling = false) {
		$html = '';

		$showitems = ($range * 2)+1;

		if((is_front_page() || is_home() ) ) {
			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		} else {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}

		if($pages == '') {
			global $wp_query;
			$pages = $ml_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}

		if(1 != $pages) {
			if ($infinite_scrolling == "infinite") {
				$html .= '<div class="pagination infinite-scroll clearfix">';
			} else {
				$html .= '<div class="pagination clearfix">';
			}

			if($paged > 1) $html .= '<a class="pagination-prev" href="'.get_pagenum_link($paged - 1).'"><span class="page-prev"></span>'.__('Previous', 'Avada').'</a>';

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					if ($paged == $i) {
						$html .= '<span class="current">'.$i.'</span>';
					} else {
						$html .= '<a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a>';
					}
				}
			}

			if ($paged < $pages) $html .= '<a class="pagination-next" href="'.get_pagenum_link($paged + 1).'">'.__('Next', 'Avada').'<span class="page-next"></span></a>';
			$html .= '</div>';
		}
		return $html;
	}
endif;
