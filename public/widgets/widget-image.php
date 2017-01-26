<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Image extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->image, $instance );
		$o = WPC_Shortcodes_Sanitize::image_attr( $o );
		?>

		<div id="wc-shortcodes-image-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('attachment_id'); ?>"><?php _e('Attachment ID:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('attachment_id'); ?>" data-autocomplete-type="single" data-autocomplete-lookup="attachment" name="<?php echo $this->get_field_name('attachment_id'); ?>" value="<?php echo $o['attachment_id']; ?>" />
				<span class="wcs-description">Search for image title.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('alt'); ?>" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $o['alt']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('caption'); ?>"><?php _e('Caption:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('caption'); ?>" name="<?php echo $this->get_field_name('caption'); ?>" value="<?php echo $o['caption']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('link_to'); ?>"><?php _e('Image Link To:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('link_to'); ?>" name="<?php echo $this->get_field_name('link_to'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::image_link_to_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['link_to'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $o['url']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('align'); ?>"><?php _e('Image Align:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('align'); ?>" name="<?php echo $this->get_field_name('align'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['align'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image Size:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::image_sizes() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['size'], $key ); ?>><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
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
				<label for="<?php echo $this->get_field_id('flag'); ?>"><?php _e('flag:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('flag'); ?>" name="<?php echo $this->get_field_name('flag'); ?>" value="<?php echo $o['flag']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('left'); ?>"><?php _e('Left:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('left'); ?>" name="<?php echo $this->get_field_name('left'); ?>" value="<?php echo $o['left']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('right'); ?>"><?php _e('Right:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('right'); ?>" name="<?php echo $this->get_field_name('right'); ?>" value="<?php echo $o['right']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('top'); ?>"><?php _e('Top:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('top'); ?>" name="<?php echo $this->get_field_name('top'); ?>" value="<?php echo $o['top']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('bottom'); ?>"><?php _e('Bottom:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('bottom'); ?>" name="<?php echo $this->get_field_name('bottom'); ?>" value="<?php echo $o['bottom']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_color'); ?>"><?php _e('Text Color:') ?></label><br />
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-color-picker" id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" value="<?php echo $o['text_color']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background Color:') ?></label><br />
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-color-picker" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" value="<?php echo $o['background_color']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('flag_width'); ?>"><?php _e('Flag Width:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('flag_width'); ?>" name="<?php echo $this->get_field_name('flag_width'); ?>" value="<?php echo $o['flag_width']; ?>" />
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
				$('#wc-shortcodes-image-widget-<?php echo $this->number; ?>').wcPostsWidget().wcColorPickerWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
