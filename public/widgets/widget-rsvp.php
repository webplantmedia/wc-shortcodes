<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_RSVP extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->rsvp, $instance );
		$o = WPC_Shortcodes_Sanitize::rsvp_attr( $o );
		?>

		<div id="wc-shortcodes-rsvp-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p class="wcs-instruction">You can configure your RSVP display in your <a href="<?php echo WPC_Shortcodes_Vars::$plugin_settings_url . '&wpcsf_active_tab=wc-shortcodes-options-rsvp-options-tab'; ?>" target="_blank">Shortcodes Settings Page</a>.</p>
			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::one_three_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['columns'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('align'); ?>"><?php _e('Align:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('align'); ?>" name="<?php echo $this->get_field_name('align'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['align'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('button_align'); ?>"><?php _e('Button Align:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('button_align'); ?>" name="<?php echo $this->get_field_name('button_align'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['button_align'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}
