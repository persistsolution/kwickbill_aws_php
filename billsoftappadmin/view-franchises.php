<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Customers";
$Page = "View-Customers";
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
  $sql11 = "DELETE FROM tbl_users_bill WHERE id = '$id' AND Roll=5";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_users WHERE id = '$id' AND Roll=5";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-franchises.php";
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
                                                <option value="0" <?php if($_POST["OwnFranchise"]=='0') {?> selected
                                                    <?php } ?>>Other Franchise </option>
                                                     
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
?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <!-- <th>Photo</th> -->
               <!-- <th>QR Code</th> -->
               <th>Franchise ID</th>
                <th>Franchise Name</th>
                 <th>Shop Name</th>
                  <th>Franchise Type</th>
               <th>Contact No</th>
               <th>Password</th>
                <!-- <th>Email Id</th> -->
               <!-- <th>Taluka</th>-->
                 <!-- <th>User Type</th> -->
                <th>Status</th>
                 <!--<th>Survey Details</th>-->
                <th>Register Date</th>
               <th>Action</th>
            
                
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $sql = "SELECT tu.*,tut.Name As User_Type FROM tbl_users_bill tu LEFT JOIN tbl_user_type tut ON tu.UserType=tut.id WHERE tu.Roll=5 ";
            //$sql.=" AND tu.id IN ($CocoFranchiseAccess)";
            if($_POST['OwnFranchise']){
                $OwnFranchise = $_POST['OwnFranchise'];
                if($OwnFranchise == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tu.OwnFranchise='$OwnFranchise'";
                }
            }
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND tu.CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND tu.CreatedDate<='$ToDate'";
            }
            $sql.= " ORDER BY tu.id DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
             ?>
            <tr>
               <!-- <td> <?php if($row["Photo"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-100 rounded-circle"  style="width: 100px;height: 100px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <img src="../uploads/<?php echo $row["Photo"];?>" class="d-block ui-w-100 " alt="" style="width: 100px;height: 100px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-100 rounded-circle" style="width: 100px;height: 100px;"> 
             <?php } ?></td> -->
             
              <!--  <td> <?php if($row["Barcode"] == '') {?>
                  -
                 <?php } else if(file_exists('../barcodes/'.$row["Barcode"])){?>
                 <a href="../barcodes/<?php echo $row["Barcode"];?>" target="_new"><img src="../barcodes/<?php echo $row["Barcode"];?>?nocache=<?php echo time(); ?>" class="d-block ui-w-40" alt="" style="width: 40px;height: 40px;"></a>
                  <?php }  else{?>
                 -
             <?php } ?></td> -->
              <td><?php echo $row['id']; ?></td>
                <td><a href="fr_acc/dashboard.php?id=<?php echo $row['id']; ?>" target="_new"><?php echo $row['Fname']." ".$row['Lname']; ?></a></td>
              <td><?php echo $row['ShopName']; ?></td>
               <td class="text-center"><?php echo franchiseBadge($row['OwnFranchise']); ?></td>
              <td><?php echo $row['Phone']."<br>".$row['Phone2']; ?></td>
               <td><?php echo $row['Password']; ?></td>
                <!-- <td><?php echo $row['EmailId']; ?></td> -->
              
              <!--    <td><?php echo $row['Taluka']; ?></td>-->
              
                    <!-- <td><?php echo $row['User_Type']; ?></td> -->
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>

                 <!--<td><select class="form-control" onchange="chageSurveyDetails(this.value,<?php echo $row['id']; ?>)">
                     <option value="0" <?php if($row['SurveyDetails'] == 0){?> selected <?php } ?>>Survey Not Done</option>
                     <option value="1" <?php if($row['SurveyDetails'] == 1){?> selected <?php } ?>>Survey Done</option>
                 </select></td>-->
               
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
            
            <td>
             <a href="add-customer.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="lnr lnr-pencil mr-2"></i></a>&nbsp;&nbsp;
               <a onClick="return confirm('Are you sure you want delete this Franchise?\nNote : Delete all orders related this Franchise (Y/N)');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="lnr lnr-trash text-danger"></i></a> 
            </td>
              
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
