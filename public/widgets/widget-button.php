<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Button extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->button, $instance );
		$o = WPC_Shortcodes_Sanitize::button_attr( $o );
		?>

		<div id="wc-shortcodes-button-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Button Type:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::color_types() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['type'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $o['url']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $o['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('URL Target:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::url_target_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['target'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('url_rel'); ?>"><?php _e('URL Rel:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('url_rel'); ?>" name="<?php echo $this->get_field_name('url_rel'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::url_rel_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['url_rel'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_left'); ?>"><?php _e('Icon Left:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('icon_left'); ?>" name="<?php echo $this->get_field_name('icon_left'); ?>" value="<?php echo $o['icon_left']; ?>" />
				<span class="wcs-description">Enter name of <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome icon</a>.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_right'); ?>"><?php _e('Icon Right:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('icon_right'); ?>" name="<?php echo $this->get_field_name('icon_right'); ?>" value="<?php echo $o['icon_right']; ?>" />
				<span class="wcs-description">Enter name of <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome icon</a>.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position:'); ?></label>
				<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
					<?php foreach ( WPC_Shortcodes_Widget_Options::text_align_values() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>"<?php selected( $o['position'], $key ); ?>><?php echo $value; ?></option>';
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" value="<?php echo $o['class']; ?>" />
				<span class="wcs-description">Enter class name for custom CSS styling.</span>
			</p>
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-button-widget-<?php echo $this->number; ?>').wcFontAwesomeWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
