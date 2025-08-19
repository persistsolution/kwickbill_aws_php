<?php
session_start();
include_once '../config.php';
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
        $path = '../../uploads/' . $new_name;
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

    $Remark = addslashes(trim($_POST["Remark"]));
    $ExpenseDate = addslashes(trim($_POST["ExpDate"]));
    $TempPrdId = $_POST['TempPrdId'];
    $TempPrdId2 = $_POST['TempPrdId2'];
    $FrId = addslashes(trim($_POST["FrId"]));
    $ExpCatId = addslashes(trim($_POST["ExpCatId"]));
    $Locations = addslashes(trim($_POST["Locations"]));
    $Claims = addslashes(trim($_POST["Claims"]));
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

    if ($Roll == 1 || $Roll == 7) {
        $qx = "INSERT INTO tbl_expense_request SET mult='1',UserId = '$user_id',Status='0',Narration = '$Remark',Amount='$TotAmt',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',TotDays='$TotDays',Locations='$Locations',AdminStatus=1,AccBy='$user_id',AdminApproveDate='$CreatedDate',Claims='$Claims'";
        $conn->query($qx);
        $ExpId = mysqli_insert_id($conn);

        $sql = "DELETE FROM wallet WHERE UserId='$user_id' AND ExpId='$ExpId'";
        $conn->query($sql);
        $Narration = "Amount Deduct against Expense " . $Remark;
        $sql = "INSERT INTO wallet SET UserId='$user_id',Amount='$TotAmt',Narration='$Remark',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ExpId='$ExpId'";
        $conn->query($sql);
    } else {
        $qx = "INSERT INTO tbl_expense_request SET mult='1',UserId = '$user_id',Status='0',Narration = '$Remark',Amount='$TotAmt',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',TotDays='$TotDays',Locations='$Locations',Claims='$Claims'";
        $conn->query($qx);
        $ExpId = mysqli_insert_id($conn);
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

                $FileName1 = $_FILES["Photo"]["name"][$i];
                $FileSize1 = $_FILES["Photo"]["size"][$i];
                $TempFile1 = $_FILES["Photo"]["tmp_name"][$i];
                $ext = strtolower(pathinfo($FileName1, PATHINFO_EXTENSION));

                if ($ext === 'pdf') {
                    $randno = rand(1, 100);
                    $baseName = str_replace(" ", "_", pathinfo($FileName1, PATHINFO_FILENAME));
                    $newFileName = $randno . "_" . $baseName . "." . $ext;
                    $dest = '../../uploads/' . $newFileName;

                    if (move_uploaded_file($TempFile1, $dest)) {
                        $Photo = $newFileName;
                    }
                } else {
                    $Photo = uploadImage($FileName1, $FileSize1, $TempFile1); // make sure this function handles indexed uploads
                }


                $FileName2 = $_FILES["Photo2"]["name"][$i];
                $FileSize2 = $_FILES["Photo2"]["size"][$i];
                $TempFile2 = $_FILES["Photo2"]["tmp_name"][$i];
                $ext2 = strtolower(pathinfo($FileName2, PATHINFO_EXTENSION));

                if ($ext2 === 'pdf') {
                    $randno2 = rand(1, 100);
                    $baseName2 = str_replace(" ", "_", pathinfo($FileName2, PATHINFO_FILENAME));
                    $newFileName2 = $randno2 . "_" . $baseName2 . "." . $ext2;
                    $dest2 = '../../uploads/' . $newFileName2;

                    if (move_uploaded_file($TempFile2, $dest2)) {
                        $Photo2 = $newFileName2;
                    }
                } else {
                    $Photo2 = uploadImage($FileName2, $FileSize2, $TempFile2); // make sure this function handles indexed uploads
                }

                $FileName3 = $_FILES["Photo3"]["name"][$i];
                $FileSize3 = $_FILES["Photo3"]["size"][$i];
                $TempFile3 = $_FILES["Photo3"]["tmp_name"][$i];
                $ext3 = strtolower(pathinfo($FileName3, PATHINFO_EXTENSION));

                if ($ext3 === 'pdf') {
                    $randno3 = rand(1, 100);
                    $baseName3 = str_replace(" ", "_", pathinfo($FileName3, PATHINFO_FILENAME));
                    $newFileName3 = $randno3 . "_" . $baseName3 . "." . $ext3;
                    $dest3 = '../../uploads/' . $newFileName3;

                    if (move_uploaded_file($TempFile3, $dest3)) {
                        $Photo3 = $newFileName3;
                    }
                } else {
                    $Photo3 = uploadImage($FileName3, $FileSize3, $TempFile3); // make sure this function handles indexed uploads
                }

                $FileName4 = $_FILES["Photo4"]["name"][$i];
                $FileSize4 = $_FILES["Photo4"]["size"][$i];
                $TempFile4 = $_FILES["Photo4"]["tmp_name"][$i];
                $ext4 = strtolower(pathinfo($FileName4, PATHINFO_EXTENSION));

                if ($ext4 === 'pdf') {
                    $randno4 = rand(1, 100);
                    $baseName4 = str_replace(" ", "_", pathinfo($FileName4, PATHINFO_FILENAME));
                    $newFileName4 = $randno4 . "_" . $baseName4 . "." . $ext4;
                    $dest4 = '../../uploads/' . $newFileName4;

                    if (move_uploaded_file($TempFile4, $dest4)) {
                        $Photo4 = $newFileName4;
                    }
                } else {
                    $Photo4 = uploadImage($FileName4, $FileSize4, $TempFile4); // make sure this function handles indexed uploads
                }



                $sql22 = "INSERT INTO tbl_expense_request_items SET Narration='$Narration',ExpCatId='$ExpCatId',Claims='$Claims',Locations='$Locations',FrId='$FrId',ExpId='$ExpId',Amount='$Amount',PaymentMode='$PaymentMode',ExpenseDate='$ExpenseDate',Gst='$Gst',
                          VedPhone='$VedPhone',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4'";
                $conn->query($sql22);
            }
        }
    }
    echo 1;
}



