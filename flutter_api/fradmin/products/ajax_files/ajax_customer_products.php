<?php
session_start();
include_once '../../config.php';
//include('../../libs/phpqrcode/qrlib.php');
$user_id = $_SESSION['frid'];
//include 'incuserdetails.php';
if($_POST['action'] == 'changeQrStatus'){ 
    $id = $_POST['id'];
    $status = $_POST['status'];
    $sql = "UPDATE tbl_cust_products SET QrDisplay='$status' WHERE id='$id'";
    $conn->query($sql);
    echo "status updated successfully!";
}
?>
