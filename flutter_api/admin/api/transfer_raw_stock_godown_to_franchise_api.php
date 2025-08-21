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
        SELECT tp.*, tu.Fname AS GodownName, tu2.ShopName AS FranchiseName 
        FROM tbl_transfer_godown_raw_prod_stock tp 
        LEFT JOIN tbl_users_bill tu ON tu.id = tp.GodownId 
        LEFT JOIN tbl_users_bill tu2 ON tu2.id = tp.FranchiseId 
        WHERE tp.OwnShop = 1
    ";

    if ($FrId !== 'all') {
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
    $report = [];
    $sr = 1;

    while ($row = $res->fetch_assoc()) {
        $transferId = $row['id'];
        $report[] = [
            "SrNo" => $sr,
            "Godown" => $row['GodownName'],
            "Franchise" => $row['FranchiseName'],
            "TransferDate" => date("d/m/Y", strtotime($row['StockDate'])),
            "TotalQty" => (float) $row['TotQty'],
            "TotalAmount" => (float) $row['TotalAmount'],
            "Narration" => $row['Narration'],
            "CreatedDate" => date("d/m/Y", strtotime($row['CreatedDate'])),
            
        ];
        // Fetch item details
        $items = [];
        $itemSql = "
            SELECT ttg.*, tgp.ProductName 
            FROM tbl_transfer_godown_raw_stock_items ttg 
            LEFT JOIN tbl_godown_products tgp ON ttg.ProdId = tgp.id 
            WHERE ttg.TransferId = '$transferId'
        ";
        $itemRes = $conn->query($itemSql);
        while ($item = $itemRes->fetch_assoc()) {
            $report[] = [
                "SrNo" => $sr,
            "Godown" => '',
            "Franchise" => '',
            "TransferDate" => $item['ProductName'],
            "TotalQty" => (float) $item['Qty'],
            "TotalAmount" => (float) $item['Price'],
            "Narration" => (float) $item['GstAmt'],
            "CreatedDate" => (float) $item['TotalPrice'],
            ];
        }

       $sr++; 
    }

    echo json_encode([
        "status" => "success",
        "filters" => [
            "FrId" => $FrId,
            "FromDate" => $FromDate,
            "ToDate" => $ToDate
        ],
        "records" => $report
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch transfer raw stock report: " . $e->getMessage()
    ]);
}
?>
