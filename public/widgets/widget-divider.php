<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Divider extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->divider, $instance );
		$o = WPC_Shortcodes_Sanitize::divider_attr( $o );
		?>

		<div id="wc-shortcodes-divider-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::divider_style_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['style'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('line'); ?>"><?php _e('Line Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('line'); ?>" name="<?php echo $this->get_field_name('line'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::divider_line_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['line'], $key ); ?>><?php echo $value; ?></option>';
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
