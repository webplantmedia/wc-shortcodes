<div class="wc-shortcodes-collage-panel wc-shortcodes-collage-panel-5 wc-shortcodes-loading">
	<div id="" class="wc-shortcodes-collage-slider-wrapper">
		<div class="wc-shortcodes-collage-slider" data-mode="<?php echo esc_attr( $display['slider_mode'] ); ?>" data-pause="<?php echo esc_attr( $display['slider_pause'] ); ?>" data-auto="<?php echo esc_attr( $display['slider_auto'] ); ?>">
			<?php while ( 4 < $count ) : ?>
				<?php $wc_shortcodes_posts_query->the_post(); ?>
				<?php include( 'content.php' ); ?>
				<?php $count--; ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>
