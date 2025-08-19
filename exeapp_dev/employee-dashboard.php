<?php session_start();
require_once 'config.php';
$id = $_GET['id'];
$PageName = "Employee Dashboard";
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   

<style>

.dashboard-card {
    border-radius: 18px;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-decoration: none;
    transition: transform 0.2s ease;
  }

  .dashboard-card:hover {
    transform: translateY(-4px);
    opacity: 0.95;
  }

  .dashboard-icon {
    font-size: 28px;
    margin-bottom: 6px;
  }

  .dashboard-title {
    font-size: 13px;
    font-weight: 500;
    margin: 0;
  }

  .dashboard-count {
    font-size: 22px;
    font-weight: bold;
    margin: 0;
  }

  .mb-3-half {
    margin-bottom: 12px;
  }
</style>
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 

        <!-- page content start -->

       <?php 
       $UserId = $_SESSION['User']['id'] ?? 0;
$today = date('Y-m-d');
       // CONDITION BASED WHERE CLAUSE
if ($ReportingMgr == 1) {
    $userWhere = "tu.UnderUser = '$UserId'";
    $mainWhere = "UnderUser = '$UserId'";
} elseif (in_array($Roll, [134, 145, 181, 183])) {
    $userWhere = "tu.UnderByBdm = '$UserId'";
    $mainWhere = "UnderByBdm = '$UserId'";
} else {
    //$userWhere = "1"; // No restriction
    //$mainWhere = "1";
}

// Total Employees (user-wise)
$empCount = $conn->query("SELECT COUNT(*) AS total FROM tbl_users WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND Status=1 AND $mainWhere");
$empRow = $empCount->fetch_assoc();
$totalEmployees = $empRow['total'];

if (in_array($Roll, [134, 145, 181, 183])) {
// Total Franchises (user-wise)
if($AssignFranchiseBdm!=''){
$frCount = $conn->query("SELECT COUNT(*) AS total FROM tbl_users WHERE Roll IN (5) AND Status=1 AND id IN ($AssignFranchiseBdm)");
$frRow = $frCount->fetch_assoc();
$totalFranchises = $frRow['total'];
}
else{
    $totalFranchises = 0;
}
}

// Total Employees + Salary
$sql4 = "SELECT COUNT(*) AS TotEmp, SUM(MonthlySalary) AS MonthlySalary 
         FROM tbl_users 
         WHERE Status = 1 
         AND Roll NOT IN(1,5,55,9,22,23,63,3) 
         AND OtherEmp = 0 
         AND $mainWhere";
$row4 = getRecord($sql4);

// Today Present
$sql2 = "SELECT COUNT(*) AS PresentCount 
         FROM tbl_attendance ta 
         INNER JOIN tbl_users tu ON tu.id = ta.UserId 
         WHERE ta.CreatedDate = '$today' 
         AND ta.Type = 1 
         AND $userWhere";
$row2 = getRecord($sql2);

// Today Joining
$sql_today = "SELECT COUNT(*) AS TodayJoin FROM tbl_users 
              WHERE DATE(JoinDate) = '$today' 
              AND Status = 1 
              AND Roll NOT IN(1,5,55,9,22,23,63,3) 
              AND OtherEmp = 0 
              AND $mainWhere";
$row_today = getRecord($sql_today);

// Below 6 Months
$sql_below6 = "SELECT COUNT(*) AS Below6 FROM tbl_users 
               WHERE JoinDate >= DATE_SUB('$today', INTERVAL 6 MONTH) 
               AND JoinDate < '$today'
               AND Status = 1 
               AND Roll NOT IN(1,5,55,9,22,23,63,3) 
               AND OtherEmp = 0 
               AND $mainWhere";
$row_below6 = getRecord($sql_below6);

// 6 Months to 1 Year
$sql_6to1 = "SELECT COUNT(*) AS MidRange FROM tbl_users 
             WHERE JoinDate < DATE_SUB('$today', INTERVAL 6 MONTH) 
             AND JoinDate > DATE_SUB('$today', INTERVAL 1 YEAR)
             AND Status = 1 
             AND Roll NOT IN(1,5,55,9,22,23,63,3) 
             AND OtherEmp = 0 
             AND $mainWhere";
