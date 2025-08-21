
<?php
$host = "mysql-database.crq6yqcualdr.ap-south-1.rds.amazonaws.com";
$user = "admin";
$pass = "admin12345";
$db = "mahachai";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
