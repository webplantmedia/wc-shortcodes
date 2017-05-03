<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Featured_Posts extends WP_Widget {
	function __construct() {

		$widget_ops = array( 'description' => __('Add featured posts to your widget.') );
		parent::__construct( 'wc_shortcodes_featured_posts', __('Angie Makes - Featured Posts'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$shortcode = array();
		foreach ( $instance as $key => $value ) {
			if ( 'title' == $key ) {
				continue;
			}
			$shortcode[] = $key . '="' . $value . '"';
		}

		if ( ! empty( $shortcode ) ) {
			$shortcode = implode( " ", $shortcode );
			$shortcode = '[wc_featured_posts ' . $shortcode . '][/wc_featured_posts]';
		}
		else {
			$shortcode = '[wc_featured_posts][/wc_featured_posts]';
		}

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		echo do_shortcode( $shortcode );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = WPC_Shortcodes_Sanitize::featured_posts_attr_fix_bools( $new_instance );
		$instance = WPC_Shortcodes_Sanitize::featured_posts_attr( $new_instance );

		return $instance;
	}

	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->featured_posts, $instance );
		$o = WPC_Shortcodes_Sanitize::featured_posts_attr( $o );
		
		$post_types = WPC_Shortcodes_Widget_Options::post_types();
		?>

		<div id="wc-shortcodes-featured-posts-widget-<?php echo $this->number; ?>" class="wc-shortcodes-featured-posts-widget wc-shortcodes-visual-manager">
			<?php if ( ! isset( $o['wc_shortcodes_using_visual_manager'] ) ) : ?>
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
				</p>
			<?php endif; ?>

			<div class="wpc-ui-theme-override">
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
					<p>
						<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Layout:'); ?></label>
						<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
							<?php foreach ( WPC_Shortcodes_Widget_Options::featured_post_layouts() as $key => $value ) : ?>
								<option value="<?php echo $key; ?>"<?php selected( $o['layout'], $key ); ?>><?php echo $value; ?></option>';
							<?php endforeach; ?>
						</select>
					</p>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-featured-posts-widget-<?php echo $this->number; ?> .wpc-ui-theme-override').accordion({heightStyle: "content", collapsible: true}).wcPostsWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
