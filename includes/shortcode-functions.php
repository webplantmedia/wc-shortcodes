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
function wordpresscanvas_pre_process_shortcode($content) {
    global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    $shortcode_tags = array();

	do_action( 'wordpresscanvas_add_preprocess_shortcodes' );

    // Do the shortcode (only the one above is registered)
    $content = do_shortcode($content);
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
add_filter('the_content', 'wordpresscanvas_pre_process_shortcode', 7);

/**
 * Add all preprocessed shortcodes here
 *
 * @since 3.6.1
 * @access public
 *
 * @return void
 */
function wordpresscanvas_add_preprocess_shortcodes() {
	add_shortcode( 'wc_fullwidth' , 'wordpresscanvas_shortcode_fullwidth' );
	add_shortcode( 'wc_column', 'wordpresscanvas_column_shortcode' );
	add_shortcode( 'wc_row', 'wordpresscanvas_row_shortcode' );
	add_shortcode( 'wc_center', 'wordpresscanvas_center_shortcode' );
	add_shortcode( 'wc_toggle', 'wordpresscanvas_toggle_shortcode' );
	add_shortcode( 'wc_accordion', 'wordpresscanvas_accordion_main_shortcode' );
	add_shortcode( 'wc_accordion_section', 'wordpresscanvas_accordion_section_shortcode' );
	add_shortcode( 'wc_tabgroup', 'wordpresscanvas_tabgroup_shortcode' );
	add_shortcode( 'wc_tab', 'wordpresscanvas_tab_shortcode' );
	add_shortcode( 'wc_testimonial', 'wordpresscanvas_testimonial_shortcode' );
	add_shortcode( 'wc_box', 'wordpresscanvas_box_shortcode' );
	add_shortcode( 'wc_pricing', 'wordpresscanvas_pricing_shortcode' );
	add_shortcode( 'wc_code' , 'wordpresscanvas_displaycode_shortcode' );
}
add_action( 'wordpresscanvas_add_preprocess_shortcodes', 'wordpresscanvas_add_preprocess_shortcodes' );


/*
 * Allow shortcodes in widgets
 * @since v1.0
 */
add_filter('widget_text', 'do_shortcode');


/**
 * wordpresscanvas_shortcode_full_width 
 *
 * @since 3.6
 * @access public
 *
 * @param array $atts 
 * @param string $content 
 * @return void
 */
function wordpresscanvas_shortcode_fullwidth( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'inside'			=>	'content'
	), $atts));

	if ( 'site' == $inside ) {
		wp_enqueue_script('wordpresscanvas_fullwidth');
	}
	else {
		$inside = 'content';
	}

	return '<div class="wc-full-width-'.$inside.'">' . do_shortcode( $content ) . '</div>';
}


// /*
//  * Fix Shortcodes
//  * @since v1.0
//  */
// if( !function_exists('wordpresscanvas_fix_shortcodes') ) {
// 	function wordpresscanvas_fix_shortcodes($content){   
// 		$array = array (
// 			'<p>['		=> '[', 
// 			']</p>'		=> ']', 
// 			']<br />'	=> ']'
// 		);
// 		$content = strtr($content, $array);
// 		return $content;
// 	}
// 	add_filter('the_content', 'wordpresscanvas_fix_shortcodes');
// }


/**
 * Easily Display HTML in post
 * 
 * @param mixed $atts 
 * @param mixed $content 
 * @access public
 * @return void
 */
function wordpresscanvas_displayhtml_shortcode( $atts, $content = null ) {
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
        $html = '<div class="wc-html-wrapper">' . $snippet . '</div>';
	}

	return $html;
}
add_shortcode( 'wc_html', 'wordpresscanvas_displayhtml_shortcode' );


/**
 * bootstrap_shortcode_displaycode 
 * 
 * @param mixed $atts 
 * @param mixed $content 
 * @access public
 * @return void
 */
function wordpresscanvas_displaycode_shortcode( $atts, $content = null ) {
	return '<code>'.$content.'</code>';
}

