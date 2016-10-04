<?php

/*
Plugin Name: Surbma - Yes/No Popup
Plugin URI: http://surbma.com/wordpress-plugins/
Description: Shows a popup with Yes/No options

Version: 1.0.0

Author: Surbma
Author URI: http://surbma.com/

License: GPLv2

Text Domain: surbma-yes-no-popup
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) exit( 'Good try! :)' );

// Localization
add_action( 'plugins_loaded', 'surbma_yes_no_popup_init' );
function surbma_yes_no_popup_init() {
	load_plugin_textdomain( 'surbma-yes-no-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'wp_enqueue_scripts', 'surbma_yes_no_popup_enqueue_scripts' );
function surbma_yes_no_popup_enqueue_scripts() {
	wp_enqueue_script( 'surbma-yes-no-popup-scripts', plugins_url( '', __FILE__ ) . '/js/scripts-min.js', array( 'jquery' ), '2.27.1', true );
	wp_enqueue_style( 'surbma-yes-no-popup-styles', plugins_url( '', __FILE__ ) . '/css/styles.css', false, '2.27.1' );
}

add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
function surbma_yes_no_popup_block() {
	if( !isset( $_COOKIE['surbma-yes-no-popup'] ) ) {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$.UIkit.modal(('#surbma-yes-no-popup'), {center: true,keyboard: false,bgclose: false}).show();
		});
	</script>
	<div id="surbma-yes-no-popup" class="uk-modal">
        <div class="uk-modal-dialog">
			<div class="uk-modal-header">
				<h2>Orvosi ajánlás?</h2>
			</div>
			<p>A következő tartalmat csak akkor tekintheti meg, ha orvosa az adott terméket táplálásterápia céljára javasolta.</p>
			<div class="uk-modal-footer uk-text-right">
				<button id="button1" type="button" class="uk-button uk-button-large uk-button-success uk-modal-close">Igen</button>
				<button id="button2" type="button" class="uk-button uk-button-large uk-button-danger">Nem</button>
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
    	document.getElementById("button1").onclick = function () {
			setCookie();
    	};
    	document.getElementById("button2").onclick = function () {
        	location.href = "/";
    	};
	</script>
	<?php
	}
}
