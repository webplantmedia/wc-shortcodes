<?php
/**
 * Sanitize Class
 */
class WPC_Shortcodes_Sanitize {
	public static function bool( $value ) {
		if ( '' == $value )
			return $value;

		if ( 'true' == $value ) {
			return true;
		}
		else if ( 'false' == $value ) {
			return false;
		}

		return (bool) $value;
	}

	public static function int_bool( $value ) {
		if ( '' == $value )
			return $value;

		if ( "no" == $value ) {
			$value = 0;
		}
		else {
			$value = (bool) $value;
			$value = $value ? 1 : 0;
		}

		return $value;
	}

	public static function gutter_space( $value, $default = 20 ) {
		if ( ! is_numeric( $value ) ) {
			$value = 20;
		}
		if ( $value > 0 && $value < 1 ) {
			$value = (int) ( $value * 1000 );
		}
		$value = (int) $value;
		if ( $value > 50 || $value < 0 ) {
			$value = $default;
		}

		return $value;
	}

	public static function text_field( $value ) {
		return trim( sanitize_text_field( $value ) );
	}

	public static function int_float( $value ) {
		if ( '' == $value )
			return $value;

		$value = filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

		return $value;
	}

	public static function html_classes( $value ) {
		if ( empty( $value ) ) {
			return '';
		}

		$a = explode( ' ', $value );

		if ( ! empty( $a ) && is_array( $a ) ) {
			foreach( $a as $k => $v ) {
				$a[ $k ] = sanitize_html_class( $v );
			}
		}

		$value = implode( ' ', $a );

		return trim( $value );
	}

	public static function opacity( $value ) {
		if ( '' == $value )
			return $value;

		$value = number_format( $value, 2, '.', '' );
		$value = floatval( $value );

		if ( empty( $value ) )
			$value = 0;

		if ( 0 > $value )
			$value = 0;
		else if ( 1 < $value )
			$value = 1;

		return $value;
	}

	public static function percentage( $value ) {
		if ( '' == $value )
			return $value;

		$value = preg_replace( "/[^0-9\.]/", "", $value );
		$value = floatval( $value );

		if ( empty( $value ) )
			$value = 0;

		if ( 0 > $value )
			$value = 0;

		if ( 100 < $value )
			$value = 100;

		return $value;
	}

	public static function column( $value, $default = 2 ) {
		$value = intval( $value );

		if ( 1 > $value )
			return $default;

		if ( 9 < $value )
			return $default;

		if ( empty( $value ) )
			return $default;

		return $value;
	}

	public static function positive_number( $value ) {
		if ( '' == $value )
			return $value;

		$value = preg_replace("/[^0-9\-]/", "",$value);
		$value = intval( $value );

		if ( empty( $value ) )
			$value = 0;

		if ( 0 > $value )
			$value = 0;

		return $value;
	}

	public static function number( $value ) {
		if ( '' == $value )
			return $value;

		$value = preg_replace("/[^0-9\-]/", "",$value);
		$value = intval( $value );

		if ( empty( $value ) )
			$value = '0';

		return $value;
	}

	public static function pixel( $value ) {
		if ( '' == $value )
			return $value;

		$value = preg_replace("/[^0-9\-]/", "",$value);
		$value = intval( $value );

		if ( empty( $value ) )
			$value = '0';

		return $value."px";
	}

	public static function css_units( $value, $css_unit = 'px' ) {
		if ( '' == $value )
			return $value;

		$value = trim( $value );

		if ( 0 == $value )
			return $value;

		$values = explode( ' ', $value );
		$clean = array();

		foreach ( $values as $value ) {
			if ( preg_match( '/(px|em|rem)$/', $value, $match ) ) {
				$css_unit = $match[1];
			}
			$value = filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

			if ( empty( $value ) ) {
				$value = '0';
			}
			else {
				$value = $value . $css_unit;
			}

			$clean[] = $value;
		}

		if ( empty( $clean ) ) {
			return '';
		}

		return implode( ' ', $clean );
	}

