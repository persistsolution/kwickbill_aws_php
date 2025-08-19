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



$Status = $_POST['Status'];
$CatId = $_POST['CatId'];
$Roll = $_POST['Roll'];
/*if($_POST['Options']!=''){
$Options = implode(",", $_POST['Options']);
}
else{
   $Options = 0; 
}*/


if($_POST['Options']!=''){
$Options2 = implode(",", $_POST['Options']);
}
else{
   $Options2 = 0; 
}

if($_POST['ExpCatId']!=''){
$ExpCatId = implode(",", $_POST['ExpCatId']);
}
else{
   $ExpCatId = 0; 
}

/*if($_POST['CocoFranchiseAccess']!=''){
$CocoFranchiseAccess = implode(",", $_POST['CocoFranchiseAccess']);
}
else{
   $CocoFranchiseAccess = 0; 
}*/

if($_POST['AssignFranchiseAttendance']!=''){
$AssignFranchiseAttendance = implode(",", $_POST['AssignFranchiseAttendance']);
}
else{
   $AssignFranchiseAttendance = 0; 
}

if($_POST['AssignFranchiseVedExp']!=''){
$AssignFranchiseVedExp = implode(",", $_POST['AssignFranchiseVedExp']);
}
else{
   $AssignFranchiseVedExp = 0; 
}

if($_POST['AssignFranchiseBdm']!=''){
$AssignFranchiseBdm = implode(",", $_POST['AssignFranchiseBdm']);
}
else{
   $AssignFranchiseBdm = 0; 
}



