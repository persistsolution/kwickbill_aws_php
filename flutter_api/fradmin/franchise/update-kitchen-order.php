<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    // Support both GET and POST
    $InvId = $_GET['InvId'] ?? $_POST['InvId'] ?? null;
    $userId = $_GET['user_id'] ?? $_POST['user_id'] ?? null;

    if (!$InvId || trim($InvId) === '') {
        throw new Exception("InvId is required");
    }

    $InvId = $conn->real_escape_string($InvId);

    $sql = "UPDATE tbl_customer_invoice_2025 SET KitchenStatus = '1' WHERE Unqid = '$InvId'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "KitchenStatus updated successfully",
            "InvId" => $InvId,
            "user_id" => $userId
        ]);
    } else {
        throw new Exception("Database update failed: " . $conn->error);
    }

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
