<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "HR-Leave";
$Page = "Hr-Pending-Leave-Request";
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
<h4 class="font-weight-bold py-3 mb-0">HR Pending Leave Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
                 <th>Request Id</th>
                    <th>Request Date</th>
                     <th>Manager Approve</th>
                    <th>HR Approve</th>
                  
                 
               <th>Photo</th>
                <th>Employee Name</th>
               
               <th>Leave Reason</th>
             <th>From Date</th>
            
               <th>To Date</th>
              <th>Total Days</th>
                
                
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
          
         
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_leave_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 AND te.HrStatus=0 "; 
            
            $sql.=" ORDER BY te.ReqDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                    $MgrName = $row['MgrName'];
                     
              $bdmdate = date("d/m/Y", strtotime(str_replace('-', '/',$row['MannagerApproveDate'])));
               
             ?>
            <tr>
                

<td><?php echo $row['id'];?></td>
  <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ReqDate']))); ?></td>
  <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName | $bdmdate </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName | $bdmdate</span>";} else {?>
 Approve By Manager<?php } ?><br>
  </td>
                <td><a href="approve-leave-by-hr.php?id=<?php echo $row['id']; ?>"><?php if($row['HrStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By HR </span>";} else if($row['HrStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By HR</span>";} else {?>
                 <span style='color:orange;'>Pending By HR</span><?php } ?></a></td>
               
 

               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
               
              <td><?php echo $row['Narration']; ?></td>
                 
                  <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['FromDate']))); ?></td>

                   <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ToDate']))); ?></td>
                   <td><?php echo $row['TotDays']; ?> Days</td>
              
           
           
            </tr>
           <?php $i++;}  ?>
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
        order: [[0, 'asc']]
    });
});
</script>
</body>
</html>
