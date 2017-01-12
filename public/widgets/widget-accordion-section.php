<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WC_Shortcodes_Widget_Accordion_Section extends WP_Widget {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->accordion_section, $instance );
		$o = WPC_Shortcodes_Sanitize::accordion_section_attr( $o );
		?>

		<div id="wc-shortcodes-accordion-section-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class Name:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
			</p>
		</div>
		<?php
	}
}
