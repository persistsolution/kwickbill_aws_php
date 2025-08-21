<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    $FrId = $_REQUEST['FrId'] ?? 'all';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    $sql = "
        SELECT 
            ttg.*, 
            tgp.ProductName, 
            tu.Fname AS GodownName, 
            tu2.ShopName AS FranchiseName, 
            tp.StockDate 
        FROM tbl_transfer_godown_raw_stock_items_2025 ttg 
        INNER JOIN tbl_cust_products2 tgp ON ttg.ProdId = tgp.id 
        INNER JOIN tbl_transfer_godown_raw_prod_stock_2025 tp ON ttg.TransferId = tp.id 
        INNER JOIN tbl_users_bill tu ON tu.id = tp.GodownId 
        INNER JOIN tbl_users_bill tu2 ON tu2.id = tp.FranchiseId 
        WHERE 1=1
    ";

    if (!empty($FrId) && $FrId !== 'all') {
        $FrId = mysqli_real_escape_string($conn, $FrId);
        $sql .= " AND tp.FranchiseId = '$FrId'";
    }

    if (!empty($FromDate)) {
        $sql .= " AND tp.StockDate >= '$FromDate'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND tp.StockDate <= '$ToDate'";
    }

    $sql .= " ORDER BY tp.CreatedDate DESC";

    $res = $conn->query($sql);

    $data = [];
    $sr = 1;

    while ($row = $res->fetch_assoc()) {
        $data[] = [
            "SrNo" => $sr++,
            "Godown" => $row['GodownName'],
            "Franchise" => $row['FranchiseName'],
            "TransferDate" => date("d/m/Y", strtotime($row['StockDate'])),
            "Item" => $row['ProductName'],
            "Qty" => (float) $row['Qty'],
            "Rate" => (float) $row['Price'],
            "Gst" => (float) $row['GstAmt'],
            "Amount" => (float) $row['TotalPrice']
        ];
    }

    echo json_encode([
        "status" => "success",
        "filters" => [
            "FrId" => $FrId,
            "FromDate" => $FromDate,
            "ToDate" => $ToDate
        ],
        "records" => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch transfer report: " . $e->getMessage()
    ]);
}
?>
