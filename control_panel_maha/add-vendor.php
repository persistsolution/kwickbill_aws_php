<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Vendors";
$Page = "Add-Vendors";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Vendor Account
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

?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Vendor Account</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" action="ajax_files/ajax_vendors.php" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <fieldset>
 <legend>Personal Detail</legend>
                                    <div class="form-row">
                                       <div class="form-group col-md-4 maindoc">
                                            <label class="form-label">GST No  </label> 
                                            <input type="text" name="GstNo" id="GstNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["GstNo"]; ?>" maxlength="15"
                                                autocomplete="off" oninput="checkGstNoLength(this.value)">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-8">
                                            <label class="form-label">Trade/Business Name <span
                                                    class="text-danger">*</span><span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="TradeName" id="TradeName" class="form-control"
                                                placeholder="" value="<?php echo $row7["TradeName"]; ?>"
                                                autocomplete="off" required>
                                        </div>
                                        
                                        
                                         <div class="form-group col-md-4">
    <label class="form-label">Aadhar Card No</label>
    <input type="text" name="AadharNo" class="form-control" id="AadharNo"
        placeholder="Enter 12-digit Aadhar No" maxlength="12" value="<?php echo $row7["AadharNo"]; ?>"
        oninput="checkAadharLength(this.value)">
    <div class="clearfix"></div>
</div>

<input type="hidden" id="ref_id">

<div class="form-group col-md-4">
    <label class="form-label">Aadhar Card OTP</label>
    <input type="text" name="AadharOtp" class="form-control" id="AadharOtp"
        placeholder="Enter 6-digit OTP" maxlength="6"
        oninput="checkOtpLength(this.value)">
    <div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
    <label class="form-label">PAN Card No</label>
    <input type="text" name="PanNo" class="form-control" id="PanCardNo"
        placeholder="Enter Pan Card No" value="<?php echo $row7["PanCardNo"]; ?>" oninput="checkPanCardLength(this.value)">
    <div class="clearfix"></div>
