<?php

include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/pages/settings.php');

/* Admin options menu */
function surbma_yes_no_popup_add_menus() {
	global $surbma_yes_no_popup_settings_page;
	$surbma_yes_no_popup_settings_page = add_submenu_page(
		'cps-plugins-menu',
		__( 'CPS | Age Verification', 'surbma-yes-no-popup' ),
		__( 'Age Verification', 'surbma-yes-no-popup' ),
		'manage_options',
		'surbma-yes-no-popup-menu',
		'surbma_yes_no_popup_settings_page'
	);
}
add_action( 'admin_menu', 'surbma_yes_no_popup_add_menus' );

// Custom styles and scripts for admin pages
function surbma_yes_no_popup_admin_enqueue_scripts( $hook ) {
	global $surbma_yes_no_popup_settings_page;
	if ( $hook == $surbma_yes_no_popup_settings_page ) {
		add_action( 'admin_enqueue_scripts', 'cps_admin_scripts', 9999 );
	}
}
add_action( 'admin_enqueue_scripts', 'surbma_yes_no_popup_admin_enqueue_scripts' );

function surbma_yes_no_popup_admin_sidebar() {
	$options = get_option( 'cps_framework_fields' );
?><div uk-sticky="offset: 42; bottom: #bottom">
	<div class="uk-card uk-card-small uk-card-default uk-card-hover">
		<div class="uk-card-header uk-background-muted">
			<h3 class="uk-card-title"><?php _e( 'Informations', 'cps-framework' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #informations"></a></h3>
		</div>
		<div id="informations" class="uk-card-body">
			<p><a id="purchase" class="uk-button uk-button-large uk-button-danger uk-width-1-1" href="#" title="<?php _e( 'Activate all the features of the CPS | Last Defense plugin!', 'cps-framework' ); ?>"><?php _e( 'Buy Premium Now!', 'cps-framework' ); ?></a></p>
			<div class="uk-alert-primary" style="display: none;" uk-alert>
				<?php _e( '<p>Use this special <strong>COUPON</strong> coupon to get 50% OFF your first purchase, which is available till <strong>Dec 31, 2099</strong></p>', 'cps-framework' ); ?>
			</div>

			<h4 class="uk-heading-divider"><?php _e( 'Plugin links', 'cps-framework' ); ?></h4>
			<ul class="uk-list">
				<li><a href="https://wordpress.org/support/plugin/cps-framework" target="_blank"><?php _e( 'Official support forum', 'cps-framework' ); ?></a></li>
				<li><a href="https://hu.wordpress.org/plugins/cps-framework/#reviews" target="_blank"><?php _e( 'Read our reviews', 'cps-framework' ); ?></a></li>
			</ul>
			<hr>
			<p>
				<strong><?php _e( 'Do you like this plugin? Please give a 5 star review', 'cps-framework' ); ?>:</strong>
				 <a href="https://wordpress.org/support/plugin/cps-framework/reviews/#new-post" target="_blank"><?php _e( 'write a new review', 'cps-framework' ); ?></a>
			</p>
			<h4 class="uk-heading-divider"><?php _e( 'Features coming soon', 'cps-framework' ); ?></h4>
			<ul class="uk-list">
				<li><span uk-icon="icon: check; ratio: 0.8"></span> <?php _e( 'New feature', 'cps-framework' ); ?></li>
			</ul>
		</div>
		<div class="uk-card-footer uk-background-muted">
			<p class="uk-text-right"><?php _e( 'License: GPLv2', 'cps-framework' ); ?></p>
		</div>
	</div>
</div>
<script>
	var handler = FS.Checkout.configure({
		plugin_id: 	'3580',
		plan_id: 	'5747',
		public_key: 'pk_f9fa0bba3e6f914cac26c92904872'
	});
	$('#purchase').on('click', function(e) {
		handler.open({
			name: 				'CPS | Framework',
			subtitle: 			'CPS | Framework Premium',
			licenses: 			1,
			hide_coupon: 		true,
			purchaseCompleted: 	function(response){},
			success: 			function(response){}
		});
		e.preventDefault();
	});
</script>
<?php
}
