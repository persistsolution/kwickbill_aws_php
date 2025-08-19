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
$id = $_GET['id'];
$sql7 = "SELECT * FROM wallet WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 
  if(isset($_POST['submit'])){
     $UserId = addslashes(trim($_POST["UserId"]));
     $Narration = addslashes(trim($_POST["Narration"]));
$Amount = $_POST["Amount"];
$Status = $_POST["Status"];
 $CreatedDate = $_POST["CreatedDate"];
 $CreatedDate2 = date('d-M-Y');
  $CreatedTime = date('h:i a');
  if($Status == 'Cr'){
    $Msg = "Credited";
  }
  else{
    $Msg = "Debited";
  }

  if($_GET['id']==''){
$qx = "INSERT INTO wallet SET Narration='$Narration',UserId = '$UserId',Amount='$Amount',Status='$Status',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
  $conn->query($qx);
  
    $sql2 = "SELECT Phone FROM tbl_users WHERE id='$UserId'";
    $row2 = getRecord($sql2);

  
    $sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='$UserId' group by Status) as a";
                        $res11x = $conn->query($sql11x);
                        $row11x = $res11x->fetch_assoc();
    $mybalance = $row11x['credit'] - $row11x['debit'];

  $Phone = $row2['Phone'];
  if($Status == 'Cr'){
      $smstxt = "Update! INR ".$Amount." Credited in your Maha Chai Wallet on ".$CreatedDate2.". Avl Wallet Bal INR ".$mybalance.". For any query please call 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875379839610";
  }
  else{
      $smstxt = "Update! INR ".$Amount." Debited from your Maha Chai Wallet on ".$CreatedDate2.". Avl Wallet Bal INR ".$mybalance.". For any query please call 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875384525446";
  }
  include '../incsmsapi.php';  
  echo "<script>alert('Amount $Msg Successfully!');window.location.href='wallet.php';</script>";
}
else{
     $query2 = "UPDATE wallet SET Narration='$Narration',UserId = '$UserId',Amount='$Amount',Status='$Status',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime' WHERE id = '$id'";
  $conn->query($query2);
  
  $sql2 = "SELECT Phone FROM tbl_users WHERE id='$UserId'";
    $row2 = getRecord($sql2);

  
    $sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='$UserId' group by Status) as a";
                        $res11x = $conn->query($sql11x);
                        $row11x = $res11x->fetch_assoc();
    $mybalance = $row11x['credit'] - $row11x['debit'];

  $Phone = $row2['Phone'];
  if($Status == 'Cr'){
      $smstxt = "Update! INR ".$Amount." Credited in your Maha Chai Wallet on ".$CreatedDate2.". Avl Wallet Bal INR ".$mybalance.". For any query please call 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875379839610";
  }
  else{
      $smstxt = "Update! INR ".$Amount." Debited from your Maha Chai Wallet on ".$CreatedDate2.". Avl Wallet Bal INR ".$mybalance.". For any query please call 8007885000";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875384525446";
  }
  echo "<script>alert('Amount $Msg Successfully!');window.location.href='wallet.php';</script>";
}
    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Wallet Balance</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">
<div class="form-group col-md-12">
<label class="form-label">Account <span class="text-danger">*</span></label>
  <select class="select2-demo form-control" id="UserId" name="UserId" required="">
      <option selected="" disabled="" value="">Select Account</option>
     
     <?php 
     $sql1 = "SELECT tu.*,tut.Name As AccType FROM tbl_users tu LEFT JOIN tbl_user_type tut ON tu.Roll=tut.id WHERE tu.Status=1";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
          
      ?>
    <option <?php if($row7['UserId'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].") - ".$result['AccType']; ?></option>
<?php } ?>
 

</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Amount <span class="text-danger">*</span></label>
<input type="text" name="Amount" class="form-control" id="Amount" placeholder="Amount" value="<?php echo $row7['Amount'];?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Date <span class="text-danger">*</span></label>
<input type="date" name="CreatedDate" class="form-control" id="CreatedDate" placeholder="" value="<?php echo $row7['CreatedDate'];?>" required>
<div class="clearfix"></div>
</div>


<div class="form-group col-md-12">
<label class="form-label">Status <span class="text-danger">*</span></label>
  <select class="form-control" id="Status" name="Status" required="">
<option selected="" disabled="" value="">Select Status</option>
<option value="Cr" <?php if($row7["Status"]=='Cr') {?> selected <?php } ?>>Credit</option>
<option value="Dr" <?php if($row7["Status"]=='Dr') {?> selected <?php } ?>>Debit</option>
</select>
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