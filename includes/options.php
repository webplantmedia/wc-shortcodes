<?php
function wc_shortcodes_options( $options ) {
	global $wc_shortcodes_share_buttons;
	global $wc_shortcodes_social_icons;
	global $wc_shortcodes_theme_support;

	// RSVP
	$number_options = "1\n2\n3\n4\n5";
	$event_options = "All Events\nMain Ceremony\nWedding Party";
	$admin_email = get_option( 'admin_email' );

	// page
	$menu_slug = 'wc-shortcodes';

	// Option
	$options[ $menu_slug ] = array(
		'parent_slug' => 'themes.php',
		'page_title' => 'Shortcodes',
		'menu_title' => 'Shortcodes',
		'capability' => 'manage_options',
		'option_group' => 'wc-shortcodes-options-group',
		'tabs' => array(
			array(
				'id' => 'wc-shortcodes-options-social-media-options-tab',
				'title' => 'Social Media',
				'sections' => array(
					array(
						'id' => 'wc-shortcodes-options-social-media-display-section',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => 'Display',
						'options' => array(
							array(
								'option_name' => 'social_icons_display',
								'title' => 'Order / Show / Hide',
								'default' => $wc_shortcodes_social_icons,
								'description' => '',
								'type' => 'order_show_hide',
								'callback' => 'wc_shortcodes_sanitize_social_icons',
							),
							array(
								'option_name' => 'social_icons_format',
								'title' => 'Format',
								'default' => $wc_shortcodes_theme_support['social_icons_format'],
								'description' => '',
								'type' => 'dropdown',
								'options' => array(
									'icon' => 'Icon',
									'image' => 'Image',
								),
							),
						),
					),
					array(
						'id' => 'wc-shortcodes-options-social-media-configure-section',
						'add_section' => true,
						'title' => 'Customize',
						'options' => wc_shortcodes_get_social_icons_options(),
					),
				),
			),
			array(
				'id' => 'wc-shortcodes-options-share-buttons-options-tab',
				'title' => 'Share Buttons',
				'sections' => array(
					array(
						'id' => 'wc-shortcodes-options-share-buttons-display-section',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => 'Display',
						'options' => array(
							array(
								'option_name' => 'share_buttons_display',
								'title' => 'Order / Show / Hide',
								'default' => $wc_shortcodes_share_buttons,
								'description' => '',
								'type' => 'order_show_hide',
								'callback' => 'wc_shortcodes_sanitize_share_buttons',
							),
							array(
								'option_name' => 'share_buttons_format',
								'title' => 'Format',
								'default' => $wc_shortcodes_theme_support['share_buttons_format'],
								'description' => '',
								'type' => 'dropdown',
								'options' => array(
									'icon' => 'Icon',
									'image' => 'Image',
									'icon-text' => 'Icon + Text',
									'text' => 'Text',
								),
							),
						),
					),
					array(
						'id' => 'wc-shortcodes-options-share-buttons-configure-section',
						'add_section' => true,
						'title' => 'Customize',
						'options' => wc_shortcodes_get_share_buttons_options(),
					),
				),
			),
			array(
				'id' => 'wc-shortcodes-options-rsvp-options-tab',
				'title' => 'RSVP',
				'sections' => array(
					array(
						'id' => 'wc-shortcodes-options-rsvp-section',
						'add_section' => true,
						'title' => 'RSVP',
						'options' => array(
							array(
								'option_name' => 'rsvp_email',
								'title' => 'Email To',
								'default' => $admin_email,
								'description' => 'Send RSVP notification to the email address above. Separate multiple emails with a comma.',
								'type' => 'emails',
							),
							array(
								'option_name' => 'rsvp_email_title',
								'title' => 'Email Title',
								'default' => 'New RSVP - ' .get_bloginfo('title'),
								'description' => 'The subject tile of your email you will receive',
								'type' => 'input',
							),
							array(
								'option_name' => 'rsvp_success_message',
								'title' => 'Success Message',
								'default' => 'Thanks for attending! We will see you at our wedding.',
								'description' => 'The message to display after a user successfully RSVP\'d',
								'type' => 'input',
							),
						),
					),
					array(
						'id' => 'wc-shortcodes-options-rsvp-name-section',
						'title' => 'Name',
						'add_section' => true,
						'options' => array(
							array(
								'option_name' => 'rsvp_name_title',
								'title' => 'Title',
								'default' => 'Your Name',
								'description' => '',
								'type' => 'input',
							),
						),
					),
					array(
						'id' => 'wc-shortcodes-options-rsvp-number-section',
						'title' => 'Number',
						'add_section' => true,
						'options' => array(
							array(
								'option_name' => 'rsvp_number_title',
								'title' => 'Title',
								'default' => 'Number of Guests',
								'description' => '',
								'type' => 'input',
							),
							array(
								'option_name' => 'rsvp_number_options',
								'title' => 'Options',
								'default' => $number_options,
								'description' => '',
								'type' => 'textarea',
							),
						),
					),
					array(
						'id' => 'wc-shortcodes-options-rsvp-event-section',
						'title' => 'Event',
						'add_section' => true,
						'options' => array(
							array(
								'option_name' => 'rsvp_event_title',
								'title' => 'Title',
								'default' => 'You Will Attend...',
								'description' => '',
								'type' => 'input',
							),
							array(
								'option_name' => 'rsvp_event_options',
								'title' => 'Options',
								'default' => $event_options,
								'description' => '',
								'type' => 'textarea',
							),
						),
					),
					array(
						'id' => 'wc-shortcodes-options-rsvp-button-section',
						'title' => 'Button',
						'add_section' => true,
						'options' => array(
							array(
								'option_name' => 'rsvp_button_title',
								'title' => 'Title',
								'default' => 'I Am Attending',
								'description' => '',
								'type' => 'input',
							),
						),
					),
				),
			),
			array(
				'id' => 'wc-misc-options-tab',
				'title' => 'Misc',
				'sections' => array(
					array(
						'id' => 'wc-misc-options-section',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => 'Miscellaneous Options',
						'options' => array(
							array(
								'option_name' => 'enable_shortcode_css',
								'title' => 'Shortcode CSS',
								'default' => '1',
								'description' => '',
								'label' => 'Use shortcode CSS provided by plugin',
								'type' => 'checkbox',
							),
							array(
								'option_name' => 'enable_font_awesome',
								'title' => 'Enable FontAwesome',
								'default' => '1',
								'description' => '',
								'label' => 'Use font icons provided by FontAwesome',
								'type' => 'checkbox',
							),
						),
					),
				),
			),
		),
	);

	return $options;
}
add_filter( 'wc_shortcodes_wpcsf_options', 'wc_shortcodes_options', 10, 1 );

