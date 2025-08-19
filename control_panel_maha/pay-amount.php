<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Wallet";
$Page = "Wallet";

?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Courses</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
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


</style>
 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">


<?php 
$id = $_GET['reqid'];
$sql7 = "SELECT * FROM tbl_withdraw_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();

$sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='".$row7['UserId']."' group by Status) as a";
                        $res11x = $conn->query($sql11x);
                        $row11x = $res11x->fetch_assoc();
$mybalance = $row11x['credit'] - $row11x['debit'];

$sql8 = "SELECT * FROM tbl_users WHERE id='".$row7['UserId']."'";
$row8 = getRecord($sql8);
?>

<?php 
  if(isset($_POST['submit'])){
     $UserId = addslashes(trim($_POST["UserId"]));
     $Narration = addslashes(trim($_POST["Narration"]));
     $AccountName = addslashes(trim($_POST['AccountName']));
$BankName = addslashes(trim($_POST['BankName']));
$AccountNo = addslashes(trim($_POST['AccountNo']));
$IfscCode = addslashes(trim($_POST['IfscCode']));
$Branch = addslashes(trim($_POST['Branch']));
$UpiNo = addslashes(trim($_POST['UpiNo']));
$Amount = $_POST["Amount"];
$PayMode = $_POST["PayMode"];
$PayDate = $_POST["PayDate"];
$Status = $_POST["Status"];
 $CreatedDate = date('Y-m-d');
  $CreatedTime = date('h:i a');
  if($Status == 'Cr'){
    $Msg = "Credited";
  }
  else{
    $Msg = "Debited";
  }

  if($_GET['id']==''){
$qx = "INSERT INTO wallet SET Narration='$Narration',UserId = '$UserId',Amount='$Amount',Status='Dr',CreatedDate='$PayDate',CreatedTime='$CreatedTime'";
  $conn->query($qx);
  
  $sql = "UPDATE tbl_withdraw_request SET PayMode='$PayMode',PayDate='$PayDate',PayAmt='$Amount',PayTime='$CreatedTime',Status=1,AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',PayNarration='$Narration' WHERE id='$id'";
  $conn->query($sql);
  echo "<script>alert('Pay Amount Successfully!');window.location.href='amount-request.php';</script>";
}
else{
     $query2 = "UPDATE wallet SET Narration='$Narration',UserId = '$UserId',Amount='$Amount',Status='Dr',CreatedDate='$PayDate',CreatedTime='$CreatedTime' WHERE id = '$id'";
  $conn->query($query2);
  
  $sql = "UPDATE tbl_withdraw_request SET PayMode='$PayMode',PayDate='$PayDate',PayAmt='$Amount',PayTime='$CreatedTime',Status=1,AccountName='$AccountName',BankName='$BankName',AccountNo='$AccountNo',IfscCode='$IfscCode',Branch='$Branch',UpiNo='$UpiNo',PayNarration='$Narration' WHERE id='$id'";
  $conn->query($sql);
  
  echo "<script>alert('Record Updated Successfully!');window.location.href='amount-request.php';</script>";
}
    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Transfer Amount</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">
<div class="form-group col-md-12">
<label class="form-label">Account <span class="text-danger">*</span></label>
  <select class="select2-demo form-control" id="UserId" name="UserId" required="">
      <!--<option selected="" disabled="" value="">Select Account</option>-->
      <!--<optgroup label="Franchise">-->
     <?php 
     $sql1 = "SELECT * FROM tbl_users WHERE id='".$row7['UserId']."'";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
      ?>
    <option <?php if($row7['UserId'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
<!-- </optgroup>-->
 

</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Wallet Amount <span class="text-danger">*</span></label>
<input type="text" name="BalAmount" class="form-control" id="BalAmount" placeholder="Amount" value="<?php echo $mybalance;?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Withdraw Request Amount <span class="text-danger">*</span></label>
<input type="text" class="form-control" value="<?php echo $row7['Amount'];?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Pay Amount <span class="text-danger">*</span></label>
<input type="text" name="Amount" class="form-control" id="Amount" placeholder="Amount" value="<?php echo $row7['Amount'];?>" required>
<div class="clearfix"></div>
</div>


<div class="form-group col-md-6">
<label class="form-label">Payment Mode <span class="text-danger">*</span></label>
  <select class="form-control" id="PayMode" name="PayMode" required="">
<option selected="" disabled="" value="">Select Payment Mode</option>
<option value="Bank Transfer" <?php if($row7["Status"]=='Bank Transfer') {?> selected <?php } ?>>Bank Transfer</option>
<option value="UPI" <?php if($row7["Status"]=='UPI') {?> selected <?php } ?>>UPI</option>
<option value="Cash" <?php if($row7["Status"]=='Cash') {?> selected <?php } ?>>Cash</option>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Payment Date <span class="text-danger">*</span></label>
<input type="date" name="PayDate" class="form-control" id="PayDate" placeholder="Amount" value="<?php echo $row7['PayDate'];?>" required>
<div class="clearfix"></div>
</div>



                                       <div class="form-group col-md-6">
<label class="form-label">Bank Holder Name </label>
<input type="text" name="AccountName" id="AccountName" class="form-control" placeholder="" value="<?php echo $row8["AccountName"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Bank Name </label>
<input type="text" name="BankName" id="BankName" class="form-control" placeholder="" value="<?php echo $row8["BankName"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Account No </label>
<input type="text" name="AccountNo" id="AccountNo" class="form-control" placeholder="" value="<?php echo $row8["AccountNo"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Branch </label>
<input type="text" name="Branch" id="Branch" class="form-control" placeholder="" value="<?php echo $row8["Branch"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">IFSC Code </label>
<input type="text" name="IfscCode" id="IfscCode" class="form-control" placeholder="" value="<?php echo $row8["IfscCode"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-12">
<label class="form-label">UPI ID </label>
<input type="text" name="UpiNo" id="UpiNo" class="form-control" placeholder="" value="<?php echo $row8["UpiNo"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-12">
<label class="form-label">Narration <span class="text-danger">*</span></label>
<input type="text" name="Narration" class="form-control" id="Narration" placeholder="Narration" value="<?php echo $row7['Narration'];?>" required>
<div class="clearfix"></div>
</div>

</div>

<button type="submit" name="submit" class="btn btn-primary btn-finish">Submit</button>
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
        CKEDITOR.replace( 'editor1');
</script>
</body>
</html>
.