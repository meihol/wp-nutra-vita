<?php
function send_sms($msg, $phonenumber){
    $apikey = 'dRu2ZH22Tf/3srdqstmisMe2+4K1i2OFRiBtovCOhmw=';
	$clientid = 'd9e63099-bba8-4fa5-ba6f-3256e764dbe9';
    $senderid = 'SEVAKK';

	// https://api.arihantsms.com/api/v2/SendSMS?ApiKey={ApiKey}&ClientId={ClientId}&SenderId={SenderId}&Message={Message}&MobileNumbers={MobileNumbers}
    // $url = "https://sms.mobileadz.in/api/push.json?apikey=$apikey&sender=$senderid&mobileno=$phonenumber&text=$msg";
	$url = "http://sms2.gatisofttech.in:6005/api/v2/SendSMS?ApiKey=$apikey&ClientId=$clientid&SenderId=$senderid&Message=$msg&MobileNumbers=91$phonenumber";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
}