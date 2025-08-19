<?php 
session_start();
require_once 'config.php';
$amount = $_POST['amount'];
$userid = $_POST['userid'];
$phone = $_POST['phone'];
$pkgid = $_REQUEST['pkgid'];
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');
$CreatedDate = date('Y-m-d');

$sql = "UPDATE orders SET PayStatus=1 WHERE id='$pkgid'";
$conn->query($sql);
//echo "<script>window.location.href='my-orders.php';</script>";
echo "https://rjorg.in/teasoftware/mobapp/my-orders.php";
?>