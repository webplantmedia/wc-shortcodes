<?php
/**
 * filter social url. For example, we want to add
 * mailto: to an email address.
 * 
 * @access public
 * @return void
 */
function wc_shortcodes_smart_social_link( $social_link, $name ) {
    switch ( $name ) {
        case 'email' :
            // some users may have already inserted mailto:, so let's remove it.
			if ( is_email( $social_link ) ) {
				$social_link = str_replace( 'mailto:', '', $social_link );
				$social_link = 'mailto:'.$social_link;
			}
            break;
    }

    return $social_link;
}
add_filter( 'wc_shortcodes_social_link' , 'wc_shortcodes_smart_social_link', 10, 2 );
