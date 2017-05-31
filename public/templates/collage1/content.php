<?php
$url = get_post_meta($post->ID, '_wc_shortcodes_collage_url', true);
$text_color = get_post_meta($post->ID, '_wc_shortcodes_collage_text_color', true);
$text_background_color = get_post_meta($post->ID, '_wc_shortcodes_collage_text_background_color', true);
$text_background_opacity = get_post_meta($post->ID, '_wc_shortcodes_collage_text_background_opacity', true);
$text_max_width = get_post_meta($post->ID, '_wc_shortcodes_collage_text_max_width', true);
$button_text = get_post_meta($post->ID, '_wc_shortcodes_collage_button_text', true);
$background_color = get_post_meta($post->ID, '_wc_shortcodes_collage_background_color', true);

$image_style = array();
if ( $background_color ) {
	$image_style[] = 'background-color:' . esc_attr( $background_color ) . ';';
}

$content_inner_style = array();
if ( $text_max_width ) {
	$content_inner_style[] = 'max-width:' . intval( $text_max_width ) . 'px;';
}

$content_style = array();
if ( $text_background_color ) {
	$content_style[] = 'background-color:' . esc_attr( $text_background_color ) . ';';
}
if ( $text_background_opacity && $text_background_opacity < 1 ) {
	$content_style[] = 'opacity:' . esc_attr( $text_background_opacity ) . ';';
}

$content_text_style = array();
$content_text_class = array();
if ( $text_color ) {
	$content_text_style[] = 'color:' . esc_attr( $text_color ) . ';';
	$content_text_class[] = 'wc-shortcodes-collage-content-style';
}

$content = wc_shortcodes_get_the_content();
$content_text_class[] = 'wc-shortcodes-collage-content';

$show_content_box = false;
if ( $content || $button_text ) {
	$show_content_box = true;
}
?>

<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $display['size'] ); ?>
		<?php $image_style[] = 'background-image:url(\''.$img[0].'\');'; ?>
<?php endif; ?>

<?php if ( ! empty( $url ) ) : ?>
	<div data-href="<?php echo esc_url( $url ); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'wc-shortcodes-collage-panel-background wc-shortcodes-collage-has-link' ); ?> style="<?php echo implode( '', $image_style ); ?>">
<?php else: ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'wc-shortcodes-collage-panel-background' ); ?> style="<?php echo implode( '', $image_style ); ?>">
<?php endif; ?>

		<?php if ( $show_content_box ) : ?>

			<div class="wc-shortcodes-collage-panel-content" style="<?php echo implode( '', $content_style ); ?>">
				<div class="wc-shortcodes-collage-panel-content-inner" style="<?php echo implode( '', $content_inner_style ); ?>">

					<?php if ( ! empty( $content ) ) : ?>
						<div class="<?php echo implode( ' ', $content_text_class ); ?>" style="<?php echo implode( '', $content_text_style ); ?>">
							<?php echo $content; ?>

							<?php if ( ! empty( $button_text ) && ! empty( $url ) ) : ?>
								<div class="wc-shortcodes-collage-button-wrapper">
									<a class="<?php echo esc_attr( $display['button_class'] ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo $button_text; ?></a>
								</div><!-- .entry-summary -->
							<?php endif; ?>

						</div><!-- .entry-summary -->
					<?php endif; ?>

				</div>
			</div><!-- .wc-shortcodes-collage-panel-content -->

		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'wc-shortcodes' ) ); ?> 

	</div><!-- #post -->
