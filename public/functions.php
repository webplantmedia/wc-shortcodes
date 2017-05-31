<?php
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

function wc_shortcodes_get_the_content( $more_link_text = null, $strip_teaser = false ) {
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

	return $content;
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