if($_POST['zone']!=''){
$zone = implode(",", $_POST['zone']);
$sql = "SELECT frids FROM tbl_assign_fr_to_zone WHERE zone IN($zone)";
$row = getRecord($sql);
$CocoFranchiseAccess = $row['frids'];
}
else{
   $zone = 0; 
   $CocoFranchiseAccess = 0; 
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
$SalaryType = addslashes(trim($_POST['SalaryType']));
$CreditSalaryStatus = addslashes(trim($_POST['CreditSalaryStatus']));

$MainBrEmp = addslashes(trim($_POST['MainBrEmp']));
$UnderByUser = addslashes(trim($_POST['UnderByUser']));

$RefPhone = addslashes(trim($_POST['RefPhone']));
$RefPhone2 = addslashes(trim($_POST['RefPhone2']));
$RefEmailId = addslashes(trim($_POST['RefEmailId']));

$NomineeName = addslashes(trim($_POST['NomineeName']));
$NomineeRelation = addslashes(trim($_POST['NomineeRelation']));
$NomineePhone = addslashes(trim($_POST['NomineePhone']));
$NomineeAadharNo = addslashes(trim($_POST['NomineeAadharNo']));
$MonthlySalary = addslashes(trim($_POST['MonthlySalary']));
$MgrCheckpoint = addslashes(trim($_POST['MgrCheckpoint']));
$OtherEmp = addslashes(trim($_POST['OtherEmp']));
$InternshipEmp = addslashes(trim($_POST['InternshipEmp']));
$NoticePeriod = addslashes(trim($_POST['NoticePeriod']));
$ReferCode = addslashes(trim($_POST['ReferCode']));
$ReferName = addslashes(trim($_POST['ReferName']));
$ReferId = addslashes(trim($_POST['ReferId']));

$Education = addslashes(trim($_POST['Education']));
$UanNo = addslashes(trim($_POST['UanNo']));
$NsoVedPay = addslashes(trim($_POST['NsoVedPay']));
$YearlyWeekOff = addslashes(trim($_POST['YearlyWeekOff']));
$MonthlyWeekOff = addslashes(trim($_POST['MonthlyWeekOff']));
$ReJoinDate = addslashes(trim($_POST['ReJoinDate']));
$ApproveBy = addslashes(trim($_POST['ApproveBy']));
$UnderByBdm = addslashes(trim($_POST['UnderByBdm']));
$AnniversaryDate = addslashes(trim($_POST['AnniversaryDate']));
$Increment = addslashes(trim($_POST['Increment']));
$IncrementPer = addslashes(trim($_POST['IncrementPer']));

$PettyCash = addslashes(trim($_POST['PettyCash']));
$PettyAmount = addslashes(trim($_POST['PettyAmount']));
$MarkAttendance = addslashes(trim($_POST['MarkAttendance']));
$VendorExpSecOpt = addslashes(trim($_POST['VendorExpSecOpt']));
$EmpStatus = addslashes(trim($_POST['EmpStatus']));
$EmpScheme = addslashes(trim($_POST['EmpScheme']));
$EsicNo = addslashes(trim($_POST['EsicNo']));
$BdmCheckpoint = addslashes(trim($_POST['BdmCheckpoint']));
$EmpAppDashboard = addslashes(trim($_POST['EmpAppDashboard']));
$CashHandover = addslashes(trim($_POST['CashHandover']));

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

$randno4 = rand(1,100);
$src4 = $_FILES['DeclarationPdf']['tmp_name'];
$fnm4 = substr($_FILES["DeclarationPdf"]["name"], 0,strrpos($_FILES["DeclarationPdf"]["name"],'.')); 
$fnm4 = str_replace(" ","_",$fnm4);
$ext4 = substr($_FILES["DeclarationPdf"]["name"],strpos($_FILES["DeclarationPdf"]["name"],"."));
$dest4 = '../../uploads/'. $randno4 . "_".$fnm4 . $ext4;
$imagepath4 =  $randno4 . "_".$fnm4 . $ext4;
if(move_uploaded_file($src4, $dest4))
{
$DeclarationPdf = $imagepath4 ;
} 
else{
	$DeclarationPdf = $_POST['OldDeclarationPdf'];
}

$randno5 = rand(1,100);
$src5 = $_FILES['DeclarationPhoto']['tmp_name'];
$fnm5 = substr($_FILES["DeclarationPhoto"]["name"], 0,strrpos($_FILES["DeclarationPhoto"]["name"],'.')); 
$fnm5 = str_replace(" ","_",$fnm5);
$ext5 = substr($_FILES["DeclarationPhoto"]["name"],strpos($_FILES["DeclarationPhoto"]["name"],"."));
$dest5 = '../../uploads/'. $randno5 . "_".$fnm5 . $ext5;
$imagepath5 =  $randno5 . "_".$fnm5 . $ext5;
if(move_uploaded_file($src5, $dest5))
{
$DeclarationPhoto = $imagepath5 ;
} 
else{
	$DeclarationPhoto = $_POST['OldDeclarationPhoto'];
}


$paymentData = [];

for ($i = 1; $i <= 6; $i++) {
    $paymentData[$i] = [
        'FamilyName'   => addslashes(trim($_POST["FamilyName$i"] ?? '')),
        'FamilyMobile'  => addslashes(trim($_POST["FamilyMobile$i"] ?? '')),
        'EmpRelation'   => addslashes(trim($_POST["EmpRelation$i"] ?? '')),
        'FamilyDob'  => addslashes(trim($_POST["FamilyDob$i"] ?? '')),
        'FamilyResident'     => addslashes(trim($_POST["FamilyResident$i"] ?? '')),
        'FamilyCity'     => addslashes(trim($_POST["FamilyCity$i"] ?? '')),
        'FamilyState'     => addslashes(trim($_POST["FamilyState$i"] ?? '')),
    ];
}

$updateFields = [];

foreach ($paymentData as $i => $data) {
    $updateFields[] = "FamilyName$i='{$data['FamilyName']}'";
    $updateFields[] = "FamilyMobile$i='{$data['FamilyMobile']}'";
    $updateFields[] = "EmpRelation$i='{$data['EmpRelation']}'";
    $updateFields[] = "FamilyDob$i='{$data['FamilyDob']}'";
    $updateFields[] = "FamilyResident$i='{$data['FamilyResident']}'";
    $updateFields[] = "FamilyCity$i='{$data['FamilyCity']}'";
    $updateFields[] = "FamilyState$i='{$data['FamilyState']}'";
}

 $updateString = implode(', ', $updateFields);
 
$UnderFrId = addslashes(trim($_POST['UnderFrId']));
$sql55 = "SELECT ZoneId FROM tbl_users WHERE id='$UnderFrId'";
$row55 = getRecord($sql55);
$ZoneId = $row55['ZoneId'];

$tempDir = '../../barcodes/'; 

if($id == ''){
    $sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone' AND Roll NOT IN(1,5,55,9,22,23,63)";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
    if($pageval == 'lead'){
       echo "<script>alert('Phone No Already Exists!');window.location.href='../add-sales-lead-manager.php';</script>";  
     }
    else if($pageval == 'flexi'){
    echo "<script>alert('Phone No Already Exists!');window.location.href='../add-flexi-manager.php';</script>";
    }
    else if($pageval == 'service'){
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-service-manager.php';</script>";   
    }
    else{
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-employee.php';</script>";
    }
 }   
 else{
$sql = "INSERT INTO tbl_users SET CashHandover='$CashHandover',InternshipEmp='$InternshipEmp',EmpAppDashboard='$EmpAppDashboard',AssignFranchiseBdm='$AssignFranchiseBdm',BdmCheckpoint='$BdmCheckpoint',EsicNo='$EsicNo',EmpScheme='$EmpScheme',EmpStatus='$EmpStatus',VendorExpSecOpt='$VendorExpSecOpt',MarkAttendance='$MarkAttendance',PettyCash='$PettyCash',PettyAmount='$PettyAmount',ReferId='$ReferId',IncrementPer='$IncrementPer',Increment='$Increment',AnniversaryDate='$AnniversaryDate',UnderByBdm='$UnderByBdm',ApproveBy='$ApproveBy',ReJoinDate='$ReJoinDate',YearlyWeekOff='$YearlyWeekOff',MonthlyWeekOff='$MonthlyWeekOff',NsoVedPay='$NsoVedPay',AssignFranchiseVedExp='$AssignFranchiseVedExp',AssignFranchiseAttendance='$AssignFranchiseAttendance',Education='$Education',UanNo='$UanNo',ReferName='$ReferName',ReferCode='$ReferCode',NoticePeriod='$NoticePeriod',OtherEmp='$OtherEmp',MgrCheckpoint='$MgrCheckpoint',DeclarationPhoto='$DeclarationPhoto',ZoneId='$ZoneId',MonthlySalary='$MonthlySalary',DeclarationPdf='$DeclarationPdf',NomineeName='$NomineeName',NomineeRelation='$NomineeRelation',NomineePhone='$NomineePhone',NomineeAadharNo='$NomineeAadharNo',RefPhone='$RefPhone',RefPhone2='$RefPhone2',RefEmailId='$RefEmailId',zone='$zone',CocoFranchiseAccess='$CocoFranchiseAccess',SalaryType='$SalaryType',CreditSalaryStatus='$CreditSalaryStatus',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='$Roll',CreatedDate='$CreatedDate',CreatedBy='$user_id',GstNo='$GstNo',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',PanNo='$PanNo',Options2='$Options2',CompId='$CompId',BranchId='$BranchId',FatherPhone='$FatherPhone',Designation='$Designation',Dob='$Dob',AadharNo='$AadharNo',BloodGroup='$BloodGroup',JoinDate='$JoinDate',EmailId2='$EmailId2',PerDaySalary='$PerDaySalary',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',UnderUser='$UnderUser',ReportingMgr='$ReportingMgr',ResignStatus='$ResignStatus',ResignDate='$ResignDate',ResignComment='$ResignComment',UnderFrId='$UnderFrId',ExpCatId='$ExpCatId',MainBrEmp='$MainBrEmp',UnderByUser='$UnderByUser',$updateString";
$conn->query($sql);
$EmpId = mysqli_insert_id($conn);

 $sql2 = "INSERT INTO tbl_bank_details SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',Status='1',CreatedBy='$user_id',CreatedDate='$CreatedDate',userid='$EmpId',type=1";
    $conn->query($sql2);

if (isset($_FILES['Files'])) {
    $errors = array();
    foreach ($_FILES['Files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $key . $_FILES['Files']['name'][$key];
        $file_size = $_FILES['Files']['size'][$key];
        $file_tmp = $_FILES['Files']['tmp_name'][$key];
        $file_type = $_FILES['Files']['type'][$key];
        $FileName = $_FILES['Files']['name'][$key];
        
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }
        if ($file_name == '0' || $file_size == '0') {} else {
             $query = "INSERT into tbl_user_files SET UserId='$EmpId',Files='$file_name',FileName='$FileName'";
            $desired_dir = "../../uploads/";
            if (empty($errors) == true) {
                if (is_dir($desired_dir) == false) {
                    mkdir("$desired_dir", 0700); // Create directory if it does not exist
                }
                if (is_dir("$desired_dir/" . $file_name) == false) {
                    move_uploaded_file($file_tmp, "../../uploads/" . $file_name);
                } else {
                    // rename the file if another one exist
                    $new_dir = "../../uploads/" . $file_name . time();
                    rename($file_tmp, $new_dir);
                }
                $conn->query($query);
            } else {
                print_r($errors);
            }
        }
        if (empty($error)) {
           
           
        }
    }
}

if (isset($_FILES['Files2'])) {
    $errors = array();
    foreach ($_FILES['Files2']['tmp_name'] as $key => $tmp_name) {
        $file_name = $key . $_FILES['Files2']['name'][$key];
        $file_size = $_FILES['Files2']['size'][$key];
        $file_tmp = $_FILES['Files2']['tmp_name'][$key];
        $file_type = $_FILES['Files2']['type'][$key];
        $FileName = $_FILES['Files2']['name'][$key];
        
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }
        if ($file_name == '0' || $file_size == '0') {} else {
             $query = "INSERT into tbl_user_files2 SET UserId='$EmpId',Files='$file_name',FileName='$FileName'";
            $desired_dir = "../../uploads/";
            if (empty($errors) == true) {
                if (is_dir($desired_dir) == false) {
                    mkdir("$desired_dir", 0700); // Create directory if it does not exist
                }
                if (is_dir("$desired_dir/" . $file_name) == false) {
                    move_uploaded_file($file_tmp, "../../uploads/" . $file_name);
                } else {
                    // rename the file if another one exist
                    $new_dir = "../../uploads/" . $file_name . time();
                    rename($file_tmp, $new_dir);
                }
                $conn->query($query);
            } else {
                print_r($errors);
            }
        }
        if (empty($error)) {
           
           
        }
    }
}



$sql3 = "INSERT INTO customer_address SET UserId='$EmpId',Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate'";
$conn->query($sql3);

$filename = $EmpId.".png";
$codeContents = $Phone;
QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
$Barcode = $filename;

$CustomerId = "MH".$EmpId;
$sql3 = "UPDATE tbl_users SET Barcode='$Barcode',CustomerId='$CustomerId' WHERE id='$EmpId'";
$conn->query($sql3);

if($pageval == 'lead'){
echo "<script>alert('Record Created Successfully!');window.location.href='../view-sales-lead-manager.php';</script>";
}
else if($pageval == 'flexi'){
echo "<script>alert('Record Created Successfully!');window.location.href='../view-flexi-manager.php';</script>";
}
else if($pageval == 'service'){
echo "<script>alert('Record Created Successfully!');window.location.href='../view-service-manager.php';</script>";
}
else{
  echo "<script>alert('Record Created Successfully!');window.location.href='../view-employee.php';</script>";
}
}
}
else{
     /*$sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone' AND id!='$id' AND Roll NOT IN(1,5,55,9,22,23,63)";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){
    if($pageval == 'lead'){
       echo "<script>alert('Phone No Already Exists!');window.location.href='../add-sales-lead-manager.php?id=$id';</script>";  
     }
    else if($pageval == 'flexi'){
    echo "<script>alert('Phone No Already Exists!');window.location.href='../add-flexi-manager.php?id=$id';</script>";
    }
    else if($pageval == 'service'){
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-service-manager.php?id=$id';</script>";   
    }
    else{
     echo "<script>alert('Phone No Already Exists!');window.location.href='../add-employee.php?id=$id';</script>";
    }
 }  
 else{*/
     $filename = $id.".png";
$codeContents = $Phone;
QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
$Barcode = $filename;

$sql = "UPDATE tbl_users SET InternshipEmp='$InternshipEmp',AssignFranchiseBdm='$AssignFranchiseBdm',BdmCheckpoint='$BdmCheckpoint',EsicNo='$EsicNo',EmpScheme='$EmpScheme',ReferId='$ReferId',IncrementPer='$IncrementPer',Increment='$Increment',AnniversaryDate='$AnniversaryDate',UnderByBdm='$UnderByBdm',ApproveBy='$ApproveBy',ReJoinDate='$ReJoinDate',YearlyWeekOff='$YearlyWeekOff',MonthlyWeekOff='$MonthlyWeekOff',NsoVedPay='$NsoVedPay',AssignFranchiseVedExp='$AssignFranchiseVedExp',AssignFranchiseAttendance='$AssignFranchiseAttendance',Education='$Education',UanNo='$UanNo',ReferName='$ReferName',ReferCode='$ReferCode',NoticePeriod='$NoticePeriod',OtherEmp='$OtherEmp',MgrCheckpoint='$MgrCheckpoint',DeclarationPhoto='$DeclarationPhoto',ZoneId='$ZoneId',MonthlySalary='$MonthlySalary',DeclarationPdf='$DeclarationPdf',NomineeName='$NomineeName',NomineeRelation='$NomineeRelation',NomineePhone='$NomineePhone',NomineeAadharNo='$NomineeAadharNo',RefPhone='$RefPhone',RefPhone2='$RefPhone2',RefEmailId='$RefEmailId',zone='$zone',CocoFranchiseAccess='$CocoFranchiseAccess',SalaryType='$SalaryType',CreditSalaryStatus='$CreditSalaryStatus',Barcode='$Barcode',Fname='$Fname',Mname='$Mname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',Phone2='$Phone2',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',Address='$Address',Pincode='$Pincode',Status='$Status',Photo='$Photo',Roll='$Roll',ModifiedDate='$CreatedDate',ModifiedBy='$user_id',GstNo='$GstNo',Photo2='$Photo2',Photo3='$Photo3',Details='$Details',CatId='$CatId',PanNo='$PanNo',CompId='$CompId',BranchId='$BranchId',FatherPhone='$FatherPhone',Designation='$Designation',Dob='$Dob',AadharNo='$AadharNo',BloodGroup='$BloodGroup',JoinDate='$JoinDate',EmailId2='$EmailId2',PerDaySalary='$PerDaySalary',AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',UnderUser='$UnderUser',ReportingMgr='$ReportingMgr',ResignStatus='$ResignStatus',ResignDate='$ResignDate',ResignComment='$ResignComment',UnderFrId='$UnderFrId',ExpCatId='$ExpCatId',MainBrEmp='$MainBrEmp',UnderByUser='$UnderByUser',$updateString ";
if($user_id == 2651 || $user_id == 2650 || $user_id == 5 || $user_id == 415){
$sql.=",PettyCash='$PettyCash',PettyAmount='$PettyAmount',Options2='$Options2'";
}
if($user_id == 2651 || $user_id == 2650){
   $sql.=",CashHandover='$CashHandover',EmpAppDashboard='$EmpAppDashboard',EmpStatus='$EmpStatus',VendorExpSecOpt='$VendorExpSecOpt',MarkAttendance='$MarkAttendance'";
} 
$sql.=" WHERE id='$id'";
$conn->query($sql);


$sql3 = "UPDATE customer_address SET Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$CreatedDate' WHERE UserId='$id'";
$conn->query($sql3);


if (isset($_FILES['Files'])) {
    $errors = array();
    foreach ($_FILES['Files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $key . $_FILES['Files']['name'][$key];
        $file_size = $_FILES['Files']['size'][$key];
        $file_tmp = $_FILES['Files']['tmp_name'][$key];
        $file_type = $_FILES['Files']['type'][$key];
        $FileName = $_FILES['Files']['name'][$key];
        
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }
        if ($file_name == '0' || $file_size == '0') {} else {
             $query = "INSERT into tbl_user_files SET UserId='$id',Files='$file_name',FileName='$FileName'";
            $desired_dir = "../../uploads/";
            if (empty($errors) == true) {
                if (is_dir($desired_dir) == false) {
                    mkdir("$desired_dir", 0700); // Create directory if it does not exist
                }
                if (is_dir("$desired_dir/" . $file_name) == false) {
                    move_uploaded_file($file_tmp, "../../uploads/" . $file_name);
                } else {
                    // rename the file if another one exist
                    $new_dir = "../../uploads/" . $file_name . time();
                    rename($file_tmp, $new_dir);
                }
                $conn->query($query);
            } else {
                print_r($errors);
            }
        }
        if (empty($error)) {
           
           
        }
    }
}

if (isset($_FILES['Files2'])) {
    $errors = array();
    foreach ($_FILES['Files2']['tmp_name'] as $key => $tmp_name) {
        $file_name = $key . $_FILES['Files2']['name'][$key];
        $file_size = $_FILES['Files2']['size'][$key];
        $file_tmp = $_FILES['Files2']['tmp_name'][$key];
        $file_type = $_FILES['Files2']['type'][$key];
        $FileName = $_FILES['Files2']['name'][$key];
        
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }
        if ($file_name == '0' || $file_size == '0') {} else {
             $query = "INSERT into tbl_user_files2 SET UserId='$id',Files='$file_name',FileName='$FileName'";
            $desired_dir = "../../uploads/";
            if (empty($errors) == true) {
                if (is_dir($desired_dir) == false) {
                    mkdir("$desired_dir", 0700); // Create directory if it does not exist
                }
                if (is_dir("$desired_dir/" . $file_name) == false) {
                    move_uploaded_file($file_tmp, "../../uploads/" . $file_name);
                } else {
                    // rename the file if another one exist
                    $new_dir = "../../uploads/" . $file_name . time();
                    rename($file_tmp, $new_dir);
                }
                $conn->query($query);
            } else {
                print_r($errors);
            }
        }
        if (empty($error)) {
           
           
        }
    }
}

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
if($pageval == 'lead'){
echo "<script>alert('Record Updated Successfully!');window.location.href='../view-sales-lead-manager.php';</script>";
}
else if($pageval == 'flexi'){
echo "<script>alert('Record Updated Successfully!');window.location.href='../view-flexi-manager.php';</script>";
}
else if($pageval == 'service'){
echo "<script>alert('Record Updated Successfully!');window.location.href='../view-service-manager.php';</script>";
}
else{
  echo "<script>alert('Record Updated Successfully!');window.location.href='../view-employee.php';</script>";
}
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

