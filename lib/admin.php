<?php

include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/pages/settings.php');

/* Admin options menu */
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
add_action( 'admin_menu', 'surbma_yes_no_popup_add_menus' );

// Custom styles and scripts for admin pages
function surbma_yes_no_popup_admin_scripts( $hook ) {
	global $surbma_yes_no_popup_settings_page;
    if ( $hook == $surbma_yes_no_popup_settings_page ) {
		wp_enqueue_script( 'uikit-js', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/admin/uikit/js/uikit.min.js', array( 'jquery' ), '3.0.0.35', true );
		wp_enqueue_script( 'uikit-icons', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/admin/uikit/js/uikit-icons.min.js', array( 'jquery' ), '3.0.0.35', true );
		wp_enqueue_style( 'uikit-css', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/admin/uikit/css/uikit.min.css', false, '3.0.0.35' );
    	wp_enqueue_style( 'surbma-admin', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/admin/surbma-admin.css' );
    }
}
add_action( 'admin_enqueue_scripts', 'surbma_yes_no_popup_admin_scripts', 9999 );
