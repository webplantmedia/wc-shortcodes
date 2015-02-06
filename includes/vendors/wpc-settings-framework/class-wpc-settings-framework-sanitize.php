<?php
namespace WC_Shortcodes;

/**
 * This class will store sanitize functions
 *
 * @package   WPC_Settings_Framework
 * @author    Chris Baldelomar <chris@webplantmedia.com>
 * @license   GPL-2.0+
 * @link      http://webplantmedia.com
 * @copyright 2014 Chris Baldelomar
 */
class WPC_Settings_Framework_Sanitize {
	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Given an option type, we will return a string
	 * of the callback function used to sanitize
	 * the option value
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param string $type 
	 * @return string
	 */
	public function callback( $type ) {
		switch ( $type ) {
			case 'color' :
				return 'hex_color';
			case 'font' :
				return 'font';
			case 'font_appearance' :
				return 'font_appearance';
			case 'font_hover' :
				return 'font_hover';
			case 'font_weight' :
				return 'font_weight';
			case 'image' :
				return 'esc_url_raw';
			case 'positive_pixel' :
				return 'positive_pixel';
			case 'pixel' :
				return 'pixel';
			case 'number' :
				return 'number';
			case 'decimal' :
				return 'decimal';
			case 'border' :
				return 'border';
			case 'background' :
				return 'background_css';
			case 'checkbox' :
				return 'checkbox';
			case 'google_fonts' :
				return 'google_fonts';
			case 'upload_fonts' :
				return 'upload_fonts';
			case 'gallery' :
				return 'gallery';
			case 'sidebar' :
				return 'sidebar';
			case 'emails' :
				return 'emails';
		}

		return '';
	}

	/**
	 * Validate slideshow data saved to database.
	 *
	 * @since 3.6
	 * @access public
	 *
	 * @param array $value 
	 * @return array
	 */
	public function gallery( $value ) {
		if ( empty( $value ) )
			return null;

		$ids = explode( ',', $value );

		foreach ( $ids as $key => $id ) {
			if ( ! is_numeric( $id ) ) {
				unset( $ids[ $key ] );
			}
		}

		$value = implode( ',', $ids );

		return $value;
	}

	/**
	 * Sanitize border values. Border consists
	 * of pixel value, border style, and color.
	 *
	 * @since 3.6
	 * @access public
	 *
	 * @param array $value 
	 * @return array
	 */
	public function border( $value ) {
		$border = array(
			'width' => '0px',
			'style' => 'none',
			'color' => '#ffffff',
		);

		if ( ! is_array( $value ) )
			return $border;

		foreach ( $value as $k => $v ) {
			switch ( $k ) {
				case 'width' :
					$v = $this->positive_pixel( $v );
					$border['width'] = $v;
					break;
				case 'style' :
					$v = $this->border_style( $v );
					$border['style'] = $v;
					break;
				case 'color' :
					$v = $this->hex_color( $v );
					$border['color'] = $v;
					break;
			}
		}

		return $border;
	}

	/**
	 * Strips all non numerica characters and returns
	 * intval() of string. Only allows for positive values.
	 *
	 * @since 3.6
	 * @access public
	 *
	 * @param string $value 
	 * @return void
	 */
	public function positive_pixel( $value ) {
		$value = preg_replace("/[^0-9]/", "",$value);
		$value = intval( $value );

		if ( empty( $value ) )
			$value = '0';

		return $value."px";
	}

	/**
	 * Strips all non numerica characters and returns
	 * intval() of string. Allows both negative and
	 * positive values.
	 *
	 * @since 3.6
	 * @access public
	 *
	 * @param string $value 
	 * @return void
	 */
	public function pixel( $value ) {
		$value = preg_replace("/[^0-9\-]/", "",$value);
		$value = intval( $value );

		if ( empty( $value ) )
			$value = '0';

		return $value."px";
	}

