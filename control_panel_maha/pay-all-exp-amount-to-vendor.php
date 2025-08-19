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
<title><?php echo $Proj_Title; ?> </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">




<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Pay Invoice Amount To Vendor
  
</h4>

<div class="card" style="padding: 10px;">
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 <div class="form-group col-md-4">
<label class="form-label"> Vendor<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="VedId" id="VedId" required>
<option selected="" value="">Select Vendor</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll IN(3) AND Fname!='' ORDER BY Fname";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["VedId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>
 
<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top: 30px;">
    <label class="form-label">&nbsp;</label>
<button type="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="form-group col-md-1">
<label class="form-label">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>
   
   <?php 
if (isset($_POST['selected_ids']) && is_array($_POST['selected_ids'])) {
    $selected = $_POST['selected_ids'];
    $ids = implode(",", $selected);
    
    $TotPayAmount = addslashes(trim($_POST["TotPayAmount"]));
    $PaymentDate = addslashes(trim($_POST["PaymentDate"]));
    $PaymentStatus = addslashes(trim($_POST["PaymentStatus"]));
    $PayNarration = addslashes(trim($_POST["PayNarration"]));
    $UtrNo = addslashes(trim($_POST["UtrNo"]));
    $CreatedDate = date('Y-m-d');

    $sql7 = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, tu.CustomerId, tu.Phone 
             FROM tbl_vendor_expenses te 
             LEFT JOIN tbl_users tu ON tu.id = te.VedId 
             WHERE te.id IN ($ids)";
    $result7 = getList($sql7);

    $VedName = '';
    $VedPhone = '';

    foreach($result7 as $row7) {
        $id = $row7['id'];
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
        $PayAmount = $row7['AccAmount'];
        $UserId = $row7['UserId'];

        // Get wallet balance (optional: not used later)
        $sql88 = "SELECT SUM(creditAmt) AS Credit, SUM(debitAmt) AS Debit 
                  FROM (
                      SELECT 
                          CASE WHEN Status='Cr' THEN SUM(Amount) ELSE 0 END AS creditAmt,
                          CASE WHEN Status='Dr' THEN SUM(Amount) ELSE 0 END AS debitAmt 
                      FROM wallet 
                      WHERE UserId='$UserId' 
                      GROUP BY Status
                  ) AS a";
        $row88 = getRecord($sql88);
        $Wallet = $row88['Credit'] - $row88['Debit'];

        // Update expense
        $query2 = "UPDATE tbl_vendor_expenses 
                   SET UtrNo='$UtrNo', PayAmount='$PayAmount', BalAmt='0', PaymentDate='$PaymentDate', 
                       PaymentStatus='$PaymentStatus', PayBy='$user_id', PayNarration='$PayNarration' 
                   WHERE id = '$id'";
        $conn->query($query2);

        // Ledger entry for invoice
        $sql = "INSERT INTO tbl_vendor_expense_ledger 
                SET UtrNo='', UserId='$CustId', AccCode='$AccCode', AccountName='$CustName', 
                    InvoiceNo='$InvoiceNo', Amount='$InvAmount', PaymentDate='$PaymentDate', 
                    CrDr='cr', Roll=3, Type='INV', PayMode='', Narration='$VedNarration', 
                    ChequeNo='', ChqDate='', BankName='', UpiNo='', 
                    CreatedBy='$Created_By', CreatedDate='$Created_Date', ExpId='$id'";
        $conn->query($sql);
        $PostId = mysqli_insert_id($conn);

        if ($PaymentStatus == 1) {
            $sql2 = "SELECT MAX(SrNo) AS maxid FROM tbl_vendor_expense_ledger WHERE Type='PR'";
            $row2 = getRecord($sql2);
            $SrNo = $row2['maxid'] ? $row2['maxid'] + 1 : 1;
            $Code = "PR" . $SrNo;

            $sql = "INSERT INTO tbl_vendor_expense_ledger 
                    SET PostId='$PostId', UtrNo='$UtrNo', Code='$Code', SrNo='$SrNo', UserId='$CustId', 
                        AccCode='$AccCode', AccountName='$CustName', InvoiceNo='$InvoiceNo', 
                        Amount='$PayAmount', PaymentDate='$PaymentDate', CrDr='dr', Roll=3, Type='PR', 
                        PayMode='$PayType', Narration='$PayNarration', ChequeNo='', ChqDate='', 
                        BankName='', UpiNo='', CreatedBy='$user_id', CreatedDate='$CreatedDate', ExpId='$id'";
            $conn->query($sql);
        }

        // Capture user info for SMS once
        if ($VedName == '') {
            $VedName = $row7['Fname'];
            $VedPhone = $row7['Phone'];
        }
    }

    // ✅ Send SMS one time after all updates
    if ($VedPhone != '') {
        $smstxt = "Dear $VedName, Your payment of Rs. $TotPayAmount against the invoices submitted has been successfully processed vide UTR No. $UtrNo. - Mahachai";
        $dltentityid = "1501701120000037351";
        $dlttempid = "1707174722970840066";
        $Phone = $VedPhone;

        include '../incsmsapi.php';
    }
}
?>