	public static function css_unit( $value, $css_unit = 'px' ) {
		if ( '' == $value )
			return $value;

		$value = trim( $value );

		if ( 0 == $value )
			return $value;

		if ( preg_match( '/(px|em|rem)$/', $value, $match ) ) {
			$css_unit = $match[1];
		}
		$value = filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

		if ( empty( $value ) )
			return 0;

		return $value . $css_unit;
	}

	public static function hex_color( $color ) {
		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return '';
	}

	public static function custom_field_name( $name ) {
		if ( '' === $name )
			return '';

		// 3 or 6 hex digits, or the empty string.
		$name = trim( sanitize_text_field( $name ) );
		$name = preg_replace( '/^_/', '', $name );

		return $name;
	}

	public static function social_icons_align( $value, $default = 'left' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::social_icons_align_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function social_icons_size( $value, $default = 'large' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::social_icons_sizes();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function social_icons_format( $value, $default = 'default' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::social_icons_formats();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function social_icons_display_type( $value, $default = 'float-left' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::social_icons_display_types();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function social_icons_max_height( $value, $default = 48 ) {
		$whitelist = WPC_Shortcodes_Widget_Options::social_icons_max_height_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function divider_line( $value, $default = 'single' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::divider_line_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function divider_style( $value, $default = 'solid' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::divider_style_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function fullwidth_style( $value, $default = 'solid' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::fullwidth_style_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function google_map_zoom( $value, $default = 8 ) {
		$whitelist = WPC_Shortcodes_Widget_Options::google_map_zoom_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function heading_type( $value, $default = 'h2' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::heading_tags();
		$value = strtolower( $value );

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function image_link_to( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::image_link_to_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function highlight_color( $value, $default = 'yellow' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::highlight_colors();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function pricing_color_type( $value, $default = 'primary' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::pricing_color_types();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function color_type( $value, $default = 'primary' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::color_types();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function url_target( $value, $default = 'self' ) {
		$value = ltrim( trim( $value ), '_' );

		$whitelist = WPC_Shortcodes_Widget_Options::url_target_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function url_rel( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::url_rel_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function fa_icon( $value ) {
		$value = preg_replace( '/^fa\-/', '', $value );
		return sanitize_html_class( $value );
	}

	public static function column_size( $value, $default = 'one-third' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::column_sizes();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function column_position( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::column_positions();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function left_right_none( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::left_right_none_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function one_three( $value, $default = 3 ) {
		$whitelist = WPC_Shortcodes_Widget_Options::one_three_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function image_size( $value, $default = 'large' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::image_sizes();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function call_to_action_style_format( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::call_to_action_style_format_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function image_links_style_format( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::image_links_style_format_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function image_link_text_position( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::image_link_text_position_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function posts_layout( $value, $default = 'bxslider' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::posts_layouts();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function featured_post_layout( $value, $default = 'thumbnail' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::featured_post_layouts();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function posts_template( $value, $default = 'slider1' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::posts_templates();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function collage_template( $value, $default = 'collage1' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::collage_templates();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function post_slider_layout( $value, $default = 'bxslider' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::post_slider_layouts();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function post_slider_template( $value, $default = 'slider1' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::post_slider_templates();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function post_slider_mode( $value, $default = 'fade' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::post_slider_modes();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function order_field( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::order_fields();

		$value = strtoupper( $value );
		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function text_align( $value, $default = '' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::text_align_values();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function comma_delim_to_array( $string ) {
		$a = explode( ',', $string );
		$t = array();

		foreach ( $a as $key => $value ) {
			$value = trim( $value );
			if ( ! empty( $value ) ) {
				$t[] = $value;
			}
		}

		if ( empty( $t ) ) {
			return '';
		}
		else {
			return $t;
		}
	}

	public static function accordion_main_layout( $value, $default = 'box' ) {
		$whitelist = WPC_Shortcodes_Widget_Options::accordion_main_layouts();

		if ( array_key_exists( $value, $whitelist ) )
			return $value;

		return $default;
	}

	public static function accordion_section_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function accordion_main_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'collapse' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'leaveopen' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
				case 'layout' :
					$atts[ $key ] = self::accordion_main_layout( $value );
					break;
			}
		}

		return $atts;
	}

	public static function tabgroup_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
				case 'layout' :
					$atts[ $key ] = self::accordion_main_layout( $value );
					break;
			}
		}

		return $atts;
	}

	public static function tab_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
			}
		}

		return $atts;
	}

	public static function toggle_attr( $atts ) {

		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
				case 'padding' :
					$atts[ $key ] = self::css_units( $value );
					break;
				case 'border_width' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'layout' :
					$atts[ $key ] = self::accordion_main_layout( $value );
					break;
			}
		}

		return $atts;
	}

	public static function column_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'size' :
					$atts[ $key ] = self::column_size( $value );
					break;
				case 'position' :
					$atts[ $key ] = self::column_position( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
				case 'text_align' :
					$atts[ $key ] = self::text_align( $value );
					break;
			}
		}

		return $atts;
	}

	public static function spacing_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'size' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function button_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'type' :
					$atts[ $key ] = self::color_type( $value );
					break;
				case 'url' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'target' :
					$atts[ $key ] = self::url_target( $value );
					break;
				case 'rel' :
					$atts[ $key ] = self::url_rel( $value );
					break;
				case 'icon_left' :
					$atts[ $key ] = self::fa_icon( $value );
					break;
				case 'icon_right' :
					$atts[ $key ] = self::fa_icon( $value );
					break;
				case 'position' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function box_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'color' :
					$atts[ $key ] = self::color_type( $value );
					break;
				case 'text_align' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'margin_top' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'margin_bottom' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function image_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'alt' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'caption' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'link_to' :
					$atts[ $key ] = self::image_link_to( $value );
					break;
				case 'url' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'align' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'attachment_id' :
					$atts[ $key ] = self::positive_number( $value );
					break;
				case 'size' :
					$atts[ $key ] = self::image_size( $value );
					break;
				case 'flag' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'left' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'right' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'top' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'bottom' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'text_color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'background_color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'font_size' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'text_align' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'flag_width' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function pricing_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'type' :
					$atts[ $key ] = self::pricing_color_type( $value );
					break;
				case 'plan' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'cost' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'per' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'button_url' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'button_text' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'button_target' :
					$atts[ $key ] = self::url_target( $value );
					break;
				case 'button_rel' :
					$atts[ $key ] = self::url_rel( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function highlight_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'color' :
					$atts[ $key ] = self::highlight_color( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function skillbar_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'percentage' :
					$atts[ $key ] = self::percentage( $value );
					break;
				case 'color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'show_percent' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function social_icons_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'format' :
					$atts[ $key ] = self::social_icons_format( $value );
					break;
				case 'columns' :
					$atts[ $key ] = self::social_icons_display_type( $value );
					break;
				case 'maxheight' :
					$atts[ $key ] = self::social_icons_max_height( $value );
					break;
				case 'size' :
					$atts[ $key ] = self::social_icons_size( $value );
					break;
				case 'align' :
					$atts[ $key ] = self::social_icons_align( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function rsvp_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'columns' :
					$atts[ $key ] = self::one_three( $value );
					break;
				case 'align' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'button_align' :
					$atts[ $key ] = self::text_align( $value );
					break;
			}
		}

		return $atts;
	}

	public static function share_buttons_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	// Fixes bools on widget update when checkbox is empty, and thus blank. We don't want to revert to the default value, but false.
	public static function collage_attr_fix_bools( $atts ) {
		$bools = array( 'ignore_sticky_posts', 'slider_auto', 'nopaging' );

		foreach ( $bools as $key ) {
			if ( ! isset( $atts[ $key ] ) ) {
				$atts[ $key ] = 0;
			}
		}

		return $atts;
	}

	public static function collage_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'ignore_sticky_posts' :
				case 'slider_auto' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'nopaging' :
					$atts[ $key ] = self::int_bool( $value );
					$atts[ $key ] = (bool) $atts[ $key ];
					break;
				case 'p' :
				case 'posts_per_page' :
				case 'heading_size' :
				case 'mobile_heading_size' :
				case 'desktop_height' :
				case 'laptop_height' :
				case 'mobile_height' :
					$atts[ $key ] = self::number( $value );
					break;
				case 'gutter_space' :
					$atts[ $key ] = self::gutter_space( $value, 7 );
					break;
				case 'slider_pause' :
					$atts[ $key ] = self::number( $value );
					$atts[ $key ] = abs( $atts[ $key ] );
					break;
				case 'layout' :
					$atts[ $key ] = self::post_slider_layout( $value );
					break;
				case 'template' :
					$atts[ $key ] = self::collage_template( $value );
					break;
				case 'slider_mode' :
					$atts[ $key ] = self::post_slider_mode( $value );
					break;
				case 'order' :
					$atts[ $key ] = self::order_field( $value );
					break;
				case 'button_class' :
					$atts[ $key ] = self::html_classes( $atts[ $key ] );
					break;
				case 'terms' :
				case 'pids' :
				case 'post__in' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
			}
		}

		return $atts;
	}

	public static function call_to_action_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				// image 1
				case 'image' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'image_2x' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'image_max_width' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'image_position' :
					$atts[ $key ] = self::text_align( $value );
					break;
				// Settings
				case 'style_format' :
					$atts[ $key ] = self::call_to_action_style_format( $value );
					break;
				case 'text_max_width' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'text_position' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'gutter_position' :
					$atts[ $key ] = self::percentage( $value );
					break;
				case 'gutter_spacing' :
					$atts[ $key ] = self::positive_number( $value );
					break;
				case 'padding_top' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'padding_bottom' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'padding_side' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function image_links_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				// image 1
				case 'image_1' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'text_1' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'url_1' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				// image 2
				case 'image_2' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'text_2' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'url_2' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				// image 3
				case 'image_3' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'text_3' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'url_3' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				// image 4
				case 'image_4' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'text_4' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'url_4' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				// Settings
				case 'text_position' :
					$atts[ $key ] = self::image_link_text_position( $value );
					break;
				case 'height' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'heading_type' :
					$atts[ $key ] = self::heading_type( $value );
					break;
				case 'text_color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'background_color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'style_format' :
					$atts[ $key ] = self::image_links_style_format( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function testimonial_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'by' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'url' :
					$atts[ $key ] = esc_url_raw( $value );
					break;
				case 'position' :
					$atts[ $key ] = self::left_right_none( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function fa_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'icon' :
					$atts[ $key ] = self::fa_icon( $value );
					break;
				case 'margin_left' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'margin_right' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function googlemap_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'title_on_load' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'location' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'height' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'zoom' :
					$atts[ $key ] = self::google_map_zoom( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function divider_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'style' :
					$atts[ $key ] = self::divider_style( $value );
					break;
				case 'line' :
					$atts[ $key ] = self::divider_line( $value );
					break;
				case 'margin_top' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'margin_bottom' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function countdown_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'date' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'format' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'labels' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'labels1' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'message' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
			}
		}

		return $atts;
	}

	public static function html_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'name' :
					$atts[ $key ] = self::custom_field_name( $value );
					break;
			}
		}

		return $atts;
	}

	public static function pre_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'name' :
					$atts[ $key ] = self::custom_field_name( $value );
					break;
				case 'scrollable' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'color' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'lang' :
					$atts[ $key ] = self::html_classes( $value );
					break;
				case 'linenums' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'wrap' :
					$atts[ $key ] = self::int_bool( $value );
					break;
			}
		}

		return $atts;
	}

	public static function center_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'max_width' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'text_align' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function fullwidth_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'selector' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'max_width' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
				case 'padding_top' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'padding_bottom' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'padding_side' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'background_color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'border_color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'style' :
					$atts[ $key ] = self::fullwidth_style( $value );
					break;
			}
		}

		return $atts;
	}

	public static function heading_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'title' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
				case 'type' :
					$atts[ $key ] = self::heading_type( $value );
					break;
				case 'margin_top' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'margin_bottom' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'text_align' :
					$atts[ $key ] = self::text_align( $value );
					break;
				case 'font_size' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'color' :
					$atts[ $key ] = self::hex_color( $value );
					break;
				case 'icon_left' :
					$atts[ $key ] = self::fa_icon( $value );
					break;
				case 'icon_right' :
					$atts[ $key ] = self::fa_icon( $value );
					break;
				case 'icon_spacing' :
					$atts[ $key ] = self::css_unit( $value );
					break;
				case 'class' :
					$atts[ $key ] = self::html_classes( $value );
					break;
			}
		}

		return $atts;
	}

	public static function posts_attr_key_change( $atts ) {
		// Rename keys in shortcode options.
		$renamed = array( 'title', 'meta_all', 'meta_author', 'meta_date', 'meta_comments', 'thumbnail', 'content', 'paging' );
		foreach ( $renamed as $key ) {
			if ( isset( $atts[ $key ] ) ) {
				$new_key = 'show_' . $key;
				if ( ! isset( $atts[ $new_key ] ) ) {
					$atts[ $new_key ] = $atts[ $key ];
				}
				unset( $atts[ $key ] );
			}
		}
		
		return $atts;
	}

	public static function posts_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'ignore_sticky_posts' :
				case 'show_meta_category' :
				case 'nopaging' :
				case 'show_title' :
				case 'show_meta_all' :
				case 'show_meta_author' :
				case 'show_meta_date' :
				case 'show_meta_comments' :
				case 'show_thumbnail' :
				case 'show_content' :
				case 'show_paging' :
				case 'filtering' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'nopaging' :
					$atts[ $key ] = self::int_bool( $value );
					$atts[ $key ] = (bool) $atts[ $key ];
					break;
				case 'gutter_space' :
					$atts[ $key ] = self::gutter_space( $value );
					break;
				case 'p' :
				case 'posts_per_page' :
				case 'excerpt_length' :
					$atts[ $key ] = self::number( $value );
					break;
				case 'columns' :
					$atts[ $key ] = self::column( $value );
					break;
				case 'slider_pause' :
					$atts[ $key ] = self::number( $value );
					$atts[ $key ] = abs( $atts[ $key ] );
					break;
				case 'layout' :
					$atts[ $key ] = self::posts_layout( $value );
					break;
				case 'template' :
					$atts[ $key ] = self::posts_template( $value );
					break;
				case 'order' :
					$atts[ $key ] = self::order_field( $value );
					break;
				case 'heading_type' :
					$atts[ $key ] = self::heading_type( $value );
					break;
				case 'button_class' :
					$atts[ $key ] = self::html_classes( $atts[ $key ] );
					$atts[ $key ] = empty( $atts[ $key ] ) ? 'wc-shortcodes-post-button' : $atts[ $key ];
					break;
				case 'readmore' :
				case 'terms' :
				case 'pids' :
				case 'post__in' :
				case 'date_format' :
					$atts[ $key ] = sanitize_text_field( $value );
			}
		}

		if ( $atts['columns'] == 1 ) {
			$atts['layout'] = 'single-column';
		}

		// sanitize limit
		if ( $atts['posts_per_page'] < 0 ) {
			$atts['posts_per_page'] = -1;
			$atts['nopaging'] = true;
		}

		return $atts;
	}

	// Fixes bools on widget update when checkbox is empty, and thus blank. We don't want to revert to the default value, but false.
	public static function post_slider_attr_fix_bools( $atts ) {
		$bools = array( 'ignore_sticky_posts', 'show_meta_category', 'show_title', 'show_content', 'show_button', 'slider_auto', 'nopaging' );

		foreach ( $bools as $key ) {
			if ( ! isset( $atts[ $key ] ) ) {
				$atts[ $key ] = 0;
			}
		}

		return $atts;
	}

	public static function post_slider_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'ignore_sticky_posts' :
				case 'show_meta_category' :
				case 'show_title' :
				case 'show_content' :
				case 'show_button' :
				case 'slider_auto' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'nopaging' :
					$atts[ $key ] = self::int_bool( $value );
					$atts[ $key ] = (bool) $atts[ $key ];
					break;
				case 'p' :
				case 'posts_per_page' :
				case 'heading_size' :
				case 'mobile_heading_size' :
				case 'excerpt_length' :
				case 'desktop_height' :
				case 'laptop_height' :
				case 'mobile_height' :
					$atts[ $key ] = self::number( $value );
					break;
				case 'slider_pause' :
					$atts[ $key ] = self::number( $value );
					$atts[ $key ] = abs( $atts[ $key ] );
					break;
				case 'layout' :
					$atts[ $key ] = self::post_slider_layout( $value );
					break;
				case 'template' :
					$atts[ $key ] = self::post_slider_template( $value );
					break;
				case 'slider_mode' :
					$atts[ $key ] = self::post_slider_mode( $value );
					break;
				case 'order' :
					$atts[ $key ] = self::order_field( $value );
					break;
				case 'heading_type' :
					$atts[ $key ] = self::heading_type( $value );
					break;
				case 'button_class' :
					$atts[ $key ] = self::html_classes( $atts[ $key ] );
					break;
				case 'readmore' :
				case 'terms' :
				case 'pids' :
				case 'post__in' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
			}
		}

