<?php  
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];

function uploadImage($filename,$filesize,$tempfile){
    $name = $filename;
 $size = $filesize;
 $ext = end(explode(".", $name));
 $allowed_ext = array("png", "jpg", "jpeg");
 if(in_array($ext, $allowed_ext))
 {
   $new_image = '';
   $new_name = md5(rand()) . '.' . $ext;
   $path = '../../uploads/' . $new_name; 
   list($width, $height) = getimagesize($tempfile);
   if($ext == 'png')
   {
    $new_image = imagecreatefrompng($tempfile);
   }
   if($ext == 'jpg' || $ext == 'jpeg')  
            {  
               $new_image = imagecreatefromjpeg($tempfile);  
            }
            $new_width=500;
            $new_height = ($height/$width)*500;
            $tmp_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($tmp_image, $path, 100);
            imagedestroy($new_image);
            imagedestroy($tmp_image);
           return  $new_name;
  
 }
}
if($_POST['action'] == 'saveExpenses'){
    $id = $_POST['id'];
    $VedId = addslashes(trim($_POST["VedId"]));
    $Narration = addslashes(trim($_POST["Narration"]));
$Amount = addslashes(trim($_POST["Amount"]));
$PaymentMode = addslashes(trim($_POST["PaymentMode"]));
$ExpenseDate = addslashes(trim($_POST["ExpenseDate"]));
$Gst = addslashes(trim($_POST["Gst"]));
$VedPhone = addslashes(trim($_POST["VedPhone"]));
$TempPrdId = $_POST['TempPrdId'];
$TempPrdId2 = $_POST['TempPrdId2'];
$FrId = addslashes(trim($_POST["Locations"]));
$InvoiceNo = addslashes(trim($_POST["InvoiceNo"]));

$TradeName = addslashes(trim($_POST["TradeName"]));
$TypeOfVendor = addslashes(trim($_POST["TypeOfVendor"]));
$PoNo = addslashes(trim($_POST["PoNo"]));
$Locations = addslashes(trim($_POST["Locations"]));
$AdvAmount = addslashes(trim($_POST["AdvAmount"]));
$InvType = addslashes(trim($_POST["InvType"]));

$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

if (isset($_FILES['Photo']['name']) && $_FILES['Photo']['name'] != ''){
$FileName1 = $_FILES["Photo"]["name"];
$FileSize1 = $_FILES["Photo"]["size"];
$TempFile1 = $_FILES["Photo"]["tmp_name"];
$Photo = uploadImage($FileName1,$FileSize1,$TempFile1);
}
else{
    $Photo = $_POST['OldPhoto'];
}

if (isset($_FILES['Photo2']['name']) && $_FILES['Photo2']['name'] != ''){
$FileName2 = $_FILES["Photo2"]["name"];
$FileSize2 = $_FILES["Photo2"]["size"];
$TempFile2 = $_FILES["Photo2"]["tmp_name"];
$ext2 = end(explode(".", $FileName2));
if($ext2 == 'pdf'){
    $randno = rand(1,100);
$src = $_FILES['Photo2']['tmp_name'];
$fnm = substr($_FILES["Photo2"]["name"], 0,strrpos($_FILES["Photo2"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo2"]["name"],strpos($_FILES["Photo2"]["name"],"."));
$dest = '../../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$Photo2 = $imagepath ;
} 
}
else{
$Photo2 = uploadImage($FileName2,$FileSize2,$TempFile2);
}
}
else{
    $Photo2 = $_POST['OldPhoto2'];
}

$BillSoftFrId = addslashes(trim($_POST["Locations"]));
$StockDate = addslashes(trim($_POST["ExpenseDate"]));
$Product = addslashes(trim($_POST["Product"]));
if($id != ''){
    $qx = "UPDATE tbl_vendor_expenses SET Product='$Product',InvType='$InvType',TradeName='$TradeName',TypeOfVendor='$TypeOfVendor',PoNo='$PoNo',Locations='$Locations',AdvAmount='$AdvAmount',VedId='$VedId',UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',InvoiceNo='$InvoiceNo',BdmStatus=0,PurchaseStatus=0,ManagerStatus=0,AdminStatus=0 WHERE id='$id'";
    $conn->query($qx); 
     $SaveInvId = $id;
     if (!empty($id) && is_numeric($id)) {
    $sql = "DELETE FROM tbl_ved_expense_items WHERE ExpId='$id'";
    $conn->query($sql);
    $sql = "DELETE FROM tbl_cust_prod_stock_2025 WHERE VedExpId='$id' AND VedExpItem='Yes' AND Status='Cr'";
    $conn->query($sql);
    // $sql = "DELETE FROM tbl_cust_prod_stock_2025_backup WHERE VedExpId='$id' AND VedExpItem='Yes'";
    // $conn->query($sql);
     }
  
    foreach ($_SESSION["cart_item1"] as $product) {
           $MainProdId = $product['id'];
                    $Prod_Type  = $product['ProdType'];
                    $Unit2  = $product['Unit'];
                    $Qty = addslashes(trim($product['Qty']));
                    $sql2 = "SELECT * FROM tbl_units WHERE Name2='$Unit2'";
                    $row2 = getRecord($sql2);
                    $Unit = $row2['Name'];
                    if($Prod_Type == 0){
                    $sql = "SELECT id FROM tbl_cust_products_2025 WHERE ProdId='$MainProdId' AND CreatedBy='$FrId'";
                    $row = getRecord($sql);
                    $ProdId = $row['id'];
                    $Qty2 = addslashes(trim($product['Qty']));
                    }
                    else{
                      $ProdId = $product['id'];
                      if($Unit2 == 'Pieces'){
                          $Qty2 = addslashes(trim($product['Qty']));
                      }
                      else{
                         $Qty2 =  $product['Qty']*1000;
                      }
                      
                    }
                    
                    $PurchasePrice = addslashes(trim($product['PurchasePrice']));
                    $SellPrice = addslashes(trim($product['SellPrice']));

                    
    $qx = "INSERT INTO tbl_ved_expense_items SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',srno='1',VedId='$VedId',ExpId='$SaveInvId',InvId='$SaveInvId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$BillSoftFrId',CreatedDate='$CreatedDate',FrId='$BillSoftFrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
       $conn->query($qx);
       //$VedInvId = mysqli_insert_id($conn);
       
      $qx = "INSERT INTO tbl_cust_prod_stock_2025 SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',VedExpItem='Yes',VedExpId='$SaveInvId',VedInvId='$SaveInvId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$BillSoftFrId',CreatedDate='$CreatedDate',FrId='$BillSoftFrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
       $conn->query($qx);
       $InvId = mysqli_insert_id($conn);
       
       // Step 2: Backup same record to tbl_cust_prod_stock_2025_backup
$backup_q = "INSERT INTO tbl_cust_prod_stock_2025_backup 
            SET MainProdId='$MainProdId',
                ProdId='$ProdId',
                Qty='$Qty2',
                Unit='$Unit',
                Qty2='$Qty',
                Unit2='$Unit2',
                ProdType='$Prod_Type',
                VedExpItem='Yes',
                VedExpId='$SaveInvId',
                VedInvId='$SaveInvId',
                CreatedBy='$user_id',
                StockDate='$StockDate',
                Narration='$Narration',
                Status='Cr',
                UserId='$BillSoftFrId',
                CreatedDate='$CreatedDate',
                FrId='$BillSoftFrId',
                PurchasePrice='$PurchasePrice',
                SellPrice='$SellPrice',
                orgstockid='$InvId'";

$conn->query($backup_q);

  
  $sql = "UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'";
  $conn->query($sql);
//   $url = $_SERVER['REQUEST_URI'];
//   $createddate = date('Y-m-d H:i:s');
//   $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='new customer product stock added',invid='$InvId',createddate='$createddate',roll='customer-product-stock'";
//   $conn->query($sql);
     
     
        }
        echo 1;
}
else{
$sql = "SELECT * FROM tbl_vendor_expenses WHERE VedId='$VedId' AND Amount='$Amount' AND InvoiceNo='$InvoiceNo' AND ExpenseDate='$ExpenseDate'";
$rncnt = getRow($sql);
if($rncnt > 0){
    echo 0;
}
else{
$qx = "INSERT INTO tbl_vendor_expenses SET Product='$Product',InvType='$InvType',TradeName='$TradeName',TypeOfVendor='$TypeOfVendor',PoNo='$PoNo',Locations='$Locations',AdvAmount='$AdvAmount',VedId='$VedId',UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',InvoiceNo='$InvoiceNo'";
  $conn->query($qx); 
  $SaveInvId = mysqli_insert_id($conn);
        foreach ($_SESSION["cart_item1"] as $product) {
           $MainProdId = $product['id'];
                    $Prod_Type  = $product['ProdType'];
                    $Unit2  = $product['Unit'];
                    $Qty = addslashes(trim($product['Qty']));
                    $sql2 = "SELECT * FROM tbl_units WHERE Name2='$Unit2'";
                    $row2 = getRecord($sql2);
                    $Unit = $row2['Name'];
                    if($Prod_Type == 0){
                    $sql = "SELECT id FROM tbl_cust_products_2025 WHERE ProdId='$MainProdId' AND CreatedBy='$FrId'";
                    $row = getRecord($sql);
                    $ProdId = $row['id'];
                    $Qty2 = addslashes(trim($product['Qty']));
                    }
                    else{
                      $ProdId = $product['id'];
                      if($Unit2 == 'Pieces'){
                          $Qty2 = addslashes(trim($product['Qty']));
                      }
                      else{
                         $Qty2 =  $product['Qty']*1000;
                      }
                      
                    }
                    
                    $PurchasePrice = addslashes(trim($product['PurchasePrice']));
                    $SellPrice = addslashes(trim($product['SellPrice']));

                    
    $qx = "INSERT INTO tbl_ved_expense_items SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',srno='1',VedId='$VedId',ExpId='$SaveInvId',InvId='$SaveInvId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$BillSoftFrId',CreatedDate='$CreatedDate',FrId='$BillSoftFrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
       $conn->query($qx);
       //$VedInvId = mysqli_insert_id($conn);
       
      $qx = "INSERT INTO tbl_cust_prod_stock_2025 SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',VedExpItem='Yes',VedExpId='$SaveInvId',VedInvId='$SaveInvId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$BillSoftFrId',CreatedDate='$CreatedDate',FrId='$BillSoftFrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
       $conn->query($qx);
       $InvId = mysqli_insert_id($conn);
       
       // Step 2: Backup same record to tbl_cust_prod_stock_2025_backup
$backup_q = "INSERT INTO tbl_cust_prod_stock_2025_backup 
            SET MainProdId='$MainProdId',
                ProdId='$ProdId',
                Qty='$Qty2',
                Unit='$Unit',
                Qty2='$Qty',
                Unit2='$Unit2',
                ProdType='$Prod_Type',
                VedExpItem='Yes',
                VedExpId='$SaveInvId',
                VedInvId='$SaveInvId',
                CreatedBy='$user_id',
                StockDate='$StockDate',
                Narration='$Narration',
                Status='Cr',
                UserId='$BillSoftFrId',
                CreatedDate='$CreatedDate',
                FrId='$BillSoftFrId',
                PurchasePrice='$PurchasePrice',
                SellPrice='$SellPrice',
                orgstockid='$InvId'";

$conn->query($backup_q);

//      $qx = "INSERT INTO tbl_cust_prod_stock_2025_backup SET VedInvId='$SaveInvId',ProdId='$ProdId',Qty='$Qty',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$BillSoftFrId',CreatedDate='$CreatedDate',FrId='$BillSoftFrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice',orgstockid='$InvId'";
//   $conn->query($qx);
  
  // Fetch the inserted records
// $result = $conn->query("SELECT * FROM tbl_cust_prod_stock_2025 WHERE id = '$InvId'");
// $row = $result->fetch_assoc();

// Create SQL Dump
// $sqlDump = "INSERT INTO tbl_cust_prod_stock_2025 (ProdId, Qty, CreatedBy, StockDate, Narration, Status, UserId, CreatedDate, FrId, PurchasePrice, SellPrice) 
//             VALUES ('" . implode("','", array_values($row)) . "');\n";

// file_put_contents('../stock_backup/'.$BillSoftFrId.'_backup.sql', $sqlDump, FILE_APPEND | LOCK_EX);

  
  $sql = "UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'";
  $conn->query($sql);
  $url = $_SERVER['REQUEST_URI'];
  $createddate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='new customer product stock added',invid='$InvId',createddate='$createddate',roll='customer-product-stock'";
  $conn->query($sql);
     
     
        }
        
        unset($_SESSION["cart_item1"]);
  
  $sql = "SELECT Fname,Phone FROM tbl_users WHERE id='$VedId'";
  $row = getRecord($sql);
  $VedName = $row['Fname'];
  $VedPhone = $row['Phone'];
  $smstxt = "Dear ".$VedName.", We are pleased to inform you that the Bills has been formally submitted. Thank you for your continued cooperation. - Mahachai";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169838793992439";
  $Phone = $VedPhone;
  include '../../incsmsapi.php';  
  
  echo 1;
}
}
}
?>