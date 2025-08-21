<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $ProdId = $_REQUEST['ProdId'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT ts.*, p.ProductName
            FROM tbl_cust_prod_stock_2025 ts
            INNER JOIN tbl_cust_products_2025 p ON ts.ProdId = p.id
            WHERE ts.FrId = '$FrId'
              AND ts.Status = 'Dr'
              AND ts.ProdType = 0
              AND ts.Wastage = 1";

    if (!empty($ProdId) && $ProdId !== 'all') {
        $sql .= " AND ts.ProdId = '$ProdId'";
    }

    if (!empty($FromDate)) {
        $sql .= " AND ts.StockDate >= '$FromDate'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND ts.StockDate <= '$ToDate'";
    }

    $sql .= " ORDER BY ts.id DESC";

    $res = $conn->query($sql);

    $records = [];
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "SrNo" => $i++,
            "ProdId" => $row['ProdId'],
            "ProductName" => $row['ProductName'],
            "Date" => date("d/m/Y", strtotime(str_replace('-', '/', $row['StockDate']))),
            "StockOutQty" => $row['Qty']
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
