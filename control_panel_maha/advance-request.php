<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Advance-Request".$_REQUEST['val'];
$Page = "Advance-Request".$_REQUEST['val'];
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
  $sql11 = "DELETE FROM tbl_advance_request WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="advance-request.php";
    </script>
<?php } 

if($_REQUEST['action'] == 'changestatus'){
    $id = $_REQUEST["id"];
    $val = $_REQUEST["val"];
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $sql3 = "SELECT * FROM tbl_advance_request WHERE id = '$id'";
    $row3 = getRecord($sql3);
    $UserId = $row3['UserId'];
    $Amount = $row3['Amount'];
    if($val == 0){
        $sql = "UPDATE tbl_advance_request SET Status=1 WHERE id='$id'";
        $conn->query($sql);
        $sql2 = "INSERT INTO wallet SET ExpId='$id',UserId='$UserId',Amount='$Amount',Narration='Advance Amount Approved',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
        $conn->query($sql2);
    }
    else{
        $sql = "UPDATE tbl_advance_request SET Status=0 WHERE id='$id'";
        $conn->query($sql);
        $sql2 = "DELETE FROM wallet WHERE ExpId='$id'";
        $conn->query($sql2);
    }
 ?>
    <script type="text/javascript">
      alert("Record Saved Successfully");
      window.location.href="advance-request.php";
    </script>
<?php   
}
?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Advance Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               
                  <th>Admin/Account Approve</th>
               <th>Photo</th>
                <th>Employee Name</th>
                
                <th>Amount</th>
             
                <th>Narration</th>
               
                <th>Status</th>
                <th>request Date</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu3.Fname AS AccName FROM tbl_advance_request te 
                LEFT JOIN tbl_users tu ON tu.id=te.UserId 
               
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy WHERE 1 ";
            if($_REQUEST['val'] !=''){
                $sql.=" AND te.AdminStatus='".$_REQUEST['val']."'";
            }
            $sql.=" ORDER BY te.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                 $MgrName = $row['MgrName'];
                 $AccName = $row['AccName'];
             ?>
            <tr>
               
                
  <td><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName </span>";} else {?>
 <a href="approve-advance-by-account.php?id=<?php echo $row['id']; ?>">Approve By Admin/Account</a><?php } ?></td>
 
               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
              
                
                <td><?php echo $row['Amount']; ?></td>
             
                  <td><?php echo $row['Narration']; ?></td>
            
                     
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
           
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
 function changeStatus(id,val){
     window.location.href='advance-request.php?action=changestatus&id='+id+'&status='+val;
 }
    $(document).ready(function() {
    $('#example').DataTable({
    });
});
</script>
</body>
</html>
