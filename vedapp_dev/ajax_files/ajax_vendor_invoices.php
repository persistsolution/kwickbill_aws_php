<?php  
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
$sql110 = "SELECT Roll FROM tbl_users WHERE id='$user_id'";
$row110 = getRecord($sql110);
$Roll = $row110['Roll'];
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
    
    $Narration = addslashes(trim($_POST["Narration"]));
$Amount = addslashes(trim($_POST["Amount"]));
$PaymentMode = addslashes(trim($_POST["PaymentMode"]));
$ExpenseDate = addslashes(trim($_POST["ExpenseDate"]));
$Gst = addslashes(trim($_POST["Gst"]));
$VedPhone = addslashes(trim($_POST["VedPhone"]));
$TempPrdId = $_POST['TempPrdId'];
$TempPrdId2 = $_POST['TempPrdId2'];
$FrId = addslashes(trim($_POST["FrId"]));
$ExpCatId = addslashes(trim($_POST["ExpCatId"]));
$Locations = addslashes(trim($_POST["Locations"]));
$Claims = addslashes(trim($_POST["Claims"]));
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');
$CreatedTime = date('h:i a');

$FileName1 = $_FILES["Photo"]["name"];
$FileSize1 = $_FILES["Photo"]["size"];
$TempFile1 = $_FILES["Photo"]["tmp_name"];
$Photo = uploadImage($FileName1,$FileSize1,$TempFile1);

$FileName2 = $_FILES["Photo2"]["name"];
$FileSize2 = $_FILES["Photo2"]["size"];
$TempFile2 = $_FILES["Photo2"]["tmp_name"];
$Photo2 = uploadImage($FileName2,$FileSize2,$TempFile2);

$FileName3 = $_FILES["Photo3"]["name"];
$FileSize3 = $_FILES["Photo3"]["size"];
$TempFile3 = $_FILES["Photo3"]["tmp_name"];
$Photo3 = uploadImage($FileName3,$FileSize3,$TempFile3);

$FileName4 = $_FILES["Photo4"]["name"];
$FileSize4 = $_FILES["Photo4"]["size"];
$TempFile4 = $_FILES["Photo4"]["tmp_name"];
$Photo4 = uploadImage($FileName4,$FileSize4,$TempFile4);


$date1=date_create($ExpenseDate);
$date2=date_create($CreatedDate);
$diff=date_diff($date1,$date2);
if($ExpenseDate<$CreatedDate){
$TotDays = $diff->format("%a");
}
else{
    $TotDays = 0;
}

$sql = "SELECT * FROM tbl_vendor_expense_invoices WHERE UserId = '$user_id' AND Amount='$Amount' AND ExpenseDate='$ExpenseDate'";
$rncnt = getRow($sql);
if($rncnt > 0){
    echo 0;
}
else{
    if($Roll == 1 || $Roll == 7){
        $qx = "INSERT INTO tbl_vendor_expense_invoices SET UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',TotDays='$TotDays',Locations='$Locations',AdminStatus=1,AccBy='$user_id',AdminApproveDate='$CreatedDate',Claims='$Claims'";
  $conn->query($qx); 
  $ExpId = mysqli_insert_id($conn);
  
  $sql = "DELETE FROM wallet WHERE UserId='$user_id' AND ExpId='$ExpId'";
  $conn->query($sql);
  $Narration = "Amount Deduct against Expense ".$Narration;
  $sql = "INSERT INTO wallet SET UserId='$user_id',Amount='$Amount',Narration='$Narration',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ExpId='$ExpId'";
  $conn->query($sql);
    } 
    else{
$qx = "INSERT INTO tbl_vendor_expense_invoices SET UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',TotDays='$TotDays',Locations='$Locations',Claims='$Claims'";
  $conn->query($qx); 
    }
  echo 1;
}
}

if($_POST['action'] == 'updateExpenses'){
    $id = $_POST['id']; 
    $Narration = addslashes(trim($_POST["Narration"]));
$Amount = addslashes(trim($_POST["Amount"]));
$PaymentMode = addslashes(trim($_POST["PaymentMode"]));
$ExpenseDate = addslashes(trim($_POST["ExpenseDate"]));
$Gst = addslashes(trim($_POST["Gst"]));
$VedPhone = addslashes(trim($_POST["VedPhone"]));
$TempPrdId = $_POST['TempPrdId'];
$TempPrdId2 = $_POST['TempPrdId2'];
$FrId = addslashes(trim($_POST["FrId"]));
$ExpCatId = addslashes(trim($_POST["ExpCatId"]));
$Locations = addslashes(trim($_POST["Locations"]));
$Claims = addslashes(trim($_POST["Claims"]));
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

if (isset($_FILES['Photo'])) {
$FileName1 = $_FILES["Photo"]["name"];
$FileSize1 = $_FILES["Photo"]["size"];
$TempFile1 = $_FILES["Photo"]["tmp_name"];
$Photo = uploadImage($FileName1,$FileSize1,$TempFile1);
}
else{
   $Photo = $_POST['OldPhoto']; 
}

if (isset($_FILES['Photo2'])) {
$FileName2 = $_FILES["Photo2"]["name"];
$FileSize2 = $_FILES["Photo2"]["size"];
$TempFile2 = $_FILES["Photo2"]["tmp_name"];
$Photo2 = uploadImage($FileName2,$FileSize2,$TempFile2);
}
else{
   $Photo2 = $_POST['OldPhoto2']; 
}

if (isset($_FILES['Photo3'])) {
$FileName3 = $_FILES["Photo3"]["name"];
$FileSize3 = $_FILES["Photo3"]["size"];
$TempFile3 = $_FILES["Photo3"]["tmp_name"];
$Photo3 = uploadImage($FileName3,$FileSize3,$TempFile3);
}
else{
   $Photo3 = $_POST['OldPhoto3']; 
}

if (isset($_FILES['Photo4'])) {
$FileName4 = $_FILES["Photo4"]["name"];
$FileSize4 = $_FILES["Photo4"]["size"];
$TempFile4 = $_FILES["Photo4"]["tmp_name"];
$Photo4 = uploadImage($FileName4,$FileSize4,$TempFile4);
}
else{
   $Photo4 = $_POST['OldPhoto4']; 
}

$date1=date_create($ExpenseDate);
$date2=date_create($CreatedDate);
$diff=date_diff($date1,$date2);
if($ExpenseDate<$CreatedDate){
$TotDays = $diff->format("%a");
}
else{
    $TotDays = 0;
}

 $qx = "UPDATE tbl_vendor_expense_invoices SET UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',Photo3='$Photo3',Photo4='$Photo4',ExpCatId='$ExpCatId',ManagerStatus=0,AdminStatus=0,TotDays='$TotDays',Locations='$Locations',Claims='$Claims' WHERE id='$id'";

  $conn->query($qx); 
  
  echo 1;
    
}
?>