<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $TransferId = $_REQUEST['id'] ?? '';

    if (empty($TransferId)) {
        throw new Exception("TransferId is required");
    }

    $sql = "SELECT tcp.ProductName, ttf.Qty, ttf.Unit
            FROM tbl_transfer_franchise_prod_stock_items_2025 ttf
            LEFT JOIN tbl_cust_products_2025 tcp ON ttf.ProdId = tcp.id
            WHERE ttf.TransferId = '$TransferId'
            ORDER BY ttf.CreatedDate DESC";

    $res = $conn->query($sql);

    $items = [];
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $items[] = [
            "SrNo" => $i++,
            "ProductName" => $row['ProductName'],
            "Qty" => $row['Qty'] . ' ' . $row['Unit']
        ];
    }

    echo json_encode([
        "status" => "success",
        "items" => $items
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch items: " . $e->getMessage()
    ]);
}
?>
