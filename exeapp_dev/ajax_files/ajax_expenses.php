<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
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
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

/*$randno = rand(1,100);
$src = $_FILES['Photo']['tmp_name'];
$fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
$dest = '../../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$Photo = $imagepath ;
} 
else{
    $Photo = $_POST['OldPhoto'];
}

$randno2 = rand(1,100);
$src2 = $_FILES['Photo2']['tmp_name'];
$fnm2 = substr($_FILES["Photo2"]["name"], 0,strrpos($_FILES["Photo2"]["name"],'.')); 
$fnm2 = str_replace(" ","_",$fnm2);
$ext2 = substr($_FILES["Photo2"]["name"],strpos($_FILES["Photo2"]["name"],"."));
$dest2 = '../../uploads/'. $randno2 . "_".$fnm2 . $ext2;
$imagepath2 =  $randno2 . "_".$fnm2 . $ext2;
if(move_uploaded_file($src2, $dest2))
{
$Photo2 = $imagepath2 ;
} 
else{
    $Photo2 = $_POST['OldPhoto2'];
}
,WebPhoto='$Photo',WebPhoto2='$Photo2'
*/
 $qx = "INSERT INTO tbl_expense_request SET UserId = '$user_id',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',TempPrdId='$TempPrdId',TempPrdId2='$TempPrdId2',VedPhone='$VedPhone',FrId='$FrId'";
  $conn->query($qx); 
  echo 1;
    
}
?>