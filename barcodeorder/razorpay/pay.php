<?php 
session_start();
require_once '../config.php';
require('razorpay-php/Razorpay.php');
// Create the Razorpay Order

use Razorpay\Api\Api;
 $keyId = 'rzp_live_JyjHE7UWYPkxTt';
 $keySecret = '6mD2ELwei49WegohZIglVLkq';
$displayCurrency = 'INR';

 $api = new Api($keyId, $keySecret);

 $amount = $_GET["amount"];
$name = $_GET["name"];
$phone = $_GET["phone"];
$email = $_GET["email"];
$oid = $_GET["oid"];
$FrId = $_GET["FrId"];
?>


<body>
      
      
    <style>
      .razorpay-payment-button {
       display: inline-block;
    padding: 20px 55px;
    font-size: 16px;
    font-weight: 600;
    line-height: 3px;
    color: #fff;
    border: none;
    font-weight: 600;
    border-radius: 4px;
    background-color: #f7b312;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    cursor: pointer;
     position: absolute;
  top: 35%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
      }
    </style>
        <!--Login Register section start-->
        
         
    <div class="ps-page--single" id="about-us">
        <div class="ps-about-intro">
            <div class="container">
                <div class="ps-section__header">
                    <h4 style="margin-bottom: 10px;text-align:center;">Pay Amount</h4>
                     <strong style="color: red;font-size: 18px;text-align: center;">Do Not Refresh the Page or Go to Next or Previous Page as it will lead to wrong transaction.</strong><br>
                   <form action="sucess.php?oid=<?php echo $oid;?>&amount=<?php echo $amount;?>&FrId=<?php echo $FrId;?>" method="POST">
    <!-- Note that the amount is in paise = 50 INR -->
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $keyId; ?>"
        data-amount="<?php echo $amount*100;?>"
        
        data-buttontext="Pay Now"
        data-name="MahaBuddy"
        data-order_id="<?php echo $razorpayOrder->id; ?>"
        data-description="MahaBuddy Txn with RazorPay"
        data-image=""
        data-prefill.name="<?php echo $name; ?>"
        data-prefill.email="<?php echo $email; ?>"
        data-prefill.contact="<?php echo $phone; ?>"
        data-theme.color="#27457b"
    ></script>
    <input type="hidden" value="Hidden Element" name="hidden">
    </form>
                </div>
                
                
            </div>
        </div>
        </div>
        
        <!--Login Register section end-->



</body>

</html>