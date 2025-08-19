<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'] ?? 0;

function uploadImage($filename, $filesize, $tempfile) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed_ext = ["png", "jpg", "jpeg"];
    if (!in_array($ext, $allowed_ext)) return '';

    $new_name = md5(rand()) . '.' . $ext;
    $path = '../../uploads/' . $new_name;
    list($width, $height) = getimagesize($tempfile);

  if ($ext == 'png') {
    $image = imagecreatefrompng($tempfile);
} elseif ($ext == 'jpg' || $ext == 'jpeg') {
    $image = imagecreatefromjpeg($tempfile);
} else {
    $image = false;
}
    if (!$image) return '';

    $new_width = 500;
    $new_height = ($height / $width) * 500;
    $tmp_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($tmp_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($tmp_image, $path, 100);
    imagedestroy($image);
    imagedestroy($tmp_image);
    return $new_name;
}

function insertExpenseProduct($product, $conn, $SaveInvId, $VedId, $FrId, $BillSoftFrId, $user_id, $StockDate, $Narration, $CreatedDate) {
    $MainProdId = $product['id'];
    $Prod_Type  = $product['ProdType'];
    $Unit2      = $product['Unit'];
    $Qty        = addslashes(trim($product['Qty']));
    $PurchasePrice = addslashes(trim($product['PurchasePrice']));
    $SellPrice     = addslashes(trim($product['SellPrice']));

    $row2 = getRecord("SELECT * FROM tbl_units WHERE Name2='$Unit2'");
    $Unit = $row2['Name'] ?? $Unit2;

    if ($Prod_Type == 0) {
        $row = getRecord("SELECT id FROM tbl_cust_products_2025 WHERE ProdId='$MainProdId' AND CreatedBy='$FrId'");
        $ProdId = $row['id'] ?? 0;
        $Qty2 = $Qty;
    } else {
        $ProdId = $product['id'];
        $Qty2 = ($Unit2 == 'Pieces') ? $Qty : ($Qty * 1000);
    }

    $fields = [
        'MainProdId' => $MainProdId,
        'ProdId' => $ProdId,
        'Qty' => $Qty2,
        'Unit' => $Unit,
        'Qty2' => $Qty,
        'Unit2' => $Unit2,
        'ProdType' => $Prod_Type,
        'VedExpItem' => 'Yes',
        'VedExpId' => $SaveInvId,
        'VedInvId' => $SaveInvId,
        'CreatedBy' => $user_id,
        'StockDate' => $StockDate,
        'Narration' => $Narration,
        'Status' => 'Cr',
        'UserId' => $BillSoftFrId,
        'CreatedDate' => $CreatedDate,
        'FrId' => $BillSoftFrId,
        'PurchasePrice' => $PurchasePrice,
        'SellPrice' => $SellPrice
    ];

    $insertFields = implode(",", array_map(function($k) use ($fields) {
    return "$k='{$fields[$k]}'";
}, array_keys($fields)));

    $conn->query("INSERT INTO tbl_ved_expense_items SET srno='1', VedId='$VedId', ExpId='$SaveInvId', InvId='$SaveInvId', $insertFields");
    $conn->query("INSERT INTO tbl_cust_prod_stock_2025 SET $insertFields");
    $InvId = mysqli_insert_id($conn);

    $fields['orgstockid'] = $InvId;
   $backupFields = implode(",", array_map(function($k) use ($fields) {
    return "$k='{$fields[$k]}'";
}, array_keys($fields)));

    $conn->query("INSERT INTO tbl_cust_prod_stock_2025_backup SET $backupFields");

    $conn->query("UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'");
}

