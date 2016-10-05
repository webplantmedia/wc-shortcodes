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

		echo '[wc_post_slider p="' . $instance['p'] . '" post__in="' . $instance['post__in'] . '" order="' . $instance['order'] . '" orderby="' . $instance['orderby'] . '" post_type="' . $instance['post_type'] . '" posts_per_page="' . $instance['posts_per_page'] . '" taxonomy="' . $instance['taxonomy'] . '" field="' . $instance['field'] . '" terms="' . $instance['terms'] . '" meta_category="' . $instance['meta_category'] . '" title="' . $instance['title'] . '" content="' . $instance['content'] . '" readmore="' . $instance['readmore'] . '" button_class="' . $instance['button_class'] . '" size="' . $instance['size'] . '" heading_type="' . $instance['heading_type'] . '" heading_size="' . $instance['heading_size'] . '" mobile_heading_size="' . $instance['mobile_heading_size'] . '" excerpt_length="' . $instance['excerpt_length'] . '" desktop_height="' . $instance['desktop_height'] . '" laptop_height="' . $instance['laptop_height'] . '" mobile_height="' . $instance['mobile_height'] . '" template="' . $instance['template'] . '"][/wc_post_slider]';
		echo $args['before_widget'];
		echo do_shortcode( '[wc_post_slider p="' . $instance['p'] . '" post__in="' . $instance['post__in'] . '" order="' . $instance['order'] . '" orderby="' . $instance['orderby'] . '" post_type="' . $instance['post_type'] . '" posts_per_page="' . $instance['posts_per_page'] . '" taxonomy="' . $instance['taxonomy'] . '" field="' . $instance['field'] . '" terms="' . $instance['terms'] . '" meta_category="' . $instance['meta_category'] . '" title="' . $instance['title'] . '" content="' . $instance['content'] . '" readmore="' . $instance['readmore'] . '" button_class="' . $instance['button_class'] . '" size="' . $instance['size'] . '" heading_type="' . $instance['heading_type'] . '" heading_size="' . $instance['heading_size'] . '" mobile_heading_size="' . $instance['mobile_heading_size'] . '" excerpt_length="' . $instance['excerpt_length'] . '" desktop_height="' . $instance['desktop_height'] . '" laptop_height="' . $instance['laptop_height'] . '" mobile_height="' . $instance['mobile_height'] . '" template="' . $instance['template'] . '"][/wc_post_slider]' );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$pids = explode( ',', $new_instance['pids'] );
		$p = array();
		if ( ! empty( $pids ) ) {
			foreach ( $pids as $id ) {
				$id = (int) $id;
				if ( ! empty( $id ) ) {
					$p[] = $id;
				}
			}
		}

		$instance['pids'] = implode( ',', $p );
		$instance['pids'] = ! empty( $instance['pids'] ) ? $instance['pids'] . ',' : '';

		$size = sizeof( $p );
		if ( 1 < $size ) {
			$instance['p'] = '';
			$instance['post__in'] = implode( ',', $p );
		}
		else if ( 1 == $size ) {
			$instance['p'] = $p[0];
			$instance['post__in'] = '';
		}
		else {
			$instance['p'] = '';
			$instance['post__in'] = '';
		}

		$instance['order'] = $new_instance['order'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
		$instance['taxonomy'] = $new_instance['taxonomy'];
		$instance['field'] = $new_instance['field'];
		$instance['terms'] = $new_instance['terms'];
		$instance['meta_category'] = $new_instance['meta_category'];
		$instance['title'] = $new_instance['title'];
		$instance['content'] = $new_instance['content'];
		$instance['readmore'] = $new_instance['readmore'];
		$instance['button_class'] = strip_tags( stripslashes( $new_instance['button_class'] ) );
		$instance['size'] = $new_instance['size'];
		$instance['heading_type'] = $new_instance['heading_type'];
		$instance['heading_size'] = $new_instance['heading_size'];
		$instance['mobile_heading_size'] = $new_instance['mobile_heading_size'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['desktop_height'] = $new_instance['desktop_height'];
		$instance['laptop_height'] = $new_instance['laptop_height'];
		$instance['mobile_height'] = $new_instance['mobile_height'];
		$instance['template'] = $new_instance['template'];

		return $instance;
	}

	function form( $instance ) {
		wp_enqueue_script( 'wc-shortcodes-wpdb-autocomplete' );

		$pids = isset( $instance['pids'] ) ? $instance['pids'] : '';
		$order = isset( $instance['order'] ) ? $instance['order'] : '';
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'name';
		$post_type = isset( $instance['post_type'] ) ? $instance['post_type'] : 'post';
		$posts_per_page = isset( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : '10';
		$taxonomy = isset( $instance['taxonomy'] ) ? $instance['taxonomy'] : '';
		$field = isset( $instance['field'] ) ? $instance['field'] : 'slug';
		$terms = isset( $instance['terms'] ) ? $instance['terms'] : '';
		$meta_category = isset( $instance['meta_category'] ) ? $instance['meta_category'] : 'no';
		$title = isset( $instance['title'] ) ? $instance['title'] : 'yes';
		$content = isset( $instance['content'] ) ? $instance['content'] : 'yes';
		$readmore = isset( $instance['readmore'] ) ? $instance['readmore'] : 'Coninue Reading';
		$button_class = isset( $instance['button_class'] ) ? $instance['button_class'] : 'button secondary-button';
		$size = isset( $instance['size'] ) ? $instance['size'] : 'h2';
		$heading_type = isset( $instance['heading_type'] ) ? $instance['heading_type'] : '30';
		$heading_size = isset( $instance['heading_size'] ) ? $instance['heading_size'] : '24';
		$mobile_heading_size = isset( $instance['mobile_heading_size'] ) ? $instance['mobile_heading_size'] : '24';
		$excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : '30';
		$desktop_height = isset( $instance['desktop_height'] ) ? $instance['desktop_height'] : '600';
		$laptop_height = isset( $instance['laptop_height'] ) ? $instance['laptop_height'] : '500';
		$mobile_height = isset( $instance['mobile_height'] ) ? $instance['mobile_height'] : '350';
		$template = isset( $instance['template'] ) ? $instance['template'] : 'slider2';

		$args = array(
		   'public'   => true,
		);
		$post_types = get_post_types( $args );
		unset( $post_types['attachment'] );
		?>

		<div id="wc-shortcodes-post-slider-widget-<?php echo $this->number; ?>">
			<p>
				<label for="<?php echo $this->get_field_id('pids'); ?>"><?php _e('Post IDs:') ?></label>
				<input type="text" class="widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('pids'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="post" name="<?php echo $this->get_field_name('pids'); ?>" value="<?php echo $pids; ?>" />
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
								<option value="<?php echo $key; ?>"<?php selected( $taxonomy, $key ); ?> data-post-type="<?php echo $post_type_name; ?>"><?php echo $post_type_name; ?> => <?php echo $key; ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Posts Per Page:') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $posts_per_page; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('button_class'); ?>"><?php _e('Button Class:') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('button_class'); ?>" name="<?php echo $this->get_field_name('button_class'); ?>" value="<?php echo $button_class; ?>" />
			</p>
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
		</div>

		<?php if ( is_integer( $this->number ) ) : ?>
			<script type="text/javascript">
				/* <![CDATA[ */
				jQuery(document).ready(function($){
					$('#wc-shortcodes-post-slider-widget-<?php echo $this->number; ?>').wcPostSliderWidget();
				});
				/* ]]> */
			</script>
		<?php endif; ?>
		<?php
	}
}

function wc_shortcodes_cat_lookup_callback() {
	global $wpdb; //get access to the WordPress database object variable

	//get names of all businesses
	$request = $wpdb->esc_like(stripslashes($_POST['request'])).'%'; //escape for use in LIKE statement
	$sql = "select ID, post_title from $wpdb->posts where post_title like %s and post_type='post' and post_status='publish'";

	$sql = $wpdb->prepare($sql, $request);
	
	$results = $wpdb->get_results($sql);

	//copy the business titles to a simple array
	$titles = array();
	$i = 0;
	foreach( $results as $r ) {
		$titles[ $i ][ 'label' ] = $r->post_title . " (" . $r->ID . ")";
		$titles[ $i ][ 'value' ] = $r->ID;
		$i++;
	}
		
	echo json_encode($titles); //encode into JSON format and output

	die(); //stop "0" from being output
}
add_action( 'wp_ajax_wc_cat_lookup', 'wc_shortcodes_cat_lookup_callback' );

function wc_shortcodes_post_lookup_callback() {
	global $wpdb; //get access to the WordPress database object variable

	//get names of all businesses
	$request = $wpdb->esc_like( stripslashes( $_POST['request'] ) ) . '%'; //escape for use in LIKE statement
	$post_type = stripslashes( $_POST['post_type'] );
	$sql = "select ID, post_title from $wpdb->posts where post_title like %s and post_type='%s' and post_status='publish' order by post_title ASC limit 0,30 ";

	$sql = $wpdb->prepare($sql, $request, $post_type);

	$results = $wpdb->get_results($sql);

	//copy the business titles to a simple array
	$titles = array();
	$i = 0;
	foreach( $results as $r ) {
		$titles[ $i ][ 'label' ] = $r->post_title . " (" . $r->ID . ")";
		$titles[ $i ][ 'value' ] = $r->ID;
		$i++;
	}
		
	echo json_encode($titles); //encode into JSON format and output

	die(); //stop "0" from being output
}
add_action( 'wp_ajax_wc_post_lookup', 'wc_shortcodes_post_lookup_callback' );
