<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Call_To_Action extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->call_to_action, $instance );
		$o = WPC_Shortcodes_Sanitize::call_to_action_attr( $o );

		?>

		<div id="wc-shortcodes-call-to-action-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager wpc-image-wrapper wpc-ui-theme-override">
			<?php
			$imagestyle = '';
			if ( empty( $o['image'] ) ) {
				$imagestyle = ' style="display:none"';
			}
			?>
			<div class="wpc-widgets-image-field">
				<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php echo _e( 'Image URL:' ); ?>
					<input class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $o['image'] ); ?>" />
				</label>
				<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
				<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
				<div class="wpc-widgets-preview-image"<?php echo $imagestyle; ?>><img src="<?php echo esc_url($o['image']); ?>" /></div>
			</div>
			<?php
			$imagestyle = '';
			if ( empty( $o['image_2x'] ) ) {
				$imagestyle = ' style="display:none"';
			}
			?>
			<div class="wpc-widgets-image-field">
				<label for="<?php echo $this->get_field_id( 'image_2x' ); ?>"><?php echo _e( 'Retina Image URL:' ); ?>
					<input class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id( 'image_2x' ); ?>" name="<?php echo $this->get_field_name( 'image_2x' ); ?>" type="text" value="<?php echo esc_url( $o['image_2x'] ); ?>" />
				</label>
				<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'image_2x' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
				<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'image_2x' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
				<div class="wpc-widgets-preview-image"<?php echo $imagestyle; ?>><img src="<?php echo esc_url($o['image_2x']); ?>" /></div>
			</div>
			<p>
				<label for="<?php echo $this->get_field_id('image_max_width'); ?>"><?php _e('Image Max Width:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('image_max_width'); ?>" name="<?php echo $this->get_field_name('image_max_width'); ?>" value="<?php echo $o['image_max_width']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('image_position'); ?>"><?php _e('Image Position:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('image_position'); ?>" name="<?php echo $this->get_field_name('image_position'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['image_position'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('style_format'); ?>"><?php _e('Style Format:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('style_format'); ?>" name="<?php echo $this->get_field_name('style_format'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::call_to_action_style_format_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['style_format'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_max_width'); ?>"><?php _e('Text Max Width:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('text_max_width'); ?>" name="<?php echo $this->get_field_name('text_max_width'); ?>" value="<?php echo $o['text_max_width']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_position'); ?>"><?php _e('Text Position:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('text_position'); ?>" name="<?php echo $this->get_field_name('text_position'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['text_position'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<div>
				<label for="<?php echo $this->get_field_id('gutter_position'); ?>"><?php _e('Gutter Position:') ?></label>
				<div class="wc-shortcodes-range-wrapper clear">
					<input type="range" min="0" max="100" step="1" class="wc-shortcodes-widget-option wc-shortcodes-range-input widefat" id="<?php echo $this->get_field_id('gutter_position'); ?>" name="<?php echo $this->get_field_name('gutter_position'); ?>" data-output="<?php echo $this->get_field_id('gutter_position'); ?>-output" value="<?php echo $o['gutter_position']; ?>" />
					<output id="<?php echo $this->get_field_id('gutter_position'); ?>-output"><?php echo $o['gutter_position']; ?></output>
				</div>
				<span class="wcs-description">This will determine the percent width for the left and right side.</span>
			</div>
			<p>
				<label for="<?php echo $this->get_field_id('gutter_spacing'); ?>"><?php _e('Gutter Spacing:') ?></label>
				<input type="number" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('gutter_spacing'); ?>" name="<?php echo $this->get_field_name('gutter_spacing'); ?>" value="<?php echo $o['gutter_spacing']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding_top'); ?>"><?php _e('Padding Top:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding_top'); ?>" name="<?php echo $this->get_field_name('padding_top'); ?>" value="<?php echo $o['padding_top']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding_bottom'); ?>"><?php _e('Padding Bottom:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding_bottom'); ?>" name="<?php echo $this->get_field_name('padding_bottom'); ?>" value="<?php echo $o['padding_bottom']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('padding_side'); ?>"><?php _e('Padding Side:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('padding_side'); ?>" name="<?php echo $this->get_field_name('padding_side'); ?>" value="<?php echo $o['padding_side']; ?>" />
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
				$('.wc-shortcodes-range-input').on( 'input', function() {
					var $this = $(this);
					var id = $this.data('output');
					if ( typeof id == 'string' ) {
						var $output = $('#' + id);
						console.log('#' + id);
						if ( $output.length ) {
							var val = $this.val();
							console.log($output);
							console.log(val);
							$output.val( val );
						}
					}
				});
			});
			/* ]]> */
		</script>
		<?php
	}
}
