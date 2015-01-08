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
				<?php
				$content = get_the_content();
				$has_url = get_url_in_content( $content );
				$link = ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
				?>
				<a href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a>
			</<?php echo $atts['heading_type']; ?>>
		<?php endif; ?>

		<?php if ( $atts['content'] ) : ?>
			<?php wc_shortcodes_the_content(); ?>
		<?php endif; ?>

		<?php include('entry-meta.php'); ?>

	</div><!-- .wc-shortcodes-post-border -->
</div><!-- #post -->
