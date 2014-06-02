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
		parent::__construct( 'wc_shortcodes_social_icons', __('WP Canvas - Social Media Image Icons'), $widget_ops );
	}

	function widget($args, $instance) {

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		// set class with the number of columns the user selected
		$columns = (int) $instance['columns'];
		if ( empty($columns) ) {
			$columns = 3;
		}

		$order = $instance['order'];
		$first = true;

		$class = ' wc-shortcodes-columns-'.$columns;

		$html = '<ul class="wc-shortcodes-social-icons wc-shortcodes-clearfix'.$class.'">';
			$i = 0;
			foreach ($order as $key => $name) {
				$li_class = array();
				$li_class[] = 'wc-shortcodes-social-icon';
				$li_class[] = 'wc-shortcode-social-icon-' . $key;

				if ( $i % $columns == 0 ) 
					$li_class[] = 'clear-left';

				$link_option_name = WC_SHORTCODES_PREFIX . $key . '_link';
				$icon_option_name = WC_SHORTCODES_PREFIX . $key . '_icon';

				if (  $icon_url = get_option( $icon_option_name ) ) {
					$social_link = get_option( $link_option_name );
					$social_link = apply_filters( 'wc_shortcodes_social_link', $social_link, $key );

					if ( empty( $social_link ) )
						continue;

					if ( $first )
						$li_class[] = 'first-icon';

					$first = false;

					$html .= '<li class="'.implode( ' ', $li_class ).'">';
						$html .='<a href="'.$social_link.'">';
							$html .= '<img src="'.$icon_url.'">';
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
		$instance['columns'] = (int) $new_instance['columns'];
		$instance['order'] = $new_instance['order'];
		return $instance;
	}

	function form( $instance ) {
		$default_order = array(
			'facebook' => 'Facebook',
			'google' => 'Google',
			'twitter' => 'Twitter',
			'pinterest' => 'Pinterest',
			'instagram' => 'Instagram',
			'bloglovin' => 'BlogLovin',
			'flickr' => 'Flickr',
			'rss' => 'RSS',
			'email' => 'Email',
			'custom1' => 'Custom 1',
			'custom2' => 'Custom 2',
			'custom3' => 'Custom 3',
			'custom4' => 'Custom 4',
			'custom5' => 'Custom 5',
		);
		$order = isset( $instance['order'] ) ? $instance['order'] : $default_order;
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Follow Me!';
		$columns = isset( $instance['columns'] ) ? (int) $instance['columns'] : 6;
		?>
		<label><?php _e('Order:'); ?></label>
		<ul class="wc-shortcodes-clearfix wc-shortcodes-social-icons">
			<?php foreach ( $order as $key => $name ) : ?>
				<li>
					<p style="background-color:#f7f7f7;border:1px solid #dfdfdf;padding:2px;margin:0;text-align:center;cursor:move;"><?php echo $name; ?></p>
					<input type="hidden" name="<?php echo $this->get_field_name('order'); ?>[<?php echo $key; ?>]" value="<?php echo $name; ?>" />
				</li>
			<?php endforeach; ?>
		</ul>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Number of Columns:'); ?></label>
			<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
				<option value="1"<?php selected( $columns, '1' ); ?>>1</option>';
				<option value="2"<?php selected( $columns, '2' ); ?>>2</option>';
				<option value="3"<?php selected( $columns, '3' ); ?>>3</option>';
				<option value="4"<?php selected( $columns, '4' ); ?>>4</option>';
				<option value="5"<?php selected( $columns, '5' ); ?>>5</option>';
				<option value="6"<?php selected( $columns, '6' ); ?>>6</option>';
				<option value="7"<?php selected( $columns, '7' ); ?>>7</option>';
				<option value="8"<?php selected( $columns, '8' ); ?>>8</option>';
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
