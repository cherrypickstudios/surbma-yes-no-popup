<?php

include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/admin/surbma-admin.php');
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
