<?php session_start();
require_once 'config.php';
$id = $_GET['id'];
$PageName = "Employees";
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

<?php
require_once 'config.php';

// Filters
$val = $_GET['val'] ?? '';
$frid = $_GET['frid'] ?? '';
$start_date = $_GET['start_date'] ?? date('Y-m-d');
$end_date = $_GET['end_date'] ?? date('Y-m-d');

// User Conditions
if (!empty($frid)) {
    $userWhere = "tu.UnderFrId = '$frid'";
    $mainWhere = "UnderFrId = '$frid'";
} else {
    if ($ReportingMgr == 1) {
        $userWhere = "tu.UnderUser = '$UserId'";
        $mainWhere = "UnderUser = '$UserId'";
    } elseif (in_array($Roll, [134, 145, 181, 183])) {
        $userWhere = "tu.UnderByBdm = '$UserId'";
        $mainWhere = "UnderByBdm = '$UserId'";
    } else {
        $userWhere = "1=1";
        $mainWhere = "1=1";
    }
}

// Initialize variables for filtering
$present_ids = [];
$present_id_list = '0';

// PRESENT Employees
if ($val == 'present') {
    $sql4 = "SELECT DISTINCT tu.id 
             FROM tbl_attendance ta
             INNER JOIN tbl_users tu ON tu.id = ta.UserId
             WHERE ta.CreatedDate BETWEEN '$start_date' AND '$end_date'
             AND ta.Type = 2 
             AND tu.Status = 1
             AND tu.Roll NOT IN (1, 5, 55, 9, 22, 23, 63, 3)
             AND tu.OtherEmp = 0
             AND $mainWhere";
    $res4 = $conn->query($sql4);
    while ($r = $res4->fetch_assoc()) {
        $present_ids[] = $r['id'];
    }
    $present_id_list = !empty($present_ids) ? implode(',', $present_ids) : '0';
}

// ABSENT Employees
if ($val == 'absent') {
    $present_sql = "SELECT DISTINCT ta.UserId 
                    FROM tbl_attendance ta
                    INNER JOIN tbl_users tu ON tu.id = ta.UserId
                    WHERE ta.CreatedDate BETWEEN '$start_date' AND '$end_date'
                    AND ta.Type = 2
                    AND tu.Status = 1
                    AND tu.Roll NOT IN (1, 5, 55, 9, 22, 23, 63, 3)
                    AND tu.OtherEmp = 0
                    AND $mainWhere";
    $present_res = $conn->query($present_sql);
    while ($row = $present_res->fetch_assoc()) {
        $present_ids[] = $row['UserId'];
    }
    $present_id_list = !empty($present_ids) ? implode(',', $present_ids) : '0';
}

// MAIN EMPLOYEE QUERY
$sql2 = "SELECT 
            tu.id, tu.Fname, tu.Lname, tu.Photo, tu.CreatedDate, tu.CustomerId,
            tu.UnderFrId, tu.UnderUser, tu.Status,
            tut.Name AS RoleName,
            tu2.Fname AS UnderName,
            tu3.ShopName AS UnderFrName
        FROM tbl_users tu 
        LEFT JOIN tbl_user_type tut ON tut.id = tu.Roll 
        LEFT JOIN tbl_users tu2 ON tu.UnderUser = tu2.id 
        LEFT JOIN tbl_users tu3 ON tu3.id = tu.UnderFrId 
        WHERE tu.Roll NOT IN (1, 5, 55, 9, 22, 23, 63, 3) 
          AND tu.OtherEmp = 0 
          AND tu.Status = 1
          AND $userWhere";

if ($val == 'present') {
    $sql2 .= " AND tu.id IN ($present_id_list)";
} elseif ($val == 'absent') {
    $sql2 .= " AND tu.id NOT IN ($present_id_list)";
} elseif ($val == 'todayjoin') {
    $sql2 .= " AND DATE(tu.CreatedDate) = '$start_date'";
} elseif ($val == 'below6month') {
    $sql2 .= " AND tu.CreatedDate >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
} elseif ($val == 'above6month') {
    $sql2 .= " AND tu.CreatedDate < DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
               AND tu.CreatedDate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
} elseif ($val == 'above1year') {
    $sql2 .= " AND tu.CreatedDate < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
}

$sql2 .= " ORDER BY tu.Fname ASC";
$res2 = $conn->query($sql2);

if ($res2->num_rows > 0) {
    while ($row = $res2->fetch_assoc()) {

$today = date('Y-m-d');
        // Attendance for each employee
        $sql22 = "SELECT 
                    DATE_FORMAT(MIN(CASE WHEN Type = 1 THEN CreatedTime END), '%r') AS PunchInTime,
                    DATE_FORMAT(MAX(CASE WHEN Type = 2 THEN CreatedTime END), '%r') AS PunchOutTime
                  FROM tbl_attendance 
                  WHERE CreatedDate BETWEEN '$today' AND '$today'
                  AND UserId = '".$row['id']."'";
        $row22 = getRecord($sql22);

        // Reporting Manager Name
        $UnderUserName = $row['UnderName'] ?? '—';
?>
        <a href="view-employee-details2.php?id=<?php echo $row['id']; ?>&frid=<?php echo $frid;?>&start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>" class="d-block text-decoration-none text-dark">
            <li class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-auto pr-0">
                        <div class="avatar avatar-40 rounded-circle overflow-hidden border">
                            <?php if (empty($row['Photo']) || !file_exists("../uploads/".$row['Photo'])) { ?>
                                <img src="no_profile.jpg" alt="No Image" style="width: 40px; height: 40px;">
                            <?php } else { ?>
                                <img src="../uploads/<?php echo $row['Photo']; ?>" alt="Profile" style="width: 40px; height: 40px;">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col pl-2">
                        <h6 class="mb-0 font-weight-bold text-dark"><?php echo strtoupper(strtolower($row['Fname']." ".$row['Lname'])); ?></h6>
                        <small class="text-muted">Employee ID: <?php echo $row['CustomerId']; ?></small>
                    </div>
                </div>

                <!-- Extra Info -->
                <div class="mt-2 ml-2 pl-2 border-left">
                    <p class="mb-1"><strong>Joined:</strong> <?php echo date("d/m/Y", strtotime($row['CreatedDate'])); ?></p>
                    <p class="mb-1"><strong>Reporting Manager:</strong> <?php echo $UnderUserName; ?></p>
                    <p class="mb-1"><strong>Franchise:</strong> <?php echo $row['UnderFrName']; ?></p>
                    <p class="mb-1"><strong>Today Attendance:</strong><br>
                        <span style="color: green;">Punch In:</span> <?php echo $row22['PunchInTime'] ?? '<span class="text-muted">—</span>'; ?><br>
                        <span style="color: red;">Punch Out:</span> <?php echo $row22['PunchOutTime'] ?? '<span class="text-muted">—</span>'; ?>
                    </p>
                </div>
            </li>
        </a>
<?php 
    }
} else { ?>
    <li class="list-group-item text-danger text-center">
        Oops! No Record Found..
    </li>
<?php } ?>

 
</ul>

                    </div>
                </div>
             
                
            
        </div>
    </main><br><br><br><br>
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
