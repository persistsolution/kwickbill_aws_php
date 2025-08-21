<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

session_start();
require_once '../../config.php'; // Adjust the path as needed

// Read and decode JSON input
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Fallback to POST if JSON not found
if (!$data || !is_array($data)) {
    $data = $_POST;
}

// Validate required fields
$required = ['ProdId', 'PurchasePrice', 'TotalPrice', 'Qty', 'QtyUnit', 'Qty2', 'QtyUnit2', 'StockDate', 'Narration', 'CreatedBy', 'FrId'];
$missing = [];
foreach ($required as $field) {
    if (!isset($data[$field]) || $data[$field] === '') {
        $missing[] = $field;
    }
}

if (!empty($missing)) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing required fields: " . implode(', ', $missing)
    ]);
    exit;
}

// Sanitize inputs
$ProdId = intval($data['ProdId']);
$PurchasePrice = floatval($data['PurchasePrice']);
$TotalPrice = floatval($data['TotalPrice']);
$Qty = floatval($data['Qty']);
$Unit = addslashes(trim($data['QtyUnit']));
$Qty2 = floatval($data['Qty2']);
$Unit2 = addslashes(trim($data['QtyUnit2']));
$StockDate = addslashes(trim($data['StockDate']));
$Narration = addslashes(trim($data['Narration']));
$CreatedBy = intval($data['CreatedBy']);
$FrId = intval($data['FrId']);
$CreatedDate = date('Y-m-d H:i:s');

// Determine BillSoftFrId
$BillSoftFrId = $FrId;
$sql77 = "SELECT Roll, BillSoftFrId FROM tbl_users_bill WHERE id='$FrId'";
$res77 = $conn->query($sql77);
if ($res77 && $res77->num_rows > 0) {
    $row77 = $res77->fetch_assoc();
    $BillSoftFrId = ($row77['Roll'] == 5) ? $FrId : $row77['BillSoftFrId'];
}

// Insert into main table
$sql = "INSERT INTO tbl_cust_prod_stock_2025 
    SET SellPrice='$TotalPrice', PurchasePrice='$PurchasePrice', ProdType=1,
        UserId='$BillSoftFrId', Qty2='$Qty2', Unit2='$Unit2', FrId='$BillSoftFrId',
        ProdId='$ProdId', Qty='$Qty', Unit='$Unit', CreatedBy='$CreatedBy',
        StockDate='$StockDate', Narration='$Narration', Status='Cr', CreatedDate='$CreatedDate'";

if ($conn->query($sql)) {
    $InvId = $conn->insert_id;

   
    // SQL dump
    $result = $conn->query("SELECT * FROM tbl_cust_prod_stock_2025 WHERE id='$InvId'");
    if ($result && $row = $result->fetch_assoc()) {
        $sqlDump = "INSERT INTO tbl_cust_prod_stock_2025 (" . implode(',', array_keys($row)) . ") VALUES ('" . implode("','", array_map('addslashes', array_values($row))) . "');\n";
        file_put_contents('raw_stock_backup/' . $BillSoftFrId . '_backup.sql', $sqlDump, FILE_APPEND | LOCK_EX);
    }

    // Update purchase price in product table
    $conn->query("UPDATE tbl_cust_products2 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'");

   

    echo json_encode([
        "status" => "success",
        "message" => "Raw product stock added successfully",
        "inserted_id" => $InvId
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $conn->error
    ]);
}
?>
