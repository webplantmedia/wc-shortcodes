<?php
$nav_filter_class = '';
if ( ! $nav_filter_hard_links ) {
	$nav_filter_class = ' wc-shortcodes-filtering-dynamic';
}
$args = array(
	'orderby' => 'name',
);
$taxonomy = $atts['taxonomy'];
$whitelist = $atts['terms'];
$permalink = get_permalink();

if ( ! empty( $taxonomy ) ) {
	$terms = get_terms( $taxonomy, $args );

	if ( ! is_wp_error( $terms ) || empty( $terms ) ) {

		$links = array();
		$link = $nav_filter_hard_links ? $permalink : '#';
		$links[] = "<a href='{$link}' data-filter='*' title='All Tags' class='wc-shortcodes-term wc-shortcodes-all-tags wc-shortcodes-term-active'>" . __( 'All', 'wordpresscanvas' ) . "</a>";

		if ( ! is_array( $whitelist ) || empty( $whitelist ) ) {
			foreach ( $terms as $term ) {
				$link = $nav_filter_hard_links ? $permalink . '?wpc_terms=' . $term->slug : '#';
						
				$links[] = "<a href='{$link}' data-filter='.wc-shortcodes-filter-{$term->slug}' title='{$term->name} Tag' class='wc-shortcodes-term wc-shortcodes-term-slug-{$term->slug}'>" . $term->name . "</a>";
			}
		}
		else {
			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $whitelist ) ) {
					$link = $nav_filter_hard_links ? $permalink . '?wpc_terms=' . $term->slug : '#';
							
					$links[] = "<a href='{$link}' data-filter='.wc-shortcodes-filter-{$term->slug}' title='{$term->name} Tag' class='wc-shortcodes-term wc-shortcodes-term-slug-{$term->slug}'>" . $term->name . "</a>";
				}
			}
		}
		?>

		<?php if ( sizeof( $links ) > 2 ) : ?>
			<nav data-target="#wc-shortcodes-posts-<?php echo $instance; ?>" class="wc-shortcodes-filtering<?php echo $nav_filter_class; ?> wc-shortcodes-filtering-layout-<?php echo $atts['layout']; ?> wc-shortcodes-nav-<?php echo $taxonomy; ?>">
				<?php echo implode( "<span class='tag-divider'>/</span>", $links ); ?>
			</nav>
		<?php endif; ?>

		<?php
	}
}