/**
 * bootstrap_shortcode_displaypre 
 * 
 * @param mixed $atts 
 * @param mixed $content 
 * @access public
 * @return void
 */
function wordpresscanvas_displaypre_shortcode( $atts, $content = null ) {
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
		wp_enqueue_script('wordpresscanvas_prettify');
		wp_enqueue_script('wordpresscanvas_pre');
		//$code = preg_replace( '/[ ]{4,}|[\t]/', '  ', $code );
		$html .= '<pre id="prettycode-'.$instance.'" class="'.$class.'">';
		$html .= htmlspecialchars( $code );
		$html .= '</pre>';
	}

	return $html;
}
add_shortcode( 'wc_pre' , 'wordpresscanvas_displaypre_shortcode' );


/*
 * Clear Floats
 * @since v1.0
 */
if( !function_exists('wordpresscanvas_clear_floats_shortcode') ) {
	function wordpresscanvas_clear_floats_shortcode() {
	   return '<div class="wc-clear-floats"></div>';
	}
	add_shortcode( 'wc_clear_floats', 'wordpresscanvas_clear_floats_shortcode' );
}


/*
 * Skillbars
 * @since v1.4
 */
if( !function_exists('wordpresscanvas_callout_shortcode') ) {
	function wordpresscanvas_callout_shortcode( $atts, $content = NULL  ) {		
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
		$output = '<div class="wc-callout wc-clearfix '. $class .'">';
		$output .= '<div class="wc-callout-caption">';
			if ( $icon_left ) $output .= '<span class="wc-callout-icon-left icon-'. $icon_left .'"></span>';
			$output .= do_shortcode ( $content );
			if ( $icon_right ) $output .= '<span class="wc-callout-icon-right icon-'. $icon_right .'"></span>';
		$output .= '</div>';	
		if ( $button_text !== '' ) {
			$output .= '<div class="wc-callout-button">';
				$output .='<a href="'. $button_url .'" title="'. $button_text .'" target="_'. $button_target .'" class="wc-button '.$button_color .'" '. $border_radius_style .'><span class="wc-button-inner">'. $button_text .'</span></a>';
			$output .='</div>';
		}
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'wc_callout', 'wordpresscanvas_callout_shortcode' );
}


/*
 * Skillbars
 * @since v1.3
 */
if( !function_exists('wordpresscanvas_skillbar_shortcode') ) {
	function wordpresscanvas_skillbar_shortcode( $atts  ) {		
		extract( shortcode_atts( array(
			'title'	=> '',
			'percentage'	=> '100',
			'color'	=> '#6adcfa',
			'class'	=> '',
			'show_percent'	=> 'true'
		), $atts ) );
		
		// Enque scripts
		wp_enqueue_script('wordpresscanvas_skillbar');
		
		// Display the accordion	';
		$output = '<div class="wc-skillbar wc-clearfix '. $class .'" data-percent="'. $percentage .'%">';
			if ( $title !== '' ) $output .= '<div class="wc-skillbar-title" style="background: '. $color .';"><span>'. $title .'</span></div>';
			$output .= '<div class="wc-skillbar-bar" style="background: '. $color .';"></div>';
			if ( $show_percent == 'true' ) {
				$output .= '<div class="wc-skill-bar-percent">'.$percentage.'%</div>';
			}
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'wc_skillbar', 'wordpresscanvas_skillbar_shortcode' );
}


/*
 * Spacing
 * @since v1.0
 */
if( !function_exists('wordpresscanvas_spacing_shortcode') ) {
	function wordpresscanvas_spacing_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'size'	=> '20px',
			'class'	=> '',
		  ),
		  $atts ) );
	 return '<hr class="wc-spacing '. $class .'" style="height: '. $size .'" />';
	}
	add_shortcode( 'wc_spacing', 'wordpresscanvas_spacing_shortcode' );
}


