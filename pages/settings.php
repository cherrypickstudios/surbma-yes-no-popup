<?php

add_action( 'admin_init', 'surbma_yes_no_popup_fields_init' );
function surbma_yes_no_popup_fields_init() {
	register_setting(
		'surbma_yes_no_popup_options',
		'surbma_yes_no_popup_fields',
		'surbma_yes_no_popup_fields_validate'
	);
}

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

$popup_themes = array(
	'normal' => array(
		'value' => 'normal',
		'label' => __( 'Normal theme', 'surbma-yes-no-popup' )
	),
	'normal-centered' => array(
		'value' => 'normal-centered',
		'label' => __( 'Normal centered theme', 'surbma-yes-no-popup' )
	),
	'full-page-light' => array(
		'value' => 'full-page-light',
		'label' => __( 'Full Page Light theme', 'surbma-yes-no-popup' )
	),
	'full-page-dark' => array(
		'value' => 'full-page-dark',
		'label' => __( 'Full Page Dark theme', 'surbma-yes-no-popup' )
	)
);

function surbma_yes_no_popup_settings_page() {

	global $popupbuttons_options;
	global $popupbutton1sstyle_options;
	global $popupbutton2sstyle_options;
	global $popup_themes;

?>
<div class="surbma-admin">
	<?php surbma_admin_header(); ?>
	<div class="wrap">
	<div class="uk-grid-small" uk-grid>
		<div class="uk-width-3-4@m">
		<form class="uk-form-horizontal" method="post" action="options.php">
			<?php settings_fields( 'surbma_yes_no_popup_options' ); ?>
			<?php $options = get_option( 'surbma_yes_no_popup_fields' ); ?>
					<div class="uk-card uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header">
							<h3 class="uk-card-title"><?php _e( 'Popup Content', 'surbma-yes-no-popup' ); ?></h3>
						</div>
						<div class="uk-card-body">
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popuptitle]"><?php _e( 'Popup Title', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="surbma_yes_no_popup_fields[popuptitle]" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popuptitle]" value="<?php esc_attr_e( $options['popuptitle'] ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popuptext]"><?php _e( 'Popup Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<textarea id="surbma_yes_no_popup_fields[popuptext]" class="uk-textarea" cols="50" rows="10" name="surbma_yes_no_popup_fields[popuptext]"><?php echo stripslashes( $options['popuptext'] ); ?></textarea>
									<p><?php _e( 'Allowed HTML tags in this field', 'surbma-yes-no-popup' ); ?>:<br /><pre><?php echo allowed_tags(); ?></pre></p>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton1text]"><?php _e( 'Popup Button 1 Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="surbma_yes_no_popup_fields[popupbutton1text]" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbutton1text]" value="<?php esc_attr_e( $options['popupbutton1text'] ); ?>" />
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
									<input id="surbma_yes_no_popup_fields[popupbutton2text]" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbutton2text]" value="<?php esc_attr_e( $options['popupbutton2text'] ); ?>" />
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
									<input id="surbma_yes_no_popup_fields[popupbuttonurl]" class="uk-input" type="url" name="surbma_yes_no_popup_fields[popupbuttonurl]" value="<?php esc_attr_e( $options['popupbuttonurl'] ); ?>" />
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

					<div class="uk-card uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header">
							<h3 class="uk-card-title"><?php _e( 'Popup Display', 'surbma-yes-no-popup' ); ?></h3>
						</div>
						<div class="uk-card-body">
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupthemes]"><?php _e( 'Popup Theme', 'surbma-yes-no-popup' ); ?></label>
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
								<div class="uk-form-label"><?php _e( 'Where to show PopUp?', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'EVERYWHERE', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popupshoweverywhere]" name="surbma_yes_no_popup_fields[popupshoweverywhere]" type="checkbox" value="1" <?php checked( '1', $options['popupshoweverywhere'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p><?php _e( 'Except on this page', 'surbma-yes-no-popup' ); ?>:
									<input id="surbma_yes_no_popup_fields[popupexcepthere]" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupexcepthere]" value="<?php esc_attr_e( $options['popupexcepthere'] ); ?>" placeholder="ID" /> (<?php _e( 'You can give only ONE PAGE ID!', 'surbma-yes-no-popup' ); ?>)</p>
									<p class="uk-text-meta"><?php _e( 'If this option is enabled, all other options below will be ignored!', 'surbma-yes-no-popup' ); ?></p>
									<hr>
									<p class="switch-wrap">
										<?php _e( 'Frontpage', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popupshowfrontpage]" name="surbma_yes_no_popup_fields[popupshowfrontpage]" type="checkbox" value="1" <?php checked( '1', $options['popupshowfrontpage'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Blog', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popupshowblog]" name="surbma_yes_no_popup_fields[popupshowblog]" type="checkbox" value="1" <?php checked( '1', $options['popupshowblog'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Archive pages', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popupshowarchive]" name="surbma_yes_no_popup_fields[popupshowarchive]" type="checkbox" value="1" <?php checked( '1', $options['popupshowarchive'] ); ?> />
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
													<input id="surbma_yes_no_popup_fields[<?php echo $popupshowcpt; ?>]" name="surbma_yes_no_popup_fields[<?php echo $popupshowcpt; ?>]" type="checkbox" value="1" <?php checked( '1', $popupshowcptValue ); ?> />
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
									<input id="surbma_yes_no_popup_fields[popupshowposts]" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowposts]" value="<?php esc_attr_e( $options['popupshowposts'] ); ?>" placeholder="IDs, comma separated" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowpages]"><?php _e( 'Only on these pages:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="surbma_yes_no_popup_fields[popupshowpages]" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowpages]" value="<?php esc_attr_e( $options['popupshowpages'] ); ?>" placeholder="IDs, comma separated" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowcategories]"><?php _e( 'Only on these category archive pages:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="surbma_yes_no_popup_fields[popupshowcategories]" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowcategories]" value="<?php esc_attr_e( $options['popupshowcategories'] ); ?>" placeholder="Category IDs, comma separated" />
									<p class="uk-text-meta"><?php _e( 'This will enable Popup on category archive and all the category post single pages.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Membership mode', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Hide Popup for logged in users', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popuphideloggedin]" name="surbma_yes_no_popup_fields[popuphideloggedin]" type="checkbox" value="1" <?php checked( '1', $options['popuphideloggedin'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Always show Popup for NOT logged in users', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popupshownotloggedin]" name="surbma_yes_no_popup_fields[popupshownotloggedin]" type="checkbox" value="1" <?php checked( '1', $options['popupshownotloggedin'] ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'One button mode (Show only Popup Button 1)', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<input id="surbma_yes_no_popup_fields[popuphidebutton2]" name="surbma_yes_no_popup_fields[popuphidebutton2]" type="checkbox" value="1" <?php checked( '1', $options['popuphidebutton2'] ); ?> />
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
											<input id="surbma_yes_no_popup_fields[popupdebug]" name="surbma_yes_no_popup_fields[popupdebug]" type="checkbox" value="1" <?php checked( '1', $options['popupdebug'] ); ?> />
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

					<div class="uk-card uk-card-default uk-card-hover">
						<div class="uk-card-header">
							<h3 class="uk-card-title"><?php _e( 'Popup Options', 'surbma-yes-no-popup' ); ?></h3>
						</div>
						<div class="uk-card-body">
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupcookiedays]"><?php _e( 'Cookie expires in (days):', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<input id="surbma_yes_no_popup_fields[popupcookiedays]" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupcookiedays]" value="<?php esc_attr_e( $options['popupcookiedays'] ); ?>" placeholder="Days" />
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
		<div class="uk-width-1-4@m">
			<div uk-sticky="offset: 42; bottom: #bottom">
				<div class="uk-card uk-card-small uk-card-default">
					<div class="uk-card-media-top">
						<img src="<?php echo SURBMA_YES_NO_POPUP_PLUGIN_URL; ?>/admin/donate.jpg" alt="Donate">
					</div>
					<div class="uk-card-body">
						<p><?php _e( 'It\'s a free WordPress plugin, made with a lot of care and love. Please consider to donate my work! You can do it for free just by using my Affiliate links to buy something, that you really need. All links are related to WordPress.', 'surbma-yes-no-popup' ); ?></p>
						<p><a class="uk-button uk-button-default uk-width-1-1" href="https://surbma.com/donate/" target="_blank"><?php _e( 'FREE Donation', 'surbma-yes-no-popup' ); ?></a></p>
					</div>
				</div>
				<div class="uk-card uk-card-small uk-card-secondary uk-card-body">
					<p class="uk-text-right"><?php _e( 'License: GPLv2', 'surbma-yes-no-popup' ); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="uk-margin-bottom" id="bottom"></div>
	</div>
	<?php surbma_admin_footer(); ?>