		// sanitize limit
		if ( $atts['posts_per_page'] < 0 ) {
			$atts['posts_per_page'] = -1;
			$atts['nopaging'] = true;
		}

		return $atts;
	}

	// Fixes bools on widget update when checkbox is empty, and thus blank. We don't want to revert to the default value, but false.
	public static function featured_posts_attr_fix_bools( $atts ) {
		$bools = array( 'ignore_sticky_posts', 'show_meta_category', 'nopaging' );

		foreach ( $bools as $key ) {
			if ( ! isset( $atts[ $key ] ) ) {
				$atts[ $key ] = 0;
			}
		}

		return $atts;
	}

	public static function featured_posts_attr( $atts ) {
		foreach ( $atts as $key => $value ) {
			switch( $key ) {
				case 'ignore_sticky_posts' :
				case 'show_meta_category' :
					$atts[ $key ] = self::int_bool( $value );
					break;
				case 'nopaging' :
					$atts[ $key ] = false;
					break;
				case 'p' :
				case 'posts_per_page' :
				case 'heading_size' :
					$atts[ $key ] = self::number( $value );
					break;
				case 'layout' :
					$atts[ $key ] = self::featured_post_layout( $value );
					break;
				case 'order' :
					$atts[ $key ] = self::order_field( $value );
					break;
				case 'heading_type' :
					$atts[ $key ] = self::heading_type( $value );
					break;
				case 'title' :
				case 'terms' :
				case 'pids' :
				case 'post__in' :
					$atts[ $key ] = sanitize_text_field( $value );
					break;
			}
		}

		if ( $atts['posts_per_page'] <= 0 ) {
			$atts['posts_per_page'] = 1;
		}
		if ( $atts['posts_per_page'] >= 10 ) {
			$atts['posts_per_page'] = 10;
		}

		return $atts;
	}
}
