<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    $ZoneId = $_REQUEST['ZoneId'] ?? 'all';
    $SubZoneId = $_REQUEST['SubZoneId'] ?? 'all';
    $FrId = $_REQUEST['FrId'] ?? 'all';
    $CatId = $_REQUEST['CatId'] ?? 'all';
    $FromDate = $_REQUEST['FromDate'] ?? '2025-06-01';
    $ToDate = $_REQUEST['ToDate'] ?? '2025-06-30';

    $conditions = [
        "ts.Status = 'Cr'",
        "ts.FrId != 0",
        "ts.ProdType = 1"
    ];

    if ($FrId !== 'all') {
        $FrId = mysqli_real_escape_string($conn, $FrId);
        $conditions[] = "ts.FrId = '$FrId'";
    }

    if ($ZoneId !== 'all') {
        $ZoneId = mysqli_real_escape_string($conn, $ZoneId);
        $conditions[] = "tu.ZoneId = '$ZoneId'";
    }

    if ($SubZoneId !== 'all') {
        $SubZoneId = mysqli_real_escape_string($conn, $SubZoneId);
        $conditions[] = "tu.SubZoneId = '$SubZoneId'";
    }

    if ($CatId !== 'all') {
        $CatId = mysqli_real_escape_string($conn, $CatId);
        $conditions[] = "p.CatId = '$CatId'";
    }

    if (!empty($FromDate)) $conditions[] = "ts.StockDate >= '$FromDate'";
    if (!empty($ToDate)) $conditions[] = "ts.StockDate <= '$ToDate'";

    $conditionStr = implode(' AND ', $conditions);

    $sql = "
        SELECT ts.FrId, ts.ProdId, ts.Unit, ts.Unit2, p.ProductName, p.MinQty, p.CatId, tu.ZoneId, tu.SubZoneId
        FROM tbl_cust_prod_stock_2025 ts
        INNER JOIN tbl_cust_products2 p ON ts.ProdId = p.id
        INNER JOIN tbl_users_bill tu ON ts.FrId = tu.id
        WHERE $conditionStr
        GROUP BY ts.ProdId
        ORDER BY ts.id DESC
    ";

    $res = $conn->query($sql);
    $records = [];
    $i = 1;

    while ($row = $res->fetch_assoc()) {
        $franchiseId = $row['FrId'];
        $productId = $row['ProdId'];

        // Shop name
        $franchise = getRecord("SELECT ShopName FROM tbl_users_bill WHERE id = '$franchiseId'");

        // Zone and SubZone name
        $zone = getRecord("SELECT Name FROM tbl_zone WHERE id = '" . $row['ZoneId'] . "'");
        $subzone = getRecord("SELECT Name FROM tbl_sub_zone WHERE id = '" . $row['SubZoneId'] . "'");

        // Balance calculation
        $stockSql = "
            SELECT SUM(creditqty) AS creditqty, SUM(debitqty) AS debitqty, SUM(creditqty) - SUM(debitqty) AS balqty FROM (
                SELECT 
                    CASE WHEN Status = 'Cr' THEN SUM(Qty) ELSE 0 END AS creditqty,
                    CASE WHEN Status = 'Dr' THEN SUM(Qty) ELSE 0 END AS debitqty
                FROM tbl_cust_prod_stock_2025
                WHERE FrId = '$franchiseId' AND ProdId = '$productId' AND ProdType = 1
        ";
        if (!empty($FromDate)) $stockSql .= " AND StockDate >= '$FromDate'";
        if (!empty($ToDate)) $stockSql .= " AND StockDate <= '$ToDate'";
        $stockSql .= " GROUP BY Status ) AS a";

        $stock = getRecord($stockSql);

        $credit = $stock['creditqty'] ?? 0;
        $debit = $stock['debitqty'] ?? 0;
        $balance = $stock['balqty'] ?? 0;

        // Unit conversion
        $isKg = strtolower($row['Unit']) != 'pieces';
        $factor = $isKg ? 1000 : 1;
        $unitLabel = $row['Unit2'];

        $creditQty = round($credit / $factor, 2) . ' ' . $unitLabel;
        $debitQty = round($debit / $factor, 2) . ' ' . $unitLabel;
        $balQty = round($balance / $factor, 2) . ' ' . $unitLabel;

        $lowStock = $balance < $row['MinQty'];

        $records[] = [
            "SrNo" => $i++,
            "FranchiseName" => $franchise['ShopName'] ?? '',
            "Zone" => $zone['Name'] ?? '',
            "SubZone" => $subzone['Name'] ?? '',
            "RawProductName" => $row['ProductName'],
            "Credit" => $creditQty,
            "Debit" => $debitQty,
            "Balance" => $balQty,
            "LowStockWarning" => $lowStock
        ];
    }

    echo json_encode([
        "status" => "success",
        "filters" => [
            "FrId" => $FrId,
            "ZoneId" => $ZoneId,
            "SubZoneId" => $SubZoneId,
            "FromDate" => $FromDate,
            "ToDate" => $ToDate
        ],
        "records" => $records
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch raw product stock report: " . $e->getMessage()
    ]);
}
?>