</div>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function surbma_yes_no_popup_fields_validate( $input ) {
	global $popupbuttons_options;
	global $popupbutton1sstyle_options;
	global $popupbutton2sstyle_options;
	global $popup_themes;

	// Say our text option must be safe text with no HTML tags
	$input['popupbuttonurl'] = wp_filter_nohtml_kses( $input['popupbuttonurl'] );
	$input['popupbuttonurl'] = esc_url_raw( $input['popupbuttonurl'] );
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

	if ( ! isset( $input['popupshoweverywhere'] ) )
		$input['popupshoweverywhere'] = null;
	$input['popupshoweverywhere'] = ( $input['popupshoweverywhere'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popupshowfrontpage'] ) )
		$input['popupshowfrontpage'] = null;
	$input['popupshowfrontpage'] = ( $input['popupshowfrontpage'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popupshowblog'] ) )
		$input['popupshowblog'] = null;
	$input['popupshowblog'] = ( $input['popupshowblog'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popupshowarchive'] ) )
		$input['popupshowarchive'] = null;
	$input['popupshowarchive'] = ( $input['popupshowarchive'] == 1 ? 1 : 0 );

	foreach ( get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' ) as $post_type ) {
		$popupshowcpt = 'popupshowcpt-' . $post_type->name;
		if ( ! isset( $input[$popupshowcpt] ) )
			$input[$popupshowcpt] = null;
		$input[$popupshowcpt] = ( $input[$popupshowcpt] == 1 ? 1 : 0 );
	}

	if ( ! isset( $input['popuphideloggedin'] ) )
		$input['popuphideloggedin'] = null;
	$input['popuphideloggedin'] = ( $input['popuphideloggedin'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popupshownotloggedin'] ) )
		$input['popupshownotloggedin'] = null;
	$input['popupshownotloggedin'] = ( $input['popupshownotloggedin'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popuphidebutton2'] ) )
		$input['popuphidebutton2'] = null;
	$input['popuphidebutton2'] = ( $input['popuphidebutton2'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popupdebug'] ) )
		$input['popupdebug'] = null;
	$input['popupdebug'] = ( $input['popupdebug'] == 1 ? 1 : 0 );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['popupbuttonoptions'], $popupbuttons_options ) )
		$input['popupbuttonoptions'] = null;
	if ( ! array_key_exists( $input['popupbutton1style'], $popupbutton1sstyle_options ) )
		$input['popupbutton1style'] = null;
	if ( ! array_key_exists( $input['popupbutton2style'], $popupbutton2sstyle_options ) )
		$input['popupbutton2style'] = null;
	if ( ! array_key_exists( $input['popupthemes'], $popup_themes ) )
		$input['popupthemes'] = null;

	return $input;
}
