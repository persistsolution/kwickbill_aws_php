<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Pretty-Cash-Account";
$Page = "Account-Pending-Pretty-Cash-Request";
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
<h4 class="font-weight-bold py-3 mb-0">Account Pending Pretty Cash Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
                 <th>Request Id</th>
                    <th>Request Date</th>
                   <th>Manager Approve</th>
                    <th>Admin Approve</th>
                   <th>Accountant Approve</th>
                 
               <th>Photo</th>
                <th>Employee Name</th>
                <th>Wallet Balance</th>
               <th>Amount</th>
               <th>Approve Amount</th>
                <th>Narration</th>
            
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
          
         
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                WHERE te.UserId!=0 AND te.AdminStatus=1 AND te.AccStatus='0' AND te.ExpenseDate>='2025-06-28'"; 
            
            $sql.=" ORDER BY te.ExpenseDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                    $MgrName = $row['MgrName'];
               $AdminName = $row['AdminName'];
               $EmpId = $row['UserId'];
               $sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='$EmpId' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    $WalletBal = $row88['Credit'] - $row88['Debit'];
    
     $sql66 = "SELECT ExpApproval FROM tbl_users WHERE id='$EmpId'";
    $row66 = getRecord($sql66);
    
      $mgrdate = date("d/m/Y", strtotime(str_replace('-', '/',$row['MannagerApproveDate'])));
      $admindate = date("d/m/Y", strtotime(str_replace('-', '/',$row['AdminApproveDate'])));
      
             ?>
            <tr>
                

<td><?php echo $row['id'];?></td>
  <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
  
   <?php if($row66['ExpApproval'] == 1){?>
  <td style="color:red;">No manager assigned</td>
  <?php } else {?>
             <td><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName | $mgrdate </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName | $mgrdate</span>";} else {?>
 <span style='color:orange;'>Pending By Manager</span><?php } ?></td>
 <?php } ?>
 
 <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AdminName | $admindate </span>";} else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AdminName | $admindate</span>";} else {?>
 <span style='color:orange;'>Pending By Admin</span><?php } ?><br>
  </td>
  
                <td><a href="approve-pretty-cash-by-accoutant.php?id=<?php echo $row['id']; ?>"><?php if($row['AccStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['AccStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName</span>";} else {?>
                 <span style='color:orange;'>Pending By Accountant</span><?php } ?></a></td>
               
 
               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><a href="customer-profile.php?id=<?php echo $row['UserId'];?>" target="_blank"><?php echo $row['Fname']." ".$row['Lname']; ?></a></td>
                <td><?php echo $WalletBal; ?></td>
                  <td><?php echo $row['Amount']; ?></td>
                  <td><?php echo $row['AccAmount']; ?></td>
                   <td><?php echo $row['Narration']; ?></td>
             
                
              
           
           
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
