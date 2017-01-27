<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_HTML extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->html, $instance );
		$o = WPC_Shortcodes_Sanitize::html_attr( $o );
		?>

		<div id="wc-shortcodes-html-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo $o['name']; ?>" />
				<span class="wcs-description">Enter the name of the custom field you will use for your custom HTML. See our <a href="http://knowledgebase.angiemakes.com/how-to-insert-custom-html-and-javascript-to-the-wp-editor/?cat=24" target="_blank">help article</a> for detailed instructions.</span>
			</p>
		</div>
		<?php
	}
}
