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
<h4 class="font-weight-bold py-3 mb-0">Payment Done To NSO Vendor
  
</h4>

<div class="card" style="padding: 10px;">
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 
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
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
                 <th>Expense Id</th>
                 <th>Pay Amount</th>
                 <th>Invoice No</th>
                    <th>Invoice Date</th>
                   <!-- <th>Account Approve</th>
                   <th>Admin Approve</th>-->
                 <th>Location</th>
               <!--<th>Photo</th>-->
               
                 <th>Vendor Name</th>
             <!--   <th>Vendor Mobile No</th>-->
                <th>Amount</th>
                 <th>UTR No.</th>
               <!-- <th>PaymentMode</th>
                <th>Narration</th>-->
                 <th>Receipt</th>
                <th>Payment Receipt</th>
              <th>Created By</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
          
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS AccName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus='1' AND te.PaymentStatus=1 AND te.UserId!=0 AND te.Locations IN($AssignFranchiseVedExp) AND te.ExpenseDate>='2025-05-01'"; 
           
             if ($_POST['FromDate']) {
            $FromDate = $_POST['FromDate'];
            $sql .= " AND te.AdminApproveDate >= '$FromDate'";
        }
        if ($_POST['ToDate']) {
            $ToDate = $_POST['ToDate'];
            $sql .= " AND te.AdminApproveDate <= '$ToDate'";
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
                

<td><?php echo $row['id'];?></td>
  
   <td>
       <?php if($row['PaymentStatus'] == 1){?>
       <a href="pay-nso-vendor-amount.php?id=<?php echo $row['id']; ?>" target="_blank" style='color:green;'>Payment Done </a>
       <?php } else {?>
       <a href="pay-nso-vendor-amount.php?id=<?php echo $row['id']; ?>" target="_blank">Pay Amount</a>
       <?php } ?>
       </td>
   <td><?php echo $row['InvoiceNo']; ?></td>
   <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
 <!--<td id="showstatus<?php echo $row['id']; ?>"><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else {?>
 Approve By Accountant<?php } ?>
  </td>
  <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName</span>";} else {?>
 Approve By Admin<?php } ?>
  </td>-->

<td><?php echo $row['ShopName'];?></td>
              <!-- <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>-->
              
               <td><a href="vendor-details.php?id=<?php echo $row['VedId'];?>" target="_blank"><?php echo $row['VedName']; ?></a></td>
             <!-- <td><?php echo $row['VedPhone']; ?></td>-->
                
                <td><?php echo $row['Amount']; ?></td>
                <td><?php echo $row['UtrNo']; ?></td>
               <!--<td><?php echo $row['PaymentMode']; ?></td>
                  <td><?php echo $row['Narration']; ?></td>-->
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
    $('#example').DataTable({
        order: [[0, 'desc']] ,
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });
    
   
});
</script>
</body>
</html>
