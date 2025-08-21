<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FranchiseId = $_REQUEST['user_id'] ?? '';

    if (empty($FranchiseId)) {
        throw new Exception("FranchiseId is required");
    }

    $sql = "SELECT tp.*, tu.Fname AS GodownName, tu2.ShopName 
            FROM tbl_transfer_godown_raw_prod_stock_2025 tp 
            LEFT JOIN tbl_users_bill tu ON tu.id = tp.GodownId 
            LEFT JOIN tbl_users_bill tu2 ON tu2.id = tp.FranchiseId 
            WHERE tp.FranchiseId = '$FranchiseId'
            ORDER BY tp.CreatedDate DESC";

    $res = $conn->query($sql);

    $records = [];
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $transferId = $row['id'];

        $sql2 = "SELECT COUNT(*) AS cnt FROM tbl_transfer_godown_raw_stock_items_2025 WHERE TransferId = '$transferId'";
        $cntRes2 = $conn->query($sql2)->fetch_assoc();
        $totalProducts = (int) $cntRes2['cnt'];

        $sql22 = "SELECT COUNT(*) AS cnt FROM tbl_transfer_godown_raw_stock_items_2025 WHERE TransferId = '$transferId' AND Receive = 1";
        $cntRes22 = $conn->query($sql22)->fetch_assoc();
        $receivedProducts = (int) $cntRes22['cnt'];

        $balance = $totalProducts - $receivedProducts;

        $records[] = [
            "SrNo" => $i++,
            "GodownName" => $row['GodownName'],
            "FranchiseName" => $row['ShopName'],
            "TransferDate" => date("d/m/Y", strtotime(str_replace('-', '/', $row['StockDate']))),
            "TotalProduct" => $totalProducts,
            "Received" => $receivedProducts,
            "Balance" => $balance
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
