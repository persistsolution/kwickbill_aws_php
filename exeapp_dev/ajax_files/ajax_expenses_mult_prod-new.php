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


function uploadFile($file, $index, $fieldName) {
    $fileName = $file["name"][$index];
    $fileSize = $file["size"][$index];
    $tempFile = $file["tmp_name"][$index];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($ext === 'pdf') {
        $baseName = str_replace(" ", "_", pathinfo($fileName, PATHINFO_FILENAME));
        $newName = rand(1, 100) . "_" . $baseName . "." . $ext;
        $dest = "../../expense_files/" . $newName;
        return move_uploaded_file($tempFile, $dest) ? $newName : '';
    } else {
        return uploadImage($fileName, $fileSize, $tempFile);
    }
}

function getPost($key, $default = '') {
    return isset($_POST[$key]) ? addslashes(trim($_POST[$key])) : $default;
}

function handlePhotos($i) {
    $photoFields = ['Photo', 'Photo2', 'Photo3', 'Photo4'];
    $uploaded = [];

    foreach ($photoFields as $field) {
        if (!empty($_FILES[$field]['name'][$i])) {
            $uploaded[$field] = uploadFile($_FILES[$field], $i, $field);
        } else {
            $uploaded[$field] = $_POST["Old$field"][$i] ?? '';
        }
    }

    return $uploaded;
}

