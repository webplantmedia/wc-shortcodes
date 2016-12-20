<?php $classes[] = 'wc-shortcodes-post-box'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="wc-shortcodes-post-border">
		<?php if ( $display['content'] ) : ?>
			<div class="wc-shortcodes-entry-quote">
				<?php wc_shortcodes_the_content(); ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>

		<div class="wc-shortcodes-post-content">

			<?php include('entry-meta.php'); ?>

		</div><!-- .wc-shortcodes-post-content -->
	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
