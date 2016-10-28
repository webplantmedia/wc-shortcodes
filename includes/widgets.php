<?php
/******************************************************************
Author: Chris Baldelomar
URL: http://webplantmedia.com

All widget code should go here.
******************************************************************/

function wc_shortcodes_register_widgets() {
	// Register social icons widget version 2
	register_widget('WC_Shortcodes_Social_Icons_Widget');
	register_widget('WC_Shortcodes_Post_Slider_Widget');
}
add_action('widgets_init', 'wc_shortcodes_register_widgets');

/**
 * WC_Shortcodes_Social_Icons_Widget
 *
 * This displays a sidebar widget of social media icons.
 *
 * @uses WP
 * @uses _Widget
 */
class WC_Shortcodes_Social_Icons_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => __('Add your social icons to your sidebar.') );
		parent::__construct( 'wc_shortcodes_social_icons', __('WP Canvas - Social Media Icons'), $widget_ops );
	}

	function widget($args, $instance) {

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		if ( empty( $instance['format'] ) ) {
			$instance['format'] = 'default';
		}
		$format = $instance['format'];

		// set class with the number of columns the user selected
		$columns = $instance['columns'];
		if ( empty($columns) ) {
			$columns = 'float-left';
		}
		$maxheight = 'none';
		if ( isset( $instance['maxheight'] ) ) {
			$maxheight = $instance['maxheight'];
		}

		$order = get_option( WC_SHORTCODES_PREFIX . 'social_icons_display' );

		switch ( $format ) {
			case 'default' :
				$format = get_option( WC_SHORTCODES_PREFIX . 'social_icons_format', 'icon' );
				break;
			case 'icon' :
				$format = 'icon';	
				break;
			default :
				$format = 'image';	
		}

		$show_image = 'image' == $format ? true : false;

		if ( ! is_array( $order ) || empty( $order ) ) {
			return;
		}

		$first = true;

		$column_display = false;
		if ( is_numeric( $columns ) & (int) $columns > 0 ) {
			$column_display = true;
		}

		$classes = array();
		$classes[] = 'wc-shortcodes-social-icons';
		$classes[] = 'wc-shortcodes-clearfix';
		$classes[] = 'wc-shortcodes-columns-'.$columns;
		$classes[] = 'wc-shortcodes-maxheight-'.$maxheight;
		$classes[] = 'wc-shortcodes-social-icons-format-'.$format;

		$html = '<ul class="'.implode( ' ', $classes ).'">';
			$i = 0;
			foreach ($order as $key => $name) {
				$li_class = array();
				$li_class[] = 'wc-shortcodes-social-icon';
				$li_class[] = 'wc-shortcode-social-icon-' . $key;

				if ( $column_display && $i % $columns == 0 ) {
					$li_class[] = 'clear-left';
				}

				$link_option_name = WC_SHORTCODES_PREFIX . $key . '_link';
				$image_icon_option_name = WC_SHORTCODES_PREFIX . $key . '_icon';
				$font_icon_option_name = WC_SHORTCODES_PREFIX . $key . '_font_icon';

				$social_link = get_option( $link_option_name );
				$social_link = apply_filters( 'wc_shortcodes_social_link', $social_link, $key );

				$first_class = $first ? ' first-icon' : '';
				$first = false;

				if ( $show_image ) {
					$icon_url = get_option( $image_icon_option_name );

					$html .= '<li class="wc-shortcodes-social-icon wc-shortcode-social-icon-' . $key . $first_class . '">';
						$html .='<a target="_blank" href="'.$social_link.'">';
							$html .= '<img src="'.$icon_url.'" alt="'.$name.'">';
						$html .= '</a>';
					$html .= '</li>';
				}
				else {
					$icon_class = get_option( $font_icon_option_name );

					$html .= '<li class="wc-shortcodes-social-icon wc-shortcode-social-icon-' . $key . $first_class . '">';
						$html .='<a target="_blank" href="'.$social_link.'">';
							$html .= '<i class="fa '.$icon_class.'"></i>';
						$html .= '</a>';
					$html .= '</li>';
				}
			}
		$html .= '</ul>';

		echo $html;

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['format'] = $new_instance['format'];
		$instance['columns'] = $new_instance['columns'];
		$instance['maxheight'] = $new_instance['maxheight'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Follow Me!';
		$format = isset( $instance['format'] ) ? $instance['format'] : 'default';
		$columns = isset( $instance['columns'] ) ? $instance['columns'] : 'float-left';
		$maxheight = isset( $instance['maxheight'] ) ? $instance['maxheight'] : 'none';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('format'); ?>"><?php _e('Format:'); ?></label>
			<select id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>">
				<option value="default"<?php selected( $format, 'default' ); ?>>Default</option>';
				<option value="icon"<?php selected( $format, 'icon' ); ?>>Icon</option>';
				<option value="image"<?php selected( $format, 'image' ); ?>>Image</option>';
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Display:'); ?></label>
			<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
				<option value="float-center"<?php selected( $columns, 'float-center' ); ?>>Float Center</option>';
				<option value="float-left"<?php selected( $columns, 'float-left' ); ?>>Float Left</option>';
				<option value="float-right"<?php selected( $columns, 'float-right' ); ?>>Float Right</option>';
				<option value="1"<?php selected( $columns, '1' ); ?>>1 Column</option>';
				<option value="2"<?php selected( $columns, '2' ); ?>>2 Columns</option>';
				<option value="3"<?php selected( $columns, '3' ); ?>>3 Columns</option>';
				<option value="4"<?php selected( $columns, '4' ); ?>>4 Columns</option>';
				<option value="5"<?php selected( $columns, '5' ); ?>>5 Columns</option>';
				<option value="6"<?php selected( $columns, '6' ); ?>>6 Columns</option>';
				<option value="7"<?php selected( $columns, '7' ); ?>>7 Columns</option>';
				<option value="8"<?php selected( $columns, '8' ); ?>>8 Columns</option>';
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('maxheight'); ?>"><?php _e('Max Height:'); ?></label>
			<select id="<?php echo $this->get_field_id('maxheight'); ?>" name="<?php echo $this->get_field_name('maxheight'); ?>">
				<option value="none"<?php selected( $maxheight, 'none' ); ?>>None</option>';
				<?php for( $i = 10; $i <= 70; $i = $i + 2 ) : ?>
					<option value="<?php echo $i; ?>"<?php selected( $maxheight, $i ); ?>><?php echo $i; ?>px</option>';
				<?php endfor; ?>
			</select>
		</p>
		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('.wc-shortcodes-social-icons').sortable({ axis: "y" });
			});
			/* ]]> */
		</script>
		<?php
	}
}

