<?php

$api_key = '4a8797-801f87-21e9d2-5fc4c2-5745fa';
$contacts = $Phone;
$from = 'SPTSMS';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pinnacle.in/index.php/sms/send/MHCHAI/'.$contacts.'/'.$sms_text.'/TXT?apikey=4a8797-801f87-21e9d2-5fc4c2-5745fa&dltentityid='.$dltentityid.'&&dlttempid='.$dlttempid;',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
/*echo $response;*/





/*header("Location:https://api.pinnacle.in/index.php/sms/send/MHCHAI/8149693719/Please enter ".$otp." test OTP on our platform to complete the verification process. Thank you for choosing Maha Chai./TXT?apikey=4a8797-801f87-21e9d2-5fc4c2-5745fa");*/

/*$api_key = '4a8797-801f87-21e9d2-5fc4c2-5745fa';
$contacts = $Phone;
$from = 'SPTSMS';

$sms_text = urlencode($smstxt);

$api_url = "https://api.pinnacle.in/index.php/sms/send/MHCHAI/7447797866/Please enter 44778 test OTP on our platform to complete the verification process. Thank you for choosing Maha Chai./TXT?apikey=4a8797-801f87-21e9d2-5fc4c2-5745fa";

$response = file_get_contents($api_url);*/


/*$api_key = '4a8797-801f87-21e9d2-5fc4c2-5745fa';
$contacts = $Phone;
$from = 'SPTSMS';

$sms_text = urlencode($smstxt);

$api_url = "https://api.pinnacle.in/index.php/sms/send/MHCHAI/".$contacts."/".$sms_text."/TXT?apikey=4a8797-801f87-21e9d2-5fc4c2-5745fa"&dltentityid=".$dltentityid."&&dlttempid=".$dlttempid;"


$response = file_get_contents($api_url);*/

?>