/**
* Social Icons
* @since 1.0
*/
if( !function_exists('wordpresscanvas_social_icons_shortcode') ) {
	function wordpresscanvas_social_icons_shortcode( $atts ){   
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

		$class = trim( 'wc-social-icons-wrapper ' . $class );

		$order = explode( ',', $display );
		$first = true;

		$html = '<div class="' . $class . '">';
			$html .= '<ul class="wc-social-icons clearfix wc-social-icons-align-'.$align.' wc-social-icons-size-'.$size.'">';
				foreach ( $order as $key ) {
					if ( ! array_key_exists( $key, $social ) )
						continue;

					$link_option_name = 'social_media_' . $key . '_link';
					$icon_option_name = 'social_media_' . $key . '_icon';

					if ( ( $social_link = wordpresscanvas_get_option( $link_option_name ) ) && ( $icon_url = wordpresscanvas_get_option( $icon_option_name ) ) ) {
						$social_link = apply_filters( 'wordpresscanvas_social_link', $key, $social_link );
						$first_class = $first ? ' first-icon' : '';
						$first = false;

						$html .= '<li class="social-icon social-icon-' . $key . $first_class . '">';
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
	add_shortcode( 'wc_social_icons', 'wordpresscanvas_social_icons_shortcode' );
}

/**
* Highlights
* @since 1.0
*/
if ( !function_exists( 'wordpresscanvas_highlight_shortcode' ) ) {
	function wordpresscanvas_highlight_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color'	=> 'yellow',
			'class'	=> '',
		  ),
		  $atts ) );
		  return '<span class="wc-highlight wc-highlight-'. $color .' '. $class .'">' . do_shortcode( $content ) . '</span>';
	
	}
	add_shortcode( 'wc_highlight', 'wordpresscanvas_highlight_shortcode' );
}


/*
 * Buttons
 * @since v1.0
 */
if( !function_exists('wordpresscanvas_button_shortcode') ) {
	function wordpresscanvas_button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type'			=> 'primary', // or inverse
			'url'			=> 'http://www.wordpresscanvas.com',
			'title'			=> 'Visit Site',
			'target'		=> 'self',
			'rel'			=> '',
			'border_radius'	=> '',
			'class'			=> '',
			'icon_left'		=> '',
			'icon_right'	=> ''
		), $atts ) );
		
		
		// $border_radius_style = ( $border_radius ) ? 'style="border-radius:'. $border_radius .'"' : NULL;		
		$rel = ( $rel ) ? 'rel="'.$rel.'"' : NULL;
		$type = 'wc-button-' . $type;
		
		$button = NULL;
		$button .= '<a href="' . $url . '" class="wc-button ' . $type . ' '. $class .'" target="_'.$target.'" title="'. $title .'" '. $rel .'>';
			$button .= '<span class="wc-button-inner">';
				if ( $icon_left ) $button .= '<span class="wc-button-icon-left icon-'. $icon_left .'"></span>';
				$button .= $content;
				if ( $icon_right ) $button .= '<span class="wc-button-icon-right icon-'. $icon_right .'"></span>';
			$button .= '</span>';			
		$button .= '</a>';
		return $button;
	}
	add_shortcode( 'wc_button', 'wordpresscanvas_button_shortcode' );
}



/*
 * Boxes
 * @since v1.0
 *
 */
if( !function_exists('wordpresscanvas_box_shortcode') ) { 
	function wordpresscanvas_box_shortcode( $atts, $content = null ) {
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
		  $alert_content .= '<div class="wc-box clearfix wc-box-' . $color . ' '. $class .'" style="text-align:'. $text_align .';'. $style_attr .'">';
		  $alert_content .= ' '. do_shortcode($content) .'</div>';
		  return $alert_content;
	}
}



/*
 * Testimonial
 * @since v1.0
 *
 */
if( !function_exists('wordpresscanvas_testimonial_shortcode') ) { 
	function wordpresscanvas_testimonial_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'by'	=> '',
			'position'	=> 'left',
			'class'	=> '',
		  ), $atts ) );
		$testimonial_content = '';
		$testimonial_content .= '<div class="wc-testimonial clearfix wc-testimonial-'.$position.' '. $class .'"><div class="wc-testimonial-content">';
		$testimonial_content .= $content;
		$testimonial_content .= '</div><div class="wc-testimonial-author">';
		$testimonial_content .= $by .'</div></div>';	
		return $testimonial_content;
	}
}



