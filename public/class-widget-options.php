<?php
/**
 * Widget_Options
 */
class WPC_Shortcodes_Widget_Options {
	public static function heading_tags() {
		return array(
			'h1' => 'h1',
			'h2' => 'h2',
			'h3' => 'h3',
			'h4' => 'h4',
			'h5' => 'h5',
			'h6' => 'h6',
			'p' => 'p',
			'span' => 'span',
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

	public static function call_to_action_style_format_values() {
		return array(
			'image_left' => 'Image | Text',
			'image_right' => 'Text | Image',
		);
	}

	public static function image_links_style_format_values() {
		return array(
			'row' => 'Row',
			'column' => 'Column',
		);
	}

	public static function featured_post_layouts() {
		return array(
			'thumbnail' => 'Thumbnail',
			'showcase' => 'Showcase',
		);
	}

	public static function posts_layouts() {
		return array(
			'masonry' => 'Masonry',
			'grid' => 'Grid',
			'single-column' => 'Single Column',
		);
	}

	public static function posts_templates() {
		return array(
			'box' => 'Box',
			'borderless' => 'Borderless',
		);
	}

	public static function collage_templates() {
		return array(
			'collage1' => 'Style 1',
		);
	}

	public static function post_slider_layouts() {
		return array(
			'bxslider' => 'Box Slider',
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

	public static function column_sizes() {
		return array(
			'one-half' => 'One Half',
			'one-third' => 'One Third',
			'two-third' => 'One Third',
			'one-fourth' => 'One Fourth',
			'three-fourth' => 'One Fourth',
		);
	}

	public static function column_positions() {
		return array(
			'first' => 'First',
			'' => 'None',
			'last' => 'Last',
		);
	}

	public static function highlight_colors() {
		return array(
			'blue' => 'Blue',
			'gray' => 'Gray',
			'green' => 'Green',
			'red' => 'Red',
			'yellow' => 'Yellow',
		);
	}

	public static function divider_style_values() {
		return array(
			'solid' => 'Solid',
			'dashed' => 'Dashed',
			'dotted' => 'Dotted',
			'image' => 'Image 1',
			'image2' => 'Image 2',
			'image3' => 'Image 3',
		);
	}

	public static function fullwidth_style_values() {
		return array(
			'' => 'Box',
			'frame' => 'Frame',
		);
	}

	public static function divider_line_values() {
		return array(
			'' => 'None',
			'single' => 'Single',
			'double' => 'Double',
		);
	}

	public static function pricing_color_types() {
		return array(
			'primary' => 'Primary',
			'secondary' => 'Secondary',
			'inverse' => 'Inverse',
		);
	}

	public static function color_types() {
		return array(
			'primary' => 'Primary',
			'secondary' => 'Secondary',
			'inverse' => 'Inverse',
			'success' => 'Success',
			'warning' => 'Warning',
			'danger' => 'Danger',
			'info' => 'Info',
		);
	}

	public static function image_link_to_values() {
		return array(
			'' => 'None',
			'post' => 'Parent Post',
			'file' => 'Image File',
		);
	}

	public static function url_rel_values() {
		return array(
			'' => 'None',
			'nofollow' => 'No Follow',
		);
	}

	public static function url_target_values() {
		return array(
			'' => 'Same Window',
			'blank' => 'New Tab',
		);
	}

	public static function google_map_zoom_values() {
		return array(
			'1' => '1 (World)',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5 (Landmass/continent)',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10 (City)',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15 (Streets)',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20 (Buildings)',
		);
	}

	public static function one_three_values() {
		return array(
			'1' => '1',
			'3' => '3',
		);
	}

	public static function left_right_none_values() {
		return array(
			'' => 'None',
			'left' => 'Left',
			'right' => 'Right',
		);
	}

	public static function image_link_text_position_values() {
		return array(
			'top' => 'Top',
			'center' => 'Center',
			'bottom' => 'Bottom',
			'under' => 'Under',
		);
	}

	public static function text_align_values() {
		return array(
			'' => 'None',
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right',
		);
	}

	public static function social_icons_formats() {
		return array(
			'default' => 'Default',
			'icon' => 'Icon',
			'small_image' => 'Small Image',
			'medium_image' => 'Medium Image',
			'image' => 'Large Image',
		);
	}

	public static function social_icons_sizes() {
		return array(
			'' => 'None',
			'small' => 'Small',
			'medium' => 'Medium',
			'large' => 'Large',
		);
	}

	public static function social_icons_align_values() {
		return array(
			'' => 'None',
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right',
		);
	}

	public static function social_icons_display_types() {
		return array(
			'float-center' => 'Float Center',
			'float-left' => 'Float Left',
			'float-right' => 'Float Right',
			'1' => '1 Column',
			'2' => '2 Columns',
			'3' => '3 Columns',
			'4' => '4 Columns',
			'5' => '5 Columns',
			'6' => '6 Columns',
			'7' => '7 Columns',
			'8' => '8 Columns',
		);
	}

	public static function social_icons_max_height_values() {
		return array(
			'' => 'Default',
			'10' => '10',
			'12' => '12',
			'14' => '14',
			'16' => '16',
			'18' => '18',
			'20' => '20',
			'22' => '22',
			'24' => '24',
			'26' => '26',
			'28' => '28',
			'30' => '30',
			'32' => '32',
			'34' => '34',
			'36' => '36',
			'38' => '38',
			'40' => '40',
			'42' => '42',
			'44' => '44',
			'46' => '46',
			'48' => '48',
			'50' => '50',
			'52' => '52',
			'54' => '54',
			'56' => '56',
			'58' => '58',
			'60' => '60',
			'62' => '62',
			'64' => '64',
			'66' => '66',
			'68' => '68',
			'70' => '70',
		);
	}
}
