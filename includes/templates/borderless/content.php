<?php $classes[] = 'wc-shortcodes-post-box'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="wc-shortcodes-post-border">
		<?php if ( $atts['thumbnail'] && has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="wc-shortcodes-entry-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $atts['size'] ); ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $atts['title'] ) : ?>
			<<?php echo $atts['heading_type']; ?> class="wc-shortcodes-entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</<?php echo $atts['heading_type']; ?>>
		<?php endif; ?>

		<?php if ( $atts['content'] ) : ?>
			<?php wc_shortcodes_the_excerpt(); ?>
		<?php endif; ?>

		<?php include('entry-meta.php'); ?>

	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
