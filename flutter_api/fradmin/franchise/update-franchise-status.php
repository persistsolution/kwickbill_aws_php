<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['FranchiseId'])) {
        throw new Exception("FranchiseId is required");
    }

    $franchiseId = intval($input['FranchiseId']);
    $sql = "UPDATE tbl_users_bill SET Status = '1' WHERE id = $franchiseId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Franchise approved successfully."]);
    } else {
        throw new Exception("Database update failed: " . $conn->error);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
