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

    $where = "Roll = 2 AND Status = 0 AND FrId = '$FrId'";

    if (!empty($FromDate)) {
        $where .= " AND InvoiceDate >= '$FromDate'";
    }
    if (!empty($ToDate)) {
        $where .= " AND InvoiceDate <= '$ToDate'";
    }

    $sql = "(SELECT *, '2024' AS Year FROM tbl_customer_invoice WHERE $where)
            UNION ALL
            (SELECT *, '2025' AS Year FROM tbl_customer_invoice_2025 WHERE $where)
            ORDER BY InvoiceDate DESC";

    $res = $conn->query($sql);
    $records = [];

    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "OrderNo" => $row['OrderNo'],
            "InvoiceNo" => $row['InvoiceNo'],
            "InvoiceDate" => date("d/m/Y", strtotime($row['InvoiceDate'])),
            "CustomerName" => $row['CustName'],
            "NetAmount" => round($row['NetAmount'], 2),
            "PayType" => $row['PayType'],
            // "ViewLink" => "view-order-items.php?id={$row['Unqid']}&year={$row['Year']}"
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