$row_6to1 = getRecord($sql_6to1);

// Above 1 Year
$sql_above1 = "SELECT COUNT(*) AS Above1 FROM tbl_users 
               WHERE JoinDate <= DATE_SUB('$today', INTERVAL 1 YEAR)
               AND Status = 1 
               AND Roll NOT IN(1,5,55,9,22,23,63,3) 
               AND OtherEmp = 0 
               AND $mainWhere";
$row_above1 = getRecord($sql_above1);

// Final Totals
$totfr = $frRow['total'] ?? 0;
$totemp = $row4['TotEmp'] ?? 0;
$totsal = $row4['MonthlySalary'] ?? 0;
$totpr = $row2['PresentCount'] ?? 0;
$tottodayjoin = $row_today['TodayJoin'] ?? 0;
$totbelow6Count = $row_below6['Below6'] ?? 0;
$totbetween6To1Count = $row_6to1['MidRange'] ?? 0;
$totabove1Count = $row_above1['Above1'] ?? 0;
$todayabsent = $totemp - $totpr;
?>
          <div class="container my-3">
  <div class="row">
    <!-- Total Employees -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php" class="dashboard-card" style="background: linear-gradient(135deg, #1E88E5, #42A5F5);">
        <span class="material-icons dashboard-icon">groups</span>
        <p class="dashboard-title">Total Employees</p>
        <p class="dashboard-count"><?php echo $totemp; ?></p>
      </a>
    </div>
    
    <?php if (in_array($Roll, [134, 145, 181, 183])) {?>
    <!-- Total Franchises -->
    <div class="col-6 mb-3-half">
      <a href="franchise-list.php" class="dashboard-card" style="background: linear-gradient(135deg, #43A047, #66BB6A);">
        <span class="material-icons dashboard-icon">storefront</span>
        <p class="dashboard-title">Total Franchises</p>
        <p class="dashboard-count"><?php echo $totfr; ?></p>
      </a>
    </div>
    <?php } ?>
    <!-- Today Present -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?val=present" class="dashboard-card" style="background: linear-gradient(135deg, #00ACC1, #26C6DA);">
        <span class="material-icons dashboard-icon">check_circle</span>
        <p class="dashboard-title">Today Present</p>
        <p class="dashboard-count"><?php echo $totpr;?></p>
      </a>
    </div>

    <!-- Today Absent -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?val=absent" class="dashboard-card" style="background: linear-gradient(135deg, #E53935, #EF5350);">
        <span class="material-icons dashboard-icon">cancel</span>
        <p class="dashboard-title">Today Absent</p>
        <p class="dashboard-count"><?php echo $todayabsent; ?></p>
      </a>
    </div>

    <!-- Today Joining -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?val=todayjoin" class="dashboard-card" style="background: linear-gradient(135deg, #8E24AA, #BA68C8);">
        <span class="material-icons dashboard-icon">person_add</span>
        <p class="dashboard-title">Today Joining</p>
        <p class="dashboard-count"><?php echo $tottodayjoin; ?></p>
      </a>
    </div>

    <!-- Below 6 Months -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?val=below6month" class="dashboard-card" style="background: linear-gradient(135deg, #F57C00, #FFA726);">
        <span class="material-icons dashboard-icon">hourglass_bottom</span>
        <p class="dashboard-title">Below 6 Months</p>
        <p class="dashboard-count"><?php echo $totbelow6Count; ?></p>
      </a>
    </div>

    <!-- 6 Months to 1 Year -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?val=above6month" class="dashboard-card" style="background: linear-gradient(135deg, #6D4C41, #A1887F);">
        <span class="material-icons dashboard-icon">timeline</span>
        <p class="dashboard-title">6M - 1Y</p>
        <p class="dashboard-count"><?php echo $totbetween6To1Count; ?></p>
      </a>
    </div>

    <!-- Above 1 Year -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?val=above1year" class="dashboard-card" style="background: linear-gradient(135deg, #455A64, #90A4AE);">
        <span class="material-icons dashboard-icon">emoji_events</span>
        <p class="dashboard-title">Above 1 Year</p>
        <p class="dashboard-count"><?php echo $totabove1Count; ?></p>
      </a>
    </div>
  </div>
</div>



    </main>
    <br><br><br><br>
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
