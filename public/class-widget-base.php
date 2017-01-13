<?php

class WPC_Shortcodes_Widget_Base {

	protected $number = 1;
	protected $id_base = 1;

	/**
	 * Constructs id attributes for use in WP_Widget::form() fields.
	 *
	 * This function should be used in form() methods to create id attributes
	 * for fields to be saved by WP_Widget::update().
	 *
	 * @since 2.8.0
	 * @since 4.4.0 Array format field IDs are now accepted.
	 * @access public
	 *
	 * @param string $field_name Field name.
	 * @return string ID attribute for `$field_name`.
	 */
	public function get_field_id( $field_name ) {
		return 'widget-' . $this->id_base . '-' . $this->number . '-' . trim( str_replace( array( '[]', '[', ']' ), array( '', '-', '' ), $field_name ), '-' );
	}

	/**
	 * Constructs name attributes for use in form() fields
	 *
	 * This function should be used in form() methods to create name attributes for fields
	 * to be saved by update()
	 *
	 * @since 2.8.0
	 * @since 4.4.0 Array format field names are now accepted.
	 * @access public
	 *
	 * @param string $field_name Field name
	 * @return string Name attribute for $field_name
	 */
	public function get_field_name($field_name) {
		if ( false === $pos = strpos( $field_name, '[' ) ) {
			return 'widget-' . $this->id_base . '[' . $this->number . '][' . $field_name . ']';
		} else {
			return 'widget-' . $this->id_base . '[' . $this->number . '][' . substr_replace( $field_name, '][', $pos, strlen( '[' ) );
		}
	}
}
