<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Expense Request";
$UserId = $_SESSION['User']['id']; ?>
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
    <link href="css/toastr.min.css" rel="stylesheet">
      <script src="js/jquery.min3.5.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        
        <?php 
        
        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);
        
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_expense_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

 
        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                      <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                           <input type="hidden" id="TempPrdId" name="TempPrdId" value="<?php echo rand(10000,99999);?>">
                           <input type="hidden" id="TempPrdId2" name="TempPrdId2" value="<?php echo rand(10000,99999);?>">
                            <input type="hidden" name="action" value="updateExpenses" id="action">  
                      
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
                            
                          
                            </div>
                             <div id="expenseContainer">
                            <?php 
                                $i = 1;
                                $sql33 = "SELECT * FROM tbl_expense_request_items WHERE ExpId='$id'";
                                $row33 = getList($sql33);
                                foreach($row33 as $result33){
                            ?>
                              <div class="form-row expense-block" id="row<?php echo $i;?>" style="padding-left: 20px;border: 1px solid;padding-top: 10px;margin-top: 10px;">
                            
                   <div class="form-group float-label active col-6">
                            <input type="text" class="form-control txt" name="Amount[]" id="Amount" value="<?php echo $result33['Amount']; ?>" autofocus required oninput="calTotAmt()">
                            <label class="form-control-label">Amount</label>
                        </div>
                        
                         <div class="form-group float-label active col-6">
                            <input type="date" class="form-control" name="ExpenseDate[]" id="ExpenseDate" value="<?php echo $result33['ExpenseDate']; ?>" required>
                            <label class="form-control-label">Expense Date</label>                            
                        </div>

                        
                          <div class="form-group float-label active col-6">
                               <select class="form-control" name="PaymentMode[]" id="PaymentMode" required>
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Cash" <?php if($result33["PaymentMode"] == 'Cash') {?> selected <?php } ?>>
    By Cash</option>
<option value="Online" <?php if($result33["PaymentMode"] == 'Online') {?> selected <?php } ?>>
    By Online</option>
</select>
                                  <label class="form-control-label">Payment Type</label>
                            </div>

 <div class="form-group float-label active col-6">
                            <input type="number" class="form-control" name="VedPhone[]" id="VedPhone" value="<?php echo $result33['VedPhone']; ?>" required>
                            <label class="form-control-label">Vendor Mobile No</label>                            
                        </div>
                   

                        <div class="form-group float-label active col-12">
                            <input type="text" class="form-control" id="Narration" name="Narration[]" value="<?php echo $result33['Narration']; ?>" required>
                            <label class="form-control-label">Narration</label>                            
                        </div>
                        
                         <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo" name="Photo[]" accept=".png">
                            <label class="form-control-label">Upload Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto[]" id="OldPhoto" value="<?php echo $result33['Photo']; ?>">
                        <?php if($result33['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $result33['Photo']; ?>"><?php echo $result33['Photo']; ?></a><?php } ?>
                       
                      
                      <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo2" name="Photo2[]" accept=".png" >
                            <label class="form-control-label">Upload Payment Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto2[]" id="OldPhoto2" value="<?php echo $result33['Photo2']; ?>">
                        <?php if($result33['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $result33['Photo2']; ?>"><?php echo $result33['Photo2']; ?></a><?php } ?>
                     
                        <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo3" name="Photo3[]" accept=".pdf" >
                            <label class="form-control-label">Upload PDF</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto3[]" id="OldPhoto3" value="<?php echo $result33['Photo3']; ?>">
                        <?php if($result33['Photo3'] == '') {} else{?>
                        <a href="../uploads/<?php echo $result33['Photo3']; ?>"><?php echo $result33['Photo3']; ?></a><?php } ?>
                        
                        
                         <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo4" name="Photo4[]" accept=".png">
                            <label class="form-control-label">Upload Product Image</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto4[]" id="OldPhoto4" value="<?php echo $result33['Photo4']; ?>">
                        <?php if($result33['Photo4'] == '') {} else{?>
                        <a href="../uploads/<?php echo $result33['Photo4']; ?>"><?php echo $result33['Photo4']; ?></a><?php } ?>
                  
                   <div class="form-group float-label active col-12">
                               <select class="form-control" name="Gst[]" id="Gst" required>
<!--<option selected="" value="" disabled>GST</option>-->
<option value="No" <?php if($result33["Gst"] == 'No') {?> selected <?php } ?>>
   No</option>
  <option value="Yes" <?php if($result33["Gst"] == 'Yes') {?> selected <?php } ?>>
   Yes</option>

</select>
                                  <label class="form-control-label">GST</label>
                            </div>
                            
                            <div style="padding: 10px 20px;">
    <button type="button" class="remove-btn btn btn-danger btn-sm" onclick="removeRow(<?php echo $i;?>)">x Remove</button>
</div>

                            </div>
                            <?php $i++;} ?>
                           
                            <div class="form-row expense-block" style="padding-left: 20px;border: 1px solid;padding-top: 10px;margin-top: 10px;">
                            
                   <div class="form-group float-label active col-6">
                            <input type="text" class="form-control txt" name="Amount[]" id="Amount" value="" autofocus oninput="calTotAmt()">
                            <label class="form-control-label">Amount</label>
                        </div>
                        
                         <div class="form-group float-label active col-6">
                            <input type="date" class="form-control" name="ExpenseDate[]" id="ExpenseDate" value="">
                            <label class="form-control-label">Expense Date</label>                            
                        </div>

                        
                          <div class="form-group float-label active col-6">
                               <select class="form-control" name="PaymentMode[]" id="PaymentMode">
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Cash">
    By Cash</option>
<option value="Online">
    By Online</option>
</select>
                                  <label class="form-control-label">Payment Type</label>
                            </div>

 <div class="form-group float-label active col-6">
                            <input type="number" class="form-control" name="VedPhone[]" id="VedPhone" value="">
                            <label class="form-control-label">Vendor Mobile No</label>                            
                        </div>
                   

                        <div class="form-group float-label active col-12">
                            <input type="text" class="form-control" id="Narration" name="Narration[]" value="">
                            <label class="form-control-label">Narration</label>                            
                        </div>
                        
                         <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo" name="Photo[]" accept=".png">
                            <label class="form-control-label">Upload Receipt</label>                            
                        </div>
                        
                      
                      <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo2" name="Photo2[]" accept=".png" >
                            <label class="form-control-label">Upload Payment Receipt</label>                            
                        </div>
                        
                     
                        <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo3" name="Photo3[]" accept=".pdf" >
                            <label class="form-control-label">Upload PDF</label>                            
                        </div>
                       
                         <div class="form-group float-label active col-12">
                            <input type="file" class="form-control" id="Photo4" name="Photo4[]" accept=".png">
                            <label class="form-control-label">Upload Product Image</label>                            
                        </div>
                        
                  
                   <div class="form-group float-label active col-12">
                               <select class="form-control" name="Gst[]" id="Gst">
<!--<option selected="" value="" disabled>GST</option>-->
<option value="No">
   No</option>
  <option value="Yes">
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
                            <input type="text" class="form-control" id="TotAmt" name="TotAmt" value="<?php echo $row7['Amount']; ?>" readonly>
                            <label class="form-control-label">Total Amount</label>                            
                        </div>
                         <div class="form-group float-label active col-6">
                            <input type="date" class="form-control" id="ExpDate" name="ExpDate" value="<?php echo $row7['ExpenseDate']; ?>" required>
                            <label class="form-control-label">Date</label>                            
                        </div>
                        <div class="form-group float-label active col-12">
                            <input type="text" class="form-control" id="Remark" name="Remark" value="<?php echo $row7['Narration']; ?>" required>
                            <label class="form-control-label">Remark/Meesage</label>                            
                        </div>
                    </div>
                    
                        
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                      
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit" onclick="save()">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </main>
<br><br><br>
    <!-- footer-->
    
<?php include 'footer.php';?>

    <!-- Required jquery and libraries -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
function removeRow(button_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#row' + button_id).remove();
            calTotAmt();
            Swal.fire(
                'Deleted!',
                'Your row has been removed.',
                'success'
            )
        }
    });
}

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
                    //alert(data);exit();
                 //console.log(data);exit();
                     
                    if(data == 1){
                        // Android.saveProductClick();
                    // toastr.success('Your expenses request successfully submitted.!', 'Success', {timeOut: 5000}); 
                   setTimeout(function () {
    Swal.fire({
        title: 'Thank you',
        text: 'Your expenses request has been successfully updated.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "view-expenses-mult.php";
        }
    });
}, 500);
                        
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
