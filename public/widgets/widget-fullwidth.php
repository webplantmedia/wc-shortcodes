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
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::fullwidth_style_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['style'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background Color:') ?></label><br />
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-color-picker" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" value="<?php echo $o['background_color']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Border Color:') ?></label><br />
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-color-picker" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" value="<?php echo $o['border_color']; ?>" />
			</p>
			<h2>Inner Content Settings</h2>
			<p>
				<label for="<?php echo $this->get_field_id('max_width'); ?>"><?php _e('Max Width For Inner Content:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('max_width'); ?>" name="<?php echo $this->get_field_name('max_width'); ?>" value="<?php echo $o['max_width']; ?>" />
				<span class="wcs-description">Enter CSS unit value. Leave blank if you want the content to span the full width.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding_top'); ?>"><?php _e('Top Padding:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding_top'); ?>" name="<?php echo $this->get_field_name('padding_top'); ?>" value="<?php echo $o['padding_top']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding_bottom'); ?>"><?php _e('Bottom Padding:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding_bottom'); ?>" name="<?php echo $this->get_field_name('padding_bottom'); ?>" value="<?php echo $o['padding_bottom']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding_side'); ?>"><?php _e('Side Padding:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding_side'); ?>" name="<?php echo $this->get_field_name('padding_side'); ?>" value="<?php echo $o['padding_side']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-fullwidth-widget-<?php echo $this->number; ?>').wcColorPickerWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
