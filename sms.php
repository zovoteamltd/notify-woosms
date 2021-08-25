<?php
function zovo_woosms_send_sms($mobilenumber, $smsbodytext){
	$options = get_option( 'zovo_woosms_settings' );
	$body = array(
    'recipient' => $mobilenumber,
    'sender' => $options['zovo_woosms_api_mask'],
    'body' => $smsbodytext,
    'userid' => $options['zovo_woosms_api_user_name'],
    'password' => $options['zovo_woosms_api_password']
	);

	$args = array(
	    'body' => $body,
	    'timeout' => '5',
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'headers' => array(),
	    'cookies' => array()
	);

	if ($options['zovo_woosms_select_provider'] == 'zovogeeks_psms') {
		$response = wp_remote_post( 'http://sms.zovogeeks.com/api/sms/v1/send', $args );
	} elseif ($options['zovo_woosms_select_provider'] == 'zovogeeks_esms') {
		$apikey = $options['zovo_woosms_api_key'];
		$response = wp_remote_post( 'http://sms.zovogeeks.com/smsapi?api_key='.$apikey.'&type=text&contacts='.$mobilenumber.'&msg='.$smsbodytext.'&senderid='.$options['zovo_woosms_api_mask'] );
	} elseif ($options['zovo_woosms_select_provider'] == 'zovo_gsms') {
		$apikey = $options['zovo_woosms_api_key'];
		$response = wp_remote_post( 'http://sms.zovogeeks.com/smsapi?api_key='.$apikey.'&type=text&contacts='.$mobilenumber.'&msg='.$smsbodytext.'&senderid='.$options['zovo_woosms_api_mask'] );
	}


	return false;
}
