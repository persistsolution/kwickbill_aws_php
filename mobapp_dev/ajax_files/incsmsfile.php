<?php
$api_key = '2617273432AE1B';
$contacts = $Phone;
$from = 'DDSSER';
$sms_text = urlencode('Your OTP is '.$otp);

$api_url = "https://www.fast2sms.com/dev/bulkV2?authorization=GvB9bDndULpCJ0e4awoPcyTsfi72K8RkzHIxZN3SO1mWFQEl6rXJGefNwa4bxBAj69MgZtnTP7Il3EUY&message=".$sms_text."&language=english&route=q&numbers=".$contacts;
//$api_url = "http://jskbulksms.in/app/smsapi/index.php?key=".$api_key."&campaign=1&routeid=46&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=1307163593767864474";
//echo $api_url;
//Submit to server

$response = file_get_contents( $api_url);
//echo $response;

?>