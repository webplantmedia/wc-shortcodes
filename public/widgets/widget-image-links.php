<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Image_Links extends WP_Widget {
	function __construct() {

		$widget_ops = array( 'description' => __('Add image links to your widget area.') );
		parent::__construct( 'wc_shortcodes_image_links', __('Angie Makes - Image Links'), $widget_ops );
	}

	function widget($args, $instance) {
		$shortcode = array();
		foreach ( $instance as $key => $value ) {
			$shortcode[] = $key . '="' . $value . '"';
		}

		if ( ! empty( $shortcode ) ) {
			$shortcode = implode( " ", $shortcode );
			$shortcode = '[wc_image_links ' . $shortcode . '][/wc_image_links]';
		}
		else {
			$shortcode = '[wc_image_links][/wc_image_links]';
		}

		echo $args['before_widget'];
		echo do_shortcode( $shortcode );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = WPC_Shortcodes_Sanitize::image_links_attr( $new_instance );

		return $instance;
	}

	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->image_links, $instance );
		$o = WPC_Shortcodes_Sanitize::image_links_attr( $o );

		?>

		<div id="wc-shortcodes-image-links-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager wpc-image-wrapper wpc-ui-theme-override">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<?php
				$imagestyle = '';
				if ( empty( $o['image_'.$i] ) ) {
					$imagestyle = ' style="display:none"';
				}
				?>
				<h3>Image <?php echo $i; ?></h3>
				<div>
					<div class="wpc-widgets-image-field">
						<label for="<?php echo $this->get_field_id( 'image_'.$i ); ?>"><?php echo _e( 'Image URL:' ); ?>
							<input class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id( 'image_'.$i ); ?>" name="<?php echo $this->get_field_name( 'image_'.$i ); ?>" type="text" value="<?php echo esc_url( $o['image_'.$i] ); ?>" />
						</label>
						<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'image_'.$i ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
						<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'image_'.$i ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
						<div class="wpc-widgets-preview-image"<?php echo $imagestyle; ?>><img src="<?php echo esc_url($o['image_'.$i]); ?>" /></div>
					</div>
					<p>
						<label for="<?php echo $this->get_field_id('text_'.$i); ?>"><?php _e('Text:') ?></label>
						<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('text_'.$i); ?>" name="<?php echo $this->get_field_name('text_'.$i); ?>" value="<?php echo $o['text_'.$i]; ?>" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('url_'.$i); ?>"><?php _e('URL:') ?></label>
						<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('url_'.$i); ?>" name="<?php echo $this->get_field_name('url_'.$i); ?>" value="<?php echo $o['url_'.$i]; ?>" />
					</p>
				</div>
			<?php endfor; ?>
			<h3>Settings</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('text_position'); ?>"><?php _e('Text Position:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('text_position'); ?>" name="<?php echo $this->get_field_name('text_position'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::image_link_text_position_values() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['text_position'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('heading_type'); ?>"><?php _e('Heading Type:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('heading_type'); ?>" name="<?php echo $this->get_field_name('heading_type'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::heading_tags() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['heading_type'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
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
					<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $o['height']; ?>" />
					<span class="wcs-description">Enter CSS unit value.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('style_format'); ?>"><?php _e('Style Format:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('style_format'); ?>" name="<?php echo $this->get_field_name('style_format'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::image_links_style_format_values() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['style_format'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
					<span class="wcs-description">Enter class name for custom CSS styling.</span>
				</p>
			</div>
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-image-links-widget-<?php echo $this->number; ?>').accordion({heightStyle: "content", collapsible: true}).wcColorPickerWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
