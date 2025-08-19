<?php
session_start();
include_once '../config.php';
include('../../libs/phpqrcode/qrlib.php');
$user_id = $_SESSION['Admin']['id'];
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

$FatherPhone = addslashes(trim($_POST['FatherPhone']));
$Designation = addslashes(trim($_POST['Designation']));
$Dob = addslashes(trim($_POST['Dob']));
$AadharNo = addslashes(trim($_POST['AadharNo']));
$BloodGroup = addslashes(trim($_POST['BloodGroup']));
$JoinDate = addslashes(trim($_POST['JoinDate']));
$EmailId2 = addslashes(trim($_POST['EmailId2']));
$PerDaySalary = addslashes(trim($_POST['PerDaySalary']));
$UnderUser = addslashes(trim($_POST['UnderUser']));
$KycDate = addslashes(trim($_POST['KycDate']));
$KycStatus = addslashes(trim($_POST['KycStatus']));
//$pageval = addslashes(trim($_POST['pageval']));
$Status = $_POST['Status'];
$CatId = $_POST['CatId'];
$Roll = $_POST['Roll'];
if($_POST['Options']!=''){
$Options = implode(",", $_POST['Options']);
}
else{
   $Options = 0; 
}

$PanNo = addslashes(trim($_POST['PanNo']));
$CompId = addslashes(trim($_POST['CompId']));
$BranchId = addslashes(trim($_POST['BranchId']));
$CreatedDate = date('Y-m-d');
$pageval = addslashes(trim($_POST['pageval']));

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


$ReferalNo1 = addslashes(trim($_POST['ReferalNo1']));
$ReferalNo2 = addslashes(trim($_POST['ReferalNo2']));
$NomineePartnerName = addslashes(trim($_POST['NomineePartnerName']));
$NomineePartnerRelation = addslashes(trim($_POST['NomineePartnerRelation']));
$NomineePartnerPhone = addslashes(trim($_POST['NomineePartnerPhone']));


$tempDir = '../../barcodes/'; 

if($id == ''){
    $sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone'";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
   if($pageval == 'useracc'){
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-freelancer-2.php';</script>";  
   }
   else{
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-freelancer.php';</script>";
   }
    
 }   
 else{
$sql = "INSERT INTO tbl_users SET KycStatus='$KycStatus',KycDate='$KycDate',UnderUser='$UnderUser',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='$Roll',CreatedDate='$CreatedDate',CreatedBy='$user_id',GstNo='$GstNo',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',PanNo='$PanNo',Options='$Options',CompId='$CompId',BranchId='$BranchId',FatherPhone='$FatherPhone',Designation='$Designation',Dob='$Dob',AadharNo='$AadharNo',BloodGroup='$BloodGroup',JoinDate='$JoinDate',EmailId2='$EmailId2',PerDaySalary='$PerDaySalary',ReferalNo1='$ReferalNo1',ReferalNo2='$ReferalNo2',NomineePartnerName='$NomineePartnerName',NomineePartnerRelation='$NomineePartnerRelation',NomineePartnerPhone='$NomineePartnerPhone',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2'";
$conn->query($sql);
$EmpId = mysqli_insert_id($conn);

$sql3 = "INSERT INTO customer_address SET UserId='$EmpId',Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate'";
$conn->query($sql3);

$filename = $EmpId.".png";
$codeContents = $Phone;
QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
$Barcode = $filename;

$CustomerId = "MH".$EmpId;
$sql3 = "UPDATE tbl_users SET Barcode='$Barcode',CustomerId='$CustomerId' WHERE id='$EmpId'";
$conn->query($sql3);

$smstxt = "Dear ".$Fname.", Congratulations! Your registration as a business partner with Maha Chai has been successfully processed. We are thrilled to welcome you to our partner network. If you have any immediate questions or require assistance, please feel free to contact our business partnership team at 8007885000.";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875444697334";
  include '../../incsmsapi.php';  
  
if($pageval == 'useracc'){
    echo "<script>alert('Record Created Successfully!');window.location.href='../view-freelancer-2.php';</script>";
}
else{
  echo "<script>alert('Record Created Successfully!');window.location.href='../view-freelancer.php';</script>";
}
}
}
else{
     $sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone' AND id!='$id'";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
    if($pageval == 'useracc'){
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-freelancer-2.php?id=$id';</script>";  
   }
   else{
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-freelancer.php?id=$id';</script>";
   }
 }  
 else{
     
      $filename = $id.".png";
$codeContents = $Phone;
QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
$Barcode = $filename;

$sql = "UPDATE tbl_users SET KycStatus='$KycStatus',KycDate='$KycDate',UnderUser='$UnderUser',Barcode='$Barcode',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='$Roll',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',GstNo='$GstNo',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',PanNo='$PanNo',Options='$Options',CompId='$CompId',BranchId='$BranchId',FatherPhone='$FatherPhone',Designation='$Designation',Dob='$Dob',AadharNo='$AadharNo',BloodGroup='$BloodGroup',JoinDate='$JoinDate',EmailId2='$EmailId2',PerDaySalary='$PerDaySalary',ReferalNo1='$ReferalNo1',ReferalNo2='$ReferalNo2',NomineePartnerName='$NomineePartnerName',NomineePartnerRelation='$NomineePartnerRelation',NomineePartnerPhone='$NomineePartnerPhone',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2' WHERE id='$id'";
$conn->query($sql);


$sql3 = "UPDATE customer_address SET Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate' WHERE UserId='$id'";
$conn->query($sql3);
if($pageval == 'useracc'){
    echo "<script>alert('Record Updated Successfully!');window.location.href='../view-freelancer-2.php';</script>";
}
else{
  echo "<script>alert('Record Updated Successfully!');window.location.href='../view-freelancer.php';</script>";
}
}
}

}

if($_POST['action'] == 'deletePhoto'){
   	$id = $_POST['id'];
    $Photo = $_POST['Photo'];
    $q = "UPDATE tbl_users SET Photo='' WHERE id=$id";
    $conn->query($q);
    echo "File Deleted Successfully";
}

if($_POST['action'] == 'getUserDetails'){
$id = $_POST['id'];
$sql = "SELECT tu.*,tu2.Fname AS AgentName FROM tbl_users tu LEFT JOIN tbl_users tu2 ON tu.UnderUser=tu2.id WHERE tu.id='$id'";
$row = getRecord($sql);
echo json_encode($row);
}

if($_POST['action'] == 'getUserDetails2'){
$CellNo = $_POST['CellNo'];
$sql = "SELECT tu.*,tu2.Fname AS AgentName FROM tbl_users tu LEFT JOIN tbl_users tu2 ON tu.UnderUser=tu2.id WHERE tu.Phone='$CellNo'";
$row = getRecord($sql);
echo json_encode($row);
}