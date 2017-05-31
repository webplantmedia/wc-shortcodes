<?php
$count = $wc_shortcodes_posts_query->post_count;

$class = array();
$class[] = 'wc-shortcodes-collage';
$class[] = 'wc-shortcodes-clearfix';
$class[] = 'wc-shortcodes-collage-layout-' . $display['layout'];
$class[] = 'wc-shortcodes-collage-template-' . $display['template'];
$class[] = 'wc-shortcodes-collage-count-' . $count;
$slider_enabled = false;

// enqueue scripts
if ( 5 < $count && 'bxslider' == $display['layout'] ) {
	wp_enqueue_script('wc-shortcodes-bxslider');
	$class[] = 'wc-shortcodes-collage-slider-enabled';
	$slider_enabled = true;
}
wp_enqueue_script('wc-shortcodes-collage');
?>
<style>
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column {
	height: <?php echo $display['desktop_height']; ?>px;
}
<?php if ( ! empty( $display['gutter_space'] ) ) : ?>
	.wc-shortcodes-collage.wc-shortcodes-collage-template-collage1,
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-panel-wrapper {
		margin-right: -<?php echo $display['gutter_space']; ?>px;
	}
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-panel-wrapper,
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-column-1 .wc-shortcodes-collage-panel-4 {
		padding-top: <?php echo $display['gutter_space']; ?>px;
	}
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-column-2 .wc-shortcodes-collage-panel-inner,
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-column-inner {
		padding-right: <?php echo $display['gutter_space']; ?>px;
	}
<?php endif; ?>
<?php if ( ! empty( $display['heading_size'] ) ) : ?>
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h1,
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h2,
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h3,
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h4,
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h5,
#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h6 {
	font-size: <?php echo $display['heading_size']; ?>px;
}
<?php endif; ?>
@media (max-width: 1150px) {
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column {
		height: <?php echo $display['laptop_height']; ?>px;
	}
}
@media (max-width: 1150px) and (min-width: 991px) {
	<?php if ( ! empty( $display['mobile_heading_size'] ) ) : ?>
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h1,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h2,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h3,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h4,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h5,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h6 {
		font-size: <?php echo $display['mobile_heading_size']; ?>px;
	}
	<?php endif; ?>
}
@media (max-width: 990px) {
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-column {
		width: 100%;
	}
	.wc-shortcodes-collage-template-collage1 .wc-shortcodes-collage-column-2 {
		padding-top: <?php echo $display['gutter_space']; ?>px;
	}
}
@media (max-width: 767px) {
	<?php if ( ! empty( $display['mobile_heading_size'] ) ) : ?>
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h1,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h2,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h3,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h4,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h5,
	#wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-content h6 {
		font-size: <?php echo $display['mobile_heading_size']; ?>px;
	}
	<?php endif; ?>
}
@media (max-width: 567px) {
	body #wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column .wc-shortcodes-collage-panel {
		padding-top: <?php echo $display['gutter_space']; ?>px;
	}
	body #wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column .wc-shortcodes-collage-panel,
	body #wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column .wc-shortcodes-collage-panel-background,
	body #wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column .wc-shortcodes-collage-panel-wrapper {
		height: auto;
	}
	body #wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column .wc-shortcodes-collage-slider,
	body #wc-shortcodes-collage-<?php echo $instance; ?> .wc-shortcodes-collage-column .wc-shortcodes-collage-panel-background {
		height: <?php echo $display['mobile_height']; ?>px;
	}
	
}
</style>

<div id="wc-shortcodes-collage-<?php echo $instance; ?>" class="wc-shortcodes-collage-wrapper">
	<div id="wc-shortcodes-collage" class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">

		<?php if ( $wc_shortcodes_posts_query->have_posts() ) : ?>
			<div class="wc-shortcodes-collage-column wc-shortcodes-collage-column-1">
				<div class="wc-shortcodes-collage-column-inner">
					<?php if ( 4 <= $count ) : ?>
						<?php if ( 4 < $count ) : ?>
							<?php if ( $slider_enabled ) : ?>
								<?php include( 'loop-slider.php' ); ?>
							<?php else : ?>
								<?php include( 'loop-image.php' ); ?>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( 4 == $count ) : ?>
							<div class="wc-shortcodes-collage-panel wc-shortcodes-collage-panel-<?php echo $count; ?>">
								<?php $wc_shortcodes_posts_query->the_post(); ?>
								<?php include( 'content.php' ); ?>
								<?php $count--; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="wc-shortcodes-collage-column wc-shortcodes-collage-column-2">
				<div class="wc-shortcodes-collage-column-inner">
					<div class="wc-shortcodes-collage-panel wc-shortcodes-collage-panel-<?php echo $count; ?>">
						<?php $wc_shortcodes_posts_query->the_post(); ?>
						<?php include( 'content.php' ); ?>
						<?php $count--; ?>
					</div>
					<div class="wc-shortcodes-collage-panel-wrapper wc-shortcodes-clearfix">
						<?php while( $wc_shortcodes_posts_query->have_posts() ) : ?>
							<div class="wc-shortcodes-collage-panel wc-shortcodes-collage-panel-<?php echo $count; ?>">
								<div class="wc-shortcodes-collage-panel-inner">
									<?php $wc_shortcodes_posts_query->the_post(); ?>
									<?php include( 'content.php' ); ?>
									<?php $count--; ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>
