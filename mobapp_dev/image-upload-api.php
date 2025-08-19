<?php
session_start();
include_once 'config.php';
$name = $_REQUEST["name"];
$image = $_REQUEST["image"];
$prdid = $_REQUEST['prdid'];
$flag = $_REQUEST['flag'];
$action = $_REQUEST['action'];
$pageval = $_REQUEST['pageval'];
$decodedImage = base64_decode("$image");
$return = file_put_contents("../uploads/" . $name . "", $decodedImage);
$response = array();
if ($return !== false) {
    $response['success'] = 1;
    if($pageval == 'attendance'){
        if($action == 'save'){
            $sql = "UPDATE tbl_attendance SET Photo='$name' WHERE TempPrdId='$prdid'";
            $conn->query($sql);
        }
    }
    
    if($pageval == 'expenses'){
        if($action == 'save'){
            $sql = "UPDATE tbl_expense_request SET Photo='$name' WHERE TempPrdId='$prdid'";
            $conn->query($sql);
        }
        
        if($action == 'saveexpimg2'){
            $sql = "UPDATE tbl_expense_request SET Photo2='$name' WHERE TempPrdId2='$prdid'";
            $conn->query($sql);
        }
    }
    

    $response['message'] = "Your image has ploaded successfully";
} else {
    $response['success'] = 0;
    $response['message'] = "Image failed to pload";
}
echo json_encode($response);

?>