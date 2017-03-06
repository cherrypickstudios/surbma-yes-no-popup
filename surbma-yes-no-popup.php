<?php

/*
Plugin Name: Surbma - Yes/No Popup
Plugin URI: http://surbma.com/wordpress-plugins/
Description: Shows a popup with Yes/No options

Version: 1.4.0

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

add_action( 'wp_footer', 'surbma_yes_no_popup_show' );
function surbma_yes_no_popup_show() {
	$options = get_option( 'surbma_yes_no_popup_fields' );

	if( $options['popupshoweverywhere'] == 1 ) {
		add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
	}
	else {
		if( $options['popupshowfrontpage'] == 1 && is_front_page() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		if( $options['popupshowblog'] == 1 && is_home() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		if( $options['popupshowarchive'] == 1 && is_archive() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		if( $options['popupshowallposts'] == 1 && $options['popupshowposts'] == '' && is_singular( 'post' ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		if( $options['popupshowallpages'] == 1 && $options['popupshowpages'] == '' && is_page() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		$includeposttypes = $options['popupshowposttypes'] ? explode( ',', $options['popupshowposttypes'] ) : '';
		if( $options['popupshowposttypes'] != '' && $options['popupshowposts'] == '' && is_singular( $includeposttypes ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		$includeposts = $options['popupshowposts'] ? explode( ',', $options['popupshowposts'] ) : '';
		if( $options['popupshowposts'] != '' && is_single( $includeposts ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		$includepages = $options['popupshowpages'] ? explode( ',', $options['popupshowpages'] ) : '';
		if( $options['popupshowpages'] != '' && is_page( $includepages ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		$includecategories = $options['popupshowcategories'] ? explode( ',', $options['popupshowcategories'] ) : '';
		if( $options['popupshowcategories'] != '' && $options['popupshowarchive'] != 1 && ( is_category( $includecategories ) || in_category( $includecategories ) ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
	}
}

function surbma_yes_no_popup_block() {
	if( !isset( $_COOKIE['surbma-yes-no-popup'] ) || ( defined( 'WP_DEBUG' ) && WP_DEBUG == true ) ) {
		$options = get_option( 'surbma_yes_no_popup_fields' );

		if ( !isset( $options['popupcookiedays'] ) || $options['popupcookiedays'] == '' )
			$options['popupcookiedays'] = 1;
		if ( !isset( $options['popupthemes'] ) )
			$options['popupthemes'] = 'normal';
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$.UIkit.modal(('#surbma-yes-no-popup'), {center: true,keyboard: false,bgclose: false}).show();
		});
	</script>
	<div id="surbma-yes-no-popup" class="uk-modal <?php echo 'surbma-yes-no-popup-' . $options['popupthemes']; ?>">
        <div class="uk-modal-dialog">
			<div class="uk-modal-header">
				<h2><?php echo esc_attr_e( $options['popuptitle'] ); ?></h2>
			</div>
			<div class="uk-modal-content"><?php echo stripslashes( $options['popuptext'] ); ?></div>
			<div class="uk-modal-footer">
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
		    d.setTime(d.getTime() + (<?php echo esc_attr_e( $options['popupcookiedays'] ); ?>*24*60*60*1000));
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
