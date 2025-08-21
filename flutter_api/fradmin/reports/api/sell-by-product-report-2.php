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
    $ProdId = $_REQUEST['ProdId'] ?? '';

    if (empty($FrId) || empty($FromDate) || empty($ToDate)) {
        throw new Exception("FrId, FromDate, and ToDate are required");
    }

    $sql = "SELECT tc.ProdId, tc.CreatedDate, tp.ProductName, tp.PurchasePrice
            FROM tbl_customer_invoice_details_2025 tc
            INNER JOIN tbl_cust_products_2025 tp ON tp.id = tc.ProdId
            WHERE tc.FrId = '$FrId'
            AND tc.CreatedDate >= '$FromDate'
            AND tc.CreatedDate <= '$ToDate'";

    if (!empty($ProdId) && $ProdId != 'all') {
        $sql .= " AND tc.ProdId = '$ProdId'";
    }

    $sql .= " GROUP BY tc.CreatedDate, tc.ProdId";

    $data = getList($sql);
    $records = [];

    foreach ($data as $row) {
        $sql2 = "SELECT SUM(tcid.Total) AS TotalSellAmt, SUM(tcid.Qty) AS TotalSellQty
                 FROM tbl_customer_invoice_details_2025 tcid
                 INNER JOIN tbl_customer_invoice_2025 tci ON tci.id = tcid.InvId
                 WHERE tcid.ProdId = '{$row['ProdId']}'
                 AND tci.Roll = 2
                 AND tci.FrId = '$FrId'
                 AND tci.InvoiceDate = '{$row['CreatedDate']}'";

        $row2 = getRecord($sql2);

        $purchaseAmt = $row['PurchasePrice'] * $row2['TotalSellQty'];
        $sellAmt = $row2['TotalSellAmt'];
        $profitAmt = $sellAmt - $purchaseAmt;

        $records[] = [
            "Date" => date("d/m/Y", strtotime($row['CreatedDate'])),
            "ProductName" => $row['ProductName'],
            "TotalSellQty" => (float)$row2['TotalSellQty'],
            "PurchaseAmount" => round($purchaseAmt, 2),
            "SellAmount" => round($sellAmt, 2),
            "ProfitAmount" => round($profitAmt, 2)
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to generate daily profit report: " . $e->getMessage()
    ]);
}
?>
