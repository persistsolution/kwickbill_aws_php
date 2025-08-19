<?php 
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
require_once 'config.php';
    function generateAuthToken($length = 32) {
    // Use random_bytes to generate cryptographically secure random bytes
    $bytes = random_bytes($length / 2);
    // Convert the bytes to a hexadecimal string
    return bin2hex($bytes);
    }
    
    $phone = $_REQUEST['phone'];
    if($_REQUEST['phone']!=''){
    $sql = "SELECT id,Phone,AuthToken,Percentage,CocoFranchiseAccess FROM tbl_users_bill WHERE Phone='$phone' AND Roll=105 AND Status=1";
    $rncnt = getRow($sql);
    if($rncnt > 0){
        $row = getRecord($sql);
        $token = $row['AuthToken'];
        if($token==''){
        $AuthToken = generateAuthToken()."".$row['id'];
        $sql2 = "UPDATE tbl_users_bill SET AuthToken='$AuthToken' WHERE id='".$row['id']."'";
        $conn->query($sql2);
        $sql2 = "UPDATE tbl_users SET AuthToken='$AuthToken' WHERE id='".$row['id']."'";
        $conn->query($sql2);
        }
        else{
           $AuthToken = $row['AuthToken'];
        }
        echo json_encode(array('status'=>1,'msg'=>'Login Success','uid'=>$row['id'],'phone'=>$row['Phone'],'authtoken'=>$AuthToken,'franchise_access'=>$row['CocoFranchiseAccess'])); 
    }
    else{
       echo json_encode(array('status'=>0,'msg'=>'Invalid Phone No')); 
    }
    }
    else{
       echo json_encode(array('status'=>0,'msg'=>"Phone no not getting"));  
    }

?>