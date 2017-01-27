<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Box extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->box, $instance );
		$o = WPC_Shortcodes_Sanitize::box_attr( $o );
		?>

		<div id="wc-shortcodes-box-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::color_types() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['color'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_align'); ?>"><?php _e('Text Align:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['text_align'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('margin_top'); ?>"><?php _e('Top Margin:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('margin_top'); ?>" name="<?php echo $this->get_field_name('margin_top'); ?>" value="<?php echo $o['margin_top']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('margin_bottom'); ?>"><?php _e('Bottom Margin:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('margin_bottom'); ?>" name="<?php echo $this->get_field_name('margin_bottom'); ?>" value="<?php echo $o['margin_bottom']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
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
