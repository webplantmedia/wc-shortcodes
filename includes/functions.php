<?php
/**
 * filter social url. For example, we want to add
 * mailto: to an email address.
 * 
 * @access public
 * @return void
 */
function wc_shortcodes_smart_social_link( $social_link, $name ) {
	switch ( $name ) {
		case 'email' :
			// some users may have already inserted mailto:, so let's remove it.
			if ( is_email( $social_link ) ) {
				$social_link = str_replace( 'mailto:', '', $social_link );
				$social_link = 'mailto:'.$social_link;
			}
			break;
		default :
			$social_link = esc_url( $social_link );
			break;
	}

	return $social_link;
}
add_filter( 'wc_shortcodes_social_link' , 'wc_shortcodes_smart_social_link', 10, 2 );

function wc_shortcodes_default_social_icons() {
	global $wc_shortcodes_social_icons;

	$default = $wc_shortcodes_social_icons;

	foreach ( $wc_shortcodes_social_icons as $key => $value ) {
		$link_option_name = WC_SHORTCODES_PREFIX . $key . '_link';
		$icon_option_name = WC_SHORTCODES_PREFIX . $key . '_icon';

		if (  $icon_url = get_option( $icon_option_name ) ) {
			$social_link = get_option( $link_option_name );

			if ( empty( $social_link ) )
				unset( $default[ $key ] );
		}
	}

	if ( empty( $default ) ) {
		$default = $wc_shortcodes_social_icons;
	}

	return $default;
}

