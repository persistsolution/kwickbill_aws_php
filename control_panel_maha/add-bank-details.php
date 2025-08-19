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
$sql7 = "SELECT * FROM tbl_bank_details WHERE id='$id'";
$row7 = getRecord($sql7);

if(isset($_POST['submit'])){
    $AccountName = addslashes(trim($_POST['AccountName']));
$BankName = addslashes(trim($_POST['BankName']));
$AccountNo = addslashes(trim($_POST['AccountNo']));
$IfscCode = addslashes(trim($_POST['IfscCode']));
$Branch = addslashes(trim($_POST['Branch']));
$CreatedDate = date('Y-m-d');

if($_GET['id'] == ''){
    $sql2 = "SELECT * FROM tbl_bank_details WHERE AccountNo='$AccountNo' AND IfscCode='$IfscCode'";
    $rncnt2 = getRow($sql2);
    if($rncnt2>0){
        echo "<script>alert('Bank Details Already Exists');</script>";
    }
    else{
    $sql = "INSERT INTO tbl_bank_details SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',Status='1',CreatedBy='$user_id',CreatedDate='$CreatedDate'";
    $conn->query($sql);
    echo "<script>alert('Bank Details Saved Successfully');window.location.href='view-bank-details.php';</script>";
    }
}
else{
    $sql2 = "SELECT * FROM tbl_bank_details WHERE AccountNo='$AccountNo' AND IfscCode='$IfscCode' AND id!='$id'";
    $rncnt2 = getRow($sql2);
    if($rncnt2>0){
        echo "<script>alert('Bank Details Already Exists');</script>";
    }
    else{
  $sql = "UPDATE tbl_bank_details SET AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',Status='1',ModifiedBy='$user_id',ModifiedDate='$CreatedDate' WHERE id='$id'";
    $conn->query($sql);
    echo "<script>alert('Bank Details Update Successfully');window.location.href='view-bank-details.php';</script>";  
    }
}
}
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Bank Details</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                   
                    
<fieldset>
 <legend>Bank Account Detail</legend>
<div class="form-row">  

<div class="form-group col-md-3">
<label class="form-label">Account No </label>
<input type="text" name="AccountNo" id="AccountNo" class="form-control" placeholder="" value="<?php echo $row7["AccountNo"]; ?>" oninput="getBankDetails()">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">IFSC Code </label>
<input list="IfscCodeList" name="IfscCode" id="IfscCode" class="form-control" placeholder="" value="<?php echo $row7["IfscCode"]; ?>" oninput="getBankDetails()">
    <datalist id="IfscCodeList">
        <?php $sql = "SELECT DISTINCT(IfscCode) AS IfscCode FROM tbl_bank_details";
        $row = getList($sql);
        foreach($row as $result){?>
      <option value="<?php echo $result['IfscCode'];?>" />
      <?php } ?>
    
    </datalist>
<div class="clearfix"></div>
</div>




                                    
                                       <div class="form-group col-md-6">
<label class="form-label">Bank Holder Name </label>
<input type="text" name="AccountName" id="AccountName" class="form-control" placeholder="" value="<?php echo $row7["AccountName"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Bank Name </label>
<input list="cars" name="BankName" id="BankName" class="form-control" placeholder="" value="<?php echo $row7["BankName"]; ?>">
    <datalist id="cars">
        <?php $sql = "SELECT DISTINCT(BankName) AS BankName FROM tbl_bank_details";
        $row = getList($sql);
        foreach($row as $result){?>
      <option value="<?php echo $result['BankName'];?>" />
      <?php } ?>
    
    </datalist>
<div class="clearfix"></div>
</div>


<div class="form-group col-md-6">
<label class="form-label">Branch </label>
<input list="BranchList" name="Branch" id="Branch" class="form-control" placeholder="" value="<?php echo $row7["Branch"]; ?>">
    <datalist id="BranchList">
        <?php $sql = "SELECT DISTINCT(Branch) AS Branch FROM tbl_bank_details";
        $row = getList($sql);
        foreach($row as $result){?>
      <option value="<?php echo $result['Branch'];?>" />
      <?php } ?>
    
    </datalist>
<div class="clearfix"></div>
</div>





 


                                    </div> 
                                     </fieldset>
                                     <br>
                                    <!-- <button id="growl-default" class="btn btn-default">Default</button> -->
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Save</button>
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

   
</body>

</html>

<script>
     function showLoader() {
    document.getElementById('loader').style.display = 'block';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
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
                 $('#BankName').val(data.bank_name).prop("readonly",true);
                 $('#AccountName').val(data.name_at_bank).prop("readonly",true);
                 $('#Branch').val(data.branch).prop("readonly",true);
                 $('#AccountNo').prop("readonly",true);
                 $('#IfscCode').prop("readonly",true);
                
            } else {
                $('#AccountNo').prop("readonly",false);
                 $('#IfscCode').prop("readonly",false);
                 $('#BankName').val('').prop("readonly",false);
                 $('#AccountName').val('').prop("readonly",false);
                 $('#Branch').val('').prop("readonly",false);
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
</script>