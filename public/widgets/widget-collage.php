<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Collage extends WP_Widget {
	function __construct() {

		$widget_ops = array( 'description' => __('Add a collage to your widget area.') );
		parent::__construct( 'wc_shortcodes_collage', __('Angie Makes - Collage'), $widget_ops );
	}

	function widget($args, $instance) {
		$shortcode = array();
		foreach ( $instance as $key => $value ) {
			$shortcode[] = $key . '="' . $value . '"';
		}

		if ( ! empty( $shortcode ) ) {
			$shortcode = implode( " ", $shortcode );
			$shortcode = '[wc_collage ' . $shortcode . '][/wc_collage]';
		}
		else {
			$shortcode = '[wc_collage][/wc_collage]';
		}

		echo $args['before_widget'];
		echo do_shortcode( $shortcode );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = WPC_Shortcodes_Sanitize::collage_attr_fix_bools( $new_instance );
		$instance = WPC_Shortcodes_Sanitize::collage_attr( $new_instance );

		return $instance;
	}

	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		?>

		<?php
		$o = array_merge( WPC_Shortcodes_Vars::$attr->collage, $instance );
		$o = WPC_Shortcodes_Sanitize::collage_attr( $o );
		
		$post_types = array( 'wcs_collage' => 'wcs_collage' );
		$image_title = array( 1 => 'Top Right', 2 => 'Bottom Left', 3=> 'Bottom Right 1', 4=> 'Bottom Right 2' );
		?>

		<div id="wc-shortcodes-collage-widget-<?php echo $this->number; ?>" class="wc-shortcodes-collage-widget wc-shortcodes-visual-manager wpc-image-wrapper wpc-ui-theme-override">
			<h3>Select Posts</h3>
			<div>
				<p class="wcs-instruction wcs-plain-instructions"><a href="<?php echo admin_url( 'edit.php?post_type=wcs_collage' ); ?>" target="_blank">Configure your collage items</a></p>
				<p>
					<label for="<?php echo $this->get_field_id('pids'); ?>"><?php _e('Post IDs:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('pids'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="post" name="<?php echo $this->get_field_name('pids'); ?>" value="<?php echo $o['pids']; ?>" />
					<span class="wcs-description">Leave blank to display all posts.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::order_fields() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['order'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::order_by_fields() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['orderby'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:'); ?></label>
					<select id="<?php echo $this->get_field_id('taxonomy'); ?>" class="wc-shortcodes-widget-option wc-shortcodes-widget-taxonomy-selector" name="<?php echo $this->get_field_name('taxonomy'); ?>">
						<option value=""<?php selected( $o['taxonomy'], "" ); ?>>No Taxonomy</option>';
						<?php foreach ( $post_types as $post_type_name ) : ?>
							<?php $taxonomies = get_object_taxonomies( $post_type_name, 'names' ); ?>
							<?php if ( $taxonomies ) : ?>
								<?php foreach ( $taxonomies  as $key ) : ?>
									<option value="<?php echo $key; ?>"<?php selected( $o['taxonomy'], $key ); ?> data-post-type="<?php echo $post_type_name; ?>"><?php echo $key; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('terms'); ?>"><?php _e('Terms:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('terms'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="terms" name="<?php echo $this->get_field_name('terms'); ?>" value="<?php echo $o['terms']; ?>" />
					<span class="wcs-description">Leave blank to display all terms.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Posts Per Page:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $o['posts_per_page']; ?>" />
					<span class="wcs-description">Enter -1 for unlimited posts.</span>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('ignore_sticky_posts'); ?>" name="<?php echo $this->get_field_name('ignore_sticky_posts'); ?>" value="1" <?php checked( $o['ignore_sticky_posts'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('ignore_sticky_posts'); ?>"><?php _e('Ignore Sticky Posts') ?></label>
				</p>
			</div>
			<h3>Content</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('button_class'); ?>"><?php _e('Button Class:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('button_class'); ?>" name="<?php echo $this->get_field_name('button_class'); ?>" value="<?php echo $o['button_class']; ?>" />
					<span class="wcs-description">Enter class name for custom CSS styling. (Ex: button primary-button)</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image Size:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::image_sizes() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['size'], $key ); ?>><?php echo $value; ?></option>
						<?php endforeach; ?>
					</select>
				</p>
			</div>
			<h3>Style</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::collage_templates() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['template'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('gutter_space'); ?>"><?php _e('Gutter Space:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('gutter_space'); ?>" name="<?php echo $this->get_field_name('gutter_space'); ?>" value="<?php echo $o['gutter_space']; ?>" />
					<span class="wcs-description">Enter a pixel value between 0 and 50.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('heading_size'); ?>"><?php _e('Heading Size:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('heading_size'); ?>" name="<?php echo $this->get_field_name('heading_size'); ?>" value="<?php echo $o['heading_size']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('mobile_heading_size'); ?>"><?php _e('Mobile Heading Size:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('mobile_heading_size'); ?>" name="<?php echo $this->get_field_name('mobile_heading_size'); ?>" value="<?php echo $o['mobile_heading_size']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('desktop_height'); ?>"><?php _e('Desktop Height:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('desktop_height'); ?>" name="<?php echo $this->get_field_name('desktop_height'); ?>" value="<?php echo $o['desktop_height']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('laptop_height'); ?>"><?php _e('Laptop Height:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('laptop_height'); ?>" name="<?php echo $this->get_field_name('laptop_height'); ?>" value="<?php echo $o['laptop_height']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('mobile_height'); ?>"><?php _e('Mobile Height:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('mobile_height'); ?>" name="<?php echo $this->get_field_name('mobile_height'); ?>" value="<?php echo $o['mobile_height']; ?>" />
				</p>
			</div>
			<h3>Slider Settings</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('slider_mode'); ?>"><?php _e('Slider Mode:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('slider_mode'); ?>" name="<?php echo $this->get_field_name('slider_mode'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::post_slider_modes() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['slider_mode'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('slider_pause'); ?>"><?php _e('Slider Pause:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('slider_pause'); ?>" name="<?php echo $this->get_field_name('slider_pause'); ?>" value="<?php echo $o['slider_pause']; ?>" />
					<span class="wcs-description">Enter number in milliseconds.</span>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('slider_auto'); ?>" name="<?php echo $this->get_field_name('slider_auto'); ?>" value="1" <?php checked( $o['slider_auto'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('slider_auto'); ?>"><?php _e('Enable Auto Transition') ?></label>
				</p>
			</div>
			<input type="hidden" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-post-type-selector" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" value="<?php echo $o['post_type']; ?>" />
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-collage-widget-<?php echo $this->number; ?>').accordion({heightStyle: "content", collapsible: true}).wcPostsWidget().wcColorPickerWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
