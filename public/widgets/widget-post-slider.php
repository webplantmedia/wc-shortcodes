<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Post_Slider extends WP_Widget {
	function __construct() {

		$widget_ops = array( 'description' => __('Add a post slider to your widget area.') );
		parent::__construct( 'wc_shortcodes_post_slider', __('Angie Makes - Post Slider'), $widget_ops );
	}

	function widget($args, $instance) {
		$shortcode = array();
		foreach ( $instance as $key => $value ) {
			$shortcode[] = $key . '="' . $value . '"';
		}

		if ( ! empty( $shortcode ) ) {
			$shortcode = implode( " ", $shortcode );
			$shortcode = '[wc_post_slider ' . $shortcode . '][/wc_post_slider]';
		}
		else {
			$shortcode = '[wc_post_slider][/wc_post_slider]';
		}

		echo $args['before_widget'];
		echo do_shortcode( $shortcode );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = WPC_Shortcodes_Sanitize::post_slider_attr_fix_bools( $new_instance );
		$instance = WPC_Shortcodes_Sanitize::post_slider_attr( $new_instance );

		return $instance;
	}

	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->post_slider, $instance );
		$o = WPC_Shortcodes_Sanitize::post_slider_attr( $o );
		
		$post_types = WPC_Shortcodes_Widget_Options::post_types('wcs_slide');
		?>

		<div id="wc-shortcodes-post-slider-widget-<?php echo $this->number; ?>" class="wc-shortcodes-post-slider-widget wc-shortcodes-visual-manager wpc-ui-theme-override">
			<h3>Select Posts</h3>
			<div>
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
					<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label>
					<select id="<?php echo $this->get_field_id('post_type'); ?>" class="wc-shortcodes-widget-option wc-shortcodes-widget-post-type-selector" name="<?php echo $this->get_field_name('post_type'); ?>">
						<?php foreach ( $post_types as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['post_type'], $key ); ?>><?php echo $value; ?></option>';
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
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_meta_category'); ?>" name="<?php echo $this->get_field_name('show_meta_category'); ?>" value="1" <?php checked( $o['show_meta_category'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_meta_category'); ?>"><?php _e('Show Meta Category') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked( $o['show_title'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Title') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>" value="1" <?php checked( $o['show_content'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show Content') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_button'); ?>" name="<?php echo $this->get_field_name('show_button'); ?>" value="1" <?php checked( $o['show_button'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_button'); ?>"><?php _e('Show Button') ?></label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('readmore'); ?>"><?php _e('Read More Text:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" value="<?php echo $o['readmore']; ?>" />
					<span class="wcs-description">Enter button text. Leave blank if you do not want a button.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('button_class'); ?>"><?php _e('Button Class:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('button_class'); ?>" name="<?php echo $this->get_field_name('button_class'); ?>" value="<?php echo $o['button_class']; ?>" />
					<span class="wcs-description">Enter class name for custom CSS styling.</span>
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
					<label for="<?php echo $this->get_field_id('heading_type'); ?>"><?php _e('Heading Type:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('heading_type'); ?>" name="<?php echo $this->get_field_name('heading_type'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::heading_tags() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['heading_type'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
			</div>
			<h3>Style</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::post_slider_templates() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['template'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
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
					<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt Length:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $o['excerpt_length']; ?>" />
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
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-post-slider-widget-<?php echo $this->number; ?>').accordion({heightStyle: "content", collapsible: true}).wcPostsWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
