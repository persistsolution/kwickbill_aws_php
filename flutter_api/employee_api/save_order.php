<?php
header("Content-Type: application/json");
include 'db.php'; // Secure DB connection

$data = json_decode(file_get_contents("php://input"), true);
/*$data = [
    "CustId" => 123,
    "CellNo" => "9876543210",
    "CustName" => "John Doe",
    "InvoiceNo" => "20250628153030123",
    "InvoiceDate" => "2025-06-28 15:30:30",
    "CreatedBy" => 1,
    "CreatedDate" => "2025-06-28 15:30:30",
    "PkgDiscount" => 10.0,
    "TotalAmount" => "500.00",
    "PayType" => "Cash",
    "user_id" => "253",
    "cart" => [
        [
            "id" => 1,
            "ServerInvId" => 0,
            "InvId" => "7",
            "CatId" => 5,
            "ProdId" => 101,
            "MainProdId" => "Tea",
            "ActPrice" => 20,
            "Qty" => 2,
            "Price" => 40,
            "CgstPer" => "2.5",
            "SgstPer" => "2.5",
            "IgstPer" => "",
            "GstAmt" => 2,
            "Total" => 42,
            "CreatedDate" => "2025-06-28 15:30:30",
            "CustProd" => 0,
            "CgstAmt" => 1,
            "SgstAmt" => 1,
            "IgstAmt" => 0,
            "PkgId" => 0,
            "PkgAmt" => 0,
            "PkgDiscount" => 0,
            "PkgDate" => "",
            "PkgValidity" => "",
            "PrimeDiscount" => 0,
            "FrId" => 1,
            "upstatus" => 0,
            "modified_time" => "2025-06-28 15:30:30.000",
            "user_id" => "253"
        ]
    ]
];*/


$uid = intval($data['user_id']);
$CustName = addslashes(trim($data['CustName']));
$CellNo = addslashes(trim($data['CellNo']));
$EmailId = addslashes(trim($data['EmailId']));
$id = addslashes(trim($data['id']));
$InvoiceNo = addslashes(trim($data['InvoiceNo']));
$InvoiceDate = addslashes(trim($data['InvoiceDate']));
$CreatedBy = addslashes(trim($data['CreatedBy'])); 
$CreatedDate = addslashes(trim($data['CreatedDate'])); 
$SubTotal = addslashes(trim($data['SubTotal'])); 
$GstAmt = addslashes(trim($data['GstAmt'])); 
$TotalAmount = addslashes(trim($data['TotalAmount'])); 
$DiscPer = floatval($data['DiscPer']);
$Discount = floatval($data['Discount']);
$NetAmount = floatval($data['NetAmount']);
$ac_per = floatval($data['ac_per']);
$ac_charges = floatval($data['ac_charges']);
$FrId = floatval($data['user_id']);
$PayType = addslashes(trim($data['PayType']));
$PayType2 = addslashes(trim($data['PayType2']));
$Amount1 = addslashes(trim($data['Amount1']));
$Amount2 = addslashes(trim($data['Amount2']));
$CreatedTime= floatval($data['CreatedTime']);

$RedeemAmount = addslashes(trim($data['RedeemAmount']));
$RedeemStatus = addslashes(trim($data['RedeemStatus']));
$order_instructions = addslashes(trim($data['order_instructions']));
$table_id = addslashes(trim($data['table_id']));
$table_number = addslashes(trim($data['table_number']));
$table_name = addslashes(trim($data['table_name']));
$table_alias = addslashes(trim($data['table_alias']));
$table_label = addslashes(trim($data['table_label']));

$created_at = date('Y-m-d H:i:s');
$cart = $data['cart'];

// Fetch Roll & BillSoftFrId
$sqlFr = "SELECT Roll, BillSoftFrId FROM tbl_users_bill WHERE id='$uid'";
$resultFr = $conn->query($sqlFr);
$BillSoftFrId = $uid; // Default fallback
if ($resultFr && $resultFr->num_rows > 0) {
    $rowFr = $resultFr->fetch_assoc();
    $BillSoftFrId = $rowFr['Roll'] == 5 ? $uid : $rowFr['BillSoftFrId'];
}

