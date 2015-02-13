<?php
/******************************************************************
Author: Chris Baldelomar
URL: http://webplantmedia.com

All widget code should go here.
******************************************************************/

function wc_shortcodes_register_widgets() {
	// Register social icons widget version 2
	register_widget('WC_Shortcodes_Social_Icons_Widget');
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
		$format = get_option( WC_SHORTCODES_PREFIX . 'social_icons_format', 'image' );
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
		$instance['columns'] = $new_instance['columns'];
		$instance['maxheight'] = $new_instance['maxheight'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Follow Me!';
		$columns = isset( $instance['columns'] ) ? $instance['columns'] : 'float-left';
		$maxheight = isset( $instance['maxheight'] ) ? $instance['maxheight'] : 'none';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
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
