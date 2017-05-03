<div id="featured-post-<?php the_ID(); ?>" class="wc-shortcodes-featured-posts-content">
	<div id="wc-shortcodes-featured-posts-inner" class="wc-shortcodes-featured-posts-content-inner">
		<?php $class = ''; ?>
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<?php $image_style = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $display['size'] ); ?>
			<?php $image_style = 'background-image:url(\''.$image_style[0].'\');'; ?>

			<div class="wcs-fp-post-thumbnail-wrapper">
				<a href="<?php the_permalink(); ?>"><div class="wcs-fp-post-thumbnail" style="<?php echo $image_style; ?>"></div></a>
			</div>

			<?php $class = ' wcs-fp-has-post-thumbnail'; ?>
		<?php endif; ?>

		<div class="wcs-fp-post-content<?php echo $class; ?>">
			<?php if ( $display['show_meta_category'] ) : ?>
				<?php echo wc_shortcodes_get_posted_category(); ?>
			<?php endif; ?>

			<div class="wcs-fp-post-header">
				<<?php echo $display['heading_type']; ?> class="wcs-fp-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</<?php echo $display['heading_type']; ?>>
			</div><!-- .entry-header -->
		</div>
	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