if($_POST['action'] == 'getReferDetails'){
$ReferCode = $_POST['ReferCode'];
$sql = "SELECT id,Fname,Phone,Phone2,EmailId FROM tbl_users WHERE CustomerId='$ReferCode'";
$row = getRecord($sql);
echo json_encode(array('id'=>$row['id'],'Fname'=>$row['Fname'],'Phone'=>$row['Phone'],'Phone2'=>$row['Phone2'],'EmailId'=>$row['EmailId']));
}


if($_POST['action'] == 'getEmpDetails'){
    $id = $_POST['id'];
    $sql = "SELECT tu.id,tu.Fname,tu.CustomerId,tu.MonthlySalary,tut.Name AS Designation FROM tbl_users tu 
            LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll WHERE tu.id='$id'";
    $row = getRecord($sql);
    echo json_encode($row);
}

if ($_POST['action'] == 'calAttendance') {
    $UserId = intval($_POST['UserId']);
    $month  = intval($_POST['month']);
    $year   = intval($_POST['year']);

    // Calculate first and last day of the month
    $startDate = date("Y-m-01", strtotime("$year-$month-01"));
    $endDate   = date("Y-m-t", strtotime("$year-$month-01"));

    // Total days in selected month
    $totalDays = date("t", strtotime("$year-$month-01"));

    // Get total present days
    $sqlPresent = "SELECT COUNT(*) as present 
                   FROM tbl_attendance 
                   WHERE CreatedDate >= '$startDate' 
                     AND CreatedDate <= '$endDate' 
                     AND UserId = '$UserId' 
                     AND Type = 2";
    $rowPresent = getRecord($sqlPresent);
    $totalPresent = $rowPresent['present'];

    // Calculate absent days
    $totalAbsent = $totalDays - $totalPresent;

    // Prepare response
    $response = [
        "total_days"    => $totalDays,
        "total_present" => $totalPresent,
        "total_absent"  => $totalAbsent
    ];

    echo json_encode($response);
}

