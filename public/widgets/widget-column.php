<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Column extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->column, $instance );
		$o = WPC_Shortcodes_Sanitize::column_attr( $o );
		?>

		<div id="wc-shortcodes-column-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p class="wcs-instruction">Make sure you enter this shortcode inside a <code>[wc_row]</code> shortcode.</p>
			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::column_sizes() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['size'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::column_positions() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['position'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_align'); ?>"><?php _e('Text Align:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['text_align'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}
