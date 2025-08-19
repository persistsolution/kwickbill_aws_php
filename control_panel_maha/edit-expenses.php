<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Expense-Request";
$Page = "Expense-Request";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Raw Stock
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
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$val = $_GET['val'];
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto FROM tbl_expense_request te LEFT JOIN tbl_users tu ON tu.id=te.UserId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$EmpId = $row7['UserId'];

$sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='".$row7['UserId']."' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    $Wallet = $row88['Credit'] - $row88['Debit'];


if(isset($_POST['submit'])){
    $Amount = addslashes(trim($_POST["Amount"]));
     $ExpenseDate = addslashes(trim($_POST["ExpenseDate"]));
  $Narration = addslashes(trim($_POST["Narration"]));
  $ExpCatId = addslashes(trim($_POST["ExpCatId"]));
  $FrId = addslashes(trim($_POST["FrId"]));
  $Locations = addslashes(trim($_POST["Locations"]));
  $VedPhone = addslashes(trim($_POST["VedPhone"]));
  $PaymentMode = addslashes(trim($_POST["PaymentMode"]));
  $Gst = addslashes(trim($_POST["Gst"]));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_expense_request SET Amount='$Amount',ExpenseDate='$ExpenseDate',Narration='$Narration',ExpCatId='$ExpCatId',FrId='$FrId',Locations='$Locations',VedPhone='$VedPhone',PaymentMode='$PaymentMode',Gst='$Gst' WHERE id = '$id'";
  $conn->query($query2);
  
  
    echo "<script>alert('Expense Update Successfully!');window.location.href='account-pending-expense-request.php';</script>";  
 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Update Expense</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

 <div class="form-group col-md-6">
                                            <label class="form-label">Employee Name</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']." ".$row7['Lname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Wallet Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $Wallet; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Expense Amount</label>
                                            <input type="text" name="Amount" class="form-control"
                                                placeholder="" value="<?php echo $row7["Amount"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Expense Date</label>
                                            <input type="date" name="ExpenseDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ExpenseDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-12">
                                            <label class="form-label">Expense For</label>
                                            <input type="text" name="Narration" class="form-control"
                                                placeholder="" value="<?php echo $row7["Narration"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                              <label class="form-label">Expense Category</label>
                               <select class="form-control" name="ExpCatId" id="ExpCatId" >
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
                            
                               <div class="form-group col-md-4">
                                    <label class="form-label">Franchise</label>
                               <select class="form-control" required name="FrId">
<option selected="" value="0" <?php if($row7["FrId"] == 0) {?> selected <?php } ?>>MAHA CHAI PVT LTD KHAMALA Branch (Main)</option>
 

 <?php 
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!=''";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                  
                            </div>
                            
                               <div class="form-group col-md-3">
                                    <label class="form-label">Locations</label>
                               <select class="form-control" required name="Locations">
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

  <div class="form-group col-md-2">
       <label class="form-label">Vendor Mobile No</label>
                            <input type="number" class="form-control"  value="<?php echo $row7['VedPhone']; ?>" name="VedPhone" required>
                                                
                        </div>
                        


<div class="form-group col-md-4">
                                            <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                                            <select class="form-control" required name="PaymentMode">
                                                <option selected="" disabled="" value="">Select Status</option>
                                                <option value="Cash" <?php if($row7["PaymentMode"]=='Cash') {?> selected
                                                    <?php } ?>>By Cash</option>
                                                <option value="Online" <?php if($row7["PaymentMode"]=='Online') {?> selected
                                                    <?php } ?>>By Online</option>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        
 <div class="form-group col-md-4">
                                            <label class="form-label">GST <span class="text-danger">*</span></label>
                                            <select class="form-control" required name="Gst">
                                                <option selected="" disabled="" value="">Select GST</option>
                                                <option value="No" <?php if($row7["Gst"]=='No') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="Yes" <?php if($row7["Gst"]=='Yes') {?> selected
                                                    <?php } ?>>Yes</option>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
 



                                        
</div>

  


                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Update</button>
                                    </div>

                
                                    </div>
                               </div>


 <div class="col-lg-5" id="emidetails" style="display:none;">
    

 </div>

  
                                

 </div>
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

 
</body>

</html>