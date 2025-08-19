<?php 
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'getSerialNo'){
    $id = $_POST['id'];
    $sql = "SELECT srno FROM tbl_asset_category WHERE id='$id'";
    $row = getRecord($sql);
    
    $sql2 = "SELECT COALESCE(MAX(srno) + 1, 1) AS NextSrNo FROM tbl_assets WHERE asset_category='$id'";
    $row2 = getRecord($sql2);
    echo json_encode(array('SrNo'=>$row2['NextSrNo'],'SerialId'=>$row['srno']."00".$row2['NextSrNo']));
}
?>