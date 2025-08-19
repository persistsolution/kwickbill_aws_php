<?php  
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
if($_POST['action'] == 'saveRequest'){
$UserId = addslashes(trim($_POST["UserId"]));
$ReqDate = addslashes(trim($_POST["ReqDate"]));
$CandName = addslashes(trim($_POST["CandName"]));
$CandPhone = addslashes(trim($_POST["CandPhone"]));
$CandEmail = addslashes(trim($_POST["CandEmail"]));
$Notes = addslashes(trim($_POST["Notes"]));
$CreatedDate = date('Y-m-d H:i:s');

$sql = "SELECT * FROM tbl_referral_details WHERE CandPhone = '$CandPhone'";
$rncnt = getRow($sql);
if($rncnt > 0){
    echo 0;
}
else{
$qx = "INSERT INTO tbl_referral_details SET UserId='$user_id',ReqDate='$ReqDate',CandName='$CandName',CandPhone='$CandPhone',CandEmail='$CandEmail',Notes='$Notes',CreatedDate='$CreatedDate'";
  $conn->query($qx); 
  echo 1;
}
}
?>