<?php if ( $display['show_meta_all'] ) : ?>
	<div class="wc-shortcodes-footer-entry-meta wc-shortcodes-clearfix">
		<div class="wc-shortcodes-entry-meta-inner wc-shortcodes-clearfix">
			<?php if ( $display['show_meta_comments'] ) : ?>
				<?php if ( comments_open() ) : ?>
					<span class="wc-shortcodes-comments-link">
						<?php comments_popup_link( '<span class="wc-shortcodes-leave-reply">' . __( '0', 'wc_shortcodes' ) . '</span>', __( '1', 'wordpresscanvas' ), __( '%', 'wordpresscanvas' ) ); ?>
					</span><!-- .comments-link -->
				<?php endif; // comments_open() ?>
			<?php endif; ?>

			<?php
			$meta = array();
			// Post author
			if ( $display['show_meta_author'] ) {
				$meta[] = sprintf( '<span class="wc-shortcodes-author"><span class="wc-shortcodes-by">' . __( 'By', 'wc_shortcodes' ) . '</span> <a class="wc-shortcodes-url" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author(),
					get_the_author()
				);
			}
			?>

			<?php
			if ( $display['show_meta_date'] && ! has_post_format( 'link' ) ) {
				$meta[] = sprintf( '<span class="wc-shortcodes-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="wc-shortcodes-entry-date" datetime="%3$s">%4$s</time></a></span>',
					esc_url( get_permalink() ),
					esc_attr( sprintf( __( 'Permalink to %s', 'wc_shortcodes' ), the_title_attribute( 'echo=0' ) ) ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( sprintf( '%2$s', get_post_format_string( get_post_format() ), get_the_date( $display['date_format'] ) ) )
				);
			}
			?>
			<?php echo implode( '<span class="wc-shortcodes-sep">|</span>', $meta ); ?>
		</div>
	</div><!-- .wc-shortcodes-footer-entry-meta -->
<?php endif; ?>