if ($_POST['action'] == 'updateExpenses') {
$id = $_POST['id'];
    $Remark = addslashes(trim($_POST["Remark"]));
    $ExpenseDate = addslashes(trim($_POST["ExpDate"]));
    $TempPrdId = $_POST['TempPrdId'];
    $TempPrdId2 = $_POST['TempPrdId2'];
    $FrId = addslashes(trim($_POST["FrId"]));
    $ExpCatId = addslashes(trim($_POST["ExpCatId"]));
    $Locations = addslashes(trim($_POST["Locations"]));
    $Claims = addslashes(trim($_POST["Claims"]));
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

   
        $qx = "UPDATE tbl_expense_request SET Narration = '$Remark',Amount='$TotAmt',ExpenseDate='$ExpenseDate',ModifedDate='$CreatedDate',ModifedBy='$user_id',Gst='$Gst',
        FrId='$FrId',ExpCatId='$ExpCatId',TotDays='$TotDays',Claims='$Claims' WHERE id='$id'";
        $conn->query($qx);
        $ExpId = $id;
    
$sql = "DELETE FROM tbl_expense_request_items WHERE ExpId='$id'";
$conn->query($sql);
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

                if (isset($_FILES['Photo'][$i])) {
                $FileName1 = $_FILES["Photo"]["name"][$i];
                $FileSize1 = $_FILES["Photo"]["size"][$i];
                $TempFile1 = $_FILES["Photo"]["tmp_name"][$i];
                $ext = strtolower(pathinfo($FileName1, PATHINFO_EXTENSION));
                if ($ext === 'pdf') {
                    $randno = rand(1, 100);
                    $baseName = str_replace(" ", "_", pathinfo($FileName1, PATHINFO_FILENAME));
                    $newFileName = $randno . "_" . $baseName . "." . $ext;
                    $dest = '../../uploads/' . $newFileName;

                    if (move_uploaded_file($TempFile1, $dest)) {
                        $Photo = $newFileName;
                    }
                } else {
                    $Photo = uploadImage($FileName1, $FileSize1, $TempFile1); // make sure this function handles indexed uploads
                }
                }
                else{
   $Photo = $_POST['OldPhoto'][$i]; 
}


if (isset($_FILES['Photo2'][$i])) {
                $FileName2 = $_FILES["Photo2"]["name"][$i];
                $FileSize2 = $_FILES["Photo2"]["size"][$i];
                $TempFile2 = $_FILES["Photo2"]["tmp_name"][$i];
                $ext2 = strtolower(pathinfo($FileName2, PATHINFO_EXTENSION));

                if ($ext2 === 'pdf') {
                    $randno2 = rand(1, 100);
                    $baseName2 = str_replace(" ", "_", pathinfo($FileName2, PATHINFO_FILENAME));
                    $newFileName2 = $randno2 . "_" . $baseName2 . "." . $ext2;
                    $dest2 = '../../uploads/' . $newFileName2;

                    if (move_uploaded_file($TempFile2, $dest2)) {
                        $Photo2 = $newFileName2;
                    }
                } else {
                    $Photo2 = uploadImage($FileName2, $FileSize2, $TempFile2); // make sure this function handles indexed uploads
                }
            }
                else{
   $Photo2 = $_POST['OldPhoto2'][$i]; 
}

if (isset($_FILES['Photo3'][$i])) {
                $FileName3 = $_FILES["Photo3"]["name"][$i];
                $FileSize3 = $_FILES["Photo3"]["size"][$i];
                $TempFile3 = $_FILES["Photo3"]["tmp_name"][$i];
                $ext3 = strtolower(pathinfo($FileName3, PATHINFO_EXTENSION));

                if ($ext3 === 'pdf') {
                    $randno3 = rand(1, 100);
                    $baseName3 = str_replace(" ", "_", pathinfo($FileName3, PATHINFO_FILENAME));
                    $newFileName3 = $randno3 . "_" . $baseName3 . "." . $ext3;
                    $dest3 = '../../uploads/' . $newFileName3;

                    if (move_uploaded_file($TempFile3, $dest3)) {
                        $Photo3 = $newFileName3;
                    }
                } else {
                    $Photo3 = uploadImage($FileName3, $FileSize3, $TempFile3); // make sure this function handles indexed uploads
                }
        }
                else{
   $Photo3 = $_POST['OldPhoto3'][$i]; 
}

if (isset($_FILES['Photo4'][$i])) {
                $FileName4 = $_FILES["Photo4"]["name"][$i];
                $FileSize4 = $_FILES["Photo4"]["size"][$i];
                $TempFile4 = $_FILES["Photo4"]["tmp_name"][$i];
                $ext4 = strtolower(pathinfo($FileName4, PATHINFO_EXTENSION));

                if ($ext4 === 'pdf') {
                    $randno4 = rand(1, 100);
                    $baseName4 = str_replace(" ", "_", pathinfo($FileName4, PATHINFO_FILENAME));
                    $newFileName4 = $randno4 . "_" . $baseName4 . "." . $ext4;
                    $dest4 = '../../uploads/' . $newFileName4;

                    if (move_uploaded_file($TempFile4, $dest4)) {
                        $Photo4 = $newFileName4;
                    }
                } else {
                    $Photo4 = uploadImage($FileName4, $FileSize4, $TempFile4); // make sure this function handles indexed uploads
                }
    }
                else{
   $Photo4 = $_POST['OldPhoto4'][$i]; 
}



                $sql22 = "INSERT INTO tbl_expense_request_items SET Narration='$Narration',ExpCatId='$ExpCatId',Claims='$Claims',Locations='$Locations',FrId='$FrId',ExpId='$ExpId',Amount='$Amount',PaymentMode='$PaymentMode',ExpenseDate='$ExpenseDate',Gst='$Gst',
                          VedPhone='$VedPhone',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4'";
                $conn->query($sql22);
            }
        }
    }
    echo 1;
}
?>