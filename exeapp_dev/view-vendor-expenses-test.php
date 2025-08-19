<?php session_start();
require_once 'config.php';
$user_id = $_SESSION['User']['id'];
$PageName = "Vendor Expenses";
$Page = "Recharge";
$WallMsg = "NotShow"; 
 unset($_SESSION["cart_item1"]);
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?>

        <!-- page content start -->
<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
//   $sql11 = "DELETE FROM tbl_invoice WHERE id = '$id'";
//   $conn->query($sql11);
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="view-vendor-expenses-test.php";
    </script>
<?php } ?>



        <div class="main-container">
            <div class="container">
                 <div style="float:right;">
                                                                   
                 <a href="add-vendor-expenses-test.php" class="btn btn-sm btn-default rounded">Add New</a>
            
                                
                                                                </div><br><br>
               
               
               

                       <?php 
$sql = "SELECT te.*, tub.ShopName, tu3.Fname AS VedName 
        FROM tbl_vendor_expenses te
        LEFT JOIN tbl_users tu3 ON tu3.id = te.VedId 
        LEFT JOIN tbl_users_bill tub ON tub.id = te.Locations 
        WHERE te.UserId = '$user_id' AND te.ExpenseDate>='2025-05-01' 
        ORDER BY te.id DESC";

$row = getList($sql);
foreach ($row as $result) {
    $bdmdate = !empty($result['BdmApproveDate']) ? date("d/m/Y", strtotime($result['BdmApproveDate'])) : '-';
    $purchasedate = !empty($result['PurchaseApproveDate']) ? date("d/m/Y", strtotime($result['PurchaseApproveDate'])) : '-';
    $accountdate = !empty($result['ApproveDate']) ? date("d/m/Y", strtotime($result['ApproveDate'])) : '-';
    $admindate = !empty($result['AdminApproveDate']) ? date("d/m/Y", strtotime($result['AdminApproveDate'])) : '-';
    $BdmComment = $result['BdmComment'];
    $PurchaseComment = $result['PurchaseComment'];
    $AccountComment = $result['MannagerComment'];
    $AdminComment = $result['AdminComment'];
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <div class="row">
      
      <!-- Left Content -->
      <div class="col-md-9">
        <h5 class="text-primary mb-1">&#8377;<?= number_format($result['Amount'], 2); ?></h5>
        <p class="mb-1"><strong>Exp ID:</strong> <?= $result['id']; ?></p>
        <p class="mb-1"><strong>Invoice No:</strong> <?= $result['InvoiceNo']; ?></p>
        <p class="mb-1"><strong>Vendor Name:</strong> <?= $result['VedName']; ?></p>
        <p class="mb-1"><strong>Location:</strong> <?= $result['ShopName']; ?></p>
        <p class="mb-1"><strong>Expense Date:</strong> <?= $result['ExpenseDate']; ?></p>
        <p class="mb-2"><strong>Payment Mode:</strong> <?= $result['PaymentMode']; ?></p>

        <!-- Status Section -->
        <p class="mb-1">
          <strong>BDM Status:</strong>
          <?php
            if ($result['BdmStatus'] == '1') {
              echo "<span class='text-success'>Approved</span> | $bdmdate";
            } elseif ($result['BdmStatus'] == '2') {
              echo "<span class='text-danger'>Rejected</span> | $bdmdate <br> $BdmComment
              ";
            } else {
              echo "<span class='text-warning'>Pending</span>";
            }
          ?>
        </p>

        <p class="mb-1">
          <strong>Purchase Dept Status:</strong>
          <?php
            if ($result['PurchaseStatus'] == '1') {
              echo "<span class='text-success'>Approved</span> | $purchasedate";
            } elseif ($result['PurchaseStatus'] == '2') {
              echo "<span class='text-danger'>Rejected</span> | $purchasedate <br> $PurchaseComment";
            } else {
              echo "<span class='text-warning'>Pending</span>";
            }
          ?>
        </p>

        <p class="mb-1">
          <strong>Accountant Status:</strong>
          <?php
            if ($result['ManagerStatus'] == '1') {
              echo "<span class='text-success'>Approved</span> | $accountdate";
            } elseif ($result['ManagerStatus'] == '2') {
              echo "<span class='text-danger'>Rejected</span> | $accountdate <br> $AccountComment";
            } else {
              echo "<span class='text-warning'>Pending</span>";
            }
          ?>
        </p>

        <p class="mb-0">
          <strong>Admin Status:</strong>
          <?php
            if ($result['AdminStatus'] == '1') {
              echo "<span class='text-success'>Approved</span> | $admindate";
            } elseif ($result['AdminStatus'] == '2') {
              echo "<span class='text-danger'>Rejected</span> | $admindate <br> $AdminComment";
            } else {
              echo "<span class='text-warning'>Pending</span>";
            }
          ?>
        </p>
      </div>

      <!-- Right Action Buttons -->
      <div class="col-md-3 d-flex align-items-start justify-content-end">
        <div class="d-flex gap-2">
          <!-- Edit Button -->
          <a href="add-vendor-expenses-2.php?id=<?= $result['id']; ?>" 
             class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" 
             title="Edit"
             style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-pen"></i>
          </a>
&nbsp;
          <!-- Delete Button -->
          <a href="view-vendor-expenses-test.php?action=delete&id=<?= $result['id']; ?>" 
             class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" 
             title="Delete"
             onclick="return confirm('Are you sure you want to delete this record?');"
             style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-trash-alt"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

<?php } ?>

                        
                        <input type="text" class="Exp_Id" value="">
                    
                    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title">Are you sure?</h5>
      </div>
      <div class="modal-body">
          
        <button type="button" class="btn btn-success" onclick="delete()">YES</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
      </div>
     
    </div>

  </div>
</div>

            </div>
        </div>
    </main>
<br><br><br><br>
<?php include 'footer.php';?>
    <!-- Required jquery and libraries -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="js/app.js"></script>
<script>
    function getExpId(id){
        $('#myModal').modal('show');
        $('.Exp_Id').val(id);
    }
    
     
</script>
   
</body>

</html>