	public function font( $value ) {
		$font = array(
			'font_family' => '',
			'font_size' => '',
			'text_transform' => '',
			'font_style' => '',
			'font_weight' => '',
			'color' => '',
		);

		if ( !is_array( $value ) )
			return $font;

		foreach ( $value as $k => $v ) {
			switch ( $k ) {
				case 'font_family' :
					$font['font_family'] = $v;
					break;
				case 'font_size' :
					$v = $this->pixel( $value['font_size'] );
					$font['font_size'] = $v;
					break;
				case 'text_transform' :
					$font['text_transform'] = $v;
					break;
				case 'font_style' :
					$v = $this->font_style( $v );
					$font['font_style'] = $v;
					break;
				case 'font_weight' :
					$v = $this->font_weight( $v );
					$font['font_weight'] = $v;
					break;
				case 'color' :
					$v = $this->hex_color( $v );
					$font['color'] = $v;
					break;
			}
		}

		return $font;
	}

	public function font_hover( $value ) {
		$font = array(
			'text_decoration' => '',
			'color' => '',
		);

		if ( !is_array( $value ) )
			return $font;

		foreach ( $value as $k => $v ) {
			switch ( $k ) {
				case 'text_decoration' :
					$v = $this->text_decoration( $v );
					$font['text_decoration'] = $v;
					break;
				case 'color' :
					$v = $this->hex_color( $v );
					$font['color'] = $v;
					break;
			}
		}

		return $font;
	}

	public function font_appearance( $value ) {
		$font = array(
			'text_decoration' => '',
			'font_style' => '',
			'font_weight' => '',
			'color' => '',
		);

		if ( !is_array( $value ) )
			return $font;

		foreach ( $value as $k => $v ) {
			switch ( $k ) {
				case 'text_decoration' :
					$v = $this->text_decoration( $v );
					$font['text_decoration'] = $v;
					break;
				case 'font_style' :
					$v = $this->font_style( $v );
					$font['font_style'] = $v;
					break;
				case 'font_weight' :
					$v = $this->font_weight( $v );
					$font['font_weight'] = $v;
					break;
				case 'color' :
					$v = $this->hex_color( $v );
					$font['color'] = $v;
					break;
			}
		}

		return $font;
	}

