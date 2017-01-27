<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Testimonial extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->testimonial, $instance );
		$o = WPC_Shortcodes_Sanitize::testimonial_attr( $o );
		?>

		<div id="wc-shortcodes-testimonial-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('by'); ?>"><?php _e('By:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('by'); ?>" name="<?php echo $this->get_field_name('by'); ?>" value="<?php echo $o['by']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $o['url']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::left_right_none_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['position'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
		</div>
		<?php
	}
}
