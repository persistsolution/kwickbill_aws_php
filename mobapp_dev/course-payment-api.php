<?php 
session_start();
require_once 'config.php';
$amount = $_POST['amount'];
$userid = $_POST['userid'];
$phone = $_POST['phone'];
$pkgid = $_POST['pkgid'];
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');
$CreatedDate = date('Y-m-d');
$CurrMonth = date('m');
$CurrYear = date('Y');
$sql2 = "SELECT Roll FROM tbl_users WHERE id='$userid'";
$row2 = getRecord($sql2);
$Roll = $row2['Roll'];
if($Roll != 55 || $Roll != 5 || $Roll != 9 || $Roll != 22 || $Roll != 23){
	$sql3 = "SELECT * FROM tbl_exe_double_cashback WHERE Month='$CurrMonth' AND Year='$CurrYear' AND UserId='$userid'";
	$rncnt3 = getRoe($sql3);
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
else{
$sql44 = "SELECT * FROM tbl_money_range WHERE RangeTo>='$net_amt' AND RangeFrom<='$net_amt' LIMIT 1";
$row44 = getRecord($sql44);
$Percentage = $row44['Percentage'];
$ExtraAmt = $amount*($Percentage/100);
$CashbackPrice = $amount + ($amount*($Percentage/100));  
}

$sql = "INSERT INTO wallet SET UserId='$userid',Amount='$CashbackPrice',Narration='Amount Added into wallet',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$OrderTime',ExtraAmt='$ExtraAmt'";
$conn->query($sql);
//echo "<script>window.location.href='my-orders.php';</script>";


if($Roll == 55){
    echo "http://hanshgroup.com/mahabuddy/custapp/profile.php";
}
else if($Roll == 5){
   echo "http://hanshgroup.com/mahabuddy/mobapp/profile.php"; 
}
else{
   echo "http://hanshgroup.com/mahabuddy/exeapp/profile.php";  
}

?>