<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    $FrId = $_REQUEST['FrId'] ?? 'all';
    $CatId = $_REQUEST['CatId'] ?? 'all';
    $FromDate = $_REQUEST['FromDate'] ?? '2025-06-01';
    $ToDate = $_REQUEST['ToDate'] ?? '2025-06-30';

    $conditions = ["ts.Status='Cr'", "ts.FrId!=0", "ts.ProdType=0"];

    if ($FrId !== 'all') {
        $FrId = mysqli_real_escape_string($conn, $FrId);
        $conditions[] = "ts.FrId = '$FrId'";
    }

    if ($CatId !== 'all') {
        $CatId = mysqli_real_escape_string($conn, $CatId);
        $conditions[] = "p.CatId = '$CatId'";
    }

    if (!empty($FromDate)) {
        $conditions[] = "ts.StockDate >= '$FromDate'";
    }
    if (!empty($ToDate)) {
        $conditions[] = "ts.StockDate <= '$ToDate'";
    }

    $conditionStr = implode(' AND ', $conditions);

    $sql = "
        SELECT ts.FrId, ts.ProdId, p.ProductName, tcc.Name AS CatName, p.MinQty, p.id AS Prod_Id
        FROM tbl_cust_prod_stock_2025 ts
        INNER JOIN tbl_cust_products_2025 p ON ts.ProdId = p.id
        INNER JOIN tbl_cust_category_2025 tcc ON p.CatId = tcc.id
        WHERE $conditionStr
        GROUP BY p.id
        ORDER BY ts.id DESC
    ";

    $res = $conn->query($sql);
    $data = [];
    $i = 1;

    while ($row = $res->fetch_assoc()) {
        $prodId = $row['Prod_Id'];
        $franchiseId = $row['FrId'];

        // Get Franchise Name
        $row3 = getRecord("SELECT ShopName FROM tbl_users_bill WHERE id = '$franchiseId'");
        $shopName = $row3['ShopName'] ?? '';

        // Get Previous Balance before FromDate
        $prevSql = "
            SELECT SUM(creditqty) - SUM(debitqty) AS balqty FROM (
                SELECT 
                    CASE WHEN Status = 'Cr' THEN SUM(Qty) ELSE 0 END AS creditqty,
                    CASE WHEN Status = 'Dr' THEN SUM(Qty) ELSE 0 END AS debitqty
                FROM tbl_cust_prod_stock_2025
                WHERE FrId = '$franchiseId' AND ProdId = '$prodId' AND ProdType = 0 AND StockDate < '$FromDate'
                GROUP BY Status
            ) a
        ";
        $prev = getRecord($prevSql);
        $prevBal = $prev['balqty'] ?? 0;

        // Get Current Credit/Debit in Range
        $filter = "";
        if (!empty($FromDate)) $filter .= " AND StockDate >= '$FromDate'";
        if (!empty($ToDate)) $filter .= " AND StockDate <= '$ToDate'";

        $currSql = "
            SELECT SUM(creditqty) AS creditqty, SUM(debitqty) AS debitqty, SUM(creditqty) - SUM(debitqty) AS balqty FROM (
                SELECT 
                    CASE WHEN Status = 'Cr' THEN SUM(Qty) ELSE 0 END AS creditqty,
                    CASE WHEN Status = 'Dr' THEN SUM(Qty) ELSE 0 END AS debitqty
                FROM tbl_cust_prod_stock_2025
                WHERE FrId = '$franchiseId' AND ProdId = '$prodId' AND ProdType = 0 $filter
                GROUP BY Status
            ) a
        ";
        $curr = getRecord($currSql);

        $totalBal = ($curr['balqty'] ?? 0) + $prevBal;
        $lowStock = $totalBal < $row['MinQty'];

        $data[] = [
            "SrNo" => $i++,
            "FranchiseName" => $shopName,
            "ProductName" => $row['ProductName'],
            "CategoryName" => $row['CatName'],
            "MinQty" => (float)$row['MinQty'],
            "Credit" => (float)($curr['creditqty'] ?? 0),
            "Debit" => (float)($curr['debitqty'] ?? 0),
            "Balance" => (float)$totalBal,
            "LowStockWarning" => $lowStock
        ];
    }

    echo json_encode([
        "status" => "success",
        "filters" => [
            "FrId" => $FrId,
            "CatId" => $CatId,
            "FromDate" => $FromDate,
            "ToDate" => $ToDate
        ],
        "records" => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch stock report: " . $e->getMessage()
    ]);
}
