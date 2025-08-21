<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $CatId = $_REQUEST['CatId'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT p.id AS ProdId, p.ProductName, tcc.Name AS CatName,
                   COALESCE(p.MinQty, 0) AS MinQty, p.PurchasePrice
            FROM tbl_cust_products_2025 p
            INNER JOIN tbl_cust_category_2025 tcc ON p.CatId = tcc.id
            WHERE p.CreatedBy = '$FrId'
              AND p.ProdType = 0
              AND p.ProdType2 IN (1,3)
              AND p.CatId != 28
              AND p.delete_flag = 0
              AND p.checkstatus = 1";

    if (!empty($CatId) && $CatId !== 'all') {
        $sql .= " AND p.CatId = '$CatId'";
    }

    $sql .= " GROUP BY p.id ORDER BY p.ProductName ASC";
    $products = getList($sql);
    $records = [];

    foreach ($products as $prod) {
        // Current period (from 2025-01-28 to today)
        $sql2 = "SELECT SUM(creditqty) AS creditqty, SUM(debitqty) AS debitqty, COALESCE(SUM(creditqty) - SUM(debitqty), 0) AS balqty
                 FROM (
                    SELECT 
                      CASE WHEN Status='Dr' THEN SUM(Qty) ELSE 0 END AS debitqty,
                      CASE WHEN Status='Cr' THEN SUM(Qty) ELSE 0 END AS creditqty
                    FROM tbl_cust_prod_stock_2025
                    WHERE ProdId = '{$prod['ProdId']}'
                      AND ProdType = 0
                      AND FrId = '$FrId'
                      AND StockDate >= '2025-01-28'
                      AND StockDate <= '" . date('Y-m-d') . "'
                    GROUP BY Status
                 ) AS a";
        $row2 = getRecord($sql2);

        // Carry forward (before 2025-01-28)
        $sql21 = "SELECT SUM(creditqty) AS creditqty, SUM(debitqty) AS debitqty, COALESCE(SUM(creditqty) - SUM(debitqty), 0) AS balqty
                  FROM (
                    SELECT 
                      CASE WHEN Status='Dr' THEN SUM(Qty) ELSE 0 END AS debitqty,
                      CASE WHEN Status='Cr' THEN SUM(Qty) ELSE 0 END AS creditqty
                    FROM tbl_cust_prod_stock_2025
                    WHERE ProdId = '{$prod['ProdId']}'
                      AND ProdType = 0
                      AND FrId = '$FrId'
                      AND StockDate < '2025-01-28'
                    GROUP BY Status
                  ) AS a";
        $row21 = getRecord($sql21);

        $carryForward = $row21['balqty'] ?? 0;
        $credit = $row2['creditqty'] ?? 0;
        $debit = $row2['debitqty'] ?? 0;
        $balance = $carryForward + ($row2['balqty'] ?? 0);
        $amount = round($balance * $prod['PurchasePrice'], 2);

        $records[] = [
            "ProductId" => $prod['ProdId'],
            "ProductName" => $prod['ProductName'],
            "CategoryName" => $prod['CatName'],
            "PurchasePrice" => (float)$prod['PurchasePrice'],
            "MinQty" => (float)$prod['MinQty'],
            "CarryForward" => (float)$carryForward,
            "CreditQty" => (float)$credit,
            "DebitQty" => (float)$debit,
            "BalanceQty" => (float)$balance,
            "Amount" => $amount
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to generate stock report: " . $e->getMessage()
    ]);
}
?>
