<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $CatId = $_REQUEST['CatId'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    $sql = "SELECT id, Name FROM tbl_cust_category_2025 WHERE ProdType = 0";
    if (!empty($CatId) && $CatId != 'all') {
        $sql .= " AND id = '$CatId'";
    }
    $sql .= " ORDER BY srno ASC";

    $categories = getList($sql);
    $records = [];

    foreach ($categories as $cat) {
        $sql2 = "SELECT SUM(tcid.Total) AS Total, COUNT(tcid.id) AS TotProd
                 FROM tbl_customer_invoice_details_2025 tcid
                 INNER JOIN tbl_customer_invoice_2025 tci ON tci.id = tcid.InvId
                 WHERE tcid.CatId = '{$cat['id']}' AND tci.Roll = 2 AND tci.FrId = '$FrId'";

        if (!empty($FromDate)) {
            $sql2 .= " AND tci.InvoiceDate >= '$FromDate'";
        }
        if (!empty($ToDate)) {
            $sql2 .= " AND tci.InvoiceDate <= '$ToDate'";
        }

        $row2 = getRecord($sql2);

        if (($row2['TotProd'] ?? 0) > 0) {
            $records[] = [
                "Category" => $cat['Name'],
                "TotalSell" => (int)$row2['TotProd'],
                "Amount" => round($row2['Total'], 2)
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to generate category-wise sell report: " . $e->getMessage()
    ]);
}
?>