/*
 * Center
 * @since v1.0
 *
 */
if( !function_exists('wordpresscanvas_center_shortcode') ) {
	function wordpresscanvas_center_shortcode( $atts, $content = null ){
		extract( shortcode_atts( array(
			'max_width'		=> '500px',
			'text_align'	=> 'center',
			'class'			=> '',
		  ), $atts ) );

		// $append_clearfix = '<div class="wc-clear-floats"></div>';
		$style = empty( $max_width ) ? '' : ' style="max-width:'.$max_width.';"';

		return '<div class="wc-center clearfix wc-center-inner-align-'. $text_align .' '. $class .'"' . $style . '>' . do_shortcode($content) . '</div>';
	}
}



/*
 * Columns
 * @since v1.0
 *
 */
if( !function_exists('wordpresscanvas_column_shortcode') ) {
	function wordpresscanvas_column_shortcode( $atts, $content = null ){
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

		$append_clearfix = 'last' == $position ? '<div class="wc-clear-floats"></div>' : '';

		return '<div'.$style.' class="wc-column wc-' . $size . ' wc-column-'.$position.' '. $class .'">' . do_shortcode($content) . '</div>';
	}
}




/*
 * Rows
 * @since v1.0
 *
 */
if( !function_exists('wordpresscanvas_row_shortcode') ) {
	function wordpresscanvas_row_shortcode( $atts, $content = null ){
		return '<div class="wc-row clearfix">' . do_shortcode($content) . '</div>';
	}
}



/*
 * Toggle
 * @since v1.0
 */
if( !function_exists('wordpresscanvas_toggle_shortcode') ) {
	function wordpresscanvas_toggle_shortcode( $atts, $content = null ) {
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
		wp_enqueue_script('wordpresscanvas_toggle');
		
		// Display the Toggle
		return '<div class="wc-toggle '. $class .'"><div class="wc-toggle-trigger"><a href="#">'. $title .'</a></div><div style="'.$style.'" class="wc-toggle-container">' . do_shortcode($content) . '</div></div>';
	}
}


/*
 * Accordion
 * @since v1.0
 *
 */

// Main
if( !function_exists('wordpresscanvas_accordion_main_shortcode') ) {
	function wordpresscanvas_accordion_main_shortcode( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'class'	=> '',
			'collapse' => 0,
		), $atts ) );

		$type = 'wc-accordion-default';

		if ( (int) $collapse )
			$type = 'wc-accordion-collapse';
		
		// Enque scripts
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('wordpresscanvas_accordion');
		
		// Display the accordion	
		return '<div class="wc-accordion '.$type.' '. $class .'">' . do_shortcode($content) . '</div>';
	}
}


// Section
if( !function_exists('wordpresscanvas_accordion_section_shortcode') ) {
	function wordpresscanvas_accordion_section_shortcode( $atts, $content = null  ) {
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
		  
		return '<div class="wc-accordion-trigger '. $class .'"><a href="#">'. $title .'</a></div><div style="'.$style.'" class="wc-accordion-content">' . do_shortcode($content) . '</div>';
	}
	
}


/*
 * Tabs
 * @since v1.0
 *
 */