if ( ! function_exists( 'wc_shortcodes_display_term_classes' ) ) {
	function wc_shortcodes_display_term_classes( $taxonomy ) {
		global $post;

		$classes = array();

		if ( is_object_in_taxonomy( $post->post_type, $taxonomy ) ) {
			foreach ( (array) wp_get_post_terms( $post->ID, $taxonomy ) as $term ) {
				if ( empty( $term->slug ) )
					continue;
				$classes[] = 'wc-shortcodes-filter-' . sanitize_html_class($term->slug, $term->term_id);
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'wc_shortcodes_comma_delim_to_array' ) ) {
	function wc_shortcodes_comma_delim_to_array( $string ) {
		$a = explode( ',', $string );

		foreach ( $a as $key => $value ) {
			$value = trim( $value );

			if ( empty( $value ) )
				unset( $a[ $key ] );
			else
				$a[ $key ] = $value;
		}

		if ( empty( $a ) )
			return '';
		else
			return $a;
	}
}

function wc_shortcodes_body_class( $classes ) {
	if ( WC_SHORTCODES_FONT_AWESOME_ENABLED )
		$classes[] = 'wc-shortcodes-font-awesome-enabled';

	return $classes;
}
add_filter( 'body_class', 'wc_shortcodes_body_class' );

function wc_shortcodes_add_filters_for_custom_content() {
	add_filter( 'wc_shortcodes_the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
	add_filter( 'wc_shortcodes_the_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
	add_filter( 'wc_shortcodes_the_content', 'wptexturize' );
	add_filter( 'wc_shortcodes_the_content', 'convert_smilies' );
	add_filter( 'wc_shortcodes_the_content', 'convert_chars' );
	add_filter( 'wc_shortcodes_the_content', 'wpautop' );
	add_filter( 'wc_shortcodes_the_content', 'shortcode_unautop' );
	add_filter( 'wc_shortcodes_the_content', 'prepend_attachment' );
	add_filter( 'wc_shortcodes_the_content', 'do_shortcode', 11 ); // AFTER wpautop()

	add_filter( 'wc_shortcodes_get_the_excerpt', 'wc_shortcodes_wp_trim_excerpt'  );

	add_filter( 'wc_shortcodes_the_excerpt', 'wptexturize' );
	add_filter( 'wc_shortcodes_the_excerpt', 'convert_smilies' );
	add_filter( 'wc_shortcodes_the_excerpt', 'convert_chars' );
	add_filter( 'wc_shortcodes_the_excerpt', 'wpautop' );
	add_filter( 'wc_shortcodes_the_excerpt', 'shortcode_unautop');
}
add_action( 'init', 'wc_shortcodes_add_filters_for_custom_content' );

function wc_shortcodes_the_media_content( $more_link_text = null, $strip_teaser = false ) {
	$content = get_the_content( $more_link_text, $strip_teaser );

	$pieces = explode( "\n", $content );

	$content = '';

	foreach ( $pieces as $line ) {
		if ( empty( $line ) ) {
			continue;
		}

		if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $line ) ) {
			$content = $line;
			break;
		}
		else if ( has_shortcode( $line, 'audio' ) ) {
			$content = $line;
			break;
		}
		else if ( has_shortcode( $line, 'video' ) ) {
			$content = $line;
			break;
		}
	}

	/**
	 * Filter the post content.
	 *
	 * @since 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$content = apply_filters( 'wc_shortcodes_the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	echo $content;
}

function wc_shortcodes_the_content( $more_link_text = null, $strip_teaser = false ) {
	$content = get_the_content( $more_link_text, $strip_teaser );

	/**
	 * Filter the post content.
	 *
	 * @since 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$content = apply_filters( 'wc_shortcodes_the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	echo $content;
}

function wc_shortcodes_the_excerpt() {
	$excerpt = wc_shortcodes_get_the_excerpt();

	/**
	 * Filter the post content.
	 *
	 * @since 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$excerpt = apply_filters( 'wc_shortcodes_the_excerpt', $excerpt );
	echo $excerpt;
}

function wc_shortcodes_get_the_excerpt( $deprecated = '' ) {
	if ( !empty( $deprecated ) )
		_deprecated_argument( __FUNCTION__, '2.3' );

	$post = get_post();

	if ( post_password_required() ) {
		return __( 'There is no excerpt because this is a protected post.' );
	}

	/**
	 * Filter the retrieved post excerpt.
	 *
	 * @since 1.2.0
	 *
	 * @param string $post_excerpt The post excerpt.
	 */
	return apply_filters( 'wc_shortcodes_get_the_excerpt', $post->post_excerpt );
}

/**
 * Generates an excerpt from the content, if needed.
 *
 * The excerpt word amount will be 55 words and if the amount is greater than
 * that, then the string ' [&hellip;]' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as is.
 *
 * The 55 word limit can be modified by plugins/themes using the excerpt_length filter
 * The ' [&hellip;]' string can be modified by plugins/themes using the excerpt_more filter
 *
 * @since 1.5.0
 *
 * @param string $text Optional. The excerpt. If set to empty, an excerpt is generated.
 * @return string The excerpt.
 */
function wc_shortcodes_wp_trim_excerpt($text = '') {
	global $wc_shortcodes_posts_query;

	$excerpt_length = 55;
	if ( isset( $wc_shortcodes_posts_query->excerpt_length ) && ! empty( $wc_shortcodes_posts_query->excerpt_length ) ) {
	   $excerpt_length = (int) $wc_shortcodes_posts_query->excerpt_length;
	}

	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		/** This filter is documented in wp-includes/post-template.php */
		$text = apply_filters( 'wc_shortcodes_the_content', $text );
		$text = str_replace(']]>', ']]&gt;', $text);

		/**
		 * Filter the number of words in an excerpt.
		 *
		 * @since 2.7.0
		 *
		 * @param int $number The number of words. Default 55.
		 */
		$excerpt_length = apply_filters( 'wc_shortcodes_excerpt_length', $excerpt_length );
		/**
		 * Filter the string in the "more" link displayed after a trimmed excerpt.
		 *
		 * @since 2.9.0
		 *
		 * @param string $more_string The string shown within the more link.
		 */
		$excerpt_more = apply_filters( 'wc_shortcodes_excerpt_more', '&hellip;' );
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	/**
	 * Filter the trimmed excerpt string.
	 *
	 * @since 2.8.0
	 *
	 * @param string $text		  The trimmed text.
	 * @param string $raw_excerpt The text prior to trimming.
	 */
	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

function wc_shortcodes_echo_share_buttons() {
	$share = do_shortcode( '[wc_share_buttons]' );

	if ( ! empty( $share ) ) {
		echo $share;
	}
}
function wc_shortcodes_display_share_buttons( $content ) {
	global $wp_current_filter;

	$display = false;

	if ( is_single() && 'post' == get_post_type() ) {
		$display = true;
	}
	else if ( ( is_home() || is_archive() ) && 'post' == get_post_type() ) {
		$display = true;
	}
	// Don't output flair on excerpts
	if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) {
		$display = false;
	}

	if ( ! $display ) {
		return $content;
	}

	$share = do_shortcode( '[wc_share_buttons]' );
	$share = apply_filters( 'wc_shortcodes_display_share_buttons', $share );

	if ( empty( $share ) ) {
		return $content;
	}

	$content .= $share;

	return $content;
}
function wc_shortcodes_share_buttons_filters() {
	global $wc_shortcodes_theme_support;

	if ( $wc_shortcodes_theme_support[ 'share_buttons_filter_disable' ] ) {
		return;
	}

	$share_buttons_on_post_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_post_page' );
	$share_buttons_on_blog_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_blog_page' );
	$share_buttons_on_archive_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_archive_page' );
	$share_buttons_on_product_page = get_option( WC_SHORTCODES_PREFIX . 'share_buttons_on_product_page' );

	if ( $share_buttons_on_post_page ) {
		if ( is_single() && 'post' == get_post_type() ) {
			add_filter( 'the_content', 'wc_shortcodes_display_share_buttons', 38, 1 );
		}
	}

	if ( $share_buttons_on_blog_page ) {
		if ( is_home() ) {
			add_filter( 'the_content', 'wc_shortcodes_display_share_buttons', 38, 1 );
			// add_filter( 'the_excerpt', 'wc_shortcodes_display_share_buttons', 38, 1 );
		}
	}

	if ( $share_buttons_on_archive_page ) {
		if ( is_category() || is_tag() || is_author() || is_date() ) {
			add_filter( 'the_content', 'wc_shortcodes_display_share_buttons', 38, 1 );
			// add_filter( 'the_excerpt', 'wc_shortcodes_display_share_buttons', 38, 1 );
		}
	}

	if ( $share_buttons_on_product_page ) {
		add_action( 'woocommerce_single_product_summary', 'wc_shortcodes_echo_share_buttons', 99 );
	}

}
add_action( 'wp', 'wc_shortcodes_share_buttons_filters', 11 );

function wc_shortcodes_get_posted_category() {
	$html = null;
	$cats = get_the_category_list( ', ' );

	if ( ! empty( $cats ) ) {
		$html .= '<div class="wc-shortcodes-entry-category">';
			if ( ! empty( $cats ) ) {
				$html .= '<span class="wc-shortcodes-cat-posted-text">' . __( 'Posted in', 'wpcanvas2' ) . ' </span><span class="wc-shortcodes-post-in-cat-links">' . $cats . '</span>';
			}
		$html .= '</div>';
	}

	return $html;
}

