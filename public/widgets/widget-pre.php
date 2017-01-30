<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Pre extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->pre, $instance );
		$o = WPC_Shortcodes_Sanitize::pre_attr( $o );
		?>

		<div id="wc-shortcodes-pre-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo $o['name']; ?>" />
				<span class="wcs-description">Enter the name of the custom field you will use for your custom HTML. See our <a href="http://knowledgebase.angiemakes.com/how-to-insert-custom-html-and-javascript-to-the-wp-editor/?cat=24" target="_blank">help article</a> for detailed instructions.</span>
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('scrollable'); ?>" name="<?php echo $this->get_field_name('scrollable'); ?>" value="1" <?php checked( $o['scrollable'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('scrollable'); ?>"><?php _e('Enable Scroll?') ?></label>
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="1" <?php checked( $o['color'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Display Code Color?') ?></label>
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('linenums'); ?>" name="<?php echo $this->get_field_name('linenums'); ?>" value="1" <?php checked( $o['linenums'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('linenums'); ?>"><?php _e('Display Line Numbers?') ?></label>
			</p>
			<p>
				<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('wrap'); ?>" name="<?php echo $this->get_field_name('wrap'); ?>" value="1" <?php checked( $o['wrap'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id('wrap'); ?>"><?php _e('Wrap Text?') ?></label>
			</p>
		</div>
		<?php
	}
}
