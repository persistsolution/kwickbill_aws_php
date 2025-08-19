<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Manager-Vendor-Expenses";
$Page = "Manager-Vendor-Peding-Expense-Request";
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
<h4 class="font-weight-bold py-3 mb-0">Admin Vendor Approve Expense Request
  
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
                 <th>Upload Date</th>
                    <th>Expense Date</th>
                    <th>BDM Approve</th>
                   <th>Purchase Dept Approve</th>
                    <th>Account Approve</th>
                  <th>Admin Approve</th>
                   <th>Payment Status</th>
               <th>Location</th>
                 <th>Vendor Name</th>
                <th>Vendor Mobile No</th>
                <th>Amount</th>
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
          
           $sql = "SELECT te.*,tu7.Fname AS PayByName,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tu6.Fname AS AccName,tub.ShopName,tu3.TrustedVendor FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users tu7 ON tu7.id=te.PayBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.AdminStatus=1 AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01' "; 
                // AND te.Locations IN($AssignFranchiseVedExp)
               
            /*if($Roll != 1){
                $sql.=" AND te.UserId!='$user_id'";
            }*/
            if ($_POST['FromDate']) {
            $FromDate = $_POST['FromDate'];
            $sql .= " AND te.ExpenseDate >= '$FromDate'";
        }
        if ($_POST['ToDate']) {
            $ToDate = $_POST['ToDate'];
            $sql .= " AND te.ExpenseDate <= '$ToDate'";
        }
        $sql .
            $sql.=" ORDER BY te.ExpenseDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $FrId = $row['Locations'];
                  $MgrName = $row['MgrName'];
                    $PurchaseName = $row['PurchaseName'];
                    $BdmName = $row['BdmName'];
                    $adminName = $row['AccName'];
                    $PayByName = $row['PayByName'];
               
                $bdmdate = date("d/m/Y", strtotime(str_replace('-', '/',$row['BdmApproveDate'])));
                    $purchasedate = date("d/m/Y", strtotime(str_replace('-', '/',$row['PurchaseApproveDate'])));
                    $accountdate = date("d/m/Y", strtotime(str_replace('-', '/',$row['ApproveDate'])));
                    $admindate = date("d/m/Y", strtotime(str_replace('-', '/',$row['AdminApproveDate'])));
                    $PaymentDate = date("d/m/Y", strtotime(str_replace('-', '/',$row['PaymentDate'])));
                
                $sql2 = "SELECT Fname FROM `tbl_users` WHERE id IN (9591, 5965, 8346,2553) AND FIND_IN_SET($FrId, AssignFranchiseVedExp) > 0";
                $row2 = getRecord($sql2);
                $PayFname = $row2['Fname'];
             ?>
            <tr>
                

<td><?php echo $row['id'];?></td>
 <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
  <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
  <?php //if($row['TrustedVendor'] == 'Yes'){?>
                <!--<td><span style="color:red;">Approval Not Required</span></td>
                <td><span style="color:red;">Approval Not Required</span></td>-->
                <?php //} else{?>
    <td>
      <?php if($row['BdmStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $BdmName | $bdmdate </span>";} 
      else if($row['BdmStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $BdmName | $bdmdate</span>";} 
      else { echo "<span style='color:orange;'>Pending By BDM</span>"; } ?></td>
      
   <td>
      <?php if($row['PurchaseStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $PurchaseName | $purchasedate</span>";} 
      else if($row['PurchaseStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $PurchaseName | $purchasedate</span>";} 
      else { echo "<span style='color:orange;'>Pending By Purchase Dept</span>"; } ?></td>
      
     <td><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName | $accountdate</span>";} 
       else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName | $accountdate</span>";} 
       else { echo "<span style='color:orange;'>Pending By Accountant</span>"; } ?></td>
       <?php //} ?>
       
 <td><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $adminName | $admindate</span>";} 
       else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $adminName | $admindate</span>";} 
       else { echo "<span style='color:orange;'>Pending By Admin</span>"; } ?></td>
       
       <td><?php if($row['PaymentStatus']=='1'){ echo "<span style='color:green;'>Payment Done<br>By $PayByName | $PaymentDate</span>";} 
       else { echo "<span style='color:orange;'>Pending By $PayFname</span>"; } ?></td>
       
            <!--   <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>-->
              <td><?php echo $row['ShopName'];?></td>
              
              <td><a href="vendor-details.php?id=<?php echo $row['VedId'];?>" target="_blank"><?php echo $row['VedName']; ?></a></td>
              <td><?php echo $row['VedPhone']; ?></td>
                
                <td><?php echo $row['Amount']; ?></td>
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

<script type="text/javascript">

    $(document).ready(function() {
    $('#example').DataTable({
         "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ],
        order: [[0, 'desc']]
    });
    
   
});
</script>
</body>
</html>
