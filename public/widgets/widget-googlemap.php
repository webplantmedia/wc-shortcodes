<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_GoogleMap extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->googlemap, $instance );
		$o = WPC_Shortcodes_Sanitize::googlemap_attr( $o );
		?>

		<div id="wc-shortcodes-google-maps-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<?php if ( empty( WPC_Shortcodes_Vars::$google_maps_api_key ) ) : ?>
				<p class="wcs-instruction">Google requires you to enter an API key for your Maps. Go to your <a href="<?php echo WPC_Shortcodes_Vars::$plugin_settings_url . '&wpcsf_active_tab=wc-shortcodes-options-google-maps-options-tab'; ?>" target="_blank">Shortcodes Settings Page</a> for more details.</p>
			<?php endif; ?>
			<p>

				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('title_on_load'); ?>" name="<?php echo $this->get_field_name('title_on_load'); ?>" value="1" <?php checked( $o['title_on_load'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('title_on_load'); ?>"><?php _e('Show Title On Load?') ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Location:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" value="<?php echo $o['location']; ?>" />
				<span class="wcs-description">Enter address of the location.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $o['height']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::google_map_zoom_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['zoom'], $key ); ?>><?php echo $value; ?></option>';
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
