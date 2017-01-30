<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_FullWidth extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->fullwidth, $instance );
		$o = WPC_Shortcodes_Sanitize::fullwidth_attr( $o );
		?>

		<div id="wc-shortcodes-fullwidth-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('selector'); ?>"><?php _e('Selector:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('selector'); ?>" name="<?php echo $this->get_field_name('selector'); ?>" value="<?php echo $o['selector']; ?>" />
				<span class="wcs-description">Enter the name of the selector of the outer container element you want your content to span full width to.<br /><br />Example: <code>#main</code>, <code>.site-content</code>, <code>body</code>.<br /><br />Leave blank to use default selector <code><?php echo WPC_Shortcodes_Vars::$theme_support[ 'fullwidth_container' ]; ?></code></span>
			</p>
		</div>
		<?php
	}
}
