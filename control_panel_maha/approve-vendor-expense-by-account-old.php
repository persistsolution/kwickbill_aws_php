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
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto FROM tbl_vendor_expenses te LEFT JOIN tbl_users tu ON tu.id=te.VedId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$EmpId = $row7['UserId'];

$sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='".$row7['UserId']."' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    $Wallet = $row88['Credit'] - $row88['Debit'];

$sql881 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when status='cr' then sum(amount) else 0 end) as creditAmt,(case when status='dr' then sum(amount) else 0 end) as debitAmt FROM tbl_balance_ved_expenses WHERE vedid='".$row7['VedId']."' GROUP BY status) as a";
    $row881 = getRecord($sql881);
    $PrevBalAmt = $row881['Credit'] - $row881['Debit'];

if(isset($_POST['submit'])){
    $ApproveDate = addslashes(trim($_POST["ApproveDate"]));
     $MannagerComment = addslashes(trim($_POST["MannagerComment"]));
  $AccAmount = addslashes(trim($_POST["AccAmount"]));
  $ManagerStatus = addslashes(trim($_POST["ManagerStatus"]));
  $AccBalance = addslashes(trim($_POST["AccBalance"]));
  $MgrAmount = addslashes(trim($_POST["MgrAmount"]));
  $VedId = addslashes(trim($_POST["VedId"]));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $CreatedDate = date('Y-m-d H:i:s');
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_vendor_expenses SET AdminApproveDate='$ApproveDate',AdminComment='$MannagerComment',AccAmount='$AccAmount',AdminStatus='$ManagerStatus',AccBy='$user_id',Status='$ManagerStatus',AccBalance='$AccBalance' WHERE id = '$id'";
  $conn->query($query2);
  
  /*if($ManagerStatus == 1){
  $sql = "DELETE FROM wallet WHERE UserId='$EmpId' AND ExpId='$id'";
  $conn->query($sql);
  $Narration = "Amount Deduct against Expense For ".$row7["Narration"];
  $sql = "INSERT INTO wallet SET UserId='$EmpId',Amount='$AccAmount',Narration='$Narration',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ExpId='$id'";
  $conn->query($sql);
  }*/ 
  
  if($ManagerStatus == 1){
   $sql = "DELETE FROM tbl_balance_ved_expenses WHERE expid='$id'";
  $conn->query($sql);
    $sql = "INSERT INTO tbl_balance_ved_expenses SET expid='$id',amount='$MgrAmount',status='cr',expdate='$ApproveDate',createdby='$user_id',createddate='$CreatedDate',vedid='$VedId'";
      $conn->query($sql);
      $sql = "INSERT INTO tbl_balance_ved_expenses SET expid='$id',amount='$AccAmount',status='dr',expdate='$ApproveDate',createdby='$user_id',createddate='$CreatedDate',vedid='$VedId'";
      $conn->query($sql);
  }
  if($val == 'mgr'){
      echo "<script>alert('Approved Successfully!');window.location.href='expense-request2.php';</script>";
  }
  else{
    echo "<script>alert('Approved Successfully!');window.location.href='account-vendor-pending-expense-request.php';</script>";  
  }
  


    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Approve Expense</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                     <input type="hidden" name="VedId" value="<?php echo $row7['VedId']; ?>" id="VedId">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

 <div class="form-group col-md-6">
                                            <label class="form-label">Vendor Name</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']." ".$row7['Lname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Vendor Contact No</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['VedPhone']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Invoice No</label>
                                            <input type="text"  class="form-control"
                                                placeholder="" value="<?php echo $row7['InvoiceNo']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <!-- <div class="form-group col-md-4">
                                            <label class="form-label">Wallet Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $Wallet; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>-->
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Expense Amount</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["Amount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Admin Approve Amount</label>
                                            <input type="text" name="MgrAmount" class="form-control" id="MgrAmount"
                                                placeholder="" value="<?php echo $row7["MgrAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div> 
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Previous Balance</label>
                                            <input type="text" class="form-control" id="PrevBalAmt"
                                                placeholder="" value="<?php echo $PrevBalAmt; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Advance Amount</label>
                                            <input type="text" name="AccAmount" class="form-control" id="AccAmount"
                                                placeholder="" value="<?php echo $row7["AccAmount"]; ?>" required oninput="balanceAmt()">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Balance Amount</label>
                                            <input type="text" name="AccBalance" class="form-control" id="AccBalance"
                                                placeholder="" value="<?php echo $row7["AccBalance"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Expense/Invoice Date</label>
                                            <input type="date" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ExpenseDate"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-12">
                                            <label class="form-label">Expense For</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["Narration"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>

 <div class="form-group col-md-6">
                                            <label class="form-label">Approve Date</label>
                                            <input type="date" name="ApproveDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["AdminApproveDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>

 <div class="form-group col-md-6">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="ManagerStatus" name="ManagerStatus" required="">
                                                <option selected="" disabled="" value="">Select Status</option>
                                                <option value="1" <?php if($row7["AdminStatus"]=='1') {?> selected
                                                    <?php } ?>>Approved</option>
                                                <option value="0" <?php if($row7["AdminStatus"]=='0') {?> selected
                                                    <?php } ?>>Pending</option>
                                                    <option value="2" <?php if($row7["AdminStatus"]=='2') {?> selected
                                                    <?php } ?>>Reject</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
 <div class="form-group col-md-12">
                                            <label class="form-label">Comment</label>
                                            <textarea name="MannagerComment" class="form-control"
                                                placeholder=""><?php echo $row7["AdminComment"]; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>

<div class="form-group col-md-6">
                                            <label class="form-label">Receipt</label><br>
                                         <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo']; ?>"  style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Payment Receipt</label><br>
                                            <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo2']; ?>" style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>

                                        
</div>

  


                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Approve</button>
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

 <script>
     function balanceAmt(){
         var MgrAmount = $('#MgrAmount').val();
        var AccAmount = $('#AccAmount').val();
        var PrevBalAmt = $('#PrevBalAmt').val();
        var BalAmt = Number(MgrAmount) + Number(PrevBalAmt) - Number(AccAmount);
        $('#AccBalance').val(parseFloat(BalAmt).toFixed(2))
     }
     
     $(document).ready(function() {
        balanceAmt();
     });
 </script>
</body>

</html>