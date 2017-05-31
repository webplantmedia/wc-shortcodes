<?php
class WPC_Shortcodes_Collage_Post_Type {
	
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

		add_action( 'add_meta_boxes', array( &$this, 'collage_metabox' ) );
		// add_action('do_meta_boxes', array( &$this, 'replace_featured_image_box' ) );
	}

	function replace_featured_image_box() {
		remove_meta_box( 'postimagediv', 'wcs_collage', 'side' );
		add_meta_box('postimagediv', __('Background Image'), 'post_thumbnail_meta_box', 'wcs_collage', 'side', 'low');
	}

	/**
	 * Registers post types needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function register_post_types() {

		/* Set up the arguments for the collage item post type. */
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
			'register_meta_box_cb' => array( &$this, 'collage_metabox' ),

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
				'name'               => __( 'Collage Items',                   'wc-shortcodes' ),
				'singular_name'      => __( 'Collage Item',                    'wc-shortcodes' ),
				'menu_name'          => __( 'Collage',                         'wc-shortcodes' ),
				'name_admin_bar'     => __( 'Collage Item',                    'wc-shortcodes' ),
				'add_new'            => __( 'Add New',                        'wc-shortcodes' ),
				'add_new_item'       => __( 'Add New Collage Item',            'wc-shortcodes' ),
				'edit_item'          => __( 'Edit Collage Item',               'wc-shortcodes' ),
				'new_item'           => __( 'New Collage Item',                'wc-shortcodes' ),
				'view_item'          => __( 'View Collage Item',               'wc-shortcodes' ),
				'search_items'       => __( 'Search Collage',                  'wc-shortcodes' ),
				'not_found'          => __( 'No collage items found',          'wc-shortcodes' ),
				'not_found_in_trash' => __( 'No collage items found in trash', 'wc-shortcodes' ),
				'all_items'          => __( 'Collage Items',                   'wc-shortcodes' ),

				// Custom labels b/c WordPress doesn't have anything to handle this.
				'archive_title'      => __( 'Collage',                         'wc-shortcodes' ),
			)
		);

		/* Register the collage item post type. */
		register_post_type( 'wcs_collage', $args );
	}

	/**
	 * Register taxonomies for the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void.
	 */
	public function register_taxonomies() {

		/* Set up the arguments for the collage taxonomy. */
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
				'name'                       => __( 'Collage Categories',                 'wc-shortcodes' ),
				'singular_name'              => __( 'Collage Category',                   'wc-shortcodes' ),
				'menu_name'                  => __( 'Categories',                           'wc-shortcodes' ),
				'name_admin_bar'             => __( 'Collage Category',                   'wc-shortcodes' ),
				'search_items'               => __( 'Search Collage Categories',          'wc-shortcodes' ),
				'popular_items'              => __( 'Popular Collage Categories',         'wc-shortcodes' ),
				'all_items'                  => __( 'All Collage Categories',             'wc-shortcodes' ),
				'edit_item'                  => __( 'Edit Collage Category',              'wc-shortcodes' ),
				'view_item'                  => __( 'View Collage Category',              'wc-shortcodes' ),
				'update_item'                => __( 'Update Collage Category',            'wc-shortcodes' ),
				'add_new_item'               => __( 'Add New Collage Category',           'wc-shortcodes' ),
				'new_item_name'              => __( 'New Collage Category Name',          'wc-shortcodes' ),
				'separate_items_with_commas' => __( 'Separate collage categories with commas', 'wc-shortcodes' ),
				'add_or_remove_items'        => __( 'Add or remove collage categories',    'wc-shortcodes' ),
				'choose_from_most_used'      => __( 'Choose from the most used collage categories', 'wc-shortcodes' ),
			)
		);

		/* Register the 'collage' taxonomy. */
		register_taxonomy( 'wcs_collage_cat', array( 'wcs_collage' ), $args );

		/* Set up the arguments for the collage taxonomy. */
		$args = array(
			'public'            => false,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
			'show_admin_column' => true,
			'hierarchical'      => false,
			'query_var'         => 'collage_tag',

			/* The rewrite handles the URL structure. */
			'rewrite' => false,

			/* Labels used when displaying taxonomy and terms. */
			'labels' => array(
				'name'                       => __( 'Collage Tags',                            'wc-shortcodes' ),
				'singular_name'              => __( 'Collage Tag',                             'wc-shortcodes' ),
				'menu_name'                  => __( 'Tags',                                   'wc-shortcodes' ),
				'name_admin_bar'             => __( 'Collage Tag',                             'wc-shortcodes' ),
				'search_items'               => __( 'Search Collage Tags',                     'wc-shortcodes' ),
				'popular_items'              => __( 'Popular Collage Tags',                    'wc-shortcodes' ),
				'all_items'                  => __( 'All Collage Tags',                        'wc-shortcodes' ),
				'edit_item'                  => __( 'Edit Collage Tag',                        'wc-shortcodes' ),
				'view_item'                  => __( 'View Collage Tag',                        'wc-shortcodes' ),
				'update_item'                => __( 'Update Collage Tag',                      'wc-shortcodes' ),
				'add_new_item'               => __( 'Add New Collage Tag',                     'wc-shortcodes' ),
				'new_item_name'              => __( 'New Collage Tag Name',                    'wc-shortcodes' ),
				'separate_items_with_commas' => __( 'Separate collage tags with commas',       'wc-shortcodes' ),
				'add_or_remove_items'        => __( 'Add or remove collage tags',              'wc-shortcodes' ),
				'choose_from_most_used'      => __( 'Choose from the most used collage tags',  'wc-shortcodes' ),
			)
		);

		/* Register the 'collage' taxonomy. */
		register_taxonomy( 'wcs_collage_tag', array( 'wcs_collage' ), $args );
	}

	public function save_meta($post_id, $post) {
		
		if ( ! isset( $_POST['collagedetails_noncename'] ) ) {
			return;
		}

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( ! wp_verify_nonce( $_POST['collagedetails_noncename'], plugin_basename(__FILE__) )) {
			return $post->ID;
		}

		// Is the user allowed to edit the post or page?
		if ( !current_user_can( 'edit_post', $post->ID ))
			return $post->ID;

		// OK, we're authenticated: we need to find and save the data
		// We'll put it into an array to make it easier to loop though.
		
		$meta['_wc_shortcodes_collage_url'] = esc_url_raw( $_POST['_wc_shortcodes_collage_url'] );
		$meta['_wc_shortcodes_collage_text_color'] = WPC_Shortcodes_Sanitize::hex_color( $_POST['_wc_shortcodes_collage_text_color'] );
		$meta['_wc_shortcodes_collage_text_background_color'] = WPC_Shortcodes_Sanitize::hex_color( $_POST['_wc_shortcodes_collage_text_background_color'] );
		$meta['_wc_shortcodes_collage_text_background_opacity'] = WPC_Shortcodes_Sanitize::opacity( $_POST['_wc_shortcodes_collage_text_background_opacity'] );
		$meta['_wc_shortcodes_collage_text_max_width'] = WPC_Shortcodes_Sanitize::positive_number( $_POST['_wc_shortcodes_collage_text_max_width'] );
		$meta['_wc_shortcodes_collage_button_text'] = WPC_Shortcodes_Sanitize::text_field( $_POST['_wc_shortcodes_collage_button_text'] );
		$meta['_wc_shortcodes_collage_background_color'] = WPC_Shortcodes_Sanitize::hex_color( $_POST['_wc_shortcodes_collage_background_color'] );
		
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

	public function collage_details() {
		global $post;
		
		// Noncename needed to verify where the data originated
		echo '<input type="hidden" name="collagedetails_noncename" id="collagedetails_noncename" value="' .  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
		
		// Get the location data if its already been entered
		$url = get_post_meta($post->ID, '_wc_shortcodes_collage_url', true);
		$text_color = get_post_meta($post->ID, '_wc_shortcodes_collage_text_color', true);
		$text_background_color = get_post_meta($post->ID, '_wc_shortcodes_collage_text_background_color', true);
		$text_background_opacity = get_post_meta($post->ID, '_wc_shortcodes_collage_text_background_opacity', true);
		$text_max_width = get_post_meta($post->ID, '_wc_shortcodes_collage_text_max_width', true);
		$button_text = get_post_meta($post->ID, '_wc_shortcodes_collage_button_text', true);
		$background_color = get_post_meta($post->ID, '_wc_shortcodes_collage_background_color', true);
		
		?>
		<p><strong>URL:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_url" value="<?php echo $url; ?>" class="widefat" />
		<p class="description">Enter link this box should go to.</p>

		<p><strong>Text Color:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_text_color" value="<?php echo $text_color; ?>" class="widefat wpc-color-field" />
		<p class="description">Leave blank to use default theme colors.</p>

		<p><strong>Text Background Color:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_text_background_color" value="<?php echo $text_background_color; ?>" class="widefat wpc-color-field" />
		<p class="description">Leave blank if you want no test background color.</p>

		<p><strong>Text Background Opacity:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_text_background_opacity" value="<?php echo $text_background_opacity; ?>" class="widefat" />
		<p class="description">Enter decimal value from 0 to 1. Leave blank for no opacity.</p>

		<p><strong>Text Max Width:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_text_max_width" value="<?php echo $text_max_width; ?>" class="widefat" />
		<p class="description">Enter pixel value.</p>

		<p><strong>Button Text:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_button_text" value="<?php echo $button_text; ?>" class="widefat" />
		<p class="description">Leave blank if you do want to display a button.</p>

		<p><strong>Background Color:</strong></p>
		<input type="text" name="_wc_shortcodes_collage_background_color" value="<?php echo $background_color; ?>" class="widefat wpc-color-field" />
		<p class="description">Leave blank if you want no background color.</p>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('.wpc-color-field').each(function(){
					$(this).wpColorPicker();
				});
			});
			/* ]]> */
		</script>
		<?php
	}

	public function collage_metabox() {
		add_meta_box('wc-shortcodes-collage-metabox', 'Collage Details', array( &$this, 'collage_details' ), 'wcs_collage', 'normal', 'high');
	}
}
