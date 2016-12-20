<?php $classes[] = 'wc-shortcodes-post-box'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="wc-shortcodes-post-border">
		<div class="wc-shortcodes-entry-audio">
			<?php wc_shortcodes_the_media_content(); ?>
		</div><!-- .entry-summary -->

		<?php if ( $display['title'] ) : ?>
			<<?php echo $display['heading_type']; ?> class="wc-shortcodes-entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</<?php echo $display['heading_type']; ?>>
		<?php endif; ?>

		<?php if ( $display['content'] ) : ?>
			<?php wc_shortcodes_the_excerpt(); ?>
		<?php endif; ?>

		<?php include('entry-meta.php'); ?>

	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
