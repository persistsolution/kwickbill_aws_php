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

    $sql = "SELECT tp.*, tu.Fname AS VedName 
            FROM tbl_return_prod_stock tp 
            INNER JOIN tbl_users tu ON tp.VedId = tu.id 
            WHERE tp.FrId = '$FrId' AND tp.ProdType = 1 
            ORDER BY tp.CreatedDate DESC";

    $rows = getList($sql);
    $records = [];

    foreach ($rows as $row) {
        $sql2 = "SELECT SUM(Qty) AS Qty FROM tbl_return_prod_items WHERE InvId = '" . $row['id'] . "'";
        $row2 = getRecord($sql2);

        $records[] = [
            "InvNo" => $row['InvNo'],
            "ReturnDate" => date("d/m/Y", strtotime($row['ReturnDate'])),
            "VendorName" => $row['VedName'],
            "ReturnQty" => (float)$row2['Qty'],
            "Reason" => $row['Narration'],
            "ReturnStatus" => $row['ReturnStatus'] == '1' ? 'Approve' : ($row['ReturnStatus'] == '2' ? 'Reject' : 'Pending'),
            "CreatedDate" => date("d/m/Y h:i a", strtotime($row['CreatedDate']))
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch return report: " . $e->getMessage()
    ]);
}
?>
