<?php 
session_start();
include_once 'config.php';
//include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Customers";
$Page = "View-Customers";

/*$sql = "SELECT * FROM `tbl_users` WHERE Roll IN(5) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "F".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}*/

?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Customer Account List</title>
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
  $sql11 = "DELETE FROM tbl_users WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-customers.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Franchise 
     <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-customer.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span><?php } ?>
</h4>

<div class="card" style="padding: 10px;">

       <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

<div class="form-group col-md-3">
                                            <label class="form-label">Franchise Type <span class="text-danger">*</span></label>
                                            <select class="form-control" id="OwnFranchise" name="OwnFranchise" required="">
                                                <option selected=""  value="all">All</option>
                                                <option value="1" <?php if($_POST["OwnFranchise"]=='1') {?> selected
                                                    <?php } ?>>COCO Franchise</option>
                                                    <option value="2" <?php if($_POST["OwnFranchise"]=='2') {?> selected
                                                    <?php } ?>>FOFO Franchise </option>
                                                <option value="3" <?php if($_POST["OwnFranchise"]=='3') {?> selected
                                                    <?php } ?>>FOCO Franchise </option>
                                                     <option value="4" <?php if($_POST["OwnFranchise"]=='4') {?> selected
                                                    <?php } ?>>COFO Franchise </option>
                                                     
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>

