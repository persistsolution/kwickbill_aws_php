<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Profit-Loss";
$Page = "Add-Profit-Loss";
$sessionid = session_id();
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="author" content="" />

<?php include_once 'header_script.php'; ?>
<script src="ckeditor/ckeditor.js"></script>
</head>
<body>
<style type="text/css">
  .password-tog-info {
  display: inline-block;
cursor: pointer;
font-size: 12px;
font-weight: 600;
position: absolute;
right: 50px;
top: 30px;
text-transform: uppercase;
z-index: 2;
}


</style>
 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">


<?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_profit_loss WHERE id='$id'";
$row7 = getRecord($sql7);
if($_GET['id']){
$renteleper = $row7['renteleper'];
$invshareper = $row7['invshareper'];
}
else{
 $renteleper = 0;$invshareper=0;   
}
?>

<?php 
  if(isset($_POST['submit'])){
      $frid = $_POST['frid'];
    $month = addslashes(trim($_POST['month']));
    $year = addslashes(trim($_POST['year']));
    $totalsell = addslashes(trim($_POST['totalsell']));
    $salary = addslashes(trim($_POST['salary']));
    $rent = addslashes(trim($_POST['rent']));
    $electricity = addslashes(trim($_POST['electricity']));
    $pettycash = addslashes(trim($_POST['pettycash']));
    $gst = addslashes(trim($_POST['gst']));
    $hocost = addslashes(trim($_POST['hocost']));
    $balance = addslashes(trim($_POST['balance']));
    $createddate = date('Y-m-d H:i:s');
    $narration = addslashes(trim($_POST['narration']));
    $prodcost = addslashes(trim($_POST['prodcost']));
    $salaryper = addslashes(trim($_POST['salaryper']));
    $renteleper = addslashes(trim($_POST['renteleper']));
    $rentelecost = addslashes(trim($_POST['rentelecost']));
    $invshareper = addslashes(trim($_POST['invshareper']));
    $invsharecost = addslashes(trim($_POST['invsharecost']));
    
  
$sql = "SELECT * FROM tbl_profit_loss WHERE month='$month' AND year='$year' AND frid='$frid'";
if($_GET['id'] != ''){
    $sql.=" AND id!='$id'";
}
$rncnt = getRow($sql);

    if($_GET['id'] == ''){
        if($rncnt > 0){
            echo "<script>alert('This Month Record Already Savewd');window.location.href='add-profit-loss.php';</script>";
        }
        else{
     $qx = "INSERT INTO tbl_profit_loss SET frid='$frid',month='$month',year='$year',totalsell='$totalsell',salary='$salary',
            rent='$rent',electricity='$electricity',pettycash='$pettycash',gst='$gst',hocost='$hocost',balance='$balance',narration='$narration',
            createdby='$user_id',createddate='$createddate',prodcost='$prodcost',salaryper='$salaryper',renteleper='$renteleper',rentelecost='$rentelecost',invshareper='$invshareper',invsharecost='$invsharecost'";
  $conn->query($qx); 
  $InvId = mysqli_insert_id($conn);
  echo "<script>alert('Record Saved Successfully!');window.location.href='view-profit-loss.php';</script>";
        }
}
else{
    if($rncnt > 0){
            echo "<script>alert('This Month Record Already Savewd');window.location.href='add-profit-loss.php';</script>";
        }
        else{
    $sql = "UPDATE tbl_profit_loss SET frid='$frid',month='$month',year='$year',totalsell='$totalsell',salary='$salary',
            rent='$rent',electricity='$electricity',pettycash='$pettycash',gst='$gst',hocost='$hocost',balance='$balance',narration='$narration',modifiedby='$user_id',modifieddate='$CreatedDate',prodcost='$prodcost',salaryper='$salaryper',renteleper='$renteleper',rentelecost='$rentelecost',invshareper='$invshareper',invsharecost='$invsharecost' WHERE id='$id'";
    $conn->query($sql);
    echo "<script>alert('Record Updated Successfully!');window.location.href='view-profit-loss.php';</script>";
        }
}
      
   

    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Add Profit Loss</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<div class="row">
<div class="col-lg-10">
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">

 <div class="form-group col-md-6">
<label class="form-label"> Franchise<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="frid" id="UserId" required onchange="getSellAmt(this.value,document.getElementById('month').value,document.getElementById('year').value)">
<option selected="" value="all">All</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_users_bill WHERE Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["frid"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">Month</label>
<select class="form-control" style="width: 100%" name="month" id="month" required onchange="getSellAmt(document.getElementById('UserId').value,this.value,document.getElementById('year').value)">
<option <?php if($row7['month'] == '01'){?> selected <?php } ?> value="01">Jan</option>
<option <?php if($row7['month'] == '02'){?> selected <?php } ?> value="02">Feb</option>
<option <?php if($row7['month'] == '03'){?> selected <?php } ?> value="03">Mar</option>
<option <?php if($row7['month'] == '04'){?> selected <?php } ?> value="04">Apr</option>
<option <?php if($row7['month'] == '05'){?> selected <?php } ?> value="05">May</option>
<option <?php if($row7['month'] == '06'){?> selected <?php } ?> value="06">Jun</option>
<option <?php if($row7['month'] == '07'){?> selected <?php } ?> value="07">Jul</option>
<option <?php if($row7['month'] == '08'){?> selected <?php } ?> value="08">Aug</option>
<option <?php if($row7['month'] == '09'){?> selected <?php } ?> value="09">Sep</option>
<option <?php if($row7['month'] == '10'){?> selected <?php } ?> value="10">Oct</option>
<option <?php if($row7['month'] == '11'){?> selected <?php } ?> value="11">Nov</option>
<option <?php if($row7['month'] == '12'){?> selected <?php } ?> value="12">Dec</option>
  </select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">Year</label>
<select class="form-control" style="width: 100%" name="year" id="year" required onchange="getSellAmt(document.getElementById('UserId').value,document.getElementById('month').value,this.value)">
    <option <?php if($row7['year'] == '2025'){?> selected <?php } ?> value="2025">2025</option>
    <option <?php if($row7['year'] == '2024'){?> selected <?php } ?> value="2024">2024</option>
    
  </select>
<div class="clearfix"></div>
</div>
<div class="form-group col-md-2"></div>
 <div class="form-group col-md-2">
<label class="form-label">Total Sell </label>
<input type="text" name="totalsell" id="TotalAmount" class="form-control" placeholder="" value="<?php echo $row7['totalsell'];?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
    
     <div class="form-group col-md-2">
<label class="form-label">Product Cost (40%) </label>
<input type="text" name="prodcost" id="prodcost" class="form-control" placeholder="" value="<?php echo $row7['prodcost'];?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
 
    <!--<div class="form-group col-md-2">
<label class="form-label">Salary % </label>
<input type="text" name="salaryper" id="salaryper" class="form-control" placeholder="" value="<?php echo $row7['salaryper'];?>" autocomplete="off" required
oninput="calSalAmt(document.getElementById('TotalAmount').value)">
<div class="clearfix"></div>
    </div>-->
    
    <div class="form-group col-md-2">
<label class="form-label">Salary Cost </label>
<input type="text" name="salary" id="salary" class="form-control" placeholder="" value="<?php echo $row7['salary'];?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>

    <!--<div class="form-group col-md-2">
<label class="form-label">Rent & Electricity % <span class="text-danger">*</span></label>
<input type="text" name="renteleper" id="renteleper" class="form-control" placeholder="" value="<?php echo $renteleper; ?>" autocomplete="off" required oninput="calRentEleAmt(document.getElementById('TotalAmount').value)">
<div class="clearfix"></div>
    </div>-->

   <div class="form-group col-md-2">
<label class="form-label">Rent & Electricity Cost <span class="text-danger">*</span></label>
<input type="text" name="rentelecost" id="rentelecost" class="form-control" placeholder="" value="<?php echo $row7['rentelecost'];?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
    
    <div class="form-group col-md-2">
<label class="form-label">Misc Expences <span class="text-danger">*</span></label>
<input type="text" name="pettycash" id="pettycash" class="form-control" placeholder="" value="<?php echo $row7['rentelecost'];?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
<div class="form-group col-md-2"></div>
    
<div class="form-group col-md-2">
<label class="form-label">Investor Share % <span class="text-danger">*</span></label>
<input type="text" name="invshareper" id="invshareper" class="form-control" placeholder="" value="<?php echo $invshareper; ?>" autocomplete="off" required  oninput="calInvShareAmt(document.getElementById('TotalAmount').value)">
<div class="clearfix"></div>
    </div>
    
     <div class="form-group col-md-2">
<label class="form-label">Investor Share Cost <span class="text-danger">*</span></label>
<input type="text" name="invsharecost" id="invsharecost" class="form-control" placeholder="" value="<?php echo $row7['invsharecost'];?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>

<div class="form-group col-md-2">
<label class="form-label">Gst 5% <span class="text-danger">*</span></label>
<input type="text" name="gst" id="gst" class="form-control" placeholder="" value="<?php echo $row7["gst"]; ?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
    
    <div class="form-group col-md-2">
<label class="form-label">Ho Cost 5% <span class="text-danger">*</span></label>
<input type="text" name="hocost" id="hocost" class="form-control" placeholder="" value="<?php echo $row7["hocost"]; ?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
    
    <div class="form-group col-md-2">
<label class="form-label">Balance <span class="text-danger">*</span></label>
<input type="text" name="balance" id="balance" class="form-control" placeholder="" value="<?php echo $row7["balance"]; ?>" autocomplete="off" readonly>
<div class="clearfix"></div>
    </div>
    
    <div class="form-group col-md-10">
<label class="form-label">Narration </label>
<input type="text" name="narration" id="Narration" class="form-control" placeholder="" value="<?php echo $row7["narration"]; ?>" autocomplete="off">
<div class="clearfix"></div>
    </div>

</div> 

<button type="submit" name="submit" id="submit" class="btn btn-primary btn-finish">Submit</button>
<span id="error_msg" style="color:red;"></span>

</form>
</div>
<div class="col-lg-4" id="showcart">
    
        
</div>
</div>
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
 <script>
 function calSalAmt(TotalAmount){
     var salaryper = $('#salaryper').val();
      var salary = (TotalAmount * salaryper) / 100;
      $('#salary').val(parseFloat(salary).toFixed(2));
      calBalAmt();
 }
 
  function calRentEleAmt(TotalAmount){
     var renteleper = $('#renteleper').val();
      var rentelecost = (TotalAmount * renteleper) / 100;
      $('#rentelecost').val(parseFloat(rentelecost).toFixed(2));
      calBalAmt();
 }
 
 function calInvShareAmt(TotalAmount){
     var invshareper = $('#invshareper').val();
      var invsharecost = (TotalAmount * invshareper) / 100;
      $('#invsharecost').val(parseFloat(invsharecost).toFixed(2));
      calBalAmt();
 }
  function calBalAmt(){
      var TotalAmount = $('#TotalAmount').val();
      var prodcost = $('#prodcost').val();
      var salary = $('#salary').val();
      var rentelecost = $('#rentelecost').val();
      var pettycash = $('#pettycash').val();
      var invsharecost = $('#invsharecost').val();
      var gst = $('#gst').val();
      var hocost = $('#hocost').val();
     var balance = Number(TotalAmount) - Number(prodcost) - Number(salary) - Number(rentelecost) - Number(pettycash) - Number(gst) - Number(hocost) - Number(invsharecost);
     $('#balance').val(parseFloat(balance).toFixed(2));
     
 }
 
  
  function getSellAmt(frid,month,year){
      var action = "getSellAmt";
            $.ajax({
                url: "ajax_files/ajax_customer_account.php",
                method: "POST",
                data: {
                    action: action,
                    FrId:frid,
                    month:month,
                    year:year
                },
                success: function(data) {
                  //alert(data);
                  var res = JSON.parse(data);
                  console.log(data);
                    $('#TotalAmount').val(parseFloat(res.NetAmount).toFixed(2));
                    var prodcost = (res.NetAmount * 40) / 100;
                    $('#prodcost').val(parseFloat(prodcost).toFixed(2));
                    var gst = (res.NetAmount * 5) / 100;
                    $('#gst').val(parseFloat(gst).toFixed(2));
                    var hocost = (res.NetAmount * 5) / 100;
                    $('#hocost').val(parseFloat(hocost).toFixed(2));
                    // var pettycash = (res.NetAmount * 5) / 100;
                    // $('#pettycash').val(parseFloat(pettycash).toFixed(2));
                    //calBalAmt();
                    $('#pettycash').val(parseFloat(res.TotPetty).toFixed(2));
                    $('#salary').val(parseFloat(res.Salary).toFixed(2));
                    $('#rentelecost').val(parseFloat(res.Rent).toFixed(2));
                    //calSalAmt(res.NetAmount);
                    //calRentEleAmt(res.NetAmount);
                    calInvShareAmt(res.NetAmount);
                    
                    calBalAmt();
                }
            });
  }
   
   $(document).ready(function() {
       var frid = $('#UserId').val();
       var month = $('#month').val();
       var year = $('#year').val();
       getSellAmt(frid,month,year);
       calBalAmt();
   });
</script>
</body>
</html>