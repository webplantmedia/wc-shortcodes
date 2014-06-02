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
		$view_hook_name = add_submenu_page( 'options.php', $o['title'], $o['title'], 'manage_options', 'wc-shortcodes-options-' . $tab, 'wc_shortcodes_options_display_page' );
	}

	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	$view_hook_name = add_submenu_page( 'themes.php', 'Shortcodes', 'Shortcodes', 'manage_options', 'wc-shortcodes-options', 'wc_shortcodes_options_display_page' );
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
		case 'background' :
			wc_shortcodes_options_display_background_fields( $args );
			break;
		case 'checkbox' :
			wc_shortcodes_options_display_checkbox_field( $args );
			break;
		case 'textarea' :
			wc_shortcodes_options_display_textarea_field( $args );
			break;
		case 'positive_pixel' :
			wc_shortcodes_options_display_positive_pixel_input_field( $args );
			break;
		case 'pixel' :
			wc_shortcodes_options_display_pixel_input_field( $args );
			break;
		case 'emails' :
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
function wc_shortcodes_options_display_positive_pixel_input_field( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );
	$val = preg_replace("/[^0-9]/", "",$val);
	?>

	<?php if ( isset( $label ) ) : ?>
		<label for="<?php echo $option_name; ?>"><?php echo $label; ?></label>&nbsp;
	<?php endif; ?>

	<input type="number" min="0" class="small-text" name="<?php echo esc_attr($option_name); ?>" id="<?php echo $option_name; ?>" value="<?php echo esc_attr($val); ?>" />&nbsp;

	<?php if ( isset( $description ) && !empty( $description ) ) : ?>
		<p class="description"><?php echo $description; ?></p>
	<?php endif; ?>

	<?php
}
function wc_shortcodes_options_display_pixel_input_field( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );
	$val = preg_replace("/[^0-9\-]/", "",$val);
	?>

	<?php if ( isset( $label ) ) : ?>
		<label for="<?php echo $option_name; ?>"><?php echo $label; ?></label>&nbsp;
	<?php endif; ?>

	<input type="number" class="small-text" name="<?php echo esc_attr($option_name); ?>" id="<?php echo $option_name; ?>" value="<?php echo esc_attr($val); ?>" />&nbsp;

	<?php if ( isset( $description ) && !empty( $description ) ) : ?>
		<p class="description"><?php echo $description; ?></p>
	<?php endif; ?>

	<?php
}
function wc_shortcodes_options_display_background_fields( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );

	// preview image default style
	$style = '';
	if ( empty( $val['image'] ) )
		$style = ' style="display:none"';
	?>

	<div class="wc-shortcodes-background-options">
		<?php // Background Image ?>
		<input name="<?php echo $option_name; ?>[image]" id="<?php echo $option_name; ?>" class="regular-text ltr upload-input" type="text" value="<?php echo esc_attr( $val['image'] ); ?>" />
		<br />
		<a class="button wc-shortcodes-image-upload" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image" data-frame="select" data-state="wc_shortcodes_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wc-shortcodes-custom-uploader" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>
		<a class="button wc-shortcodes-restore-image" data-restore="<?php echo esc_attr( $default['image'] ); ?>" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image">Default</a>
		<a class="button wc-shortcodes-delete-image" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image">Delete</a>
		<br />
		<p class="wc-shortcodes-preview-image"<?php echo $style; ?>><img src="<?php echo esc_attr( $val['image'] ); ?>" /></p>

		<?php // Background Repeat ?>
		<select name="<?php echo $option_name; ?>[repeat]" >
			<option value="repeat" <?php selected( $val['repeat'], 'repeat'); ?>>Repeat</option>
			<option value="repeat-x" <?php echo selected( $val['repeat'], 'repeat-x', false ); ?>>Repeat Horizontal</option>
			<option value="repeat-y" <?php echo selected( $val['repeat'], 'repeat-y', false ); ?>>Repeat Vertical</option>
			<option value="no-repeat" <?php echo selected( $val['repeat'], 'no-repeat', false ); ?>>No Repeat</option>
			<option value="" <?php selected( $val['repeat'], ''); ?>>Inherit</option>
		</select>

		<?php // Background position ?>
		<select name="<?php echo $option_name; ?>[position]" >
			<option value="left top" <?php selected( $val['position'], 'left top'); ?>>Left Top</option>
			<option value="left center" <?php selected( $val['position'], 'left center'); ?>>Left Center</option>
			<option value="left bottom" <?php selected( $val['position'], 'left bottom'); ?>>Left Bottom</option>
			<option value="right top" <?php selected( $val['position'], 'right top'); ?>>Right Top</option>
			<option value="right center" <?php selected( $val['position'], 'right center'); ?>>Right Center</option>
			<option value="right bottom" <?php selected( $val['position'], 'right bottom'); ?>>Right Bottom</option>
			<option value="center top" <?php selected( $val['position'], 'center top'); ?>>Center Top</option>
			<option value="center center" <?php selected( $val['position'], 'center center'); ?>>Center Center</option>
			<option value="center bottom" <?php selected( $val['position'], 'center bottom'); ?>>Center Bottom</option>
			<option value="" <?php selected( $val['position'], ''); ?>>Inherit</option>
		</select>

		<?php // Background Attachment ?>
		<select name="<?php echo $option_name; ?>[attachment]" >
			<option value="scroll" <?php selected( $val['attachment'], 'scroll'); ?>>Scroll</option>
			<option value="fixed" <?php selected( $val['attachment'], 'fixed'); ?>>Fixed</option>
			<option value="" <?php selected( $val['attachment'], ''); ?>>Inherit</option>
		</select>
		<br />

		<?php // Background Color ?>
		<input name="<?php echo $option_name; ?>[color]" type="text" value="<?php echo $val['color']; ?>" class="wc-shortcodes-color-field" data-default-color="<?php echo $default['color']; ?>" />

		<?php // Description ?>
		<?php if ( isset( $description ) && !empty( $description ) ) : ?>
			<p class="description"><?php echo $description; ?></p>
		<?php endif; ?>
	</div>

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
		<a class="button wc-shortcodes-image-upload" data-target="#<?php echo $option_name; ?>" data-preview=".wc-shortcodes-preview-image" data-frame="select" data-state="wc_shortcodes_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wc-shortcodes-custom-uploader" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>
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

