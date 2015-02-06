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


function wc_shortcodes_theme_options( $theme_options ) {
	// Grid Option
	$theme_options['wc-grid-options'] = array(
		'parent_slug' => 'themes.php',
		'page_title' => 'Grid',
		'menu_title' => 'Grid',
		'capability' => 'manage_options',
		'option_group' => 'wc-grid-options-group',
		'display' => 'theme_options',
		'tabs' => array(
			array(
				'name' => 'Grid',
				'sections' => array(
					array(
						'id' => 'wc-grid-options-section',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => '',
						'options' => array(
							array(
								'id' => 'content_width',
								'title' => 'Content Size',
								'description' => 'Set the width and padding of your content.',
								'group' => array(
									array(
										'option_name' => 'content_max_width',
										'label' => 'Max Width',
										'default' => '1200px',
										'type' => 'positive_pixel',
										'less' => true,
									),
									array(
										'option_name' => 'edge_padding',
										'label' => 'Edge Padding',
										'default' => '0px',
										'type' => 'positive_pixel',
										'less' => true,
									),
									array(
										'option_name' => 'sidebar_padding',
										'label' => 'Sidebar Padding',
										'default' => '60px',
										'type' => 'positive_pixel',
										'less' => true,
									),
								),
							),
							array(
								'option_name' => 'sidebar_width',
								'title' => 'Sidebar Width',
								'default' => '320px',
								'description' => 'Set the width of your sidebar widgets.',
								'type' => 'positive_pixel',
								'less' => true,
							),
						),
					),
				),
			),
			array(
				'name' => 'Header',
				'sections' => array(
					array(
						'id' => 'wc-header-options-section',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => '',
						'options' => array(
							array(
								'option_name' => 'logo_image',
								'title' => 'Logo Image',
								'default' => '',
								'description' => 'Select you logo image. If no logo image is selected, then we will showcase your blog title and description.',
								'type' => 'gallery',
							),
							array(
								'option_name' => 'logo_width',
								'title' => 'Logo Width',
								'default' => '22',
								'description' => 'Set the percentage width of your logo. Should be an even number between 10% - 40%.',
								'type' => 'number',
								'less' => true,
							),
							array(
								'option_name' => 'show_site_text',
								'title' => 'Show Site Text',
								'default' => '0',
								'description' => '',
								'label' => 'Show the site title and site description in the header',
								'type' => 'checkbox',
							),
							array(
								'option_name' => 'site_title_bottom_padding',
								'title' => 'Site Title Bottom Padding',
								'default' => '5px',
								'description' => 'Set the padding between the site title and site description.',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'header_background',
								'title' => 'Header Background',
								'default' => array(
									'color' => '#ffffff',
									'image' => '',
									'repeat' => 'repeat-x',
									'attachment'=> 'scroll',
									'position' => 'center top',
								),
								'description' => 'Upload a background header image.',
								'type' => 'background',
								'less' => true,
							),
							array(
								'option_name' => 'header_min_height',
								'title' => 'Header Minimum Height',
								'default' => '0px',
								'description' => 'Set the minimum height of your header',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'id' => 'header_padding',
								'title' => 'Header Padding',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'header_top_padding',
										'label' => 'Top',
										'default' => '30px',
										'type' => 'positive_pixel',
										'less' => true,
									),
									array(
										'option_name' => 'header_bottom_padding',
										'label' => 'Bottom',
										'default' => '20px',
										'type' => 'positive_pixel',
										'less' => true,
									),
								)
							),
						),
					),
				),
			),
			array(
				'name' => 'Header',
				'sections' => array(
					array(
						'id' => 'wc-menu-bar-options-group',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => 'Menu Bar',
						'options' => array(
							array(
								'option_name' => 'menu_bar_background',
								'title' => 'Menu Bar Background',
								'default' => array(
									'color' => '#ffffff',
									'image' => '',
									'repeat' => 'repeat-x',
									'attachment'=> 'scroll',
									'position' => 'center top',
								),
								'description' => '',
								'type' => 'background',
								'less' => true,
							),
							array(
								'option_name' => 'menu_bar_bottom_offset',
								'title' => 'Menu Bar Bottom Offset',
								'default' => '40',
								'description' => 'Set the percentage value your menu bar should move up. Should be between 0-100%.',
								'type' => 'number',
								'less' => true,
							),
							array(
								'option_name' => 'menu_bar_font_hover_color',
								'title' => 'Font Hover Color',
								'default' => '#444444',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'menu_bar_font_hover_background_color',
								'title' => 'Font Hover Background Color',
								'default' => '#dddddd',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'menu_bar_font_active_background_color',
								'title' => 'Font Active Background Color',
								'default' => '#f96e5b',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'id' => 'menu_bar_position',
								'title' => 'Menubar Position',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'menu_bar_font_padding_top',
										'label' => 'Padding Top',
										'default' => '18px',
										'type' => 'positive_pixel',
										'less' => true,
									),
									array(
										'option_name' => 'menu_bar_font_padding_bottom',
										'label' => 'Padding Bottom',
										'default' => '18px',
										'type' => 'positive_pixel',
										'less' => true,
									),
								)
							),
							array(
								'option_name' => 'sticky_menu',
								'title' => 'Sticky Menu',
								'default' => '0',
								'description' => '',
								'label' => 'Fix the menu to the top of screen when scrolling',
								'type' => 'checkbox',
							),
						),
					),
					array(
						'id' => 'wc-dropdown-options-group',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => 'Dropdown',
						'options' => array(
							array(
								'option_name' => 'dropdown_border',
								'title' => 'Dropdown Border',
								'default' => array(
									'width' => '4px',
									'style' => 'solid',
									'color' => '#ffffff',
								),
								'description' => '',
								'type' => 'border',
								'less' => true,
							),
							array(
								'option_name' => 'dropdown_font_color',
								'title' => 'Dropdown Font Color',
								'default' => '#444444',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'dropdown_font_background_color',
								'title' => 'Dropdown Font Background Color',
								'default' => '#eeeeee',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'dropdown_font_hover_color',
								'title' => 'Dropdown Font Hover Color',
								'default' => '#444444',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'dropdown_font_hover_background_color',
								'title' => 'Dropdown Font Hover Background Color',
								'default' => '#dddddd',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'dropdown_font_active_background_color',
								'title' => 'Dropdown Font Active Background Color',
								'default' => '#eeeeee',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'dropdown_width',
								'title' => 'Dropdown Width',
								'default' => '300px',
								'description' => '',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'id' => 'dropdown_position',
								'title' => 'Dropdown Position',
								'description' => '',
								'group' => array(
									array(
										'option_name' => 'dropdown_font_padding_top',
										'label' => 'Padding Top',
										'default' => '12px',
										'type' => 'positive_pixel',
										'less' => true,
									),
									array(
										'option_name' => 'dropdown_font_padding_bottom',
										'label' => 'Padding Bottom',
										'default' => '12px',
										'type' => 'positive_pixel',
										'less' => true,
									),
								)
							),
						),
					),
				),
			),
			array(
				'name' => 'Misc',
				'sections' => array(
					array(
						'id' => 'wc-misc-options-section',
						'add_section' => true, // Add a new section? Or does it already exists?
						'title' => '',
						'options' => array(
							array(
								'option_name' => 'favicon',
								'title' => 'Favicon',
								'default' => '',
								'description' => 'Go <a href="http://www.favicon.cc/" target="_blank">here</a> if you need help creating a favicon.',
								'type' => 'image',
							),
							array(
								'option_name' => 'jshtml_head',
								'title' => 'Head',
								'default' => '',
								'description' => '',
								'type' => 'textarea',
							),
							array(
								'option_name' => 'jshtml_top_of_page',
								'title' => 'Top of Page',
								'default' => '',
								'description' => '',
								'type' => 'textarea',
							),
							array(
								'option_name' => 'jshtml_footer',
								'title' => 'Footer',
								'default' => '',
								'description' => '',
								'type' => 'wp_editor',
							),
							array(
								'option_name' => 'show_bio_in_post',
								'title' => 'Show Bio',
								'default' => '1',
								'label' => 'Show your bio at the bottom of each post.',
								'description' => '',
								'type' => 'checkbox',
							),
							array(
								'option_name' => 'font_render',
								'title' => 'Font Rendering',
								'default' => 'smooth',
								'options' => array(
									'default' => 'Browser Default',
									'smooth' => 'Smooth',
								),
								'description' => 'Forcing browsers to display fonts smoothly will usually cause your fonts to be thinner. However, in some cases, this may be what you want.',
								'type' => 'dropdown',
							),
							array(
								'option_name' => 'blog_use_excerpt',
								'title' => 'For each article in blog, show',
								'default' => '1',
								'options' => array(
									'0' => 'Full Text',
									'1' => 'Summary',
								),
								'description' => '',
								'type' => 'radio',
							),
							array(
								'option_name' => 'enable_auto_updates',
								'title' => 'Updates',
								'default' => '1',
								'label' => 'Enable automatic updates of your theme.',
								'description' => '',
								'type' => 'checkbox',
							),
							array(
								'option_name' => 'support_wordpress_canvas',
								'title' => 'Support Us!',
								'default' => '1',
								'label' => 'Support WordPress Canvas with a link in your footer. Thank you!',
								'description' => '',
								'type' => 'checkbox',
							),
						),
					),
				),
			),
		),
	);
