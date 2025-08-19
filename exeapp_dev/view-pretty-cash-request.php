<?php session_start();
require_once 'config.php';
$user_id = $_SESSION['User']['id'];
$PageName = "Pretty Cash Request";
$Page = "Recharge";
$WallMsg = "NotShow"; ?>
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
  $sql11 = "DELETE FROM tbl_invoice WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="view-vendor-expenses.php";
    </script>
<?php } ?>



        <div class="main-container">
            <div class="container">
                 <div style="float:right;">
                                                                   
                 <a href="add-pretty-cash-request.php" class="btn btn-sm btn-default rounded">New Req.</a>
            
                                
                                                                </div><br><br>
               
               
               

                        <?php 
$sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, 
               tu2.Fname AS MgrName, 
               tu3.Fname AS AdminName, 
               tu4.Fname AS AccName 
        FROM tbl_prettycash_request te 
        INNER JOIN tbl_users tu ON tu.id = te.UserId 
        LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
        LEFT JOIN tbl_users tu3 ON tu3.id = te.AdminBy 
        LEFT JOIN tbl_users tu4 ON tu4.id = te.AccBy 
        WHERE te.UserId = '$user_id' AND te.ExpenseDate>='2025-06-28'
        ORDER BY te.id DESC";

$rows = getList($sql);
foreach ($rows as $result) {
    $MgrName = $result['MgrName'];
    $AdminName = $result['AdminName'];
    $AccName = $result['AccName'];
?>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="mb-2 text-primary">₹<?php echo number_format($result['Amount'], 2); ?></h5>
                    <p class="mb-1">
                        <strong>REQ ID:</strong> <?= $result['id']; ?><br>
                        <strong>Narration:</strong> <?= $result['Narration']; ?><br>
                        <strong>Req. Date:</strong> <?= date("d/m/Y", strtotime($result['ExpenseDate'])); ?>
                    </p>

                    <!-- Manager Status -->
                    <p class="mb-1">
                        <strong>Manager Status:</strong>
                        <?php
                        if ($result['ManagerStatus'] == '1') {
                            echo "<span class='text-success'>Approved by $MgrName</span> | " . date("d/m/Y", strtotime($result['MannagerApproveDate']));
                            if (!empty($result['MannagerComment'])) {
                                echo "<br><em>Comment: {$result['MannagerComment']}</em>";
                            }
                        } elseif ($result['ManagerStatus'] == '2') {
                            echo "<span class='text-danger'>Rejected by $MgrName</span> | " . date("d/m/Y", strtotime($result['MannagerApproveDate']));
                            if (!empty($result['MannagerComment'])) {
                                echo "<br><em>Comment: {$result['MannagerComment']}</em>";
                            }
                        } else {
                            echo "<span class='text-warning'>Pending</span>";
                        }
                        ?>
                    </p>

                    <!-- Admin Status -->
                    <p class="mb-1">
                        <strong>Admin Status:</strong>
                        <?php
                        if ($result['AdminStatus'] == '1') {
                            echo "<span class='text-success'>Approved by $AdminName</span> | " . date("d/m/Y", strtotime($result['AdminApproveDate']));
                            if (!empty($result['AdminComment'])) {
                                echo "<br><em>Comment: {$result['AdminComment']}</em>";
                            }
                        } elseif ($result['AdminStatus'] == '2') {
                            echo "<span class='text-danger'>Rejected by $AdminName</span> | " . date("d/m/Y", strtotime($result['AdminApproveDate']));
                            if (!empty($result['AdminComment'])) {
                                echo "<br><em>Comment: {$result['AdminComment']}</em>";
                            }
                        } else {
                            echo "<span class='text-warning'>Pending</span>";
                        }
                        ?>
                    </p>

                    <!-- Accountant Status -->
                    <p class="mb-0">
                        <strong>Accountant Status:</strong>
                        <?php
                        if ($result['AccStatus'] == '1') {
                            echo "<span class='text-success'>Approved by $AccName</span> | " . date("d/m/Y", strtotime($result['AccApproveDate']));
                            if (!empty($result['AccComment'])) {
                                echo "<br><em>Comment: {$result['AccComment']}</em>";
                            }
                        } elseif ($result['AccStatus'] == '2') {
                            echo "<span class='text-danger'>Rejected by $AccName</span> | " . date("d/m/Y", strtotime($result['AccApproveDate']));
                            if (!empty($result['AccComment'])) {
                                echo "<br><em>Comment: {$result['AccComment']}</em>";
                            }
                        } else {
                            echo "<span class='text-warning'>Pending</span>";
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php 
} 
?>

                        
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
