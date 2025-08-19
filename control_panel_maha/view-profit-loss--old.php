<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Profit-Loss";
$Page = "View-Profit-Loss";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?></title>
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
  $sql11 = "DELETE FROM tbl_profit_loss WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-profit-loss.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Profit Loss List
    <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-profit-loss.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New </a></span>
<?php } ?>
</h4>

<div class="card" style="padding: 10px;">
      
        <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       
 <div class="form-group col-md-6">
<label class="form-label"> Franchise<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="frid" id="UserId" required>
<option selected="" value="all">All</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_users_bill WHERE Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_REQUEST["frid"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">Month</label>
<select class="form-control" style="width: 100%" name="month" id="month" required>
<option <?php if($_REQUEST['month'] == '01'){?> selected <?php } ?> value="01">Jan</option>
<option <?php if($_REQUEST['month'] == '02'){?> selected <?php } ?> value="02">Feb</option>
<option <?php if($_REQUEST['month'] == '03'){?> selected <?php } ?> value="03">Mar</option>
<option <?php if($_REQUEST['month'] == '04'){?> selected <?php } ?> value="04">Apr</option>
<option <?php if($_REQUEST['month'] == '05'){?> selected <?php } ?> value="05">May</option>
<option <?php if($_REQUEST['month'] == '06'){?> selected <?php } ?> value="06">Jun</option>
<option <?php if($_REQUEST['month'] == '07'){?> selected <?php } ?> value="07">Jul</option>
<option <?php if($_REQUEST['month'] == '08'){?> selected <?php } ?> value="08">Aug</option>
<option <?php if($_REQUEST['month'] == '09'){?> selected <?php } ?> value="09">Sep</option>
<option <?php if($_REQUEST['month'] == '10'){?> selected <?php } ?> value="10">Oct</option>
<option <?php if($_REQUEST['month'] == '11'){?> selected <?php } ?> value="11">Nov</option>
<option <?php if($_REQUEST['month'] == '12'){?> selected <?php } ?> value="12">Dec</option>
  </select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">Year</label>
<select class="form-control" style="width: 100%" name="year" id="year" required>
    <option <?php if($_REQUEST['year'] == '2025'){?> selected <?php } ?> value="2025">2025</option>
    <option <?php if($_REQUEST['year'] == '2024'){?> selected <?php } ?> value="2024">2024</option>
    
  </select>
<div class="clearfix"></div>
</div>


<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:30px;">
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
               <th>#</th>
              
                <th>Month</th>
                 <th>Franchise</th>
                 <th>Zone</th>
                 <th>Sub Zone</th>
                <th>Total Sell</th>
                <th>Product Cost (40%)</th>
                <th>Salary</th>
                <th>Rent & Electricity</th>
                <th>Misc Expences</th>
                <th>Investor Share Cost (12%)</th>
                <th>Gst (5%)</th>
                <th>Ho Cost (5%)</th>
                <th>Balance</th>
                <th>Created Date</th>
                <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
                <!--<th>Action</th>-->
               <?php } ?>
            
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT ts.*,tu.ShopName,tz.Name AS ZoneName,tsz.Name AS SubZoneName FROM tbl_profit_loss ts 
            INNER JOIN tbl_users_bill tu ON tu.id=ts.frid 
            INNER JOIN tbl_zone tz ON tu.ZoneId=tz.id 
            INNER JOIN tbl_sub_zone tsz ON tu.SubZoneId=tsz.id 
            WHERE 1";
            
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND ts.TransferDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND ts.TransferDate<='$ToDate'";
            }
            $sql.=" ORDER BY ts.id DESC";    
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
             ?>
            <tr>
               <td><?php echo $i; ?></td>
               <td><?php echo $row['month']."/".$row['year']; ?></td>
                 <td><?php echo $row['ShopName']; ?></td>
                 <td><?php echo $row['ZoneName']; ?></td>
                 <td><?php echo $row['SubZoneName']; ?></td>
               <td>&#8377;<?php echo $row['totalsell']; ?></td>
               <td>&#8377;<?php echo $row['prodcost']; ?></td>
               <td>&#8377;<?php echo $row['salary']; ?></td>
               <td>&#8377;<?php echo $row['rentelecost']; ?></td>
               <td>&#8377;<?php echo $row['pettycash']; ?></td>
               <td>&#8377;<?php echo $row['invsharecost']; ?></td>
               <td>&#8377;<?php echo $row['gst']; ?></td>
               <td>&#8377;<?php echo $row['hocost']; ?></td>
               <td>&#8377;<?php echo $row['balance']; ?></td>
              
              
              <td><?php echo date("d/m/Y h:i a", strtotime(str_replace('-', '/',$row['createddate']))); ?></td>
               <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
            <!--<td>
                 <?php if(in_array("10", $Options)){?>
                <a href="add-profit-loss.php?id=<?php echo $row['id']; ?>" ><i class="lnr lnr-pencil mr-2"></i></a>&nbsp;&nbsp;
                <?php } if(in_array("11", $Options)){?>
                <a onClick="return confirm('Are you sure you want delete this record?');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" ><i class="lnr lnr-trash text-danger"></i></a><?php } ?>
            </td>-->
            
            <?php } ?>
       
              
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
        ]
    });
});
</script>
</body>
</html>
