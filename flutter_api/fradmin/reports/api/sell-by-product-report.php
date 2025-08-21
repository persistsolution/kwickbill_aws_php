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

    $sql = "SELECT id AS ProdId, ProductName, PurchasePrice 
            FROM tbl_cust_products_2025 
            WHERE CreatedBy = '$FrId' AND ProdType = 0 AND checkstatus = 1 AND delete_flag = 0";

    if (!empty($ProdId) && $ProdId != 'all') {
        $sql .= " AND id = '$ProdId'";
    }

    $sql .= " ORDER BY srno ASC";

    $products = getList($sql);
    $records = [];

    foreach ($products as $prod) {
        $sql2 = "SELECT SUM(tcid.Total) AS TotalSellAmt, SUM(tcid.Qty) AS TotalSellQty
                 FROM tbl_customer_invoice_details_2025 tcid
                 INNER JOIN tbl_customer_invoice_2025 tci ON tci.id = tcid.InvId
                 WHERE tcid.ProdId = '{$prod['ProdId']}' AND tci.Roll = 2 AND tci.FrId = '$FrId'";

        if (!empty($FromDate)) {
            $sql2 .= " AND tci.InvoiceDate >= '$FromDate'";
        }
        if (!empty($ToDate)) {
            $sql2 .= " AND tci.InvoiceDate <= '$ToDate'";
        }

        $row2 = getRecord($sql2);

        if (($row2['TotalSellQty'] ?? 0) > 0) {
            $purchaseAmt = $prod['PurchasePrice'] * $row2['TotalSellQty'];
            $sellAmt = $row2['TotalSellAmt'];
            $profitAmt = $sellAmt - $purchaseAmt;

            $records[] = [
                "ProductName" => $prod['ProductName'],
                "TotalSellQty" => (float)$row2['TotalSellQty'],
                "PurchaseAmount" => round($purchaseAmt, 2),
                "SellAmount" => round($sellAmt, 2),
                "ProfitAmount" => round($profitAmt, 2)
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to generate product-wise profit report: " . $e->getMessage()
    ]);
}
?>
