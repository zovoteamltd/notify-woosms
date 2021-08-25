<?php
function Zovo_woosms_scripts() {
    wp_enqueue_style( 'notify_woosms_style',  plugin_dir_url( __FILE__ ) . "/css/style.css");
}

add_action( 'admin_print_styles', 'Zovo_woosms_scripts' );

add_action( 'admin_menu', 'zovo_woosms_add_admin_menu' );
add_action( 'admin_init', 'zovo_woosms_settings_init' );


function zovo_woosms_add_admin_menu(  ) {

	add_options_page( 'zovo WooSMS', 'zovo WooSMS', 'manage_options', 'zovo_woosms', 'zovo_woosms_options_page' );

}


function zovo_woosms_settings_init(  ) {

	register_setting( 'pluginPage', 'zovo_woosms_settings' );

	add_settings_section(
		'zovo_woosms_pluginPage_api_section',
		__( 'API SETTINGS', 'zovo-woosms' ),
		'zovo_woosms_settings_api_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'zovo_woosms_enable_sms',
		__( 'SMS Notification:', 'zovo-woosms' ),
		'zovo_woosms_enable_sms_render',
		'pluginPage',
		'zovo_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'zovo_woosms_select_provider',
		__( 'Select SMS Provider', 'zovo_woosms' ),
		'zovo_woosms_select_provider_render',
		'pluginPage',
		'zovo_woosms_pluginPage_api_section'
	);

  add_settings_field(
		'zovo_woosms_api_key',
		__( 'API Key:', 'zovo-woosms' ),
		'zovo_woosms_api_key_render',
		'pluginPage',
		'zovo_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'zovo_woosms_api_user_name',
		__( 'User Name:', 'zovo-woosms' ),
		'zovo_woosms_api_user_name_render',
		'pluginPage',
		'zovo_woosms_pluginPage_api_section'
	);


	add_settings_field(
		'zovo_woosms_api_password',
		__( 'Password:', 'zovo-woosms' ),
		'zovo_woosms_api_password_render',
		'pluginPage',
		'zovo_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'zovo_woosms_api_mask',
		__( 'Sender Name:', 'zovo-woosms' ),
		'zovo_woosms_api_mask_render',
		'pluginPage',
		'zovo_woosms_pluginPage_api_section'
	);


	add_settings_section(
		'zovo_woosms_pluginPage_section',
		__( 'SMS TEMPLATES', 'zovo-woosms' ),
		'zovo_woosms_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'zovo_woosms_check_order_placed',
		__( 'New Order:', 'zovo-woosms' ),
		'zovo_woosms_check_order_placed_render',
		'pluginPage',
		'zovo_woosms_pluginPage_section'
	);

	add_settings_field(
		'zovo_woosms_template_order_placed',
		__( 'SMS Template:', 'zovo-woosms' ),
		'zovo_woosms_template_order_placed_render',
		'pluginPage',
		'zovo_woosms_pluginPage_section'
	);

	add_settings_field(
		'zovo_woosms_check_order_processing',
		__( 'Order Processing:', 'zovo-woosms' ),
		'zovo_woosms_check_order_processing_render',
		'pluginPage',
		'zovo_woosms_pluginPage_section'
	);

	add_settings_field(
		'zovo_woosms_template_order_processing',
		__( 'SMS Template:', 'zovo-woosms' ),
		'zovo_woosms_template_order_processing_render',
		'pluginPage',
		'zovo_woosms_pluginPage_section'
	);

	add_settings_field(
		'zovo_woosms_check_order_completed',
		__( 'Order Complete:', 'zovo-woosms' ),
		'zovo_woosms_check_order_completed_render',
		'pluginPage',
		'zovo_woosms_pluginPage_section'
	);

	add_settings_field(
		'zovo_woosms_template_order_completed',
		__( 'SMS Template:', 'zovo-woosms' ),
		'notify_woosms_template_order_completed_render',
		'pluginPage',
		'zovo_woosms_pluginPage_section'
	);


}


function zovo_woosms_enable_sms_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='checkbox' name='zovo_woosms_settings[zovo_woosms_enable_sms]' <?php checked( $options['zovo_woosms_enable_sms'], 1 ); ?> value='1'> Enable
	<?php

}


