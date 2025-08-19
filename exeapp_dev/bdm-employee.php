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
if ($_GET['frid'] !='') {
     $userWhere = "tu.UnderFrId ='".$_GET['frid']."'";
              $mainWhere =" UnderFrId='".$_GET['frid']."'";
          }
          else{
if ($ReportingMgr == 1) {
    $userWhere = "tu.UnderUser = '$UserId'";
    $mainWhere = "UnderUser = '$UserId'";
} elseif (in_array($Roll, [134, 145, 181, 183])) {
    $userWhere = "tu.UnderByBdm = '$UserId'";
    $mainWhere = "UnderByBdm = '$UserId'";
} 
}

$today = date('Y-m-d');

if ($_GET['val'] == 'present') {
    // Today Present Employees with Salary and IDs
    $sql4 = "SELECT tu.id, tu.MonthlySalary
             FROM tbl_attendance ta
             INNER JOIN tbl_users tu ON tu.id = ta.UserId
             WHERE ta.CreatedDate = '$today'
             AND ta.Type = 1
             AND tu.Status = 1
             AND tu.Roll NOT IN(1, 5, 55, 9, 22, 23, 63, 3)
             AND tu.OtherEmp = 0
             AND $mainWhere";

    $res4 = $conn->query($sql4);

    $totemp = 0;
    $totsal = 0;
    $emp_ids = [];

    while ($row = $res4->fetch_assoc()) {
        $totemp++;
        $totsal += $row['MonthlySalary'];
        $emp_ids[] = $row['id'];
    }

    // Optional: Create a comma-separated ID string
    $emp_id_list = implode(',', $emp_ids);
}

if ($_GET['val'] == 'absent') {
// Today Present Employees with Salary and IDs
    $sql4 = "SELECT tu.id, tu.MonthlySalary
             FROM tbl_attendance ta
             INNER JOIN tbl_users tu ON tu.id = ta.UserId
             WHERE ta.CreatedDate = '$today'
             AND ta.Type = 1
             AND tu.Status = 1
             AND tu.Roll NOT IN(1, 5, 55, 9, 22, 23, 63, 3)
             AND tu.OtherEmp = 0
             AND $mainWhere";

    $res4 = $conn->query($sql4);

    $totemp = 0;
    $totsal = 0;
    $emp_ids = [];

    while ($row = $res4->fetch_assoc()) {
        $totemp++;
        $totsal += $row['MonthlySalary'];
        $emp_ids[] = $row['id'];
    }

    // Optional: Create a comma-separated ID string
    $emp_id_list = implode(',', $emp_ids);
}


if ($_GET['val'] == 'todayjoin') {
$sql_today = "SELECT id, Fname 
              FROM tbl_users 
              WHERE DATE(JoinDate) = '$today' 
              AND Status = 1 
              AND Roll NOT IN(1,5,55,9,22,23,63,3) 
              AND OtherEmp = 0 
              AND $mainWhere";

$res_today = $conn->query($sql_today);

$tottodayjoin = 0;
$todayJoinIds = [];
$todayJoinNames = [];

while ($row = $res_today->fetch_assoc()) {
    $tottodayjoin++;
    $todayJoinIds[] = $row['id'];
    $todayJoinNames[] = $row['Fname'];
}

// Optional:
$todayJoinIdList = implode(',', $todayJoinIds);
}

if ($_GET['val'] == 'below6month') {
    $sql_below6 = "SELECT id, Fname 
               FROM tbl_users 
               WHERE JoinDate >= DATE_SUB('$today', INTERVAL 6 MONTH) 
               AND JoinDate < '$today'
               AND Status = 1 
               AND Roll NOT IN(1,5,55,9,22,23,63,3) 
               AND OtherEmp = 0 
               AND $mainWhere";

$res_below6 = $conn->query($sql_below6);

$totbelow6Count = 0;
$below6Ids = [];
$below6Names = [];

while ($row = $res_below6->fetch_assoc()) {
    $totbelow6Count++;
    $below6Ids[] = $row['id'];
    $below6Names[] = $row['Fname'];
}

// Optional formatted outputs:
$below6IdList = implode(',', $below6Ids);
}

