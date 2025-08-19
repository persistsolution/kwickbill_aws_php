<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "HO-Admin-Expenses";
$Page = "HO-Admin-Peding-Expense-Request";
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



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_expense_request WHERE id = '$id'";
  $conn->query($sql11);
  $sql = "DELETE FROM wallet WHERE ExpId='$id'";
  $conn->query($sql);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="expense-request.php";
    </script>
<?php } 

?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">All Pending Expense Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Expense Id</th>
                 <th>Manager Approve</th>
                  <th>Admin Approve</th>
                 
                   <th>Expense Date</th>
                     <th>Created Date</th>
               <th>Photo</th>
                <th>Employee Name</th>
                 <!--<th>Category</th>-->
                 <!--<th>Franchise</th>
                 <th>Locations</th>-->
                <!--<th>Vendor Mobile No</th>-->
                <th>Amount</th>
                <!--<th>PaymentMode</th>-->
                <th>Narration</th>
                <!-- <th>Receipt</th>-->
                <!-- <th>Payment Receipt</th>-->
                <!--<th>Status</th>-->
               
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            
                $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.AdminStatus!=1"; 
               
             $sql.=" ORDER BY te.CreatedDate DESC";  
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                 $MgrName = $row['MgrName'];
                 $AccName = $row['AccName'];
                 if($row['TotDays']>=0 && $row['TotDays']<=6){
                     $totdays = 0; //less than 7
                 }
                 else{
                     $totdays = 1; // more than 7
                 }
             ?>
            <tr>
                <td><?php echo $row['id'];?></td>
              
                <td><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else {?>
                 <span style='color:orange;'>Pending By Manager</span><?php } ?></td>
               
                
  <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName </span>";} else {?>
Approve By Admin/Account<br>

 <?php } ?>
 
 </td>
 
   <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
   <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><a href="employee-hierarchy.php?id=<?php echo $row['UserId'];?>" target="_blank"><?php echo $row['Fname']." ".$row['Lname']; ?></a></td>
               <!--<td><?php echo $row['ExpCatName'];?></td>-->
               <!--<td><?php echo $row['ShopName'];?></td>
               <td><?php echo $row['ExpLocation'];?></td>-->
              <!--<td><?php echo $row['VedPhone']; ?></td>-->
                
                <td><?php echo $row['Amount']; ?></td>
               <!--<td><?php echo $row['PaymentMode']; ?></td>-->
                  <td><?php echo $row['Narration']; ?></td>
             <!-- <td><?php if($row["Photo"] == '') {?>
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
                     
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>
              -->
           
           
            </tr>
            
            
           <?php } ?>
           
         
           
           
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
         order: [[0, 'desc']]
    });
});
</script>
</body>
</html>
