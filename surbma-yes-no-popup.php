<?php

/*
Plugin Name: CPS | Age Verification
Plugin URI: https://surbma.com/wordpress-plugins/
Description: Shows a popup with age verification options.

Version: 4.0

Author: CherryPickStudios
Author URI: https://www.cherrypickstudios.com/

License: GPLv2

Text Domain: surbma-yes-no-popup
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) exit( 'Good try! :)' );

define( 'SURBMA_YES_NO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_FILE', __FILE__ );

// Localization
function surbma_yes_no_popup_init() {
	load_plugin_textdomain( 'surbma-yes-no-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'surbma_yes_no_popup_init' );

// CPS SDK
if ( !function_exists( 'cps' ) ) {
	function cps() {
		// Include CPS SDK.
		require_once dirname( __FILE__ ) . '/cps/start.php';
	}

	// Init CPS.
	cps();
}

// Include files
if ( is_admin() ) {
	include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/lib/admin.php' );
}

function surbma_yes_no_popup_enqueue_scripts() {
	$options = get_option( 'surbma_yes_no_popup_fields' );
	$popupstylesValue = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
	wp_enqueue_script( 'surbma-yes-no-popup-scripts', plugins_url( '', __FILE__ ) . '/assets/js/scripts-min.js', array( 'jquery' ), '2.27.5', true );
	wp_enqueue_style( 'surbma-yes-no-popup-styles', plugins_url( '', __FILE__ ) . '/assets/css/styles-' . $popupstylesValue . '.css', false, '2.27.5' );
}
add_action( 'wp_enqueue_scripts', 'surbma_yes_no_popup_enqueue_scripts', 999 );

function surbma_yes_no_popup_show() {
	$options = get_option( 'surbma_yes_no_popup_fields' );

	$popupshoweverywhere = $options['popupshoweverywhere'];
	$popupexcepthere = $options['popupexcepthere'];

	if( $popupshoweverywhere == 1 && $popupexcepthere == '' ) {
		add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
	}
	elseif( $popupshoweverywhere == 1 && $popupexcepthere != '' && !is_page( $popupexcepthere ) ) {
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
		foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) {
			$popupshowcpt = 'popupshowcpt-' . $post_type->name;
			if( isset( $options[$popupshowcpt] ) && $options[$popupshowcpt] != '' && is_singular( $post_type->name ) ) {
				add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
			}
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
add_action( 'wp_footer', 'surbma_yes_no_popup_show' );

function surbma_yes_no_popup_block() {
	$options = get_option( 'surbma_yes_no_popup_fields' );

	$popuphideloggedin = 0;
	if ( isset( $options['popuphideloggedin'] ) && $options['popuphideloggedin'] == 1 && is_user_logged_in() )
		$popuphideloggedin = 1;

	$popupshownotloggedin = 0;
	if ( isset( $options['popupshownotloggedin'] ) && $options['popupshownotloggedin'] == 1 && !is_user_logged_in() )
		$popupshownotloggedin = 1;

	$popuphidebutton2 = 0;
	if ( isset( $options['popuphidebutton2'] ) && $options['popuphidebutton2'] == 1 )
		$popuphidebutton2 = 1;

	$popupdebug = 0;
	if ( isset( $options['popupdebug'] ) && $options['popupdebug'] == 1 )
		$popupdebug = 1;

	$popupcookiedays = 1;
	if ( isset( $options['popupcookiedays'] ) && $options['popupcookiedays'] != '' )
		$popupcookiedays = $options['popupcookiedays'];

	$popupthemes = 'normal';
	if ( isset( $options['popupthemes'] ) && $options['popupthemes'] != '' )
		$popupthemes = $options['popupthemes'];
	?>
<input type="hidden" id="popuphideloggedin" value="<?php echo $popuphideloggedin; ?>" />
<input type="hidden" id="popupshownotloggedin" value="<?php echo $popupshownotloggedin; ?>" />
<input type="hidden" id="popupdebug" value="<?php echo $popupdebug; ?>" />
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var show_modal = 0;
		if( $('#popupdebug').val() == '1' || $('#popupshownotloggedin').val() == '1' ) {
			show_modal = 1;
		} else {
			if( surbma_ynp_readCookie('surbma-yes-no-popup') != 'yes' && $('#popuphideloggedin').val() != '1' ) {
				show_modal = 1;
			}
		}
		if( show_modal == 1 ) {
			$.UIkit.modal(('#surbma-yes-no-popup'), {center: true,keyboard: false,bgclose: false}).show();
		}
		// console.log('show_modal'+show_modal);
	});
</script>
<div id="surbma-yes-no-popup" class="uk-modal <?php echo 'surbma-yes-no-popup-' . $popupthemes; ?>">
    <div class="uk-modal-dialog">
		<?php if( ( isset( $options['popupimage'] ) && $options['popupimage'] != '' ) || ( isset( $options['popuptitle'] ) && $options['popuptitle'] != '' ) ) { ?>
			<div class="uk-modal-header">
				<?php if( isset( $options['popupimage'] ) && $options['popupimage'] != '' ) { ?>
					<p><img src="<?php echo esc_attr_e( $options['popupimage'] ); ?>" class="" alt="<?php echo esc_attr_e( $options['popuptitle'] ); ?>"></p>
				<?php } ?>
				<?php if( isset( $options['popuptitle'] ) && $options['popuptitle'] != '' ) { ?>
					<h2><a href="#"></a><?php echo esc_attr_e( $options['popuptitle'] ); ?></h2>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if( isset( $options['popuptext'] ) && $options['popuptext'] != '' ) { ?>
			<div class="uk-modal-content"><?php echo stripslashes( $options['popuptext'] ); ?></div>
		<?php } ?>
		<div class="uk-modal-footer">
			<button id="button1" type="button" class="uk-button uk-button-large uk-button-<?php echo esc_attr_e( $options['popupbutton1style'] ); ?><?php if( $options['popupbuttonoptions'] != 'button-1-redirect' ) echo ' uk-modal-close'; ?>"><?php echo esc_attr_e( $options['popupbutton1text'] ); ?></button>
			<?php if( $popuphidebutton2 != 1 ) { ?>
				<button id="button2" type="button" class="uk-button uk-button-large uk-button-<?php echo esc_attr_e( $options['popupbutton2style'] ); ?><?php if( $options['popupbuttonoptions'] == 'button-1-redirect' ) echo ' uk-modal-close'; ?>"><?php echo esc_attr_e( $options['popupbutton2text'] ); ?></button>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function surbma_ynp_setCookie() {
	    var d = new Date();
	    d.setTime(d.getTime() + (<?php echo esc_attr_e( $popupcookiedays ); ?>*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = "surbma-yes-no-popup=yes;" + expires + ";path=/";
	}
	function surbma_ynp_readCookie(cookieName) {
		var re = new RegExp('[; ]'+cookieName+'=([^\\s;]*)');
		var sMatch = (' '+document.cookie).match(re);
		if (cookieName && sMatch) return unescape(sMatch[1]);
		return '';
	}
	<?php if( $options['popupbuttonoptions'] != 'button-1-redirect' ) { ?>
    	document.getElementById("button1").onclick = function () {
			surbma_ynp_setCookie();
    	};
    	document.getElementById("button2").onclick = function () {
        	location.href = "<?php echo esc_attr_e( $options['popupbuttonurl'] ); ?>";
    	};
	<?php } else { ?>
    	document.getElementById("button1").onclick = function () {
        	location.href = "<?php echo esc_attr_e( $options['popupbuttonurl'] ); ?>";
    	};
    	document.getElementById("button2").onclick = function () {
			surbma_ynp_setCookie();
    	};
	<?php } ?>
</script>
<?php
}
