<?php
class WPC_Shortcodes_Ajax {
	protected static $instance = null;

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'wp_ajax_wc_post_lookup', array( &$this, 'post_lookup_callback' ) );
		add_action( 'wp_ajax_wc_attachment_lookup', array( &$this, 'attachment_lookup_callback' ) );
		add_action( 'wp_ajax_wc_terms_lookup', array( &$this, 'terms_lookup_callback' ) );
		add_action( 'wp_ajax_wc_mce_popup', array( &$this, 'mce_popup' ) );
	}

	public function post_lookup_callback() {
		global $wpdb; //get access to the WordPress database object variable

		//get names of all businesses
		$request = '%' . $wpdb->esc_like( stripslashes( sanitize_text_field( $_POST['request'] ) ) ) . '%'; //escape for use in LIKE statement
		$post_type = stripslashes( sanitize_text_field( $_POST['post_type'] ) );

		$sql = "
			select
				ID,
				post_title
			from
				$wpdb->posts
			where
				post_title like %s
				and post_type='%s'
				and post_status='publish'
			order by
				post_title ASC
			limit
				0,30
		";

		$sql = $wpdb->prepare($sql, $request, $post_type);

		$results = $wpdb->get_results($sql);

		//copy the business titles to a simple array
		$titles = array();
		$i = 0;
		foreach( $results as $r ) {
			$titles[ $i ][ 'label' ] = $r->post_title . " (" . $r->ID . ")";
			$titles[ $i ][ 'value' ] = $r->ID;
			$i++;
		}

		if ( empty( $titles ) ) {
			$titles[0]['label'] = "No results found in post type \"$post_type\".";
			$titles[0]['value'] = "0";
		}
			
		echo json_encode($titles); //encode into JSON format and output

		die(); //stop "0" from being output
	}

	public function attachment_lookup_callback() {
		global $wpdb; //get access to the WordPress database object variable

		//get names of all businesses
		$request = '%' . $wpdb->esc_like( stripslashes( sanitize_text_field( $_POST['request'] ) ) ) . '%'; //escape for use in LIKE statement
		$post_type = 'attachment';
		$post_status = 'inherit';

		$sql = "
			select
				ID,
				post_title
			from
				$wpdb->posts
			where
				post_title like %s
				and post_type='%s'
				and post_status='%s'
			order by
				post_title ASC
			limit
				0,30
		";

		$sql = $wpdb->prepare( $sql, $request, $post_type, $post_status );

		$results = $wpdb->get_results($sql);

		//copy the business titles to a simple array
		$titles = array();
		$i = 0;
		foreach( $results as $r ) {
			$titles[ $i ][ 'label' ] = $r->post_title . " (" . $r->ID . ")";
			$titles[ $i ][ 'value' ] = $r->ID;
			$i++;
		}

		if ( empty( $titles ) ) {
			$titles[0]['label'] = "No results found in post type \"$post_type\".";
			$titles[0]['value'] = "0";
		}
			
		echo json_encode($titles); //encode into JSON format and output

		die(); //stop "0" from being output
	}

	public function terms_lookup_callback() {
		global $wpdb; //get access to the WordPress database object variable

		//get names of all businesses
		$request = '%' . $wpdb->esc_like( stripslashes( sanitize_text_field( $_POST['request'] ) ) ) . '%'; //escape for use in LIKE statement
		$post_type = stripslashes( sanitize_text_field( $_POST['post_type'] ) );
		$taxonomy = stripslashes( sanitize_text_field( $_POST['taxonomy'] ) );

		if ( empty( $taxonomy ) ) {
			$titles = array();
			$titles[0]['label'] = "Please select a taxonomy.";
			$titles[0]['value'] = "0";
			
			echo json_encode($titles); //encode into JSON format and output

			die(); //stop "0" from being output
		}

		$sql = "
			SELECT
				t.slug,
				t.slug
			FROM $wpdb->terms AS t 
			INNER JOIN $wpdb->term_taxonomy AS tt ON (tt.term_id = t.term_id) 
			INNER JOIN $wpdb->term_relationships AS tr ON (tr.term_taxonomy_id = tt.term_taxonomy_id) 
			WHERE t.slug like %s 
				AND tt.taxonomy IN ('%s')
			GROUP BY
				t.slug
			ORDER BY
				t.name ASC
			limit
				0,30
		";

		$sql = $wpdb->prepare($sql, $request, $taxonomy);

		$results = $wpdb->get_results($sql);

		//copy the business titles to a simple array
		$titles = array();
		$i = 0;
		foreach( $results as $r ) {
			$titles[ $i ]['label'] = $r->slug;
			$titles[ $i ]['value'] = $r->slug;
			$i++;
		}
		
		if ( empty( $titles ) ) {
			$titles[0]['label'] = "No results found in selected taxonomy \"$taxonomy\".";
			$titles[0]['value'] = "0";
		}
			
		echo json_encode($titles); //encode into JSON format and output

		die(); //stop "0" from being output
	}

	public function mce_popup() {

		// no need to sanitize here.
		$tag = $_POST['tag'];
		$shortcode = stripslashes( $_POST['shortcode'] );

		$attr = $this->parse_shortcode( $tag, $shortcode );
		$attr['wc_shortcodes_using_visual_manager'] = 1;
		
		switch ( $tag ) {
			case 'wc_accordion' :
				$widget = new WPC_Shortcodes_Widget_Accordion_Main();
				$widget->form( $attr );
				break;
			case 'wc_accordion_section' :
				$widget = new WPC_Shortcodes_Widget_Accordion_Section();
				$widget->form( $attr );
				break;
			case 'wc_tabgroup' :
				$widget = new WPC_Shortcodes_Widget_Tabgroup();
				$widget->form( $attr );
				break;
			case 'wc_tab' :
				$widget = new WPC_Shortcodes_Widget_Tab();
				$widget->form( $attr );
				break;
			case 'wc_toggle' :
				$widget = new WPC_Shortcodes_Widget_Toggle();
				$widget->form( $attr );
				break;
			case 'wc_clear_floats' :
			case 'wc_row' :
				echo 0;
				die();
				break;
			case 'wc_column' :
				$widget = new WPC_Shortcodes_Widget_Column();
				$widget->form( $attr );
				break;
			case 'wc_spacing' :
				$widget = new WPC_Shortcodes_Widget_Spacing();
				$widget->form( $attr );
				break;
			case 'wc_button' :
				$widget = new WPC_Shortcodes_Widget_Button();
				$widget->form( $attr );
				break;
			case 'wc_pricing' :
				$widget = new WPC_Shortcodes_Widget_Pricing();
				$widget->form( $attr );
				break;
			case 'wc_skillbar' :
				$widget = new WPC_Shortcodes_Widget_Skillbar();
				$widget->form( $attr );
				break;
			case 'wc_social_icons' :
				$widget = new WPC_Shortcodes_Widget_Social_Icons();
				$widget->form( $attr );
				break;
			case 'wc_share_buttons' :
				$widget = new WPC_Shortcodes_Widget_Share_Buttons();
				$widget->form( $attr );
				break;
			case 'wc_testimonial' :
				$widget = new WPC_Shortcodes_Widget_Testimonial();
				$widget->form( $attr );
				break;
			case 'wc_image' :
				$widget = new WPC_Shortcodes_Widget_Image();
				$widget->form( $attr );
				break;
			case 'wc_call_to_action' :
				$widget = new WPC_Shortcodes_Widget_Call_To_Action();
				$widget->form( $attr );
				break;
			case 'wc_image_links' :
				$widget = new WPC_Shortcodes_Widget_Image_Links();
				$widget->form( $attr );
				break;
			case 'wc_fa' :
				$widget = new WPC_Shortcodes_Widget_FA();
				$widget->form( $attr );
				break;
			case 'wc_googlemap' :
				$widget = new WPC_Shortcodes_Widget_GoogleMap();
				$widget->form( $attr );
				break;
			case 'wc_countdown' :
				$widget = new WPC_Shortcodes_Widget_Countdown();
				$widget->form( $attr );
				break;
			case 'wc_rsvp' :
				$widget = new WPC_Shortcodes_Widget_RSVP();
				$widget->form( $attr );
				break;
			case 'wc_html' :
				$widget = new WPC_Shortcodes_Widget_HTML();
				$widget->form( $attr );
				break;
			case 'wc_box' :
				$widget = new WPC_Shortcodes_Widget_Box();
				$widget->form( $attr );
				break;
			case 'wc_highlight' :
				$widget = new WPC_Shortcodes_Widget_Highlight();
				$widget->form( $attr );
				break;
			case 'wc_divider' :
				$widget = new WPC_Shortcodes_Widget_Divider();
				$widget->form( $attr );
				break;
			case 'wc_pre' :
				$widget = new WPC_Shortcodes_Widget_Pre();
				$widget->form( $attr );
				break;
			case 'wc_center' :
				$widget = new WPC_Shortcodes_Widget_Center();
				$widget->form( $attr );
				break;
			case 'wc_fullwidth' :
				$widget = new WPC_Shortcodes_Widget_FullWidth();
				$widget->form( $attr );
				break;
			case 'wc_heading' :
				$widget = new WPC_Shortcodes_Widget_Heading();
				$widget->form( $attr );
				break;
			case 'wc_post_slider' :
				$widget = new WPC_Shortcodes_Widget_Post_Slider();
				$widget->form( $attr );
				break;
			case 'wc_collage' :
				$widget = new WPC_Shortcodes_Widget_Collage();
				$widget->form( $attr );
				break;
			case 'wc_posts' :
				$widget = new WPC_Shortcodes_Widget_Posts();
				$widget->form( $attr );
				break;
		}

		die();
	}

	private function parse_shortcode( $check_tag, $content ) {
		// Some shortcodes are not commonly registered. Need to be able to parse them.
		// global $shortcode_tags;

		if ( false === strpos( $content, '[' ) ) {
			return false;
		}

		/*
		if (empty($shortcode_tags) || !is_array($shortcode_tags))
			return false;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		 */

		$tagnames = array( $check_tag );

		if ( empty( $tagnames ) ) {
			return false;
		}

		$pattern = get_shortcode_regex( $tagnames );
		preg_match( "/$pattern/", $content, $m );

		// allow [[foo]] syntax for escaping a tag
		if ( $m[1] == '[' && $m[6] == ']' ) {
			return substr($m[0], 1, -1);
		}

		$tag = $m[2];
		
		if ( $tag != $check_tag )
			return false;

		$attr = shortcode_parse_atts( $m[3] );

		return $attr;
	}
}
