<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_FA extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->fa, $instance );
		$o = WPC_Shortcodes_Sanitize::fa_attr( $o );
		?>

		<div id="wc-shortcodes-fa-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" value="<?php echo $o['icon']; ?>" />
				<span class="wcs-description">Enter name of <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome icon</a>.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('margin_left'); ?>"><?php _e('Left Margin Spacing:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('margin_left'); ?>" name="<?php echo $this->get_field_name('margin_left'); ?>" value="<?php echo $o['margin_left']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('margin_right'); ?>"><?php _e('Right Margin Spacing:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('margin_right'); ?>" name="<?php echo $this->get_field_name('margin_right'); ?>" value="<?php echo $o['margin_right']; ?>" />
				<span class="wcs-description">Enter CSS unit value.</span>
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
				$('#wc-shortcodes-fa-widget-<?php echo $this->number; ?>').wcFontAwesomeWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
