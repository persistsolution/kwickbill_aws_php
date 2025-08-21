<?php
session_start();
$sessionid = session_id();
include_once '../config.php';
include('../../libs/phpqrcode/qrlib.php');
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'Save'){
$id = $_POST['id'];
$ColgId = addslashes(trim($_POST["ColgId"]));
$CourseId = addslashes(trim($_POST["CourseId"]));
$Fname = addslashes(trim($_POST['Fname']));
$Mname = addslashes(trim($_POST['Mname']));
$Lname = addslashes(trim($_POST['Lname']));
$Phone = $_POST['Phone'];
$EmailId = $_POST['EmailId'];
$Phone2 = $_POST['Phone2'];
$Password = addslashes(trim($_POST['Password']));
$CountryId = addslashes($_POST['CountryId']);
$StateId = addslashes($_POST['StateId']);
$CityId = addslashes($_POST['CityId']);
$Address = addslashes(trim($_POST['Address']));
$LoanCategory = addslashes(trim($_POST['LoanCategory']));
$SubCategory = addslashes(trim($_POST['SubCategory']));
$Campaign = addslashes(trim($_POST['Campaign']));
$Source = addslashes(trim($_POST['Source']));
$CallDate = addslashes(trim($_POST['CallDate']));
$AgentName = addslashes(trim($_POST['AgentName']));
$AgentComments = addslashes(trim($_POST['AgentComments']));
$PartId = addslashes(trim($_POST['PartId']));
$BranchId = addslashes(trim($_POST['BranchId']));
$Pincode = trim($_POST['Pincode']);
$LeadId = trim($_POST['LeadId']);
$Status = $_POST['Status'];
$UserType = $_POST['UserType'];
$Roll = $_POST['Roll'];

$Address2 = addslashes(trim($_POST['Address2']));
$WorkingDetails = addslashes(trim($_POST['WorkingDetails']));
$WorkingAddress = addslashes(trim($_POST['WorkingAddress']));
$Gname = addslashes(trim($_POST['Gname']));
$Gphone = addslashes(trim($_POST['Gphone']));
$Gname2 = addslashes(trim($_POST['Gname2']));
$Gphone2 = addslashes(trim($_POST['Gphone2']));
$Dob = addslashes(trim($_POST['Dob']));
$Area = addslashes(trim($_POST['Area']));
$UnderUser = addslashes(trim($_POST['UnderUser']));

$ProjectType = addslashes(trim($_POST['ProjectType']));
$BeneficiaryId = addslashes(trim($_POST['BeneficiaryId']));
$Taluka = addslashes(trim($_POST['Taluka']));
$Village = addslashes(trim($_POST['Village']));
$District = addslashes(trim($_POST['District']));
$PumpCapacity = addslashes(trim($_POST['PumpCapacity']));
$RooftopPlantCapacity = addslashes(trim($_POST['RooftopPlantCapacity']));

$Lattitude = addslashes(trim($_POST['Lattitude']));
$Longitude = addslashes(trim($_POST['Longitude']));
$OffOnGrid = addslashes(trim($_POST['OffOnGrid']));
$SanctionLoad = addslashes(trim($_POST['SanctionLoad']));
$LoadExtension = addslashes(trim($_POST['LoadExtension']));
$WaterSource = addslashes(trim($_POST['WaterSource']));
$SummerDepth = addslashes(trim($_POST['SummerDepth']));

$WinterDepth = addslashes(trim($_POST['WinterDepth']));
$PumpHead = addslashes(trim($_POST['PumpHead']));
$BgNumber = addslashes(trim($_POST['BgNumber']));
$BgValidity = addslashes(trim($_POST['BgValidity']));
$BgClaimPeriod = addslashes(trim($_POST['BgClaimPeriod']));
$InsuranceNumber = addslashes(trim($_POST['InsuranceNumber']));
$InsuranceAgency = addslashes(trim($_POST['InsuranceAgency']));
$InsuranceValidity = addslashes(trim($_POST['InsuranceValidity']));
$InstallationVendor = addslashes(trim($_POST['InstallationVendor']));
$PumpHeadSelect = addslashes(trim($_POST['PumpHeadSelect']));

$SchemeId = addslashes(trim($_POST['SchemeId']));
$AcDc = addslashes(trim($_POST['AcDc']));
$Surface = addslashes(trim($_POST['Surface']));
$AadharNo = addslashes(trim($_POST['AadharNo']));
$PanNo = addslashes(trim($_POST['PanNo']));

$AccountName = addslashes(trim($_POST['AccountName']));
$BankName = addslashes(trim($_POST['BankName']));
$AccountNo = addslashes(trim($_POST['AccountNo']));
$IfscCode = addslashes(trim($_POST['IfscCode']));
$Branch = addslashes(trim($_POST['Branch']));
$UpiNo = addslashes(trim($_POST['UpiNo']));


$GumastaNo = addslashes(trim($_POST['GumastaNo']));
$MsmeNo = addslashes(trim($_POST['MsmeNo']));
$InspectionDate = addslashes(trim($_POST['InspectionDate']));
$CommissioningDate = addslashes(trim($_POST['CommissioningDate']));
$CustType = addslashes(trim($_POST['CustType']));
$BoreDia = addslashes(trim($_POST['BoreDia']));

$CompName = addslashes(trim($_POST['CompName']));
$CompAddress = addslashes(trim($_POST['CompAddress']));
$CompPhone = addslashes(trim($_POST['CompPhone']));
$AuthorName = addslashes(trim($_POST['AuthorName']));
$CompId = addslashes(trim($_POST['CompId']));
$ExeId = addslashes(trim($_POST['ExeId']));
$SellAmt = addslashes(trim($_POST['SellAmt']));
$SellDate = addslashes(trim($_POST['SellDate']));
  
  $ShopName = addslashes(trim($_POST['ShopName']));
  $OwnFranchise = addslashes(trim($_POST['OwnFranchise']));
  $Location = addslashes(trim($_POST['Location']));
  $ZoneId = addslashes(trim($_POST['ZoneId']));
$CreatedDate = date('Y-m-d');

$FrDevCost = addslashes(trim($_POST['FrDevCost']));
  $MonthlyRent = addslashes(trim($_POST['MonthlyRent']));
  $PumpName = addslashes(trim($_POST['PumpName']));
  $SpacePartner = addslashes(trim($_POST['SpacePartner']));
  
  $SubZoneId= addslashes(trim($_POST['SubZoneId']));
  $AlianceName= addslashes(trim($_POST['AlianceName']));
  $AliancePhone= addslashes(trim($_POST['AliancePhone']));
  $AlianceEmailId= addslashes(trim($_POST['AlianceEmailId']));
  $AliancePer= addslashes(trim($_POST['AliancePer']));
   $FssaiNo= addslashes(trim($_POST['FssaiNo']));
   $OperationalFr= addslashes(trim($_POST['OperationalFr']));
   $UnderByBdm= addslashes(trim($_POST['UnderByBdm']));

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

$randno8 = rand(1,100);
$src8 = $_FILES['GstCertificate']['tmp_name'];
$fnm8 = substr($_FILES["GstCertificate"]["name"], 0,strrpos($_FILES["GstCertificate"]["name"],'.')); 
$fnm8 = str_replace(" ","_",$fnm8);
$ext8 = substr($_FILES["GstCertificate"]["name"],strpos($_FILES["GstCertificate"]["name"],"."));
$dest8 = '../../uploads/'. $randno8 . "_".$fnm8 . $ext8;
$imagepath8 =  $randno8 . "_".$fnm8 . $ext8;
if(move_uploaded_file($src8, $dest8))
{
$GstCertificate = $imagepath8 ;
} 
else{
$GstCertificate = $_POST['OldGstCertificate'];
}

$randno8 = rand(1,100);
$src8 = $_FILES['FoodLicence']['tmp_name'];
$fnm8 = substr($_FILES["FoodLicence"]["name"], 0,strrpos($_FILES["FoodLicence"]["name"],'.')); 
$fnm8 = str_replace(" ","_",$fnm8);
$ext8 = substr($_FILES["FoodLicence"]["name"],strpos($_FILES["FoodLicence"]["name"],"."));
$dest8 = '../../uploads/'. $randno8 . "_".$fnm8 . $ext8;
$imagepath8 =  $randno8 . "_".$fnm8 . $ext8;
if(move_uploaded_file($src8, $dest8))
{
$FoodLicence = $imagepath8 ;
} 
else{
$FoodLicence = $_POST['OldFoodLicence'];
}

$randno7 = rand(1,100);
$src7 = $_FILES['FoodLicenceReceipt']['tmp_name'];
$fnm7 = substr($_FILES["FoodLicenceReceipt"]["name"], 0,strrpos($_FILES["FoodLicenceReceipt"]["name"],'.')); 
$fnm7 = str_replace(" ","_",$fnm7);
$ext7 = substr($_FILES["FoodLicenceReceipt"]["name"],strpos($_FILES["FoodLicenceReceipt"]["name"],"."));
$dest7 = '../../uploads/'. $randno7 . "_".$fnm7 . $ext7;
$imagepath7 =  $randno7 . "_".$fnm7 . $ext7;
if(move_uploaded_file($src7, $dest7))
{
$FoodLicenceReceipt = $imagepath7 ;
} 
else{
$FoodLicenceReceipt = $_POST['OldFoodLicenceReceipt'];
}

$randno6 = rand(1,100);
$src6 = $_FILES['AgreementCopy']['tmp_name'];
$fnm6 = substr($_FILES["AgreementCopy"]["name"], 0,strrpos($_FILES["AgreementCopy"]["name"],'.')); 
$fnm6 = str_replace(" ","_",$fnm6);
$ext6 = substr($_FILES["AgreementCopy"]["name"],strpos($_FILES["AgreementCopy"]["name"],"."));
$dest6 = '../../uploads/'. $randno6 . "_".$fnm6 . $ext6;
$imagepath6 =  $randno6 . "_".$fnm6 . $ext6;
if(move_uploaded_file($src6, $dest6))
{
$AgreementCopy = $imagepath6 ;
} 
else{
$AgreementCopy = $_POST['OldAgreementCopy'];
}

$Options = '10,11,14,48,49,50,56,57,59,60,69,71,73,74,77,78,79,80,81,82,84,85,86,92,93,94,96,97,98,99';

/*if($_POST['GstNo']==''){
$GstNo = "27AANCM5897K1ZH"; 
}
else{*/
 $GstNo = addslashes(trim($_POST['GstNo']));   
/*}*/

if($_POST['ZomatoSwiggy']!=''){
$ZomatoSwiggy = implode(",", $_POST['ZomatoSwiggy']);
}
else{
   $ZomatoSwiggy = 0; 
}



$modified_time = gmdate('Y-m-d H:i:s.').gettimeofday()['usec'];


 $PrintCompName = addslashes(trim($_POST['PrintCompName']));
    $PrintMobNo = addslashes(trim($_POST['PrintMobNo']));
    $terms_condition = addslashes(trim($_POST['terms_condition']));
    $bottom_title = addslashes(trim($_POST['bottom_title']));
    $MenuId = addslashes(trim($_POST['MenuId']));
$NewFr = addslashes(trim($_POST['NewFr']));
if($id == ''){
 $sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone'";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
    echo 0;
 }  
 else{
$sql = "INSERT INTO tbl_users SET UnderByBdm='$UnderByBdm',ZomatoSwiggy='$ZomatoSwiggy',OperationalFr='$OperationalFr',FssaiNo='$FssaiNo',AlianceName='$AlianceName',AliancePhone='$AliancePhone',AlianceEmailId='$AlianceEmailId',AliancePer='$AliancePer',NewFr='$NewFr',MenuId='$MenuId',SubZoneId='$SubZoneId',FrDevCost='$FrDevCost',MonthlyRent='$MonthlyRent',PumpName='$PumpName',SpacePartner='$SpacePartner',ZoneId='$ZoneId',OwnFranchise='$OwnFranchise',ShopName='$ShopName',ExeId='$ExeId',SellAmt='$SellAmt',SellDate='$SellDate',SchemeId='$SchemeId',ColgId='$ColgId',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Phone2='$Phone2',Password='$Password',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',BranchId='$BranchId',CreatedDate='$CreatedDate',CreatedBy='$user_id',Dob='$Dob',Area='$Area',UserType='$UserType',UnderUser='$UnderUser',ProjectType='$ProjectType',BeneficiaryId='$BeneficiaryId',Taluka='$Taluka',Village='$Village',District='$District',PumpCapacity='$PumpCapacity',RooftopPlantCapacity='$RooftopPlantCapacity',Lattitude='$Lattitude',Longitude='$Longitude',OffOnGrid='$OffOnGrid',SanctionLoad='$SanctionLoad',LoadExtension='$LoadExtension',WaterSource='$WaterSource',SummerDepth='$SummerDepth',WinterDepth='$WinterDepth',PumpHead='$PumpHead',BgNumber='$BgNumber',BgValidity='$BgValidity',BgClaimPeriod='$BgClaimPeriod',InsuranceNumber='$InsuranceNumber',InsuranceAgency='$InsuranceAgency',InsuranceValidity='$InsuranceValidity',InstallationVendor='$InstallationVendor',PumpHeadSelect='$PumpHeadSelect',AcDc='$AcDc',Surface='$Surface',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2',AadharNo='$AadharNo',PanNo='$PanNo',GstCertificate='$GstCertificate',GstNo='$GstNo',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',GumastaNo='$GumastaNo',Gumasta='$Gumasta',MsmeNo='$MsmeNo',Msme='$Msme',InspectionDate='$InspectionDate',CommissioningDate='$CommissioningDate',CustType='$CustType',BoreDia='$BoreDia',CompName='$CompName',CompAddress='$CompAddress',CompPhone='$CompPhone',AuthorName='$AuthorName',Roll=5,CompId='$CompId',Options='$Options',terms_condition='$terms_condition',bottom_title='$bottom_title',PrintCompName='$PrintCompName',PrintMobNo='$PrintMobNo',FoodLicence='$FoodLicence',FoodLicenceReceipt='$FoodLicenceReceipt',AgreementCopy='$AgreementCopy',modified_time='$modified_time',Location='$Location'";
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

$sql = "INSERT INTO tbl_general_ledger SET UserId='$EmpId',AccountName='$Fname',Amount='$SellAmt',PaymentDate='$SellDate',CrDr='Cr',Type='OB',Narration='Total Sell Amount',CreatedDate='$CreatedDate'";
$conn->query($sql);

$smstxt = "Hello ".$Fname.", Thank you for registering as a Franchise Owner with Maha Chai! We're thrilled to welcome you to our growing family. Your commitment to becoming a part of our franchise network is an exciting step forward. We're dedicated to supporting your journey and ensuring your success. Maha Chai Team";
//   $dltentityid = "1501701120000037351";
//   $dlttempid = "1707169876344321817";
//   include '../../incsmsapi.php';  

$sql = "INSERT INTO tbl_users_bill SELECT * FROM `tbl_users` WHERE id='$EmpId'";
$conn->query($sql);

/*if($OwnFranchise == 1){
 $sql3 = "INSERT INTO tbl_cust_products (ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,CreatedBy,code,CreatedDate,modified_time,CgstAmt,SgstAmt,IgstAmt)
        SELECT ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,'$EmpId','','$CreatedDate','$modified_time',CgstAmt,SgstAmt,IgstAmt FROM `tbl_cust_products` WHERE CreatedBy=0 AND ProdType=0";
        $conn->query($sql3);
}
else{
    $sql3 = "INSERT INTO tbl_cust_products (ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,CreatedBy,code,CreatedDate,modified_time,CgstAmt,SgstAmt,IgstAmt)
        SELECT ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,'$EmpId','','$CreatedDate','$modified_time',CgstAmt,SgstAmt,IgstAmt FROM `tbl_cust_products` WHERE CreatedBy=253 AND ProdType=0";
        $conn->query($sql3); 
}*/
    
   /* $sql = "SELECT * FROM tbl_cust_products WHERE ProdType=0";
$row = getList($sql);
foreach($row as $result){
    $MinPrice = $result['MinPrice'];
    $CgstPer = 2.5;
    $SgstPer = 2.5;
    $CgstAmt2 = $MinPrice*($CgstPer/100);
    $CgstAmt = round($CgstAmt2, 2);
    $SgstAmt2 = $MinPrice*($SgstPer/100);
    $SgstAmt = round($SgstAmt2, 2);
    $GstAmt2 = $CgstAmt + $SgstAmt;
    $GstAmt = round($GstAmt2, 2);
    $ProdPrice2 = $MinPrice - $GstAmt;
    $ProdPrice = round($ProdPrice2, 2);
    $sql = "UPDATE tbl_cust_products SET CgstPer='2.5',SgstPer='2.5',CgstAmt='$CgstAmt',SgstAmt='$SgstAmt',ProdPrice='$ProdPrice',GstAmt='$GstAmt' WHERE id='".$result['id']."'";
    $conn->query($sql);
}    */

/*        $sql = "SELECT * FROM tbl_cust_products WHERE code=''";
$row = getList($sql);
foreach($row as $result){
    $Code = RandomStringGenerator($n); 
    $Code2 = $Code."".$result['id'];
    $sql2 = "UPDATE tbl_cust_products SET code='$Code2' WHERE id='".$result['id']."'";
    $conn->query($sql2);
}
*/

echo 1;
}
}
else{
/*$sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone' AND id!='$id'";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
    echo 0;
 }  
 else{*/
$filename = $id.".png";
$codeContents = $Phone;
QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
$Barcode = $filename;

$sql = "UPDATE tbl_users SET UnderByBdm='$UnderByBdm',ZomatoSwiggy='$ZomatoSwiggy',OperationalFr='$OperationalFr',FssaiNo='$FssaiNo',AlianceName='$AlianceName',AliancePhone='$AliancePhone',AlianceEmailId='$AlianceEmailId',AliancePer='$AliancePer',Phone='$Phone',NewFr='$NewFr',MenuId='$MenuId',PrintCompName='$PrintCompName',PrintMobNo='$PrintMobNo',terms_condition='$terms_condition',bottom_title='$bottom_title',SubZoneId='$SubZoneId',FrDevCost='$FrDevCost',MonthlyRent='$MonthlyRent',PumpName='$PumpName',SpacePartner='$SpacePartner',ZoneId='$ZoneId',OwnFranchise='$OwnFranchise',ShopName='$ShopName',ExeId='$ExeId',SellAmt='$SellAmt',SellDate='$SellDate',Barcode='$Barcode',Roll=5,SchemeId='$SchemeId',ColgId='$ColgId',Fname='$Fname',Mname='$Mname',Lname='$Lname',EmailId='$EmailId',Phone2='$Phone2',Password='$Password',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',BranchId='$BranchId',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',Dob='$Dob',Area='$Area',UserType='$UserType',UnderUser='$UnderUser',ProjectType='$ProjectType',BeneficiaryId='$BeneficiaryId',Taluka='$Taluka',Village='$Village',District='$District',PumpCapacity='$PumpCapacity',RooftopPlantCapacity='$RooftopPlantCapacity',Lattitude='$Lattitude',Longitude='$Longitude',OffOnGrid='$OffOnGrid',SanctionLoad='$SanctionLoad',LoadExtension='$LoadExtension',WaterSource='$WaterSource',SummerDepth='$SummerDepth',WinterDepth='$WinterDepth',PumpHead='$PumpHead',BgNumber='$BgNumber',BgValidity='$BgValidity',BgClaimPeriod='$BgClaimPeriod',InsuranceNumber='$InsuranceNumber',InsuranceAgency='$InsuranceAgency',InsuranceValidity='$InsuranceValidity',InstallationVendor='$InstallationVendor',PumpHeadSelect='$PumpHeadSelect',AcDc='$AcDc',Surface='$Surface',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2',AadharNo='$AadharNo',PanNo='$PanNo',GstCertificate='$GstCertificate',GstNo='$GstNo',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',GumastaNo='$GumastaNo',Gumasta='$Gumasta',MsmeNo='$MsmeNo',Msme='$Msme',InspectionDate='$InspectionDate',CommissioningDate='$CommissioningDate',CustType='$CustType',BoreDia='$BoreDia',CompName='$CompName',CompAddress='$CompAddress',CompPhone='$CompPhone',AuthorName='$AuthorName',CompId='$CompId',Options='$Options',FoodLicence='$FoodLicence',FoodLicenceReceipt='$FoodLicenceReceipt',AgreementCopy='$AgreementCopy',modified_time='$modified_time',Location='$Location' WHERE id='$id'";
$conn->query($sql);

$sql = "UPDATE tbl_users_bill SET OperationalFr='$OperationalFr',FssaiNo='$FssaiNo',AlianceName='$AlianceName',AliancePhone='$AliancePhone',AlianceEmailId='$AlianceEmailId',AliancePer='$AliancePer',Phone='$Phone',NewFr='$NewFr',MenuId='$MenuId',PrintCompName='$PrintCompName',PrintMobNo='$PrintMobNo',terms_condition='$terms_condition',bottom_title='$bottom_title',SubZoneId='$SubZoneId',FrDevCost='$FrDevCost',MonthlyRent='$MonthlyRent',PumpName='$PumpName',SpacePartner='$SpacePartner',ZoneId='$ZoneId',OwnFranchise='$OwnFranchise',ShopName='$ShopName',ExeId='$ExeId',SellAmt='$SellAmt',SellDate='$SellDate',Barcode='$Barcode',Roll=5,SchemeId='$SchemeId',ColgId='$ColgId',Fname='$Fname',Mname='$Mname',Lname='$Lname',EmailId='$EmailId',Phone2='$Phone2',Password='$Password',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',BranchId='$BranchId',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',Dob='$Dob',Area='$Area',UserType='$UserType',UnderUser='$UnderUser',ProjectType='$ProjectType',BeneficiaryId='$BeneficiaryId',Taluka='$Taluka',Village='$Village',District='$District',PumpCapacity='$PumpCapacity',RooftopPlantCapacity='$RooftopPlantCapacity',Lattitude='$Lattitude',Longitude='$Longitude',OffOnGrid='$OffOnGrid',SanctionLoad='$SanctionLoad',LoadExtension='$LoadExtension',WaterSource='$WaterSource',SummerDepth='$SummerDepth',WinterDepth='$WinterDepth',PumpHead='$PumpHead',BgNumber='$BgNumber',BgValidity='$BgValidity',BgClaimPeriod='$BgClaimPeriod',InsuranceNumber='$InsuranceNumber',InsuranceAgency='$InsuranceAgency',InsuranceValidity='$InsuranceValidity',InstallationVendor='$InstallationVendor',PumpHeadSelect='$PumpHeadSelect',AcDc='$AcDc',Surface='$Surface',AadharCard='$AadharCard',AadharCard2='$AadharCard2',PanCard='$PanCard',PanCard2='$PanCard2',AadharNo='$AadharNo',PanNo='$PanNo',GstCertificate='$GstCertificate',GstNo='$GstNo',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',GumastaNo='$GumastaNo',Gumasta='$Gumasta',MsmeNo='$MsmeNo',Msme='$Msme',InspectionDate='$InspectionDate',CommissioningDate='$CommissioningDate',CustType='$CustType',BoreDia='$BoreDia',CompName='$CompName',CompAddress='$CompAddress',CompPhone='$CompPhone',AuthorName='$AuthorName',CompId='$CompId',Options='$Options',FoodLicence='$FoodLicence',FoodLicenceReceipt='$FoodLicenceReceipt',AgreementCopy='$AgreementCopy',modified_time='$modified_time',Location='$Location' WHERE id='$id'";
$conn->query($sql);

$sql3 = "UPDATE customer_address SET Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate' WHERE UserId='$id'";
$conn->query($sql3);

$sql = "DELETE FROM tbl_general_ledger WHERE UserId='$id' AND Type='OB'";
$conn->query($sql);
$sql = "INSERT INTO tbl_general_ledger SET UserId='$id',AccountName='$Fname',Amount='$SellAmt',PaymentDate='$SellDate',CrDr='Cr',Type='OB',Narration='Total Sell Amount',CreatedDate='$CreatedDate'";
$conn->query($sql);
echo 1;
/*}*/
}
}

