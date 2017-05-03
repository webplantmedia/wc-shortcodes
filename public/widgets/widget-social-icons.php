<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Social_Icons extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => __('Add your social icons to your sidebar.') );
		parent::__construct( 'wc_shortcodes_social_icons', __('Angie Makes - Social Media Icons'), $widget_ops );
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
			$shortcode = '[wc_social_icons ' . $shortcode . '][/wc_social_icons]';
		}
		else {
			$shortcode = '[wc_social_icons][/wc_social_icons]';
		}

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		echo do_shortcode( $shortcode );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = WPC_Shortcodes_Sanitize::social_icons_attr( $new_instance );

		return $instance;
	}

	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->social_icons, $instance );
		$o = WPC_Shortcodes_Sanitize::social_icons_attr( $o );
		?>

		<div id="wc-shortcodes-social-icons-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p class="wcs-instruction">You can configure your social icons in your <a href="<?php echo WPC_Shortcodes_Vars::$plugin_settings_url . '&wpcsf_active_tab=wc-shortcodes-options-social-media-options-tab'; ?>" target="_blank">Shortcode Settings Page</a>.</p>
			<?php if ( ! isset( $o['wc_shortcodes_using_visual_manager'] ) ) : ?>
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
				</p>
			<?php endif; ?>
			<p>
				<label for="<?php echo $this->get_field_id('format'); ?>"><?php _e('Format:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::social_icons_formats() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['format'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Display:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::social_icons_display_types() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['columns'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('maxheight'); ?>"><?php _e('Max Height:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('maxheight'); ?>" name="<?php echo $this->get_field_name('maxheight'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::social_icons_max_height_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['maxheight'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
		</div>
		<?php
	}
}
