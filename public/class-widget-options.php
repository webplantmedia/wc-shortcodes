<?php
/**
 * Widget_Options
 */
class WPC_Shortcodes_Widget_Options {
	public static function heading_tags() {
		return array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
		);
	}

	public static function order_fields() {
		return array(
			'DESC' => 'DESC',
			'ASC' => 'ASC',
		);
	}

	public static function order_by_fields() {
		return array(
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
	}

	public static function posts_layouts() {
		return array(
			'masonry' => 'Masonry',
			'grid' => 'Grid',
		);
	}

	public static function posts_templates() {
		return array(
			'box' => 'Box',
			'borderless' => 'Borderless',
		);
	}

	public static function post_slider_templates() {
		return array(
			'slider1' => 'Slider 1',
			'slider2' => 'Slider 2',
		);
	}

	public static function post_slider_modes() {
		return array(
			'fade' => 'Fade',
			'horizontal' => 'Horizontal',
			'vertical' => 'Vertical',
		);
	}

	public static function posts_columns() {
		return array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
	}
	
	public static function image_sizes() {
		$sizes = apply_filters( 'image_size_names_choose', array(
			'thumbnail' => __('Thumbnail'),
			'medium'    => __('Medium'),
			'large'     => __('Large'),
			'full'      => __('Full Size'),
		));

		return $sizes;
	}

	public static function post_types( $add_post_type = null ) {
		$args = array(
		   'public' => true,
		);
		$post_types = get_post_types( $args );

		if ( ! empty( $add_post_type ) ) {
			if ( post_type_exists( $add_post_type ) ) {
				$post_types[ $add_post_type ] = $add_post_type;
			}
		}

		unset( $post_types['attachment'] );

		return $post_types;
	}

	public static function accordion_main_layouts() {
		return array(
			'box' => 'Box',
			'none' => 'None',
		);
	}
}
