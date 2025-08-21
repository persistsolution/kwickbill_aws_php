<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $BillSoftFrId = $_REQUEST['user_id'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    if (empty($BillSoftFrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT ts.* FROM tbl_cash_book ts WHERE ts.FrId = '$BillSoftFrId'";

    if (!empty($FromDate)) {
        $sql .= " AND ts.TransferDate >= '$FromDate'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND ts.TransferDate <= '$ToDate'";
    }

    $sql .= " ORDER BY ts.id DESC";

    $res = $conn->query($sql);

    $records = [];
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $receiptLink = '';
        if ($row['Files'] && file_exists("../uploads/" . $row['Files'])) {
            $receiptLink = "../uploads/" . $row['Files'];
        } else {
            $receiptLink = null;
        }

        $records[] = [
            "SerialNo" => $i++,
            "Date" => date("d-m-Y", strtotime($row['TransferDate'])),
            "TotalAmount" => (float) $row['TotalAmount'],
            "TransferAmount" => (float) $row['Amount'],
            "BalanceAmount" => (float) $row['BalAmt'],
            "BankName" => $row['BankName'],
            "Receipt" => $receiptLink
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
