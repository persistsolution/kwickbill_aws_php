<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Manager-Vendor-Expenses";
$Page = "Pay-Vendor-Amount";
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
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu.CustomerId FROM tbl_nso_vendor_expenses te LEFT JOIN tbl_users tu ON tu.id=te.VedId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$CustId = $row7['VedId'];
$CustName = $row7['Fname'];
$AccCode = $row7['CustomerId'];
$InvoiceNo = $row7['InvoiceNo'];
$InvAmount = $row7['Amount'];
$VedId = $row7['VedId'];
$VedNarration = $row7['Narration'];
$Created_By = $row7['CreatedBy'];
$Created_Date = $row7['CreatedDate'];
$PayType = $row7['PaymentMode'];
$sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='".$row7['UserId']."' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    $Wallet = $row88['Credit'] - $row88['Debit'];


if(isset($_POST['submit'])){
    $PayAmount = addslashes(trim($_POST["PayAmount"]));
     $BalAmt = addslashes(trim($_POST["BalAmt"]));
  $PaymentDate = addslashes(trim($_POST["PaymentDate"]));
  $PaymentStatus = addslashes(trim($_POST["PaymentStatus"]));
  $PayNarration = addslashes(trim($_POST["PayNarration"]));
  $UtrNo = addslashes(trim($_POST["UtrNo"]));
  $CreatedDate = date('Y-m-d');

 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_nso_vendor_expenses SET UtrNo='$UtrNo',PayAmount='$PayAmount',BalAmt='$BalAmt',PaymentDate='$PaymentDate',PaymentStatus='$PaymentStatus',PayBy='$user_id',PayNarration='$PayNarration' WHERE id = '$id'";
  $conn->query($query2);
  
   $sql = "INSERT INTO tbl_nso_vendor_expense_ledger SET UtrNo='',UserId='$CustId',AccCode='$AccCode',AccountName='$CustName',InvoiceNo='$InvoiceNo',
      Amount='$InvAmount',PaymentDate='$PaymentDate',CrDr='cr',Roll=3,Type='INV',PayMode='',Narration='$VedNarration',ChequeNo='',ChqDate='',
      BankName='',UpiNo='',CreatedBy='$Created_By',CreatedDate='$Created_Date',ExpId='$id'";
    $conn->query($sql);
    $PostId = mysqli_insert_id($conn);
  
  if($PaymentStatus == 1){
      $sql2 = "SELECT MAX(SrNo) as maxid FROM tbl_nso_vendor_expense_ledger WHERE Type='PR'";
    $row2 = getRecord($sql2);
    if($row2['maxid'] == ''){
        $SrNo = 1;
        $Code = "PR".$SrNo;
    }
    else{
        $SrNo = $row2['maxid']+1;
        $Code = "PR".$SrNo;
    }
    
      $sql = "INSERT INTO tbl_nso_vendor_expense_ledger SET PostId='$PostId',UtrNo='$UtrNo',Code='$Code',SrNo='$SrNo',UserId='$CustId',AccCode='$AccCode',AccountName='$CustName',InvoiceNo='$InvoiceNo',
      Amount='$PayAmount',PaymentDate='$PaymentDate',CrDr='dr',Roll=3,Type='PR',PayMode='$PayType',Narration='$PayNarration',ChequeNo='$ChequeNo',ChqDate='$ChqDate',
      BankName='$BankName',UpiNo='$UpiNo',CreatedBy='$user_id',CreatedDate='$CreatedDate',ExpId='$id'";
      $conn->query($sql);
  }
  
  $sql = "SELECT Fname,Phone FROM tbl_users WHERE id='$VedId'";
  $row = getRecord($sql);
  $VedName = $row['Fname'];
  $VedPhone = $row['Phone'];
  
  $smstxt = "Dear ".$VedName.", Your payment of Rs. ".$PayAmount." against the invoices submitted has been successfully processed vide UTR No. ".$UtrNo.". - Mahachai";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707174722970840066";
  
  $Phone = $VedPhone;
  include '../incsmsapi.php';
  echo "<script>alert('Amount Paid Successfully!');window.location.href='view-payable-amount-nso-vendors.php';</script>";


    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Pay Amount To NSO Vendor</h4>

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
                                            <label class="form-label">Vendor Name</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Trade/Business Name</label>
                                            <input type="text" name="TradeName" class="form-control"
                                                placeholder="" value="<?php echo $row7['TradeName']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Vendor Contact No</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['VedPhone']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Type Of vendor</label>
                                            <select class="form-control" name="TypeOfVendor" id="TypeOfVendor" disabled>
                                                <option value="" selected>...</option>
                                                <?php 
                                                    $sql = "SELECT * FROM tbl_common_master WHERE Roll=1 AND Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){
                                                ?>
                                                <option value="<?php echo $result['id'];?>" <?php if($row7['TypeOfVendor'] == $result['id']){?> selected <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <!--<div class="form-group col-md-3">
                                            <label class="form-label">Wallet Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $Wallet; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>-->
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Invoice No</label>
                                            <input type="text"  class="form-control"
                                                placeholder="" value="<?php echo $row7["InvoiceNo"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Invoice Date</label>
                                            <input type="date" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ExpenseDate"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                          
                                       <!-- <div class="form-group col-md-3">
                                            <label class="form-label">Prev Balance Amount</label>
                                            <input type="text" name="PrevAmount" class="form-control"
                                                placeholder="" value="0" readonly>
                                            <div class="clearfix"></div>
                                        </div> -->
                                        
                                        
                                        
                                       
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">PO No</label>
                                            <input type="text" name="PoNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["PoNo"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                            
                                            <div class="form-group col-md-3">
                                            <label class="form-label">Locations</label>
                                            <select class="form-control" name="Locations" id="Locations" disabled>
<option selected="" value="" disabled>Select Locations</option>
 
<?php  
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!='' AND Status=1 ORDER BY ShopName";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["Locations"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Payment Type</label>
                                            <select class="form-control" name="PaymentMode" id="PaymentMode" disabled>
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Advance Payment" <?php if($row7["PaymentMode"] == 'Advance Payment') {?> selected <?php } ?>>
    Advance Payment</option>
<option value="Final Payment" <?php if($row7["PaymentMode"] == 'Final Payment') {?> selected <?php } ?>>
    Final Payment</option>
</select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Type Of Invoice</label>
                                            <select class="form-control" name="InvType" id="InvType" disabled>
<option selected="" value="" disabled>Select</option>
  <option value="Proforma Invoice" <?php if($row7["InvType"] == 'Proforma Invoice') {?> selected <?php } ?>>
    Proforma Invoice</option>
<option value="Tax Invoice" <?php if($row7["InvType"] == 'Tax Invoice') {?> selected <?php } ?>>
    Tax Invoice</option>
</select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Invoice Amount</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["Amount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">NSO Approve Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7["BdmAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Purchase Approve Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7["PurchaseAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Accountant Approve Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7["MgrAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Admin Approve Amount</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7["AccAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Advance Amount</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["AdvAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Payable Amount</label>
                                            <input type="text" name="PayAmount" class="form-control"
                                                placeholder="" value="<?php echo $row7["AccAmount"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Balance Amount</label>
                                            <input type="text" name="BalAmt" class="form-control"
                                                placeholder="" value="<?php echo $row7["Amount"]-$row7["AccAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       
                                        
                                        
                                        

 <div class="form-group col-md-3">
                                            <label class="form-label">Payment Date</label>
                                            <input type="date" name="PaymentDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["PaymentDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="PaymentStatus" name="PaymentStatus" required="">
                                                <option selected="" disabled="" value="">Select Status</option>
                                                <option value="1" <?php if($row7["PaymentStatus"]=='1') {?> selected
                                                    <?php } ?>>Payment Done</option>
                                                <option value="0" <?php if($row7["PaymentStatus"]=='0') {?> selected
                                                    <?php } ?>>Payment Pending</option>
                                                    <option value="2" <?php if($row7["PaymentStatus"]=='2') {?> selected
                                                    <?php } ?>>Payment Reject</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>

 <!--
 <div class="form-group col-md-12">
                                            <label class="form-label">Comment</label>
                                            <textarea name="MannagerComment" class="form-control"
                                                placeholder=""><?php echo $row7["AdminComment"]; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>-->
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">UTR No <span class="text-danger">*</span></label>
                                            <input type="text" name="UtrNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["UtrNo"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-12">
                                            <label class="form-label">Narration</label>
                                            <input type="text" name="PayNarration" class="form-control"
                                                placeholder="" value="<?php echo $row7["PayNarration"]; ?>" >
                                            <div class="clearfix"></div>
                                        </div>

                            <!--<div class="form-group col-md-6">
                                            <label class="form-label">Invoice</label><br>
                                         <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo']; ?>"  style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>-->
                                       <!-- 
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Payment Receipt</label><br>
                                            <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo2']; ?>" style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>-->

                                        
</div>

  

<br>
                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Submit</button>
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