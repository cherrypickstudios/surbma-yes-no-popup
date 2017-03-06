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
<div class="premium-wp uk-grid uk-margin-top">
	<div class="wrap uk-width-9-10">
		<h1 class="dashicons-before dashicons-welcome-view-site"><?php _e( 'Surbma - Yes/No Popup Settings', 'surbma-yes-no-popup' ); ?></h1>

		<form class="uk-form" method="post" action="options.php">
			<?php settings_fields( 'surbma_yes_no_popup_options' ); ?>
			<?php $options = get_option( 'surbma_yes_no_popup_fields' ); ?>

			<div class="uk-grid">
				<div class="uk-width-1-1">
					<div class="uk-panel uk-panel-box uk-panel-box-secondary uk-panel-header">
						<h3 class="uk-panel-title"><?php _e( 'Popup Content', 'surbma-yes-no-popup' ); ?></h3>

						<table class="form-table">
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popuptitle]"><?php _e( 'Popup Title', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popuptitle]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popuptitle]" value="<?php esc_attr_e( $options['popuptitle'] ); ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popuptext]"><?php _e( 'Popup Text', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<textarea id="surbma_yes_no_popup_fields[popuptext]" class="large-text" cols="50" rows="10" name="surbma_yes_no_popup_fields[popuptext]"><?php echo stripslashes( $options['popuptext'] ); ?></textarea>
									<p><?php _e( 'Allowed HTML tags in this field', 'surbma-yes-no-popup' ); ?>:<br /><pre><?php echo allowed_tags(); ?></pre></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupbutton1text]"><?php _e( 'Popup Button 1 Text', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupbutton1text]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popupbutton1text]" value="<?php esc_attr_e( $options['popupbutton1text'] ); ?>" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupbutton1style]"><?php _e( 'Popup Button 1 Style', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<select name="surbma_yes_no_popup_fields[popupbutton1style]">
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
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupbutton2text]"><?php _e( 'Popup Button 2 Text', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupbutton2text]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popupbutton2text]" value="<?php esc_attr_e( $options['popupbutton2text'] ); ?>" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupbutton2style]"><?php _e( 'Popup Button 2 Style', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<select name="surbma_yes_no_popup_fields[popupbutton2style]">
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
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupbuttonurl]"><?php _e( 'Popup Button Redirect URL', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupbuttonurl]" class="regular-text" type="url" name="surbma_yes_no_popup_fields[popupbuttonurl]" value="<?php esc_attr_e( $options['popupbuttonurl'] ); ?>" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupbuttonoptions]"><?php _e( 'Popup Button Options', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<select name="surbma_yes_no_popup_fields[popupbuttonoptions]">
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
								</td>
							</tr>
						</table>

						<p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>

					</div>
					<div class="uk-panel uk-panel-box uk-panel-box-secondary uk-panel-header">
						<h3 class="uk-panel-title"><?php _e( 'Popup Display', 'surbma-yes-no-popup' ); ?></h3>

						<table class="form-table">
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupthemes]"><?php _e( 'Popup Theme', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<select name="surbma_yes_no_popup_fields[popupthemes]">
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
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php _e( 'Where to show PopUp?', 'surbma-yes-no-popup' ); ?></th>
								<td>
									<p><input id="surbma_yes_no_popup_fields[popupshoweverywhere]" name="surbma_yes_no_popup_fields[popupshoweverywhere]" type="checkbox" value="1" <?php checked( '1', $options['popupshoweverywhere'] ); ?> />
									<label class="description" for="surbma_yes_no_popup_fields[popupshoweverywhere]"><?php _e( 'EVERYWHERE', 'surbma-yes-no-popup' ); ?></label></p>
									<p class="description"><?php _e( 'If this option is enabled, all other options below will be ignored!', 'surbma-yes-no-popup' ); ?></p>
									<hr>
									<p><input id="surbma_yes_no_popup_fields[popupshowfrontpage]" name="surbma_yes_no_popup_fields[popupshowfrontpage]" type="checkbox" value="1" <?php checked( '1', $options['popupshowfrontpage'] ); ?> />
									<label class="description" for="surbma_yes_no_popup_fields[popupshowfrontpage]"><?php _e( 'Frontpage', 'surbma-yes-no-popup' ); ?></label></p>
									<p><input id="surbma_yes_no_popup_fields[popupshowblog]" name="surbma_yes_no_popup_fields[popupshowblog]" type="checkbox" value="1" <?php checked( '1', $options['popupshowblog'] ); ?> />
									<label class="description" for="surbma_yes_no_popup_fields[popupshowblog]"><?php _e( 'Blog', 'surbma-yes-no-popup' ); ?></label></p>
									<p><input id="surbma_yes_no_popup_fields[popupshowarchive]" name="surbma_yes_no_popup_fields[popupshowarchive]" type="checkbox" value="1" <?php checked( '1', $options['popupshowarchive'] ); ?> />
									<label class="description" for="surbma_yes_no_popup_fields[popupshowarchive]"><?php _e( 'Archive pages', 'surbma-yes-no-popup' ); ?></label></p>
									<p><input id="surbma_yes_no_popup_fields[popupshowallposts]" name="surbma_yes_no_popup_fields[popupshowallposts]" type="checkbox" value="1" <?php checked( '1', $options['popupshowallposts'] ); ?> />
									<label class="description" for="surbma_yes_no_popup_fields[popupshowallposts]"><?php _e( 'All posts', 'surbma-yes-no-popup' ); ?></label></p>
									<p><input id="surbma_yes_no_popup_fields[popupshowallpages]" name="surbma_yes_no_popup_fields[popupshowallpages]" type="checkbox" value="1" <?php checked( '1', $options['popupshowallpages'] ); ?> />
									<label class="description" for="surbma_yes_no_popup_fields[popupshowallpages]"><?php _e( 'All pages', 'surbma-yes-no-popup' ); ?></label></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupshowposttypes]"><?php _e( 'On these Custom Post Types:', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupshowposttypes]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popupshowposttypes]" value="<?php esc_attr_e( $options['popupshowposttypes'] ); ?>" placeholder="CPT slugs in apostrophes, comma separated" />
									<p class="description"><?php _e( 'This will enable Popup on all CPT single pages.', 'surbma-yes-no-popup' ); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupshowposts]"><?php _e( 'Only on these posts:', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupshowposts]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popupshowposts]" value="<?php esc_attr_e( $options['popupshowposts'] ); ?>" placeholder="IDs, comma separated" />
									<p class="description"><?php _e( 'If post IDs are entered, "All posts" and CPT options will be ignored!', 'surbma-yes-no-popup' ); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupshowpages]"><?php _e( 'Only on these pages:', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupshowpages]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popupshowpages]" value="<?php esc_attr_e( $options['popupshowpages'] ); ?>" placeholder="IDs, comma separated" />
									<p class="description"><?php _e( 'If page IDs are entered, "All pages" option will be ignored!', 'surbma-yes-no-popup' ); ?></p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupshowcategories]"><?php _e( 'Only on these category archive pages:', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupshowcategories]" class="regular-text" type="text" name="surbma_yes_no_popup_fields[popupshowcategories]" value="<?php esc_attr_e( $options['popupshowcategories'] ); ?>" placeholder="Category IDs, comma separated" />
									<p class="description"><?php _e( 'This will enable Popup on category archive and all the category post single pages.', 'surbma-yes-no-popup' ); ?></p>
								</td>
							</tr>
						</table>

						<p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>

					</div>
					<div class="uk-panel uk-panel-box uk-panel-box-secondary uk-panel-header">
						<h3 class="uk-panel-title"><?php _e( 'Popup Options', 'surbma-yes-no-popup' ); ?></h3>

						<table class="form-table">
							<tr valign="top">
								<th scope="row">
									<label class="description" for="surbma_yes_no_popup_fields[popupcookiedays]"><?php _e( 'Cookie expires in (days):', 'surbma-yes-no-popup' ); ?></label>
								</th>
								<td>
									<input id="surbma_yes_no_popup_fields[popupcookiedays]" class="small-text" type="number" name="surbma_yes_no_popup_fields[popupcookiedays]" value="<?php esc_attr_e( $options['popupcookiedays'] ); ?>" placeholder="Days" />
									<p class="description"><?php _e( 'Default value is 1 day.', 'surbma-yes-no-popup' ); ?></p>
								</td>
							</tr>
						</table>

						<p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>

					</div>
				</div>
			</div>
		</form>
	</div>
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
	$input['popupshowposttypes'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowposttypes'] ) );
	$input['popupshowpages'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowpages'] ) );
	$input['popupshowpages'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowpages'] ) );
	$input['popupshowcategories'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowcategories'] ) );

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

	if ( ! isset( $input['popupshowallposts'] ) )
		$input['popupshowallposts'] = null;
	$input['popupshowallposts'] = ( $input['popupshowallposts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['popupshowallpages'] ) )
		$input['popupshowallpages'] = null;
	$input['popupshowallpages'] = ( $input['popupshowallpages'] == 1 ? 1 : 0 );

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
