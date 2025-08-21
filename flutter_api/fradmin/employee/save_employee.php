<?php 
include_once '../config.php';
$id = $_POST['id'];
$frid = $_POST['frid']; 
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


$Status = $_POST['Status'];
$CatId = $_POST['CatId'];
$Roll = $_POST['Roll'];
if($_POST['Options']!=''){
$Options = implode(",", $_POST['Options']);
}
else{
   $Options = 0; 
}

/**/

if($_POST['zone']!=''){
$zone = implode(",", $_POST['zone']);
$sql = "SELECT frids FROM tbl_assign_fr_to_zone WHERE zone IN($zone)";
$row = getRecord($sql);
$CocoFranchiseAccess = $row['frids'];
}
else{
   $zone = 0; 
   if($_POST['CocoFranchiseAccess']!=''){
$CocoFranchiseAccess = implode(",", $_POST['CocoFranchiseAccess']);
}
else{
   $CocoFranchiseAccess = 0; 
}
}

if($_POST['MenuId']!=''){
$MenuId = implode(",", $_POST['MenuId']);
}
else{
   $MenuId = 0; 
}

if($_POST['submenuid']!=''){
$submenuid = implode(",", $_POST['submenuid']);
}
else{
   $submenuid = 0; 
}



$PanNo = addslashes(trim($_POST['PanNo']));
$CompId = addslashes(trim($_POST['CompId']));
$BranchId = addslashes(trim($_POST['BranchId']));
$CreatedDate = date('Y-m-d');
$pageval = addslashes(trim($_POST['pageval']));

$AccountName = addslashes(trim($_POST['AccountName']));
$BankName = addslashes(trim($_POST['BankName']));
$AccountNo = addslashes(trim($_POST['AccountNo']));
$IfscCode = addslashes(trim($_POST['IfscCode']));
$Branch = addslashes(trim($_POST['Branch']));
$UpiNo = addslashes(trim($_POST['UpiNo']));
$UnderUser = addslashes(trim($_POST['UnderUser']));
$ReportingMgr = addslashes(trim($_POST['ReportingMgr']));
$ResignStatus = addslashes(trim($_POST['ResignStatus']));
$ResignDate = addslashes(trim($_POST['ResignDate']));
$ResignComment = addslashes(trim($_POST['ResignComment']));


if($id == ''){
    $sql2 = "SELECT * FROM tbl_users_bill WHERE Phone='$Phone'";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
     echo "<script>alert('Phone No Already Exists!');window.location.href='add-employee.php';</script>";
 }   
 else{
$sql = "INSERT INTO tbl_users_bill SET MenuId='$MenuId',submenuid='$submenuid',zone='$zone',CocoFranchiseAccess='$CocoFranchiseAccess',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='$Roll',CreatedDate='$CreatedDate',CreatedBy='$user_id',GstNo='$GstNo',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',PanNo='$PanNo',Options='$Options',CompId='$CompId',BranchId='$BranchId',FatherPhone='$FatherPhone',Designation='$Designation',Dob='$Dob',AadharNo='$AadharNo',BloodGroup='$BloodGroup',JoinDate='$JoinDate',EmailId2='$EmailId2',PerDaySalary='$PerDaySalary',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',UnderUser='$UnderUser',ReportingMgr='$ReportingMgr',ResignStatus='$ResignStatus',ResignDate='$ResignDate',ResignComment='$ResignComment'";
$conn->query($sql);
$EmpId = mysqli_insert_id($conn);



$sql3 = "INSERT INTO customer_address SET UserId='$EmpId',Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate'";
$conn->query($sql3);
  echo "<script>alert('Record Created Successfully!');window.location.href='add-employee.php';</script>";
}
}
else{
     $sql2 = "SELECT * FROM tbl_users_bill WHERE Phone='$Phone' AND id!='$id' ";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
    echo "<script>alert('Phone No Already Exists!');window.location.href='add-employee.php';</script>";
 }  
 else{
   

$sql = "UPDATE tbl_users_bill SET MenuId='$MenuId',submenuid='$submenuid',zone='$zone',CocoFranchiseAccess='$CocoFranchiseAccess',Barcode='$Barcode',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='$Roll',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',GstNo='$GstNo',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',PanNo='$PanNo',Options='$Options',CompId='$CompId',BranchId='$BranchId',FatherPhone='$FatherPhone',Designation='$Designation',Dob='$Dob',AadharNo='$AadharNo',BloodGroup='$BloodGroup',JoinDate='$JoinDate',EmailId2='$EmailId2',PerDaySalary='$PerDaySalary',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',UnderUser='$UnderUser',ReportingMgr='$ReportingMgr',ResignStatus='$ResignStatus',ResignDate='$ResignDate',ResignComment='$ResignComment' WHERE id='$id'";
$conn->query($sql);


$sql3 = "UPDATE customer_address SET Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate' WHERE UserId='$id'";
$conn->query($sql3);

echo "<script>alert('Record Updated Successfully!');window.location.href='add-employee.php';</script>";
}
}
?>