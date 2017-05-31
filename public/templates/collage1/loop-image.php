<div class="wc-shortcodes-collage-panel wc-shortcodes-collage-panel-5">
	<?php while ( 4 < $count ) : ?>
		<?php $wc_shortcodes_posts_query->the_post(); ?>
		<?php include( 'content.php' ); ?>
		<?php $count--; ?>
	<?php endwhile; ?>
</div>