if($_POST['action'] == 'deletePhoto'){
   	$id = $_POST['id'];
    $Photo = $_POST['Photo'];
    $q = "UPDATE tbl_users SET Photo='' WHERE id=$id";
    $conn->query($q);
    echo "File Deleted Successfully";
}

if($_POST['action'] == 'getCustDetails'){
    $id = $_POST['id'];
    $sql = "SELECT * FROM tbl_users WHERE id=$id";
    $row = getRecord($sql);
    echo json_encode($row);
}

if($_POST['action'] == 'chageSurveyDetails'){
    $id = $_POST['id'];
    $val = $_POST['val'];
    $sql = "UPDATE tbl_users SET SurveyDetails='$val' WHERE id=$id";
    $conn->query($sql);
    echo 1;
}


if($_POST['action'] == 'getTotalCashAmt'){
    $FromDate = $_POST['FromDate'];
    $ToDate = $_POST['ToDate'];
    $FrId = $_POST['FrId'];
    
    $sql22 = "SELECT SUM(TotalCashAmt) AS TotalCashAmt FROM (SELECT SUM(NetAmount) AS TotalCashAmt FROM tbl_customer_invoice WHERE FrId='$FrId' AND PayType='Cash' UNION ALL 
          SELECT SUM(NetAmount) AS TotalCashAmt FROM tbl_customer_invoice_2025 WHERE FrId='$FrId' AND PayType='Cash') as a";
