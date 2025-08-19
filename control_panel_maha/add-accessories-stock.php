<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Stock";
$Page = "Add-Stock";
$sessionid = session_id();
// echo "<pre>";
// print_r($_SESSION['cart_item']);
if(!isset($_POST['submit'])){
$sql = "DELETE FROM tbl_temp_stock WHERE SessionId='$sessionid'";
$conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Product</title>
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
$sql7 = "SELECT * FROM tbl_accessories_stock_invoice WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
$InvoiceDate = date('Y-m-d');
?>

<?php 
  if(isset($_POST['submit'])){
    $BranchId = $_POST['BranchId'];
    $TotQty = addslashes(trim($_POST['TotQty']));
    $DmNo = addslashes(trim($_POST['DmNo']));
    $StockDate = addslashes(trim($_POST['StockDate']));
    
    $CreatedDate = date('Y-m-d');
$Narration = addslashes(trim($_POST['Narration']));

     $qx = "INSERT INTO tbl_accessories_stock_invoice SET BranchId='$BranchId',TotQty='$TotQty',Status=1,CreatedBy='$user_id',CreatedDate='$CreatedDate',DmNo='$DmNo',StockDate='$StockDate',Narration='$Narration'";
  $conn->query($qx);
  $InvId = mysqli_insert_id($conn);

     $number = count($_POST["AccId"]);
if($number > 0)  
      {  
        for($i=0; $i<$number; $i++)  
          {  
            if(trim($_POST["Qty"][$i] != '' || $_POST["Qty"][$i] != 0))  
              {
                $AccId = $_POST['AccId'][$i];
               $sql = "SELECT * FROM tbl_accessories WHERE id='$AccId' ";
                $row = getRecord($sql);
                $AccName = $row['AccName'];
                $Qty = $_POST['Qty'][$i];
                
                $sql22 = "INSERT INTO tbl_accessories_stock SET BranchId='$BranchId',InvId='$InvId',AccId='$AccId',AccName='$AccName',Qty='$Qty',Status='1',CrDr='cr',CreatedBy='$user_id',CreatedDate='$CreatedDate',Narration='$Narration'";
                $conn->query($sql22);
              }  

          }
      }

      
   echo "<script>alert('Accessories Stock Added Successfully!');window.location.href='view-accessories-stocks.php';</script>";

    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Accessories Stock</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<div class="row">
<div class="col-lg-8">
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">


  <div class="form-group col-md-12">
<label class="form-label"> Branch<span class="text-danger">*</span></label>
 <select class="form-control" name="BranchId" id="BranchId" required>
<?php 
 if($Roll == 1 || $Roll == 7){?>
<option selected="" value="">Select Branch</option>
<?php }
 if($Roll == 1 || $Roll == 7){
  $sql12 = "SELECT * FROM tbl_branch WHERE Status='1'";
}
else{
  $sql12 = "SELECT * FROM tbl_branch WHERE Status='1' AND id='$BranchId'";
}
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["BranchId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Name']; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>


<div class="form-group col-md-6">
<label class="form-label">DM Number <span class="text-danger">*</span></label>
<input type="text" name="DmNo" id="DmNo" class="form-control" placeholder="" value="<?php echo $row7["DmNo"]; ?>" autocomplete="off" required>
<div class="clearfix"></div>
    </div>

<div class="form-group col-md-6">
<label class="form-label">Date <span class="text-danger">*</span></label>
<input type="date" name="StockDate" id="StockDate" class="form-control txt" placeholder="" value="<?php echo $row7["StockDate"]; ?>" autocomplete="off" required>
<div class="clearfix"></div>
    </div>

 </div>
    <div id="dynamic_field">
    <div class="form-row">
<div class="form-group col-md-6 ">
<label class="form-label">Accessories Name</label>
 <select class="form-control" name="AccId[]" id="AccId1" >
<option selected="" value="">Select Accessories</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_accessories WHERE Status='1'";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option value="<?php echo $result['id'];?>">
    <?php echo $result['AccName']; ?></option>
<?php } ?>
</select>
</div>



                                        <div class="form-group col-md-2">
<label class="form-label">Qty </label>
<input type="number" name="Qty[]" id="Qty1" class="form-control txt" placeholder="e.g.,1" value="" autocomplete="off" min="1" oninput="getSubTotal()">
</div>

<input type="hidden" class="form-control" name="srno[]" id="srno1" value="1">

<div class="form-group col-md-1" style="padding-top: 30px;">
<label class="form-label">&nbsp;</label>
<button class="btn btn-secondary" type="button" id="add_more">+</button>
</div>
</div>
</div>

<div class="form-row">



<div class="form-group col-md-12">
<label class="form-label">Total Qty </label>
<input type="text" name="TotQty" id="TotQty" class="form-control" placeholder="" value="<?php echo $row7["TotQty"]; ?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>



<div class="form-group col-md-12">
   <label class="form-label">Narration</label>
     <textarea name="Narration" id="Narration" class="form-control"  
                                                ><?php echo $row7['Narration']; ?></textarea>
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


<?php include_once 'footer_script.php'; ?>
 <script>
    function getSubTotal(){
     var sum = 0;
      $(".txt").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
   });
     $('#TotQty').val(sum);
   
    }

     $(document).ready(function(){
  var i=1; 
    $('#add_more').click(function(){  
           i++;  
       var action = "addMoreService2";
    $.ajax({
    url:"ajax_files/ajax_accessories.php",
    method:"POST",
    data : {action:action,id:i},
    success:function(data)
    {
      $('#dynamic_field').append(data);
    }   
    });  
    }); 

    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete?"))  
           { 
           $('#row'+button_id+'').remove();  
            
           }
      }); 

  }); 
</script>
</body>
</html>