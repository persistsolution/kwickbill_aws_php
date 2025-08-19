<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="E-Commerce";
$Page="Coupon-Code";

?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Coupon Code</title>
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
$sql7 = "SELECT * FROM tbl_coupon_code WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 
  if(isset($_POST['submit'])){
$Code = addslashes(trim($_POST["Code"]));
$Discount = addslashes(trim($_POST["Discount"]));
$FromDate = addslashes(trim($_POST["FromDate"]));
$ToDate = addslashes(trim($_POST["ToDate"]));
$MinOrder = addslashes(trim($_POST["MinOrder"]));
$PointDays = addslashes(trim($_POST["PointDays"]));
$Details = addslashes(trim($_POST["Details"]));

$CouponFor = addslashes(trim($_POST["CouponFor"]));
$CatId = addslashes(trim($_POST["CatId"]));
$DiscountType = addslashes(trim($_POST["DiscountType"]));

$Status = $_POST["Status"];
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

$randno = rand(1,100);
$src = $_FILES['Photo']['tmp_name'];
$fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
$dest = '../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$Photo = $imagepath ;
} 
else{
  $Photo = $_POST['OldPhoto'];
}

if($_GET['id']==''){
    $qx = "INSERT INTO tbl_coupon_code SET Code='$Code',Discount='$Discount',FromDate='$FromDate',ToDate='$ToDate',MinOrder='$MinOrder',PointDays='$PointDays',Photo='$Photo',Details='$Details',Status='$Status',CreatedBy='$user_id',CreatedDate='$CreatedDate',CouponFor='$CouponFor',CatId='$CatId',DiscountType='$DiscountType'";
  $conn->query($qx);
  echo "<script>alert('Coupon/Offer Added Successfully!');window.location.href='coupon-code.php';</script>";
}
else{
      $query2 = "UPDATE tbl_coupon_code SET Code='$Code',Discount='$Discount',FromDate='$FromDate',ToDate='$ToDate',MinOrder='$MinOrder',PointDays='$PointDays',Photo='$Photo',Details='$Details',Status='$Status',ModifiedBy='$user_id',ModifiedDate='$CreatedDate',CouponFor='$CouponFor',CatId='$CatId',DiscountType='$DiscountType' WHERE id = '$id'";
  $conn->query($query2);
  echo "<script>alert('Coupon/Offer Updated Successfully!');window.location.href='coupon-code.php';</script>";
}
    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Coupon Code</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">

<input type="hidden" id="id" value="<?php echo $_GET['id'];?>">
<div class="form-group col-md-4">
<label class="form-label">Coupon For <span class="text-danger">*</span></label>
  <select class="form-control" id="CouponFor" name="CouponFor" required="" onchange="checkCouponFor(this.value)">
<option selected="" disabled="" value="">Select Coupon For</option>
<option value="1" <?php if($row7["CouponFor"]=='1') {?> selected <?php } ?>>Single Product</option>
<option value="2" <?php if($row7["CouponFor"]=='2') {?> selected <?php } ?>>Category</option>
<option value="3" <?php if($row7["CouponFor"]=='3') {?> selected <?php } ?>>None Of Above</option>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-4">
<label class="form-label">Category <span class="text-danger">*</span></label>
  <select class="form-control" id="CatId" name="CatId" required="">
<option selected="" disabled="" value="">Select Category</option>
<?php 
        $q = "select * from category WHERE Status='1' AND Roll!=2";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
        
?>
<option <?php if($row7["CatId"]==$rw['id']) {?> selected <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
              <?php } ?></select>
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-4">
<label class="form-label">Referral/Coupon Code <span class="text-danger">*</span></label>
<input type="text" name="Code" class="form-control" id="Code" placeholder="" required value="<?php echo $row7['Code'];?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-6">
<label class="form-label">From Date<span class="text-danger">*</span></label>
<input type="date" name="FromDate" class="form-control" id="FromDate" placeholder="" required value="<?php echo $row7['FromDate'];?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-6">
<label class="form-label">To Date<span class="text-danger">*</span></label>
<input type="date" name="ToDate" class="form-control" id="ToDate" placeholder="" required value="<?php echo $row7['ToDate'];?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Discount Type <span class="text-danger">*</span></label>
  <select class="form-control" id="DiscountType" name="DiscountType" required="">
<option selected="" disabled="" value="">Select Discount Type</option>
<option value="1" <?php if($row7["DiscountType"]=='1') {?> selected <?php } ?>>Percent</option>
<option value="2" <?php if($row7["DiscountType"]=='2') {?> selected <?php } ?>>Amount</option>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-4">
<label class="form-label">Discount<span class="text-danger">*</span></label>
<div class="input-group">
<input type="text" id="Discount" name="Discount" class="form-control" required onKeyPress="return isNumberKey(event)" value="<?php echo $row7['Discount'];?>">
<div class="clearfix"></div>

</div>
</div>

<!--<div class="form-group col-lg-6">
<label class="form-label">Points Validity<span class="text-danger">*</span></label>
<div class="input-group">
<input type="text" id="PointDays" name="PointDays" class="form-control" value="<?php echo $row7['PointDays'];?>" required onKeyPress="return isNumberKey(event)">
<div class="clearfix"></div>
<div class="input-group-prepend">
<div class="input-group-text">Days</div>
</div>
</div>
</div>-->

<div class="form-group col-lg-4">
<label class="form-label">Min Order Amount<span class="text-danger">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">&#8377;</div>
</div>
<input type="text" id="MinOrder" name="MinOrder" class="form-control" value="<?php echo $row7['MinOrder'];?>" required="" onKeyPress="return isNumberKey(event)">
<div class="clearfix"></div>
</div>
</div>

<div class="form-group col-lg-12">
<label class="form-label">Details <span class="text-danger">*</span></label>
<textarea name="Details" class="form-control" id="editor1" placeholder="Details" required><?php echo $row7["Details"]; ?></textarea>
<div class="clearfix"></div>
</div>


<div class="form-group col-md-12">
  <label class="form-label"> Coupon/Offer Image </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="Photo" style="opacity: 1;">
<input type="hidden" name="OldPhoto" value="<?php echo $row7['Photo'];?>" id="OldPhoto">
<span class="custom-file-label"></span>
</label>
<?php if($row7['Photo']=='') {} else{?>
  <span id="show_photo">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo"></a><img src="../uploads/<?php echo $row7['Photo'];?>" alt="" class="img-fluid ticket-file-img" style="width: 64px;height: 64px;"></div>
</span>
<?php } ?>
</div>


<div class="form-group col-md-12">
<label class="form-label">Status <span class="text-danger">*</span></label>
  <select class="form-control" id="Status" name="Status" required="">
<option selected="" disabled="" value="">Select Status</option>
<option value="1" <?php if($row7["Status"]=='1') {?> selected <?php } ?>>Active</option>
<option value="0" <?php if($row7["Status"]=='0') {?> selected <?php } ?>>Inctive</option>
</select>
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
        
        $(document).ready(function() {
            var CouponFor = $('#CouponFor').val();
            checkCouponFor(CouponFor);
            
        });
        function checkCouponFor(val){
            if(val == 2){
                $('#CatId').attr("disabled",false);
            }
            else{
               $('#CatId').attr("disabled",true).val(''); 
            }
        }
</script>
</body>
</html>
.