function wc_shortcodes_options_display_textarea_field( $args ) {
	extract( $args );

	$val = get_option( $option_name, $default );
	?>

	<?php if ( isset( $label ) ) : ?>
		<label for="<?php echo esc_attr($option_name); ?>"><?php echo $label; ?></label>&nbsp;
	<?php endif; ?>

	<textarea name="<?php echo $option_name; ?>" class="wc-shortcodes-textarea" id="<?php echo $option_name; ?>"><?php echo esc_textarea($val); ?></textarea>
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
		case 'emails' :
			return 'wc_shortcodes_options_sanitize_emails';
		case 'background' :
			return 'wc_shortcodes_options_sanitize_background_css';
		case 'positive_pixel' :
			return 'wc_shortcodes_options_sanitize_positive_pixel';
		case 'pixel' :
			return 'wc_shortcodes_options_sanitize_pixel';
	}

	return '';
}

function wc_shortcodes_options_sanitize_positive_pixel( $value ) {
	$value = preg_replace("/[^0-9]/", "",$value);
	$value = intval( $value );

	if ( empty( $value ) )
		$value = '0';

	return $value."px";
}

function wc_shortcodes_options_sanitize_pixel( $value ) {
	$value = preg_replace("/[^0-9\-]/", "",$value);
	$value = intval( $value );

	if ( empty( $value ) )
		$value = '0';

	return $value."px";
}

function wc_shortcodes_options_sanitize_background_css( $value ) {
	$background = array(
		'color' => '',
		'image' => '',
		'repeat' => '',
		'position' => '',
		'attachment' => '',
	);

	if ( !is_array( $value ) )
		return $background;

	foreach ( $value as $k => $v ) {
		switch ( $k ) {
			case 'color' :
				$v = wc_shortcodes_options_sanitize_hex_color( $v );
				$background['color'] = $v;
				break;
			case 'image' :
				$v = esc_url_raw( $v );
				$background['image'] = $v;
				break;
			case 'repeat' :
				$v = wc_shortcodes_options_sanitize_background_repeat( $v );
				$background['repeat'] = $v;
				break;
			case 'position' :
				$v = wc_shortcodes_options_sanitize_background_position( $v );
				$background['position'] = $v;
				break;
			case 'attachment' :
				$v = wc_shortcodes_options_sanitize_background_attachment( $v );
				$background['attachment'] = $v;
				break;
		}
	}

	return $background;
}

function wc_shortcodes_options_sanitize_background_repeat( $value ) {
	$whitelist = array( 'repeat', 'no-repeat', 'repeat-x', 'repeat-y' );

	if ( in_array( $value, $whitelist ) )
		return $value;

	return '';
}

function wc_shortcodes_options_sanitize_background_position( $value ) {
	$whitelist = array(
		'left top',
		'left center',
		'left bottom',
		'right top',
		'right center',
		'right bottom',
		'center top',
		'center center',
		'center bottom',
	);

	if ( in_array( $value, $whitelist ) )
		return $value;

	return '';
}

function wc_shortcodes_options_sanitize_background_attachment( $value ) {
	$whitelist = array( 'fixed', 'scroll' );

	if ( in_array( $value, $whitelist ) )
		return $value;

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

function wc_shortcodes_options_sanitize_emails( $email ) {
	$valid = array();

	$email = explode( ',', $email );

	foreach ( $email as $e ) {
		$e = trim( $e );
		if ( is_email( $e ) )
			$valid[] = $e;
	}

	if ( ! empty( $valid ) )
		return implode( ',', $valid );

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
