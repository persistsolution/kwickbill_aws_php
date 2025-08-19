<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Employee";
$Page = "Add-Employee";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Employee Account
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />

    <?php include_once 'header_script.php'; ?>
    <script src="ckeditor/ckeditor.js"></script>
</head>

<body>
   <style type="text/css">
    .password-tog-info {
        display: inline-block;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        position: absolute;
        right: 50px;
        top: 30px;
        text-transform: uppercase;
        z-index: 2;
    }

    fieldset legend {
        background: inherit;
        font-family: "Lato", sans-serif;
        color: #650812;
        font-size: 15px;
        left: 10px;
        padding: 0 10px;
        position: absolute;
        top: -12px;
        font-weight: 400;
        width: auto !important;
        border: none !important;
    }

    fieldset {
        background: #ffffff;
        border: 1px solid #4FAFB8;
        border-radius: 5px;
        margin: 20px 0 1px 0;
        padding: 20px;
        position: relative;
    }
    
    #loader {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.7);
    text-align: center;
    padding-top: 20%;
    font-size: 24px;
    font-weight: bold;
    color: #333;
}
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_users WHERE id='$id'";
$row7 = getRecord($sql7);
$row7['Options'] = explode(',', $row7['Options2']);
$row7['ExpCatId'] = explode(',', $row7['ExpCatId']);
$row7['CocoFranchiseAccess'] = explode(',', $row7['CocoFranchiseAccess']);
$row7['AssignFranchiseAttendance'] = explode(',', $row7['AssignFranchiseAttendance']);
$row7['AssignFranchiseVedExp'] = explode(',', $row7['AssignFranchiseVedExp']);
$row7['zone'] = explode(',', $row7['zone']);
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Employee Account</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" action="ajax_files/ajax_employee.php" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                     <fieldset>
 <legend>Personal Detail</legend>
                                    <div class="form-row">
                                       
                                            <div class="form-group col-md-3">
    <label class="form-label">Aadhar Card No</label>
    <input type="text" name="AadharNo" class="form-control" id="AadharNo"
        placeholder="Enter 12-digit Aadhar No" maxlength="12" value="<?php echo $row7["AadharNo"]; ?>"
        oninput="checkAadharLength(this.value)">
    <div class="clearfix"></div>
</div>

<input type="hidden" id="ref_id">

<div class="form-group col-md-3">
    <label class="form-label">Aadhar Card OTP</label>
    <input type="text" name="AadharOtp" class="form-control" id="AadharOtp"
        placeholder="Enter 6-digit OTP" maxlength="6"
        oninput="checkOtpLength(this.value)">
    <div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
    <label class="form-label">PAN Card No</label>
    <input type="text" name="PanCardNo" class="form-control" id="PanCardNo"
        placeholder="Enter Pan Card No" value="<?php echo $row7["PanCardNo"]; ?>" oninput="checkPanCardLength(this.value)">
    <div class="clearfix"></div>
</div>



                                               
                                       <div class="form-group col-md-6">
                                            <label class="form-label">Employee Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Fname" id="Fname" class="form-control"
                                                placeholder="" value="<?php echo $row7["Fname"]; ?>"
                                                autocomplete="off">
                                        </div>

                                         <div class="form-group col-md-3">
                                            <label class="form-label">Education</label>
                                            <input type="text" name="Education" id="Education" class="form-control"
                                                placeholder="" value="<?php echo $row7["Education"]; ?>"
                                                autocomplete="off">
                                        </div>

                                         <div class="form-group col-md-3">
                                            <label class="form-label">UAN No </label>
                                            <input type="text" name="UanNo" id="UanNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["UanNo"]; ?>"
                                                autocomplete="off">
                                        </div>
                                        
                                         <div class="form-group col-md-4">
    <label class="form-label">Country <span class="text-danger">*</span></label>
    <select class="form-control" name="CountryId" id="CountryId" required="">