$row22 = getRecord($sql22);

$sql221 = "SELECT SUM(Amount) AS TotalTransferAmt FROM tbl_cash_book WHERE FrId='$FrId' AND ApproveStatus=1";
$row221 = getRecord($sql221);
 $TotalAmount = $row22["TotalCashAmt"] - $row221['TotalTransferAmt'];
    echo $TotalAmount;
}

if($_POST['action'] == 'getSellAmt'){
    $FrId = $_POST['FrId'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    if($FrId == 'all'){
        $sql = "SELECT COALESCE(SUM(NetAmount), 0) AS NetAmount FROM (SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice WHERE month(InvoiceDate)='$month' AND year(InvoiceDate)='$year' 
                UNION ALL 
                SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025 WHERE month(InvoiceDate)='$month' AND year(InvoiceDate)='$year') as a";
    $row = getRecord($sql);
    
    $sql2 = "SELECT COALESCE(SUM(TotAmt), 0) AS TotPetty 
FROM (
    SELECT tu.Fname, SUM(w.Amount) AS TotAmt 
    FROM `wallet` w 
    LEFT JOIN tbl_users tu ON tu.id = w.UserId 
    LEFT JOIN tbl_users_bill tub ON tub.id = tu.UnderFrId 
    WHERE w.Status = 'Cr' 
        AND MONTH(w.CreatedDate) = '$month' 
        AND YEAR(w.CreatedDate) = '$year' 
        AND (w.Narration LIKE '%Pretty Cash%' OR w.Narration LIKE '%Petty Cash%') 
    GROUP BY w.UserId
) AS a";
    $row2 = getRecord($sql2);
    
    $sql3 = "SELECT COALESCE(SUM(MonthlySalary), 0) AS MonthlySalary FROM (SELECT tu.id,tu.Fname,tu.SalaryType,tu.PerDaySalary,$month AS Month,$year AS Year,DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS DaysInMonth,
    tu.PerDaySalary * DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS MonthlySalary FROM tbl_users tu WHERE tu.SalaryType = 1 AND tu.Status=1 UNION ALL 
    SELECT tu.id,tu.Fname,tu.SalaryType,tu.PerDaySalary,$month AS Month,$year AS Year,DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS DaysInMonth,tu.PerDaySalary AS MonthlySalary FROM tbl_users tu WHERE tu.SalaryType = 2 AND tu.Status=1) as a";
    $row3 = getRecord($sql3);
    
    $sql4 = "SELECT COALESCE(SUM(MonthlyRent), 0) AS MonthlyRent FROM tbl_users WHERE Roll=5 AND Status=1";
    $row4 = getRecord($sql4);
    
    }
    else{
    $sql = "SELECT COALESCE(SUM(NetAmount), 0) AS NetAmount FROM (SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice WHERE FrId='$FrId' AND month(InvoiceDate)='$month' AND year(InvoiceDate)='$year' UNION ALL 
    SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025 WHERE FrId='$FrId' AND month(InvoiceDate)='$month' AND year(InvoiceDate)='$year') as a";
    $row = getRecord($sql);
    
    $sql2 = "SELECT COALESCE(SUM(TotAmt), 0) AS TotPetty 