function wc_shortcodes_get_share_buttons_options() {
	global $wc_shortcodes_theme_support;
	global $wc_shortcodes_share_buttons;

	$options = array();
	foreach ( $wc_shortcodes_share_buttons as $key => $value ) {
		$options[] = array(
			'id' => $key . '-share',
			'title' => $value,
			'description' => '',
			'group' => array(
				array(
					'option_name' => $key . '_share_text',
					'label' => 'Share Text',
					'default' => $wc_shortcodes_theme_support[ $key . '_share_text'],
					'description' => '',
					'type' => 'input',
				),
				array(
					'option_name' => $key . '_share_font_icon',
					'label' => 'Font Icon',
					'default' => $wc_shortcodes_theme_support[ $key . '_share_font_icon'],
					'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
					'type' => 'input',
				),
				array(
					'option_name' => $key . '_share_icon',
					'label' => 'Image Icon',
					'default' => $wc_shortcodes_theme_support[ $key . '_share_button'],
					'description' => '',
					'type' => 'image',
				),
			),
		);
	}

	return $options;
}
function wc_shortcodes_get_social_icons_options() {
	global $wc_shortcodes_theme_support;
	global $wc_shortcodes_social_icons;

	$options = array();
	foreach ( $wc_shortcodes_social_icons as $key => $value ) {
		$options[] = array(
			'id' => $key,
			'title' => $value,
			'description' => '',
			'group' => array(
				array(
					'option_name' => $key . '_link',
					'label' => 'Link',
					'default' => '',
					'description' => '',
					'type' => 'input',
				),
				array(
					'option_name' => $key . '_font_icon',
					'label' => 'Font Icon',
					'default' => $wc_shortcodes_theme_support[ $key . '_font_icon'],
					'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
					'type' => 'input',
				),
				array(
					'option_name' => $key . '_icon',
					'label' => 'Image Icon',
					'default' => $wc_shortcodes_theme_support[ $key . '_social_icon'],
					'description' => '',
					'type' => 'image',
				),
			),
		);
	}

	return $options;
}

function wc_shortcodes_sanitize_share_buttons( $value ) {
	global $wc_shortcodes_share_buttons;

	$whitelist = $wc_shortcodes_share_buttons;

	$valid = array();

	if ( ! is_array( $value ) || empty( $value ) )
		return null;

	foreach ( $value as $k => $v ) {
		if ( array_key_exists( $k, $whitelist ) )
			$valid[ $k ] = $v;
	}

	return $valid;
}

function wc_shortcodes_sanitize_social_icons( $value ) {
	global $wc_shortcodes_social_icons;

	$whitelist = $wc_shortcodes_social_icons;

	$valid = array();

	if ( ! is_array( $value ) || empty( $value ) )
		return null;

	foreach ( $value as $k => $v ) {
		if ( array_key_exists( $k, $whitelist ) )
			$valid[ $k ] = $v;
	}

	return $valid;
}
