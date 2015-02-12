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
		'page_title' => '',
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
						'options' => array(
							array(
								'id' => 'facebook',
								'title' => 'Facebook',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'facebook_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'facebook_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['facebook_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'facebook_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['facebook_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'twitter',
								'title' => 'Twitter',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'twitter_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'twitter_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['twitter_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'twitter_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['twitter_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'pinterest',
								'title' => 'Pinterest',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'pinterest_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'pinterest_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['pinterest_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'pinterest_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['pinterest_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'google',
								'title' => 'Google',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'google_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'google_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['google_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'google_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['google_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'bloglovin',
								'title' => 'BlogLovin',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'bloglovin_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'bloglovin_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['bloglovin_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'bloglovin_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['bloglovin_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'email',
								'title' => 'Email',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'email_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'email_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['email_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'email_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['email_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'flickr',
								'title' => 'Flickr',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'flickr_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'flickr_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['flickr_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'flickr_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['flickr_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'instagram',
								'title' => 'Instagram',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'instagram_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'instagram_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['instagram_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'instagram_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['instagram_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'rss',
								'title' => 'RSS',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'rss_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'rss_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['rss_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'rss_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['rss_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'custom1',
								'title' => 'Custom 1',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'custom1_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom1_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['custom1_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom1_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['custom1_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'custom2',
								'title' => 'Custom 2',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'custom2_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom2_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['custom2_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom2_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['custom2_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'custom3',
								'title' => 'Custom 3',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'custom3_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom3_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['custom3_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom3_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['custom3_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'custom4',
								'title' => 'Custom 4',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'custom4_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom4_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['custom4_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom4_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['custom4_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'custom5',
								'title' => 'Custom 5',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'custom5_link',
										'label' => 'Link',
										'default' => '',
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom5_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['custom5_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'custom5_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['custom5_social_icon'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
						),
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
						'options' => array(
							array(
								'id' => 'facebook-share',
								'title' => 'Facebook',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'facebook_share_text',
										'label' => 'Share Text',
										'default' => $wc_shortcodes_theme_support['facebook_share_text'],
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'facebook_share_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['facebook_share_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'facebook_share_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['facebook_share_button'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'twitter-share',
								'title' => 'Twitter',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'twitter_share_text',
										'label' => 'Share Text',
										'default' => $wc_shortcodes_theme_support['twitter_share_text'],
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'twitter_share_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['twitter_share_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'twitter_share_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['twitter_share_button'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'pinterest-share',
								'title' => 'Pinterest',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'pinterest_share_text',
										'label' => 'Share Text',
										'default' => $wc_shortcodes_theme_support['pinterest_share_text'],
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'pinterest_share_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['pinterest_share_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'pinterest_share_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['pinterest_share_button'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'google-share',
								'title' => 'Google',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'google_share_text',
										'label' => 'Share Text',
										'default' => $wc_shortcodes_theme_support['google_share_text'],
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'google_share_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['google_share_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'google_share_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['google_share_button'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
							array(
								'id' => 'email-share',
								'title' => 'Email',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'email_share_text',
										'label' => 'Share Text',
										'default' => $wc_shortcodes_theme_support['email_share_text'],
										'description' => '',
										'type' => 'input',
									),
									array(
										'option_name' => 'email_share_font_icon',
										'label' => 'Font Icon',
										'default' => $wc_shortcodes_theme_support['email_share_font_icon'],
										'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
										'type' => 'input',
									),
									array(
										'option_name' => 'email_share_icon',
										'label' => 'Image Icon',
										'default' => $wc_shortcodes_theme_support['email_share_button'],
										'description' => '',
										'type' => 'image',
									),
								),
							),
						),
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

