<?php 
session_start();
include_once '../config.php';
include_once 'auth.php';
$user_id = $_REQUEST['user_id'];
$BillSoftFrId = $_REQUEST['user_id'];
$MainPage = "View-Cash-Book";
$Page = "View-Cash-Book";
$sessionid = session_id();
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>Add Cashbook</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="author" content="" />

<?php include_once '../header_script.php'; ?>
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

<?php //include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">


<?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_sub_menu WHERE id='$id'";
$row7 = getRecord($sql7);

?>

<?php 
  if(isset($_POST['submit'])){
    $menuid = addslashes(trim($_POST['menuid']));
    $title = addslashes(trim($_POST['title']));
    $table_values = addslashes(trim($_POST['table_values']));
    $link = addslashes(trim($_POST['link']));
    $srno = addslashes(trim($_POST['srno']));
   $user_id = 253;
    
  
    if($_GET['id'] == ''){
     $qx = "INSERT INTO tbl_sub_menu SET menuid='$menuid',title='$title',table_values='$table_values',link='$link',
            srno='$srno',user_id='$user_id'";
  $conn->query($qx);
  $InvId = mysqli_insert_id($conn);
echo "<script>window.location.href = 'add-sub-menu.php';</script>";
 /*echo '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.swal2-popup.custom-small-alert {
  width: 300px !important;
  font-size: 14px !important;
  padding: 15px !important;
}
</style>

<script>
Swal.fire({
  icon: "success",
  title: "Record Saved Successfully!",
  showConfirmButton: true,
  confirmButtonText: "OK",
  customClass: {
    popup: "custom-small-alert"
  }
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "add-sub-menu.php";
  }
});
</script>
';*/
}
else{
     $qx = "UPDATE tbl_sub_menu SET menuid='$menuid',title='$title',table_values='$table_values',link='$link',
            srno='$srno',user_id='$user_id' WHERE id='$id' ";
    $conn->query($sql);
   echo '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
  icon: "success",
  title: "Record Updated Successfully!",
  showConfirmButton: true,
  confirmButtonText: "OK"
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "add-sub-menu.php";
  }
});
</script>
';
}
      
   

    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<!--<h4 class="font-weight-bold py-3 mb-0">Add Sub Menu</h4>-->


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<div class="row">
<div class="col-lg-8">
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">

<div class="form-group col-md-4 ">
<label class="form-label">Menu</label>
 <select class="form-control" name="menuid" id="menuid">
<option selected="" value="">Select Menu</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_dynamic_menu WHERE Status='1' ORDER BY title";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option value="<?php echo $result['id'];?>">
    <?php echo $result['title']; ?></option>
<?php } ?>
</select>
</div>
 
    <div class="form-group col-md-8">
<label class="form-label">Sub Menu Title </label>
<input type="text" name="title" id="title" class="form-control" placeholder="" value="" autocomplete="off" required>
<div class="clearfix"></div>
    </div>
    
    <div class="form-group col-md-12">
   <label class="form-label">Table Values</label>
     <textarea name="table_values" id="table_values" class="form-control"  
                                                ><?php echo $row7['table_values']; ?></textarea>
    <div class="clearfix"></div>
 </div>

    <div class="form-group col-md-8">
<label class="form-label">link <span class="text-danger">*</span></label>
<input type="text" name="link" id="link" class="form-control" placeholder="" value="<?php echo $row7["link"]; ?>" autocomplete="off" required>
<div class="clearfix"></div>
    </div>

   <div class="form-group col-md-4">
<label class="form-label">Sr No <span class="text-danger">*</span></label>
<input type="number" name="srno" id="srno" class="form-control" placeholder="" value="<?php echo $row7["srno"]; ?>" autocomplete="off" required>
<div class="clearfix"></div>
    </div>

</div>

<button type="submit" name="submit" id="submit" class="btn btn-primary btn-finish">Submit</button>
<span id="error_msg" style="color:red;"></span>

</form>
</div>
<div class="col-lg-4" id="showcart">
    
        
</div>
</div>
</div>
</div>
</div>

<?php include_once 'footer.php'; ?>
</div>
</div>
</div>
<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once '../footer_script.php'; ?>
 <script>
 function balAmt(){
     var TotalAmount = $('#TotalAmount').val();
      var Amount = $('#Amount').val();
      var BalAmt = Number(TotalAmount) - Number(Amount);
       $('#BalAmt').val(parseFloat(BalAmt).toFixed(2));
           
 }
 
 function getAccNo(id){
     var action = "getAccNo";
            $.ajax({
                url: "ajax_files/ajax_customer_invoice.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                success: function(data) {
                  
                    var res = JSON.parse(data);
                    var BankName = res.BankName;
                    var AccNo = res.AccNo;
                  $('#BankName').val(BankName);
                  $('#AccountNo').val(AccNo);
                }
            });
 }
  function getCashAmount(FromDate,ToDate,FrId){
     var action = "getCashAmount";
            $.ajax({
                url: "ajax_files/ajax_customer_invoice.php",
                method: "POST",
                data: {
                    action: action,
                    FromDate: FromDate,
                    ToDate:ToDate,
                    FrId:FrId
                },
                success: function(data) {
                  //alert(data);
                  console.log(data);
                  $('#TotalAmount').val(parseFloat(data).toFixed(2));
                   $('#Amount').val(parseFloat(data).toFixed(2));
                    balAmt();
                }
            });
  }
   
</script>
</body>
</html>