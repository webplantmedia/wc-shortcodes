<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Share_Buttons extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->share_buttons, $instance );
		$o = WPC_Shortcodes_Sanitize::share_buttons_attr( $o );
		?>

		<div id="wc-shortcodes-share-buttons-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p class="wcs-instruction">You can configure your share buttons in your <a href="<?php echo WPC_Shortcodes_Vars::$plugin_settings_url . '&wpcsf_active_tab=wc-shortcodes-options-share-buttons-options-tab'; ?>" target="_blank">Shortcode Settings Page</a>.</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
		</div>
		<?php
	}
}
