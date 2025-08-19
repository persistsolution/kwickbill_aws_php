<?php
error_reporting(0);
$servername = "mysql-database.crq6yqcualdr.ap-south-1.rds.amazonaws.com";
$username = "admin";
$password = "admin12345";
$dbname = "mahachai";

/// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
// check connection 
if($conn->connect_error) {
    die("connection failed : " . $conn->connect_error);
} else {
     //echo "Successfully Connected";
}
$Proj_Title = "Maha Chai";
$SiteUrl = "https://mahabuddy.com/";
date_default_timezone_set("Asia/Kolkata");
/*$sms_username = "giradkatotp";
$sms_password = "ind123";
$sms_sender = "SAIAPP";
$site_url = "http://localhost/education";*/

function getList($sql){
  global $conn;  
    $res2 = $conn->query($sql);
    while($row2 = $res2->fetch_assoc()){
        $row3[] = $row2;
    }
    return $row3;
}

function getRecord($sql){
  global $conn;  
    $res2 = $conn->query($sql);
	$row2 = $res2->fetch_assoc();
    return $row2;
}

function getRow($sql){
  global $conn;  
    $res2 = $conn->query($sql);
	$row2 = mysqli_num_rows($res2);
    return $row2;
}

function getFinYear(){
  if (date('m') <= 3) {//Upto June 2014-2015
    $financial_year = (date('Y')-1) . '-' . date('Y');
} else {//After June 2015-2016
    $financial_year = date('Y') . '-' . (date('Y') + 1);
}
return $financial_year;
}


$sql = "SELECT * FROM `tbl_users` WHERE Roll IN(9,22,23) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "B".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}

$sql = "SELECT * FROM `tbl_users` WHERE Roll IN(3) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "V".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}

$sql = "SELECT * FROM `tbl_users` WHERE Roll IN(55) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "C".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}

$sql = "SELECT * FROM `tbl_users` WHERE Roll IN(5) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "F".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}

$sql = "SELECT * FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "E".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}

include('../libs/phpqrcode/qrlib.php');
$tempDir = '../barcodes/'; 
$sql = "SELECT * FROM `tbl_users` WHERE (Barcode='' OR  Barcode is null)";
$row = getList($sql);
foreach($row as $result){
$filename = $result['id'].".png";
$codeContents =  $result['Phone'];
QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
$Barcode = $filename;
$sql3 = "UPDATE tbl_users SET Barcode='$Barcode' WHERE id='".$result['id']."'";
$conn->query($sql3);
}
?>