<option selected="" disabled="">Select Country</option>
    <?php 
      $q = "select * from tbl_country";
      $r = $conn->query($q);
      while($rw = $r->fetch_assoc())
      {
    ?>
      <option <?php if(1==$rw['id']){ ?> selected <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
    <?php } ?>
</select>
  </div>
  <div class="form-group col-md-4">
    <label class="form-label">State <span class="text-danger">*</span></label>
<select class="form-control" id="StateId" name="StateId" required="">
<option selected="" disabled="">Select State</option>
 <?php 
        $CountryId = $row7['CountryId'];
        $q = "select * from tbl_state WHERE CountryId='1' ORDER BY Name ASC";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
?>
                <option <?php if($row7['StateId']==$rw['id']){ ?> selected <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
              <?php } ?>
</select>
  </div>
  <div class="form-group col-md-4">
      <label class="form-label">City/District </label>
<select class="form-control" id="CityId" name="CityId">
<option selected="" disabled="">Select City/District</option>
  <?php 
 $StateId = $row7['StateId'];
        $q = "select * from tbl_city WHERE StateId='$StateId' ORDER BY Name ASC";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
?>
                <option <?php if($row7['CityId']==$rw['id']){ ?> selected <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
              <?php } ?>
</select>
  </div>

 <div class="form-group col-md-12">
                                            <label class="form-label">Permanent Address </label>
                                            <textarea name="Address" class="form-control" placeholder="Address" id="Address"
                                                autocomplete="off"><?php echo $row7["Address"]; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                    <div class="form-group col-md-3">
                                            <label class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="Password" id="Password" class="form-control"
                                                placeholder="Password" value="<?php echo $row7["Password"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                       <!-- <input type="hidden" name="Password" id="Password" class="form-control"
                                                placeholder="Password" value="12345">-->
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Mobile No <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="Phone" id="Phone" class="form-control"
                                                placeholder="Mobile No" value="<?php echo $row7["Phone"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Another Mobile No</label>
                                            <input type="text" name="Phone2" class="form-control"
                                                placeholder="Another Mobile No" value="<?php echo $row7["Phone2"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Email Id </label>
                                            <input type="email" name="EmailId" id="EmailId" class="form-control"
                                                placeholder="Email Id" value="<?php echo $row7["EmailId"]; ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <!--<div class="form-group col-md-2">
                                            <label class="form-label">Referral code </label>
                                            <input type="text" name="ReferCode" id="ReferCode" class="form-control"
                                                placeholder="" value="<?php echo $row7["ReferCode"]; ?>" oninput="checkReferDetails()">
                                            <div class="clearfix"></div>
                                        </div>-->
                                        
                                        <div class="form-group col-md-3">
<label class="form-label"> Referral code</label>
 <select class="select2-demo form-control" name="ReferCode" id="ReferCode" onchange="checkReferDetails(this.value)">
<option selected="" value="0">No Refer</option>

<optgroup label="Referral User">
 <?php 
  $sql12 = "SELECT id,Fname,CustomerId FROM tbl_users WHERE Status='1' AND CustomerId!=''";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["ReferCode"] == $result['CustomerId']) {?> selected <?php } ?> value="<?php echo $result['CustomerId'];?>">
    <?php echo $result['Fname']." (".$result['CustomerId'].")"; ?></option>
