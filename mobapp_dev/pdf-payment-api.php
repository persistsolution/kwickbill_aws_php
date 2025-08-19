<?php 
session_start();
require_once 'config.php';
$sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
$row55 = getRecord($sql55);
$ExpMail = $row55['ExpMail'];
$OrderMail = $row55['OrderMail'];
$AdminMail = $row55['AdminMail'];
$AccountMail = $row55['AccountMail'];
$AllMail = $row55['AllMail'];
if($_REQUEST['flag'] == 1){
$amount = $_REQUEST['amount'];
$userid = $_REQUEST['userid'];
$phone = $_REQUEST['phone'];
$pkgid = $_REQUEST['pkgid'];
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');
$CreatedDate = date('Y-m-d');
$CreatedDate2 = date('d-M-Y');
$CurrMonth = date('m');
$CurrYear = date('Y');
$net_amt = $_REQUEST['amount'];
$sql2 = "SELECT Roll,Phone FROM tbl_users WHERE id='$userid'";
$row2 = getRecord($sql2);
$Roll = $row2['Roll'];
$Phone = $row2['Phone'];
$names = array('55', '5', '9', '22', '23');
if(in_array($Roll,$names)){
    $sql44 = "SELECT * FROM tbl_money_range WHERE RangeTo>='$net_amt' AND RangeFrom<='$net_amt' LIMIT 1";
$row44 = getRecord($sql44);
$Percentage = $row44['Percentage'];
$ExtraAmt = $amount*($Percentage/100);
$CashbackPrice = $amount + ($amount*($Percentage/100));  
}
else{
$sql3 = "SELECT * FROM tbl_exe_double_cashback WHERE Month='$CurrMonth' AND Year='$CurrYear' AND UserId='$userid'";
	$rncnt3 = getRow($sql3);
	if($rncnt3 > 0){
		$sql44 = "SELECT * FROM tbl_money_range WHERE RangeTo>='$net_amt' AND RangeFrom<='$net_amt' LIMIT 1";
		$row44 = getRecord($sql44);
		$Percentage = $row44['Percentage'];
		$ExtraAmt = $amount*($Percentage/100);
		$CashbackPrice = $amount + ($amount*($Percentage/100)); 
	}
		else{
			$sql3 = "INSERT INTO tbl_exe_double_cashback SET Month='$CurrMonth',Year='$CurrYear',UserId='$userid',CreatedDate='$CreatedDate'";
			$conn->query($sql3);
			$ExtraAmt = $amount;
			$CashbackPrice = $amount*2;
		}
}

$sql = "INSERT INTO wallet SET UserId='$userid',Amount='$amount',Narration='Amount Added into wallet',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$OrderTime',ExtraAmt='$ExtraAmt'";
$conn->query($sql);

$sql = "INSERT INTO wallet SET UserId='$userid',Amount='$ExtraAmt',Narration='Extra Benefit Amount Added into wallet',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$OrderTime',ExtraAmt='$ExtraAmt'";
$conn->query($sql);


$sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='$userid' group by Status) as a";
                        $res11x = $conn->query($sql11x);
                        $row11x = $res11x->fetch_assoc();
$mybalance = $row11x['credit'] - $row11x['debit'];

$Phone = $row2['Phone'];
 $smstxt = "Update! INR ".$amount." Credited in your Maha Chai Wallet on ".$CreatedDate2.". Avl Wallet Bal INR ".$mybalance.". For any query please call 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875379839610";
  include '../incsmsapi.php';  


if($Roll == 55){
    echo "https://kwickfoods.in/custapp/profile.php";
}
else if($Roll == 5){
   echo "https://kwickfoods.in/mobapp/profile.php"; 
}
else{
   echo "https://kwickfoods.in/exeapp/profile.php";  
}
}


if($_REQUEST['flag'] == 2){
$amount = $_POST['amount'];
$userid = $_POST['userid'];
$phone = $_POST['phone'];
$pkgid = $_REQUEST['pkgid'];
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');
$CreatedDate = date('Y-m-d');
$CreatedDate2 = date('d-M-Y');

$sql2 = "SELECT Roll,Phone FROM tbl_users WHERE id='$userid'";
$row2 = getRecord($sql2);
$Roll = $row2['Roll'];

$sql = "UPDATE orders SET PayStatus=1 WHERE id='$pkgid'";
$conn->query($sql);

$sql2 = "INSERT INTO wallet SELECT * FROM temp_wallet WHERE Oid='$pkgid'";
$conn->query($sql2);

$sql = "DELETE FROM temp_wallet WHERE Oid='$pkgid'";
$conn->query($sql);

$sql33 = "SELECT * FROM orders WHERE id='$pkgid'";
$row33 = getRecord($sql33); 
$OrderNo = $row33['OrderNo'];
$OrderDate = $row33['OrderDate'];
$Total_Order = $row33["OrderTotal"]+$row33["ServiceFee"]-$row33["Promoprice"]-$row33["Discount"]-$row33["WalletAmt"];
$ShippingCharge = $row33['ServiceFee'];
$Discount = $row33["Discount"];
$WalletAmt = $row33["WalletAmt"];
$CashbackAmt = $row33['CashbackAmt'];  
$to = $OrderMail;
  $allmail = $AllMail;
  //include("incordercontent.php");
  //include("sendmailsmtp.php");
  
  $Phone = $row2['Phone'];
  
 $smstxt = "Your order has been successfully placed. Order No: ".$OrderNo." Date: ".$CreatedDate2." Thank you for choosing Maha Chai! For any query please call us: 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875363508806";
  include '../incsmsapi.php';  
  
if($Roll == 55){
    echo "https://kwickfoods.in/custapp/my-orders.php";
}
else if($Roll == 5){
   echo "https://kwickfoods.in/mobapp/my-orders.php"; 
}
else{
   echo "https://kwickfoods.in/exeapp/my-orders.php";  
}

}

if($_REQUEST['flag'] == 3){
$amount = $_POST['amount'];
$userid = $_POST['userid'];
$phone = $_POST['phone'];
$pkgid = $_REQUEST['pkgid'];
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');
$CreatedDate = date('Y-m-d');
$CreatedDate2 = date('d-M-Y');

$sql2 = "SELECT Roll,Phone FROM tbl_users WHERE id='$userid'";
$row2 = getRecord($sql2);
$Roll = $row2['Roll'];

$sql = "UPDATE tbl_users SET KycStatus=1,KycDate='$OrderDate' WHERE id='$userid'";
$conn->query($sql);

$sql = "INSERT INTO wallet SET UserId='$userid',Amount='$amount',Narration='KYC Cashback Amount Added into wallet',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$OrderTime',ExtraAmt='0'";
$conn->query($sql);

$sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='$userid' group by Status) as a";
                        $res11x = $conn->query($sql11x);
                        $row11x = $res11x->fetch_assoc();
$mybalance = $row11x['credit'] - $row11x['debit'];

$Phone = $row2['Phone'];
 $smstxt = "Update! INR ".$amount." Credited in your Maha Chai Wallet on ".$CreatedDate2.". Avl Wallet Bal INR ".$mybalance.". For any query please call 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875379839610";
  include '../incsmsapi.php';
  
if($Roll == 55){
    echo "https://kwickfoods.in/custapp/profile.php";
}
else if($Roll == 5){
   echo "https://kwickfoods.in/mobapp/profile.php"; 
}
else{
   echo "https://kwickfoods.in/exeapp/profile.php";  
}

}


?>