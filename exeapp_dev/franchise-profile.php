<?php session_start();
require_once 'config.php';
$id = $_GET['id'];
$PageName = "Franchise";
$UserId = $_SESSION['User']['id']; ?>
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
    <link href="vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/daterangepicker-master/daterangepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 

        <!-- page content start -->

       
            <div class="container mb-4" style="padding-right: 1px;
padding-left: 1px;">

             <?php 
             $id = $_GET['id']; // or any source of franchise ID

$sql = "SELECT tu.*, 
               tz.Name AS ZoneName, 
               tsz.Name AS SubZoneName 
        FROM tbl_users tu 
        LEFT JOIN tbl_zone tz ON tz.id = tu.ZoneId 
        LEFT JOIN tbl_sub_zone tsz ON tsz.id = tu.SubZoneId 
        WHERE tu.Roll = 5 AND tu.id = '$id'";
$franchise = getRecord($sql);
?>
                <div class="card shadow-sm">
    <div class="card-body text-center">
        <div class="avatar avatar-100 rounded-circle mx-auto mb-3 overflow-hidden border">
           
              
                <img src="logo33.png" alt="QR" style="width: 100px; height: 100px;">
            
        </div>
        <h4 class="mb-0"><?php echo strtoupper($franchise['Fname'] . " " . $franchise['Lname']); ?></h4>
        <p class="text-muted"><?php echo $franchise['ShopName']; ?></p>
       
    </div>

    <hr class="my-0">

    <div class="card-body">
        <h6 class="text-primary">Franchise Details</h6>
        <p><strong>Franchise ID:</strong> <?php echo $franchise['CustomerId']; ?></p>
        <p><strong>Franchise Type:</strong> 
            <?php 
                if ($franchise['OwnFranchise'] == '1') echo "<span class='text-success'>COCO Franchise</span>";
                elseif ($franchise['OwnFranchise'] == '2') echo "<span class='text-warning'>FOFO Franchise</span>";
                else echo "<span class='text-danger'>Other Franchise</span>";
            ?>
        </p>
        <p><strong>Zone:</strong> <?php echo $franchise['ZoneName'] ?? 'NA'; ?></p>
        <p><strong>Sub-Zone:</strong> <?php echo $franchise['SubZoneName'] ?? 'NA'; ?></p>
        <p><strong>Opening Date:</strong> <?php echo date("d/m/Y", strtotime($franchise['SellDate'])); ?></p>

        <hr>
        <h6 class="text-primary">Contact Information</h6>
        <p><strong>Mobile:</strong> <?php echo $franchise['Phone']; ?></p>
        <?php if (!empty($franchise['Phone2'])): ?>
            <p><strong>Alternate No:</strong> <?php echo $franchise['Phone2']; ?></p>
        <?php endif; ?>
        <?php if (!empty($franchise['EmailId'])): ?>
            <p><strong>Email:</strong> <?php echo $franchise['EmailId']; ?></p>
        <?php endif; ?>
        <p><strong>Address:</strong> <?php echo $franchise['Address']; ?></p>

        <hr>
        <h6 class="text-primary">Other Info</h6>
        <p><strong>Monthly Rent:</strong> ₹<?php echo $franchise['MonthlyRent']; ?></p>
        <p><strong>Latitude:</strong> <?php echo $franchise['Lattitude']; ?></p>
        <p><strong>Longitude:</strong> <?php echo $franchise['Longitude']; ?></p>
    </div>
</div>

             
                
            
        </div>
    </main>
    <br><br><br><br><br>
 <?php include_once 'footer.php';?>

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

  <script src="vendor/daterangepicker-master/moment.min.js"></script>
    <script src="vendor/daterangepicker-master/daterangepicker.js"></script>
    <!-- page level custom script -->
    <script src="js/app.js"></script>

    </body>

</html>