/**
 * WC_Shortcodes_Post_Slider_Widget
 *
 * @uses WP
 * @uses _Widget
 */
class WC_Shortcodes_Post_Slider_Widget extends WP_Widget {
	function __construct() {

		$widget_ops = array( 'description' => __('Add a post slider to your widget area.') );
		parent::__construct( 'wc_shortcodes_post_slider', __('Post Slider'), $widget_ops );
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
		$instance['pids'] = $new_instance['pids'];
		$instance['order'] = $new_instance['order'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
		$instance['ignore_sticky_posts'] = (int) $new_instance['ignore_sticky_posts'];
		$instance['taxonomy'] = $new_instance['taxonomy'];
		$instance['terms'] = $new_instance['terms'];
		$instance['show_meta_category'] = (int) $new_instance['show_meta_category'];
		$instance['show_title'] = (int) $new_instance['show_title'];
		$instance['show_content'] = (int) $new_instance['show_content'];
		$instance['readmore'] = $new_instance['readmore'];
		$instance['button_class'] = strip_tags( stripslashes( $new_instance['button_class'] ) );
		$instance['size'] = $new_instance['size'];
		$instance['heading_type'] = $new_instance['heading_type'];
		$instance['heading_size'] = (int) $new_instance['heading_size'];
		$instance['mobile_heading_size'] = (int) $new_instance['mobile_heading_size'];
		$instance['excerpt_length'] = (int) $new_instance['excerpt_length'];
		$instance['desktop_height'] = (int) $new_instance['desktop_height'];
		$instance['laptop_height'] = (int) $new_instance['laptop_height'];
		$instance['mobile_height'] = (int) $new_instance['mobile_height'];
		$instance['template'] = $new_instance['template'];
		$instance['slider_mode'] = $new_instance['slider_mode'];
		$instance['slider_pause'] = (int) $new_instance['slider_pause'];
		$instance['slider_auto'] = (int) $new_instance['slider_auto'];

		return $instance;
	}

	function form( $instance ) {
		global $wc_shortcodes_widget_ops;

		$pids = isset( $instance['pids'] ) ? $instance['pids'] : '';
		$order = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
		$post_type = isset( $instance['post_type'] ) ? $instance['post_type'] : 'post';
		$posts_per_page = isset( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 10;
		$ignore_sticky_posts = isset( $instance['ignore_sticky_posts'] ) ? $instance['ignore_sticky_posts'] : 1;
		$taxonomy = isset( $instance['taxonomy'] ) ? $instance['taxonomy'] : '';
		$terms = isset( $instance['terms'] ) ? $instance['terms'] : '';
		$show_meta_category = isset( $instance['show_meta_category'] ) ? $instance['show_meta_category'] : 0;
		$show_title = isset( $instance['show_title'] ) ? $instance['show_title'] : 1;
		$show_content = isset( $instance['show_content'] ) ? $instance['show_content'] : 1;
		$readmore = isset( $instance['readmore'] ) ? $instance['readmore'] : 'Coninue Reading';
		$button_class = isset( $instance['button_class'] ) ? $instance['button_class'] : 'button secondary-button';
		$size = isset( $instance['size'] ) ? $instance['size'] : 'full';
		$heading_type = isset( $instance['heading_type'] ) ? $instance['heading_type'] : 'h2';
		$heading_size = isset( $instance['heading_size'] ) ? $instance['heading_size'] : 30;
		$mobile_heading_size = isset( $instance['mobile_heading_size'] ) ? $instance['mobile_heading_size'] : 24;
		$excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 30;
		$desktop_height = isset( $instance['desktop_height'] ) ? $instance['desktop_height'] : 600;
		$instance['desktop_height'] = '600';
		$laptop_height = isset( $instance['laptop_height'] ) ? $instance['laptop_height'] : 500;
		$mobile_height = isset( $instance['mobile_height'] ) ? $instance['mobile_height'] : 350;
		$template = isset( $instance['template'] ) ? $instance['template'] : 'slider2';
		$slider_mode = isset( $instance['slider_mode'] ) ? $instance['slider_mode'] : 'fade';
		$slider_pause = isset( $instance['slider_pause'] ) ? $instance['slider_pause'] : 4000;
		$slider_auto = isset( $instance['slider_auto'] ) ? $instance['slider_auto'] : 0;

		$args = array(
		   'public' => true,
		);
		$post_types = get_post_types( $args );
		$slide_post_type = 'wcs_slide';
		if ( post_type_exists( $slide_post_type ) ) {
			$post_types[ $slide_post_type ] = $slide_post_type;
		}
		unset( $post_types['attachment'] );
		?>

		<div id="wc-shortcodes-post-slider-widget-<?php echo $this->number; ?>" class="wc-shortcodes-post-slider-widget">
			<h3>Select Posts</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('pids'); ?>"><?php _e('Post IDs:') ?></label>
					<input type="text" class="widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('pids'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="post" name="<?php echo $this->get_field_name('pids'); ?>" value="<?php echo $pids; ?>" />
					<span class="wcs-description">Leave blank to display all posts.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:'); ?></label>
					<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
						<?php
						$options = array(
							'DESC' => 'DESC',
							'ASC' => 'ASC',
						);
						?>
						<?php foreach ( $options as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $order, $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By:'); ?></label>
					<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
						<?php
						$options = array(
							'none' => 'No Order',
							'ID' => 'Post ID',
							'author' => 'Author',
							'title' => 'Title',
							'name' => 'Post Name',
							'type' => 'Post Type',
							'date' => 'Date',
							'modified' => 'Last Modified Date',
							'parent' => 'Post/Page Parent ID',
							'rand' => 'Random',
							'comment_count' => 'Number of Comments',
							'menu_order' => 'Menu Order',
							'post__in' => 'Preserve Post ID Order',
						);
						?>
						<?php foreach ( $options as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $orderby, $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label>
					<select id="<?php echo $this->get_field_id('post_type'); ?>" class="wc-shortcodes-widget-post-type-selector" name="<?php echo $this->get_field_name('post_type'); ?>">
						<?php foreach ( $post_types as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $post_type, $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:'); ?></label>
					<select id="<?php echo $this->get_field_id('taxonomy'); ?>" class="wc-shortcodes-widget-taxonomy-selector" name="<?php echo $this->get_field_name('taxonomy'); ?>">
						<option value=""<?php selected( $taxonomy, "" ); ?>>No Taxonomy</option>';
						<?php foreach ( $post_types as $post_type_name ) : ?>
							<?php $taxonomies = get_object_taxonomies( $post_type_name, 'names' ); ?>
							<?php if ( $taxonomies ) : ?>
								<?php foreach ( $taxonomies  as $key ) : ?>
									<option value="<?php echo $key; ?>"<?php selected( $taxonomy, $key ); ?> data-post-type="<?php echo $post_type_name; ?>"><?php echo $key; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('terms'); ?>"><?php _e('Terms:') ?></label>
					<input type="text" class="widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('terms'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="terms" name="<?php echo $this->get_field_name('terms'); ?>" value="<?php echo $terms; ?>" />
					<span class="wcs-description">Leave blank to display all terms.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Posts Per Page:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $posts_per_page; ?>" />
					<span class="wcs-description">Enter -1 for unlimited posts.</span>
				</p>
				<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('ignore_sticky_posts'); ?>" name="<?php echo $this->get_field_name('ignore_sticky_posts'); ?>" value="1" <?php checked( $ignore_sticky_posts, 1 ); ?> />
					<label for="<?php echo $this->get_field_id('ignore_sticky_posts'); ?>"><?php _e('Ignore Sticky Posts') ?></label>
				</p>
			</div>
			<h3>Content</h3>
			<div>
				<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_meta_category'); ?>" name="<?php echo $this->get_field_name('show_meta_category'); ?>" value="1" <?php checked( $show_meta_category, 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_meta_category'); ?>"><?php _e('Show Meta Category') ?></label>
				</p>
				<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked( $show_title, 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Title') ?></label>
				</p>
				<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>" value="1" <?php checked( $show_content, 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show Content') ?></label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('readmore'); ?>"><?php _e('Read More Text:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" value="<?php echo $readmore; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('button_class'); ?>"><?php _e('Button Class:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('button_class'); ?>" name="<?php echo $this->get_field_name('button_class'); ?>" value="<?php echo $button_class; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image Size:'); ?></label>
					<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
						<?php
						$sizes = apply_filters( 'image_size_names_choose', array(
							'thumbnail' => __('Thumbnail'),
							'medium'    => __('Medium'),
							'large'     => __('Large'),
							'full'      => __('Full Size'),
						));
						?>
						<?php foreach ( $sizes as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $size, $key ); ?>><?php echo $value; ?></option>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('heading_type'); ?>"><?php _e('Heading Type:'); ?></label>
					<select id="<?php echo $this->get_field_id('heading_type'); ?>" name="<?php echo $this->get_field_name('heading_type'); ?>">
						<?php
						$options = array(
							'h1' => 'H1',
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
						);
						?>
						<?php foreach ( $options as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $heading_type, $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
			</div>
			<h3>Style</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:'); ?></label>
					<select id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>">
						<?php
						$options = array(
							'slider1' => 'Slider 1',
							'slider2' => 'Slider 2',
						);
						?>
						<?php foreach ( $options as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $template, $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('heading_size'); ?>"><?php _e('Heading Size:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('heading_size'); ?>" name="<?php echo $this->get_field_name('heading_size'); ?>" value="<?php echo $heading_size; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('mobile_heading_size'); ?>"><?php _e('Mobile Heading Size:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('mobile_heading_size'); ?>" name="<?php echo $this->get_field_name('mobile_heading_size'); ?>" value="<?php echo $mobile_heading_size; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt Length:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $excerpt_length; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('desktop_height'); ?>"><?php _e('Desktop Height:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('desktop_height'); ?>" name="<?php echo $this->get_field_name('desktop_height'); ?>" value="<?php echo $desktop_height; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('laptop_height'); ?>"><?php _e('Laptop Height:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('laptop_height'); ?>" name="<?php echo $this->get_field_name('laptop_height'); ?>" value="<?php echo $laptop_height; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('mobile_height'); ?>"><?php _e('Mobile Height:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('mobile_height'); ?>" name="<?php echo $this->get_field_name('mobile_height'); ?>" value="<?php echo $mobile_height; ?>" />
				</p>
			</div>
			<h3>Slider Settings</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('slider_mode'); ?>"><?php _e('Slider Mode:'); ?></label>
					<select id="<?php echo $this->get_field_id('slider_mode'); ?>" name="<?php echo $this->get_field_name('slider_mode'); ?>">
						<?php
						$options = array(
							'fade' => 'Fade',
							'horizontal' => 'Horizontal',
							'vertical' => 'Vertical',
						);
						?>
						<?php foreach ( $options as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $slider_mode, $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('slider_pause'); ?>"><?php _e('Slider Pause:') ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('slider_pause'); ?>" name="<?php echo $this->get_field_name('slider_pause'); ?>" value="<?php echo $slider_pause; ?>" />
					<span class="wcs-description">Enter number in milliseconds.</span>
				</p>
				<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('slider_auto'); ?>" name="<?php echo $this->get_field_name('slider_auto'); ?>" value="1" <?php checked( $slider_auto, 1 ); ?> />
					<label for="<?php echo $this->get_field_id('slider_auto'); ?>"><?php _e('Enable Auto Transition') ?></label>
				</p>
			</div>
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-post-slider-widget-<?php echo $this->number; ?>').accordion({heightStyle: "content"}).wcPostSliderWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
