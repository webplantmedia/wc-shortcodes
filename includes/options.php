<?php
function wc_shortcodes_set_options() {
	global $wc_shortcodes_share_buttons;
	global $wc_shortcodes_social_icons;
	global $wc_shortcodes_options;
	global $wc_shortcodes_theme_support;

	$wc_shortcodes_options['social-media'] = array(
		'title' => 'Social Media',
		'sections' => array(
			array(
				'section' => 'wc-shortcodes-options-social-display-section',
				'title' => 'Display',
				'options' => array(
					array(
						'id' => 'social_icons_display',
						'title' => 'Order / Show / Hide',
						'default' => $wc_shortcodes_social_icons,
						'description' => '',
						'type' => 'social_icons',
					),
					array(
						'id' => 'social_icons_format',
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
				'section' => 'wc-shortcodes-options-facebook-section',
				'title' => 'Facebook',
				'options' => array(
					array(
						'id' => 'facebook_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'facebook_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['facebook_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'facebook_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['facebook_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-twitter-section',
				'title' => 'Twitter',
				'options' => array(
					array(
						'id' => 'twitter_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'twitter_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['twitter_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'twitter_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['twitter_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-pinterest-section',
				'title' => 'Pinterest',
				'options' => array(
					array(
						'id' => 'pinterest_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'pinterest_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['pinterest_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'pinterest_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['pinterest_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-google-section',
				'title' => 'Google',
				'options' => array(
					array(
						'id' => 'google_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'google_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['google_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'google_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['google_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-bloglovin-section',
				'title' => 'BlogLovin',
				'options' => array(
					array(
						'id' => 'bloglovin_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'bloglovin_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['bloglovin_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'bloglovin_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['bloglovin_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-email-section',
				'title' => 'Email',
				'options' => array(
					array(
						'id' => 'email_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'email_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['email_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'email_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['email_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-flickr-section',
				'title' => 'Flickr',
				'options' => array(
					array(
						'id' => 'flickr_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'flickr_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['flickr_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'flickr_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['flickr_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-instagram-section',
				'title' => 'Instagram',
				'options' => array(
					array(
						'id' => 'instagram_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'instagram_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['instagram_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'instagram_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['instagram_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-rss-section',
				'title' => 'Rss',
				'options' => array(
					array(
						'id' => 'rss_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'rss_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['rss_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'rss_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['rss_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-custom1-section',
				'title' => 'Custom 1',
				'options' => array(
					array(
						'id' => 'custom1_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom1_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['custom1_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom1_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['custom1_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-custom2-section',
				'title' => 'Custom 2',
				'options' => array(
					array(
						'id' => 'custom2_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom2_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['custom2_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom2_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['custom2_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-custom3-section',
				'title' => 'Custom 3',
				'options' => array(
					array(
						'id' => 'custom3_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom3_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['custom3_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom3_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['custom3_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-custom4-section',
				'title' => 'Custom 4',
				'options' => array(
					array(
						'id' => 'custom4_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom4_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['custom4_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom4_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['custom4_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-custom5-section',
				'title' => 'Custom 5',
				'options' => array(
					array(
						'id' => 'custom5_link',
						'title' => 'Link',
						'default' => '',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom5_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['custom5_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'custom5_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['custom5_social_icon'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
		),
	);
	$wc_shortcodes_options['share-buttons'] = array(
		'title' => 'Share Buttons',
		'sections' => array(
			array(
				'section' => 'wc-shortcodes-options-share-display-section',
				'title' => 'Display',
				'options' => array(
					array(
						'id' => 'share_buttons_display',
						'title' => 'Order / Show / Hide',
						'default' => $wc_shortcodes_share_buttons,
						'description' => '',
						'type' => 'share_buttons',
					),
					array(
						'id' => 'share_buttons_format',
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
				'section' => 'wc-shortcodes-options-facebook-share-section',
				'title' => 'Facebook',
				'options' => array(
					array(
						'id' => 'facebook_share_text',
						'title' => 'Share Text',
						'default' => $wc_shortcodes_theme_support['facebook_share_text'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'facebook_share_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['facebook_share_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'facebook_share_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['facebook_share_button'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-twitter-share-section',
				'title' => 'Twitter',
				'options' => array(
					array(
						'id' => 'twitter_share_text',
						'title' => 'Share Text',
						'default' => $wc_shortcodes_theme_support['twitter_share_text'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'twitter_share_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['twitter_share_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'twitter_share_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['twitter_share_button'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-pinterest-share-section',
				'title' => 'Pinterest',
				'options' => array(
					array(
						'id' => 'pinterest_share_text',
						'title' => 'Share Text',
						'default' => $wc_shortcodes_theme_support['pinterest_share_text'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'pinterest_share_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['pinterest_share_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'pinterest_share_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['pinterest_share_button'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-google-share-section',
				'title' => 'Google',
				'options' => array(
					array(
						'id' => 'google_share_text',
						'title' => 'Share Text',
						'default' => $wc_shortcodes_theme_support['google_share_text'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'google_share_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['google_share_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'google_share_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['google_share_button'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-email-share-section',
				'title' => 'Email',
				'options' => array(
					array(
						'id' => 'email_share_text',
						'title' => 'Share Text',
						'default' => $wc_shortcodes_theme_support['email_share_text'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'email_share_font_icon',
						'title' => 'Font Icon',
						'default' => $wc_shortcodes_theme_support['email_share_font_icon'],
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'email_share_icon',
						'title' => 'Image Icon',
						'default' => $wc_shortcodes_theme_support['email_share_button'],
						'description' => '',
						'type' => 'image',
					),
				),
			),
		),
	);
	$number_options = "1\n2\n3\n4\n5";
	$event_options = "All Events\nMain Ceremony\nWedding Party";
	$admin_email = get_option( 'admin_email' );

	$wc_shortcodes_options['rsvp'] = array(
		'title' => 'RSVP',
		'sections' => array(
			array(
				'section' => 'wc-shortcodes-options-rsvp-section',
				'title' => 'RSVP',
				'options' => array(
					array(
						'id' => 'rsvp_email',
						'title' => 'Email To',
						'default' => $admin_email,
						'description' => 'Send RSVP notification to the email address above. Separate multiple emails with a comma.',
						'type' => 'emails',
					),
					array(
						'id' => 'rsvp_email_title',
						'title' => 'Email Title',
						'default' => 'New RSVP - ' .get_bloginfo('title'),
						'description' => 'The subject tile of your email you will receive',
						'type' => 'input',
					),
					array(
						'id' => 'rsvp_success_message',
						'title' => 'Success Message',
						'default' => 'Thanks for attending! We will see you at our wedding.',
						'description' => 'The message to display after a user successfully RSVP\'d',
						'type' => 'input',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-rsvp-name-section',
				'title' => 'Name',
				'options' => array(
					array(
						'id' => 'rsvp_name_title',
						'title' => 'Title',
						'default' => 'Your Name',
						'description' => '',
						'type' => 'input',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-rsvp-number-section',
				'title' => 'Number',
				'options' => array(
					array(
						'id' => 'rsvp_number_title',
						'title' => 'Title',
						'default' => 'Number of Guests',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'rsvp_number_options',
						'title' => 'Options',
						'default' => $number_options,
						'description' => '',
						'type' => 'textarea',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-rsvp-event-section',
				'title' => 'Event',
				'options' => array(
					array(
						'id' => 'rsvp_event_title',
						'title' => 'Title',
						'default' => 'You Will Attend...',
						'description' => '',
						'type' => 'input',
					),
					array(
						'id' => 'rsvp_event_options',
						'title' => 'Options',
						'default' => $event_options,
						'description' => '',
						'type' => 'textarea',
					),
				),
			),
			array(
				'section' => 'wc-shortcodes-options-rsvp-button-section',
				'title' => 'Button',
				'options' => array(
					array(
						'id' => 'rsvp_button_title',
						'title' => 'Title',
						'default' => 'I Am Attending',
						'description' => '',
						'type' => 'input',
					),
				),
			),
		),
	);
	$wc_shortcodes_options['misc'] = array(
		'title' => 'Misc',
		'sections' => array(
			array(
				'section' => 'wc-shortcodes-options-misc-section',
				'title' => 'Miscellaneous Options',
				'options' => array(
					array(
						'id' => 'enable_shortcode_css',
						'title' => 'Shortcode CSS',
						'default' => '1',
						'description' => '',
						'label' => 'Use shortcode CSS provided by plugin',
						'type' => 'checkbox',
					),
					array(
						'id' => 'enable_font_awesome',
						'title' => 'Enable FontAwesome',
						'default' => '1',
						'description' => '',
						'label' => 'Use font icons provided by FontAwesome',
						'type' => 'checkbox',
					),
				),
			),
		),
	);
}
add_action( 'init', 'wc_shortcodes_set_options', 100 );