function zovo_woosms_select_provider_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<select name='zovo_woosms_settings[zovo_woosms_select_provider]'>
    <option value='zovogeeks_psms' <?php selected( $options['zovo_woosms_select_provider'], 'zovogeeks_psms' ); ?>>zovogeeks Psms</option>
    <option value='zovogeeks_esms' <?php selected( $options['zovo_woosms_select_provider'], 'zovogeeks_esms' ); ?>>zovogeeks Esms</option>
    <option value='zovogeeks_gsms' <?php selected( $options['zovo_woosms_select_provider'], 'zovogeeks_gsms' ); ?>>zovogeeks Gsms</option>
	</select>
	<?php

}

function zovo_woosms_api_key_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='text' name='zovo_woosms_settings[notifyzovo_woosms_api_key]' value='<?php echo $options['zovo_woosms_api_key']; ?>'>
  <p><i>If you use API KEY, You don't have to enter user name and password.</i></p>
	<?php

}

function zovo_woosms_api_user_name_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='text' name='zovo_woosms_settings[zovo_woosms_api_user_name]' value='<?php echo $options['zovo_woosms_api_user_name']; ?>'>
	<?php

}


function zovo_woosms_api_password_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='password' name='zovo_woosms_settings[zovo_woosms_api_password]' value='<?php echo $options['zovo_woosms_api_password']; ?>'>
	<?php

}


function zovo_woosms_api_mask_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='text' name='zovo_woosms_settings[zovo_woosms_api_mask]' value='<?php echo $options['zovo_woosms_api_mask']; ?>'>
	<?php

}


function zovo_woosms_check_order_placed_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='checkbox' name='zovo_woosms_settings[zovo_woosms_check_order_placed]' <?php checked( $options['zovo_woosms_check_order_placed'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function zovo_woosms_template_order_placed_render(  ) {

	$options = get_option( 'zovoy_woosms_settings' );
	?>
	<textarea cols='40' rows='5' name='zovo_woosms_settings[zovo_woosms_template_order_placed]'><?php echo $options['zovo_woosms_template_order_placed']; ?></textarea>
	<?php

}


function zovo_woosms_check_order_processing_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='checkbox' name='zovo_woosms_settings[zovo_woosms_check_order_processing]' <?php checked( $options['zovo_woosms_check_order_processing'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function zovo_woosms_template_order_processing_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<textarea cols='40' rows='5' name='zovo_woosms_settings[zovoy_woosms_template_order_processing]'><?php echo $options['zovo_woosms_template_order_processing']; ?></textarea>
	<?php

}


function zovo_woosms_check_order_completed_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<input type='checkbox' name='zovo_woosms_settings[zovo_woosms_check_order_completed]' <?php checked( $options['zovo_woosms_check_order_completed'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function zovo_woosms_template_order_completed_render(  ) {

	$options = get_option( 'zovo_woosms_settings' );
	?>
	<textarea cols='40' rows='5' name='zovo_woosms_settings[zovo_woosms_template_order_completed]'><?php echo $options['zovo_woosms_template_order_completed']; ?></textarea>
	<?php

}


function zovo_woosms_settings_section_callback(  ) {

	echo __( 'Please enter your sms body text you want to send. <p>Use <span>{{ordernumber}}</span> <span>{{customername}}</span> for dynamic information.</p>', 'zovo-woosms' );

}

function zovo_woosms_settings_api_section_callback(  ) {

	echo __( 'Please enter your SMS API information of zovo.', 'zovo-woosms' );

}


function zovo_woosms_options_page(  ) {

		?>
		<div class="zovo_woosms_settings_page">
			<div class="zovo_woosms_settings_page_inner">
				<div class="zovo_woosms_settings_page_header">

					<div class="zovo_woosms_settings_page_header_info">
						<h2><?php echo __("zovo WooSMS");?></h2>
					</div>
				</div>
				<div class="zovo_woosms_settings_page_body">
					<form action='options.php' method='post'>
						<?php
						settings_fields( 'pluginPage' );
						do_settings_sections( 'pluginPage' );
						submit_button();
						?>
					</form>
				</div>
				<div class="zovo_woosms_settings_page_footer">
					<h4><strong><?php echo __("Please Note:</strong> This is a thirtparty plugin.<br>This plugin is not managed by SMS providers.");?></h4>
					<p>Developed by: <a href="https://github.com/solaymanhaider" target="_blank"><?php echo __(" solayman haider");?></a></p>
				</div>
			</div>
		</div>

		<?php

}
