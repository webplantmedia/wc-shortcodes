<?php
class WPC_Shortcodes_Slide_Post_Type {
	
	protected static $instance = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		/* Register custom post types on the 'init' hook. */
		add_action( 'init', array( &$this, 'register_post_types' ) );

		/* Register taxonomies on the 'init' hook. */
		add_action( 'init', array( &$this, 'register_taxonomies' ) );

		add_action( 'save_post', array( &$this, 'save_meta' ), 1, 2 ); // save the custom fields

		add_action( 'add_meta_boxes', array( &$this, 'slide_metabox' ) );
		// add_action('do_meta_boxes', array( &$this, 'replace_featured_image_box' ) );
	}

	function replace_featured_image_box() {
		remove_meta_box( 'postimagediv', 'wcs_slide', 'side' );
		add_meta_box('postimagediv', __('Slide Image'), 'post_thumbnail_meta_box', 'wcs_slide', 'side', 'low');
	}

	/**
	 * Registers post types needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function register_post_types() {

		/* Set up the arguments for the slider item post type. */
		$args = array(
			'description'         => '',
			'public'              => false,
			'publicly_queryable'  => false,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 11,
			'menu_icon'           => 'dashicons-images-alt2',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => false,
			'has_archive'         => false,
			'query_var'           => false,
			'register_meta_box_cb' => array( &$this, 'slide_metabox' ),

			/* The rewrite handles the URL structure. */
			'rewrite' => false, 

			/* What features the post type supports. */
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
			),

			/* Labels used when displaying the posts. */
			'labels' => array(
				'name'               => __( 'Slider Items',                   'wc-shortcodes' ),
				'singular_name'      => __( 'Slider Item',                    'wc-shortcodes' ),
				'menu_name'          => __( 'Slider',                         'wc-shortcodes' ),
				'name_admin_bar'     => __( 'Slider Item',                    'wc-shortcodes' ),
				'add_new'            => __( 'Add New',                        'wc-shortcodes' ),
				'add_new_item'       => __( 'Add New Slider Item',            'wc-shortcodes' ),
				'edit_item'          => __( 'Edit Slider Item',               'wc-shortcodes' ),
				'new_item'           => __( 'New Slider Item',                'wc-shortcodes' ),
				'view_item'          => __( 'View Slider Item',               'wc-shortcodes' ),
				'search_items'       => __( 'Search Slider',                  'wc-shortcodes' ),
				'not_found'          => __( 'No slider items found',          'wc-shortcodes' ),
				'not_found_in_trash' => __( 'No slider items found in trash', 'wc-shortcodes' ),
				'all_items'          => __( 'Slider Items',                   'wc-shortcodes' ),

				// Custom labels b/c WordPress doesn't have anything to handle this.
				'archive_title'      => __( 'Slider',                         'wc-shortcodes' ),
			)
		);

		/* Register the slider item post type. */
		register_post_type( 'wcs_slide', $args );
	}

	/**
	 * Register taxonomies for the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void.
	 */
	public function register_taxonomies() {

		/* Set up the arguments for the slider taxonomy. */
		$args = array(
			'public'            => false,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'query_var'         => false,

			/* The rewrite handles the URL structure. */
			'rewrite' => false,

			/* Labels used when displaying taxonomy and terms. */
			'labels' => array(
				'name'                       => __( 'Slider Categories',                 'wc-shortcodes' ),
				'singular_name'              => __( 'Slider Category',                   'wc-shortcodes' ),
				'menu_name'                  => __( 'Categories',                           'wc-shortcodes' ),
				'name_admin_bar'             => __( 'Slider Category',                   'wc-shortcodes' ),
				'search_items'               => __( 'Search Slider Categories',          'wc-shortcodes' ),
				'popular_items'              => __( 'Popular Slider Categories',         'wc-shortcodes' ),
				'all_items'                  => __( 'All Slider Categories',             'wc-shortcodes' ),
				'edit_item'                  => __( 'Edit Slider Category',              'wc-shortcodes' ),
				'view_item'                  => __( 'View Slider Category',              'wc-shortcodes' ),
				'update_item'                => __( 'Update Slider Category',            'wc-shortcodes' ),
				'add_new_item'               => __( 'Add New Slider Category',           'wc-shortcodes' ),
				'new_item_name'              => __( 'New Slider Category Name',          'wc-shortcodes' ),
				'separate_items_with_commas' => __( 'Separate slider categories with commas', 'wc-shortcodes' ),
				'add_or_remove_items'        => __( 'Add or remove slider categories',    'wc-shortcodes' ),
				'choose_from_most_used'      => __( 'Choose from the most used slider categories', 'wc-shortcodes' ),
			)
		);

		/* Register the 'slider' taxonomy. */
		register_taxonomy( 'wcs_slide_cat', array( 'wcs_slide' ), $args );

		/* Set up the arguments for the slider taxonomy. */
		$args = array(
			'public'            => false,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
			'show_admin_column' => true,
			'hierarchical'      => false,
			'query_var'         => 'slider_tag',

			/* The rewrite handles the URL structure. */
			'rewrite' => false,

			/* Labels used when displaying taxonomy and terms. */
			'labels' => array(
				'name'                       => __( 'Slider Tags',                            'wc-shortcodes' ),
				'singular_name'              => __( 'Slider Tag',                             'wc-shortcodes' ),
				'menu_name'                  => __( 'Tags',                                   'wc-shortcodes' ),
				'name_admin_bar'             => __( 'Slider Tag',                             'wc-shortcodes' ),
				'search_items'               => __( 'Search Slider Tags',                     'wc-shortcodes' ),
				'popular_items'              => __( 'Popular Slider Tags',                    'wc-shortcodes' ),
				'all_items'                  => __( 'All Slider Tags',                        'wc-shortcodes' ),
				'edit_item'                  => __( 'Edit Slider Tag',                        'wc-shortcodes' ),
				'view_item'                  => __( 'View Slider Tag',                        'wc-shortcodes' ),
				'update_item'                => __( 'Update Slider Tag',                      'wc-shortcodes' ),
				'add_new_item'               => __( 'Add New Slider Tag',                     'wc-shortcodes' ),
				'new_item_name'              => __( 'New Slider Tag Name',                    'wc-shortcodes' ),
				'separate_items_with_commas' => __( 'Separate slider tags with commas',       'wc-shortcodes' ),
				'add_or_remove_items'        => __( 'Add or remove slider tags',              'wc-shortcodes' ),
				'choose_from_most_used'      => __( 'Choose from the most used slider tags',  'wc-shortcodes' ),
			)
		);

		/* Register the 'slider' taxonomy. */
		register_taxonomy( 'wcs_slide_tag', array( 'wcs_slide' ), $args );
	}

	public function save_meta($post_id, $post) {
		
		if ( ! isset( $_POST['slidedetails_noncename'] ) ) {
			return;
		}

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( ! wp_verify_nonce( $_POST['slidedetails_noncename'], plugin_basename(__FILE__) )) {
			return $post->ID;
		}

		// Is the user allowed to edit the post or page?
		if ( !current_user_can( 'edit_post', $post->ID ))
			return $post->ID;

		// OK, we're authenticated: we need to find and save the data
		// We'll put it into an array to make it easier to loop though.
		
		$meta['_wc_shortcodes_slide_url'] = esc_url_raw( $_POST['_wc_shortcodes_slide_url'] );
		
		// Add values of $events_meta as custom fields
		
		foreach ( $meta as $key => $value ) { // Cycle through the $events_meta array!
			if( $post->post_type == 'revision' ) {
				// Don't store custom data twice
				return;
			}

			// $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)

			if ( get_post_meta( $post->ID, $key, false ) ) {
				// If the custom field already has a value
				update_post_meta( $post->ID, $key, $value );
			} else {
				// If the custom field doesn't have a value
				add_post_meta( $post->ID, $key, $value );
			}
			if( ! $value ) {
				delete_post_meta( $post->ID, $key ); // Delete if blank
			}
		}

	}

	public function slide_details() {
		global $post;
		
		// Noncename needed to verify where the data originated
		echo '<input type="hidden" name="slidedetails_noncename" id="slidedetails_noncename" value="' .  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
		
		// Get the location data if its already been entered
		$url = get_post_meta($post->ID, '_wc_shortcodes_slide_url', true);
		
		echo '<p><strong>Enter URL:</strong></p>';
		echo '<input type="text" name="_wc_shortcodes_slide_url" value="' . $url  . '" class="widefat" />';
	}

	public function slide_metabox() {
		add_meta_box('wc-shortcodes-slide-metabox', 'Slide Details', array( &$this, 'slide_details' ), 'wcs_slide', 'normal', 'high');
	}
}