if ($_GET['val'] == 'above6month') {
$sql_6to1 = "SELECT id, Fname 
             FROM tbl_users 
             WHERE JoinDate < DATE_SUB('$today', INTERVAL 6 MONTH) 
             AND JoinDate > DATE_SUB('$today', INTERVAL 1 YEAR)
             AND Status = 1 
             AND Roll NOT IN(1,5,55,9,22,23,63,3) 
             AND OtherEmp = 0 
             AND $mainWhere";

$res_6to1 = $conn->query($sql_6to1);

$totbetween6To1Count = 0;
$midRangeIds = [];
$midRangeNames = [];

while ($row = $res_6to1->fetch_assoc()) {
    $totbetween6To1Count++;
    $midRangeIds[] = $row['id'];
    $midRangeNames[] = $row['Fname'];
}

// Optional strings
$midRangeIdList = implode(',', $midRangeIds);
$midRangeNameList = implode(', ', $midRangeNames);
}

if ($_GET['val'] == 'above1year') {
$sql_above1 = "SELECT id, Fname 
               FROM tbl_users 
               WHERE JoinDate <= DATE_SUB('$today', INTERVAL 1 YEAR)
               AND Status = 1 
               AND Roll NOT IN(1,5,55,9,22,23,63,3) 
               AND OtherEmp = 0 
               AND $mainWhere";

$res_above1 = $conn->query($sql_above1);

$totabove1Count = 0;
$above1Ids = [];
$above1Names = [];

while ($row = $res_above1->fetch_assoc()) {
    $totabove1Count++;
    $above1Ids[] = $row['id'];
    $above1Names[] = $row['Fname'];
}

// Optional: create strings
$above1IdList = implode(',', $above1Ids);
}
$sql2 = "SELECT 
            tu.id, tu.Fname, tu.Lname, tu.Photo, tu.CreatedDate, tu.Status, tu.UnderUser, tu.UnderFrId,tu.CustomerId,
            tut.Name AS RoleName,
            tu2.Fname AS UnderName,
            tu3.ShopName AS UnderFrName
        FROM tbl_users tu 
        LEFT JOIN tbl_user_type tut ON tut.id = tu.Roll 
        LEFT JOIN tbl_users tu2 ON tu.UnderUser = tu2.id 
        LEFT JOIN tbl_users tu3 ON tu3.id = tu.UnderFrId 
        WHERE tu.Roll NOT IN (1,5,55,9,22,23,63,3) 
          AND tu.OtherEmp = 0 
          AND tu.Status = 1 ";
          
          if ($_GET['val'] == 'present') {
              $sql2.=" AND tu.id IN($emp_id_list)";
          }
          if ($_GET['val'] == 'absent') {
              $sql2.=" AND tu.id NOT IN($emp_id_list)";
          }
          if ($_GET['val'] == 'todayjoin') {
              $sql2.=" AND tu.id IN($todayJoinIdList)";
          }
          if ($_GET['val'] == 'below6month') {
              $sql2.=" AND tu.id IN($below6IdList)";
          }
          if ($_GET['val'] == 'above6month') {
              $sql2.=" AND tu.id IN($midRangeIdList)";
          }
          if ($_GET['val'] == 'above1year') {
              $sql2.=" AND tu.id IN($above1IdList)";
          }
          
          $sql2.=" AND $userWhere";
        $sql2.=" ORDER BY tu.Fname ASC";
//echo $sql2;

$res2 = $conn->query($sql2);
$row_cnt = mysqli_num_rows($res2);
if ($row_cnt > 0) {
    while ($row = $res2->fetch_assoc()) {
        $Status = ($row['Status'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Pending</span>';
        $UnderUserName = ($row['UnderUser'] == 0) ? 'NA' : $row['UnderName'];

        $sql22 = "SELECT 
                    DATE_FORMAT(MAX(CASE WHEN Type = 1 THEN CreatedTime END), '%r') AS PunchInTime,
                    DATE_FORMAT(MAX(CASE WHEN Type = 2 THEN CreatedTime END), '%r') AS PunchOutTime
                  FROM tbl_attendance 
                  WHERE CreatedDate = CURDATE() AND UserId = '".$row['id']."'";
        $row22 = getRecord($sql22);
?>
 <a href="view-employee-details.php?id=<?php echo $row['id']; ?>" class="d-block text-decoration-none text-dark">
    <li class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto pr-0">
                <div class="avatar avatar-40 rounded-circle overflow-hidden border">
                    <?php if ($row['Photo'] == '' || !file_exists("../uploads/".$row['Photo'])) { ?>
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
            <!--<div class="col-auto">
                <?php echo $Status; ?>
            </div>-->
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
<?php }} else { ?>
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
