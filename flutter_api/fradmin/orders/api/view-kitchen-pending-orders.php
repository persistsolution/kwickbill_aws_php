<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $FrId = $_REQUEST['user_id'] ?? '';
    $FromDate = date('Y-m-d');
    $ToDate = date('Y-m-d');
    $PayType = $_REQUEST['PayType'] ?? '';

    if (empty($FrId)) {
        throw new Exception("FrId is required");
    }

    // Common condition
    $whereCommon = "Roll = 2 AND Status = 1 AND FrId = '$FrId' AND delete_flag = 0 AND KitchenStatus=0";

    if (!empty($FromDate)) {
        $whereCommon .= " AND InvoiceDate >= '$FromDate'";
    }
    if (!empty($ToDate)) {
        $whereCommon .= " AND InvoiceDate <= '$ToDate'";
    }
    if (!empty($PayType) && $PayType !== 'all') {
        $whereCommon .= " AND PayType = '$PayType'";
    }

    $srno = 1;
    $sql = "SELECT *, '2025' AS Year FROM tbl_customer_invoice_2025 WHERE $whereCommon ORDER BY InvoiceDate DESC";
    $res = $conn->query($sql);

    $records = [];
    $totalAmount = 0;

    while ($row = $res->fetch_assoc()) {
        $invoiceNo = $row['InvoiceNo'];
        $serverInvId = $row['Unqid'];
        $invId = $row['id'];
        $year = $row['Year'];

        // Check for items with ProdType2 = 2
        $detailsTable = 'tbl_customer_invoice_details_2025';
        $productTable = 'tbl_cust_products_2025';

        $itemSql = "SELECT d.*, p.ProductName
                    FROM $detailsTable d
                    INNER JOIN $productTable p ON d.ProdId = p.id
                    WHERE d.ServerInvId = '$serverInvId' AND d.InvId = '$invId' AND p.ProdType2 = 2";
        $itemRes = $conn->query($itemSql);

        if ($itemRes->num_rows > 0) {
            // Add invoice header only if items exist
            $records[] = [
                "OrderNo" => $srno,
                "VideoLink" => "https://www.youtube.com/watch?v=xVVHZ_CJllg",
                "InvId" => $row['Unqid'],
                "InvoiceNo" => $row['InvoiceNo'],
                "InvoiceDate" => date("d/m/Y", strtotime($row['InvoiceDate'])),
                "CustomerName" => $row['CustName'],
                "Qty" => "",
                "Rate" => "",
                "Amount" => "",
            ];

            // Add each item
            while ($itemRow = $itemRes->fetch_assoc()) {
                $records[] = [
                    "OrderNo" => $srno,
                    "VideoLink" => "https://www.youtube.com/watch?v=xVVHZ_CJllg",
                    "InvId" => $row['Unqid'],
                    "InvoiceNo" => "",
                    "InvoiceDate" => "",
                    "ItemName" => $itemRow['ProductName'],
                    "Qty" => $itemRow['Qty'],
                    "Rate" => $itemRow['Price'],
                    "Amount" => $itemRow['Total'],
                ];
            }

            $totalAmount += $row['NetAmount'];
            $srno++;
        }
    }

    echo json_encode([
        "status" => "success",
        "totalAmount" => round($totalAmount, 2),
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch records: " . $e->getMessage()
    ]);
}
?>
