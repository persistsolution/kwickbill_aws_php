<?php 
session_start();
include_once 'config.php';
require_once "database.php";

$sql73 = "SELECT Tokens,id FROM tbl_users WHERE Status='1' AND Tokens!=''";
$data=mysqli_query($con,$sql73);
while($row=mysqli_fetch_array($data))
    {
        $ReceiverId = $row['id'];
         $title = $Title;
            $body =  $Message;
            $reg_id = $row[0];
            $registrationIds = array($reg_id);
            //$url = "$SiteUrl/profile.php?id=$UserId";
            $imgurl = "https://rjorg.in/teasoftware/mobapp/pic22.jpg";
            include '../incnotification.php';
    }
    ?>