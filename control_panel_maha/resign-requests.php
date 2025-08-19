<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Resign-Requests";
$Page = "Resign-Requests";
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
<h4 class="font-weight-bold py-3 mb-0">Resign Requests
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Approve/Reject</th>
                <th>Status</th>
                <th>Employee Name</th>
                <th>Contact No</th>
                <th>Request Date</th>
               <th>Meesage</th>
                <!--<th>Action</th>-->
               
            </tr>
        </thead>
        <tbody>
             <?php 
             $i=1;
            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Phone FROM tbl_resign_requests te LEFT JOIN tbl_users tu ON tu.id=te.UserId ORDER BY te.ReqDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
             ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="change-resign-status.php?id=<?php echo $row['id']; ?>">Change Status</a></td>
                <td><?php if($row['ResignStatus']=='1'){echo "<span style='color:green;'>Approved</span>";} 
                else { echo "<span style='color:red;'>Pending</span>";} ?></td>
                <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
                <td><?php echo $row['Phone']; ?></td>
                <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ReqDate']))); ?></td>
                <td><?php echo $row['ResignComment']; ?></td>
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
 function changeStatus(id,val){
     window.location.href='lead-aprroval.php?action=changestatus&id='+id+'&status='+val;
 }
    $(document).ready(function() {
    $('#example').DataTable({
    });
});
</script>
</body>
</html>