// Insert customer if not exists
$CustId = 0;
if (!empty($CellNo)) {
    $sqlCust = "SELECT id FROM tbl_users WHERE Phone='$CellNo' AND Roll=55";
    $resultCust = $conn->query($sqlCust);
    if ($resultCust && $resultCust->num_rows > 0) {
        $rowCust = $resultCust->fetch_assoc();
        $CustId = $rowCust['id'];
    } else {
        $sqlInsertCust = "INSERT INTO tbl_users (Fname, Phone, EmailId,CreatedBy, CreatedDate, Roll, Status)
                          VALUES ('$CustName', '$CellNo','$EmailId', '$uid', NOW(), 55, 1)";
        $conn->query($sqlInsertCust);
        $CustId = $conn->insert_id;
        $CustomerId = "C" . $CustId;
        $conn->query("UPDATE tbl_users SET CustomerId='$CustomerId' WHERE id='$CustId'");
    }
}

// Insert Invoice (using provided InvoiceNo)
 $sqlInvoice = "INSERT INTO tbl_customer_invoice_2025 SET EmailId='$EmailId',RedeemAmount='$RedeemAmount',RedeemStatus='$RedeemStatus',order_instructions='$order_instructions',table_id='$table_id',
 table_number='$table_number',table_name='$table_name',table_alias='$table_alias',table_label='$table_label',flag=0,id='$id', CustId='$CustId', CustName='$CustName', CellNo='$CellNo',
    InvoiceDate='$InvoiceDate', InvoiceNo='$InvoiceNo', CreatedBy='$CreatedBy', CreatedDate=CURDATE(), CreatedTime=CURTIME(),
    TotalAmount='$TotalAmount', NetAmount='$NetAmount', PayType='$PayType',PayType2='$PayType2',Amount1='$Amount1',Amount2='$Amount2',
    SubTotal='$SubTotal', GstAmt='$GstAmt',DiscPer='$DiscPer',Discount='$Discount',ac_per='$ac_per',ac_charges='$ac_charges',FrId='$FrId', push_flag=1, Roll=2";
$conn->query($sqlInvoice);
$ServerInvId = mysqli_insert_id($conn);

if($CellNo!=''){
    $rupees = $NetAmount*(10/100);
    $points = $rupees * 10; // 1 Rs = 10 Points
    $sql = "INSERT INTO tbl_customer_points SET custid='$CustId',phone='$CellNo',total_amount='$NetAmount',rupees='$rupees',points='$points',invoicedate='$InvoiceDate',frid='$FrId',status='cr'";
    $conn->query($sql);
}
// Insert Items
foreach ($cart as $item) {
    $itemid = addslashes(trim($item['id']));
    $CatId = intval($item['CatId']);
    $ProdId = intval($item['ProdId']);
    $MainProdId = addslashes($item['MainProdId'] ?? '');
    $ActPrice = floatval($item['ActPrice']);
    $Qty = floatval($item['Qty']);
    $Price = floatval($item['Price']);
    $CgstPer = floatval($item['CgstPer']);
    $SgstPer = floatval($item['SgstPer']);
    $IgstPer = floatval($item['IgstPer']);
    $Total = floatval($item['Total']);
    $CgstAmt = floatval($item['CgstAmt']);
    $SgstAmt = floatval($item['SgstAmt']);
    $IgstAmt = floatval($item['IgstAmt']);
    $GstAmt = floatval($item['GstAmt']);
    

    // $cgst_amt = ($cgst_per > 0) ? round(($price * $cgst_per) / 100, 2) : 0;
    // $sgst_amt = ($sgst_per > 0) ? round(($price * $sgst_per) / 100, 2) : 0;
    // $igst_amt = ($igst_per > 0) ? round(($price * $igst_per) / 100, 2) : 0;
    // $gst_amt  = $cgst_amt + $sgst_amt + $igst_amt;

    $conn->query("INSERT INTO tbl_customer_invoice_details_2025 SET ServerInvId='$ServerInvId',id='$itemid', InvoiceNo='$InvoiceNo', InvId='$id', FrId='$FrId',
        MainProdId='$MainProdId', ProdId='$ProdId', ActPrice='$ActPrice',Qty='$Qty', Price='$Price', Total='$Total',
        CgstPer='$CgstPer', SgstPer='$SgstPer', IgstPer='$IgstPer',
        CgstAmt='$CgstAmt', SgstAmt='$SgstAmt', IgstAmt='$IgstAmt', GstAmt='$GstAmt',
        push_flag=1, CreatedDate=NOW(), CustProd=1");
}

echo json_encode([
    "success" => true,
    "invoice_id" => $invoice_id,
    "message" => "Invoice saved successfully"
]);
?>
