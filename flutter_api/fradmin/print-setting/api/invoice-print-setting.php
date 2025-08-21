<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

session_start();
require_once '../../config.php';

// Read JSON input
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Fallback to POST if JSON not found
if (!$data || !is_array($data)) {
    $data = $_POST;
}

// Validate required fields
$required = ['BillSoftFrId', 'ShopName', 'Address', 'Phone', 'GstNo', 'terms_condition', 'bottom_title'];
$missing = [];
foreach ($required as $field) {
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        $missing[] = $field;
    }
}

if (!empty($missing)) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing required fields: " . implode(', ', $missing)
    ]);
    exit;
}

// Sanitize inputs
$BillSoftFrId = intval($data['BillSoftFrId']);
$ShopName = addslashes(trim($data['ShopName']));
$Address = addslashes(trim($data['Address']));
$Phone = addslashes(trim($data['Phone']));
$GstNo = addslashes(trim($data['GstNo']));
$terms_condition = addslashes(trim($data['terms_condition']));
$bottom_title = addslashes(trim($data['bottom_title']));

// Update query
$sql = "UPDATE tbl_users_bill 
        SET PrintCompName='$ShopName',
            Address='$Address',
            PrintMobNo='$Phone',
            GstNo='$GstNo',
            terms_condition='$terms_condition',
            bottom_title='$bottom_title'
        WHERE id='$BillSoftFrId'";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => "success",
        "message" => "Setting updated successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $conn->error
    ]);
}
?>
