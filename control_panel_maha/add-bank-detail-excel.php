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
    $UserId = $_POST['UserId'];
    $AccountName = addslashes(trim($_POST['AccountName']));
$BankName = addslashes(trim($_POST['BankName']));
$AccountNo = addslashes(trim($_POST['AccountNo']));
$IfscCode = addslashes(trim($_POST['IfscCode']));
$Branch = addslashes(trim($_POST['Branch']));
$Amount = addslashes(trim($_POST['Amount']));
$PayType= addslashes(trim($_POST['PayType']));
$PayDate = addslashes(trim($_POST['PayDate']));
$ExpId = addslashes(trim($_POST['ExpId']));
$FrId = addslashes(trim($_POST['FrId']));
$CreatedDate = date('Y-m-d');

if($_GET['id'] == ''){
    $sql = "INSERT INTO tbl_bank_detail_excel_data SET PayDate='$PayDate',UserId='$UserId',AccountName='$AccountName',Amount='$Amount',AccountNo='$AccountNo',IfscCode='$IfscCode',PayType='$PayType',Status='1',CreatedBy='$user_id',CreatedDate='$CreatedDate',ExpId='$ExpId',FrId='$FrId'";
    $conn->query($sql);
    echo "<script>alert('Bank Details Saved Successfully');window.location.href='bank-detail-excel.php';</script>";
}
else{
  $sql = "UPDATE tbl_bank_detail_excel_data SET PayDate='$PayDate',UserId='$UserId',AccountName='$AccountName',Amount='$Amount',AccountNo='$AccountNo',IfscCode='$IfscCode',PayType='$PayType',Status='1',ModifiedBy='$user_id',ModifiedDate='$CreatedDate',ExpId='$ExpId',FrId='$FrId' WHERE id='$id'";
    $conn->query($sql);
    echo "<script>alert('Bank Details Update Successfully');window.location.href='bank-detail-excel.php';</script>";  
}
}
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Bank Details For Excel</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                   
                    
<fieldset>
 <legend>Bank Account Detail</legend>
<div class="form-row">               

 <div class="form-group col-md-4">
<label class="form-label"> Beneficiery Name<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required onchange="getBankDetails(this.value)">
<option selected="" value="0">...</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_bank_details WHERE Status=1 GROUP BY AccountNo,IfscCode";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["UserId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['AccountName']." (".$result['BankName'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

                                    
                                       <div class="form-group col-md-4">
<label class="form-label">Bank Holder Name </label>
<input type="text" name="AccountName" id="AccountName" class="form-control" placeholder="" value="<?php echo $row7["AccountName"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Bank Name </label>
<input list="cars" name="BankName" id="BankName" class="form-control" placeholder="" value="<?php echo $row7["BankName"]; ?>" readonly>
   
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Account No </label>
<input type="text" name="AccountNo" id="AccountNo" class="form-control" placeholder="" value="<?php echo $row7["AccountNo"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Branch </label>
<input type="text" name="Branch" id="Branch" class="form-control" placeholder="" value="<?php echo $row7["Branch"]; ?>" readonly>
    
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">IFSC Code </label>
<input type="text" name="IfscCode" id="IfscCode" class="form-control" placeholder="" value="<?php echo $row7["IfscCode"]; ?>" readonly>
   
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">Amount <span class="text-danger">*</span></label>
<input type="text" name="Amount" id="Amount" class="form-control" placeholder="" value="<?php echo $row7["Amount"]; ?>" required>
   
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">Payment Type <span class="text-danger">*</span></label>
<input type="text" name="PayType" id="PayType" class="form-control" placeholder="" value="<?php echo $row7["PayType"]; ?>" required>
   
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">Payment Date <span class="text-danger">*</span></label>
<input type="date" name="PayDate" id="PayDate" class="form-control" placeholder="" value="<?php echo $row7["PayDate"]; ?>" required>
   
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">Expense ID </label>
<input type="text" name="ExpId" id="ExpId" class="form-control" placeholder="" value="<?php echo $row7["ExpId"]; ?>">
   
<div class="clearfix"></div>
</div>

<div class="form-group col-md-5">
<label class="form-label"> Franchise</label>
 <select class="select2-demo form-control" name="FrId" id="FrId">
<option selected="" value="0">Select Franchise</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>

</select>
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


    <?php include_once 'footer_script.php'; ?>
<script>
    function getBankDetails(id){
        var action = "getBankDetails";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                dataType:"json",
                success: function(data) {
                    $('#AccountName').val(data.AccountName);
                    $('#BankName').val(data.BankName);
                    $('#AccountNo').val(data.AccountNo);
                    $('#Branch').val(data.Branch);
                    $('#IfscCode').val(data.IfscCode);
                }
            });
    }
</script>
   
</body>

</html>