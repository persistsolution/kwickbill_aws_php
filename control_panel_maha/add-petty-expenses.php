<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Petty-Expenses";
$Page = "Add-Petty-Expenses";

?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Expenses</title>
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
$sql7 = "SELECT * FROM tbl_expense_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>



<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Add Expenses</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
 <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                           
                            <input type="hidden" name="action" value="saveExpenses" id="action">  
                            
                            <div class="form-row">

<div class="form-group col-md-6">
     <label class="form-label">Expense Category</label>
                               <select class="form-control" name="ExpCatId" id="ExpCatId" required>
<option selected="" value="" disabled>Select Expense Category</option>
 

 <?php 
    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["ExpCatId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['Name'];?></option>
     <?php } ?>
</select>
                                 
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label class="form-label">Expense Claim</label>
                               <select class="form-control" name="Claims" id="Claims" required>

 

<option value="1" <?php if($row7["Claims"] == 1) {?> selected <?php } ?>>
   Regular Claims</option>
   <option value="2" <?php if($row7["Claims"] == 2) {?> selected <?php } ?>>
   New Execution</option>

</select>
                                  
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label class="form-label">Franchise</label>
                               <select class="form-control" name="FrId" id="FrId" required>

 

 <?php  
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!='' AND Status=1 AND OwnFranchise IN (1,2)";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                  
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="form-label">Locations</label>
                               <select class="form-control" name="Locations" id="Locations" required>
<option selected="" value="" disabled>Select Locations</option>
 

 <?php 
    $sql33 = "SELECT * FROM `tbl_locations` WHERE Status=1";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["Locations"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['Name'];?></option>
     <?php } ?>
</select>
                                  
                            </div>
                            
                   <div class="form-group col-md-6">
                       <label class="form-label">Amount</label>
                            <input type="text" class="form-control" name="Amount" id="Amount" value="<?php echo $row7['Amount']; ?>" autofocus required>
                            
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-label">Expense Date</label>                     
                            <input type="date" class="form-control" name="ExpenseDate" id="ExpenseDate" value="<?php echo $row7['ExpenseDate']; ?>">
                                   
                        </div>

                        
                         <div class="form-group col-md-6">
                             <label class="form-label">Payment Type</label>
                               <select class="form-control" name="PaymentMode" id="PaymentMode" required>
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Cash" <?php if($row7["PaymentMode"] == 'Cash') {?> selected <?php } ?>>
    By Cash</option>
<option value="Online" <?php if($row7["PaymentMode"] == 'Online') {?> selected <?php } ?>>
    By Online</option>
</select>
                                  
                            </div>

<div class="form-group col-md-6">
    <label class="form-label">Vendor Mobile No</label>   
                            <input type="number" class="form-control" name="VedPhone" id="VedPhone" value="<?php echo $row7['VedPhone']; ?>" required>
                                                     
                        </div>
                   

                        <div class="form-group col-md-6">
                            <label class="form-label">Narration</label>      
                            <input type="text" class="form-control" id="Narration" name="Narration" value="<?php echo $row7['Narration']; ?>" required>
                                                  
                        </div>
                        
                         <div class="form-group col-md-6">
                             <label class="form-label">Upload Receipt</label>        
                            <input type="file" class="form-control" id="Photo" name="Photo" onclick="uploadImageSingle(document.getElementById('TempPrdId').value)">
                                                
                        </div>
                          <input type="hidden" name="OldPhoto" id="OldPhoto" value="<?php echo $row7['Photo']; ?>">
                        <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>"><?php echo $row7['Photo']; ?></a><?php } ?>
                       
                      
                      <div class="form-group col-md-6">
                          <label class="form-label">Upload Payment Receipt</label>           
                            <input type="file" class="form-control" id="Photo2" name="Photo2" onclick="uploadImageSingle2(document.getElementById('TempPrdId2').value)">
                                             
                        </div>
                          <input type="hidden" name="OldPhoto2" id="OldPhoto2" value="<?php echo $row7['Photo2']; ?>">
                        <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>"><?php echo $row7['Photo2']; ?></a><?php } ?>
                     
                       <div class="form-group col-md-6">
                            <label class="form-label">Upload PDF</label>      
                            <input type="file" class="form-control" id="Photo3" name="Photo3">
                                                 
                        </div>
                          <input type="hidden" name="OldPhoto3" id="OldPhoto3" value="<?php echo $row7['Photo3']; ?>">
                        <?php if($row7['Photo3'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo3']; ?>"><?php echo $row7['Photo3']; ?></a><?php } ?>
                  
                   <div class="form-group col-md-6">
                        <label class="form-label">GST</label>
                               <select class="form-control" name="Gst" id="Gst" required>
<!--<option selected="" value="" disabled>GST</option>-->
<option value="No" <?php if($row7["Gst"] == 'No') {?> selected <?php } ?>>
   No</option>
  <option value="Yes" <?php if($row7["Gst"] == 'Yes') {?> selected <?php } ?>>
   Yes</option>

</select>
                                 
                            </div>
                            
                
                    
                        </div>
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                     
                   <button type="submit" name="submit" id="submit" class="btn btn-primary btn-finish">Submit</button>
                   
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
     $(document).ready(function() {
     $('#validation-form').on('submit', function(e){
      e.preventDefault();    
     if ($('#validation-form').valid()) {
     $.ajax({  
                url :"ajax_files/ajax_petty_expenses.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                 beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').text('Please Wait...');
    },
                success:function(data){ 
                    //alert(data);
                     $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                 //console.log(data);exit();
                     
                    if(data == 1){
                        // Android.saveProductClick();
                    // toastr.success('Your expenses request successfully submitted.!', 'Success', {timeOut: 5000}); 
                    setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your expenses request successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-petty-expenses.php";
  }
}); });
                        
                     }
                     else if(data == 0){
                         setTimeout(function () { 
swal({
  title: "Error",
  text: "today Same amount expenses request already exists!",
  type: "error",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          
  }
}); });
                     }
                    
                    
                    
                      $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                }  
           })
     } else {
                //$('#Fname').focus();
                return false;
            }
     });
 });
 </script>
</body>
</html>