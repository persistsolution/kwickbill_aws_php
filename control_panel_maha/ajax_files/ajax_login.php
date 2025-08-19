<?php 
session_start();
include_once '../config.php';

if($_POST['action'] == 'Login'){
    $username = trim($_POST['Username']);
    $password = $_POST['Password'];
    $Roll = $_POST['Roll'];

    // 1. Check only username
    $query_user = "SELECT * FROM tbl_users 
                   WHERE Phone = '$username'
                   AND Roll NOT IN(5,55) 
                   AND Status=1";
     $result_user = $conn->query($query_user);

    if(mysqli_num_rows($result_user) == 0){

        echo json_encode(array('Status'=>0, 'Message'=>'Invalid Username'));
    } else {
        $query_pass = "SELECT * FROM tbl_users 
                       WHERE Phone = '$username'
                       AND Password = '$password' 
                       AND Roll NOT IN(5,55) 
                       AND Status=1";
        $result_pass = $conn->query($query_pass);

        if(mysqli_num_rows($result_pass) == 0){
            // ❌ Wrong password
            echo json_encode(array('Status'=>2, 'Message'=>'Invalid Password'));
        } else {
            // ✅ Success → send OTP
            $row = $result_pass->fetch_assoc();
            $Phone = $row['Phone'];
            $otp = rand(1000,9999);
            $_SESSION['otp'] = $otp;

            $smstxt = "Please enter ".$otp." OTP on our platform to complete the verification process. Thank you for choosing Maha Chai.";
            $dltentityid = "1501701120000037351";
            $dlttempid = "1707169838793992439";

            include '../../incsmsapi.php';  

            echo json_encode(array(
                'Status'=>1,
                'Message'=>'Login Success',
                'Roll'=>$row['Roll'],
                'Phone'=>$Phone,
                'Uid'=>$row['id']
            ));
        }
    }
}


if($_POST['action'] == 'VerifyOtp'){
    $Phone = addslashes(trim($_POST['Phone']));
    $Uid = addslashes(trim($_POST['Uid']));
$YourOtp = addslashes(trim($_POST['YourOtp']));
$GetOtp = addslashes(trim($_POST['GetOtp']));
if($YourOtp == $GetOtp){
$query = "SELECT * FROM tbl_users WHERE id = '$Uid' AND Status=1";
$rncnt = getRow($query);
if($rncnt > 0){
$row = getRecord($query);
$_SESSION['Admin'] = $row;
$_SESSION['Roll'] = $row['Roll'];
$uid = $row['id'];
unset($_SESSION['otp']);
echo json_encode(array('Status'=>1,'Username'=>$Phone,'uid'=>$uid));
}
}
else{
echo json_encode(array('Status'=>0));   
}
}


if($_POST['action'] == 'LoginDev'){
$username = trim($_POST['Username']);
$password = $_POST['Password'];
$Roll = $_POST['Roll'];
$query = "SELECT * FROM tbl_users WHERE (Phone = '$username' OR EmailId='$username') AND Password = '$password' AND Roll NOT IN(5,55) AND Status=1";
    $result = $conn->query($query);
     $rncnt = mysqli_num_rows($result);
    $row = $result->fetch_assoc();
    if($rncnt > 0){
        //$_SESSION['Admin'] = $row;
        //$_SESSION['Roll'] = $row['Roll'];
        $Phone = $row['Phone'];
        $otp = rand(1000,9999);
        $_SESSION['otp'] = $otp;
        echo json_encode(array('Status'=>1,'Roll'=>$row['Roll'],'Phone'=>$Phone,'Uid'=>$row['id']));
    }
    else{
        unset($_SESSION['Admin']);
        unset($_SESSION['Roll']);
        echo json_encode(array('Status'=>0));
    } 
}
?>