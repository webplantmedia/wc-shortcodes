<?php
/**
 * WC_Shortcodes_Posts_Widget
 *
 * @uses WP
 * @uses _Widget
 */
class WC_Shortcodes_Widget_Spacing extends WP_Widget {
	function __construct() {

		$widget_ops = array( 'description' => __('Add a fixed amount of spacing.') );
		parent::__construct( 'wc_shortcodes_spacing', __('Spacing'), $widget_ops );
	}

	function widget($args, $instance) {
		$shortcode = array();
		foreach ( $instance as $key => $value ) {
			$shortcode[] = $key . '="' . $value . '"';
		}

		if ( ! empty( $shortcode ) ) {
			$shortcode = implode( " ", $shortcode );
			$shortcode = '[wc_spacing ' . $shortcode . '][/wc_spacing]';
		}
		else {
			$shortcode = '[wc_spacing][/wc_spacing]';
		}

		echo $args['before_widget'];
		echo do_shortcode( $shortcode );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = WPC_Shortcodes_Sanitize::spacing_attr( $new_instance );

		return $instance;
	}

	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->spacing, $instance );
		$o = WPC_Shortcodes_Sanitize::spacing_attr( $o );
		?>

		<div id="wc-shortcodes-spacing-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('pids'); ?>"><?php _e('Size:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('size'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="post" name="<?php echo $this->get_field_name('size'); ?>" value="<?php echo $o['size']; ?>" />
				<span class="wcs-description">Set the size or height of the spacing.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class Name:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
			</p>
		</div>
		<?php
	}
}
