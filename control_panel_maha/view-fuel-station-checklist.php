<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Fuel-Checklist";
$Page = "Pending-Fuel-Checklist";
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
<h4 class="font-weight-bold py-3 mb-0">Pendng Fuel Station Checklists
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 
<div class="form-group col-md-3">
<label class="form-label"> Rating/Points<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="points" id="points" required>
<option selected="" value="all">All</option>

  <option <?php if($_REQUEST["points"] == 7) {?> selected <?php } ?> value="7">
    Below 7</option>
    <option <?php if($_REQUEST["points"] == 8) {?> selected <?php } ?> value="8">
    Between 7 AND 10</option>
    <option <?php if($_REQUEST["points"] == 10) {?> selected <?php } ?> value="10">
    Above 10</option>

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
            <th nowrap>Status</th>
            <th>System Rating</th>
            <th>Not Feasible</th>
            <th>Considered</th>
            <th>Ok</th>
            <th>Fuel Station Name</th>
            <th>Lattitude</th>
            <th>Longitude</th>
            <th>Address</th>
            <th>State</th>
             <th>City</th>
             <th>Tourist Location</th>
            <th>Address</th>
            <th>Google Location</th>
            <th>Fuel Station Type</th>
            <th>Dealer Name</th>
            <th>Dealer Contact</th>
            <th>Manager Name</th>
            <th>Manager Contact</th>
            <th>Sales Officer Name</th>
            <th>Sales Officer Contact</th>
            <th>Pump Operational</th>
            <th>Petrol Sales</th>
            <th>Diesel Sales</th>
            <th>CNG Availability</th>
            <th>Electric Charging Availability</th>
            <th>Pump Area (SqFt)</th>
            <th>Nozzle Count</th>
            <th>Space Availability</th>
            <th>Built Space Availability</th>
            <th>Built Space Area (SqFt)</th>
            <th>Vehicles Visited</th>
            <th>Expected Sales</th>
            <th>Cross Sales Expected</th>
            <th>Online Sales Expected</th>
            <th>Comments</th>
            <th>Media Files</th>
            
            <th>Created Date</th>
           <th>Created By</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $sql = "SELECT ts.*,tu.Fname,tst.Name As StateName,tc.Name AS CityName FROM tbl_fuel_station_details ts LEFT JOIN tbl_users tu ON tu.id=ts.userid 
                LEFT JOIN tbl_fuel_state tst ON tst.id=ts.StateId 
                LEFT JOIN tbl_fuel_city tc ON tc.id=ts.CityId WHERE ts.Status='Pending'";
        if($_POST['points']){
            $points = $_REQUEST['points'];
                if($points == 'all'){
                    $sql.= " ";
                }
                else{
                    if($points == 7){
                        $sql.= " AND points<'$points'";
                    }
                    if($points == 8){
                        $sql.= " AND points>='7' AND points<='10'";
                    }
                    if($points == 10){
                        $sql.= " AND points>'10'";
                    }
                
                }
        }
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
            if($row['points']<7){
                $check1 = '<i class="ion ion-ios-checkmark-circle" style="color:green"></i>';
                $check2 = '<i class="ion ion-ios-close-circle" style="color:red"></i>';
                $check3 = '<i class="ion ion-ios-close-circle" style="color:red"></i>';
            }
            if($row['points']>=7 && $row['points']<=10){
                $check1 = '<i class="ion ion-ios-close-circle" style="color:red"></i>';
                $check2 = '<i class="ion ion-ios-checkmark-circle" style="color:green"></i>';
                $check3 = '<i class="ion ion-ios-close-circle" style="color:red"></i>';
            }
            if($row['points']>10){
                $check1 = '<i class="ion ion-ios-close-circle" style="color:red"></i>';
                $check2 = '<i class="ion ion-ios-close-circle" style="color:red"></i>';
                $check3 = '<i class="ion ion-ios-checkmark-circle" style="color:green"></i>';
            }
            
        ?>
        <tr>
           <td><?php echo $i; ?></td>
           <td nowrap><select class="form-control" onchange="changeStatus(this.value,<?php echo $row['id']; ?>)" style="width: 120px;">
               <option value="Pending" <?php if($row['Status'] == 'Pending'){?> selected <?php } ?>>Pending</option>
               <option value="Approve" <?php if($row['Status'] == 'Approve'){?> selected <?php } ?>>Approve</option>
               <option value="Reject" <?php if($row['Status'] == 'Reject'){?> selected <?php } ?>>Reject</option>
           </select></td>
           <td style="text-align: center;"><?php echo $row['points']; ?></td>
           <td style="text-align: center;font-size:20px;"><?php echo $check1;?></td>
           <td style="text-align: center;font-size:20px;"><?php echo $check2;?></td>
           <td style="text-align: center;font-size:20px;"><?php echo $check3;?></td>
            <td><?php echo $row['FuelStationName']; ?></td>
            <td><a href="view-map.php?lat=<?php echo $row['MarkLatitude']; ?>&lng=<?php echo $row['MarkLogitude']; ?>&title=<?php echo $row['FuelStationName']; ?>" target="_new"><?php echo $row['MarkLatitude']; ?></a></td>
            <td><a href="view-map.php?lat=<?php echo $row['MarkLatitude']; ?>&lng=<?php echo $row['MarkLogitude']; ?>&title=<?php echo $row['FuelStationName']; ?>" target="_new"><?php echo $row['MarkLogitude']; ?></a></td>
            <td><a href="view-map.php?lat=<?php echo $row['MarkLatitude']; ?>&lng=<?php echo $row['MarkLogitude']; ?>&title=<?php echo $row['FuelStationName']; ?>" target="_new"><?php echo $row['MarkAddress']; ?></a></td>
            <td><?php echo $row['StateName']; ?></td>
            <td><?php echo $row['CityName']; ?></td>
            <td><?php echo $row['TouristLocation']; ?></td>
            <td><?php echo $row['Address']; ?></td>
            <td><a href="<?php echo $row['GoogleLocation']; ?>" target="_blank"><?php echo $row['GoogleLocation']; ?></a></td>
            <td><?php echo $row['FuelStationType']; ?></td>
            <td><?php echo $row['DealerName']; ?></td>
            <td><?php echo $row['DealerContact']; ?></td>
            <td><?php echo $row['ManagerName']; ?></td>
            <td><?php echo $row['ManagerContact']; ?></td>
            <td><?php echo $row['SalesOfficerName']; ?></td>
            <td><?php echo $row['SalesOfficerContact']; ?></td>
            <td><?php echo $row['PumpOperational']; ?></td>
            <td><?php echo $row['PetrolSales']; ?></td>
            <td><?php echo $row['DieselSales']; ?></td>
            <td><?php echo $row['CNGAvailability']; ?></td>
            <td><?php echo $row['ElectricChargingAvailability']; ?></td>
            <td><?php echo $row['PumpAreaSqFt']; ?></td>
            <td><?php echo $row['NozzleCount']; ?></td>
            <td><?php echo $row['SpaceAvailability']; ?></td>
            <td><?php echo $row['BuiltSpaceAvailability']; ?></td>
            <td><?php echo $row['BuiltSpaceAreaSqFt']; ?></td>
            <td><?php echo $row['VehiclesVisited']; ?></td>
            <td><?php echo $row['ExpectedSales']; ?></td>
            <td><?php echo $row['CrossSalesExpected']; ?></td>
            <td><?php echo $row['OnlineSalesExpected']; ?></td>
            <td><?php echo $row['Comments']; ?></td>
            <td><a href="view-fuel-media-files.php?id=<?php echo $row['id']; ?>">View Media Files</a></td>
            
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
 function changeStatus(status,id){
     console.log(status,id);
     if(confirm("Are you sure you want to change Status?"))  
           {  
                var action = "changeFuelStatus";
    $.ajax({
    url:"ajax_files/ajax_fuel.php",
    method:"POST",
    data : {action:action,id:id,status:status},
    success:function(data)
    {
      alert("Status Changed Succesffully");
     // window.location.href="view-fuel-station-checklist.php";
    }
    });
           }
 }
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
