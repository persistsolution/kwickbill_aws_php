<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
if($_POST['action']=='Save'){
$Question1 = addslashes(trim($_POST['Question1']));	
$Answer1 = addslashes(trim($_POST['Answer1']));
$Question2 = addslashes(trim($_POST['Question2']));	
$Answer2 = addslashes(trim($_POST['Answer2']));
$Question3 = addslashes(trim($_POST['Question3']));	
$Answer3 = addslashes(trim($_POST['Answer3']));
$Question4 = addslashes(trim($_POST['Question4']));	
$Answer4 = addslashes(trim($_POST['Answer4']));
$Question5 = addslashes(trim($_POST['Question5']));	
$Answer5 = addslashes(trim($_POST['Answer5']));
$Question6 = addslashes(trim($_POST['Question6']));	
$Answer6 = addslashes(trim($_POST['Answer6']));
$Question7 = addslashes(trim($_POST['Question7']));	
$Answer7 = addslashes(trim($_POST['Answer7']));
$Question8 = addslashes(trim($_POST['Question8']));	
$Answer8 = addslashes(trim($_POST['Answer8']));
$Question9 = addslashes(trim($_POST['Question9']));	
$Answer9 = addslashes(trim($_POST['Answer9']));
$Question10 = addslashes(trim($_POST['Question10']));	
$Answer10 = addslashes(trim($_POST['Answer10']));
$Question11 = addslashes(trim($_POST['Question11']));	
$Answer11 = addslashes(trim($_POST['Answer11']));
$Question12 = addslashes(trim($_POST['Question12']));	
$Answer12 = addslashes(trim($_POST['Answer12']));
$CreatedDate = date('Y-m-d');
$CreatedTime = date('h:i a');

$sql3 = "SELECT * FROM tbl_cashback_amount WHERE id=3";
$row3 = getRecord($sql3);
$CashbackAmt = $row3['Price'];
$sql = "SELECT * FROM tbl_survey WHERE CustId='$user_id' AND CreatedDate='$CreatedDate' AND Type=2";
$rncnt = getRow($sql);
if($rncnt > 0){
    	$sql = "DELETE FROM tbl_survey WHERE CustId='$user_id' AND CreatedDate='$CreatedDate' AND Type=2";
	$conn->query($sql);
	$sql = "DELETE FROM wallet WHERE UserId='$user_id' AND ShopDaily=1 AND CreatedDate='$CreatedDate'";
	$conn->query($sql);
	$sql = "INSERT INTO tbl_survey SET CustId='$user_id',Question1='$Question1',Answer1='$Answer1',Question2='$Question2',Answer2='$Answer2',Question3='$Question3',Answer3='$Answer3',Question4='$Question4',Answer4='$Answer4',Question5='$Question5',Answer5='$Answer5',Question6='$Question6',Answer6='$Answer6',Question7='$Question7',Answer7='$Answer7',Question8='$Question8',Answer8='$Answer8',Question9='$Question9',Answer9='$Answer9',Question10='$Question10',Answer10='$Answer10',Question11='$Question11',Answer11='$Answer11',Question12='$Question12',Answer12='$Answer12',Status='1',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',Type=2";
	$conn->query($sql);
	
	$sql_12 = "INSERT INTO wallet SET UserId='$user_id',Amount='$CashbackAmt',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',Narration='Daily Checklist Cashback',ShopDaily=1";
$conn->query($sql_12);
	echo $CashbackAmt;
}
else{
	$sql = "INSERT INTO tbl_survey SET CustId='$user_id',Question1='$Question1',Answer1='$Answer1',Question2='$Question2',Answer2='$Answer2',Question3='$Question3',Answer3='$Answer3',Question4='$Question4',Answer4='$Answer4',Question5='$Question5',Answer5='$Answer5',Question6='$Question6',Answer6='$Answer6',Question7='$Question7',Answer7='$Answer7',Question8='$Question8',Answer8='$Answer8',Question9='$Question9',Answer9='$Answer9',Question10='$Question10',Answer10='$Answer10',Question11='$Question11',Answer11='$Answer11',Question12='$Question12',Answer12='$Answer12',Status='1',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',Type=2";
	$conn->query($sql);
	
	$sql_12 = "INSERT INTO wallet SET UserId='$user_id',Amount='$CashbackAmt',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',Narration='Daily Checklist Cashback',ShopDaily=1";
$conn->query($sql_12);
	echo $CashbackAmt;
}
}
?>