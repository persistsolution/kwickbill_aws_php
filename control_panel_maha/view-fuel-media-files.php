<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Fuel-Checklist";
$Page = "Fuel-Checklist";
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
  $sql11 = "DELETE FROM tbl_fuel_station_details WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-fule-station-checklist.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Fuel Station Checklists
    
</h4>

<div class="card" style="padding: 10px;">

     
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Media Type</th>
            <th>File</th>
           
        </tr>
    </thead>
    <tbody>
        <?php 
        $id = $_GET['id'];
        $i = 1;
        $sql = "SELECT* FROM tbl_fuel_checklist_images WHERE postid='$id'";
        
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
         
            if($row['roll']=='1'){
                $foldername = "fuelimage";
            }
            else{
                $foldername = "fuelvideos";
            }
        ?>
        <tr>
           <td><?php echo $i; ?></td>
           <td><?php if($row['roll']=='1'){echo "<span style='color:green;'>Photo</span>";} else { echo "<span style='color:red;'>Video</span>";} ?></td>
            <td><a href="../<?php echo $foldername;?>/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
          
            
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
