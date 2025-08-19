<?php
session_start();
include_once '../config.php';
require_once("../dbcontroller.php");
$db_handle = new DBController();
$user_id = $_SESSION['User']['id'];
$sql110 = "SELECT Roll FROM tbl_users WHERE id='$user_id'";
$row110 = getRecord($sql110);
$Roll = $row110['Roll'];

function uploadImage($filename, $filesize, $tempfile)
{
    $name = $filename;
    $size = $filesize;
    $ext = end(explode(".", $name));
    $allowed_ext = array("png", "jpg", "jpeg");
    if (in_array($ext, $allowed_ext)) {
        $new_image = '';
        $new_name = md5(rand()) . '.' . $ext;
        $path = '../../expense_files/' . $new_name;
        list($width, $height) = getimagesize($tempfile);
        if ($ext == 'png') {
            $new_image = imagecreatefrompng($tempfile);
        }
        if ($ext == 'jpg' || $ext == 'jpeg') {
            $new_image = imagecreatefromjpeg($tempfile);
        }
        $new_width = 500;
        $new_height = ($height / $width) * 500;
        $tmp_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($tmp_image, $path, 100);
        imagedestroy($new_image);
        imagedestroy($tmp_image);
        return  $new_name;
    }
}

if ($_POST['action'] == 'saveExpenses') {
    $id = $_POST['id'];
    $Remark = addslashes(trim($_POST["Remark"]));
    $ExpenseDate = addslashes(trim($_POST["ExpDate"]));
    $StockDate = addslashes(trim($_POST["ExpDate"]));
    $TempPrdId = $_POST['TempPrdId'];
    $TempPrdId2 = $_POST['TempPrdId2'];
    $FrId = addslashes(trim($_POST["FrId"]));
    //$ExpCatId = addslashes(trim($_POST["ExpCatId"]));
    $Locations = addslashes(trim($_POST["Locations"]));
    $Claims = addslashes(trim($_POST["Claims"]));
    $SendToApproval = addslashes(trim($_POST["SendToApproval"]));
    $CreatedDate = date('Y-m-d');
    $ModifiedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');

    $date1 = date_create($ExpenseDate);
    $date2 = date_create($CreatedDate);
    $diff = date_diff($date1, $date2);
    if ($ExpenseDate < $CreatedDate) {
        $TotDays = $diff->format("%a");
    } else {
        $TotDays = 0;
    }

    $TotAmt = $_POST['TotAmt'];

    if ($id == '') {
        $sql = "SELECT * FROM tbl_expense_request WHERE Amount='$TotAmt' AND ExpenseDate='$ExpenseDate' AND UserId = '$user_id' AND FrId='$FrId'";
        $rncnt = getRow($sql);
        if($rncnt > 0){
             echo 0;
        }
        else{
        if ($Roll == 1 || $Roll == 7) {
            $qx = "INSERT INTO tbl_expense_request SET SendToApproval='$SendToApproval',mult='2',UserId = '$user_id',Status='0',Narration = '$Remark',Amount='$TotAmt',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',TotDays='$TotDays',Locations='$Locations',AdminStatus=1,AccBy='$user_id',AdminApproveDate='$CreatedDate',Claims='$Claims'";
            $conn->query($qx);
            $ExpId = mysqli_insert_id($conn);

            $sql = "DELETE FROM wallet WHERE UserId='$user_id' AND ExpId='$ExpId'";
            $conn->query($sql);
            $Narration = "Amount Deduct against Expense " . $Remark;
            $sql = "INSERT INTO wallet SET UserId='$user_id',Amount='$TotAmt',Narration='$Remark',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ExpId='$ExpId'";
            $conn->query($sql);
        } else {
            $qx = "INSERT INTO tbl_expense_request SET AdminStatus=0,ManagerStatus=0,SendToApproval='$SendToApproval',mult='2',UserId = '$user_id',Status='0',Narration = '$Remark',Amount='$TotAmt',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',TotDays='$TotDays',Locations='$Locations',Claims='$Claims'";
            $conn->query($qx);
            $ExpId = mysqli_insert_id($conn);
        }
        
        
    //      $sql = "DELETE FROM tbl_expense_request_items WHERE ExpId='$ExpId'";
    // $conn->query($sql);
    // $sql = "DELETE FROM tbl_emp_expense_prod_items WHERE ExpId='$ExpId'";
    // $conn->query($sql);
    // $sql = "DELETE FROM tbl_cust_prod_stock_2025 WHERE EmpExpId='$ExpId'";
    // $conn->query($sql);

    $number = count($_POST["Amount"]);
    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            if (trim($_POST["Amount"][$i] != '')) {
                $Amount = addslashes(trim($_POST["Amount"][$i]));
                $PaymentMode = addslashes(trim($_POST["PaymentMode"][$i]));
                $ExpenseDate = addslashes(trim($_POST["ExpenseDate"][$i]));
                $Gst = addslashes(trim($_POST["Gst"][$i]));
                $VedPhone = addslashes(trim($_POST["VedPhone"][$i]));
                $Narration = addslashes(trim($_POST["Narration"][$i]));
                $ExpCatId = addslashes(trim($_POST["ExpCatId"][$i]));
                $srno = addslashes(trim($_POST["srno"][$i]));
                $Product = addslashes(trim($_POST["Product"][$i]));
                $PdfLink = addslashes(trim($_POST["PdfLink"][$i]));

                if (isset($_FILES['Photo']['name'][$i]) && $_FILES['Photo']['name'][$i] != ''){
                    $FileName1 = $_FILES["Photo"]["name"][$i];
                    $FileSize1 = $_FILES["Photo"]["size"][$i];
                    $TempFile1 = $_FILES["Photo"]["tmp_name"][$i];
                    $ext = strtolower(pathinfo($FileName1, PATHINFO_EXTENSION));

                    if ($ext === 'pdf') {
                        $randno = rand(1, 100);
                        $baseName = str_replace(" ", "_", pathinfo($FileName1, PATHINFO_FILENAME));
                        $newFileName = $randno . "_" . $baseName . "." . $ext;
                        $dest = '../../expense_files/' . $newFileName;

                        if (move_uploaded_file($TempFile1, $dest)) {
                            $Photo = $newFileName;
                        }
                    } else {
                        $Photo = uploadImage($FileName1, $FileSize1, $TempFile1); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo = $_POST['OldPhoto'][$i];
                }


               if (isset($_FILES['Photo2']['name'][$i]) && $_FILES['Photo2']['name'][$i] != ''){
                    $FileName2 = $_FILES["Photo2"]["name"][$i];
                    $FileSize2 = $_FILES["Photo2"]["size"][$i];
                    $TempFile2 = $_FILES["Photo2"]["tmp_name"][$i];
                    $ext2 = strtolower(pathinfo($FileName2, PATHINFO_EXTENSION));

                    if ($ext2 === 'pdf') {
                        $randno2 = rand(1, 100);
                        $baseName2 = str_replace(" ", "_", pathinfo($FileName2, PATHINFO_FILENAME));
                        $newFileName2 = $randno2 . "_" . $baseName2 . "." . $ext2;
                        $dest2 = '../../expense_files/' . $newFileName2;

                        if (move_uploaded_file($TempFile2, $dest2)) {
                            $Photo2 = $newFileName2;
                        }
                    } else {
                        $Photo2 = uploadImage($FileName2, $FileSize2, $TempFile2); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo2 = $_POST['OldPhoto2'][$i];
                }

                if (isset($_FILES['Photo3']['name'][$i]) && $_FILES['Photo3']['name'][$i] != ''){
                    $FileName3 = $_FILES["Photo3"]["name"][$i];
                    $FileSize3 = $_FILES["Photo3"]["size"][$i];
                    $TempFile3 = $_FILES["Photo3"]["tmp_name"][$i];
                    $ext3 = strtolower(pathinfo($FileName3, PATHINFO_EXTENSION));

                    if ($ext3 === 'pdf') {
                        $randno3 = rand(1, 100);
                        $baseName3 = str_replace(" ", "_", pathinfo($FileName3, PATHINFO_FILENAME));
                        $newFileName3 = $randno3 . "_" . $baseName3 . "." . $ext3;
                        $dest3 = '../../expense_files/' . $newFileName3;

                        if (move_uploaded_file($TempFile3, $dest3)) {
                            $Photo3 = $newFileName3;
                        }
                    } else {
                        $Photo3 = uploadImage($FileName3, $FileSize3, $TempFile3); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo3 = $_POST['OldPhoto3'][$i];
                }


                if (isset($_FILES['Photo4']['name'][$i]) && $_FILES['Photo4']['name'][$i] != ''){
                    $FileName4 = $_FILES["Photo4"]["name"][$i];
                    $FileSize4 = $_FILES["Photo4"]["size"][$i];
                    $TempFile4 = $_FILES["Photo4"]["tmp_name"][$i];
                    $ext4 = strtolower(pathinfo($FileName4, PATHINFO_EXTENSION));

                    if ($ext4 === 'pdf') {
                        $randno4 = rand(1, 100);
                        $baseName4 = str_replace(" ", "_", pathinfo($FileName4, PATHINFO_FILENAME));
                        $newFileName4 = $randno4 . "_" . $baseName4 . "." . $ext4;
                        $dest4 = '../../expense_files/' . $newFileName4;

                        if (move_uploaded_file($TempFile4, $dest4)) {
                            $Photo4 = $newFileName4;
                        }
                    } else {
                        $Photo4 = uploadImage($FileName4, $FileSize4, $TempFile4); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo4 = $_POST['OldPhoto4'][$i];
                }

                

                $sql22 = "INSERT INTO tbl_expense_request_items SET PdfLink='$PdfLink',srno='$srno',Product='$Product',ExpCatId='$ExpCatId',Narration='$Narration',Claims='$Claims',Locations='$Locations',FrId='$FrId',ExpId='$ExpId',Amount='$Amount',PaymentMode='$PaymentMode',ExpenseDate='$ExpenseDate',Gst='$Gst',
                          VedPhone='$VedPhone',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4'";
                $conn->query($sql22);
                $ExpItemId = mysqli_insert_id($conn);
                
                
                
        
        

                foreach ($_SESSION["cart_item$srno"] as $product) {
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

                    $qx = "INSERT INTO tbl_emp_expense_prod_items SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',srno='$srno',EmpId='$user_id',ExpId='$ExpId',ExpItemId='$ExpItemId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$FrId',CreatedDate='$CreatedDate',FrId='$FrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
                    $conn->query($qx);
                    //$VedInvId = mysqli_insert_id($conn);

                    $qx = "INSERT INTO tbl_cust_prod_stock_2025 SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',EmpExpItem='Yes',EmpExpId='$ExpId',ExpItemId='$ExpItemId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$FrId',CreatedDate='$CreatedDate',FrId='$FrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
                    $conn->query($qx);
                    $InvId = mysqli_insert_id($conn);
                    
                    // Step 2: Copy inserted record to backup table with orgstockid = $InvId
$backup_q = "INSERT INTO tbl_cust_prod_stock_2025_backup 
                (MainProdId, ProdId, Qty, Unit, Qty2, Unit2, ProdType, EmpExpItem, EmpExpId, ExpItemId, CreatedBy, StockDate, Narration, Status, UserId, CreatedDate, FrId, PurchasePrice, SellPrice, orgstockid) 
            VALUES 
                ('$MainProdId', '$ProdId', '$Qty2', '$Unit', '$Qty', '$Unit2', '$Prod_Type', 'Yes', '$ExpId', '$ExpItemId', '$user_id', '$StockDate', '$Narration', 'Cr', '$FrId', '$CreatedDate', '$FrId', '$PurchasePrice', '$SellPrice', '$InvId')";

$conn->query($backup_q);


                    // Fetch the inserted records
                    // $result = $conn->query("SELECT * FROM tbl_cust_prod_stock_2025 WHERE id = '$InvId'");
                    // $row = $result->fetch_assoc();

                    // Create SQL Dump
            //         $sqlDump = "INSERT INTO tbl_cust_prod_stock_2025 (ProdId, Qty, CreatedBy, StockDate, Narration, Status, UserId, CreatedDate, FrId, PurchasePrice, SellPrice) 
            // VALUES ('" . implode("','", array_values($row)) . "');\n";

            //         file_put_contents('../stock_backup/' . $FrId . '_backup.sql', $sqlDump, FILE_APPEND | LOCK_EX);


                    $sql = "UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'";
                    $conn->query($sql);
                    $url = $_SERVER['REQUEST_URI'];
                    $createddate = date('Y-m-d H:i:s');
                    // $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$FrId',url='$url',action='new customer product stock added',invid='$InvId',createddate='$createddate',roll='customer-product-stock'";
                    // $conn->query($sql);

                    unset($_SESSION["cart_item$srno"]);
                }
            }
        }
    }
    
    $sql55 = "SELECT * FROM `tbl_expense_request_items` WHERE Gst='Yes' AND ExpId='$ExpId'";
                        $rncnt55 = getRow($sql55);
                        if($rncnt55 > 0){
                        $sql55 = "UPDATE tbl_expense_request SET Gst='Yes' WHERE id='$ExpId'";
                        $conn->query($sql55);
                        }
                        else{
                            $sql55 = "UPDATE tbl_expense_request SET Gst='No' WHERE id='$ExpId'";
                        $conn->query($sql55);
                        }
                        
    echo 1;
    
        }            
                        
    } else {
        $qx = "UPDATE tbl_expense_request SET AdminStatus=0,ManagerStatus=0,SendToApproval='$SendToApproval',Narration = '$Remark',Amount='$TotAmt',ExpenseDate='$ExpenseDate',ModifedDate='$CreatedDate',ModifedBy='$user_id',Gst='$Gst',
        FrId='$FrId',ExpCatId='$ExpCatId',TotDays='$TotDays',Claims='$Claims' WHERE id='$id'";
        $conn->query($qx);
        $ExpId = $id;
        if ($Roll == 1 || $Roll == 7) {
            $sql = "DELETE FROM wallet WHERE UserId='$user_id' AND ExpId='$ExpId'";
            $conn->query($sql);
            $Narration = "Amount Deduct against Expense " . $Remark;
            $sql = "INSERT INTO wallet SET UserId='$user_id',Amount='$TotAmt',Narration='$Remark',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ExpId='$ExpId'";
            $conn->query($sql);
        }
        
        
        if (!empty($ExpId) && is_numeric($ExpId)) {
         $sql = "DELETE FROM tbl_expense_request_items WHERE ExpId='$ExpId'";
    $conn->query($sql);
    $sql = "DELETE FROM tbl_emp_expense_prod_items WHERE ExpId='$ExpId'";
    $conn->query($sql);
    $sql = "DELETE FROM tbl_cust_prod_stock_2025 WHERE EmpExpId='$ExpId' AND EmpExpItem='Yes' AND Status='Cr'";
    $conn->query($sql);
    // $sql = "DELETE FROM tbl_cust_prod_stock_2025_backup WHERE EmpExpId='$ExpId' AND EmpExpItem='Yes'";
    // $conn->query($sql);
        }

    $number = count($_POST["Amount"]);
    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            if (trim($_POST["Amount"][$i] != '')) {
                $Amount = addslashes(trim($_POST["Amount"][$i]));
                $PaymentMode = addslashes(trim($_POST["PaymentMode"][$i]));
                $ExpenseDate = addslashes(trim($_POST["ExpenseDate"][$i]));
                $Gst = addslashes(trim($_POST["Gst"][$i]));
                $VedPhone = addslashes(trim($_POST["VedPhone"][$i]));
                $Narration = addslashes(trim($_POST["Narration"][$i]));
                $ExpCatId = addslashes(trim($_POST["ExpCatId"][$i]));
                $srno = addslashes(trim($_POST["srno"][$i]));
                $Product = addslashes(trim($_POST["Product"][$i]));
                $PdfLink = addslashes(trim($_POST["PdfLink"][$i]));

                if (isset($_FILES['Photo']['name'][$i]) && $_FILES['Photo']['name'][$i] != ''){
                    $FileName1 = $_FILES["Photo"]["name"][$i];
                    $FileSize1 = $_FILES["Photo"]["size"][$i];
                    $TempFile1 = $_FILES["Photo"]["tmp_name"][$i];
                    $ext = strtolower(pathinfo($FileName1, PATHINFO_EXTENSION));

                    if ($ext === 'pdf') {
                        $randno = rand(1, 100);
                        $baseName = str_replace(" ", "_", pathinfo($FileName1, PATHINFO_FILENAME));
                        $newFileName = $randno . "_" . $baseName . "." . $ext;
                        $dest = '../../expense_files/' . $newFileName;

                        if (move_uploaded_file($TempFile1, $dest)) {
                            $Photo = $newFileName;
                        }
                    } else {
                        $Photo = uploadImage($FileName1, $FileSize1, $TempFile1); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo = $_POST['OldPhoto'][$i];
                }


               if (isset($_FILES['Photo2']['name'][$i]) && $_FILES['Photo2']['name'][$i] != ''){
                    $FileName2 = $_FILES["Photo2"]["name"][$i];
                    $FileSize2 = $_FILES["Photo2"]["size"][$i];
                    $TempFile2 = $_FILES["Photo2"]["tmp_name"][$i];
                    $ext2 = strtolower(pathinfo($FileName2, PATHINFO_EXTENSION));

                    if ($ext2 === 'pdf') {
                        $randno2 = rand(1, 100);
                        $baseName2 = str_replace(" ", "_", pathinfo($FileName2, PATHINFO_FILENAME));
                        $newFileName2 = $randno2 . "_" . $baseName2 . "." . $ext2;
                        $dest2 = '../../expense_files/' . $newFileName2;

                        if (move_uploaded_file($TempFile2, $dest2)) {
                            $Photo2 = $newFileName2;
                        }
                    } else {
                        $Photo2 = uploadImage($FileName2, $FileSize2, $TempFile2); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo2 = $_POST['OldPhoto2'][$i];
                }

                if (isset($_FILES['Photo3']['name'][$i]) && $_FILES['Photo3']['name'][$i] != ''){
                    $FileName3 = $_FILES["Photo3"]["name"][$i];
                    $FileSize3 = $_FILES["Photo3"]["size"][$i];
                    $TempFile3 = $_FILES["Photo3"]["tmp_name"][$i];
                    $ext3 = strtolower(pathinfo($FileName3, PATHINFO_EXTENSION));

                    if ($ext3 === 'pdf') {
                        $randno3 = rand(1, 100);
                        $baseName3 = str_replace(" ", "_", pathinfo($FileName3, PATHINFO_FILENAME));
                        $newFileName3 = $randno3 . "_" . $baseName3 . "." . $ext3;
                        $dest3 = '../../expense_files/' . $newFileName3;

                        if (move_uploaded_file($TempFile3, $dest3)) {
                            $Photo3 = $newFileName3;
                        }
                    } else {
                        $Photo3 = uploadImage($FileName3, $FileSize3, $TempFile3); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo3 = $_POST['OldPhoto3'][$i];
                }


                if (isset($_FILES['Photo4']['name'][$i]) && $_FILES['Photo4']['name'][$i] != ''){
                    $FileName4 = $_FILES["Photo4"]["name"][$i];
                    $FileSize4 = $_FILES["Photo4"]["size"][$i];
                    $TempFile4 = $_FILES["Photo4"]["tmp_name"][$i];
                    $ext4 = strtolower(pathinfo($FileName4, PATHINFO_EXTENSION));

                    if ($ext4 === 'pdf') {
                        $randno4 = rand(1, 100);
                        $baseName4 = str_replace(" ", "_", pathinfo($FileName4, PATHINFO_FILENAME));
                        $newFileName4 = $randno4 . "_" . $baseName4 . "." . $ext4;
                        $dest4 = '../../expense_files/' . $newFileName4;

                        if (move_uploaded_file($TempFile4, $dest4)) {
                            $Photo4 = $newFileName4;
                        }
                    } else {
                        $Photo4 = uploadImage($FileName4, $FileSize4, $TempFile4); // make sure this function handles indexed uploads
                    }
                } else {
                    $Photo4 = $_POST['OldPhoto4'][$i];
                }

                

                $sql22 = "INSERT INTO tbl_expense_request_items SET PdfLink='$PdfLink',srno='$srno',Product='$Product',ExpCatId='$ExpCatId',Narration='$Narration',Claims='$Claims',Locations='$Locations',FrId='$FrId',ExpId='$ExpId',Amount='$Amount',PaymentMode='$PaymentMode',ExpenseDate='$ExpenseDate',Gst='$Gst',
                          VedPhone='$VedPhone',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4'";
                $conn->query($sql22);
                $ExpItemId = mysqli_insert_id($conn);
                
                
                
        
        

                foreach ($_SESSION["cart_item$srno"] as $product) {
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

                    $qx = "INSERT INTO tbl_emp_expense_prod_items SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',srno='$srno',EmpId='$user_id',ExpId='$ExpId',ExpItemId='$ExpItemId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$FrId',CreatedDate='$CreatedDate',FrId='$FrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
                    $conn->query($qx);
                    //$VedInvId = mysqli_insert_id($conn);

                    $qx = "INSERT INTO tbl_cust_prod_stock_2025 SET MainProdId='$MainProdId',ProdId='$ProdId',Qty='$Qty2',Unit='$Unit',Qty2='$Qty',Unit2='$Unit2',ProdType='$Prod_Type',EmpExpItem='Yes',EmpExpId='$ExpId',ExpItemId='$ExpItemId',CreatedBy='$user_id',StockDate='$StockDate',Narration='$Narration',Status='Cr',UserId='$FrId',CreatedDate='$CreatedDate',FrId='$FrId',PurchasePrice='$PurchasePrice',SellPrice='$SellPrice'";
                    $conn->query($qx);
                    $InvId = mysqli_insert_id($conn);
                    
                     // Step 2: Copy inserted record to backup table with orgstockid = $InvId
$backup_q = "INSERT INTO tbl_cust_prod_stock_2025_backup 
                (MainProdId, ProdId, Qty, Unit, Qty2, Unit2, ProdType, EmpExpItem, EmpExpId, ExpItemId, CreatedBy, StockDate, Narration, Status, UserId, CreatedDate, FrId, PurchasePrice, SellPrice, orgstockid) 
            VALUES 
                ('$MainProdId', '$ProdId', '$Qty2', '$Unit', '$Qty', '$Unit2', '$Prod_Type', 'Yes', '$ExpId', '$ExpItemId', '$user_id', '$StockDate', '$Narration', 'Cr', '$FrId', '$CreatedDate', '$FrId', '$PurchasePrice', '$SellPrice', '$InvId')";

$conn->query($backup_q);


                    // Fetch the inserted records
                    // $result = $conn->query("SELECT * FROM tbl_cust_prod_stock_2025 WHERE id = '$InvId'");
                    // $row = $result->fetch_assoc();

                    // Create SQL Dump
            //         $sqlDump = "INSERT INTO tbl_cust_prod_stock_2025 (ProdId, Qty, CreatedBy, StockDate, Narration, Status, UserId, CreatedDate, FrId, PurchasePrice, SellPrice) 
            // VALUES ('" . implode("','", array_values($row)) . "');\n";

            //         file_put_contents('../stock_backup/' . $FrId . '_backup.sql', $sqlDump, FILE_APPEND | LOCK_EX);


                    $sql = "UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'";
                    $conn->query($sql);
                    $url = $_SERVER['REQUEST_URI'];
                    $createddate = date('Y-m-d H:i:s');
                    // $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$FrId',url='$url',action='new customer product stock added',invid='$InvId',createddate='$createddate',roll='customer-product-stock'";
                    // $conn->query($sql);

                    unset($_SESSION["cart_item$srno"]);
                }
            }
        }
    }
    
    $sql55 = "SELECT * FROM `tbl_expense_request_items` WHERE Gst='Yes' AND ExpId='$ExpId'";
                        $rncnt55 = getRow($sql55);
                        if($rncnt55 > 0){
                        $sql55 = "UPDATE tbl_expense_request SET Gst='Yes' WHERE id='$ExpId'";
                        $conn->query($sql55);
                        }
                        else{
                            $sql55 = "UPDATE tbl_expense_request SET Gst='No' WHERE id='$ExpId'";
                        $conn->query($sql55);
                        }
                        
    echo 1;
    }

   
}


if ($_POST['action'] == 'getExpenseRow') {
    $i = $_POST['id']; ?>
    <div class="form-row expense-block" style="padding-left: 20px;border: 1px solid;padding-top: 10px;margin-top: 10px;" id="row<?php echo $i; ?>">
        <input type="hidden" name="srno[]" id="srno<?php echo $i; ?>" class="srno" value="<?php echo $i; ?>">

        <div class="form-group float-label active">
            <select class="form-control" name="ExpCatId[]" id="ExpCatId<?php echo $i; ?>" onchange="checkExpCatId(this.value,<?php echo $i;?>)">
                <option selected="" value="" disabled>Select Expense Category</option>


                <?php
                $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                $row33 = getList($sql33);
                foreach ($row33 as $result) {
                ?>
                    <option value="<?php echo $result['id']; ?>" <?php if ($row7["ExpCatId"] == $result['id']) { ?> selected <?php } ?>>
                        <?php echo $result['Name']; ?></option>
                <?php } ?>
            </select>
            <label class="form-control-label">Expense Category</label>
        </div>

        <div class="form-group float-label active col-6">
            <input type="text" class="form-control txt" name="Amount[]" id="Amount<?php echo $i; ?>" value="<?php echo $row7['Amount']; ?>" autofocus required oninput="calTotAmt()">
            <label class="form-control-label">Amount</label>
        </div>

        <div class="form-group float-label active col-6">
            <input type="date" class="form-control" name="ExpenseDate[]" id="ExpenseDate<?php echo $i; ?>" value="<?php echo $row7['ExpenseDate']; ?>" required>
            <label class="form-control-label">Expense Date</label>
        </div>


        <div class="form-group float-label active col-6">
            <select class="form-control" name="PaymentMode[]" id="PaymentMode<?php echo $i; ?>" required>
                <option selected="" value="" disabled>Select Payment Type</option>
                <option value="Cash" <?php if ($row7["PaymentMode"] == 'Cash') { ?> selected <?php } ?>>
                    By Cash</option>
                <option value="Online" <?php if ($row7["PaymentMode"] == 'Online') { ?> selected <?php } ?>>
                    By Online</option>
            </select>
            <label class="form-control-label">Payment Type</label>
        </div>

        <div class="form-group float-label active col-6">
            <input type="number" class="form-control" name="VedPhone[]" id="VedPhone<?php echo $i; ?>" value="<?php echo $row7['VedPhone']; ?>" required>
            <label class="form-control-label">Vendor Mobile No</label>
        </div>


        <div class="form-group float-label active col-12">
            <input type="text" class="form-control" id="Narration<?php echo $i; ?>" name="Narration[]" value="<?php echo $row7['Narration']; ?>" required>
            <label class="form-control-label">Narration</label>
        </div>

        <div class="form-group col-12 file-upload-block">
            <label class="upload-label">Upload Receipt</label>
            <label for="Photo<?php echo $i; ?>" class="custom-file-upload" id="PhotoPreviewBox<?php echo $i; ?>">
                <div class="upload-box-content">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Click or Drag file here to upload (.png)</span>
                </div>
            </label>
            <input type="file" id="Photo<?php echo $i; ?>" name="Photo[]" accept=".png">
            
        </div>


        <!-- Upload Payment Receipt -->
        <div class="form-group col-12 file-upload-block">
            <label class="upload-label">Upload Payment Receipt</label>
            <label for="Photo2<?php echo $i; ?>" class="custom-file-upload" id="Photo2PreviewBox<?php echo $i; ?>">
                <div class="upload-box-content">
                    <i class="fas fa-file-image"></i>
                    <span>Click to upload (.png)</span>
                </div>
            </label>
            <input type="file" id="Photo2<?php echo $i; ?>" name="Photo2[]" accept=".png">
          
        </div>

        <!-- Upload PDF -->
        <div class="form-group col-12 file-upload-block">
            <label class="upload-label">Upload PDF</label>
            <label for="Photo3<?php echo $i; ?>" class="custom-file-upload" id="Photo3PreviewBox<?php echo $i; ?>">
                <div class="upload-box-content">
                    <i class="fas fa-file-pdf"></i>
                    <span>Click to upload (.pdf)</span>
                </div>
            </label>
            <input type="file" id="Photo3<?php echo $i; ?>" name="Photo3[]" accept=".pdf">
           
        </div>


        <!-- Upload Product Image -->
        <div class="form-group col-12 file-upload-block">
            <label class="upload-label">Upload Product Image</label>
            <label for="Photo4<?php echo $i; ?>" class="custom-file-upload" id="Photo4PreviewBox<?php echo $i; ?>">
                <div class="upload-box-content">
                    <i class="fas fa-box-open"></i>
                    <span>Click to upload (.png)</span>
                </div>
            </label>
            <input type="file" id="Photo4<?php echo $i; ?>" name="Photo4[]" accept=".png">
            
        </div>

<!--<div class="form-group float-label active col-12">
                                    <input type="file" class="form-control" id="Photo5<?php echo $i;?>" name="Photo5_<?php echo $i; ?>[]" accept=".png" multiple>
                                    <label class="form-control-label">Upload Multiple Receipt</label>
                                </div>-->
                               
<div class="form-group float-label active col-12">
                                    <input type="file" class="form-control" id="Photo5<?php echo $i;?>" accept=".png" multiple  onchange="convertToPDF(<?php echo $i;?>)">
                                    <label class="form-control-label">Upload Multiple Photo For Making PDF</label>
                                    </div>
                                     <input type="hidden" class="form-control" name="PdfLink[]" id="PdfLink<?php echo $i;?>" value="" autofocus readonly>
                                  
                                   <!-- <div style="padding-top:5px;">
                                    <button type="button" class="btn btn-info btn-sm" onclick="convertToPDF(<?php echo $i;?>)" id="makepdf<?php echo $i; ?>">Make Pdf Link</button>
                                    </div>-->
                                
                                
 

<!-- <div class="form-group float-label active col-12">
                                    <input type="text" class="form-control" name="PdfLink[]" id="PdfLink<?php echo $i;?>" value="" autofocus readonly>
                                    <label class="form-control-label">PDF LInk</label>
                                </div>-->
                                

        <div class="form-group float-label active col-12">
            <select class="form-control" name="Gst[]" id="Gst<?php echo $i; ?>" required>
                <!--<option selected="" value="" disabled>GST</option>-->
                <option value="No" >
                    No</option>
                <option value="Yes" >
                    Yes</option>

            </select>
            <label class="form-control-label">GST</label>
        </div>

        <div class="form-group float-label active col-10">
            <select class="form-control product-select" name="Product[]" id="Product<?php echo $i; ?>" required onchange="showAddButton(<?php echo $i; ?>,this.value)">
                <!--<option selected="" value="" disabled>GST</option>-->
                <option value="Yes" >
                    Yes</option>
                <option value="No" >
                    No</option>
                

            </select>
            <label class="form-control-label" style="font-size: 10px;font-weight: 500;">Did You Purchase Inventory Product?</label>
        </div>


        <div class="form-group float-label active col-2 showbutton" id="showbutton<?php echo $i; ?>" style="display:block;">
            <button type="button" class="btn btn-info openmodal" onclick="openModal(<?php echo $i; ?>)">+</button>
        </div>

        <div class="col-lg-12 showcart" id="showcart2<?php echo $i; ?>">


        </div>
<input type="hidden" id="TotalAmt<?php echo $i;?>" class="form-control">
        <div class="btn-group-container" style="display: flex; gap: 10px; justify-content: flex-start; padding: 10px 20px;">
            <button type="button" class="btn btn-success" onclick="addExpenseRow()">+ Add</button>
            <button type="button" class="btn btn-danger remove-btn" onclick="this.closest('.expense-block').remove();">&times; Remove</button>
        </div>


    </div>
<?php
}

?>