if ($_POST['action'] === 'saveExpenses') {
    extract($_POST);
    $ExpenseDate = $StockDate = addslashes(trim($ExpenseDate));
    $CreatedDate = $ModifiedDate = date('Y-m-d');

    $Photo = ($_FILES['Photo']['name'] ?? '') ? uploadImage($_FILES['Photo']['name'], $_FILES['Photo']['size'], $_FILES['Photo']['tmp_name']) : $_POST['OldPhoto'];
    $Photo2 = ($_FILES['Photo2']['name'] ?? '') 
        ? (strtolower(pathinfo($_FILES["Photo2"]["name"], PATHINFO_EXTENSION)) == 'pdf'
            ? (move_uploaded_file($_FILES["Photo2"]["tmp_name"], $pdfDest = '../../uploads/' . rand(1,100) . "_" . str_replace(" ","_", pathinfo($_FILES["Photo2"]["name"], PATHINFO_FILENAME)) . ".pdf") ? basename($pdfDest) : '')
            : uploadImage($_FILES['Photo2']['name'], $_FILES['Photo2']['size'], $_FILES['Photo2']['tmp_name']))
        : $_POST['OldPhoto2'];

    $isUpdate = !empty($id);

    if ($isUpdate) {
        $conn->query("UPDATE tbl_vendor_expenses SET Product='$Product', InvType='$InvType', TradeName='$TradeName', TypeOfVendor='$TypeOfVendor', PoNo='$PoNo', Locations='$Locations', AdvAmount='$AdvAmount', VedId='$VedId', UserId='$user_id', Status='0', Narration='$Narration', Amount='$Amount', PaymentMode='$PaymentMode', ExpenseDate='$ExpenseDate', ModifiedDate='$ModifiedDate', ModifiedBy='$user_id', Gst='$Gst', TempPrdId='$TempPrdId', TempPrdId2='$TempPrdId2', VedPhone='$VedPhone', FrId='$FrId', Photo='$Photo', Photo2='$Photo2', InvoiceNo='$InvoiceNo' WHERE id='$id'");
        $conn->query("DELETE FROM tbl_ved_expense_items WHERE ExpId='$id'");
        $conn->query("DELETE FROM tbl_cust_prod_stock_2025 WHERE VedExpId='$id' AND VedExpItem='Yes'");
        $SaveInvId = $id;
    } else {
        $sqlCheck = "SELECT * FROM tbl_vendor_expenses WHERE VedId='$VedId' AND Amount='$Amount' AND InvoiceNo='$InvoiceNo' AND ExpenseDate='$ExpenseDate'";
        if (getRow($sqlCheck) > 0) {
            echo 0;
            exit;
        }
        $conn->query("INSERT INTO tbl_vendor_expenses SET Product='$Product', InvType='$InvType', TradeName='$TradeName', TypeOfVendor='$TypeOfVendor', PoNo='$PoNo', Locations='$Locations', AdvAmount='$AdvAmount', VedId='$VedId', UserId='$user_id', Status='0', Narration='$Narration', Amount='$Amount', PaymentMode='$PaymentMode', ExpenseDate='$ExpenseDate', CreatedDate='$CreatedDate', CreatedBy='$user_id', Gst='$Gst', TempPrdId='$TempPrdId', TempPrdId2='$TempPrdId2', VedPhone='$VedPhone', FrId='$FrId', Photo='$Photo', Photo2='$Photo2', InvoiceNo='$InvoiceNo'");
        $SaveInvId = mysqli_insert_id($conn);
    }

    foreach ($_SESSION["cart_item1"] as $product) {
        insertExpenseProduct($product, $conn, $SaveInvId, $VedId, $FrId, $Locations, $user_id, $StockDate, $Narration, $CreatedDate);
    }

    if (!$isUpdate) {
        unset($_SESSION["cart_item1"]);
        $row = getRecord("SELECT Fname, Phone FROM tbl_users WHERE id='$VedId'");
        $smstxt = "Dear {$row['Fname']}, We are pleased to inform you that the Bills has been formally submitted. Thank you for your continued cooperation. - Mahachai";
        include '../../incsmsapi.php';
    }

    echo 1;
}
?>
