<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

session_start();
require_once '../../config.php'; // Adjust path if needed

// Read and decode JSON input
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Fallback to POST if JSON not found
if (!$data || !is_array($data)) {
    $data = $_POST;
}

// Validate required fields
$required = ['ProdId', 'Qty', 'PurchasePrice', 'SellPrice', 'StockDate', 'Narration', 'CreatedBy', 'FrId'];
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
$Qty = floatval($data['Qty']);
$PurchasePrice = floatval($data['PurchasePrice']);
$SellPrice = floatval($data['SellPrice']);
$StockDate = addslashes(trim($data['StockDate']));
$Narration = addslashes(trim($data['Narration']));
$CreatedBy = intval($data['CreatedBy']);
$FrId = intval($data['FrId']);
$CreatedDate = date('Y-m-d');

// Determine BillSoftFrId
$BillSoftFrId = $FrId;
$sql77 = "SELECT Roll, BillSoftFrId FROM tbl_users_bill WHERE id = '$FrId'";
$res77 = $conn->query($sql77);
if ($res77 && $res77->num_rows > 0) {
    $row77 = $res77->fetch_assoc();
    $BillSoftFrId = ($row77['Roll'] == 5) ? $FrId : $row77['BillSoftFrId'];
}

// Insert stock record
$sql = "INSERT INTO tbl_cust_prod_stock_2025 
    SET ProdId='$ProdId', Qty='$Qty', CreatedBy='$CreatedBy', StockDate='$StockDate',
        Narration='$Narration', Status='Cr', UserId='$BillSoftFrId', CreatedDate='$CreatedDate',
        FrId='$BillSoftFrId', PurchasePrice='$PurchasePrice', SellPrice='$SellPrice'";

if ($conn->query($sql)) {
    $InvId = $conn->insert_id;

   
    // SQL dump file
    $result = $conn->query("SELECT * FROM tbl_cust_prod_stock_2025 WHERE id = '$InvId'");
    if ($result && $row = $result->fetch_assoc()) {
        $sqlDump = "INSERT INTO tbl_cust_prod_stock_2025 (" . implode(',', array_keys($row)) . ") VALUES ('" . implode("','", array_map('addslashes', array_values($row))) . "');\n";
        file_put_contents('stock_backup/' . $BillSoftFrId . '_backup.sql', $sqlDump, FILE_APPEND | LOCK_EX);
    }

    // Update purchase price in product
    $conn->query("UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'");

   

    echo json_encode([
        "status" => "success",
        "message" => "Product stock added successfully",
        "inserted_id" => $InvId
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $conn->error
    ]);
}
?>