if (!function_exists('wordpresscanvas_tabgroup_shortcode')) {
	function wordpresscanvas_tabgroup_shortcode( $atts, $content = null ) {
		
		//Enque scripts
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('wordpresscanvas_tabs');
		
		// Display Tabs
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
		if( count($tab_titles) ){
		    $output .= '<div id="wc-tab-'. rand(1, 100) .'" class="wc-tabs">';
			$output .= '<ul class="ui-tabs-nav clearfix">';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#wc-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
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
if (!function_exists('wordpresscanvas_tab_shortcode')) {
	function wordpresscanvas_tab_shortcode( $atts, $content = null ) {
		$defaults = array(
			'title'	=> 'Tab',
			'class'	=> ''
		);
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="wc-tab-'. sanitize_title( $title ) .'" class="tab-content '. $class .'">'. do_shortcode( $content ) .'</div>';
	}
}




/*
 * Pricing Table
 * @since v1.0
 *
 */
 
/*section*/
if( !function_exists('wordpresscanvas_pricing_shortcode') ) {
	function wordpresscanvas_pricing_shortcode( $atts, $content = null  ) {
		
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
		$pricing_content .= '<div class="wc-pricing wc-pricing-type-'. $type .' '. $class .'">';
			$pricing_content .= '<div class="wc-pricing-header">';
				$pricing_content .= '<h5>'. $plan. '</h5>';
				$pricing_content .= '<div class="wc-pricing-cost">'. $cost .'</div><div class="wc-pricing-per">'. $per .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="wc-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_url ) {
				$pricing_content .= '<div class="wc-pricing-button"><a href="'. $button_url .'" class="wc-button wc-button-'.$type.'" target="_'. $button_target .'" rel="'. $button_rel .'"><span class="wc-button-inner">'. $button_text .'</span></a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
	
}




/************************
 *
 * Version 1.1 Additions
 *
*************************/



/*
 * Heading
 * @since v1.1
 */
if( !function_exists('wordpresscanvas_heading_shortcode') ) {
	function wordpresscanvas_heading_shortcode( $atts ) {
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
		  ),
		  $atts ) );
		  
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

	 	$output = '<'.$type.' class="wc-heading '. $text_align .' '. $class .'" style="'.$style_attr.'"><span>';
		if ( $icon_left ) $output .= '<i class="wc-button-icon-left icon-'. $icon_left .'"></i>';
			$output .= $title;
		if ( $icon_right ) $output .= '<i class="wc-button-icon-right icon-'. $icon_right .'"></i>';
		$output .= '</'.$type.'></span>';

		if ( 'h1' == $type )
			$output = '<header class="entry-header">'. $output . '</header>';
		
		return $output;
	}
	add_shortcode( 'wc_heading', 'wordpresscanvas_heading_shortcode' );
}


/*
 * Google Maps
 * @since v1.1
 */
if (! function_exists( 'wordpresscanvas_shortcode_googlemaps' ) ) :
	function wordpresscanvas_shortcode_googlemaps($atts, $content = null) {
		
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
		wp_enqueue_script('wordpresscanvas_googlemap');
		wp_enqueue_script('wordpresscanvas_googlemap_api');
		
		
		$output = '<div id="map_canvas_'.rand(1, 100).'" class="googlemap '. $class .'" style="height:'.$height.'px;width:100%">';
			$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
			$output .= '<input class="location" type="hidden" value="'.$location.'" />';
			$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
			$output .= '<div class="map_canvas"></div>';
		$output .= '</div>';
		
		return $output;
	   
	}
	add_shortcode( 'wc_googlemap', 'wordpresscanvas_shortcode_googlemaps' );
endif;


/*
 * Divider
 * @since v1.1
 */
if( !function_exists('wordpresscanvas_divider_shortcode') ) {
	function wordpresscanvas_divider_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'style'			=> 'solid',
			'line'			=> 'single',
			'margin_top'	=> '',
			'margin_bottom'	=> '',
			'class'			=> '',
		  ),
		  $atts ) );
		$style_attr = '';
		if ( $margin_top && $margin_bottom ) {  
			$style_attr = 'style="margin-top: '. $margin_top .';margin-bottom: '. $margin_bottom .';"';
		} elseif( $margin_bottom ) {
			$style_attr = 'style="margin-bottom: '. $margin_bottom .';"';
		} elseif ( $margin_top ) {
			$style_attr = 'style="margin-top: '. $margin_top .';"';
		} else {
			$style_attr = NULL;
		}
	 return '<hr class="wc-divider wc-divider-line-'.$line.' wc-divider-style-'. $style .' '. $class .'" '.$style_attr.' />';
	}
	add_shortcode( 'wc_divider', 'wordpresscanvas_divider_shortcode' );
}



