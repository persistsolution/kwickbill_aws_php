<?php 
if($_POST['action'] == 'sentAadharOtp'){
$curl = curl_init();
//
$data = [
    "aadhaar_number" => $_POST['AadharNo']
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.cashfree.com/verification/offline-aadhaar/otp",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "x-client-id: CF954657D1J6NM12Q4HS73BJNM6G",        // Replace <api-key> with your actual sandbox client ID
        "x-client-secret: cfsk_ma_prod_c268c3843c3c04c593d1dcdbd70c4e62_cd4402bd"     // Replace <api-key> with your actual sandbox client secret
    ],
]);

$response = curl_exec($curl);

if ($response === false) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo $response;
}
//echo $response;
curl_close($curl);
}


if($_POST['action'] == 'aadharOtpVerify'){

$curl = curl_init();

$data = [
    "otp" => $_POST['AadharOtp'],
    "ref_id" => $_POST['ref_id']
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.cashfree.com/verification/offline-aadhaar/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "x-client-id: CF954657D1J6NM12Q4HS73BJNM6G", // Replace with sandbox ID if sandbox
        "x-client-secret: cfsk_ma_prod_c268c3843c3c04c593d1dcdbd70c4e62_cd4402bd" // Replace with sandbox secret if sandbox
    ],
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

// Ensure JSON output
header('Content-Type: application/json');

if ($response === false) {
    echo json_encode([
        "status" => "ERROR",
        "message" => "cURL Error: " . $err
    ]);
} else {
    echo $response;
}

}

if($_POST['action'] == 'panOtpVerify'){

$curl = curl_init();
$data = [
    "pan" => $_POST['PanCardNo'],
    "name" => 'MAHACHAI'
];
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.cashfree.com/verification/pan",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "x-client-id: CF954657D1J6NM12Q4HS73BJNM6G",
    "x-client-secret: cfsk_ma_prod_c268c3843c3c04c593d1dcdbd70c4e62_cd4402bd"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}

if($_POST['action'] == 'GstVerify'){
$curl = curl_init();
$GstNo = $_POST['GstNo'];
$data = [
    "GSTIN" => $_POST['GstNo'],
    "business_name" => 'MAHACHAI PRIVATE LIMITED'
];
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.cashfree.com/verification/gstin",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "x-client-id: CF954657D1J6NM12Q4HS73BJNM6G",
    "x-client-secret: cfsk_ma_prod_c268c3843c3c04c593d1dcdbd70c4e62_cd4402bd"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}


if($_POST['action'] == 'BankAccountVerify'){

$curl = curl_init();
$GstNo = $_POST['GstNo'];
$data = [
    "bank_account" => $_POST['AccountNo'],
    "ifsc" => $_POST['IfscCode'],
    "name"=>'John Doe',
    "phone"=>'9999999999'
];
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.cashfree.com/verification/bank-account/sync",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
   "x-client-id: CF954657D1J6NM12Q4HS73BJNM6G",
    "x-client-secret: cfsk_ma_prod_c268c3843c3c04c593d1dcdbd70c4e62_cd4402bd"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}
?>
