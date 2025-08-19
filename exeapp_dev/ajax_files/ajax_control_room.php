<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
$sql2 = "SELECT Phone FROM tbl_users WHERE id='$user_id'";
$row2 = getRecord($sql2);
$UserPhone = $row2['Phone'];
if($_POST['action']=='SaveLead'){
	$id = $_POST['id'];
	$FrId = addslashes(trim($_POST['FrId']));
	$Phone2 = addslashes(trim($_POST['Phone']));
	$EmailId = addslashes(trim($_POST['EmailId']));
	$Details = addslashes(trim($_POST['Details']));
	$CreatedDate = date('Y-m-d H:i:s');
	if($id == ''){
		$sql = "INSERT INTO tbl_control_room SET FrId='$FrId',Details='$Details',CreatedBy='$user_id',CreatedDate='$CreatedDate'";
		$conn->query($sql);
		
		echo 1;
		
	}
	else{
		$sql = "UPDATE tbl_control_room SET FrId='$FrId',Details='$Details', WHERE id='$id'";
		$conn->query($sql);
		
		echo 1;
		
	}
	
}
?>