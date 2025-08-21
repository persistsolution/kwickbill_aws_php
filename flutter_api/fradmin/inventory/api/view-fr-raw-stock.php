<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT ts.StockDate, ts.Qty2, ts.Unit2, ts.id, p.ProductName, ts.PurchasePrice, ts.SellPrice
            FROM tbl_cust_prod_stock_2025 ts
            INNER JOIN tbl_cust_products2 p ON ts.ProdId = p.id
            WHERE ts.FrId = '$FrId'
              AND ts.Status = 'Cr'
              AND ts.ProdType = '1'
              AND p.delete_flag = 0";

    if (!empty($FromDate)) {
        $sql .= " AND ts.StockDate >= '$FromDate'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND ts.StockDate <= '$ToDate'";
    }

    $sql .= " ORDER BY ts.id DESC";

    $res = $conn->query($sql);

    $records = [];
    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "Id" => $row['id'],
            "ProductName" => $row['ProductName'],
            "StockDate" => date("d/m/Y", strtotime(str_replace('-', '/', $row['StockDate']))),
            "Price" => (float) $row['PurchasePrice'],
            "StockInQty" => $row['Qty2'] . ' ' . $row['Unit2'],
            "TotalPrice" => (float) $row['SellPrice']
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
