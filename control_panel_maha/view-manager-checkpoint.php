<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Manager-Checkpoint";
$Page = "Manager-Checkpoint";
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
  $sql11 = "DELETE FROM tbl_manager_checkpoint WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-manager-checkpoint.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Manager Checkpoints
    
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
<div class="form-group col-md-1">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
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
            <th>Sr No</th>
            <th>Staff Grooming</th>
            <th>Food Quality and Test</th>
            <th>Store Stock Check</th>
            <th>Problem Solutions</th>
            <th>Preparation Check in Freezer</th>
            <th>Equipment Maintenance Check</th>
            <th>Outlet Running Operation</th>
            <th>Unused Product Transfer</th>
            <th>Sale and Purchase Report</th>
            <th>Counter Display and Arrangement</th>
            <th>Created Date</th>
           <th>Created By</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $sql = "SELECT ts.*,tu.Fname FROM tbl_manager_checkpoint ts LEFT JOIN tbl_users tu ON tu.id=ts.userid WHERE 1";
        
        if ($_POST['FromDate']) {
            $FromDate = $_POST['FromDate'];
            $sql .= " AND ts.createddate >= '$FromDate'";
        }
        if ($_POST['ToDate']) {
            $ToDate = $_POST['ToDate'];
            $sql .= " AND ts.createddate <= '$ToDate'";
        }
        $sql .= " ORDER BY ts.createddate DESC";

        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['staff_grooming']; ?></td>
            <td><?php echo $row['food_quality_test']; ?></td>
            <td><?php echo $row['store_stock_check']; ?></td>
            <td><?php echo $row['problem_solutions']; ?></td>
            <td><?php echo $row['preparation_freezer']; ?></td>
            <td><?php echo $row['equipment_maintenance_check']; ?></td>
            <td><?php echo $row['outlet_running_operation']; ?></td>
            <td><?php echo $row['unused_product_transfer']; ?></td>
            <td><?php echo $row['sale_purchase_report']; ?></td>
            <td><?php echo $row['counter_display_arrangement']; ?></td>
            <td><?php echo date("d/m/Y", strtotime($row['createddate'])); ?></td>
            <td><?php echo $row['Fname']; ?></td>
        </tr>
        <?php $i++; } ?>
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
        ]
    });
});
</script>
</body>
</html>
