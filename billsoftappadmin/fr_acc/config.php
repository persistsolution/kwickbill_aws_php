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
    // echo "Successfully Connected";
}
$Proj_Title = "MAHA BUDDY";
$SiteUrl = "https://rjorg.in/pandavcollege/";
date_default_timezone_set("Asia/Kolkata");
$CloseDate = "2024-12-31";
$OpenDate = "2025-01-01";

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
?>