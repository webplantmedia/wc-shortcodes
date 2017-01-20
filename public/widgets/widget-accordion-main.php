<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Accordion_Main extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->accordion_main, $instance );
		$o = WPC_Shortcodes_Sanitize::accordion_main_attr( $o );
		?>

		<div id="wc-shortcodes-accordion-main-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('collapse'); ?>" name="<?php echo $this->get_field_name('collapse'); ?>" value="1" <?php checked( $o['collapse'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('collapse'); ?>"><?php _e('Collapse?') ?></label>
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('leaveopen'); ?>" name="<?php echo $this->get_field_name('leaveopen'); ?>" value="1" <?php checked( $o['leaveopen'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('leaveopen'); ?>"><?php _e('Leave Open?') ?></label>
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
