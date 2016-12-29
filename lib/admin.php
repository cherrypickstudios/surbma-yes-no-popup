<?php

include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/pages/settings.php');

/* Admin options menu */
add_action( 'admin_menu', 'surbma_yes_no_popup_add_menus' );
function surbma_yes_no_popup_add_menus() {
	global $surbma_yes_no_popup_settings_page;
	$surbma_yes_no_popup_settings_page = add_options_page(
		__( 'Surbma - Yes/No Popup', 'surbma-yes-no-popup' ),
		__( 'Yes/No Popup', 'surbma-yes-no-popup' ),
		'manage_options',
		'surbma-yes-no-popup-menu',
		'surbma_yes_no_popup_settings_page'
	);
}

// Custom styles and scripts for admin pages
add_action( 'admin_enqueue_scripts', 'surbma_yes_no_popup_admin_scripts' );
function surbma_yes_no_popup_admin_scripts( $hook ) {
	global $surbma_yes_no_popup_settings_page;
    if ( $hook == $surbma_yes_no_popup_settings_page ) {
    	wp_enqueue_style( 'surbma-yes-no-popup', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/css/surbma-admin-min.css' );
    }
}
