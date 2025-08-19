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

                   
                <div class="card">
                   
                
           
                    <div class="card-body px-0 pt-0">
                        <ul class="list-group list-group-flush" id="show_prod">
<ul class="list-group list-group-flush">
<?php 
$sql = "SELECT tu.*, tut.Name AS User_Type FROM tbl_users tu 
        LEFT JOIN tbl_user_type tut ON tu.UserType = tut.id 
        WHERE tu.Roll = 5 AND tu.id IN ($AssignFranchiseBdm)";


$sql .= " ORDER BY tu.id DESC";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $rowZone = getRecord("SELECT Name FROM tbl_zone WHERE id='".$row['ZoneId']."'");
        $rowSubZone = getRecord("SELECT Name FROM tbl_sub_zone WHERE id='".$row['SubZoneId']."'");
        $qrPath = '../barcodes/' . $row['Barcode'];
?>
<a href="fr-emp-dashboard.php?id=<?php echo $row['id']; ?>" class="d-block text-decoration-none text-dark">
    <li class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto pr-0">
                <div class="avatar avatar-40 rounded overflow-hidden border">
                    
                        <img src="logo33.png" alt="No QR" style="width: 40px; height: 40px;">
                    >
                </div>
            </div>
            <div class="col pl-2">
                <h6 class="mb-0 font-weight-bold text-dark"><?php echo strtoupper($row['Fname']." ".$row['Lname']); ?></h6>
                <small class="text-muted">Shop: <?php echo $row['ShopName']; ?></small>
            </div>
            <!--<div class="col-auto">
                <?php echo ($row['Status'] == 1) ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Pending</span>'; ?>
            </div>-->
        </div>

        <div class="mt-2 ml-2 pl-2 border-left small">
            <p class="mb-1"><strong>Franchise ID:</strong> <?php echo $row['CustomerId']; ?></p>
            <p class="mb-1"><strong>Zone:</strong> <?php echo $rowZone['Name'] ?? 'NA'; ?> </p> 
            <p class="mb-1"> <strong>Sub-Zone:</strong> <?php echo $rowSubZone['Name'] ?? 'NA'; ?></p>
            <p class="mb-1"><strong>Franchise Type:</strong> 
                <?php 
                    if ($row['OwnFranchise'] == '1') echo "<span style='color:green;'>COCO Franchise</span>";
                    elseif ($row['OwnFranchise'] == '2') echo "<span style='color:orange;'>FOFO Franchise</span>";
                    else echo "<span style='color:red;'>Other Franchise</span>";
                ?>
            </p>
            <p class="mb-1"><strong>Contact:</strong> <?php echo $row['Phone']; ?><?php echo $row['Phone2'] ? ' / '.$row['Phone2'] : ''; ?></p>
            <p class="mb-1"><strong>Monthly Rent:</strong> ₹<?php echo $row['MonthlyRent']; ?></p>
            <p class="mb-1"><strong>Opening Date:</strong> <?php echo date("d/m/Y", strtotime($row['SellDate'])); ?></p>
            <p class="mb-1"><strong>Location:</strong> Lat: <?php echo $row['Lattitude']; ?>, Lng: <?php echo $row['Longitude']; ?></p>
            <p class="mb-1"><strong>Address:</strong> <?php echo $row['Address']; ?></p>
        </div>
    </li>
</a>
<?php } } else { ?>
    <li class="list-group-item text-danger text-center">No Franchise Found</li>
<?php } ?>
</ul>


                    </div>
                </div>
             
                
            
        </div>
    </main>
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
