<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
if($_POST['action'] == 'Save'){
$id = $_POST['id'];
$Fname = addslashes(trim($_POST['Fname']));
$Mname = addslashes(trim($_POST['Mname']));
$Lname = addslashes(trim($_POST['Lname']));
$Phone = $_POST['Phone'];
$EmailId = $_POST['EmailId'];
$Phone2 = $_POST['Phone2'];
$Password = addslashes($_POST['Password']);
$CountryId = addslashes($_POST['CountryId']);
$StateId = addslashes($_POST['StateId']);
$CityId = addslashes($_POST['CityId']);
$Address = addslashes(trim($_POST['Address']));
$GstNo = addslashes(trim($_POST['GstNo']));
$Pincode = trim($_POST['Pincode']);
$Details = addslashes(trim($_POST['Details']));
$Status = $_POST['Status'];
$CatId = $_POST['CatId'];
$Roll = $_POST['Roll'];
$AadharNo = addslashes(trim($_POST['AadharNo']));
$PanNo = addslashes(trim($_POST['PanNo']));
$TradeName = addslashes(trim($_POST['TradeName']));
$TypeOfVendor = addslashes(trim($_POST['TypeOfVendor']));

$AccountName = addslashes(trim($_POST['AccountName']));
$BankName = addslashes(trim($_POST['BankName']));
$AccountNo = addslashes(trim($_POST['AccountNo']));
$IfscCode = addslashes(trim($_POST['IfscCode']));
$Branch = addslashes(trim($_POST['Branch']));
$UpiNo = addslashes(trim($_POST['UpiNo']));

$CreatedDate = date('Y-m-d');

$randno = rand(1,100);
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


$randno3 = rand(1,100);
$src3 = $_FILES['Photo3']['tmp_name'];
$fnm3 = substr($_FILES["Photo3"]["name"], 0,strrpos($_FILES["Photo3"]["name"],'.')); 
$fnm3 = str_replace(" ","_",$fnm3);
$ext3 = substr($_FILES["Photo3"]["name"],strpos($_FILES["Photo3"]["name"],"."));
$dest3 = '../../uploads/'. $randno3 . "_".$fnm3 . $ext3;
$imagepath3 =  $randno3 . "_".$fnm3 . $ext3;
if(move_uploaded_file($src3, $dest3))
{
$Photo3 = $imagepath3 ;
} 
else{
  $Photo3 = $_POST['OldPhoto3'];
}

$randno3 = rand(1,100);
$src3 = $_FILES['AadharCard']['tmp_name'];
$fnm3 = substr($_FILES["AadharCard"]["name"], 0,strrpos($_FILES["AadharCard"]["name"],'.')); 
$fnm3 = str_replace(" ","_",$fnm3);
$ext3 = substr($_FILES["AadharCard"]["name"],strpos($_FILES["AadharCard"]["name"],"."));
$dest3 = '../../uploads/'. $randno3 . "_".$fnm3 . $ext3;
$imagepath3 =  $randno3 . "_".$fnm3 . $ext3;
if(move_uploaded_file($src3, $dest3))
{
$AadharCard = $imagepath3 ;
} 
else{
$AadharCard = $_POST['AadharCardOld'];
}

$randno4 = rand(1,100);
$src4 = $_FILES['AadharCard2']['tmp_name'];
$fnm4 = substr($_FILES["AadharCard2"]["name"], 0,strrpos($_FILES["AadharCard2"]["name"],'.')); 
$fnm4 = str_replace(" ","_",$fnm4);
$ext4 = substr($_FILES["AadharCard2"]["name"],strpos($_FILES["AadharCard2"]["name"],"."));
$dest4 = '../../uploads/'. $randno4 . "_".$fnm4 . $ext4;
$imagepath4 =  $randno4 . "_".$fnm4 . $ext4;
if(move_uploaded_file($src4, $dest4))
{
$AadharCard2 = $imagepath4 ;
} 
else{
$AadharCard2 = $_POST['AadharCardOld2'];
}

$randno6 = rand(1,100);
$src6 = $_FILES['PanCard']['tmp_name'];
$fnm6 = substr($_FILES["PanCard"]["name"], 0,strrpos($_FILES["PanCard"]["name"],'.')); 
$fnm6 = str_replace(" ","_",$fnm6);
$ext6 = substr($_FILES["PanCard"]["name"],strpos($_FILES["PanCard"]["name"],"."));
$dest6 = '../../uploads/'. $randno6 . "_".$fnm6 . $ext6;
$imagepath6 =  $randno6 . "_".$fnm6 . $ext6;
if(move_uploaded_file($src6, $dest6))
{
$PanCard = $imagepath6 ;
} 
else{
$PanCard = $_POST['PanCardOld'];
}

$randno7 = rand(1,100);
$src7 = $_FILES['PanCard2']['tmp_name'];
$fnm7 = substr($_FILES["PanCard2"]["name"], 0,strrpos($_FILES["PanCard2"]["name"],'.')); 
$fnm7 = str_replace(" ","_",$fnm7);
$ext7 = substr($_FILES["PanCard2"]["name"],strpos($_FILES["PanCard2"]["name"],"."));
$dest7 = '../../uploads/'. $randno7 . "_".$fnm7 . $ext7;
$imagepath7 =  $randno7 . "_".$fnm7 . $ext7;
if(move_uploaded_file($src7, $dest7))
{
$PanCard2 = $imagepath7 ;
} 
else{
$PanCard2 = $_POST['PanCardOld2'];
}

$randno = rand(1,100);
$src = $_FILES['ChequeBook']['tmp_name'];
$fnm = substr($_FILES["ChequeBook"]["name"], 0,strrpos($_FILES["ChequeBook"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["ChequeBook"]["name"],strpos($_FILES["ChequeBook"]["name"],"."));
$dest = '../../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$ChequeBook = $imagepath ;
} 
else{
	$ChequeBook = $_POST['ChequeBookOld'];
}


if($id == ''){
 $sql = "SELECT * FROM tbl_users WHERE Phone='$Phone' AND Roll='3'";
 $rncnt = getRow($sql);
 if($rncnt > 0){
     echo 0;
 }
 else{
 $sql = "INSERT INTO tbl_users SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',TradeName='$TradeName',TypeOfVendor='$TypeOfVendor',ChequeBook='$ChequeBook',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='3',CreatedDate='$CreatedDate',CreatedBy='$user_id',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2',GstNo='$GstNo',PanNo='$PanNo',AadharNo='$AadharNo'";
$conn->query($sql);
$EmpId = mysqli_insert_id($conn);
$CustomerId = "V".$EmpId;
$sql3 = "UPDATE tbl_users SET CustomerId='$CustomerId' WHERE id='$EmpId'";
$conn->query($sql3);

 $sql2 = "INSERT INTO tbl_bank_details SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',Status='1',CreatedBy='$user_id',CreatedDate='$CreatedDate',userid='$EmpId',type=1";
    $conn->query($sql2);
    
echo 1;
}
}
else{
    $sql = "SELECT * FROM tbl_users WHERE Phone='$Phone' AND Roll='3' AND id!='$id'";
 $rncnt = getRow($sql);
 if($rncnt > 0){
     echo 0;
 }
 else{
$sql = "UPDATE tbl_users SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',TradeName='$TradeName',TypeOfVendor='$TypeOfVendor',ChequeBook='$ChequeBook',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='3',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2',GstNo='$GstNo',PanNo='$PanNo',AadharNo='$AadharNo' WHERE id='$id'";
$conn->query($sql);
$sql3 = "SELECT * FROM tbl_bank_details WHERE AccountNo='$AccountNo' AND IfscCode='$IfscCode' AND type=1 AND userid='$id'";
$rncnt3 = getRow($sql3);
if($rncnt3 > 0){
 $sql2 = "UPDATE tbl_bank_details SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',Status='1',ModifiedBy='$user_id',ModifiedDate='$CreatedDate' WHERE userid='$id' AND type=1";
$conn->query($sql2);
}
else{
     $sql2 = "INSERT INTO tbl_bank_details SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',Status='1',CreatedBy='$user_id',CreatedDate='$CreatedDate',userid='$id',type=1";
    $conn->query($sql2);
}
echo 1;
}
}

}
