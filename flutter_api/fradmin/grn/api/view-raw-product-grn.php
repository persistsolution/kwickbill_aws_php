<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $BillSoftFrId = $_REQUEST['user_id'] ?? '';
    $VedId = $_REQUEST['VedId'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    if (empty($BillSoftFrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT tc.*, tu.Fname 
            FROM tbl_cust_stock_ved_inv tc 
            INNER JOIN tbl_users tu ON tu.id = tc.VedId 
            WHERE tc.FrId = '$BillSoftFrId' AND tc.ProdType = 1";

    if (!empty($VedId) && $VedId !== 'all') {
        $sql .= " AND tc.VedId = '$VedId'";
    }

    if (!empty($FromDate)) {
        $sql .= " AND tc.StockDate >= '$FromDate'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND tc.StockDate <= '$ToDate'";
    }

    $sql .= " ORDER BY tc.id DESC";

    $res = $conn->query($sql);

    $records = [];
    $i = 1;

    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "SerialNo" => $i++,
            "InvoiceNo" => $row['InvNo'],
            "VendorName" => $row['Fname'],
            "Date" => date("d-m-Y", strtotime($row['StockDate'])),
            "StockInQty" => (float) $row['TotalQty']
           
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
