<?php

function cps_plugins_header_title( $title ) {
	return __( 'Surbma & Cherry Pick Studios Plugins', 'cps-sdk' );
}

function cps_plugins_page() {
	add_filter( 'cps_admin_header_title', 'cps_plugins_header_title' );
?>
<div class="cps-admin cps-settings-page">
	<?php cps_admin_header(); ?>
	<div class="wrap">
		<h2 class="uk-text-center uk--margin-bottom">Surbma & Cherry Pick Studios plugins</h2>
		<p class="uk-text-center uk-margin-remove-top uk-margin-medium-bottom"><strong>If you like Surbma & Cherry Pick Studios plugins, take a look at our other plugins! <br>We are sure, you will find useful solutions for your website.</strong></p>
		<div class="uk--grid-small uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-3@l" uk-grid uk-height-match="target: > div > div > .uk-card > .uk-card-body">
		<?php
			$json = file_get_contents( 'https://www.cherrypickstudios.com/cps-plugins.json' );
			$plugins = json_decode( $json, true );

			foreach ( $plugins as $plugin ) {
				$title = isset( $plugin['title'] ) && $plugin['title'] != '' ? $plugin['title'] : '';
				$img = isset( $plugin['img'] ) && $plugin['img'] != '' ? $plugin['img'] : false;
				$badge = isset( $plugin['badge'] ) && $plugin['badge'] != '' ? $plugin['badge'] : false;
				$description = isset( $plugin['description'] ) && $plugin['description'] != '' ? $plugin['description'] : false;
				$alert = isset( $plugin['alert'] ) && $plugin['alert'] != '' ? $plugin['alert'] : false;
				$url = isset( $plugin['url'] ) && $plugin['url'] != '' ? $plugin['url'] : false;
				$button = isset( $plugin['button'] ) && $plugin['button'] != '' ? $plugin['button'] : 'Visit Plugin Page';

				if( $title != '' ) { ?>
				<div>
					<div class="uk-card uk--card-small uk-card-default uk-card-hover">
						<div class="uk-card-media-top">
							<?php if( $img != false ) { ?>
							<img src="<?php echo $img; ?>" alt="<?php echo $title; ?>">
							<?php } else { ?>
							<img src="<?php echo CPS_URL; ?>/images/cps-logo.svg" alt="" style="width: 220px;display: block;margin: 0 auto;padding: 60px;">
							<?php } ?>
						</div>
						<div class="uk-card-header uk-background-muted">
							<?php if( $badge != false ) { ?>
							<div class="uk-card-badge uk-label"><?php echo $badge; ?></div>
							<?php } ?>
							<h3 class="uk-card-title" style="font-size: 18px;"><strong><?php echo $title; ?></strong></h3>
						</div>
						<?php if( $description != false ) { ?>
						<div class="uk-card-body">
							<?php echo $description; ?>
							<?php if( $alert != false ) { ?>
							<div class="uk-alert-primary uk-margin-top" uk-alert>
								<?php echo $alert; ?>
							</div>
							<?php } ?>
						</div>
						<?php } ?>
						<?php if( $url != false ) { ?>
						<div class="uk-card-footer uk-background-muted">
							<a id="purchase" class="uk-button uk-button-large uk-button-primary uk-width-1-1" href="<?php echo $url; ?>" target="_blank"><?php _e( $button, 'cps-sdk' ); ?></a>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php }
			}
		?>
		</div>
		<div class="uk-margin-medium-bottom" id="bottom"></div>
		<p class="uk-text-center">Surbma = Cherry Pick Studios = Surbma <br>Eventually all Surbma branded plugins will be renamed with our new brand: Cherry Pick Studios</p>
	</div>
	<?php cps_admin_footer(); ?>
</div>
<?php
}
