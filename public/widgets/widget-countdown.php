<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Countdown extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$o = array_merge( WPC_Shortcodes_Vars::$attr->countdown, $instance );
		$o = WPC_Shortcodes_Sanitize::countdown_attr( $o );
		?>

		<div id="wc-shortcodes-countdown-widget-<?php echo $this->number; ?>" class="wc-shortcodes-visual-manager">
			<p>
				<label for="<?php echo $this->get_field_id('date'); ?>"><?php _e('Date Format:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" value="<?php echo $o['date']; ?>" />
				<span class="wcs-description">Insert a valid date string. Example: <code>Jan 1, <?php echo date('Y', strtotime('+1 year')); ?>, 12:00:00 AM</code></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('format'); ?>"><?php _e('Format:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>" value="<?php echo $o['format']; ?>" />
				<span class="wcs-description">Format for display - upper case for always, lower case only if non-zero, 'Y' years, 'O' months, 'W' weeks, 'D' days, 'H' hours, 'M' minutes, 'S' seconds.</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('labels'); ?>"><?php _e('Plural Labels:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('labels'); ?>" name="<?php echo $this->get_field_name('labels'); ?>" value="<?php echo $o['labels']; ?>" />
				<span class="wcs-description">Plural names for date display. Example: <code>Years,Months,Weeks,Days,Hours,Minutes,Seconds</code></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('labels1'); ?>"><?php _e('Singular Labels:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('labels1'); ?>" name="<?php echo $this->get_field_name('labels1'); ?>" value="<?php echo $o['labels1']; ?>" />
				<span class="wcs-description">Singular names for date display. Example: <code>Year,Month,Week,Day,Hour,Minute,Second</code></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Message:') ?></label>
				<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" value="<?php echo $o['message']; ?>" />
				<span class="wcs-description">Text to display after countdown completes. Example: <code>Happy New Year!</code></span>
			</p>
		</div>
		<?php
	}
}
