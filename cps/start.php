<?php

// CPS SDK Version.
$this_sdk_version = '5.3';

define( 'CPS_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CPS_URL', plugins_url( '', __FILE__ ) );

// https://github.com/collizo4sky/persist-admin-notices-dismissal
require dirname( __FILE__ ) . '/vendors/pand/persist-admin-notices-dismissal.php';
add_action( 'admin_init', array( 'PAnD', 'init' ) );

// Include files.
if ( is_admin() ) {
	include_once dirname( __FILE__ ) . '/lib/admin.php';
}

// Custom styles and scripts for admin pages
function cps_admin_scripts() {
	wp_enqueue_script( 'freemius-checkout-js', 'https://checkout.freemius.com/checkout.min.js', array( 'jquery' ), '2.3.0' );
	wp_enqueue_script( 'uikit-js', CPS_URL . '/vendors/uikit/js/uikit.min.js', array( 'jquery' ), '3.1.6' );
	wp_enqueue_script( 'uikit-icons', CPS_URL . '/vendors/uikit/js/uikit-icons.min.js', array( 'jquery' ), '3.1.6' );
	wp_enqueue_style( 'uikit-css', CPS_URL . '/vendors/uikit/css/uikit.min.css', false, '3.1.6' );
	wp_enqueue_style( 'cps-admin', CPS_URL . '/assets/css/cps-admin.css' );
}

function cps_admin_header( $plugin_file = '' ) {
	if( $plugin_file != '' ) {
		$plugin_data = get_plugin_data( $plugin_file );
		$plugin_name = $plugin_data['Name'];
		$headertitle = $plugin_name . ' <span>by Cherry Pick Studios</span>';
	} else {
		$headertitle = 'Cherry Pick Studios <span>WordPress Plugins, That Just Works.</span>';
	}
	$headertitle = apply_filters( 'cps_admin_header_title', $headertitle );
	$fburl = apply_filters( 'cps_admin_header_facebook_url', 'https://www.facebook.com/groups/CherryPickStudios/' );
	$fbtitle = apply_filters( 'cps_admin_header_facebook_title', 'Join the Cherry Pick Studios Facebook Group, where you can ask any question or ask for new features. Everybody is welcome!' );
	$fbbuttontext = apply_filters( 'cps_admin_header_facebook_button_text', 'Join CPS Support Group' );
	$email = apply_filters( 'cps_admin_header_email', 'hello@cherrypickstudios.com' );
	$emailtitle = apply_filters( 'cps_admin_header_email_title', 'Cherry Pick Studios Email Support' );
	$website = apply_filters( 'cps_admin_header_website', 'https://www.cherrypickstudios.com/' );
	$websitetitle = apply_filters( 'cps_admin_header_website_title', 'Cherry Pick Studios Website' );
	$textDomain = apply_filters( 'cps_admin_header_textdomain', 'cps-sdk' );
	?><nav class="uk-navbar-container uk-margin" id="cps-header" uk-navbar>
		<div class="uk-navbar-left">
			<div class="uk-navbar-item uk-logo">
				<img src="<?php echo CPS_URL; ?>/assets/images/cps-logo.svg" alt="Cherry Pick Studios">
				<div><?php echo $headertitle ?></div>
			</div>
		</div>
		<div class="uk-navbar-right">
			<div class="uk-navbar-item">
				<a href="<?php echo $fburl ?>" class="facebook-button uk-button uk-button-primary" title="<?php _e( $fbtitle, $textDomain ); ?>" target="_blank"><span uk-icon="facebook"></span> <?php _e( $fbbuttontext, $textDomain ); ?></a>
			</div>
			<ul class="uk-navbar-nav">
				<li><a href="mailto:<?php echo $email ?>" title="<?php _e( $emailtitle, $textDomain ); ?>" target="_blank" uk-icon="mail"></a></li>
				<li><a href="<?php echo $website ?>" title="<?php _e( $websitetitle, $textDomain ); ?>" target="_blank" uk-icon="world"></a></li>
			</ul>
			<div class="uk-navbar-item"></div>
		</div>
	</nav>
	<div id="cps-admin-notification-placeholder" class="wrap"><h1></h1></div><?php
}

function cps_admin_footer( $plugin_file = '' ) {
	$home_url = get_option( 'home' );
	$wp_version = get_bloginfo( 'version' );
	$php = phpversion();
	if( $plugin_file != '' ) {
		$plugin_data = get_plugin_data( $plugin_file );
		$plugin_version = $plugin_data['Version'];
		$plugin_name = $plugin_data['Name'];
		$plugin_pluginURI = $plugin_data['PluginURI'];
		?><div class="uk-section uk-section-small">
	    	<div class="uk-text-center">
				<p>
					<strong><a class="uk-link-reset" href="<?php echo $plugin_pluginURI; ?>" target="_blank"><?php echo $plugin_name; ?></a></strong> - v.<?php echo $plugin_version; ?><br>
					Made with &hearts; by <img src="https://www.cherrypickstudios.com/cps-logo/?url=<?php echo urlencode( $home_url ); ?>&plugin=<?php echo urlencode( $plugin_name ); ?>&ver=<?php echo urlencode( $plugin_version ); ?>&wpver=<?php echo urlencode( $wp_version ); ?>&php=<?php echo urlencode( $php ); ?>" alt="Cherry Pick Studios" width="20"> <a class="uk-link-reset" href="https://www.cherrypickstudios.com" target="_blank">Cherry Pick Studios</a>
				</p>
			</div>
		</div><?php
	} else {
		?><div class="uk-section uk-section-small">
	    	<div class="uk-text-center">
				<p>
					Made with &hearts; by <img src="https://www.cherrypickstudios.com/cps-logo/?url=<?php echo urlencode( $home_url ); ?>&plugin=&ver=&wpver=<?php echo urlencode( $wp_version ); ?>&php=<?php echo urlencode( $php ); ?>" alt="Cherry Pick Studios" width="20"> <a class="uk-link-reset" href="https://www.cherrypickstudios.com" target="_blank">Cherry Pick Studios</a>
				</p>
			</div>
		</div><?php
	}
}
