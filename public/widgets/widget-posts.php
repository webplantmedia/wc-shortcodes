<?php
/**
 * @uses WP
 * @uses _Widget
 */
class WPC_Shortcodes_Widget_Posts extends WPC_Shortcodes_Widget_Base {
	function form( $instance ) {
		// array_merge needs both values to be array.
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$instance = WPC_Shortcodes_Sanitize::posts_attr_key_change( $instance );
		$o = array_merge( WPC_Shortcodes_Vars::$attr->posts, $instance );
		$o = WPC_Shortcodes_Sanitize::posts_attr( $o );
		
		$post_types = WPC_Shortcodes_Widget_Options::post_types();
		?>

		<div id="wc-shortcodes-posts-widget-<?php echo $this->number; ?>" class="wc-shortcodes-posts-widget wc-shortcodes-visual-manager wpc-ui-theme-override">
			<h3>Select Posts</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('pids'); ?>"><?php _e('Post IDs:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('pids'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="post" name="<?php echo $this->get_field_name('pids'); ?>" value="<?php echo $o['pids']; ?>" />
					<span class="wcs-description">Leave blank to display all posts.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::order_fields() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['order'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::order_by_fields() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['orderby'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label>
					<select id="<?php echo $this->get_field_id('post_type'); ?>" class="wc-shortcodes-widget-option wc-shortcodes-widget-post-type-selector" name="<?php echo $this->get_field_name('post_type'); ?>">
						<?php foreach ( $post_types as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['post_type'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:'); ?></label>
					<select id="<?php echo $this->get_field_id('taxonomy'); ?>" class="wc-shortcodes-widget-option wc-shortcodes-widget-taxonomy-selector" name="<?php echo $this->get_field_name('taxonomy'); ?>">
						<option value=""<?php selected( $o['taxonomy'], "" ); ?>>No Taxonomy</option>';
						<?php foreach ( $post_types as $post_type_name ) : ?>
							<?php $taxonomies = get_object_taxonomies( $post_type_name, 'names' ); ?>
							<?php if ( $taxonomies ) : ?>
								<?php foreach ( $taxonomies  as $key ) : ?>
									<option value="<?php echo $key; ?>"<?php selected( $o['taxonomy'], $key ); ?> data-post-type="<?php echo $post_type_name; ?>"><?php echo $key; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('terms'); ?>"><?php _e('Terms:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat wc-shortcodes-widget-autocomplete-select" id="<?php echo $this->get_field_id('terms'); ?>" data-autocomplete-type="multi" data-autocomplete-lookup="terms" name="<?php echo $this->get_field_name('terms'); ?>" value="<?php echo $o['terms']; ?>" />
					<span class="wcs-description">Leave blank to display all terms.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Posts Per Page:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $o['posts_per_page']; ?>" />
					<span class="wcs-description">Enter -1 for unlimited posts.</span>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('ignore_sticky_posts'); ?>" name="<?php echo $this->get_field_name('ignore_sticky_posts'); ?>" value="1" <?php checked( $o['ignore_sticky_posts'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('ignore_sticky_posts'); ?>"><?php _e('Ignore Sticky Posts') ?></label>
				</p>
			</div>
			<h3>Content</h3>
			<div>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked( $o['show_title'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Title') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_meta_all'); ?>" name="<?php echo $this->get_field_name('show_meta_all'); ?>" value="1" <?php checked( $o['show_meta_all'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_meta_all'); ?>"><?php _e('Show Meta All') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_meta_author'); ?>" name="<?php echo $this->get_field_name('show_meta_author'); ?>" value="1" <?php checked( $o['show_meta_author'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_meta_author'); ?>"><?php _e('Show Meta Author') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_meta_date'); ?>" name="<?php echo $this->get_field_name('show_meta_date'); ?>" value="1" <?php checked( $o['show_meta_date'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_meta_date'); ?>"><?php _e('Show Meta Date') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_meta_comments'); ?>" name="<?php echo $this->get_field_name('show_meta_comments'); ?>" value="1" <?php checked( $o['show_meta_comments'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_meta_comments'); ?>"><?php _e('Show Meta Comments') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" value="1" <?php checked( $o['show_thumbnail'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Show Thumbnail') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>" value="1" <?php checked( $o['show_content'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show Content') ?></label>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('show_paging'); ?>" name="<?php echo $this->get_field_name('show_paging'); ?>" value="1" <?php checked( $o['show_paging'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('show_paging'); ?>"><?php _e('Show Paging') ?></label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('readmore'); ?>"><?php _e('Read More Text:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" value="<?php echo $o['readmore']; ?>" />
					<span class="wcs-description">Enter button text. Leave blank if you do not want a button.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('button_class'); ?>"><?php _e('Button Class:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('button_class'); ?>" name="<?php echo $this->get_field_name('button_class'); ?>" value="<?php echo $o['button_class']; ?>" />
					<span class="wcs-description">Enter class name for custom CSS styling.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image Size:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::image_sizes() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['size'], $key ); ?>><?php echo $value; ?></option>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<input type="checkbox" class="wc-shortcodes-widget-option checkbox" id="<?php echo $this->get_field_id('filtering'); ?>" name="<?php echo $this->get_field_name('filtering'); ?>" value="1" <?php checked( $o['filtering'], 1 ); ?> />
					<label for="<?php echo $this->get_field_id('filtering'); ?>"><?php _e('Enable Post Filtering') ?></label>
					<span class="wcs-description">You need to have a Taxonomy set for the filtering to show. Look under "Select Posts" to set your Taxonomy.</span>
				</p>
			</div>
			<h3>Style</h3>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::posts_columns() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['columns'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('gutter_space'); ?>"><?php _e('Gutter Space:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('gutter_space'); ?>" name="<?php echo $this->get_field_name('gutter_space'); ?>" value="<?php echo $o['gutter_space']; ?>" />
					<span class="wcs-description">Enter pixel value between 0 and 50.</span>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('heading_type'); ?>"><?php _e('Heading Type:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('heading_type'); ?>" name="<?php echo $this->get_field_name('heading_type'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::heading_tags() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['heading_type'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Layout:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::posts_layouts() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['layout'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:'); ?></label>
					<select class="wc-shortcodes-widget-option" id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>">
						<?php foreach ( WPC_Shortcodes_Widget_Options::posts_templates() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"<?php selected( $o['template'], $key ); ?>><?php echo $value; ?></option>';
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt Length:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $o['excerpt_length']; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('date_format'); ?>"><?php _e('Date Format:') ?></label>
					<input type="text" class="wc-shortcodes-widget-option widefat" id="<?php echo $this->get_field_id('date_format'); ?>" name="<?php echo $this->get_field_name('date_format'); ?>" value="<?php echo $o['date_format']; ?>" />
					<span class="wcs-description"><a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Documentation on date and time formatting</a></span>
				</p>
			</div>
		</div>

		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function($){
				$('#wc-shortcodes-posts-widget-<?php echo $this->number; ?>').accordion({heightStyle: "content", collapsible: true}).wcPostsWidget();
			});
			/* ]]> */
		</script>
		<?php
	}
}