/*
	// Header Option
	$theme_options['wc-header-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Header',
		'menu_title' => 'Header',
		'capability' => 'manage_options',
		'option_group' => 'wc-header-options-group',
		'display' => 'theme_options',
	);

	// Menu Options
	$theme_options['wc-menu-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Menu Bar',
		'menu_title' => 'Menu Bar',
		'capability' => 'manage_options',
		'option_group' => 'wc-menu-options-group',
		'display' => 'theme_options',
	);

	// Heading Options
	$theme_options['wc-heading-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Heading',
		'menu_title' => 'Heading',
		'capability' => 'manage_options',
		'option_group' => 'wc-heading-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-heading-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'heading_font',
						'title' => 'Heading Font',
						'default' => array(
							'font_family' => 'Lato',
							'font_size' => '44px',
							'text_transform' => 'none',
							'font_style' => 'normal',
							'font_weight' => '300',
							'color' => '#666666',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'heading_line_height',
						'title' => 'Heading Line Height',
						'default' => '1.3',
						'description' => 'Set line height for your heading text.',
						'type' => 'decimal',
						'less' => true,
					),
					array(
						'option_name' => 'heading_font_bold_weight',
						'title' => 'Heading Font Bold Weight',
						'default' => 'normal',
						'description' => 'Set the font weight for heading text',
						'type' => 'font_weight',
						'less' => true,
					),
					array(
						'option_name' => 'heading_link_font_color',
						'title' => 'Heading Link Color',
						'default' => '#8ab7b6',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'heading_link_font_hover',
						'title' => 'Heading Link Font Hover',
						'default' => array(
							'text_decoration' => 'none',
							'color' => '#f96e5b',
						),
						'description' => '',
						'type' => 'font_hover',
						'less' => true,
					),
					array(
						'id' => 'heading_font_sizes',
						'title' => 'Heading Font Sizes',
						'description' => 'Set the pixel size of your headings.',
						'group' => array(
							array(
								'option_name' => 'heading_font_size_h2',
								'label' => 'H2',
								'default' => '36px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'heading_font_size_h3',
								'label' => 'H3',
								'default' => '30px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'heading_font_size_h4',
								'label' => 'H4',
								'default' => '26px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'heading_font_size_h5',
								'label' => 'H5',
								'default' => '22px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'heading_font_size_h6',
								'label' => 'H6',
								'default' => '18px',
								'type' => 'positive_pixel',
								'less' => true,
							),
						),
					),
					array(
						'option_name' => 'heading_padding_right',
						'title' => 'Heading Right Padding',
						'default' => '150px',
						'description' => 'Make sure you have enought space between your heading and the date box.',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
		),
	);

	// Body Options
	$theme_options['wc-body-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Body',
		'menu_title' => 'Body',
		'capability' => 'manage_options',
		'option_group' => 'wc-body-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-body-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'body_font',
						'title' => 'Body Font',
						'default' => array(
							'font_family' => 'Lato',
							'font_size' => '19px',
							'text_transform' => 'none',
							'font_style' => 'normal',
							'font_weight' => 'normal',
							'color' => '#666666',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'body_line_height',
						'title' => 'Body Line Height',
						'default' => '1.6',
						'description' => 'Set line height for your body text.',
						'type' => 'decimal',
						'less' => true,
					),
					array(
						'option_name' => 'body_font_bold_weight',
						'title' => 'Body Font Bold Weight',
						'default' => 'bold',
						'description' => 'Set the font weight for bold text',
						'type' => 'font_weight',
						'less' => true,
					),
					array(
						'id' => 'body_font_sizes',
						'title' => 'Body Font Sizes',
						'description' => 'Some areas of your site my require for smaller or large text.',
						'group' => array(
							array(
								'option_name' => 'body_font_size_xsmall',
								'label' => 'X-Small',
								'default' => '14px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'body_font_size_small',
								'label' => 'Small',
								'default' => '17px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'body_font_size_large',
								'label' => 'Large',
								'default' => '21px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'body_font_size_xlarge',
								'label' => 'X-Large',
								'default' => '23px',
								'type' => 'positive_pixel',
								'less' => true,
							),
						),
					),
					array(
						'option_name' => 'link_font_color',
						'title' => 'Link Color',
						'default' => '#8ab7b6',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'link_font_hover',
						'title' => 'Link Font Hover',
						'default' => array(
							'text_decoration' => 'underline',
							'color' => '#f96e5b',
						),
						'description' => '',
						'type' => 'font_hover',
						'less' => true,
					),
				),
			),
		),
	);

	// Elements Options
	$theme_options['wc-elements-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Elements',
		'menu_title' => 'Elements',
		'capability' => 'manage_options',
		'option_group' => 'wc-elements-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-date-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Date',
				'options' => array(
					array(
						'option_name' => 'date_font_color',
						'title' => 'Date Font Color',
						'default' => '#bbbbbb',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'date_font_background_color',
						'title' => 'Date Font Background Color',
						'default' => '#eeeeee',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-quote-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Quote',
				'options' => array(
					array(
						'option_name' => 'quote_font',
						'title' => 'Quote Font',
						'default' => array(
							'font_family' => 'Lato',
							'font_size' => '30px',
							'text_transform' => 'none',
							'font_style' => 'italic',
							'font_weight' => '300',
							'color' => '#999999',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'quote_font_background_color',
						'title' => 'Quote Font Background Color',
						'default' => '#f7f7f7',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-caption-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Caption',
				'options' => array(
					array(
						'option_name' => 'caption_font',
						'title' => 'Caption Font',
						'default' => array(
							'font_family' => 'Lato',
							'font_size' => '15px',
							'text_transform' => 'none',
							'font_style' => 'normal',
							'font_weight' => 'normal',
							'color' => '#777777',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'caption_font_background_color',
						'title' => 'Caption Font Background Color',
						'default' => '#f5f5f5',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
				),
			),
		),
	);

	// Borders Options
	$theme_options['wc-borders-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Borders',
		'menu_title' => 'Borders',
		'capability' => 'manage_options',
		'option_group' => 'wc-borders-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-border-defaults-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Defaults',
				'options' => array(
					array(
						'option_name' => 'border_default_display',
						'title' => 'Default Border Display',
						'default' => 'image',
						'options' => array(
							'singlesolid' => 'Single Solid',
							'singledashed' => 'Single Dashed',
							'singledotted' => 'Single Dotted',
							'doublesolid' => 'Double Solid',
							'doubledashed' => 'Double Dashed',
							'doubledotted' => 'Double Dotted',
							'image' => 'Image 1',
							'image2' => 'Image 2',
							'image3' => 'Image 3',
						),
						'description' => 'Set the default display of your border.',
						'type' => 'dropdown',
					),
					array(
						'option_name' => 'border_color',
						'title' => 'Border Color',
						'default' => '#dddddd',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-border1-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Border 1',
				'options' => array(
					array(
						'option_name' => 'border_background',
						'title' => 'Background',
						'default' => array(
							'color' => '',
							'image' => WC_SHORTCODES_PLUGIN_URL . 'img/border.png',
							'repeat' => 'no-repeat',
							'attachment'=> 'scroll',
							'position' => 'center center',
						),
						'description' => 'Set your widget background.',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'border_background_height',
						'title' => 'Height',
						'default' => '1px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-border2-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Border 2',
				'options' => array(
					array(
						'option_name' => 'border2_background',
						'title' => 'Background',
						'default' => array(
							'color' => '',
							'image' => WC_SHORTCODES_PLUGIN_URL . 'img/border2.png',
							'repeat' => 'repeat-x',
							'attachment'=> 'scroll',
							'position' => 'center center',
						),
						'description' => 'Set your widget background.',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'border2_background_height',
						'title' => 'Height',
						'default' => '6px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-border3-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Border 3',
				'options' => array(
					array(
						'option_name' => 'border3_background',
						'title' => 'Background',
						'default' => array(
							'color' => '',
							'image' => WC_SHORTCODES_PLUGIN_URL . 'img/border3.png',
							'repeat' => 'repeat-x',
							'attachment'=> 'scroll',
							'position' => 'center center',
						),
						'description' => 'Set your widget background.',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'border3_background_height',
						'title' => 'Height',
						'default' => '6px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
		),
	);

	// Sidebar Options
	$theme_options['wc-sidebar-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Sidebar',
		'menu_title' => 'Sidebar',
		'capability' => 'manage_options',
		'option_group' => 'wc-sidebar-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-sidebar-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'sidebar_background',
						'title' => 'Sidebar Background',
						'default' => array(
							'color' => '#eeeeee',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your sidebar background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_widget_padding',
						'title' => 'Sidebar Widget Padding',
						'default' => '10px',
						'description' => 'Set the padding between the edge and your widgets.',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'widget_title_background',
						'title' => 'Widget Title Background',
						'default' => array(
							'color' => '#f96e5b',
							'image' => '',
							'repeat' => 'repeat',
							'attachment'=> 'scroll',
							'position' => 'center top',
						),
						'description' => 'Set your widget title background.',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'widget_title_line_height',
						'title' => 'Widget Title Line Height',
						'default' => '1.5',
						'description' => 'Set line height for your widget title. The larger the line height, the more space you will have for your background image.',
						'type' => 'decimal',
						'less' => true,
					),
					array(
						'option_name' => 'widget_title_edge_padding',
						'title' => 'Widget Title Edge Padding',
						'default' => '10px',
						'description' => 'Set the edge padding of your widget title.',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'widget_title_font',
						'title' => 'Widget Title Font',
						'default' => array(
							'font_family' => 'Lato',
							'font_size' => '26px',
							'text_transform' => 'uppercase',
							'font_style' => 'normal',
							'font_weight' => '300',
							'color' => '#ffffff',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_font_size',
						'title' => 'Sidebar Font Size',
						'default' => '16px',
						'description' => 'Set the font size of text inside your sidebar',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_font_color',
						'title' => 'Sidebar Font Color',
						'default' => '#999999',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_link_color',
						'title' => 'Sidebar Link Color',
						'default' => '#777777',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_link_hover_color',
						'title' => 'Sidebar Link Hover Color',
						'default' => '#555555',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_border_color',
						'title' => 'Sidebar Border Color',
						'default' => '#dddddd',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'sidebar_display',
						'title' => 'Default Sidebar Display',
						'default' => 'right',
						'options' => array(
							'left' => 'Left',
							'right' => 'Right',
						),
						'description' => 'Set the default display of your sidebar.',
						'type' => 'dropdown',
					),
					array(
						'option_name' => 'sidebar_inner_content_align',
						'title' => 'Inner Content Align',
						'default' => 'left',
						'options' => array(
							'left' => 'Left',
							'center' => 'Center',
							'right' => 'Right',
						),
						'description' => 'Set the inner content alignment inside your sidebar.',
						'type' => 'dropdown',
					),
					array(
						'option_name' => 'show_sidebar',
						'title' => 'Show Sidebar',
						'default' => array( 'post', 'blog', 'search', 'archive', 'category', 'tag', 'author' ),
						'options_callback' => 'wordpresscanvas_page_formats',
						'description' => '',
						'type' => 'checkboxes',
					),
				),
			),
		),
	);

	// Form Options
	$theme_options['wc-forms-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Forms',
		'menu_title' => 'Forms',
		'capability' => 'manage_options',
		'option_group' => 'wc-forms-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-forms-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'form_font_color',
						'title' => 'Form Font Color',
						'default' => '#444444',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'form_background_color',
						'title' => 'Form Background Color',
						'default' => '#ffffff',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'form_border_color',
						'title' => 'Form Border Color',
						'default' => '#dddddd',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'form_border_focus_color',
						'title' => 'Form Border Focus Color',
						'default' => '#8ab7b6',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'form_required_color',
						'title' => 'Form Required Color',
						'default' => '#ed331c',
						'description' => 'An asterick is placed on input fields that is required for submission.',
						'type' => 'color',
						'less' => true,
					),
				),
			),
		),
	);

	// Footer Options
	$theme_options['wc-footer-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Footer',
		'menu_title' => 'Footer',
		'capability' => 'manage_options',
		'option_group' => 'wc-footer-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-footer-sidebar-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Footer',
				'options' => array(
					array(
						'option_name' => 'footer_widget_width',
						'title' => 'Footer Widget Width',
						'default' => '250px',
						'description' => 'Set the width of your footer widgets.',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'footer_sidebar_background_color',
						'title' => 'Footer Sidebar Background Color',
						'default' => '#333333',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_widget_title_font_color',
						'title' => 'Footer Title Color',
						'default' => '#f7f7f7',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_widget_font_color',
						'title' => 'Footer Font Color',
						'default' => '#aaaaaa',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_widget_link_color',
						'title' => 'Footer Link Color',
						'default' => '#f7f7f7',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_widget_link_hover_color',
						'title' => 'Footer Link Hover Color',
						'default' => '#f7f7f7',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_sidebar_border_color',
						'title' => 'Footer Border Color',
						'default' => '#555555',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-footer-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Site Info',
				'options' => array(
					array(
						'option_name' => 'footer_background_color',
						'title' => 'Footer Background Color',
						'default' => '#444444',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_font_color',
						'title' => 'Footer Font Color',
						'default' => '#aaaaaa',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_link_color',
						'title' => 'Footer Link Color',
						'default' => '#f7f7f7',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'footer_link_hover_color',
						'title' => 'Footer Link Hover Color',
						'default' => '#f7f7f7',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'copyright_text',
						'title' => 'Copyright Text',
						'default' => '.  Site made with care by <a href="http://webplantmedia.com">Chris</a>',
						'description' => 'You can insert HTML into your text such as a link.',
						'type' => 'input',
					),
				),
			),
		),
	);

	// Background Options
	$theme_options['wc-background-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Background',
		'menu_title' => 'Background',
		'capability' => 'manage_options',
		'option_group' => 'wc-background-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-background-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'body_background',
						'title' => 'Body Background',
						'default' => array(
							'color' => '',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your body background.',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'top_body_background',
						'title' => 'Top Body Background',
						'default' => array(
							'color' => '',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your top body background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'middle_body_background',
						'title' => 'Middle Body Background',
						'default' => array(
							'color' => '',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your middle body background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'bottom_body_background',
						'title' => 'Bottom Body Background',
						'default' => array(
							'color' => '',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your bottom body background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'left_body_background',
						'title' => 'Left Body Background',
						'default' => array(
							'color' => '',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your left border background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'right_body_background',
						'title' => 'Right Body Background',
						'default' => array(
							'color' => '',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your left border background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'page_background',
						'title' => 'Page Background',
						'default' => array(
							'color' => '#ffffff',
							'image' => '',
							'repeat' => '',
							'attachment'=> '',
							'position' => '',
						),
						'description' => 'Set your page background',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'left_arrow',
						'title' => 'Left Arrow',
						'default' => WC_SHORTCODES_PLUGIN_URL . 'img/left-arrow.png',
						'description' => 'Must be 100x100 pixels',
						'type' => 'image',
						'less' => true,
					),
					array(
						'option_name' => 'right_arrow',
						'title' => 'Right Arrow',
						'default' => WC_SHORTCODES_PLUGIN_URL . 'img/right-arrow.png',
						'description' => 'Must be 100x100 pixels',
						'type' => 'image',
						'less' => true,
					),
				),
			),
		),
	);

	// Colors Options
	$theme_options['wc-colors-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Colors',
		'menu_title' => 'Colors',
		'capability' => 'manage_options',
		'option_group' => 'wc-colors-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-colors-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'color_white',
						'title' => 'White',
						'default' => '#ffffff',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_lightest_gray',
						'title' => 'Lightest Gray',
						'default' => '#f5f5f5',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_lighter_gray',
						'title' => 'Lighter Gray',
						'default' => '#dbdbdb',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_light_gray',
						'title' => 'Light Gray',
						'default' => '#999999',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_gray',
						'title' => 'Gray',
						'default' => '#555555',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_dark_gray',
						'title' => 'Dark Gray',
						'default' => '#333333',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_darker_gray',
						'title' => 'Darker Gray',
						'default' => '#222222',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_darkest_gray',
						'title' => 'Darkest Gray',
						'default' => '#111111',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'color_black',
						'title' => 'Black',
						'default' => '#000000',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'id' => 'primary_colors',
						'title' => 'Primary',
						'description' => 'Set your primary color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_primary',
								'default' => '#f96e5b',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_primary_contrast',
								'default' => '#ffffff',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'secondary_colors',
						'title' => 'Secondary',
						'description' => 'Set your secondary color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_secondary',
								'default' => '#86c1af',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_secondary_contrast',
								'default' => '#ffffff',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'inverse_colors',
						'title' => 'Inverse',
						'description' => 'Set your inverse color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_inverse',
								'default' => '#faf5f4',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_inverse_contrast',
								'default' => '#f96e5b',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'success_colors',
						'title' => 'Success',
						'description' => 'Set your success color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_success',
								'default' => '#5cb85c',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_success_contrast',
								'default' => '#efffef',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'warning_colors',
						'title' => 'Warning',
						'description' => 'Set your warning color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_warning',
								'default' => '#f0ad4e',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_warning_contrast',
								'default' => '#fff2e8',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'danger_colors',
						'title' => 'Danger',
						'description' => 'Set your danger color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_danger',
								'default' => '#d9534f',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_danger_contrast',
								'default' => '#ffe8e8',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'info_colors',
						'title' => 'Info',
						'description' => 'Set your info color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_info',
								'default' => '#5bc0de',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_info_contrast',
								'default' => '#eff9ff',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'green',
						'title' => 'Green',
						'description' => 'Set your green color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_green',
								'default' => '#5f9025',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_green_contrast',
								'default' => '#d3e8da',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'yellow',
						'title' => 'Yellow',
						'description' => 'Set your yellow color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_yellow',
								'default' => '#faeb48',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_yellow_contrast',
								'default' => '#695d43',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'blue',
						'title' => 'Blue',
						'description' => 'Set your blue color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_blue',
								'default' => '#5091b2',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_blue_contrast',
								'default' => '#e9f7fe',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
					array(
						'id' => 'red',
						'title' => 'Red',
						'description' => 'Set your red color and contrast color.',
						'group' => array(
							array(
								'option_name' => 'color_red',
								'default' => '#de5959',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
							array(
								'option_name' => 'color_red_contrast',
								'default' => '#ffe9e9',
								'description' => '',
								'type' => 'color',
								'less' => true,
							),
						),
					),
				),
			),
		),
	);

	// Media Queries
	$theme_options['wc-media-queries-options'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Media Queries',
		'menu_title' => 'Media Queries',
		'capability' => 'manage_options',
		'option_group' => 'wc-media-queries-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-tablet-media-queries-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Tablet Devices',
				'options' => array(
					array(
						'option_name' => 'tablet_device_width',
						'title' => 'Tablet Device Width',
						'default' => '991px',
						'description' => 'Set the tablet width which the media queries below begin to take effect.',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'tablet_site_title_font_size',
						'title' => 'Tablet Site Title Font Size',
						'default' => '24px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'tablet_site_description_font_size',
						'title' => 'Tablet Site Description Font Size',
						'default' => '14px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-mobile-media-queries-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Mobile Devices',
				'options' => array(
					array(
						'option_name' => 'mobile_device_width',
						'title' => 'Mobile Device Width',
						'default' => '568px',
						'description' => 'Set the mobile width which the media queries below begin to take effect.',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'mobile_site_title_font_size',
						'title' => 'Mobile Site Title Font Size',
						'default' => '24px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
					array(
						'option_name' => 'mobile_site_description_font_size',
						'title' => 'Mobile Site Description Font Size',
						'default' => '14px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-menu-media-queries-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Menu',
				'options' => array(
					array(
						'option_name' => 'menu_collapse_width',
						'title' => 'Menu Collapse Width',
						'default' => '1100px',
						'description' => 'Set the width when your menu should collapse.',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
			array(
				'id' => 'wc-viewport-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Viewport',
				'options' => array(
					array(
						'option_name' => 'viewport_device_width',
						'title' => 'Viewport Width',
						'default' => '0',
						'description' => 'Set the width you want your site to be when viewed on mobile devices and tablets. Set to 0 if you want device-width to be used.',
						'type' => 'number',
					),
					array(
						'option_name' => 'viewport_initial_scale',
						'title' => 'Initial Scale',
						'default' => '1.0',
						'description' => 'Set the initial scale of your webpage for mobile and tablet devices. Set to 0 if you do not want an initial scale set',
						'type' => 'decimal',
					),
				),
			),
		),
	);

	// Creates Social Media Page
	$theme_options['wc-meta'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Meta',
		'menu_title' => 'Meta',
		'capability' => 'manage_options',
		'option_group' => 'wc-meta-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-meta-options-group',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => '',
				'options' => array(
					array(
						'option_name' => 'meta_font',
						'title' => 'Meta Font',
						'default' => array(
							'font_family' => 'Oswald',
							'font_size' => '19px',
							'text_transform' => 'uppercase',
							'font_style' => 'normal',
							'font_weight' => '300',
							'color' => '#86c1af',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'meta_background',
						'title' => 'Meta Background',
						'default' => array(
							'color' => '#ffffff',
							'image' => WC_SHORTCODES_PLUGIN_URL . 'img/meta-background.png',
							'repeat' => 'repeat-x',
							'attachment'=> 'scroll',
							'position' => 'center top',
						),
						'description' => 'Set background image for post meta information',
						'type' => 'background',
						'less' => true,
					),
					array(
						'option_name' => 'show_share_buttons',
						'title' => 'Show Share Buttons',
						'default' => '1',
						'description' => '',
						'label' => 'Show share buttons on your blog post',
						'type' => 'checkbox',
					),
					array(
						'option_name' => 'share_buttons_font',
						'title' => 'Share Buttons Font',
						'default' => array(
							'font_family' => 'Oswald',
							'font_size' => '26px',
							'text_transform' => 'uppercase',
							'font_style' => 'normal',
							'font_weight' => '300',
							'color' => '#bbbbbb',
						),
						'description' => '',
						'type' => 'font',
						'less' => true,
					),
					array(
						'option_name' => 'share_buttons_font_hover_color',
						'title' => 'Share Button Font Hover Color',
						'default' => '#444444',
						'description' => '',
						'type' => 'color',
						'less' => true,
					),
					array(
						'option_name' => 'meta_height',
						'title' => 'Meta Height',
						'default' => '63px',
						'description' => '',
						'type' => 'positive_pixel',
						'less' => true,
					),
				),
			),
		),
	);

	// Creates JS+HTML Page
	$theme_options['wc-misc'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Misc',
		'menu_title' => 'Misc',
		'capability' => 'manage_options',
		'option_group' => 'wc-misc-options-group',
		'display' => 'theme_options',
	);

	// Media Options
	$theme_options['wc-image-sizes'] = array(
		'parent_slug' => 'options.php',
		'page_title' => 'Image Sizes',
		'menu_title' => 'Image Sizes',
		'capability' => 'manage_options',
		'option_group' => 'wc-image-sizes-options-group',
		'display' => 'theme_options',
		'sections' => array(
			array(
				'id' => 'wc-image-sizes-options-section',
				'add_section' => true, // Add a new section? Or does it already exists?
				'title' => 'Additional Image Sizes for Theme',
				'options' => array(
					array(
						'id' => 'post_thumbnail',
						'title' => 'Post Thumbnail',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'post_thumbnail_size_w',
								'label' => 'Max Width',
								'default' => '820px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'post_thumbnail_size_h',
								'label' => 'Max Height',
								'default' => '270px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'post_thumbnail_crop',
								'label' => 'Crop to exact dimensions',
								'default' => '1',
								'description' => '',
								'type' => 'checkbox',
							),
						),
					),
					array(
						'id' => 'icon_size',
						'title' => 'Icon Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'icon_size_w',
								'label' => 'Max Width',
								'default' => '48px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'icon_size_h',
								'label' => 'Max Height',
								'default' => '48px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'icon_crop',
								'label' => 'Crop to exact dimensions',
								'default' => '1',
								'description' => '',
								'type' => 'checkbox',
							),
						),
					),
					array(
						'id' => 'square_size',
						'title' => 'Square Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'square_size_w',
								'label' => 'Max Width',
								'default' => '300px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'square_size_h',
								'label' => 'Max Height',
								'default' => '300px',
								'type' => 'positive_pixel',
								'less' => true,
							),
							array(
								'option_name' => 'square_crop',
								'label' => 'Crop to exact dimensions',
								'default' => '1',
								'description' => '',
								'type' => 'checkbox',
							),
						),
					),
					array(
						'id' => 'small_size',
						'title' => 'Small Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'small_size_w',
								'label' => 'Max Width',
								'default' => '250px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'small_size_h',
								'label' => 'Max Height',
								'default' => '9999px',
								'type' => 'positive_pixel',
							),
						),
					),
					array(
						'id' => 'standard_size',
						'title' => 'Standard Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'standard_size_w',
								'label' => 'Max Width',
								'default' => '550px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'standard_size_h',
								'label' => 'Max Height',
								'default' => '9999px',
								'type' => 'positive_pixel',
							),
						),
					),
					array(
						'id' => 'big_size',
						'title' => 'Big Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'big_size_w',
								'label' => 'Max Width',
								'default' => '800px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'big_size_h',
								'label' => 'Max Height',
								'default' => '9999px',
								'type' => 'positive_pixel',
							),
						),
					),
					array(
						'id' => 'fixedheight_size',
						'title' => 'Fixed Height Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'fixedheight_size_w',
								'label' => 'Max Width',
								'default' => '9999px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'fixedheight_size_h',
								'label' => 'Max Height',
								'default' => '500px',
								'type' => 'positive_pixel',
							),
						),
					),
					array(
						'id' => 'carousel_size',
						'title' => 'Carousel Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'carousel_size_w',
								'label' => 'Max Width',
								'default' => '400px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'carousel_size_h',
								'label' => 'Max Height',
								'default' => '285px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'carousel_crop',
								'label' => 'Crop to exact dimensions',
								'default' => '1',
								'description' => '',
								'type' => 'checkbox',
							),
						),
					),
					array(
						'id' => 'slider_size',
						'title' => 'Slider Size',
						'description' => '',
						'group' => array(
							array(
								'option_name' => 'slider_size_w',
								'label' => 'Max Width',
								'default' => '1200px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'slider_size_h',
								'label' => 'Max Height',
								'default' => '500px',
								'type' => 'positive_pixel',
							),
							array(
								'option_name' => 'slider_crop',
								'label' => 'Crop to exact dimensions',
								'default' => '1',
								'description' => '',
								'type' => 'checkbox',
							),
						),
					),
				),
			),
		),
	);
 */
	return $theme_options;
}
add_filter( 'wc_shortcodes_theme_options', 'wc_shortcodes_theme_options', 10, 1 );