</div>
                                        
                                       <div class="form-group col-md-6">
                                            <label class="form-label">Vendor Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Fname" id="Fname" class="form-control"
                                                placeholder="" value="<?php echo $row7["Fname"]; ?>"
                                                autocomplete="off" required>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Type Of vendor <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="TypeOfVendor" id="TypeOfVendor" required>
                                                <option value="" selected>...</option>
                                                <?php 
                                                    $sql = "SELECT * FROM tbl_common_master WHERE Roll=1 AND Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){
                                                ?>
                                                <option value="<?php echo $result['id'];?>" <?php if($result['id'] == $row7["TypeOfVendor"]){?> selected <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Office Address <span class="text-danger">*</span></label>
                                            <textarea name="OfficeAddress" id="OfficeAddress" class="form-control" placeholder="Address"
                                                autocomplete="off" required><?php echo $row7["OfficeAddress"]; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>

                                        <!-- <div class="form-group col-md-4">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" name="Mname" id="Mname" class="form-control"
                                                placeholder="" value="<?php echo $row7["Mname"]; ?>"
                                                autocomplete="off">
                                        </div>

                                         <div class="form-group col-md-4">
                                            <label class="form-label">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Lname" id="Lname" class="form-control"
                                                placeholder="" value="<?php echo $row7["Lname"]; ?>"
                                                autocomplete="off">
                                        </div>-->

                                        <div class="form-group col-md-4">
                                            <label class="form-label">Email Id </label>
                                            <input type="email" name="EmailId" id="EmailId" class="form-control"
                                                placeholder="Email Id" value="<?php echo $row7["EmailId"]; ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- <div class="form-group col-md-6">
                                            <label class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="Password" id="Password" class="form-control"
                                                placeholder="Password" value="<?php echo $row7["Password"]; ?>">
                                            <div class="clearfix"></div>
                                        </div> -->
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Mobile No <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Phone" id="Phone" class="form-control"
                                                placeholder="Mobile No" value="<?php echo $row7["Phone"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Another Mobile No</label>
                                            <input type="text" name="Phone2" class="form-control"
                                                placeholder="Another Mobile No" value="<?php echo $row7["Phone2"]; ?>">
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

                                         <!-- <div class="form-group col-md-12">
                                            <label class="form-label">Logo 1 <span
                                                    class="text-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" class="custom-file-input" name="Photo2"
                                                    style="opacity: 1;">
                                                <input type="hidden" name="OldPhoto2"
                                                    value="<?php echo $row7['Photo2'];?>" id="OldPhoto2">
                                                <span class="custom-file-label"></span>
                                            </label>
                                            <?php if($row7['Photo2']=='') {} else{?>
                                            <span id="show_photo2">
                                                <div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a
                                                        href="javascript:void(0)"
                                                        class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white"
                                                        id="delete_photo2"></a><img
                                                        src="../uploads/<?php echo $row7['Photo2'];?>" alt=""
                                                        class="img-fluid ticket-file-img"
                                                        style="width: 64px;height: 64px;"></div>
                                            </span>
                                            <?php } ?>
                                        </div>


  <div class="form-group col-md-12">
                                            <label class="form-label">Logo 2 </label>
                                            <label class="custom-file">
                                                <input type="file" class="custom-file-input" name="Photo3"
                                                    style="opacity: 1;">
                                                <input type="hidden" name="OldPhoto3"
                                                    value="<?php echo $row7['Photo3'];?>" id="OldPhoto3">
                                                <span class="custom-file-label"></span>
                                            </label>
                                            <?php if($row7['Photo3']=='') {} else{?>
                                            <span id="show_photo3">
                                                <div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a
                                                        href="javascript:void(0)"
                                                        class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white"
                                                        id="delete_photo3"></a><img
                                                        src="../uploads/<?php echo $row7['Photo3'];?>" alt=""
                                                        class="img-fluid ticket-file-img"
                                                        style="width: 64px;height: 64px;"></div>
                                            </span>
                                            <?php } ?>
                                        </div>-->
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Country </label>
                                            <select class="form-control" name="CountryId" id="CountryId">
                                                <option selected="" disabled="">Select Country</option>
                                                <?php 
                                        $q = "select * from tbl_country";
                                        $r = $conn->query($q);
                                        while($rw = $r->fetch_assoc())
                                    {
                                ?>
                                                <option <?php if($row7['CountryId']==$rw['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">State</label>
                                            <select class="form-control" id="StateId" name="StateId">
                                                <option selected="" disabled="">Select State</option>
                                                <?php 
        $CountryId = $row7['CountryId'];
        $q = "select * from tbl_state WHERE CountryId='$CountryId' ORDER BY Name ASC";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
?>
                                                <option <?php if($row7['StateId']==$rw['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">City</label>
                                            <select class="form-control" id="CityId" name="CityId">
                                                <option selected="" disabled="">Select City</option>
                                                <?php 
 $StateId = $row7['StateId'];
        $q = "select * from tbl_city WHERE StateId='$StateId' ORDER BY Name ASC";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
?>
                                                <option <?php if($row7['CityId']==$rw['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="form-label">Pincode No </label>
                                            <input type="text" name="Pincode" class="form-control"
                                                placeholder="Pincode No" value="<?php echo $row7["Pincode"]; ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Address </label>
                                            <textarea name="Address" id="Address" class="form-control" placeholder="Address"
                                                autocomplete="off"><?php echo $row7["Address"]; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>

                                       
<div class="form-group col-md-3">
                                            <label class="form-label">Trusted  Vendor <span class="text-danger">*</span></label>
                                            <select class="form-control" id="TrustedVendor" name="TrustedVendor" required="">
                                                 <option value="No" <?php if($row7["TrustedVendor"]=='No') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="Yes" <?php if($row7["TrustedVendor"]=='Yes') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Payment Period (In Days) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="PayPeriod" id="PayPeriod" class="form-control"
                                                placeholder="" value="<?php echo $row7["PayPeriod"]; ?>" min="1"
                                                autocomplete="off" required>
                                        </div>
                                        

                                        <div class="form-group col-md-6">
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


                                      

                                    </div>
                                    </fieldset>
                                    
                                    <fieldset>
 <legend>ID Proof Documents</legend>
<div class="form-row"> 
<div class="form-group col-md-6 maindoc">
  <label class="form-label">Upload Front Aadhar Card </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="AadharCard" style="opacity: 1;">
<input type="hidden" name="AadharCardOld" value="<?php echo $row7['AadharCard'];?>" id="AadharCardOld">
<span class="custom-file-label"></span>
</label>
<?php if($row7['AadharCard']=='') {} else{?>
  <span id="show_photo3">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo3"></a><a href="../uploads/<?php echo $row7['AadharCard'];?>" target="_blank"><?php echo $row7['AadharCard'];?></a></div>
</span>
<?php } ?>
</div>

<div class="form-group col-md-6 maindoc">
  <label class="form-label">Upload Back Aadhar Card </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="AadharCard2" style="opacity: 1;">
<input type="hidden" name="AadharCardOld2" value="<?php echo $row7['AadharCard2'];?>" id="AadharCardOld2">
<span class="custom-file-label"></span>
</label>
<?php if($row7['AadharCard2']=='') {} else{?>
  <span id="show_photo4">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo4"></a><a href="../uploads/<?php echo $row7['AadharCard2'];?>" target="_blank"><?php echo $row7['AadharCard2'];?></a></div>
</span>
<?php } ?>
</div>

 

<div class="form-group col-md-6 maindoc">
  <label class="form-label">Upload Front Pan Card  </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="PanCard" style="opacity: 1;">
<input type="hidden" name="PanCardOld" value="<?php echo $row7['PanCard'];?>" id="PanCardOld">
<span class="custom-file-label"></span>
</label>
<?php if($row7['PanCard']=='') {} else{?>
  <span id="show_photo5">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo5"></a><a href="../uploads/<?php echo $row7['PanCard'];?>" target="_blank"><?php echo $row7['PanCard'];?></a></div>
</span>
<?php } ?>
</div>

<div class="form-group col-md-6 maindoc">
  <label class="form-label">Upload Back Pan Card  </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="PanCard2" style="opacity: 1;">
<input type="hidden" name="PanCardOld2" value="<?php echo $row7['PanCard2'];?>" id="PanCardOld2">
<span class="custom-file-label"></span>
</label>
<?php if($row7['PanCard2']=='') {} else{?>
  <span id="show_photo6">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo6"></a><a href="../uploads/<?php echo $row7['PanCard2'];?>" target="_blank"><?php echo $row7['PanCard2'];?></a></div>
</span>
<?php } ?>
</div>

 

</div>

                    </fieldset>
           
           <fieldset>
 <legend>Bank Account Detail</legend>
<div class="form-row">             
<div class="form-group col-md-3">
<label class="form-label">Account No <span class="text-danger">*</span></label>
<input type="text" name="AccountNo" id="AccountNo" class="form-control" placeholder="" value="<?php echo $row7["AccountNo"]; ?>" oninput="getBankDetails()" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">IFSC Code <span class="text-danger">*</span></label>
<input type="text" name="IfscCode" id="IfscCode" class="form-control" placeholder="" value="<?php echo $row7["IfscCode"]; ?>" oninput="getBankDetails()" required>
<div class="clearfix"></div>
</div>


                                    
                                       <div class="form-group col-md-6">
<label class="form-label">Bank Holder Name <span class="text-danger">*</span></label>
<input type="text" name="AccountName" id="AccountName" class="form-control" placeholder="" value="<?php echo $row7["AccountName"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Bank Name <span class="text-danger">*</span></label>
<input type="text" name="BankName" id="BankName" class="form-control" placeholder="" value="<?php echo $row7["BankName"]; ?>" required>
<div class="clearfix"></div>
</div>



<div class="form-group col-md-6">
<label class="form-label">Branch <span class="text-danger">*</span></label>
<input type="text" name="Branch" id="Branch" class="form-control" placeholder="" value="<?php echo $row7["Branch"]; ?>" required>
<div class="clearfix"></div>
</div>



<div class="form-group col-md-6">
<label class="form-label">UPI ID </label>
<input type="text" name="UpiNo" id="UpiNo" class="form-control" placeholder="" value="<?php echo $row7["UpiNo"]; ?>">
<div class="clearfix"></div>
</div>


<div class="form-group col-md-6">
  <label class="form-label">Upload Cheque Book <span class="text-danger">*</span></label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="ChequeBook" style="opacity: 1;">
<input type="hidden" name="ChequeBookOld" value="<?php echo $row7['ChequeBook'];?>" id="ChequeBookOld">
<span class="custom-file-label"></span>
</label>
<?php if($row7['ChequeBook']=='') {} else{?>
  <span id="show_photo3">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo3"></a><a href="../uploads/<?php echo $row7['ChequeBook'];?>" target="_blank"><?php echo $row7['ChequeBook'];?></a></div>
</span>
<?php } ?>
</div>


                                    </div> 
                                     </fieldset>
                                     
<!--<fieldset>
 <legend>Bank Account Detail</legend>
<div class="form-row">               
                                    
                                       <div class="form-group col-md-6">
<label class="form-label">Bank Holder Name <span class="text-danger">*</span></label>
<input type="text" name="AccountName" id="AccountName" class="form-control" placeholder="" value="<?php echo $row7["AccountName"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Bank Name <span class="text-danger">*</span></label>
<input type="text" name="BankName" id="BankName" class="form-control" placeholder="" value="<?php echo $row7["BankName"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Account No <span class="text-danger">*</span></label>
<input type="text" name="AccountNo" id="AccountNo" class="form-control" placeholder="" value="<?php echo $row7["AccountNo"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Branch <span class="text-danger">*</span></label>
<input type="text" name="Branch" id="Branch" class="form-control" placeholder="" value="<?php echo $row7["Branch"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">IFSC Code <span class="text-danger">*</span></label>
<input type="text" name="IfscCode" id="IfscCode" class="form-control" placeholder="" value="<?php echo $row7["IfscCode"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">UPI ID <span class="text-danger">*</span></label>
<input type="text" name="UpiNo" id="UpiNo" class="form-control" placeholder="" value="<?php echo $row7["UpiNo"]; ?>" required>
<div class="clearfix"></div>
</div>





 


                                    </div> 
                                     </fieldset>-->
                                     
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
     function showLoader() {
    document.getElementById('loader').style.display = 'block';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
}
    function checkGstNoLength(value) {
    if (value.length === 15) {
        showLoader();
        gstVerify();
    }
}


function gstVerify() {
    var GstNo = $('#GstNo').val();
    var action = "GstVerify";

    if (GstNo.length !== 15) {
        alert("GST number must be 15 digits");
        hideLoader();
        return;
    }

    $.ajax({
        url: "ajax_files/ajax_api.php",
        method: "POST",
        data: {
            action: action,
            GstNo: GstNo
        },
        dataType: "json",
        success: function(data) {
            console.log("Response:", data);
            hideLoader();
            
            if (data.type != 'validation_error') {
               $('#TradeName').val(data.trade_name_of_business);
                    $('#OfficeAddress').val(data.principal_place_address);
                    
                    
                
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

function getBankDetails(){
     showLoader();
  var AccountNo = $('#AccountNo').val();
  var IfscCode = $('#IfscCode').val();
   var action = "BankAccountVerify";
   $.ajax({
        url: "ajax_files/ajax_api.php",
        method: "POST",
        data: {
            action: action,
            AccountNo: AccountNo,
            IfscCode:IfscCode
        },
        dataType: "json",
        success: function(data) {
            console.log("Response:", data); 
           hideLoader();
            
            if (data.account_status === 'VALID') {
                 $('#BankName').val(data.bank_name);
                 $('#AccountName').val(data.name_at_bank);
                 $('#Branch').val(data.branch);
                
            } else {
                // alert("Failed to send OTP: " + (data.message || "Unknown error"));
            }
        },
        error: function(xhr, status, error) {
            hideLoader();
            console.error("AJAX Error:", error);
            alert("An error occurred while sending OTP. Please try again.");
        }
    });
}

    $(document).ready(function() {
        //$(document).on("click", ".btn-finish", function(event){
        $('#validation-form').on('submit', function(e) {
            exit();
            e.preventDefault();
            if ($('#validation-form').valid()) {

                $.ajax({
                    url: "ajax_files/ajax_vendors.php",
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
                                window.location.href = 'view-vendors.php';
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
                    url: "ajax_files/ajax_vendors.php",
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