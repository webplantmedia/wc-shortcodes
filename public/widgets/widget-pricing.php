<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Pricing extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->pricing, $instance );
		$o = WPC_Shortcodes_Sanitize::pricing_attr( $o );
		?>

		<div id="wc-shortcodes-pricing-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Pricing Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::pricing_color_types() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['type'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('plan'); ?>"><?php _e('Plan:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('plan'); ?>" name="<?php echo $this->get_field_name('plan'); ?>" value="<?php echo $o['plan']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('cost'); ?>"><?php _e('Cost:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('cost'); ?>" name="<?php echo $this->get_field_name('cost'); ?>" value="<?php echo $o['cost']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('per'); ?>"><?php _e('Per:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('per'); ?>" name="<?php echo $this->get_field_name('per'); ?>" value="<?php echo $o['per']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" value="<?php echo $o['button_url']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" value="<?php echo $o['button_text']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('button_target'); ?>"><?php _e('URL Target:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('button_target'); ?>" name="<?php echo $this->get_field_name('button_target'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::url_target_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['button_target'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('button_rel'); ?>"><?php _e('URL Rel:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('button_rel'); ?>" name="<?php echo $this->get_field_name('button_rel'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::url_rel_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['button_rel'], $key ); ?>><?php echo $value; ?></option>';
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