<?php if(isset($_POST['Search'])) {?>
<div class="card-datatable table-responsive">
    <form method="post" action="">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                 <th>Expense Id</th>
               
                  <th>Amount</th>
                    <th>Admin Approve Amount</th>
                 <th>Invoice No</th>
                    <th>Invoice Date</th>
                 
               
                 <th>Vendor Name</th>
                <th>Vendor Mobile No</th>
                    <th>Account Approve</th>
                   <th>Admin Approve</th>
                 <th>Location</th>
              
                
               
                <th>PaymentMode</th>
                <th>Narration</th>
                 <th>Receipt</th>
                <th>Payment Receipt</th>
              <th>Created By</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
          $VedId = $_POST['VedId'];
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS AccName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus='1' AND te.PaymentStatus=0 AND te.UserId!=0 AND te.Locations IN($AssignFranchiseVedExp) AND te.ExpenseDate>='2025-05-01'"; 
           
             if ($_POST['FromDate']) {
            $FromDate = $_POST['FromDate'];
            $sql .= " AND te.AdminApproveDate >= '$FromDate'";
        }
        if ($_POST['ToDate']) {
            $ToDate = $_POST['ToDate'];
            $sql .= " AND te.AdminApproveDate <= '$ToDate'";
        }
        
         if (!empty($VedId) && $VedId !== 'all'){
                $sql.=" AND te.VedId='$VedId'";
            }
            $sql.=" ORDER BY te.ExpenseDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                    $MgrName = $row['MgrName'];
                    $AccName = $row['AccName'];
               
             ?>
            <tr>
                
<td><input type="checkbox" class="rowCheckbox" name="selected_ids[]" 
         value="<?php echo $row['id']; ?>" 
         data-amount="<?php echo $row['Amount']; ?>"></td>
<td><?php echo $row['id'];?></td>
  
   
         <td><?php echo $row['Amount']; ?></td>
           <td><?php echo $row['AccAmount']; ?></td>
   <td><?php echo $row['InvoiceNo']; ?></td>
   <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
   
   <!--<td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>-->
              
               <td><a href="vendor-details.php?id=<?php echo $row['VedId'];?>" target="_blank"><?php echo $row['VedName']; ?></a></td>
              <td><?php echo $row['VedPhone']; ?></td>
              
 <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else {?>
 Approve By Accountant<?php } ?>
  </td>
  <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName</span>";} else {?>
 Approve By Admin<?php } ?>
  </td>

<td><?php echo $row['ShopName'];?></td>
               
                
              
               <!--  <td><?php echo $row['UtrNo']; ?></td>-->
               <td><?php echo $row['PaymentMode']; ?></td>
                  <td><?php echo $row['Narration']; ?></td>
              <td><?php if($row["Photo"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <a href="../uploads/<?php echo $row["Photo"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
              <td><?php if($row["Photo2"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo2"])){?>
                 <a href="../uploads/<?php echo $row["Photo2"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
                     
                 <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
              
           
           
            </tr>
           <?php $i++;} ?>
        </tbody>
    </table>
    
    <div class="row">
    <div class="form-group col-md-3">
                                            <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                                            <input type="date" name="PaymentDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["PaymentDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="PaymentStatus" name="PaymentStatus" required="">
                                             <!--   <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="1" <?php if($row7["PaymentStatus"]=='1') {?> selected
                                                    <?php } ?>>Payment Done</option>
                                               <!-- <option value="0" <?php if($row7["PaymentStatus"]=='0') {?> selected
                                                    <?php } ?>>Payment Pending</option>
                                                    <option value="2" <?php if($row7["PaymentStatus"]=='2') {?> selected
                                                    <?php } ?>>Payment Reject</option>-->
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">UTR No <span class="text-danger">*</span></label>
                                            <input type="text" name="UtrNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["UtrNo"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
    <label class="form-label">Total Amount <span class="text-danger">*</span></label>
    <input type="text" id="TotPayAmount" name="TotPayAmount" class="form-control"
        placeholder="" value="<?php echo $row7["TotPayAmount"]; ?>" readonly required>
    <div class="clearfix"></div>
</div>
                                        
                                         <div class="form-group col-md-9">
                                            <label class="form-label">Narration</label>
                                            <input type="text" name="PayNarration" class="form-control"
                                                placeholder="" value="<?php echo $row7["PayNarration"]; ?>" >
                                            <div class="clearfix"></div>
                                        </div>
                      
                       <div class="form-group col-md-6" style="padding-top:20px;">                 
     <button type="submit" class="btn btn-primary">Submit Selected</button>
     </div>
     </div>
</form>
</div>
<?php } ?>
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
    $('#example').DataTable({
        order: [[1, 'desc']] ,
       
        "pageLength":500
    });
    
   
});
</script>
<script>
document.getElementById("checkAll").addEventListener("change", function () {
    var checkboxes = document.querySelectorAll(".rowCheckbox");
    checkboxes.forEach(cb => cb.checked = this.checked);
    calculateTotal(); // trigger total calculation
});

document.querySelectorAll(".rowCheckbox").forEach(function (checkbox) {
    checkbox.addEventListener("change", calculateTotal);
});

function calculateTotal() {
    let total = 0;
    document.querySelectorAll(".rowCheckbox:checked").forEach(function (cb) {
        const amount = parseFloat(cb.getAttribute("data-amount")) || 0;
        total += amount;
    });
    document.getElementById("TotPayAmount").value = total.toFixed(2);
}
</script>
</body>
</html>
