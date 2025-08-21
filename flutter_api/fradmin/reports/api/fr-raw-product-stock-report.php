<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $FilterFrId = $_REQUEST['FilterFrId'] ?? '';
    $CatId = $_REQUEST['CatId'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT ts.FrId, ts.ProdId, ts.Unit, ts.Unit2, p.ProductName, tcc.Name AS CatName, p.MinQty
            FROM tbl_cust_prod_stock_2025 ts
            INNER JOIN tbl_cust_products2 p ON ts.ProdId = p.id
            INNER JOIN tbl_cust_category_2025 tcc ON p.CatId = tcc.id
            WHERE ts.Status = 'Cr' AND ts.FrId = '$FrId' AND ts.ProdType = 1";

    if (!empty($FilterFrId) && $FilterFrId != 'all') {
        $sql .= " AND ts.FrId = '$FilterFrId'";
    }

    if (!empty($CatId) && $CatId != 'all') {
        $sql .= " AND p.CatId = '$CatId'";
    }

    if (!empty($FromDate)) {
        $sql .= " AND ts.StockDate >= '$FromDate'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND ts.StockDate <= '$ToDate'";
    }

    $sql .= " GROUP BY p.id ORDER BY ts.id DESC";

    $products = getList($sql);
    $records = [];

    foreach ($products as $prod) {
        $sql2 = "SELECT SUM(creditqty) AS creditqty, SUM(debitqty) AS debitqty, COALESCE(SUM(creditqty)-SUM(debitqty), 0) AS balqty
                 FROM (
                   SELECT
                     CASE WHEN Status = 'Dr' THEN SUM(Qty) ELSE 0 END AS debitqty,
                     CASE WHEN Status = 'Cr' THEN SUM(Qty) ELSE 0 END AS creditqty
                   FROM tbl_cust_prod_stock_2025
                   WHERE FrId = '{$prod['FrId']}' AND ProdId = '{$prod['ProdId']}' AND ProdType = 1";

        if (!empty($FromDate)) {
            $sql2 .= " AND StockDate >= '$FromDate'";
        }

        if (!empty($ToDate)) {
            $sql2 .= " AND StockDate <= '$ToDate'";
        }

        $sql2 .= " GROUP BY Status ) AS a";

        $row2 = getRecord($sql2);

        $credit = $row2['creditqty'] ?? 0;
        $debit = $row2['debitqty'] ?? 0;
        $balance = $row2['balqty'] ?? 0;

        if ($prod['Unit'] != 'Pieces') {
            $credit = $credit / 1000;
            $debit = $debit / 1000;
            $balance = $balance / 1000;
        }

        $records[] = [
            "ProductName" => $prod['ProductName'],
            "CategoryName" => $prod['CatName'],
            "CreditQty" => (float)$credit,
            "DebitQty" => (float)$debit,
            "BalanceQty" => (float)$balance,
            "Unit" => $prod['Unit2']
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to generate raw stock report: " . $e->getMessage()
    ]);
}
?>