<div class="form-group col-md-2">
                                            <label class="form-label">Zone </label>
                                            <select class="form-control" id="ZoneId" name="ZoneId" required="">
                                                <option selected=""  value="all">All</option>
                                                <?php $sql = "SELECT * FROM tbl_zone WHERE Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){?>
                                                <option value="<?php echo $result['id'];?>" <?php if($_POST["ZoneId"]==$result['id']) {?> selected
                                                    <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:20px;">
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

<style>

  .nowrap { white-space: nowrap; }
  .badge-pill { border-radius: 50rem; padding: .35rem .6rem; font-weight: 600; }
 
</style>

<?php
// Helpers
function franchiseBadge($code) {
  switch ((string)$code) {
    case '1': return '<span class="badge badge-pill" style="background:#28a745;color:#fff;">COCO</span>';
    case '2': return '<span class="badge badge-pill" style="background:#ff9800;color:#fff;">FOFO</span>';
    case '3': return '<span class="badge badge-pill" style="background:#17a2b8;color:#fff;">FOCO</span>';
    case '4': return '<span class="badge badge-pill" style="background:#dc3545;color:#fff;">COFO</span>';
    default:  return '<span class="badge badge-pill" style="background:#6c757d;color:#fff;">Not Assigned</span>';
  }
}
function statusBadge($v) {
  return ($v=='1')
    ? '<span class="badge badge-pill" style="background:#28a745;color:#fff;">Active</span>'
    : '<span class="badge badge-pill" style="background:red;color:#fff;">In-active</span>';
}
function inr($n){ return '₹ '.number_format((float)$n, 2); }
?>

<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead class="thead-light">
    <tr>
         <?php if(in_array("10", $Options) || in_array("11", $Options)) { ?>
        <th class="min-col">Action</th>
      <?php } ?>
      <th class="min-col">Franchise ID</th>
      <th>Zone</th>
      <th>Sub Zone</th>
      <th>Franchise Name</th>
      <th>Shop Name</th>
      <th class="min-col">Monthly Rent</th>
      <th class="min-col">Franchise Type</th>
      <th class="min-col">Contact No</th>
      <th class="min-col">Password</th>
      <th>Address</th>
      <th class="min-col">Status</th>
      <th class="min-col">Opening Date</th>
      <th class="min-col">Latitude</th>
      <th class="min-col">Longitude</th>
      <th class="min-col">Zomato/Swiggy</th>
     
    </tr>
  </thead>
  <tbody>
  <?php 
    if($Roll == 1 || $Roll == 7){
      $sql = "SELECT tu.*, tut.Name AS User_Type FROM tbl_users tu 
              LEFT JOIN tbl_user_type tut ON tu.UserType=tut.id 
              WHERE tu.Roll=5 AND tu.id!=8757";
    } else {
      $sql = "SELECT tu.*, tut.Name AS User_Type FROM tbl_users tu 
              LEFT JOIN tbl_user_type tut ON tu.UserType=tut.id 
              WHERE tu.Roll=5 AND tu.id!=8757 ";
    }

    if(!empty($_POST['OwnFranchise'])){
      $OwnFranchise = $_POST['OwnFranchise'];
      if($OwnFranchise !== 'all'){
        $sql .= " AND tu.OwnFranchise='".mysqli_real_escape_string($conn,$OwnFranchise)."'";
      }
    }
    if(!empty($_POST['ZoneId'])){
      $ZoneId = $_POST['ZoneId'];
      if($ZoneId !== 'all'){
        $sql .= " AND tu.ZoneId='".mysqli_real_escape_string($conn,$ZoneId)."'";
      }
    }
    if(!empty($_POST['FromDate'])){
      $FromDate = $_POST['FromDate'];
      $sql .= " AND DATE(tu.CreatedDate) >= '".mysqli_real_escape_string($conn,$FromDate)."'";
    }
    if(!empty($_POST['ToDate'])){
      $ToDate = $_POST['ToDate'];
      $sql .= " AND DATE(tu.CreatedDate) <= '".mysqli_real_escape_string($conn,$ToDate)."'";
    }

    $sql .= " ORDER BY tu.id DESC";
    $res = $conn->query($sql);
    while($row = $res->fetch_assoc()) {
        $ZomatoSwiggy = $row['ZomatoSwiggy'];
      $row2  = getRecord("SELECT Name FROM tbl_zone WHERE id='".$row['ZoneId']."'");
      $row21 = getRecord("SELECT Name FROM tbl_sub_zone WHERE id='".$row['SubZoneId']."'");
      $sellDate = $row['SellDate'] ? date("d/m/Y", strtotime(str_replace('-', '/',$row['SellDate']))) : '-';
       $row23 = getRecord("SELECT GROUP_CONCAT(Name) AS Zomato FROM tbl_common_master WHERE id IN($ZomatoSwiggy)");
      
  ?>
    <tr>
         <?php if(in_array("10", $Options) || in_array("11", $Options)) { ?>
     <td>
               <?php if(in_array("10", $Options)){?>
              <a href="add-customer.php?id=<?php echo $row['id']; ?>"><i class="lnr lnr-pencil mr-2"></i></a>&nbsp;&nbsp;
            <?php } if(in_array("11", $Options)){?>
              <a onClick="return confirm('Are you sure you want delete this customer account?\nNote : Delete all record related this customer (Y/N)');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete"><i class="lnr lnr-trash text-danger"></i></a>
             <?php } ?>
            </td>
      <?php } ?>
      <td class="nowrap"><?php echo htmlspecialchars($row['CustomerId']); ?></td>
      <td><?php echo htmlspecialchars($row2['Name'] ?? '-'); ?></td>
      <td><?php echo htmlspecialchars($row21['Name'] ?? '-'); ?></td>
      <td>
        <a class="font-weight-bold text-primary" href="customer-profile.php?id=<?php echo (int)$row['id']; ?>" target="_blank">
          <?php echo htmlspecialchars(trim($row['Fname']." ".$row['Lname'])); ?>
        </a>
      </td>
      <td><?php echo htmlspecialchars($row['ShopName']); ?></td>
      <td class="text-right font-weight-semibold"><?php echo inr($row['MonthlyRent']); ?></td>
      <td class="text-center"><?php echo franchiseBadge($row['OwnFranchise']); ?></td>
      <td class="nowrap">
    <?php 
        $phones = array_filter([trim($row['Phone']), trim($row['Phone2'])]);
        echo $phones ? implode("<br>", array_map('htmlspecialchars', $phones)) : '-';
    ?>
</td>
      <td class="nowrap"><code><?php echo htmlspecialchars($row['Password']); ?></code></td>
      <td><div class="text-truncate-2" title="<?php echo htmlspecialchars($row['Address']); ?>">
        <?php echo htmlspecialchars($row['Address']); ?></div>
      </td>
      <td class="text-center"><?php echo statusBadge($row['Status']); ?></td>
      <td class="nowrap"><?php echo $sellDate; ?></td>
      <td class="nowrap"><?php echo htmlspecialchars($row['Lattitude']); ?></td>
      <td class="nowrap"><?php echo htmlspecialchars($row['Longitude']); ?></td>
<td class="nowrap"><?php echo htmlspecialchars($row23['Zomato']); ?></td>
     
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
 function chageSurveyDetails(val,id){
   var action = "chageSurveyDetails";
            $.ajax({
                url: "ajax_files/ajax_customer_account.php",
                method: "POST",
                data: {
                    action: action,
                    id: id,
                    val:val
                },
                success: function(data) {
                    alert("Survey Details Changed.");
                  
                }
            });
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
