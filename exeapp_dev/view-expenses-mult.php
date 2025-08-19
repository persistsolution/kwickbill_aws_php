<?php session_start();
require_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['User']['id'];
$PageName = "My Expenses";
$Page = "Recharge";
$WallMsg = "NotShow"; ?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="css/toastr.min.css" rel="stylesheet">
      <script type="text/javascript" src="js/toastr.min.js"></script>
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?>

        <!-- page content start -->
<?php
$filename = "1709830561313_42714_save_exp_img2_expenses.png";
$seperate = explode("_",$filename);
  $MrdNo = $seperate[1];
   $MrdNo = $seperate[2];
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_expense_request WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="view-expenses.php";
    </script>
<?php } ?>

  <?php 
        
        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);
        
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_expense_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

 
<style>
   .expense-block {
    position: relative;
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
}
.remove-btn {
    position: absolute;
    top: 527px;
    right: 135px;
    z-index: 10;
}
</style>
        <div class="main-container">
            <div class="container">
                 <div style="float:right;">
                                                                   
                 <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default rounded">Add New</a>
            
                                
                                                                </div><br><br>
               
               
               <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">Add Expenses</h4>
      </div>
      <div class="modal-body">
        
        <div class="card">
                   <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                           <input type="hidden" id="TempPrdId" name="TempPrdId" value="<?php echo rand(10000,99999);?>">
                           <input type="hidden" id="TempPrdId2" name="TempPrdId2" value="<?php echo rand(10000,99999);?>">
                            <input type="hidden" name="action" value="saveExpenses" id="action">  
                            
                             <div class="form-group float-label active">
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
                                  <label class="form-control-label">Expense Category</label>
                            </div>
                            
                            <div class="form-group float-label active">
                               <select class="form-control" name="Claims" id="Claims" required>

 

<option value="1" <?php if($row7["Claims"] == 1) {?> selected <?php } ?>>
   Regular Claims</option>
   <option value="2" <?php if($row7["Claims"] == 2) {?> selected <?php } ?>>
   New Execution</option>

</select>
                                  <label class="form-control-label">Expense Claim</label>
                            </div>
                            
                            
                            <div class="form-group float-label active">
                               <select class="form-control" name="FrId" id="FrId" required>
<!--<option selected="" value="0">MAHA CHAI PVT LTD KHAMALA Branch (Main)</option>-->
 

 <?php  
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!='' AND Status=1 AND OwnFranchise IN (1,2)";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                  <label class="form-control-label">Franchise</label>
                            </div>
                            
                            <!--<div class="form-group float-label active">
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
                                  <label class="form-control-label">Locations</label>
                            </div>-->
                            </div>
                            
                            <div id="expenseContainer">
                            <div class="form-row expense-block" style="padding-left: 20px;border: 1px solid;padding-top: 10px;margin-top: 10px;">
                            
                   <div class="form-group float-label active col-6">
                            <input type="text" class="form-control txt" name="Amount[]" id="Amount" value="<?php echo $row7['Amount']; ?>" autofocus required oninput="calTotAmt()">
                            <label class="form-control-label">Amount</label>
                        </div>
                        
                         <div class="form-group float-label active col-6">
                            <input type="date" class="form-control" name="ExpenseDate[]" id="ExpenseDate" value="<?php echo $row7['ExpenseDate']; ?>" required>
                            <label class="form-control-label">Expense Date</label>                            
                        </div>

                        
                          <div class="form-group float-label active col-6">
                               <select class="form-control" name="PaymentMode[]" id="PaymentMode" required>
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Cash" <?php if($row7["PaymentMode"] == 'Cash') {?> selected <?php } ?>>
    By Cash</option>
<option value="Online" <?php if($row7["PaymentMode"] == 'Online') {?> selected <?php } ?>>
    By Online</option>
