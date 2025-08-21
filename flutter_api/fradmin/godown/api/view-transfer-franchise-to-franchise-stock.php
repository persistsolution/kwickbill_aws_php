<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FromFrId = $_REQUEST['user_id'] ?? '';

    if (empty($FromFrId)) {
        throw new Exception("FromFrId is required");
    }

    $sql = "SELECT tp.*, tu.Fname AS FromFranchise, tu2.ShopName AS ToFranchise
            FROM tbl_transfer_franchise_prod_stock_2025 tp
            LEFT JOIN tbl_users_bill tu ON tu.id = tp.FromFrId
            LEFT JOIN tbl_users_bill tu2 ON tu2.id = tp.ToFrId
            WHERE tp.FromFrId = '$FromFrId'
            ORDER BY tp.CreatedDate DESC";

    $res = $conn->query($sql);

    $records = [];
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $transferId = $row['id'];

        $sql2 = "SELECT COUNT(*) AS cnt FROM tbl_transfer_franchise_prod_stock_items_2025 WHERE TransferId = '$transferId'";
        $cntRes2 = $conn->query($sql2)->fetch_assoc();
        $totalProducts = (int) $cntRes2['cnt'];

        $records[] = [
            "SrNo" => $i++,
            "TransferId" => $transferId,
            "FromFranchise" => $row['FromFranchise'],
            "ToFranchise" => $row['ToFranchise'],
            "TransferDate" => date("d/m/Y", strtotime(str_replace('-', '/', $row['StockDate']))),
            "TotalProduct" => $totalProducts,
           
            "Narration" => $row['Narration'],
            "CreatedDate" => date("d/m/Y", strtotime(str_replace('-', '/', $row['CreatedDate'])))
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
