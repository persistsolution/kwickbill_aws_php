<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Vendor Expenses";
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
$sql7 = "SELECT * FROM tbl_vendor_expenses WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
if($_GET['id'] == ''){
    $Locations = $UnderFrId;
}
else{
    $Locations = $row7["Locations"];
}
?>


        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" enctype="multipart/form-data">
   <div class="card-body">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="saveExpenses" id="action">
                                    <input type="hidden" id="TempPrdId" name="TempPrdId" value="<?php echo rand(10000,99999);?>">
                           <input type="hidden" id="TempPrdId2" name="TempPrdId2" value="<?php echo rand(10000,99999);?>">
                           
                         
                        
                                        <div class="form-group float-label active">
                                            <label class="form-label">Vendor <span class="text-danger">*</span></label>
                                            <select class="select2-demo form-control" style="width: 100%" data-allow-clear="true" name="VedId" id="CustId" required>
                                                <option>Search Vendor</option>
                                                <?php
                                                $sql4 = "SELECT * FROM tbl_users WHERE Status=1 AND Roll=3";
                                                $row4 = getList($sql4);
                                                foreach ($row4 as $result) {
                                                ?>
                                                    <option <?php if ($row7["UserId"] == $result['id']) { ?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname'] . " - " . $result['Phone']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group float-label active">
                            <input type="text" class="form-control" name="TradeName" id="TradeName" value="<?php echo $row7['TradeName']; ?>" required>
                            <label class="form-control-label">Trade/Business Name</label>                            
                        </div>
                                        
                                         <div class="form-group float-label active">
                            <input type="number" class="form-control" name="VedPhone" id="VedPhone" value="<?php echo $row7['VedPhone']; ?>" required>
                            <label class="form-control-label">Vendor Mobile No</label>                            
                        </div>
                        
                        <div class="form-group float-label active">
                                            
                                            <select class="form-control" name="TypeOfVendor" id="TypeOfVendor" required>
                                                <option value="" selected>...</option>
                                                <?php 
                                                    $sql = "SELECT * FROM tbl_common_master WHERE Roll=1 AND Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){
                                                ?>
                                                <option value="<?php echo $result['id'];?>"><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                            </select>
                                            <label class="form-control-label">Type Of vendor</label>    
                                        </div>
                        
                          <div class="form-group float-label active">
                            <input type="text" class="form-control" name="InvoiceNo" id="InvoiceNo" value="<?php echo $row7['InvoiceNo']; ?>" required>
                            <label class="form-control-label">Invoice No <span class="text-danger">*</span></label>                            
                        </div>
                        
                                          <div class="form-group float-label active">
                            <input type="text" class="form-control" name="Amount" id="Amount" value="<?php echo $row7['Amount']; ?>" autofocus required>
                            <label class="form-control-label">Invoice Amount</label>
                        </div>
                        
                         <div class="form-group float-label active">
                            <input type="date" class="form-control" name="ExpenseDate" id="ExpenseDate" value="<?php echo $row7['ExpenseDate']; ?>" required>
                            <label class="form-control-label">Invoice Date</label>                            
                        </div>
                        
                         <div class="form-group float-label active">
                            <input type="text" class="form-control" name="PoNo" id="PoNo" value="<?php echo $row7['PoNo']; ?>" required>
                            <label class="form-control-label">PO No <span class="text-danger">*</span></label>                            
                        </div>

 <div class="form-group float-label active">
                               <select class="form-control" name="Locations" id="Locations" required>
<option selected="" value="" disabled>Select Locations</option>
 

 <?php  
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!='' AND Status=1 AND OwnFranchise IN (1,2) ORDER BY ShopName";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($Locations == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                  <label class="form-control-label">Locations</label>
                            </div>
                        
                          <div class="form-group float-label active">
                               <select class="form-control" name="PaymentMode" id="PaymentMode" required>
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Advance Payment" <?php if($row7["PaymentMode"] == 'Advance Payment') {?> selected <?php } ?>>
    Advance Payment</option>
<option value="Final Payment" <?php if($row7["PaymentMode"] == 'Final Payment') {?> selected <?php } ?>>
    Final Payment</option>
</select>
                                  <label class="form-control-label">Payment Type</label>
                            </div>


                   <div class="form-group float-label active">
                            <input type="text" class="form-control" name="AdvAmount" id="AdvAmount" value="<?php echo $row7['AdvAmount']; ?>" autofocus required>
                            <label class="form-control-label">Advance Amount</label>
                        </div>
                        
                        <div class="form-group float-label active">
                               <select class="form-control" name="InvType" id="InvType" required>
<option selected="" value="" disabled>Select</option>
  <option value="Proforma Invoice" <?php if($row7["InvType"] == 'Proforma Invoice') {?> selected <?php } ?>>
    Proforma Invoice</option>
<option value="Tax Invoice" <?php if($row7["InvType"] == 'Tax Invoice') {?> selected <?php } ?>>
    Tax Invoice</option>
</select>
                                  <label class="form-control-label">Type Of Invoice</label>
                            </div>

                        <div class="form-group float-label active">
                            <textarea class="form-control" id="Narration" name="Narration"><?php echo $row7['Narration']; ?></textarea>
                            <label class="form-control-label">Narration</label>                            
                        </div>
                        
                         <div class="form-group float-label active">
                            <input type="file" class="form-control" id="Photo" name="Photo" accept=".png" onclick="uploadImageSingle(document.getElementById('TempPrdId').value)">
                            <label class="form-control-label">Upload Invoice</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto" id="OldPhoto" value="<?php echo $row7['Photo']; ?>">
                        <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>"><?php echo $row7['Photo']; ?></a><?php } ?>
                       
                        <div class="form-group float-label active">
                            <input type="file" class="form-control" id="Photo2" name="Photo2" accept=".pdf" >
                            <label class="form-control-label">Upload PDF</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto2[]" id="OldPhoto2" value="<?php echo $result33['Photo2']; ?>">
                        <?php if($result33['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $result33['Photo2']; ?>"><?php echo $result33['Photo2']; ?></a><?php } ?>
                        
                    <!--  <div class="form-group float-label active">
                            <input type="file" class="form-control" id="Photo2" name="Photo2" onclick="uploadImageSingle2(document.getElementById('TempPrdId2').value)">
                            <label class="form-control-label">Upload Payment Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto2" id="OldPhoto2" value="<?php echo $row7['Photo2']; ?>">
                        <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>"><?php echo $row7['Photo2']; ?></a><?php } ?>
                     
                  
                  -->
                                    
                                    <input type="hidden" id="Status" name="Status" value="0">
                                  

<div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Submit</button>
                    </div>
  </div>
                                   
                                </form>
                </div>
            </div>
        </div>
    </main>
<br><br><br><br>
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
    <script>
      $(document).ready(function() {
     $('#validation-form').on('submit', function(e){
      e.preventDefault();    
     
     $.ajax({  
                url :"ajax_files/ajax_vendor_expenses.php",  
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
                // console.log(data);exit();
                     
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
          window.location.href="view-vendor-expenses.php";
  }
}); });
                        
                     }
                    
                    
                     
                      $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                }  
           })
     });

            $(document).on("change", "#CustId", function(event) {
                var val = this.value;
                var action = "getUserDetails";
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: val
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#TradeName').val(data.TradeName);
                        $('#CustName').val(data.Fname);
                        $('#VedPhone').val(data.Phone);
                        $('#EmailId').val(data.EmailId);
                        $('#AccCode').val(data.CustomerId);
                        $('#TypeOfVendor').val(data.TypeOfVendor).attr("selected",true);
                    }
                });

            });
        });
    </script>
   
</body>

</html>