</select>
                                  <label class="form-control-label">Payment Type</label>
                            </div>

 <div class="form-group float-label active col-6">
                            <input type="number" class="form-control" name="VedPhone[]" id="VedPhone" value="<?php echo $row7['VedPhone']; ?>" required>
                            <label class="form-control-label">Vendor Mobile No</label>                            
                        </div>
                   

                        <div class="form-group float-label active col-12">
                            <input type="text" class="form-control" id="Narration" name="Narration[]" value="<?php echo $row7['Narration']; ?>" required>
                            <label class="form-control-label">Narration</label>                            
                        </div>
                        
                         <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo" name="Photo[]" accept=".png">
                            <label class="form-control-label">Upload Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto" id="OldPhoto" value="<?php echo $row7['Photo']; ?>">
                        <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>"><?php echo $row7['Photo']; ?></a><?php } ?>
                       
                      
                      <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo2" name="Photo2[]" accept=".png" >
                            <label class="form-control-label">Upload Payment Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto2" id="OldPhoto2" value="<?php echo $row7['Photo2']; ?>">
                        <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>"><?php echo $row7['Photo2']; ?></a><?php } ?>
                     
                        <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo3" name="Photo3[]" accept=".pdf" >
                            <label class="form-control-label">Upload PDF</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto3" id="OldPhoto3" value="<?php echo $row7['Photo3']; ?>">
                        <?php if($row7['Photo3'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo3']; ?>"><?php echo $row7['Photo3']; ?></a><?php } ?>
                        
                        
                         <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo4" name="Photo4[]" accept=".png">
                            <label class="form-control-label">Upload Product Image</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto4" id="OldPhoto4" value="<?php echo $row7['Photo4']; ?>">
                        <?php if($row7['Photo4'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo4']; ?>"><?php echo $row7['Photo4']; ?></a><?php } ?>
                  
                   <div class="form-group float-label active col-12">
                               <select class="form-control" name="Gst[]" id="Gst" required>
<!--<option selected="" value="" disabled>GST</option>-->
<option value="No" <?php if($row7["Gst"] == 'No') {?> selected <?php } ?>>
   No</option>
  <option value="Yes" <?php if($row7["Gst"] == 'Yes') {?> selected <?php } ?>>
   Yes</option>

</select>
                                  <label class="form-control-label">GST</label>
                            </div>
                            
                            <div style="padding: 10px 20px;">
    <button type="button" class="btn btn-success" onclick="addExpenseRow()">+ Add</button>
</div>

                            </div>
                </div>
                    </div>
                    <br>
                    
                    <div class="form-row" style="padding-left: 20px;">
                        <div class="form-group float-label active col-6">
                            <input type="text" class="form-control" id="TotAmt" name="TotAmt" value="<?php echo $row7['TotAmt']; ?>" readonly>
                            <label class="form-control-label">Total Amount</label>                            
                        </div>
                         <div class="form-group float-label active col-6">
                            <input type="date" class="form-control" id="ExpDate" name="ExpDate" value="<?php echo date('Y-m-d'); ?>" required>
                            <label class="form-control-label">Date</label>                            
                        </div>
                        <div class="form-group float-label active col-12">
                            <input type="text" class="form-control" id="Remark" name="Remark" value="" required>
                            <label class="form-control-label">Remark/Meesage</label>                            
                        </div>
                    </div>
                    
                   
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                     
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Submit</button>
                    </div>
                </form>
                </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 
<?php 
// $earlier = new DateTime("2024-07-20");
// $later = new DateTime("2024-07-26");
 

// echo $neg_diff = $later->diff($earlier)->format("%r%a"); 
?>

                        <?php 
                             $sql = "SELECT * FROM tbl_expense_request WHERE UserId='$user_id' ORDER BY id DESC";
                            $row = getList($sql);
                            foreach($row as $result){
                                
                                if($result['TotDays']>=0 && $result['TotDays']<=6){
                                     $totdays = 0; //less than 7
                                 }
                                 else{
                                     $totdays = 1; // more than 7
                                 }
                            $UserId = $result['UserId'];
                            $sql2 = "SELECT tu2.Fname,tu.UnderByUser FROM tbl_users tu INNER JOIN tbl_users tu2 ON tu2.id=tu.UnderByUser WHERE tu.id='$UserId'";
                            $row2 = getRecord($sql2);
                            $UnderByUser = $row2['UnderByUser'];
                            
                            $sql22 = "SELECT tu2.Fname FROM tbl_users tu INNER JOIN tbl_users tu2 ON tu2.id=tu.UnderByUser WHERE tu.id='$UnderByUser'";
                            $rncnt22 = getRow($sql22);
                            $row22 = getRecord($sql22);
                           
                            if($rncnt22 > 0){
                            if($result['Amount'] <= 5000 && $result['ExpCatId']!=3){
                                $AdminStatus =  "Pending By ".$row22['Fname'];
                            }
                            else{
                                $AdminStatus = "Pending By Admin";
                            }
                            }
                            else{
                                $AdminStatus = "Pending By Admin";
                            }
                           
                            ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1" style="color:#f06721;">&#8377;<?php echo number_format($result['Amount'],2);?> </h5>
                                        <p class="text-secondary"><strong>Exp Id : </strong><?php echo $result['id'];?><br><?php echo $result['Narration'];?><br><span style="color:gray;"><?php echo $result['ExpenseDate'];?></span>
                                        <br>Pay By 
                                        <span style="font-weight:500;"><?php echo $result['PaymentMode'];?></span></p>
                                        
                                       Manager Status : <?php if($result['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved </span>";} else if($result['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected </span>";} else { echo "<span style='color:orange;'>Pending </span>"; } ?>
                                        <br>
                                        Manager Comment : <?php echo $result['MannagerComment'];?>
                                        <br>
                                        Admin Status : <?php if($result['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved</span>";} else if($result['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected  </span>";} else { echo "<span style='color:orange;'>Pending </span>"; } ?> 
                                        <br>
                                        Admin Comment : <?php echo $result['AdminComment'];?>
                               

                                    </div>
                                    <?php if($result['ManagerStatus']!='1' || $result['AdminStatus']!='1'){?>
                                    <div class="col-auto pl-0">
                                        <button class="btn btn-40 bg-default-light text-default rounded-circle">
                                            <a href="add-mult-expenses.php?id=<?php echo $result['id'];?>" class="btn-danger btn btn-sm btn-30 rounded"><i class="fa fa-edit"></i></a>
                                        <!--<a href="javascript:void(0)" onclick="getExpId(<?php echo $result['id'];?>)"  class="btn-danger btn btn-sm btn-30 rounded"><i class="fa fa-trash"></i></a>-->
                                        <a href="view-expenses-mult.php?action=delete&id=<?php echo $result['id'];?>"  class="btn-danger btn btn-sm btn-30 rounded"><i class="fa fa-trash"></i></a>
                     
                                        </button>
                                    </div>
                                    <?php } ?>
                                   
                                </div>
                               
                            </div>
                        </div>
                         <?php } ?>
                        
                        <input type="text" class="Exp_Id" value="">
                   

            </div>
        </div>
    </main>

<?php include 'footer.php';?>
    <!--  jquery and libraries -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="js/app.js"></script>
   <script>
function addExpenseRow() {
    const container = document.getElementById('expenseContainer');
    const lastBlock = container.querySelector('.expense-block:last-child');
    const newBlock = lastBlock.cloneNode(true);

    // Clear inputs
    newBlock.querySelectorAll('input').forEach(input => {
        if (input.type !== 'hidden') input.value = '';
    });
    newBlock.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    newBlock.querySelectorAll('a').forEach(a => a.remove());

    // Remove any existing remove button from cloned block
    const existingRemove = newBlock.querySelector('.remove-btn');
    if (existingRemove) existingRemove.remove();

    // Add remove button only if it's not the first row
    if (container.querySelectorAll('.expense-block').length >= 1) {
        const removeBtn = document.createElement('button');
        removeBtn.innerHTML = '&times; Remove';
        removeBtn.setAttribute('type', 'button');
        removeBtn.setAttribute('class', 'remove-btn btn btn-danger btn-sm');
        removeBtn.onclick = function () {
            newBlock.remove();
        };
        newBlock.appendChild(removeBtn);
    }

    container.appendChild(newBlock);
}
</script>
<script>
function calTotAmt(){
    getSubTotal();
}
function getSubTotal(){
     var sum = 0;
      $(".txt").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
   });
     $('#TotAmt').val(sum);
   
    }
    
    function getExpId(id){
        $('#myModal').modal('show');
        $('.Exp_Id').val(id);
    }
    
    function uploadImageSingle(prdid){
    //alert(prdid);
    var action = "save"; 
    var pageval = "expenses";
    //Android.uploadImageSingle(''+prdid+'',''+action+'',''+pageval+'');
}

function uploadImageSingle2(prdid){
    //alert(prdid);
    var action = "saveexpimg2";
    var pageval = "expenses";
   // Android.uploadImageSingle(''+prdid+'',''+action+'',''+pageval+'');
}



 $(document).ready(function() {
     $('#validation-form').on('submit', function(e){
      e.preventDefault();    
     
     $.ajax({  
                url :"ajax_files/ajax_expenses_mult.php",  
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
          window.location.href="view-expenses-mult.php";
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
     });
 });

</script>
   
</body>

</html>
