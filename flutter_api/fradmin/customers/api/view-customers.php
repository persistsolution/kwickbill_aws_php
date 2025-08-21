<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT CustName, CellNo 
            FROM tbl_customer_invoice_2025 
            WHERE CustName != '' 
              AND CellNo != '' 
              AND FrId = '$FrId'";

    $res = $conn->query($sql);

    $records = [];
    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "CustName" => $row['CustName'],
            "CellNo" => $row['CellNo']
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch records: " . $e->getMessage()
    ]);
}
?>
