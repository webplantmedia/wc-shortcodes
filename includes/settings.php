<?php

function wc_shortcodes_options_enqueue_scripts() {
	wp_register_style( 'wc-shortcodes-options', WC_SHORTCODES_PLUGIN_URL . 'includes/css/admin.css', array(), WC_SHORTCODES_VERSION, 'all' );
	wp_enqueue_style( 'wc-shortcodes-options' );

	wp_register_script( 'wc-shortcodes-options-js', WC_SHORTCODES_PLUGIN_URL . 'includes/js/admin.js', array('jquery'), WC_SHORTCODES_VERSION, true );
	wp_enqueue_script( 'wc-shortcodes-options-js' );
}
add_action('admin_enqueue_scripts', 'wc_shortcodes_options_enqueue_scripts' );

function wc_shortcodes_options_init() {
	global $wc_shortcodes_options;

	foreach ( $wc_shortcodes_options as $tab => $o ) {
		foreach ( $o['sections'] as $oo ) {
			add_settings_section( $oo['section'], $oo['title'], '', 'wc-shortcodes-options' . $tab );
			foreach ( $oo['options'] as $ooo ) {
				$ooo['option_name'] = WC_SHORTCODES_PREFIX . $ooo['id'];
				$callback = wc_shortcodes_options_find_sanitize_callback( $ooo['type'] );
				register_setting( 'wc-shortcodes-options-'.$tab.'group', WC_SHORTCODES_PREFIX . $ooo['id'], $callback );
				add_settings_field('wc_shortcodes_'.$ooo['id'].'', '<label for="wc_shortcodes_'.$ooo['id'].'">'.__($ooo['title'] , 'wc_shortcodes' ).'</label>' , 'wc_shortcodes_options_display_setting', 'wc-shortcodes-options'.$tab, $oo['section'], $ooo );
			}
		}
	}
}
add_action( 'admin_init', 'wc_shortcodes_options_init' );

function wc_shortcodes_options_admin_menu() {
	global $wc_shortcodes_options;

	foreach ( $wc_shortcodes_options as $tab => $o ) {
		$view_hook_name = add_submenu_page( 'options.php', $o['title'], $o['title'], 'read', 'wc-shortcodes-options-' . $tab, 'wc_shortcodes_options_display_page' );
	}

	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	$view_hook_name = add_submenu_page( 'themes.php', 'WC Shortcodes', 'WC Shortcodes', 'read', 'wc-shortcodes-options', 'wc_shortcodes_options_display_page' );
}
add_action( 'admin_menu', 'wc_shortcodes_options_admin_menu' );

function wc_shortcodes_options_display_page() {
	global $wc_shortcodes_options, $tab;
	wp_reset_vars( array( 'tab' ) );

	// restore last tab visited
	if ( empty( $tab ) && isset( $_COOKIE[ WC_SHORTCODES_PREFIX . 'last_tab_visited'] ) ) {
		$last_tab = $_COOKIE[ WC_SHORTCODES_PREFIX . 'last_tab_visited'];
		if ( isset( $wc_shortcodes_options[ $last_tab ] ) ) {
			$tab = $last_tab;
		}
	}

	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php
			$links = array();
			foreach( $wc_shortcodes_options as $id => $page ) :
				if ( empty( $tab ) || $id == $tab ) {
					$tab = $id;
					$links[] = "<a class='nav-tab nav-tab-active' href='themes.php?page=wc-shortcodes-options&tab=".$tab."'>".$page['title']."</a>";
				}
				else {
					$links[] = "<a class='nav-tab' href='themes.php?page=wc-shortcodes-options&tab=".$id."'>".$page['title']."</a>";
				}
			endforeach;
		?>
		<h2 class="nav-tab-wrapper">
		<?php echo implode( '', $links ); ?>
		</h2>

		<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
			<div id="message" class="updated"><p><strong><?php _e( 'Settings saved.' ) ?></strong></p></div>
		<?php endif; ?>

		<form id="compile-less-css" method="post" action="options.php">
			<?php
			// settings_fields( $option_group )
			// @option_group A settings group name. This should match the group name used in register_setting()
			settings_fields( 'wc-shortcodes-options-'.$tab.'group' );

			// do_settings_sections( $page ) 
			// The slug name of the page whose settings sections you want to output. This should match the page name used in add_settings_section()
			do_settings_sections( 'wc-shortcodes-options'.$tab );
			?>

			<p class="submit">
				<?php submit_button( null, 'primary', 'submit', false ); ?>
			</p>
		</form>
	</div>
	<?php
}