	public function text_decoration( $value ) {
		$whitelist = array(
			'none',
			'underline',
			'overline',
			'line-through',
		);

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function text_transform( $value ) {
		$whitelist = array(
			'none',
			'capitalize',
			'uppercase',
			'lowercase',
		);

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function font_style( $value ) {
		$whitelist = array(
			'normal',
			'italic',
			'oblique',
		);

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function font_weight( $value ) {
		$whitelist = array(
			'normal',
			'bold',
			'bolder',
			'lighter',
			'100',
			'200',
			'300',
			'400',
			'500',
			'600',
			'700',
			'800',
			'900',
		);

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function background_css( $value ) {
		$background = array(
			'color' => '',
			'image' => '',
			'repeat' => '',
			'position' => '',
			'attachment' => '',
		);

		if ( !is_array( $value ) )
			return $background;

		foreach ( $value as $k => $v ) {
			switch ( $k ) {
				case 'color' :
					$v = $this->hex_color( $v );
					$background['color'] = $v;
					break;
				case 'image' :
					$v = esc_url_raw( $v );
					$background['image'] = $v;
					break;
				case 'repeat' :
					$v = $this->background_repeat( $v );
					$background['repeat'] = $v;
					break;
				case 'position' :
					$v = $this->background_position( $v );
					$background['position'] = $v;
					break;
				case 'attachment' :
					$v = $this->background_attachment( $v );
					$background['attachment'] = $v;
					break;
			}
		}

		return $background;
	}

	public function background_repeat( $value ) {
		$whitelist = array( 'repeat', 'no-repeat', 'repeat-x', 'repeat-y' );

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function border_style( $value ) {
		$whitelist = array(
			'none',
			'hidden',
			'dotted',
			'dashed',
			'solid',
			'double',
			'groove',
			'ridge',
			'inset',
			'outset',
			'inherit',
		);

		if ( in_array( $value, $whitelist ) )
			return $value;

		return 'none';
	}

	public function background_position( $value ) {
		$whitelist = array(
			'left top',
			'left center',
			'left bottom',
			'right top',
			'right center',
			'right bottom',
			'center top',
			'center center',
			'center bottom',
		);

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function background_attachment( $value ) {
		$whitelist = array( 'fixed', 'scroll' );

		if ( in_array( $value, $whitelist ) )
			return $value;

		return '';
	}

	public function hex_color( $color ) {
		if ( '' === $color )
			return '';

		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}

	/**
	 * replace nonalphannumeric charachers with underscore
	 * should be safe enought to use as array key
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param string $key 
	 * @return string
	 */
	public function key( $key ) {
		$key = strtolower( preg_replace( '/[^a-zA-Z0-9]/', '_', $key ) );

		return $key;
	}

	/**
	 * replace nonalphannumeric charachers with hyphen
	 * should be safe enough to use as a CSS id
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param string $key 
	 * @return string
	 */
	public function id( $id ) {
		$id = strtolower( preg_replace( '/[^a-zA-Z0-9]/', '-', $id ) );

		return $id;
	}

	/**
	 * return numeric values only
	 *
	 * @since 3.6
	 * @access public
	 *
	 * @param string $number 
	 * @return int
	 */
	public function number( $number ) {
		$number = (int) preg_replace( "/[^0-9\-]/", "", $number );

		return $number;
	}

	/**
	 * return decimal number
	 *
	 * @since 3.6.1
	 * @access public
	 *
	 * @param mixed $number
	 * @return void
	 */
	public function decimal( $number ) {
		$number = preg_replace( "/[^0-9\.\-]/", "", $number );

		return $number;
	}

	/**
	 * replace space with plus sign. Should be safe enough 
	 * to use in Google Font stylesheet link
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param string $code 
	 * @return string
	 */
	public function google_code( $code ) {
		$code = preg_replace( '/\s/', '+', $code );

		return $code;
	}

	/**
	 * Parse only friendly characters to use in family name
	 * inside css file.
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param string $name 
	 * @return string
	 */
	public function font_family_name( $name ) {
		$name = preg_replace( '/[^a-zA-Z0-9\-_]/', '', $name );

		return $name;
	}

	/**
	 * Checkbox should only return 1 or 0
	 *
	 * @since 3.5.2
	 * @access public
	 *
	 * @param string $val 
	 * @return void
	 */
	public function checkbox( $val ) {
		if ( $val )
			return 1;
		else
			return 0;
	}

	/**
	 * Make sure sidebar is valid
	 *
	 * @since 3.6.1
	 * @access public
	 *
	 * @param mixed $value
	 * @return void
	 */
	public function sidebar( $value ) {
		global $wp_registered_sidebars;

		if ( 'none' == $value )
			return $value;

		if ( array_key_exists( $value, $wp_registered_sidebars ) )
			return $value;

		return 'none';
	}

	/**
	 * Sanitize multiple emails
	 *
	 * @since 3.7.1
	 * @access public
	 *
	 * @param mixed $email
	 * @return void
	 */
	public function emails( $email ) {
		$valid = array();

		$email = explode( ',', $email );

		foreach ( $email as $e ) {
			$e = trim( $e );
			if ( is_email( $e ) )
				$valid[] = $e;
		}

		if ( ! empty( $valid ) )
			return implode( ',', $valid );

		return null;
	}

	public function share_buttons( $value ) {
		global $wc_shortcodes_share_buttons;

		$whitelist = $wc_shortcodes_share_buttons;

		$valid = array();

		if ( ! is_array( $value ) || empty( $value ) )
			return null;

		foreach ( $value as $k => $v ) {
			if ( array_key_exists( $k, $whitelist ) )
				$valid[ $k ] = $v;
		}

		return $valid;
	}
}
