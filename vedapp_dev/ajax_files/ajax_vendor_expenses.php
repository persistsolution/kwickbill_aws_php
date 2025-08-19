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
    $VedId = addslashes(trim($_POST["VedId"]));
    $Narration = addslashes(trim($_POST["Narration"]));
$Amount = addslashes(trim($_POST["Amount"]));
$PaymentMode = addslashes(trim($_POST["PaymentMode"]));
$ExpenseDate = addslashes(trim($_POST["ExpenseDate"]));
$Gst = addslashes(trim($_POST["Gst"]));
$VedPhone = addslashes(trim($_POST["VedPhone"]));
$TempPrdId = $_POST['TempPrdId'];
$TempPrdId2 = $_POST['TempPrdId2'];
$FrId = addslashes(trim($_POST["FrId"]));
$InvoiceNo = addslashes(trim($_POST["InvoiceNo"]));

$TradeName = addslashes(trim($_POST["TradeName"]));
$TypeOfVendor = addslashes(trim($_POST["TypeOfVendor"]));
$PoNo = addslashes(trim($_POST["PoNo"]));
$Locations = addslashes(trim($_POST["Locations"]));
$AdvAmount = addslashes(trim($_POST["AdvAmount"]));
$InvType = addslashes(trim($_POST["InvType"]));

$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

$FileName1 = $_FILES["Photo"]["name"];
$FileSize1 = $_FILES["Photo"]["size"];
$TempFile1 = $_FILES["Photo"]["tmp_name"];
$Photo = uploadImage($FileName1,$FileSize1,$TempFile1);

$FileName2 = $_FILES["Photo2"]["name"];
$FileSize2 = $_FILES["Photo2"]["size"];
$TempFile2 = $_FILES["Photo2"]["tmp_name"];
$Photo2 = uploadImage($FileName2,$FileSize2,$TempFile2);


$qx = "INSERT INTO tbl_vendor_expenses SET InvType='$InvType',TradeName='$TradeName',TypeOfVendor='$TypeOfVendor',PoNo='$PoNo',Locations='$Locations',AdvAmount='$AdvAmount',VedId='$user_id',UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId',Photo='$Photo',Photo2='$Photo2',InvoiceNo='$InvoiceNo'";
  $conn->query($qx); 
  
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
?>