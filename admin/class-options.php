<?php
class WPC_Shortcodes_Options extends WPC_Shortcodes_Vars {
	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		add_filter( 'wc_shortcodes_wpcsf_options', array( &$this, 'set_options' ), 10, 1 );
		add_filter( 'wc_shortcodes_wpcsf_theme_support', array( &$this, 'wpcsf_theme_support' ), 10, 1 );
	}

	public function set_options( $options ) {
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
									'selection' => parent::$social_icons,
									'default' => $this->set_default_order_show_hide_type( parent::$theme_support[ 'social_icons_selected' ], parent::$social_icons ),
									'description' => '',
									'type' => 'order_show_hide',
									'callback' => array( &$this, 'sanitize_social_icons' ),
								),
								array(
									'option_name' => 'social_icons_format',
									'title' => 'Default Format',
									'default' => parent::$theme_support['social_icons_format'],
									'description' => 'This option can be overwritten through a social media shortcode option, or through a social media widget option. So if your social icon format does not change, check your widget and shortcode options.',
									'type' => 'dropdown',
									'options' => array(
										'icon' => 'Icon',
										'small_image' => 'Small Image',
										'medium_image' => 'Medium Image',
										'image' => 'Large Image',
									),
									'theme_reset' => true,
								),
							),
						),
						array(
							'id' => 'wc-shortcodes-options-social-media-configure-section',
							'add_section' => true,
							'title' => 'Customize',
							'options' => $this->get_social_icons_options(),
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
									'selection' => parent::$share_buttons,
									'default' => $this->set_default_order_show_hide_type( parent::$theme_support[ 'share_buttons_selected' ], parent::$share_buttons ),
									'description' => '',
									'type' => 'order_show_hide',
									'callback' => array( &$this, 'sanitize_share_buttons' ),
								),
								array(
									'option_name' => 'share_buttons_format',
									'title' => 'Format',
									'default' => parent::$theme_support['share_buttons_format'],
									'description' => '',
									'type' => 'dropdown',
									'options' => array(
										'icon' => 'Icon',
										'small_image' => 'Small Image',
										'medium_image' => 'Medium Image',
										'image' => 'Large Image',
										'icon-text' => 'Icon + Text',
										'text' => 'Text',
									),
									'theme_reset' => true,
								),
								array(
									'option_name' => 'share_buttons_on_post_page',
									'title' => 'Post Page',
									'default' => parent::$theme_support['share_buttons_on_post_page'],
									'description' => '',
									'label' => 'Add share buttons to the bottom of your post pages',
									'type' => 'checkbox',
									'theme_reset' => true,
									'hide' => parent::$theme_support['share_buttons_filter_disable'],
								),
								array(
									'option_name' => 'share_buttons_on_blog_page',
									'title' => 'Blog Page',
									'default' => parent::$theme_support['share_buttons_on_blog_page'],
									'description' => '',
									'label' => 'Add share buttons to the bottom of your posts in your blog',
									'type' => 'checkbox',
									'theme_reset' => true,
									'hide' => parent::$theme_support['share_buttons_filter_disable'],
								),
								array(
									'option_name' => 'share_buttons_on_archive_page',
									'title' => 'Archive Page',
									'default' => parent::$theme_support['share_buttons_on_archive_page'],
									'description' => '',
									'label' => 'Add share buttons to the bottom of your posts in your category, tag, date, and author archive pages.',
									'type' => 'checkbox',
									'theme_reset' => true,
									'hide' => parent::$theme_support['share_buttons_filter_disable'],
								),
								array(
									'option_name' => 'share_buttons_on_product_page',
									'title' => 'Product Page',
									'default' => parent::$theme_support['share_buttons_on_product_page'],
									'description' => '',
									'label' => 'Add share buttons to the bottom of your WooCommerce product page.',
									'type' => 'checkbox',
									'theme_reset' => true,
									'hide' => parent::$theme_support['share_buttons_filter_disable'],
								),
							),
						),
						array(
							'id' => 'wc-shortcodes-options-share-buttons-configure-section',
							'add_section' => true,
							'title' => 'Customize',
							'options' => $this->get_share_buttons_options(),
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
					'id' => 'wc-shortcodes-options-google-maps-options-tab',
					'title' => 'Maps',
					'sections' => array(
						array(
							'id' => 'wc-shortcodes-options-google-maps-section',
							'title' => 'Google Maps',
							'add_section' => true,
							'options' => array(
								array(
									'option_name' => 'google_maps_api_key',
									'title' => 'Google Maps API Key',
									'default' => '',
									'description' => 'Google requires an <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">API key</a> to embed Google Maps.',
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
									'label' => 'Use shortcode CSS provided by plugin.',
									'type' => 'checkbox',
									'theme_reset' => true,
								),
								array(
									'option_name' => 'enable_font_awesome',
									'title' => 'FontAwesome',
									'default' => '1',
									'description' => '',
									'label' => 'Use FontAwesome icons provided by plugin.',
									'type' => 'checkbox',
									'theme_reset' => true,
								),
								array(
									'option_name' => 'enable_slide_post_type',
									'title' => 'Slide Post Type',
									'default' => '1',
									'description' => '',
									'label' => 'Create custom slides to use with our <code>[wc_post_slider]</code> shortcode.',
									'type' => 'checkbox',
									'theme_reset' => true,
								),
								array(
									'option_name' => 'enable_collage_post_type',
									'title' => 'Collage Post Type',
									'default' => '1',
									'description' => '',
									'label' => 'Create custom collages to use with our <code>[wc_collage]</code> shortcode.',
									'type' => 'checkbox',
									'theme_reset' => true,
								),
							),
						),
					),
				),
			),
		);

		return $options;
	}

	public function wpcsf_theme_support() {
		return parent::$theme_support;
	}

	private function get_share_buttons_options() {
		$options = array();
		foreach ( parent::$share_buttons as $key => $value ) {
			$options[] = array(
				'id' => $key . '-share',
				'title' => $value,
				'description' => '',
				'group' => array(
					array(
						'option_name' => $key . '_share_text',
						'label' => 'Share Text',
						'default' => parent::$theme_support[ $key . '_share_text'],
						'description' => '',
						'type' => 'input',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_share_font_icon',
						'label' => 'Font Icon',
						'default' => parent::$theme_support[ $key . '_share_font_icon'],
						'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
						'type' => 'input',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_small_share_icon',
						'label' => 'Small Image Icon',
						'default' => parent::$theme_support[ $key . '_small_share_button'],
						'description' => '',
						'type' => 'image',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_medium_share_icon',
						'label' => 'Medium Image Icon',
						'default' => parent::$theme_support[ $key . '_medium_share_button'],
						'description' => '',
						'type' => 'image',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_share_icon',
						'label' => 'Large Image Icon',
						'default' => parent::$theme_support[ $key . '_share_button'],
						'description' => '',
						'type' => 'image',
						'theme_reset' => true,
					),
				),
			);
		}

		return $options;
	}

	private function get_social_icons_options() {
		$options = array();
		foreach ( parent::$social_icons as $key => $value ) {
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
						'default' => parent::$theme_support[ $key . '_font_icon'],
						'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See All Icons</a>',
						'type' => 'input',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_small_icon',
						'label' => 'Small Image Icon',
						'default' => parent::$theme_support[ $key . '_small_social_icon'],
						'description' => '',
						'type' => 'image',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_medium_icon',
						'label' => 'Medium Image Icon',
						'default' => parent::$theme_support[ $key . '_medium_social_icon'],
						'description' => '',
						'type' => 'image',
						'theme_reset' => true,
					),
					array(
						'option_name' => $key . '_icon',
						'label' => 'Large Image Icon',
						'default' => parent::$theme_support[ $key . '_social_icon'],
						'description' => '',
						'type' => 'image',
						'theme_reset' => true,
					),
				),
			);
		}

		return $options;
	}

	public function sanitize_share_buttons( $value ) {

		$whitelist = parent::$share_buttons;

		$valid = array();

		if ( ! is_array( $value ) || empty( $value ) )
			return null;

		foreach ( $value as $k => $v ) {
			if ( array_key_exists( $k, $whitelist ) )
				$valid[ $k ] = $v;
		}

		return $valid;
	}

	public function sanitize_social_icons( $value ) {

		$whitelist = parent::$social_icons;

		$valid = array();

		if ( ! is_array( $value ) || empty( $value ) )
			return null;

		foreach ( $value as $k => $v ) {
			if ( array_key_exists( $k, $whitelist ) )
				$valid[ $k ] = $v;
		}

		return $valid;
	}

	private function set_default_order_show_hide_type( $selected, $default ) {
		if ( isset( $selected ) && is_array( $selected ) && ! empty( $selected ) ) {
			$new_order = array();

			foreach( $selected as $index => $key_name ) {
				if ( array_key_exists( $key_name, $default ) ) {
					$new_order[ $key_name ] = $default[ $key_name ];
					unset( $default[ $key_name ] );
				}
			}

			if ( ! empty( $new_order ) ) {
				return $new_order;
			}
		}

		return $default;
	}
}
