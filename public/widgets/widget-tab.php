<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Tab extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->tab, $instance );
		$o = WPC_Shortcodes_Sanitize::tab_attr( $o );
		?>

		<div id="wc-shortcodes-tab-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p class="wcs-instruction">Make sure you enter this shortcode inside a <code>[wc_tabgroup]</code> shortcode.</p>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
		</div>
		<?php
	}
}
