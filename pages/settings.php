<?php

add_action( 'admin_init', 'surbma_yes_no_popup_fields_init' );
function surbma_yes_no_popup_fields_init() {
	register_setting(
		'surbma_yes_no_popup_options',
		'surbma_yes_no_popup_fields',
		'surbma_yes_no_popup_fields_validate'
	);
}

// UPLOAD ENGINE
function load_wp_media_files() {
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

/**
 * Create arrays for our select and radio options
 */
$popupbuttons_options = array(
	'button-1-redirect' => array(
		'value' => 'button-1-redirect',
		'label' => __( 'Button 1: Redirect / Button 2: Close', 'surbma-yes-no-popup' )
	),
	'button-2-redirect' => array(
		'value' => 'button-2-redirect',
		'label' => __( 'Button 1: Close / Button 2: Redirect', 'surbma-yes-no-popup' )
	)
);

$popupbutton1sstyle_options = array(
	'default' => array(
		'value' => 'default',
		'label' => __( 'Default', 'surbma-yes-no-popup' )
	),
	'primary' => array(
		'value' => 'primary',
		'label' => __( 'Primary', 'surbma-yes-no-popup' )
	),
	'success' => array(
		'value' => 'success',
		'label' => __( 'Success', 'surbma-yes-no-popup' )
	),
	'danger' => array(
		'value' => 'danger',
		'label' => __( 'Danger', 'surbma-yes-no-popup' )
	)
);

$popupbutton2sstyle_options = array(
	'default' => array(
		'value' => 'default',
		'label' => __( 'Default', 'surbma-yes-no-popup' )
	),
	'primary' => array(
		'value' => 'primary',
		'label' => __( 'Primary', 'surbma-yes-no-popup' )
	),
	'success' => array(
		'value' => 'success',
		'label' => __( 'Success', 'surbma-yes-no-popup' )
	),
	'danger' => array(
		'value' => 'danger',
		'label' => __( 'Danger', 'surbma-yes-no-popup' )
	)
);

$popup_styles = array(
	'default' => array(
		'value' => 'default',
		'label' => __( 'Default Style', 'surbma-yes-no-popup' )
	),
	'almost-flat' => array(
		'value' => 'almost-flat',
		'label' => __( 'Almost Flat Style', 'surbma-yes-no-popup' )
	),
	'gradient' => array(
		'value' => 'gradient',
		'label' => __( 'Gradient Style', 'surbma-yes-no-popup' )
	)
);

$popup_themes = array(
	'normal' => array(
		'value' => 'normal',
		'label' => __( 'Normal theme', 'surbma-yes-no-popup' )
	),
	'full-page' => array(
		'value' => 'full-page',
		'label' => __( 'Full Page Theme', 'surbma-yes-no-popup' )
	)
);

function surbma_yes_no_popup_settings_page() {

	global $popupbuttons_options;
	global $popupbutton1sstyle_options;
	global $popupbutton2sstyle_options;
	global $popup_styles;
	global $popup_themes;

?>
<div class="cps-admin">
	<?php cps_admin_header( SURBMA_YES_NO_POPUP_PLUGIN_FILE ); ?>
	<div class="wrap">
		<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true ) { ?>
			<div class="updated notice is-dismissible"><p><strong><?php _e( 'Settings saved.' ); ?></strong></p></div>
		<?php } ?>

		<div class="uk-grid-small" uk-grid>
			<div class="uk-width-3-4@l">
				<form class="uk-form-horizontal" method="post" action="options.php">
					<?php settings_fields( 'surbma_yes_no_popup_options' ); ?>
					<?php $options = get_option( 'surbma_yes_no_popup_fields' ); ?>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Content', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-content"></a></h3>
						</div>
						<div id="popup-content" class="uk-card-body">
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupimage]"><?php _e( 'Popup Image', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<div class="uk-grid-small" uk-grid>
										<div class="uk-width-expand">
											<?php $popupimageValue = isset( $options['popupimage'] ) ? $options['popupimage'] : ''; ?>
											<input id="popupimage" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupimage]" value="<?php echo stripslashes( $popupimageValue ); ?>" />
										</div>
										<div class="uk-width-auto">
											<button id="upload-popupimage" class="uk-button uk-button-default uk-width-1-1"><span uk-icon="icon: image;ratio: .75"></span>&nbsp; <?php _e( 'Upload', 'surbma-yes-no-popup' ); ?></button>
										</div>
									</div>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popuptitle]"><?php _e( 'Popup Title', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popuptitle" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popuptitle]" value="<?php esc_attr_e( $options['popuptitle'] ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popuptext]"><?php _e( 'Popup Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<textarea id="popuptext" class="uk-textarea" cols="50" rows="10" name="surbma_yes_no_popup_fields[popuptext]"><?php echo stripslashes( $options['popuptext'] ); ?></textarea>
									<p><?php _e( 'Allowed HTML tags in this field', 'surbma-yes-no-popup' ); ?>:<br /><pre><?php echo allowed_tags(); ?></pre></p>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton1text]"><?php _e( 'Popup Button 1 Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupbutton1text" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbutton1text]" value="<?php esc_attr_e( $options['popupbutton1text'] ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton1style]"><?php _e( 'Popup Button 1 Style', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbutton1style]">
										<?php
											$selected = $options['popupbutton1style'];
											$p = '';
											$r = '';

											foreach ( $popupbutton1sstyle_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton2text]"><?php _e( 'Popup Button 2 Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupbutton2text" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbutton2text]" value="<?php esc_attr_e( $options['popupbutton2text'] ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton2style]"><?php _e( 'Popup Button 2 Style', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbutton2style]">
										<?php
											$selected = $options['popupbutton2style'];
											$p = '';
											$r = '';

											foreach ( $popupbutton2sstyle_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbuttonurl]"><?php _e( 'Popup Button Redirect URL', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupbuttonurl" class="uk-input" type="url" name="surbma_yes_no_popup_fields[popupbuttonurl]" value="<?php esc_attr_e( $options['popupbuttonurl'] ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbuttonoptions]"><?php _e( 'Popup Button Options', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbuttonoptions]">
										<?php
											$selected = $options['popupbuttonoptions'];
											$p = '';
											$r = '';

											foreach ( $popupbuttons_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="button--primary uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Design', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-design"></a></h3>
						</div>
						<div id="popup-design" class="uk-card-body">
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupstyles]"><?php _e( 'Styles', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupstyles]">
										<?php
											$popupstylesValue = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'default';
											$selected = $popupstylesValue;
											$p = '';
											$r = '';

											foreach ( $popup_styles as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupthemes]"><?php _e( 'Themes', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupthemes]">
										<?php
											$selected = $options['popupthemes'];
											$p = '';
											$r = '';

											foreach ( $popup_themes as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Display options', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Dark mode', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupdarkmodeValue = isset( $options['popupdarkmode'] ) ? $options['popupdarkmode'] : 0; ?>
											<input id="popupdarkmode" name="surbma_yes_no_popup_fields[popupdarkmode]" type="checkbox" value="1" <?php checked( '1', $popupdarkmodeValue); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Center text alignment', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupcentertextValue = isset( $options['popupcentertext'] ) ? $options['popupcentertext'] : 0; ?>
											<input id="popupcentertext" name="surbma_yes_no_popup_fields[popupcentertext]" type="checkbox" value="1" <?php checked( '1', $popupcentertextValue); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Vertically center the Popup', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupverticalcenterValue = isset( $options['popupverticalcenter'] ) ? $options['popupverticalcenter'] : 0; ?>
											<input id="popupverticalcenter" name="surbma_yes_no_popup_fields[popupverticalcenter]" type="checkbox" value="1" <?php checked( '1', $popupverticalcenterValue); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Large modifier', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popuplargeValue = isset( $options['popuplarge'] ) ? $options['popuplarge'] : 0; ?>
											<input id="popuplarge" name="surbma_yes_no_popup_fields[popuplarge]" type="checkbox" value="1" <?php checked( '1', $popuplargeValue); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="button--primary uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Display', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-display"></a></h3>
						</div>
						<div id="popup-display" class="uk-card-body">
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Where to show PopUp?', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'EVERYWHERE', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popupshoweverywhere" name="surbma_yes_no_popup_fields[popupshoweverywhere]" type="checkbox" value="1" <?php checked( '1', $options['popupshoweverywhere'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p><?php _e( 'Except on this page', 'surbma-yes-no-popup' ); ?>:
									<input id="popupexcepthere" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupexcepthere]" value="<?php esc_attr_e( $options['popupexcepthere'] ); ?>" placeholder="ID" /> (<?php _e( 'You can give only ONE PAGE ID!', 'surbma-yes-no-popup' ); ?>)</p>
									<p class="uk-text-meta"><?php _e( 'If this option is enabled, all other options below will be ignored!', 'surbma-yes-no-popup' ); ?></p>
									<hr>
									<p class="switch-wrap">
										<?php _e( 'Frontpage', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popupshowfrontpage" name="surbma_yes_no_popup_fields[popupshowfrontpage]" type="checkbox" value="1" <?php checked( '1', $options['popupshowfrontpage'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Blog', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popupshowblog" name="surbma_yes_no_popup_fields[popupshowblog]" type="checkbox" value="1" <?php checked( '1', $options['popupshowblog'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Archive pages', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popupshowarchive" name="surbma_yes_no_popup_fields[popupshowarchive]" type="checkbox" value="1" <?php checked( '1', $options['popupshowarchive'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<?php
									foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) {
										$popupshowcpt = 'popupshowcpt-' . $post_type->name;
										?>
											<p class="switch-wrap">
												<?php echo __( 'All', 'surbma-yes-no-popup' ) . ' ' . $post_type->labels->name; ?>:
												<label class="switch">
													<?php $popupshowcptValue = isset( $options[$popupshowcpt] ) ? $options[$popupshowcpt] : 0; ?>
													<input id="<?php echo $popupshowcpt; ?>" name="surbma_yes_no_popup_fields[<?php echo $popupshowcpt; ?>]" type="checkbox" value="1" <?php checked( '1', $popupshowcptValue ); ?> />
													<span class="slider round"></span>
												</label>
											</p>
										<?php
									}
									?>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowposts]"><?php _e( 'Only on these posts:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupshowposts" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowposts]" value="<?php esc_attr_e( $options['popupshowposts'] ); ?>" placeholder="IDs, comma separated" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowpages]"><?php _e( 'Only on these pages:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupshowpages" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowpages]" value="<?php esc_attr_e( $options['popupshowpages'] ); ?>" placeholder="IDs, comma separated" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowcategories]"><?php _e( 'Only on these category archive pages:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupshowcategories" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowcategories]" value="<?php esc_attr_e( $options['popupshowcategories'] ); ?>" placeholder="Category IDs, comma separated" />
									<p class="uk-text-meta"><?php _e( 'This will enable Popup on category archive and all the category post single pages.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Membership mode', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Hide Popup for logged in users', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popuphideloggedin" name="surbma_yes_no_popup_fields[popuphideloggedin]" type="checkbox" value="1" <?php checked( '1', $options['popuphideloggedin'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Always show Popup for NOT logged in users', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popupshownotloggedin" name="surbma_yes_no_popup_fields[popupshownotloggedin]" type="checkbox" value="1" <?php checked( '1', $options['popupshownotloggedin'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'One button mode (Show only Popup Button 1)', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popuphidebutton2" name="surbma_yes_no_popup_fields[popuphidebutton2]" type="checkbox" value="1" <?php checked( '1', $options['popuphidebutton2'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Debug mode', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Always show Popup', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="popupdebug" name="surbma_yes_no_popup_fields[popupdebug]" type="checkbox" value="1" <?php checked( '1', $options['popupdebug'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="uk-text-meta"><?php _e( 'If this option is enabled, Popup will always be visible, whatever button is clicked! Good for content testing.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="button--primary uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Options', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-options"></a></h3>
						</div>
						<div id="popup-options" class="uk-card-body">
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupcookiedays]"><?php _e( 'Cookie expires in (days):', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="popupcookiedays" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupcookiedays]" value="<?php esc_attr_e( $options['popupcookiedays'] ); ?>" placeholder="Days" />
									<p class="uk-text-meta"><?php _e( 'Default value is 1 day.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="button--primary uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>
				</form>
			</div>
			<div class="uk-width-1-4@l">
				<?php surbma_yes_no_popup_admin_sidebar() ?>
			</div>
		</div>
		<div class="uk-margin-bottom" id="bottom"></div>
	</div>
	<?php cps_admin_footer( SURBMA_YES_NO_POPUP_PLUGIN_FILE ); ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#upload-popupimage').click(function(e) {
		e.preventDefault();
		var image = wp.media({
			title: 'Upload Image',
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			$('#popupimage').val(image_url);
		});
	});
});
</script>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function surbma_yes_no_popup_fields_validate( $input ) {
	global $popupbuttons_options;
	global $popupbutton1sstyle_options;
	global $popupbutton2sstyle_options;
	global $popup_styles;
	global $popup_themes;

	// Say our text option must be safe URL
	$input['popupbuttonurl'] = wp_filter_nohtml_kses( $input['popupbuttonurl'] );
	$input['popupbuttonurl'] = esc_url_raw( $input['popupbuttonurl'] );
	$input['popupimage'] = wp_filter_nohtml_kses( $input['popupimage'] );
	$input['popupimage'] = esc_url_raw( $input['popupimage'] );

	// Say our text option must be safe text with no HTML tags
	$input['popuptitle'] = wp_filter_nohtml_kses( $input['popuptitle'] );
	$input['popupbutton1text'] = wp_filter_nohtml_kses( $input['popupbutton1text'] );
	$input['popupbutton2text'] = wp_filter_nohtml_kses( $input['popupbutton2text'] );
	$input['popupshowpages'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowpages'] ) );
	$input['popupshowpages'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowpages'] ) );
	$input['popupshowcategories'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowcategories'] ) );

	// Say our input option must be only numbers
	$input['popupexcepthere'] = preg_replace( "/[^0-9]/", "", $input['popupexcepthere'] );

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['popuptext'] = wp_filter_post_kses( $input['popuptext'] );

	// Checkbox validation.
	$input['popupdarkmode'] = isset( $input['popupdarkmode'] ) && $input['popupdarkmode'] == 1 ? 1 : 0;
	$input['popupcentertext'] = isset( $input['popupcentertext'] ) && $input['popupcentertext'] == 1 ? 1 : 0;
	$input['popupverticalcenter'] = isset( $input['popupverticalcenter'] ) && $input['popupverticalcenter'] == 1 ? 1 : 0;
	$input['popuplarge'] = isset( $input['popuplarge'] ) && $input['popuplarge'] == 1 ? 1 : 0;
	$input['popupshoweverywhere'] = isset( $input['popupshoweverywhere'] ) && $input['popupshoweverywhere'] == 1 ? 1 : 0;
	$input['popupshowfrontpage'] = isset( $input['popupshowfrontpage'] ) && $input['popupshowfrontpage'] == 1 ? 1 : 0;
	$input['popupshowblog'] = isset( $input['popupshowblog'] ) && $input['popupshowblog'] == 1 ? 1 : 0;
	$input['popupshowarchive'] = isset( $input['popupshowarchive'] ) && $input['popupshowarchive'] == 1 ? 1 : 0;

	foreach ( get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' ) as $post_type ) {
		$popupshowcpt = 'popupshowcpt-' . $post_type->name;
		$input[$popupshowcpt] = isset( $input[$popupshowcpt] ) && $input[$popupshowcpt] == 1 ? 1 : 0;
	}

	$input['popuphideloggedin'] = isset( $input['popuphideloggedin'] ) && $input['popuphideloggedin'] == 1 ? 1 : 0;
	$input['popupshownotloggedin'] = isset( $input['popupshownotloggedin'] ) && $input['popupshownotloggedin'] == 1 ? 1 : 0;
	$input['popuphidebutton2'] = isset( $input['popuphidebutton2'] ) && $input['popuphidebutton2'] == 1 ? 1 : 0;
	$input['popupdebug'] = isset( $input['popupdebug'] ) && $input['popupdebug'] == 1 ? 1 : 0;

	// Our select option must actually be in our array of select options
	if ( !array_key_exists( $input['popupbuttonoptions'], $popupbuttons_options ) )
		$input['popupbuttonoptions'] = null;
	if ( !array_key_exists( $input['popupbutton1style'], $popupbutton1sstyle_options ) )
		$input['popupbutton1style'] = null;
	if ( !array_key_exists( $input['popupbutton2style'], $popupbutton2sstyle_options ) )
		$input['popupbutton2style'] = null;
	if ( !array_key_exists( $input['popupstyles'], $popup_styles ) )
		$input['popupstyles'] = 'default';
	if ( !array_key_exists( $input['popupthemes'], $popup_themes ) )
		$input['popupthemes'] = null;

	return $input;
}
