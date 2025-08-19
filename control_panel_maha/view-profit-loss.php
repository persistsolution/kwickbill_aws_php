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
<!--<span style="float: right;">
<a href="add-profit-loss.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New </a></span>-->
<?php } ?>
</h4>

<div class="card" style="padding: 10px;">
      
        <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       
 <div class="form-group col-md-4">
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
                                            <label class="form-label">Franchise Type <span class="text-danger">*</span></label>
                                            <select class="form-control" id="OwnFranchise" name="OwnFranchise" required="">
                                                <option selected=""  value="all">All</option>
                                                <option value="1" <?php if($_POST["OwnFranchise"]=='1') {?> selected
                                                    <?php } ?>>COCO Franchise</option>
                                                    <option value="2" <?php if($_POST["OwnFranchise"]=='2') {?> selected
                                                    <?php } ?>>FOCO Franchise </option>
                                                <option value="3" <?php if($_POST["OwnFranchise"]=='3') {?> selected
                                                    <?php } ?>>FOFO Franchise </option>
                                                     
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
   
   <?php if(isset($_POST['Search'])) {?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
              
                <th>Month</th>
                 <th>Franchise</th>
                 <th>Franchise Type</th>
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
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $month = $_REQUEST['month'];$year= $_REQUEST['year'];
            $sql = "SELECT tu.ShopName,tu.id,tz.Name AS ZoneName,tsz.Name AS SubZoneName,tu.OwnFranchise FROM tbl_users_bill tu 
            INNER JOIN tbl_zone tz ON tu.ZoneId=tz.id 
            INNER JOIN tbl_sub_zone tsz ON tu.SubZoneId=tsz.id 
            WHERE tu.Status=1 ";
            if($_POST['frid']){
                $frid = $_POST['frid'];
                if($frid == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tu.id='$frid'";
                }
            }
            
            if($_POST['OwnFranchise']){
                $OwnFranchise = $_POST['OwnFranchise'];
                if($OwnFranchise == 'all'){
                    $sql.= " ";
                }
                else if($OwnFranchise == 3){
                    $sql.= " AND tu.OwnFranchise='0'";
                }
                else{
                $sql.= " AND tu.OwnFranchise='$OwnFranchise'";
                }
            }
            
            $sql.=" ORDER BY tu.id DESC";    
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $FrId = $row['id'];
                
                
                $sql5 = "SELECT COALESCE(SUM(NetAmount), 0) AS NetAmount FROM (SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice WHERE FrId='$FrId' AND month(InvoiceDate)='$month' AND year(InvoiceDate)='$year' UNION ALL 
    SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025 WHERE FrId='$FrId' AND month(InvoiceDate)='$month' AND year(InvoiceDate)='$year') as a";
    $row5 = getRecord($sql5);
    
    $sql2 = "SELECT COALESCE(SUM(TotAmt), 0) AS TotPetty 
FROM (
    SELECT tu.Fname, SUM(w.Amount) AS TotAmt 
    FROM `wallet` w 
    LEFT JOIN tbl_users tu ON tu.id = w.UserId 
    LEFT JOIN tbl_users_bill tub ON tub.id = tu.UnderFrId 
    WHERE tub.id = '$FrId' 
        AND w.Status = 'Cr' 
        AND MONTH(w.CreatedDate) = '$month' 
        AND YEAR(w.CreatedDate) = '$year' 
        AND (w.Narration LIKE '%Pretty Cash%' OR w.Narration LIKE '%Petty Cash%') 
    GROUP BY w.UserId
) AS a";
    $row2 = getRecord($sql2);
    
    $sql3 = "SELECT COALESCE(SUM(MonthlySalary), 0) AS MonthlySalary FROM (SELECT tu.id,tu.Fname,tu.SalaryType,tu.PerDaySalary,$month AS Month,$year AS Year,DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS DaysInMonth,
    tu.PerDaySalary * DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS MonthlySalary FROM tbl_users tu WHERE tu.UnderFrId = '$FrId' AND tu.SalaryType = 1 AND tu.Status=1 UNION ALL 
    SELECT tu.id,tu.Fname,tu.SalaryType,tu.PerDaySalary,$month AS Month,$year AS Year,DAY(LAST_DAY(CONCAT($year, '-', $month, '-01'))) AS DaysInMonth,tu.PerDaySalary AS MonthlySalary FROM tbl_users tu WHERE tu.UnderFrId = '$FrId' AND tu.SalaryType = 2 AND tu.Status=1) as a";
    $row3 = getRecord($sql3);
    
    $sql4 = "SELECT COALESCE(SUM(MonthlyRent), 0) AS MonthlyRent FROM tbl_users WHERE id='$FrId'";
    $row4 = getRecord($sql4);
    
    $invsharecost = ($row5['NetAmount'] * 12) / 100;
    $gstcost = ($row5['NetAmount'] * 5) / 100;
    $hocost = ($row5['NetAmount'] * 5) / 100;
    $prodcost = ($row5['NetAmount'] * 40) / 100;
     $balance =   $row5['NetAmount'] - $prodcost - $row3['MonthlySalary'] - $row4['MonthlyRent'] - $row2['TotPetty'] - $invsharecost - $gstcost - $hocost;      
             ?>
            <tr>
               <td><?php echo $i; ?></td>
               <td><?php echo $month."/".$year; ?></td>
                 <td><?php echo $row['ShopName']; ?></td>
                  <td><?php if($row['OwnFranchise']=='1'){echo "<span style='color:green;'>COCO Franchise</span>";} else if($row['OwnFranchise']=='2'){echo "<span style='color:orange;'>FOCO Franchise</span>";} else { echo "<span style='color:red;'>FOFO Franchise</span>";} ?></td>
                 <td><?php echo $row['ZoneName']; ?></td>
                 <td><?php echo $row['SubZoneName']; ?></td>
               <td><?php echo $row5['NetAmount']; ?></td>
               <td><?php echo $prodcost; ?></td>
               <td><?php echo $row3['MonthlySalary']; ?></td>
               <td><?php echo $row4['MonthlyRent']; ?></td>
               <td><?php echo $row2['TotPetty']; ?></td>
               <td><?php echo $invsharecost; ?></td>
               <td><?php echo $gstcost; ?></td>
               <td><?php echo $hocost; ?></td>
               <td><?php echo $balance; ?></td>
              
            </tr>
           <?php $i++;} ?>

          
        </tbody>
    </table>
</div>
<?php } ?>
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
        order: [[5, 'desc']]
    });
});
</script>
</body>
</html>
