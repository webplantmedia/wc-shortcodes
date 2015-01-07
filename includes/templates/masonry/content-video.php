<?php $classes[] = 'wc-shortcodes-post-box'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="wc-shortcodes-post-border">
		<div class="wc-shortcodes-entry-video">
			<?php wc_shortcodes_the_media_content(); ?>
		</div><!-- .entry-summary -->

		<div class="wc-shortcodes-post-content">
			<?php if ( $atts['title'] ) : ?>
			<div class="wc-shortcodes-entry-header">
				<<?php echo $atts['heading_type']; ?> class="wc-shortcodes-entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</<?php echo $atts['heading_type']; ?>>
			</div><!-- .entry-header -->
			<?php endif; ?>

			<?php if ( $atts['content'] ) : ?>
				<div class="wc-shortcodes-entry-summary">
					<?php wc_shortcodes_the_excerpt(); ?>
				</div>
			<?php endif; ?>

			<?php include('entry-meta.php'); ?>

		</div><!-- .wc-shortcodes-post-content -->
	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