FROM (
    SELECT tu.Fname, SUM(w.Amount) AS TotAmt 
    FROM `wallet` w 
    LEFT JOIN tbl_users tu ON tu.id = w.UserId 
    LEFT JOIN tbl_users_bill tub ON tub.id = tu.UnderFrId 
    WHERE tub.id = '$FrId' 
        AND w.Status = 'Cr' 
        AND MONTH(w.CreatedDate) = '$month' 
        AND YEAR(w.CreatedDate) = '$year' 
        AND (w.Narration LIKE '%Pretty Cash%' OR w.Narration LIKE '%Petty Cash%') 
    GROUP BY w.UserId
) AS a";
    $row2 = getRecord($sql2);
    
    $sql3 = "SELECT COALESCE(SUM(MonthlySalary), 0) AS MonthlySalary FROM (SELECT tu.id,tu.Fname,tu.SalaryType,tu.PerDaySalary,$month AS Month,$year AS Year,DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS DaysInMonth,
    tu.PerDaySalary * DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS MonthlySalary FROM tbl_users tu WHERE tu.UnderFrId = '$FrId' AND tu.SalaryType = 1 AND tu.Status=1 UNION ALL 
    SELECT tu.id,tu.Fname,tu.SalaryType,tu.PerDaySalary,$month AS Month,$year AS Year,DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS DaysInMonth,tu.PerDaySalary AS MonthlySalary FROM tbl_users tu WHERE tu.UnderFrId = '$FrId' AND tu.SalaryType = 2 AND tu.Status=1) as a";
    $row3 = getRecord($sql3);
    
    $sql4 = "SELECT COALESCE(SUM(MonthlyRent), 0) AS MonthlyRent FROM tbl_users WHERE id='$FrId'";
    $row4 = getRecord($sql4);
    }
    echo json_encode(array('Rent'=>$row4['MonthlyRent'],'NetAmount'=>$row['NetAmount'],'TotPetty'=>$row2['TotPetty'],'Salary'=>$row3['MonthlySalary']));
}

?>
