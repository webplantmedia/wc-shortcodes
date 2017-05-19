<?php $classes[] = 'wc-shortcodes-post-slide'; ?>
<?php $image_style = ''; ?>
<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<?php $image_style = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $display['size'] ); ?>
		<?php $image_style = 'background-image:url(\''.$image_style[0].'\');'; ?>
<?php endif; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> style="<?php echo $image_style; ?>">
	<div class="wc-shortcodes-post-slide-border">

		<?php if ( $display['show_content_box'] ) : ?>

			<div class="wc-shortcodes-post-slide-content">
				<div class="wc-shortcodes-post-slide-content-inner">
					<?php if ( $display['show_meta_category'] ) : ?>
						<?php echo wc_shortcodes_get_posted_category(); ?>
					<?php endif; ?>

					<?php if ( $display['show_title'] ) : ?>
						<div class="wc-shortcodes-entry-header">
							<<?php echo $display['heading_type']; ?> class="wc-shortcodes-entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</<?php echo $display['heading_type']; ?>>
						</div><!-- .entry-header -->
					<?php endif; ?>

					<?php if ( $display['show_content'] ) : ?>
					<div class="wc-shortcodes-entry-summary">
						<?php wc_shortcodes_the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php endif; ?>

					<?php if ( $display['show_button'] ) : ?>
						<?php
							if ( 'wcs_slide' == $post->post_type ) {
								$url = get_post_meta( $post->ID, '_wc_shortcodes_slide_url', true );
							}
							else {
								$url = get_the_permalink();
							}
						?>
						<div class="wc-shortcodes-read-more">
							<a class="<?php echo esc_attr( $display['button_class'] ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo $display['readmore']; ?></a>
						</div><!-- .entry-summary -->
					<?php endif; ?>
				</div>
			</div><!-- .wc-shortcodes-post-content -->

		<?php endif; ?>

	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
