<?php session_start();
require_once 'config.php';
$user_id = $_SESSION['User']['id'];
$PageName = "BDM Checkpoints";
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
  $sql11 = "DELETE FROM tbl_bdm_checklist_records WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="view-bdm-checklist.php";
    </script>
<?php } ?>

 
        <div class="main-container">
            <div class="container">
                 <div style="float:right;">
                                                                   
                 <a href="add-bdm-checklist.php" class="btn btn-sm btn-default rounded">Add New</a>
            
                                
                                                                </div><br><br>
               
               
               

                       <?php 
$sql = "SELECT frid, visitdate FROM tbl_bdm_checklist_records 
        WHERE userid='$user_id' 
        GROUP BY frid, DATE(visitdate) 
        ORDER BY id DESC";

$row = getList($sql);
foreach($row as $result){
    $frid = $result['frid'];
    $visitDate = date("Y-m-d", strtotime($result['visitdate']));
    
    // Get Franchise Name
    $franchise = getRecord("SELECT ShopName FROM tbl_users_bill WHERE id = '$frid'");
    $franchiseName = $franchise['ShopName'] ?? 'N/A';
    
    // Total Questions
    $totalQ = getRow("SELECT * FROM tbl_bdm_checklist WHERE status = 1");
    $total = $totalQ ?? 0;

    // Filled Questions
    $filledQ = getRow("SELECT * FROM tbl_bdm_checklist_records 
                       WHERE frid = '$frid' AND userid='$user_id' 
                       AND DATE(visitdate) = '$visitDate' AND answer!=''");
    $filled = $filledQ ?? 0;

    // Not Filled
    $notFilled = $total - $filled;
?>
    <div class="card mb-3 p-3 shadow-sm" style="border-radius: 12px;">
    <div class="card-body p-2">
        <p style="margin-bottom: 4px;"><strong>Franchise:</strong> <?php echo $franchiseName; ?></p>
        <p style="margin-bottom: 4px;"><strong>Visit Date:</strong> <?php echo date("d/m/Y", strtotime($visitDate)); ?></p>
        <p style="margin-bottom: 4px; color: #007bff;"><strong>Total Ques : <?php echo $total; ?></strong></p>
        <p style="margin-bottom: 4px; color: #28a745;"><strong>Filled : <?php echo $filled; ?></strong> | <strong style="margin-bottom: 0px; color: #dc3545;">Not Filled : <?php echo $notFilled; ?></strong></p>
        
    </div>
</div>
<?php } ?>

                        
       

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
