<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Heading extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		// pr(WPC_Shortcodes_Vars::$attr->heading);
		$o = array_merge( WPC_Shortcodes_Vars::$attr->heading, $instance );
		$o = WPC_Shortcodes_Sanitize::heading_attr( $o );
		?>

		<div id="wc-shortcodes-heading-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Heading Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::heading_tags() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['type'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('margin_top'); ?>"><?php _e('Top Margin:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('margin_top'); ?>" name="<?php echo $this->get_field_name('margin_top'); ?>" value="<?php echo $o['margin_top']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('margin_bottom'); ?>"><?php _e('Bottom Margin:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('margin_bottom'); ?>" name="<?php echo $this->get_field_name('margin_bottom'); ?>" value="<?php echo $o['margin_bottom']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_align'); ?>"><?php _e('Text Align:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['text_align'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('font_size'); ?>"><?php _e('Font Size:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('font_size'); ?>" name="<?php echo $this->get_field_name('font_size'); ?>" value="<?php echo $o['font_size']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Font Color:') ?></label><br />
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-color-picker" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $o['color']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_left'); ?>"><?php _e('Icon Left:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('icon_left'); ?>" name="<?php echo $this->get_field_name('icon_left'); ?>" value="<?php echo $o['icon_left']; ?>" />
				<span class="wcs-description">Enter name of <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome icon</a>.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_right'); ?>"><?php _e('Icon Right:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('icon_right'); ?>" name="<?php echo $this->get_field_name('icon_right'); ?>" value="<?php echo $o['icon_right']; ?>" />
				<span class="wcs-description">Enter name of <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome icon</a>.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_spacing'); ?>"><?php _e('Icon Spacing:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('icon_spacing'); ?>" name="<?php echo $this->get_field_name('icon_spacing'); ?>" value="<?php echo $o['icon_spacing']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
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
				$('#wc-shortcodes-heading-widget-<?php echo $this->number; ?>').wcFontAwesomeWidget();
				$('#wc-shortcodes-heading-widget-<?php echo $this->number; ?>').wcColorPickerWidget();

			});
			/* ]]> */
		</script>
		<?php
	}
}
