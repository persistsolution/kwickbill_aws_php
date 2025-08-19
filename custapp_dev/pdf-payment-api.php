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

$sql = "UPDATE tbl_customer_invoice SET Status='1',PayType='Online' WHERE Unqid='$pkgid'";
$conn->query($sql);
echo "https://kwickfoods.in/custapp/my-orders.php";
?>