<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Selling-Products";
$Page = "Allocate-Products";

 
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
<h4 class="font-weight-bold py-3 mb-0">View Franchise For Allocate Products</h4>

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

<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
              <th>Id</th>
                <th>Franchise Name</th>
                 <th>Shop Name</th>
                  <th>Franchise Type</th>
               <th>Contact No</th>
               <th>Allocate</th>
            
                
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $sql = "SELECT tu.*,tut.Name As User_Type FROM tbl_users_bill tu LEFT JOIN tbl_user_type tut ON tu.UserType=tut.id WHERE tu.Roll=5 ";
       
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
              <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
              <td><?php echo $row['ShopName']; ?></td>
                <td><?php if($row['OwnFranchise']=='1'){echo "<span style='color:green;'>COCO Franchise</span>";} else if($row['OwnFranchise']=='2'){echo "<span style='color:orange;'>FOFO Franchise</span>";} else { echo "<span style='color:red;'>Other Franchise</span>";} ?></td>
              <td><?php echo $row['Phone']; ?></td>
               <td><a href="allocate-selling-product.php?frid=<?php echo $row['id']; ?>&ShopName=<?php echo $row['ShopName']; ?>" class="badge badge-pill badge-secondary">Allocate Products</a></td>
              
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