/*
 * Display Options 
 */
function wc_shortcodes_options_display_setting( $args ) {
	if ( !isset( $args['type'] ) )
		return;

	if ( !isset( $args['option_name'] ) )
		return;

	if ( !isset( $args['default'] ) )
		return;

	switch ( $args['type'] ) {
		case 'image' :
			wc_shortcodes_options_display_image_field( $args );
			break;
		case 'checkbox' :
			wc_shortcodes_options_display_checkbox_field( $args );
			break;
		default :
			wc_shortcodes_options_input_field( $args );
			break;
	}
}

function wc_shortcodes_options_input_field( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );
	?>

	<?php if ( isset( $label ) ) : ?>
		<label for="<?php echo esc_attr($option_name); ?>"><?php echo $label; ?></label>&nbsp;
	<?php endif; ?>

	<input name="<?php echo $option_name; ?>" id="<?php echo $option_name; ?>" type="text" value="<?php echo esc_attr($val); ?>" class="regular-text" />
	<?php if ( isset( $description ) && !empty( $description ) ) : ?>
		<p class="description"><?php echo $description; ?></p>
	<?php endif; ?>
	<?php
}
function wc_shortcodes_options_display_image_field( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );

	// preview image default style
	$style = '';
	if ( empty( $val['image'] ) )
		$style = ' style="display:none"';
	?>

	<div class="wc-shortcodes-image-field">
		<input name="<?php echo $option_name; ?>" id="<?php echo $option_name; ?>" class="regular-text ltr upload-input" type="text" value="<?php echo esc_attr($val); ?>" />
		<br />
		<a class="button wc-shortcodes-image-upload" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image" data-frame="select" data-state="wordpresscanvas_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wc-shortcodes-custom-uploader" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>
		<a class="button wc-shortcodes-restore-image" data-restore="<?php echo $default; ?>" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image">Default</a>
		<a class="button wc-shortcodes-delete-image" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image">Delete</a>
		<p class="wc-shortcodes-preview-image"<?php echo $style; ?>><img src="<?php echo esc_attr($val); ?>" /></p>
		<?php if ( isset( $description ) && !empty( $description ) ) : ?>
			<p class="description"><?php echo $description; ?></p>
		<?php endif; ?>
	</div>
	<?php
}

function wc_shortcodes_options_display_checkbox_field( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );
	?>

	<?php if ( isset( $label ) ) : ?>
		<label for="<?php echo esc_attr($option_name); ?>">
	<?php endif; ?>

	<input name="<?php echo $option_name; ?>" id="<?php echo $option_name; ?>" type="checkbox" value="1" <?php checked( true, $val ); ?> />

	<?php if ( isset( $label ) ) : ?>
		&nbsp;<?php echo $label; ?></label>&nbsp;
	<?php endif; ?>

	<?php if ( isset( $description ) && !empty( $description ) ) : ?>
		<p class="description"><?php echo $description; ?></p>
	<?php endif; ?>
	<?php
}

/*
 * Sanitize Options
 */
function wc_shortcodes_options_find_sanitize_callback( $type ) {
	switch ( $type ) {
		case 'color' :
			return 'wc_shortcodes_options_sanitize_hex_color';
		case 'image' :
			return 'esc_url_raw';
		case 'checkbox' :
			return 'wc_shortcodes_options_sanitize_checkbox';
	}

	return '';
}

function wc_shortcodes_options_sanitize_checkbox( $val ) {
	if ( $val )
		return 1;
	else
		return 0;
}

function wc_shortcodes_options_sanitize_hex_color( $color ) {
	if ( '' === $color )
		return '';

	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

/*
 * Misc
 */
function wc_shortcodes_remember_last_options_tab() {
	global $page;

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'wc-shortcodes-options' ) {
		if ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ) {
			setcookie(WC_SHORTCODES_PREFIX . 'last_tab_visited', $_GET['tab'], time() + ( 2 * DAY_IN_SECONDS ) );
		}
	}
}
add_action( 'admin_init', 'wc_shortcodes_remember_last_options_tab' );
