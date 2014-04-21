<?php
$args = array(
	'orderby' => 'name',
);
$taxonomy = $atts['taxonomy'];
$whitelist = $atts['terms'];

if ( ! empty( $taxonomy ) ) {
	$terms = get_terms( $taxonomy, $args );

	if ( ! is_wp_error( $terms ) || empty( $terms ) ) {

		$links = array();
		$links[] = "<a href='#' data-filter='*' title='All Tags' class='wc-shortcodes-term wc-shortcodes-all-tags wc-shortcodes-term-active'>" . __( 'All', 'wordpresscanvas' ) . "</a>";

		if ( ! is_array( $whitelist ) || empty( $whitelist ) ) {
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term );
						
				$links[] = "<a href='#' data-filter='.wc-shortcodes-filter-{$term->slug}' title='{$term->name} Tag' class='wc-shortcodes-term wc-shortcodes-term-slug-{$term->slug}'>" . $term->name . "</a>";
			}
		}
		else {
			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $whitelist ) ) {
					$term_link = get_term_link( $term );
							
					$links[] = "<a href='#' data-filter='.wc-shortcodes-filter-{$term->slug}' title='{$term->name} Tag' class='wc-shortcodes-term wc-shortcodes-term-slug-{$term->slug}'>" . $term->name . "</a>";
				}
			}
		}
		?>

		<?php if ( sizeof( $links ) > 2 ) : ?>
			<nav data-target="#wc-shortcodes-posts-<?php echo $instance; ?>" class="wc-shortcodes-filtering wc-shortcodes-nav-<?php echo $taxonomy; ?>">
				<?php echo implode( "<span class='tag-divider'>/</span>", $links ); ?>
			</nav>
		<?php endif; ?>

		<?php
	}
}
