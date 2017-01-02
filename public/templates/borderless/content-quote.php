<?php $classes[] = 'wc-shortcodes-post-box'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="wc-shortcodes-post-border">
		<?php if ( $display['show_content'] ) : ?>
			<div class="wc-shortcodes-entry-quote">
				<?php wc_shortcodes_the_content(); ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>

		<?php include('entry-meta.php'); ?>

	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
