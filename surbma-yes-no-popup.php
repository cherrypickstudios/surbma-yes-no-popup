<?php

/*
Plugin Name: Surbma - Yes/No Popup
Plugin URI: http://surbma.com/wordpress-plugins/
Description: Shows a popup with Yes/No options

Version: 1.1.0

Author: Surbma
Author URI: http://surbma.com/

License: GPLv2

Text Domain: surbma-yes-no-popup
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) exit( 'Good try! :)' );

define( 'SURBMA_YES_NO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_URL', plugins_url( '', __FILE__ ) );

// Localization
add_action( 'plugins_loaded', 'surbma_yes_no_popup_init' );
function surbma_yes_no_popup_init() {
	load_plugin_textdomain( 'surbma-yes-no-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

// Include files
if ( is_admin() ) {
	include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/lib/admin.php' );
}

add_action( 'wp_enqueue_scripts', 'surbma_yes_no_popup_enqueue_scripts', 999 );
function surbma_yes_no_popup_enqueue_scripts() {
	wp_enqueue_script( 'surbma-yes-no-popup-scripts', plugins_url( '', __FILE__ ) . '/js/scripts-min.js', array( 'jquery' ), '2.27.1', true );
	wp_enqueue_style( 'surbma-yes-no-popup-styles', plugins_url( '', __FILE__ ) . '/css/styles.css', false, '2.27.1' );
}

add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
function surbma_yes_no_popup_block() {
	if( !isset( $_COOKIE['surbma-yes-no-popup'] ) ) {
		$options = get_option( 'surbma_yes_no_popup_fields' );
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$.UIkit.modal(('#surbma-yes-no-popup'), {center: true,keyboard: false,bgclose: false}).show();
		});
	</script>
	<div id="surbma-yes-no-popup" class="uk-modal">
        <div class="uk-modal-dialog">
			<div class="uk-modal-header">
				<h2><?php echo esc_attr_e( $options['popuptitle'] ); ?></h2>
			</div>
			<div class="uk-modal-content"><?php echo stripslashes( $options['popuptext'] ); ?></div>
			<div class="uk-modal-footer uk-text-right">
				<button id="button1" type="button" class="uk-button uk-button-large uk-button-<?php echo esc_attr_e( $options['popupbutton1style'] ); ?><?php if( $options['popupbuttonoptions'] != 'button-1-redirect' ) echo ' uk-modal-close'; ?>">
					<?php echo esc_attr_e( $options['popupbutton1text'] ); ?>
				</button>
				<button id="button2" type="button" class="uk-button uk-button-large uk-button-<?php echo esc_attr_e( $options['popupbutton2style'] ); ?><?php if( $options['popupbuttonoptions'] == 'button-1-redirect' ) echo ' uk-modal-close'; ?>">
					<?php echo esc_attr_e( $options['popupbutton2text'] ); ?>
				</button>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function setCookie() {
		    var d = new Date();
		    d.setTime(d.getTime() + (1*24*60*60*1000));
		    var expires = "expires="+ d.toUTCString();
		    document.cookie = "surbma-yes-no-popup=yes;" + expires + ";path=/";
		}
		<?php if( $options['popupbuttonoptions'] != 'button-1-redirect' ) { ?>
	    	document.getElementById("button1").onclick = function () {
				setCookie();
	    	};
	    	document.getElementById("button2").onclick = function () {
	        	location.href = "<?php echo esc_attr_e( $options['popupbuttonurl'] ); ?>";
	    	};
		<?php } else { ?>
	    	document.getElementById("button1").onclick = function () {
	        	location.href = "<?php echo esc_attr_e( $options['popupbuttonurl'] ); ?>";
	    	};
	    	document.getElementById("button2").onclick = function () {
				setCookie();
	    	};
		<?php } ?>
	</script>
	<?php
	}
}
