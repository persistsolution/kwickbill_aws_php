<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'changeFuelStatus'){
    $id = $_POST['id'];
    $Status = $_POST['status'];
    $StatusDate = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_fuel_station_details SET Status='$Status',StatusBy='$user_id',StatusDate='$StatusDate' WHERE id='$id'";
    $conn->query($sql);
    echo 1;
}

?>