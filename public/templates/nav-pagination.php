<?php
// Don't print empty markup if there's only one page.
if ( $wc_shortcodes_posts_query->max_num_pages < 2 )
	return;
?>
<nav class="navigation paging-navigation wc-shortcodes-posts-navigation" role="navigation">
	<h3 class="screen-reader-text"><?php _e( 'Posts Navigation', 'wc_shortcodes' ); ?></h3>
	<div class="nav-links">
		<?php 
			$big = 999999999; // need an unlikely integer
			$args = array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?page=%#%', // ?page=%#% : %#% is replaced by the page number
				'total' => $wc_shortcodes_posts_query->max_num_pages,
				'current' => max( 1, $wc_shortcodes_posts_query->get('paged') ),
				'show_all' => false,
				'prev_next' => true,
				'prev_text' => __('Previous Page'),
				'next_text' => __('Next Page'),
				'end_size' => 2,
				'mid_size' => 2,
				'type' => 'plain',
				'add_args' => false, // array of query args to add
				'add_fragment' => ''
			);
		?>
		<?php echo paginate_links( $args ); ?>

	</div><!-- .nav-links -->
</nav><!-- .navigation -->
