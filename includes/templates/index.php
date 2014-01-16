<?php
$blog_use_excerpt = true;
$post_format = get_post_format();
if ( $blog_use_excerpt ) {
	if ( empty( $post_format ) ) {
		$post_format = 'excerpt';
	}
}

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
	case 'quote' :
		include( 'content-quote.php' );
		break;
	case 'gallery' :
		wp_enqueue_script('wc-shortcodes-slider');
		include( 'content-gallery.php' );
		break;
	default :
		include( 'content.php' );
}
?>
