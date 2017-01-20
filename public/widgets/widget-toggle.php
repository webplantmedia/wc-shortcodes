<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Toggle extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->toggle, $instance );
		$o = WPC_Shortcodes_Sanitize::toggle_attr( $o );
		?>

		<div id="wc-shortcodes-toggle-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding'); ?>"><?php _e('Padding:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding'); ?>" name="<?php echo $this->get_field_name('padding'); ?>" value="<?php echo $o['padding']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('borde_width'); ?>"><?php _e('Border Width:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('border_width'); ?>" name="<?php echo $this->get_field_name('border_width'); ?>" value="<?php echo $o['border_width']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Layout:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::accordion_main_layouts() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['layout'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}
