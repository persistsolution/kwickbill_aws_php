<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
</html>
<?php 
session_start();
require_once '../config.php'; 
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
  $keyId = 'rzp_live_JyjHE7UWYPkxTt';
 $keySecret = '6mD2ELwei49WegohZIglVLkq';
$displayCurrency = 'INR';
$success = "1";

$error = "Payment Failed";
 $OrderId = $_POST['razorpay_order_id'];
 $PaymentId = $_POST['razorpay_payment_id'];
$PaySign = $_POST['razorpay_signature'];
//print_r($_POST);
/*if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
       //echo $success; 
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_POST['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
        
        
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}*/
$payment_id = $_POST['razorpay_payment_id'];
if ($success == 1)
{
 $amount = $_GET["amount"];
    $oid = $_GET["oid"];
    $FrId = $_GET['FrId'];
   
    $CreatedDate = date('Y-m-d');
    $OrderTime = date('h:i a');

    $sql3 = "SELECT * FROM tbl_payment_details WHERE payment_id='$payment_id'";
      $row = getRecord($sql3);
      $oldpayid = $row['payment_id'];
      if($oldpayid == $payment_id){}
        else{
      $sql = "INSERT INTO tbl_payment_details SET UserId='$user_id',payment_id='$payment_id',payment_status='$payment_status',amount='$amount',buyer_name='$buyer_name',buyer_phone='$buyer_phone',buyer_email='$buyer_email',instrument_type='$instrument_type',billing_instrument='$billing_instrument',created_at='$created_at',PkgId='$oid',FrId='$FrId'";
      $conn->query($sql);
      $sql = "UPDATE tbl_customer_invoice SET Status='1',PayType='Online Payment' WHERE id='$oid'";
      $conn->query($sql);
      
        }
?>
      <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "for Placing Order",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
     
window.location.href="../order/<?php echo $FrId;?>";
  
  }
}); });</script>
<?php
    //mail
    //include("incmailcontent.php");
    //include("sendmailsmtp.php");  
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

 ?>