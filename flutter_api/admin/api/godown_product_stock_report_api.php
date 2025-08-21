<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    $GodownId = $_REQUEST['GodownId'] ?? 'all';
    $GodownProdId = $_REQUEST['GodownProdId'] ?? 'all';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    $godownSql = "SELECT * FROM tbl_users_bill WHERE Roll IN (93) AND BillSoftFrId = 0";
    if ($GodownId !== 'all') {
        $GodownId = mysqli_real_escape_string($conn, $GodownId);
        $godownSql .= " AND id = '$GodownId'";
    }
    $godownSql .= " ORDER BY Fname ASC";
    $godownRes = $conn->query($godownSql);

    $report = [];
    $srNo = 1;

    while ($godown = $godownRes->fetch_assoc()) {
        $productSql = "SELECT id, ProductName FROM tbl_cust_products2 WHERE ProdType = 3 AND Status = '1'";
        if ($GodownProdId !== 'all') {
            $GodownProdId = mysqli_real_escape_string($conn, $GodownProdId);
            $productSql .= " AND id = '$GodownProdId'";
        }
        $productSql .= " ORDER BY ProductName";
        $productRes = $conn->query($productSql);

        while ($product = $productRes->fetch_assoc()) {
            $ProdId = $product['id'];
            $godownId = $godown['id'];

            // Credit Qty
            $crSql = "SELECT SUM(Qty) AS CrQty FROM tbl_godown_raw_prod_stock WHERE GodownId = '$godownId' AND ProdId = '$ProdId' AND Status = 'Cr'";
            if (!empty($FromDate)) $crSql .= " AND StockDate >= '$FromDate'";
            if (!empty($ToDate)) $crSql .= " AND StockDate <= '$ToDate'";
            $crRes = $conn->query($crSql);
            $CrQty = $crRes->fetch_assoc()['CrQty'] ?? 0;

            // Debit Qty
            $drSql = "SELECT SUM(Qty) AS DrQty FROM tbl_godown_raw_prod_stock WHERE GodownId = '$godownId' AND ProdId = '$ProdId' AND Status = 'Dr'";
            if (!empty($FromDate)) $drSql .= " AND StockDate >= '$FromDate'";
            if (!empty($ToDate)) $drSql .= " AND StockDate <= '$ToDate'";
            $drRes = $conn->query($drSql);
            $DrQty = $drRes->fetch_assoc()['DrQty'] ?? 0;

            $report[] = [
                "SrNo" => $srNo++,
                "Godown" => $godown['Fname'],
                "ProductName" => $product['ProductName'],
                "Credit" => (float) $CrQty,
                "Debit" => (float) $DrQty,
                "Balance" => (float) $CrQty - (float) $DrQty,
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "filters" => [
            "GodownId" => $GodownId,
            "GodownProdId" => $GodownProdId,
            "FromDate" => $FromDate,
            "ToDate" => $ToDate,
        ],
        "records" => $report
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch godown product stock report: " . $e->getMessage()
    ]);
}
?>
