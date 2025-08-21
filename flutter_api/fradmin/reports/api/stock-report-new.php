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

    $sql = "SELECT p.id AS ProdId, p.ProductName, tcc.Name AS CatName, p.MinPrice, p.PurchasePrice
            FROM tbl_cust_products_2025 p
            INNER JOIN tbl_cust_category_2025 tcc ON p.CatId = tcc.id
            WHERE p.CreatedBY = '$FrId' AND p.ProdType = 0 AND p.delete_flag = 0 AND p.checkstatus = 1";

    $products = getList($sql);
    $records = [];

    foreach ($products as $prod) {
        // Opening stock
        $sql3 = "SELECT SUM(creditqty) AS creditqty, SUM(debitqty) AS debitqty, SUM(creditqty) - SUM(debitqty) AS balqty
                 FROM (
                   SELECT 
                     CASE WHEN Status = 'Dr' THEN SUM(Qty) ELSE 0 END AS debitqty,
                     CASE WHEN Status = 'Cr' THEN SUM(Qty) ELSE 0 END AS creditqty
                   FROM tbl_cust_prod_stock_2025
                   WHERE FrId = '$FrId' AND ProdId = '{$prod['ProdId']}' AND ProdType = 0";
        if (!empty($FromDate)) {
            $sql3 .= " AND StockDate < '$FromDate'";
        }
        $sql3 .= " GROUP BY Status ) AS a";
        $row3 = getRecord($sql3);

        // Purchase (in period)
        $sql4 = "SELECT SUM(Qty) AS PurchaseQty
                 FROM tbl_cust_prod_stock_2025
                 WHERE FrId = '$FrId' AND ProdId = '{$prod['ProdId']}' AND ProdType = 0 AND Status = 'Cr'";
        if (!empty($FromDate)) {
            $sql4 .= " AND StockDate >= '$FromDate'";
        }
        if (!empty($ToDate)) {
            $sql4 .= " AND StockDate <= '$ToDate'";
        }
        $row4 = getRecord($sql4);

        // Sale (in period)
        $sql5 = "SELECT SUM(Qty) AS SaleQty
                 FROM tbl_cust_prod_stock_2025
                 WHERE FrId = '$FrId' AND ProdId = '{$prod['ProdId']}' AND ProdType = 0 AND Status = 'Dr'";
        if (!empty($FromDate)) {
            $sql5 .= " AND StockDate >= '$FromDate'";
        }
        if (!empty($ToDate)) {
            $sql5 .= " AND StockDate <= '$ToDate'";
        }
        $row5 = getRecord($sql5);

        $openingQty = $row3['balqty'] ?? 0;
        $purchaseQty = $row4['PurchaseQty'] ?? 0;
        $saleQty = $row5['SaleQty'] ?? 0;
        $closingQty = $openingQty + $purchaseQty - $saleQty;

        $records[] = [
            "ProdId" => $prod['ProdId'],
            "ProductName" => $prod['ProductName'],
            "CategoryName" => $prod['CatName'],
            "OpeningQty" => (float)$openingQty,
            "OpeningRate" => (float)$prod['MinPrice'],
            "OpeningAmount" => round($openingQty * $prod['MinPrice'], 2),
            "PurchaseQty" => (float)$purchaseQty,
            "PurchaseRate" => (float)$prod['PurchasePrice'],
            "PurchaseAmount" => round($purchaseQty * $prod['PurchasePrice'], 2),
            "SaleQty" => (float)$saleQty,
            "SaleRate" => (float)$prod['MinPrice'],
            "SaleAmount" => round($saleQty * $prod['MinPrice'], 2),
            "ClosingQty" => (float)$closingQty,
            "ClosingRate" => (float)$prod['PurchasePrice'],
            "ClosingAmount" => round($closingQty * $prod['PurchasePrice'], 2)
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to generate stock summary: " . $e->getMessage()
    ]);
}
?>
