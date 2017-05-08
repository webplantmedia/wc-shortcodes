<?php $classes[] = 'wc-shortcodes-post-box'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="wc-shortcodes-post-border">
		<?php if ( $display['show_thumbnail'] && has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="wc-shortcodes-entry-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $display['size'] ); ?></a>
			</div>
		<?php endif; ?>

		<div class="wc-shortcodes-post-content">
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

			<?php if ( $display['readmore'] ) : ?>
			<div class="wc-shortcodes-read-more">
				<a class="<?php echo esc_attr( $display['button_class'] ); ?>" href="<?php the_permalink(); ?>"><?php echo $display['readmore']; ?></a>
			</div><!-- .entry-summary -->
			<?php endif; ?>

			<?php include('entry-meta.php'); ?>

		</div><!-- .wc-shortcodes-post-content -->
	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