<?php } ?>
</optgroup>
</select>
<div class="clearfix"></div>
</div>
                                        
                                       
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Referral Name </label>
                                            <input type="text" name="ReferName" id="ReferName" class="form-control"
                                                placeholder="" value="<?php echo $row7["ReferName"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Reference Mobile No </label>
                                            <input type="text" name="RefPhone" id="RefPhone" class="form-control"
                                                placeholder="Mobile No" value="<?php echo $row7["RefPhone"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Reference Mobile No 2</label>
                                            <input type="text" name="RefPhone2" id="RefPhone2" class="form-control"
                                                placeholder="Another Mobile No" value="<?php echo $row7["RefPhone2"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        <input type="hidden" id="ReferId" name="ReferId" value="<?php echo $row7["ReferId"]; ?>">
                                        
                                       <!-- <div class="form-group col-md-3">
                                            <label class="form-label"> Father/Mother Contact No</label>
                                            <input type="text" name="FatherPhone" class="form-control"
                                                placeholder="" value="<?php echo $row7["FatherPhone"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>-->
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Reference Email Id </label>
                                            <input type="email" name="RefEmailId" id="RefEmailId" class="form-control"
                                                placeholder="Email Id" value="<?php echo $row7["RefEmailId"]; ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Defclartion Form Pdf</label>
                                            <label class="custom-file">
                                                <input type="file" class="custom-file-input" name="DeclarationPdf"
                                                    style="opacity: 1;">
                                                <input type="hidden" name="OldDeclarationPdf"
                                                    value="<?php echo $row7['DeclarationPdf'];?>" id="OldDeclarationPdf">
                                                <span class="custom-file-label"></span>
                                            </label>
                                            <?php if($row7['DeclarationPdf']=='') {} else{?>
                                            <span id="show_photo">
                                                <div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a
                                                        href="javascript:void(0)"
                                                        class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white"
                                                        id="delete_photo"></a><a href="../uploads/<?php echo $row7['DeclarationPdf'];?>"><?php echo $row7['DeclarationPdf'];?></a></div>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">Defclartion Form Photo </label>
                                            <label class="custom-file">
                                                <input type="file" class="custom-file-input" name="DeclarationPhoto"
                                                    style="opacity: 1;">
                                                <input type="hidden" name="OldDeclarationPhoto"
                                                    value="<?php echo $row7['DeclarationPhoto'];?>" id="OldDeclarationPhoto">
                                                <span class="custom-file-label"></span>
                                            </label>
                                            <?php if($row7['DeclarationPhoto']=='') {} else{?>
                                            <span id="show_photo">
                                                <div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a
                                                        href="javascript:void(0)"
                                                        class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white"
                                                        id="delete_photo"></a><img
                                                        src="../uploads/<?php echo $row7['DeclarationPhoto'];?>" alt=""
                                                        class="img-fluid ticket-file-img"
                                                        style="width: 64px;height: 64px;"></div>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        
                                                                               
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Nominee Name </label>
                                            <input type="text" name="NomineeName" id="NomineeName" class="form-control"
                                                placeholder="Nominee Name" value="<?php echo $row7["NomineeName"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Nominee Relation</label>
                                            <input type="text" name="NomineeRelation" class="form-control"
                                                placeholder="Nominee Relation" value="<?php echo $row7["NomineeRelation"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       <div class="form-group col-md-3">
                                            <label class="form-label"> Nominee Contact No</label>
                                            <input type="number" name="NomineePhone" class="form-control"
                                                placeholder="" value="<?php echo $row7["NomineePhone"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Nominee Aadhar Card No </label>
                                            <input type="text" name="NomineeAadharNo" id="NomineeAadharNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["NomineeAadharNo"]; ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Department</label>
                                            
                                             <select class="form-control" name="Designation" id="Designation">
                                                <option selected="" disabled="">Select Department</option>
                                                <?php 
                                        $q = "select * from tbl_departments WHERE Status=1 ORDER BY Name";
                                        $r = $conn->query($q);
                                        while($rw = $r->fetch_assoc())
                                    {
                                ?>
                                                <option <?php if($row7['Designation']==$rw['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            
                                          
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       <div class="form-group col-md-2">
                                            <label class="form-label">Date Of Birth</label>
                                            <input type="date" name="Dob" class="form-control" id="Dob"
                                                placeholder="" value="<?php echo $row7["Dob"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Marriage Anniversary</label>
                                            <input type="date" name="AnniversaryDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["AnniversaryDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Blood Group</label>
                                            <input type="text" name="BloodGroup" class="form-control"
                                                placeholder="" value="<?php echo $row7["BloodGroup"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        

                                            <div class="form-group col-md-3">
                                            <label class="form-label">Date Of Joining</label>
                                            <input type="date" name="JoinDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["JoinDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       
                                        
                                        <!--<div class="form-group col-md-3">
                                            <label class="form-label">Company Email Id </label>
                                            <input type="email" name="EmailId2" id="EmailId2" class="form-control"
                                                placeholder="Email Id" value="<?php echo $row7["EmailId2"]; ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>-->

                                        
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Salary Type <span class="text-danger">*</span></label>
                                            <select class="form-control" id="SalaryType" name="SalaryType" required="" onchange="getMonthSal(this.value,document.getElementById('PerDaySalary').value)">
                                                <option selected="" disabled="" value="">Select</option>
                                                <option value="1" <?php if($row7["SalaryType"]=='1') {?> selected
                                                    <?php } ?>>Daily Basis</option>
                                                <option value="2" <?php if($row7["SalaryType"]=='2') {?> selected
                                                    <?php } ?>>Fixed</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Per Day Salary <span class="text-danger">*</span></label>
                                            <input type="text" name="PerDaySalary" id="PerDaySalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["PerDaySalary"]; ?>" oninput="getMonthSal(document.getElementById('SalaryType').value,document.getElementById('PerDaySalary').value)"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Monthly Salary <span class="text-danger">*</span></label>
                                            <input type="text" name="MonthlySalary" id="MonthlySalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["MonthlySalary"]; ?>" 
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Credit Salary Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="CreditSalaryStatus" name="CreditSalaryStatus" required="">
                                               <option selected="" disabled="" value="">Select Status</option>
                                                <option value="1" <?php if($row7["CreditSalaryStatus"]=='1') {?> selected
                                                    <?php } ?>>Active</option>
                                                <option value="0" <?php if($row7["CreditSalaryStatus"]=='0') {?> selected
                                                    <?php } ?>>Inactive</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Yearly Week Off <span class="text-danger">*</span></label>
                                            <input type="text" name="YearlyWeekOff" id="YearlyWeekOff" class="form-control"
                                                placeholder="" value="<?php echo $row7["YearlyWeekOff"]; ?>" oninput="getMonthWeekOff(document.getElementById('YearlyWeekOff').value)"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Monthly Week Off <span class="text-danger">*</span></label>
                                            <input type="text" name="MonthlyWeekOff" id="MonthlyWeekOff" class="form-control"
                                                placeholder="" value="<?php echo $row7["MonthlyWeekOff"]; ?>" 
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Date Of Re-Joining</label>
                                            <input type="date" name="ReJoinDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ReJoinDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Approve By</label>
                                            <input type="text" name="ApproveBy" class="form-control"
                                                placeholder="" value="<?php echo $row7["ApproveBy"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        

                                        


                                        <div class="form-group col-md-12">
                                            <label class="form-label">Photo </label>
                                            <label class="custom-file">
                                                <input type="file" class="custom-file-input" name="Photo"
                                                    style="opacity: 1;">
                                                <input type="hidden" name="OldPhoto"
                                                    value="<?php echo $row7['Photo'];?>" id="OldPhoto">
                                                <span class="custom-file-label"></span>
                                            </label>
                                            <?php if($row7['Photo']=='') {} else{?>
                                            <span id="show_photo">
                                                <div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a
                                                        href="javascript:void(0)"
                                                        class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white"
                                                        id="delete_photo"></a><img
                                                        src="../uploads/<?php echo $row7['Photo'];?>" alt=""
                                                        class="img-fluid ticket-file-img"
                                                        style="width: 64px;height: 64px;"></div>
                                            </span>
                                            <?php } ?>
                                        </div>



<div class="form-group col-md-12">
   <label class="form-label">Image/Files (Multiple) <span class="text-danger">(File size must be less than 2 MB)</span></label>
<label class="custom-file">
<input type="file" class="custom-file-input" id="Photo2" name="Files[]" style="opacity: 1;" multiple="">
<span class="custom-file-label"></span>
</label>
 <span id="show_photo2">
<?php 
  $id = $_GET['id'];
  $sql2 = "SELECT * FROM tbl_user_files WHERE UserId='$id'";
  $res2 = $conn->query($sql2);
  $rncnt = mysqli_num_rows($res2);
  if($rncnt > 0){
    while($row2 = $res2->fetch_assoc()){?>
    <input type="hidden" name="OldMulImage" id="OldMulImage<?php echo $row2["id"]; ?>" value="<?php echo $row2["Files"]; ?>">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" onclick="delete_photo2(<?php echo $row2["id"]; ?>,<?php echo $_GET["id"]; ?>)"></a><img src="../uploads/<?php echo $row2['Files'];?>" alt="" class="img-fluid ticket-file-img" style="width: 64px;height: 64px;"></div>
<?php }} ?>
</span>
</div>

<div class="form-group col-md-12">
   <label class="form-label">Attach Files (Multiple) <span class="text-danger">(File size must be less than 2 MB)</span></label>
<label class="custom-file">
<input type="file" class="custom-file-input" id="Files2" name="Files2[]" style="opacity: 1;" multiple="">
<span class="custom-file-label"></span>
</label>
 <span id="show_photo2">
<?php 
  $id = $_GET['id'];
  $sql2 = "SELECT * FROM tbl_user_files2 WHERE UserId='$id'";
  $res2 = $conn->query($sql2);
  $rncnt = mysqli_num_rows($res2);
  if($rncnt > 0){
    while($row2 = $res2->fetch_assoc()){?>
    <input type="hidden" name="OldMulImage" id="OldMulImage<?php echo $row2["id"]; ?>" value="<?php echo $row2["Files"]; ?>">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" onclick="delete_photo2(<?php echo $row2["id"]; ?>,<?php echo $_GET["id"]; ?>)"></a>
<a href="../uploads/<?php echo $row2['Files'];?>">View File</a></div>
<?php }} ?>
</span>
</div>
                                     
                                       

                                       
   

</div>

                                   
                                       

<div class="row">

<div class="form-group col-md-3">
                                            <label class="form-label">Designation </label>
                                            <select class="form-control" name="Roll" id="Roll">
                                                <option selected="" disabled="">Select Designation</option>
                                                <?php 
                                        $q = "select * from tbl_user_type WHERE Status=1 ORDER BY Name";
                                        $r = $conn->query($q);
                                        while($rw = $r->fetch_assoc())
                                    {
                                ?>
                                                <option <?php if($row7['Roll']==$rw['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Head Office Employee <span class="text-danger">*</span></label>
                                            <select class="form-control" id="MainBrEmp" name="MainBrEmp" required="">
                                                <option selected="" disabled="" value="">Select</option>
                                                <option value="1" <?php if($row7["MainBrEmp"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                                <option value="0" <?php if($row7["MainBrEmp"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="Status" name="Status" required="">
                                                <option selected="" disabled="" value="">Select Status</option>
                                                <option value="1" <?php if($row7["Status"]=='1') {?> selected
                                                    <?php } ?>>Active</option>
                                                <option value="0" <?php if($row7["Status"]=='0') {?> selected
                                                    <?php } ?>>Inctive</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Reporting Manager <span class="text-danger">*</span></label>
                                            <select class="form-control" id="ReportingMgr" name="ReportingMgr" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="0" <?php if($row7["ReportingMgr"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["ReportingMgr"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>


                                         <!--<div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="ReportingMgr" value="1" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label">Reporting Manager</span>
                                </label>
                                        </div>-->

                                    
                                    
                                    
                                    <div class="form-group col-md-4">
<label class="form-label"> Under By Reporting Manager</label>
 <select class="select2-demo form-control" name="UnderUser" id="UnderUser">
<option selected="" value="0">No Reporting Manager</option>
<option value="5" <?php if($row7["UnderByUser"] == 5) {?> selected <?php } ?>>Pradeep Kulkarni (Admin)</option>
<optgroup label="Reporting Manager">
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND ReportingMgr=1";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["UnderUser"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</optgroup>
</select>
<div class="clearfix"></div>
</div>

 <div class="form-group col-md-4">
<label class="form-label"> Under By </label>
 <select class="select2-demo form-control" name="UnderByUser" id="UnderByUser">
<option selected="" value="0">No One</option>
<option value="5" <?php if($row7["UnderByUser"] == 5) {?> selected <?php } ?>>Pradeep Kulkarni (Admin)</option>
<optgroup label="Under BY">
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["UnderByUser"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</optgroup>
</select>
<div class="clearfix"></div>
</div>

 
                                    <div class="form-group col-md-4">
<label class="form-label"> Under By BDM</label>
 <select class="select2-demo form-control" name="UnderByBdm" id="UnderByBdm">
<option selected="" value="0">No BDM</option>
<optgroup label="BDM">
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll IN (134,145,181,183)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["UnderByBdm"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</optgroup>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label"> Under By Franchise</label>
 <select class="select2-demo form-control" name="UnderFrId" id="UnderFrId">
<option selected="" value="0">Select Franchise</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["UnderFrId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>

</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
                                            <label class="form-label">Expenses Approval</label>
                                            <select class="form-control" id="ExpApproval" name="ExpApproval">
                                                <option selected="" disabled="" value="">Select</option>
                                                <option value="1" <?php if($row7["ExpApproval"]=='1') {?> selected
                                                    <?php } ?>>One Way Expenses Approval</option>
                                                <option value="2" <?php if($row7["ExpApproval"]=='2') {?> selected
                                                    <?php } ?>>Two Way Expenses Approval</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Manager Checkpoint </label>
                                            <select class="form-control" id="MgrCheckpoint" name="MgrCheckpoint" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="0" <?php if($row7["MgrCheckpoint"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["MgrCheckpoint"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="form-label">Resign </label>
                                            <select class="form-control" id="ResignStatus" name="ResignStatus" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="0" <?php if($row7["ResignStatus"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["ResignStatus"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                          <div class="form-group col-md-3">
                                            <label class="form-label">Resign Date</label>
                                            <input type="date" name="ResignDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ResignDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Resign Comment</label>
                                            <input type="text" name="ResignComment" class="form-control"
                                                placeholder="" value="<?php echo $row7["ResignComment"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Notice Period</label>
                                            <input type="text" name="NoticePeriod" class="form-control"
                                                placeholder="e.g. 15 Days" value="<?php echo $row7["NoticePeriod"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">NSO Vendor Payment Show </label>
                                            <select class="form-control" id="NsoVedPay" name="NsoVedPay" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="0" <?php if($row7["NsoVedPay"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["NsoVedPay"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Increment </label>
                                            <select class="form-control" id="Increment" name="Increment" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="0" <?php if($row7["Increment"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["Increment"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Increment % </label>
                                            <select class="form-control" id="IncrementPer" name="IncrementPer" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                               <option value="0" <?php if($row7["IncrementPer"]=='0') {?> selected
                                                    <?php } ?>>0%</option>
                                                <option value="10" <?php if($row7["IncrementPer"]=='10') {?> selected
                                                    <?php } ?>>10%</option>
                                                    <option value="12" <?php if($row7["IncrementPer"]=='12') {?> selected
                                                    <?php } ?>>12%</option>
                                                <option value="15" <?php if($row7["IncrementPer"]=='15') {?> selected
                                                    <?php } ?>>15%</option>
                                                    
                                                <option value="20" <?php if($row7["IncrementPer"]=='20') {?> selected
                                                    <?php } ?>>20%</option>
                                                <option value="25" <?php if($row7["IncrementPer"]=='25') {?> selected
                                                    <?php } ?>>25%</option>
                                                <option value="33" <?php if($row7["IncrementPer"]=='33') {?> selected
                                                    <?php } ?>>33%</option>
                                                <option value="45" <?php if($row7["IncrementPer"]=='45') {?> selected
                                                    <?php } ?>>45%</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <?php if($user_id == 5 || $user_id == 415 || $user_id == 2650 || $user_id == 2651){?>
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Petty Cash </label>
                                            <select class="form-control" id="PettyCash" name="PettyCash" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="No" <?php if($row7["PettyCash"]=='No') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="Yes" <?php if($row7["PettyCash"]=='Yes') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Petty Cash Amount</label>
                                            <input type="number" name="PettyAmount" class="form-control"
                                                placeholder="e.g. 5000" value="<?php echo $row7["PettyAmount"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php } ?>
                                        
                                         <div class="form-group col-md-12">
                                            <label class="form-label">Details </label>
                                            <textarea name="Details" class="form-control" placeholder="Details"
                                                autocomplete="off"><?php echo $row7["Details"]; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>

</div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Dashboard </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(1,2,3) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    <?php if($user_id == 2651 || $user_id == 2650){?>
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Only For Admin </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(4,5,6,7,8,76) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } } ?>
                                    
                                     <div class="form-group col-md-12">
                                            <label class="form-label">All Expenses (For Employee) </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(9,12,13,15,16) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Other Access </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(75,85,19,29,30,31,32,33,34,35,36,37,39,49,50,51,60,61,62,74,75) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Reports </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(21,22,23,24,25,26,27,77,79,80,81,82,83,84,78) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                     <?php if($user_id == 2651 || $user_id == 2650){?>
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Admin Request </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(20,72,73,38) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php }} ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Account Request </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(28,63,17,18,47,48,87) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">HR Request </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(64,45,65,66,67) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Manager Request </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(44,46,68,69,70,71) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">Other Request </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(40,41,42,43) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group col-md-12">
                                            <label class="form-label">User Accounts </label>
                                            </div>
                                        <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(52,53,54,55,56,57,58,59) ";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>

<div class="form-group col-md-12">
                                            <label class="form-label">Action </label>
                                            </div>
                                    <?php  
                                        $sql33 = "SELECT * FROM tbl_option_cp WHERE id IN(10,11,14)";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="Options[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['Options'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                  
                                   <?php if($user_id == 2651 || $user_id == 2650){?>
                                  <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="MarkAttendance" value="1"<?php if($row7['MarkAttendance'] == 1){?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"> Anywhere</span>
                                </label>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="VendorExpSecOpt" value="1"<?php if($row7['VendorExpSecOpt'] == 1){?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"> Vendor Expense 2nd Option</span>
                                </label>
                                        </div>
                                        
                                        <?php } ?>
                                    </div>
                                    
                                    
                                    <!--<hr>
                                    
                                    <div class="row">
                                          <div class="form-group col-md-12">
                                       <label class="form-label">Expense Category </label>
    </div>
                                    <?php  
                                        $sql33 = "SELECT * FROM tbl_expenses_category WHERE Status=1";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="ExpCatId[]" value="<?php echo $result['id'];?>" <?php if(in_array($result["id"],$row7['ExpCatId'])) { ?>

                        checked="checked" <?php } ?>>
                                    <span class="custom-control-label"><?php echo $result['Name'];?></span>
                                </label>
                                        </div>
                                    <?php } ?>
                                    
                                  
                                    </div>-->
                                    
                                      </fieldset>
                                      
                                      <!--<fieldset>
 <legend>Assign Zone</legend>
<div class="form-row">               
<div class="form-group col-lg-12">
<label class="form-label">Zone <span class="text-danger">*</span></label>
<select class="select2-demo form-control" name="zone[]" id="zone[]" multiple>


 <?php 
  $sql12 = "SELECT * FROM tbl_zone";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if(in_array($result["id"],$row7['zone'])) { ?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Name'];?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

                            </div>  
                                     </fieldset>        -->   
                                     <fieldset>
 <legend>Assign Franchise For Attendace</legend>
<div class="form-row">               
                                    <div class="form-group col-lg-12">
                                     <select class="select2-demo form-control" name="AssignFranchiseAttendance[]" id="AssignFranchiseAttendance[]" multiple>
 <?php  
                                        $sql33 = "SELECT * FROM  tbl_users_bill WHERE Roll=5 AND Status=1";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
  <option <?php if(in_array($result["id"],$row7['AssignFranchiseAttendance'])) { ?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']; ?></option>
<?php } ?>
</optgroup>
</select>
</div>
</div>

                                   
                                     

                                     </fieldset>



 <fieldset>
 <legend>Assign Franchise For Vendor Expenses</legend>
 <div class="form-row">               
                                    <div class="form-group col-lg-12">
                                     <select class="select2-demo form-control" name="AssignFranchiseVedExp[]" id="AssignFranchiseVedExp[]" multiple>
 <?php  
                                        $sql33 = "SELECT * FROM  tbl_users_bill WHERE Roll=5 AND Status=1";
                                        $row33 = getList($sql33);
                                        foreach($row33 as $result){
                                        ?>
  <option <?php if(in_array($result["id"],$row7['AssignFranchiseVedExp'])) { ?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']; ?></option>
<?php } ?>
</optgroup>
</select>
</div>
</div>


                                    </fieldset>
                                    
<fieldset>
 <legend>Bank Account Detail</legend>
<div class="form-row">               
                                    
                                       <div class="form-group col-md-6">
<label class="form-label">Bank Holder Name </label>
<input type="text" name="AccountName" id="AccountName" class="form-control" placeholder="" value="<?php echo $row7["AccountName"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Bank Name </label>
<input type="text" name="BankName" id="BankName" class="form-control" placeholder="" value="<?php echo $row7["BankName"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Account No </label>
<input type="text" name="AccountNo" id="AccountNo" class="form-control" placeholder="" value="<?php echo $row7["AccountNo"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Branch </label>
<input type="text" name="Branch" id="Branch" class="form-control" placeholder="" value="<?php echo $row7["Branch"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">IFSC Code </label>
<input type="text" name="IfscCode" id="IfscCode" class="form-control" placeholder="" value="<?php echo $row7["IfscCode"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">UPI ID </label>
<input type="text" name="UpiNo" id="UpiNo" class="form-control" placeholder="" value="<?php echo $row7["UpiNo"]; ?>">
<div class="clearfix"></div>
</div>


<div class="form-group col-md-6">
                                            <label class="form-label">Other Employee <span class="text-danger">*</span></label>
                                            <select class="form-control" id="OtherEmp" name="OtherEmp" required="">
                                                
                                                <option value="0" <?php if($row7["OtherEmp"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["OtherEmp"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                                
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
 


                                    </div> 
                                     </fieldset>
                                     
                                     
                                    <fieldset>
    <legend>ESIC coverage</legend>
    <?php for ($i = 1; $i <= 6; $i++) { ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="form-label">Name Of the Family Member</label>
                <input type="text" name="FamilyName<?php echo $i;?>" class="form-control" value="<?php echo $row7['FamilyName'.$i]; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label">Mobile Of the Family Member</label>
                <input type="text" name="FamilyMobile<?php echo $i;?>" class="form-control" value="<?php echo $row7['FamilyMobile'.$i]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label">Relation With the Employee</label>
                <input type="text" name="EmpRelation<?php echo $i;?>" class="form-control" value="<?php echo $row7['EmpRelation'.$i]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label">DOB</label>
                <input type="date" name="FamilyDob<?php echo $i;?>" class="form-control" value="<?php echo $row7['FamilyDob'.$i]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label">Whether Resident With Him/Her</label>
                <input type="text" name="FamilyResident<?php echo $i;?>" class="form-control" value="<?php echo $row7['FamilyResident'.$i]; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="FamilyCity<?php echo $i;?>" class="form-control" value="<?php echo $row7['FamilyCity'.$i]; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label">State</label>
                <input type="text" name="FamilyState<?php echo $i;?>" class="form-control" value="<?php echo $row7['FamilyState'.$i]; ?>">
            </div>
        </div>

        <?php if ($i < 6) { ?>
            <hr style="border-top: 1px solid #999; margin: 20px 0;">
        <?php } ?>
    <?php } ?>
</fieldset>

                                     
                                    <!-- <button id="growl-default" class="btn btn-default">Default</button> -->
                                    <button type="submit" class="btn btn-primary btn-finish" id="submit">Save</button>
                                </form>
                            </div>
                        </div>






                    </div>


                    <?php include_once 'footer.php'; ?>
                </div>

            </div>

        </div>

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
<div id="loader">Please wait...</div>

    <?php include_once 'footer_script.php'; ?>

    <script type="text/javascript">
    function showLoader() {
    document.getElementById('loader').style.display = 'block';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
}

    function checkAadharLength(value) {
    if (value.length === 12) {
        showLoader();
        sentOtp();
    }
}

function checkOtpLength(value) {
    if (value.length === 6) {
        showLoader();
        otpVerify();
    }
}

function checkPanCardLength(value) {
    if (value.length === 10) {
        showLoader();
        sentPanOtp();
    }
}


function sentPanOtp() {
    var PanCardNo = $('#PanCardNo').val();
    var action = "panOtpVerify";

    if (PanCardNo.length !== 10) {
        alert("PAN number must be 10 digits");
        hideLoader();
        return;
    }

    $.ajax({
        url: "ajax_files/ajax_api.php",
        method: "POST",
        data: {
            action: action,
            PanCardNo: PanCardNo
        },
        dataType: "json",
        success: function(data) {
            console.log("Response:", data);
            hideLoader();
            
            if (data.type != 'validation_error') {
                if (data.registered_name) {
                    $('#Fname').val(data.registered_name);
                } else {
                    alert("PAN verified, but no registered name found.");
                }
            } else {
                alert("Failed to send OTP: " + (data.message || "Unknown error"));
            }
        },
        error: function(xhr, status, error) {
            hideLoader();
            console.error("AJAX Error:", error);
            alert("An error occurred while sending OTP. Please try again.");
        }
    });
}


    function sentOtp() {
    var AadharNo = $('#AadharNo').val();
    var action = "sentAadharOtp";
if (AadharNo.length !== 12) {
        alert("Aadhar number must be 12 digits");
        hideLoader();
        return;
    }
    else{
    $.ajax({
        url: "ajax_files/ajax_api.php",
        method: "POST",
        data: {
            action: action,
            AadharNo: AadharNo
        },
         beforeSend: function() {
                        $('#sent_aadhar_otp_verify').attr('disabled', 'disabled');
                        $('#sent_aadhar_otp_verify').text('Please Wait...');
                    },
        dataType: "json",  // ✅ Expect JSON
        success: function(data) {
            console.log(data);  // ✅ Shows the parsed object
            hideLoader();
 $('#sent_aadhar_otp_verify').attr('disabled', false);
                        $('#sent_aadhar_otp_verify').text('SENT OTP');
            if(data.status === 'SUCCESS') {
                $('#ref_id').val(data.ref_id);
                //alert("OTP sent! Ref ID: " + data.ref_id);
            } else {
                alert("Failed to send OTP: " + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
    }
}

 function otpVerify() {
    var AadharOtp = $('#AadharOtp').val();
    var ref_id = $('#ref_id').val();
    var action = "aadharOtpVerify";
 if (AadharOtp.length !== 6) {
        alert("OTP must be 6 digits");
        hideLoader();
        return;
    }
    else{
    $.ajax({
        url: "ajax_files/ajax_api.php",
        method: "POST",
        data: {
            action: action,
            AadharOtp: AadharOtp,
            ref_id: ref_id
        },
         beforeSend: function() {
                        $('#aadhar_otp_verify').attr('disabled', 'disabled');
                        $('#aadhar_otp_verify').text('Please Wait...');
                    },
        dataType: "json",
        success: function(data) {
            console.log("Response:", data);
            hideLoader();
 $('#aadhar_otp_verify').attr('disabled', false);
                        $('#aadhar_otp_verify').text('OTP Verify');
            if (data.status === "SUCCESS") {
                alert("✅ OTP verified successfully!\nRef ID: " + data.ref_id);
                // You can redirect or update UI here if needed
            } else if (data.status === "ERROR") {
                alert("❌ Verification failed: " + data.message);
            } else {
                $('#Address').val(data.address)
                $('#Fname').val(data.name);
                $('#EmailId').val(data.email);
                if (data.dob) {
    var parts = data.dob.split('-');
    if (parts.length === 3) {
        var formatted = parts[2] + '-' + parts[1] + '-' + parts[0];
        $('#Dob').val(formatted);
    }
}
                $('#NomineeName').val(data.care_of);
                //$('#').val(split_address.pincode);
                //alert("⚠ Unexpected response: " + JSON.stringify(data));
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            alert("❌ AJAX error: " + error);
        }
    });
    }
}


   function checkReferDetails(ReferCode) {
    //var ReferCode = $('#ReferCode').val();
    var action = "getReferDetails";

    $.ajax({
        url: "ajax_files/ajax_employee.php",
        method: "POST",
        data: {
            action: action,
            ReferCode: ReferCode
        },
        success: function(data) {
            var res = JSON.parse(data);
            $('#ReferId').val(res.id);
            $('#ReferName').val(res.Fname);
            $('#RefPhone').val(res.Phone);
            $('#RefPhone2').val(res.Phone2);
            $('#RefEmailId').val(res.EmailId);
        }
    });
}
    
    function getMonthWeekOff(val){
        var MonthlyWeekOff = Number(val)/12;
        $('#MonthlyWeekOff').val(Math.round(MonthlyWeekOff));
    }
    function getMonthSal(saltype,salary){
        if(saltype == 1){
            var MonthlySalary = Number(salary)*30;
            $('#MonthlySalary').val(MonthlySalary);
        }
        else{
            $('#MonthlySalary').val(salary);
        }
    }
    function myFunction2() {

        var x = document.getElementById("Password");
        if (x.type === "password") {
            x.type = "text";
            $('.show2').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        } else {
            x.type = "password";
            $('.show2').html('<i class="fa fa-eye" aria-hidden="true"></i>');
        }
    }

    function error_toast() {
        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $.growl.error({
            title: 'Error',
            message: 'Email Id / Phone No Already Exists',
            location: isRtl ? 'tl' : 'tr'
        });
    }

    function success_toast() {
        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $.growl.success({
            title: 'Success',
            message: 'Saved Successfully...',
            location: isRtl ? 'tl' : 'tr'
        });
    }
    $(document).ready(function() {
        //$(document).on("click", ".btn-finish", function(event){
        $('#validation-form').on('submit', function(e) {
            exit();
            e.preventDefault();
            if ($('#validation-form').valid()) {

                $.ajax({
                    url: "ajax_files/ajax_employee.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').text('Please Wait...');
                    },
                    success: function(data) {

                        if (data == 0) {
                            error_toast();

                        } else {
                            success_toast();
                            setTimeout(function() {
                                window.location.href = 'view-employee.php';
                            }, 2000);
                        }
                        $('#submit').attr('disabled', false);
                        $('#submit').text('Save');
                    }
                })



            } else {
                //$('#Fname').focus();
                return false;
            }
        });

        $(document).on("click", "#delete_photo", function(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to delete Profile Photo?")) {
                var action = "deletePhoto";
                var id = $('#userid').val();
                var Photo = $('#OldPhoto').val();
                $.ajax({
                    url: "ajax_files/ajax_employee.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id,
                        Photo: Photo
                    },
                    success: function(data) {

                        $('#show_photo').hide();
                        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr(
                            'dir') === 'rtl';
                        $.growl.success({
                            title: 'Success',
                            message: data,
                            location: isRtl ? 'tl' : 'tr'
                        });

                    }
                });
            }

        });
        $(document).on("change", "#CountryId", function(event) {
            var val = this.value;
            var action = "getState";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                    $('#StateId').html(data);
                }
            });

        });

        $(document).on("change", "#StateId", function(event) {
            var val = this.value;
            var action = "getCity";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                    $('#CityId').html(data);
                }
            });

        });
    });
    </script>
     <script>
        CKEDITOR.replace( 'editor1');
</script>
</body>

</html>