if ($_POST['action'] == 'saveExpenses') {
    $id = getPost('id');
    $FrId = getPost("FrId");
    $ExpenseDate = getPost("ExpDate");
    $Remark = getPost("Remark");
    $Claims = getPost("Claims");
    $Locations = getPost("Locations");
    $SendToApproval = getPost("SendToApproval");
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $TotAmt = $_POST['TotAmt'];
    $TotDays = (strtotime($CreatedDate) - strtotime($ExpenseDate)) / (60 * 60 * 24);
    $TotDays = max(0, $TotDays);

    if (empty($id)) {
        // Check for duplicate
        $checkSql = "SELECT 1 FROM tbl_expense_request WHERE Amount='$TotAmt' AND ExpenseDate='$ExpenseDate' AND UserId='$user_id' AND FrId='$FrId'";
        if (getRow($checkSql) > 0) {
            echo 0;
            exit;
        }

        // Insert header
        $fields = "SendToApproval='$SendToApproval', mult='2', UserId='$user_id', Status='0', Narration='$Remark', Amount='$TotAmt', PaymentMode='$PaymentMode', ExpenseDate='$ExpenseDate', CreatedDate='$CreatedDate', CreatedBy='$user_id', Gst='$Gst', TempPrdId='$TempPrdId', TempPrdId2='$TempPrdId2', VedPhone='$VedPhone', FrId='$FrId', Photo='$Photo', Photo2='$Photo2', Photo3='$Photo3', Photo4='$Photo4', ExpCatId='$ExpCatId', TotDays='$TotDays', Locations='$Locations', Claims='$Claims'";
        if ($Roll == 1 || $Roll == 7) {
            $fields .= ", AdminStatus=1, AccBy='$user_id', AdminApproveDate='$CreatedDate'";
        } else {
            $fields .= ", AdminStatus=0, ManagerStatus=0";
        }
        $conn->query("INSERT INTO tbl_expense_request SET $fields");
        $ExpId = mysqli_insert_id($conn);

        if ($Roll == 1 || $Roll == 7) {
            $conn->query("DELETE FROM wallet WHERE UserId='$user_id' AND ExpId='$ExpId'");
            $conn->query("INSERT INTO wallet SET UserId='$user_id', Amount='$TotAmt', Narration='Amount Deduct against Expense $Remark', Status='Dr', CreatedDate='$CreatedDate', CreatedTime='$CreatedTime', ExpId='$ExpId'");
        }
    } else {
        // Update header
        $conn->query("UPDATE tbl_expense_request SET AdminStatus=0, ManagerStatus=0, SendToApproval='$SendToApproval', Narration='$Remark', Amount='$TotAmt', ExpenseDate='$ExpenseDate', ModifedDate='$CreatedDate', ModifedBy='$user_id', Gst='$Gst', FrId='$FrId', ExpCatId='$ExpCatId', TotDays='$TotDays', Claims='$Claims' WHERE id='$id'");
        $ExpId = $id;

        // Clear existing items
        $conn->query("DELETE FROM tbl_expense_request_items WHERE ExpId='$ExpId'");
        $conn->query("DELETE FROM tbl_emp_expense_prod_items WHERE ExpId='$ExpId'");
        $conn->query("DELETE FROM tbl_cust_prod_stock_2025 WHERE EmpExpId='$ExpId'");
    }

    // Insert items
    $count = count($_POST["Amount"]);
    for ($i = 0; $i < $count; $i++) {
        if (!empty(trim($_POST["Amount"][$i]))) {
            $Amount = getPost("Amount")[$i];
            $PaymentMode = getPost("PaymentMode")[$i];
            $ExpenseDate = getPost("ExpenseDate")[$i];
            $Gst = getPost("Gst")[$i];
            $VedPhone = getPost("VedPhone")[$i];
            $Narration = getPost("Narration")[$i];
            $ExpCatId = getPost("ExpCatId")[$i];
            $srno = getPost("srno")[$i];
            $Product = getPost("Product")[$i];
            $PdfLink = getPost("PdfLink")[$i];

            $photos = handlePhotos($i);

            $conn->query("INSERT INTO tbl_expense_request_items SET PdfLink='$PdfLink', srno='$srno', Product='$Product', ExpCatId='$ExpCatId', Narration='$Narration', Claims='$Claims', Locations='$Locations', FrId='$FrId', ExpId='$ExpId', Amount='$Amount', PaymentMode='$PaymentMode', ExpenseDate='$ExpenseDate', Gst='$Gst', VedPhone='$VedPhone', Photo='{$photos['Photo']}', Photo2='{$photos['Photo2']}', Photo3='{$photos['Photo3']}', Photo4='{$photos['Photo4']}'");
            $ExpItemId = mysqli_insert_id($conn);

            // Iterate session cart items
            foreach ($_SESSION["cart_item$srno"] as $product) {
                $MainProdId = $product['id'];
                $Prod_Type = $product['ProdType'];
                $Unit2 = $product['Unit'];
                $Qty = addslashes($product['Qty']);
                $unitRow = getRecord("SELECT * FROM tbl_units WHERE Name2='$Unit2'");
                $Unit = $unitRow['Name'];

                if ($Prod_Type == 0) {
                    $prodRow = getRecord("SELECT id FROM tbl_cust_products_2025 WHERE ProdId='$MainProdId' AND CreatedBy='$FrId'");
                    $ProdId = $prodRow['id'];
                    $Qty2 = $Qty;
                } else {
                    $ProdId = $product['id'];
                    $Qty2 = ($Unit2 == 'Pieces') ? $Qty : $Qty * 1000;
                }

                $PurchasePrice = addslashes($product['PurchasePrice']);
                $SellPrice = addslashes($product['SellPrice']);

                $insertFields = "MainProdId='$MainProdId', ProdId='$ProdId', Qty='$Qty2', Unit='$Unit', Qty2='$Qty', Unit2='$Unit2', ProdType='$Prod_Type', srno='$srno', EmpId='$user_id', ExpId='$ExpId', ExpItemId='$ExpItemId', CreatedBy='$user_id', StockDate='$CreatedDate', Narration='$Narration', Status='Cr', UserId='$FrId', CreatedDate='$CreatedDate', FrId='$FrId', PurchasePrice='$PurchasePrice', SellPrice='$SellPrice'";
                $conn->query("INSERT INTO tbl_emp_expense_prod_items SET $insertFields");
                $conn->query("INSERT INTO tbl_cust_prod_stock_2025 SET EmpExpItem='Yes', EmpExpId='$ExpId', ExpItemId='$ExpItemId', $insertFields");
                $InvId = mysqli_insert_id($conn);

                $conn->query("INSERT INTO tbl_cust_prod_stock_2025_backup SET orgstockid='$InvId', $insertFields, EmpExpItem='Yes', EmpExpId='$ExpId', ExpItemId='$ExpItemId'");

                $conn->query("UPDATE tbl_cust_products_2025 SET PurchasePrice='$PurchasePrice' WHERE id='$ProdId'");
                unset($_SESSION["cart_item$srno"]);
            }
        }
    }

    // Final GST flag
    $gstItems = getRow("SELECT * FROM tbl_expense_request_items WHERE Gst='Yes' AND ExpId='$ExpId'");
    $conn->query("UPDATE tbl_expense_request SET Gst='" . ($gstItems > 0 ? "Yes" : "No") . "' WHERE id='$ExpId'");

    echo 1;
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