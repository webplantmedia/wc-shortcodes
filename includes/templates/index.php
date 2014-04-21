<?php
$blog_use_excerpt = true;
$post_format = get_post_format();
if ( $blog_use_excerpt ) {
	if ( empty( $post_format ) ) {
		$post_format = 'excerpt';
	}
}

$classes = wc_shortcodes_display_term_classes( $atts['taxonomy'] );

switch( $post_format ) {
	case 'excerpt' :
		include( 'content-excerpt.php' );
		break;
	case 'aside' :
		include( 'content-aside.php' );
		break;
	case 'link' :
		include( 'content-link.php' );
		break;
	case 'chat' :
		include( 'content-chat.php' );
		break;
	case 'audio' :
		include( 'content-audio.php' );
		break;
	case 'video' :
		include( 'content-video.php' );
		break;
	case 'quote' :
		include( 'content-quote.php' );
		break;
	case 'gallery' :
		// wp_enqueue_script('wc-shortcodes-slider');
		include( 'content-gallery.php' );
		break;
	default :
		include( 'content.php' );
}
?>
