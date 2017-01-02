<?php
/**
 * Sanitize Class
 */
class WPC_Shortcodes_Sanitize {
	public static function bool( $value ) {
		if ( 'true' == $value ) {
			return true;
		}
		else if ( 'false' == $value ) {
			return false;
		}

		return (bool) $value;
	}

	public static function text_field( $value ) {
		return trim( sanitize_text_field( $value ) );
	}

	public static function int_float( $value ) {
		$value = filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

		return $value;
	}

	public static function positive_number( $value ) {
		$value = preg_replace("/[^0-9\-]/", "",$value);
		$value = intval( $value );

		if ( empty( $value ) )
			$value = 0;

		if ( 0 > $value )
			$value = 0;

		return $value;
	}

	public static function number( $value ) {
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

	public static function css_unit( $value, $css_unit = 'px' ) {
		if ( '' == $value )
			return $value;

		$value = trim( $value );
		if ( preg_match( '/(px|em|rem)$/', $value, $match ) ) {
			$css_unit = $match[1];
		}
		$value = filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

		if ( empty( $value ) )
			$value = '0';

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

	public static function heading_type( $value, $default = 'h2' ) {
		$whitelist = array(
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'p',
			'strong',
			'span',
		);

		if ( in_array( $value, $whitelist ) )
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

	public static function posts_attr( $atts, $empty_is_false = false ) {
		// sanitize bools
		$bools = array( 'ignore_sticky_posts', 'show_meta_category', 'nopaging', 'show_title', 'show_meta_all', 'show_meta_author', 'show_meta_date', 'show_meta_comments', 'show_thumbnail', 'show_content', 'show_paging', 'filtering' );
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
			else if ( $empty_is_false ) {
				$atts[ $key ] = 0;
			}
		}

		$atts['nopaging'] = (bool) $atts['nopaging'];

		// gutter space
		if ( ! is_numeric( $atts['gutter_space'] ) ) {
			$atts['gutter_space'] = 20;
		}
		if ( $atts['gutter_space'] > 0 && $atts['gutter_space'] < 1 ) {
			$atts['gutter_space'] = (int) ( $atts['gutter_space'] * 1000 );
		}
		$atts['gutter_space'] = (int) $atts['gutter_space'];
		if ( $atts['gutter_space'] > 50 || $atts['gutter_space'] < 0 ) {
			$atts['gutter_space'] = 20;
		}

		// sanitize ints
		$ints = array( 'p', 'posts_per_page', 'columns', 'excerpt_length' );
		foreach ( $ints as $key ) {
			if ( isset( $atts[ $key ] ) ) {
				$atts[ $key ] = (int) $atts[ $key ];
			}
		}

		$valid_columns = array( 1, 2, 3, 4, 5, 6, 7, 8, 9 );
		$atts['columns'] = in_array( $atts['columns'], $valid_columns ) ? $atts['columns'] : 2;
		if ( $atts['columns'] == 1 ) {
			$atts['layout'] = 'single-column';
		}


		// sanitize limit
		if ( $atts['posts_per_page'] < 0 ) {
			$atts['posts_per_page'] = -1;
			$atts['nopaging'] = true;
		}

		// sanitize dropdown
		$valid_layouts = array( 'masonry', 'grid', 'single-column' );
		if ( ! in_array( $atts['layout'], $valid_layouts ) ) {
			$atts['layout'] = 'masonry';
		}

		$valid_templates = array( 'box', 'borderless' );
		if ( ! in_array( $atts['template'], $valid_templates ) ) {
			$atts['template'] = 'box';
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
		$atts['terms'] = sanitize_text_field( $atts['terms'] );
		$atts['pids'] = sanitize_text_field( $atts['pids'] );
		$atts['post__in'] = sanitize_text_field( $atts['post__in'] );
		$atts['date_format'] = sanitize_text_field( $atts['date_format'] );

		return $atts;
	}

	public static function post_slider_attr( $atts, $empty_is_false = false ) {
		// sanitize bools
		$bools = array( 'ignore_sticky_posts', 'show_meta_category', 'show_title', 'show_content', 'slider_auto', 'nopaging' );
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
			else if ( $empty_is_false ) {
				$atts[ $key ] = 0;
			}
		}

		$atts['nopaging'] = (bool) $atts['nopaging'];

		// sanitize ints
		$ints = array( 'p', 'posts_per_page', 'heading_size', 'mobile_heading_size', 'excerpt_length', 'desktop_height', 'laptop_height', 'mobile_height', 'slider_pause' );
		foreach ( $ints as $key ) {
			if ( isset( $atts[ $key ] ) ) {
				$atts[ $key ] = (int) $atts[ $key ];
			}
		}
		$atts['slider_pause'] = abs( $atts['slider_pause'] );

		// sanitize limit
		if ( $atts['posts_per_page'] < 0 ) {
			$atts['posts_per_page'] = -1;
			$atts['nopaging'] = true;
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
		$atts['button_class'] = sanitize_text_field( $atts['button_class'] );
		$atts['button_class'] = empty( $atts['button_class'] ) ? 'wc-shortcodes-post-slide-button' : $atts['button_class'];
		$atts['terms'] = sanitize_text_field( $atts['terms'] );
		$atts['pids'] = sanitize_text_field( $atts['pids'] );
		$atts['post__in'] = sanitize_text_field( $atts['post__in'] );

		return $atts;
	}
}
