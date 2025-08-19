<?php
session_start();
$sessionid = session_id();
require_once ("../config.php");
// Uncomment if you want to allow posts from other domains
// header('Access-Control-Allow-Origin: *');

require_once('slim.php');
if(isset($_SESSION['Company'])){
$user_id = $_SESSION['Company']['id'];
}
else if(isset($_SESSION['User'])){
$user_id = $_SESSION['User']['id'];
}  
else if(isset($_SESSION['Recruiter'])){
$user_id = $_SESSION['Recruiter']['id'];
}
// Allowing users to delete files from the server is a serious security risk.
// Use at own discretion.

// get name of file to delete from URL and clean up any path information from name for security purposes
$name = Slim::sanitizeFileName($_GET['name']);

// the path of the uploaded files
$path = '../uploads/';

// combine both to set path to file
$filename = $path . $name;
$q2 = "DELETE FROM crop_image WHERE SessionId = '$sessionid' AND UserId='$user_id' AND Type='".$_GET['type']."'";
$conn->query($q2);
//$_SESSION['photo'] = $filename;
// test if file exists, if so, remove
if (file_exists($filename)) {
    unlink($filename);
    
}