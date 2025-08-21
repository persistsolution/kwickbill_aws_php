<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $ReportType = $_REQUEST['ReportType'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';
    $PayType = $_REQUEST['PayType'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT * FROM tbl_customer_invoice_2025 
            WHERE Roll = 2 AND Status = 1 AND FrId = '$FrId' AND delete_flag = 0 AND Discount > 0";

    if (!empty($ReportType)) {
        switch ($ReportType) {
            case 'Today':
                $sql .= " AND InvoiceDate = '" . date('Y-m-d') . "'";
                break;
            case 'Yesterday':
                $sql .= " AND InvoiceDate = '" . date('Y-m-d', strtotime('-1 day')) . "'";
                break;
            case 'Week':
                $sql .= " AND InvoiceDate >= '" . date('Y-m-d', strtotime('-7 day')) . "' AND InvoiceDate <= '" . date('Y-m-d') . "'";
                break;
            case 'Month':
                $sql .= " AND InvoiceDate >= '" . date('Y-m-d', strtotime('-30 day')) . "' AND InvoiceDate <= '" . date('Y-m-d') . "'";
                break;
            case 'Custom':
                // Do nothing here, handled below
                break;
        }
    }

    if (!empty($FromDate)) {
        $sql .= " AND InvoiceDate >= '$FromDate'";
    }
    if (!empty($ToDate)) {
        $sql .= " AND InvoiceDate <= '$ToDate'";
    }
    if (!empty($PayType) && $PayType != 'all') {
        $sql .= " AND PayType = '$PayType'";
    }

    $sql .= " ORDER BY InvoiceDate DESC";

    $rows = getList($sql);
    $records = [];
    $TotSubTotal = $TotDiscount = $TotAmt = 0;

    foreach ($rows as $row) {
        $TotSubTotal += $row['SubTotal'];
        $TotDiscount += $row['Discount'];
        $TotAmt += $row['NetAmount'];

        $records[] = [
            "InvoiceNo" => $row['InvoiceNo'],
            "InvoiceDate" => date("d/m/Y", strtotime($row['InvoiceDate'])),
            "CustName" => $row['CustName'],
            "CellNo" => $row['CellNo'],
            "SubTotal" => round($row['SubTotal'], 2),
            "DiscPer" => $row['DiscPer'],
            "Discount" => round($row['Discount'], 2),
            "NetAmount" => round($row['NetAmount'], 2),
            "PayType" => $row['PayType']
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records,
        "totals" => [
            "SubTotal" => round($TotSubTotal, 2),
            "Discount" => round($TotDiscount, 2),
            "NetAmount" => round($TotAmt, 2)
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch discounted invoice report: " . $e->getMessage()
    ]);
}
?>
