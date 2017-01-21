<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Skillbar extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->skillbar, $instance );
		$o = WPC_Shortcodes_Sanitize::skillbar_attr( $o );
		?>

		<div id="wc-shortcodes-skillbar-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('percentage'); ?>"><?php _e('Percentage:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('percentage'); ?>" name="<?php echo $this->get_field_name('percentage'); ?>" value="<?php echo $o['percentage']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Font Color:') ?></label><br />
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-color-picker" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $o['color']; ?>" />
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_percent'); ?>" name="<?php echo $this->get_field_name('show_percent'); ?>" value="1" <?php checked( $o['show_percent'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('show_percent'); ?>"><?php _e('Show Percent?') ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
		</div>
		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-skillbar-widget-<?php echo $this->number; ?>').wcColorPickerWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
